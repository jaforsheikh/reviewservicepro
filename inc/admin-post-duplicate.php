<?php

/**
 * Admin Post Duplicate Action
 *
 * File: inc/admin-post-duplicate.php
 *
 * Adds a safe "Duplicate" row action for posts, pages, and public custom post types.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Check whether a post type can be duplicated.
 *
 * @param string $post_type Post type.
 * @return bool
 */
function rsp_can_duplicate_post_type($post_type)
{
  $excluded_post_types = [
    'attachment',
    'revision',
    'nav_menu_item',
    'custom_css',
    'customize_changeset',
    'oembed_cache',
    'user_request',
    'wp_block',
    'wp_template',
    'wp_template_part',
    'wp_global_styles',
    'wp_navigation',
  ];

  if (in_array($post_type, $excluded_post_types, true)) {
    return false;
  }

  $post_type_object = get_post_type_object($post_type);

  if (! $post_type_object || ! $post_type_object->show_ui) {
    return false;
  }

  return true;
}

/**
 * Add duplicate action link in admin post list.
 *
 * @param array   $actions Existing row actions.
 * @param WP_Post $post    Current post object.
 * @return array
 */
function rsp_add_duplicate_post_row_action($actions, $post)
{
  if (! $post instanceof WP_Post) {
    return $actions;
  }

  if (! rsp_can_duplicate_post_type($post->post_type)) {
    return $actions;
  }

  if (! current_user_can('edit_post', $post->ID)) {
    return $actions;
  }

  $duplicate_url = wp_nonce_url(
    add_query_arg(
      [
        'action'  => 'rsp_duplicate_post',
        'post_id' => absint($post->ID),
      ],
      admin_url('admin.php')
    ),
    'rsp_duplicate_post_' . absint($post->ID)
  );

  $actions['rsp_duplicate'] = sprintf(
    '<a href="%1$s" aria-label="%2$s">%3$s</a>',
    esc_url($duplicate_url),
    esc_attr(sprintf(__('Duplicate "%s"', 'reviewservicepro'), get_the_title($post))),
    esc_html__('Duplicate', 'reviewservicepro')
  );

  return $actions;
}
add_filter('post_row_actions', 'rsp_add_duplicate_post_row_action', 10, 2);
add_filter('page_row_actions', 'rsp_add_duplicate_post_row_action', 10, 2);

/**
 * Handle duplicate post action.
 */
function rsp_handle_duplicate_post_action()
{
  if (! is_admin()) {
    wp_die(esc_html__('Invalid request.', 'reviewservicepro'));
  }

  $post_id = isset($_GET['post_id']) ? absint($_GET['post_id']) : 0;

  if (! $post_id) {
    wp_die(esc_html__('Missing post ID.', 'reviewservicepro'));
  }

  if (! isset($_GET['_wpnonce']) || ! wp_verify_nonce(sanitize_text_field(wp_unslash($_GET['_wpnonce'])), 'rsp_duplicate_post_' . $post_id)) {
    wp_die(esc_html__('Security check failed.', 'reviewservicepro'));
  }

  $post = get_post($post_id);

  if (! $post instanceof WP_Post) {
    wp_die(esc_html__('Post not found.', 'reviewservicepro'));
  }

  if (! rsp_can_duplicate_post_type($post->post_type)) {
    wp_die(esc_html__('This post type cannot be duplicated.', 'reviewservicepro'));
  }

  if (! current_user_can('edit_post', $post_id)) {
    wp_die(esc_html__('You do not have permission to duplicate this item.', 'reviewservicepro'));
  }

  $current_user_id = get_current_user_id();

  $new_post_args = [
    'post_author'           => $current_user_id ? $current_user_id : $post->post_author,
    'post_content'          => $post->post_content,
    'post_title'            => sprintf(__('%s — Copy', 'reviewservicepro'), $post->post_title),
    'post_excerpt'          => $post->post_excerpt,
    'post_status'           => 'draft',
    'post_type'             => $post->post_type,
    'comment_status'        => $post->comment_status,
    'ping_status'           => $post->ping_status,
    'post_password'         => $post->post_password,
    'post_parent'           => $post->post_parent,
    'menu_order'            => $post->menu_order,
    'post_mime_type'        => $post->post_mime_type,
  ];

  $new_post_id = wp_insert_post(wp_slash($new_post_args), true);

  if (is_wp_error($new_post_id)) {
    wp_die(esc_html($new_post_id->get_error_message()));
  }

  /**
   * Copy taxonomies.
   */
  $taxonomies = get_object_taxonomies($post->post_type);

  if (! empty($taxonomies)) {
    foreach ($taxonomies as $taxonomy) {
      $terms = wp_get_object_terms($post_id, $taxonomy, ['fields' => 'ids']);

      if (! is_wp_error($terms)) {
        wp_set_object_terms($new_post_id, $terms, $taxonomy, false);
      }
    }
  }

  /**
   * Copy post meta safely.
   */
  $meta_to_skip = [
    '_edit_lock',
    '_edit_last',
    '_wp_old_slug',
    '_wp_trash_meta_status',
    '_wp_trash_meta_time',
  ];

  $post_meta = get_post_meta($post_id);

  if (! empty($post_meta)) {
    foreach ($post_meta as $meta_key => $meta_values) {
      if (in_array($meta_key, $meta_to_skip, true)) {
        continue;
      }

      foreach ($meta_values as $meta_value) {
        add_post_meta($new_post_id, $meta_key, maybe_unserialize($meta_value));
      }
    }
  }

  /**
   * Add original source note.
   */
  update_post_meta($new_post_id, '_rsp_duplicated_from', $post_id);

  $redirect_url = add_query_arg(
    [
      'post'   => absint($new_post_id),
      'action' => 'edit',
    ],
    admin_url('post.php')
  );

  wp_safe_redirect($redirect_url);
  exit;
}
add_action('admin_action_rsp_duplicate_post', 'rsp_handle_duplicate_post_action');

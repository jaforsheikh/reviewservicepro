import Swiper from 'swiper';
import { Autoplay, EffectFade } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/effect-fade';

import { gsap } from 'gsap';

document.addEventListener('DOMContentLoaded', () => {
  new Swiper('.hero-bg-slider', {
    modules: [Autoplay, EffectFade],
    effect: 'fade',
    loop: true,
    speed: 1400,
    autoplay: {
      delay: 4500,
      disableOnInteraction: false,
    },
  });

  const heroTimeline = gsap.timeline({
    defaults: {
      duration: 0.9,
      ease: 'power3.out',
    },
  });

  heroTimeline
    .from('.hero-badge', {
      y: 24,
      opacity: 0,
    })
    .from('.hero-title', {
      y: 38,
      opacity: 0,
    }, '-=0.45')
    .from('.hero-text', {
      y: 28,
      opacity: 0,
    }, '-=0.45')
    .from('.hero-actions', {
      y: 24,
      opacity: 0,
    }, '-=0.45')
    .from('.hero-trust > div', {
      y: 18,
      opacity: 0,
      stagger: 0.08,
    }, '-=0.35')
    .from('.hero-dashboard', {
      x: 50,
      opacity: 0,
      scale: 0.96,
    }, '-=0.65');

  gsap.to('.hero-dashboard', {
    y: -16,
    duration: 3,
    repeat: -1,
    yoyo: true,
    ease: 'sine.inOut',
  });
});
/* =========================================================
   Анимации темы ingigroup-wp-theme
   Требует: AOS, GSAP, ScrollTrigger
   ========================================================= */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {

    /* ---------- AOS: появление блоков при скролле ---------- */
    if (window.AOS) {
      AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 80,
        delay: 0
      });
    }

    /* ---------- GSAP: параллакс hero ---------- */
    if (window.gsap && window.ScrollTrigger) {
      gsap.registerPlugin(ScrollTrigger);

      var hero = document.querySelector('.hero');
      if (hero) {
        // Медленное смещение фонового изображения
        gsap.to(hero, {
          backgroundPosition: '50% 100%',
          ease: 'none',
          scrollTrigger: {
            trigger: hero,
            start: 'top top',
            end: 'bottom top',
            scrub: true
          }
        });

        // Лёгкое затухание текста при уходе hero из вьюпорта
        var heroInner = hero.querySelector('.hero__inner');
        if (heroInner) {
          gsap.to(heroInner, {
            opacity: 0,
            y: -40,
            ease: 'none',
            scrollTrigger: {
              trigger: hero,
              start: 'top top',
              end: 'bottom top',
              scrub: true
            }
          });
        }
      }

      /* ---------- Плавное появление секций (альтернатива AOS) ---------- */
      // Раскомментируйте, если хотите больше контроля, чем даёт AOS
      /*
      gsap.utils.toArray('.services, .advantages, .certificates, .opinions, .cta-form, .map').forEach(function (section) {
        gsap.from(section, {
          opacity: 0,
          y: 60,
          duration: 0.9,
          ease: 'power2.out',
          scrollTrigger: {
            trigger: section,
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        });
      });
      */
    }

  });
})();
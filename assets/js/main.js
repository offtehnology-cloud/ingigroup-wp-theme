(function ($) {
  'use strict';

  // Плавный скролл к форме
  $(document).on('click', '.js-open-form', function () {
    var $f = $('#cta-form');
    if ($f.length) $('html, body').animate({ scrollTop: $f.offset().top }, 400);
  });

  // AJAX-форма
  $(document).on('submit', '.js-ingi-form', function (e) {
    e.preventDefault();
    var $form = $(this);
    var $msg  = $form.find('.js-ingi-form-msg');

    var data = {
      action: 'ingi_send',
      nonce:  ingiAjax.nonce,
      inn:    $form.find('[name="inn"]').val(),
      name:   $form.find('[name="name"]').val(),
      phone:  $form.find('[name="phone"]').val(),
      agree:  $form.find('[name="agree"]').is(':checked') ? 1 : 0,
    };

    $msg.removeClass('is-error is-ok').text('Отправка…');

    $.post(ingiAjax.url, data)
      .done(function (res) {
        if (res.success) {
          $msg.addClass('is-ok').text(res.data.message);
          $form[0].reset();
        } else {
          $msg.addClass('is-error').text(res.data.message);
        }
      })
      .fail(function () {
        $msg.addClass('is-error').text('Ошибка сети.');
      });
  });

  // Яндекс.Карта с ленивой загрузкой
  if ($('#ingi-map').length) {
    var loadYmaps = function () {
      var s = document.createElement('script');
      s.src = 'https://api-maps.yandex.ru/2.1/?lang=ru_RU';
      s.onload = function () {
        ymaps.ready(function () {
          var $c = $('#ingi-map');
          var center = [ parseFloat($c.data('lat')), parseFloat($c.data('lon')) ];
          var map = new ymaps.Map('ingi-map', { center: center, zoom: 16 });
          map.geoObjects.add(new ymaps.Placemark(center, {}, { preset: 'islands#orangeIcon' }));
        });
      };
      document.head.appendChild(s);
    };
    if ('IntersectionObserver' in window) {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) { if (en.isIntersecting) { loadYmaps(); io.disconnect(); } });
      });
      io.observe(document.getElementById('ingi-map'));
    } else { loadYmaps(); }
  }

  // -----------------------------------------------------------
  // Анимации: AOS (появление при скролле) + GSAP (параллакс hero)
  // -----------------------------------------------------------
  document.addEventListener('DOMContentLoaded', function () {

    // AOS
    if (window.AOS) {
      AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 80,
        delay: 0
      });
    }

    // GSAP: параллакс фона hero
    if (window.gsap && window.ScrollTrigger) {
      gsap.registerPlugin(ScrollTrigger);

      var hero = document.querySelector('.hero');
      if (hero) {
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
    }

  });
  // Мобильное меню (бургер)
  $(document).on('click', '.js-burger', function () {
    var $burger = $(this);
    var $menu   = $('#mobile-menu');
    var isOpen  = $burger.hasClass('is-open');

    if (isOpen) {
      $menu.attr('hidden', true);
      $burger.removeClass('is-open').attr('aria-expanded', 'false');
    } else {
      $menu.removeAttr('hidden');
      $burger.addClass('is-open').attr('aria-expanded', 'true');
    }
  });
})(jQuery);
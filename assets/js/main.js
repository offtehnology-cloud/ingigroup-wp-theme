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
})(jQuery);
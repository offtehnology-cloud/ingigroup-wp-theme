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

		 // --- Проверка согласия на обработку персональных данных ---
		 var $agree = $form.find('[name="agree"]');
		 if ($agree.length && !$agree.is(':checked')) {
			 $msg.removeClass('is-ok').addClass('is-error')
				 .text('Пожалуйста, подтвердите согласие на обработку персональных данных.');
			 return false;
		 }
		 // --- /Проверка согласия ---

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

	 // Снимаем ошибку с чекбокса, как только пользователь его поставил
	 $(document).on('change', '.js-ingi-form [name="agree"]', function () {
		 if ($(this).is(':checked')) {
			 var $form = $(this).closest('.js-ingi-form');
			 var $msg  = $form.find('.js-ingi-form-msg');
			 if ($msg.hasClass('is-error') && $msg.text().indexOf('согласие') !== -1) {
				 $msg.removeClass('is-error').text('');
			 }
		 }
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

 /* =========================================
  *   Лайтбокс (сертификаты + сканы отзывов)
  *   Универсальный: собирает все .certificate-card
  *   со всех поддерживающих сеток в один список.
  *   ========================================= */
 (function () {
	 if (typeof gsap === 'undefined') return;

	 // Сетки, карточки которых открываются в лайтбоксе
	 const GRID_SELECTORS = [
		 '.certificates-grid',
  '.opinions-scans-grid',
  '.production-gallery__grid',
  '.felling-gallery__grid',   // ← новое
	 ];
	 const links = GRID_SELECTORS
	 .map( s => document.querySelector( s ) )
	 .filter( Boolean )
	 .flatMap( g => Array.from( g.querySelectorAll( '.certificate-card' ) ) );

	 if ( ! links.length ) return;

	 const lb = document.createElement( 'div' );
	 lb.className = 'lightbox';
	 lb.setAttribute( 'aria-hidden', 'true' );
	 lb.setAttribute( 'role', 'dialog' );
	 lb.setAttribute( 'aria-modal', 'true' );
	 lb.innerHTML = `
	 <div class="lightbox__backdrop"></div>
	 <button class="lightbox__close" type="button" aria-label="Закрыть">×</button>
	 <button class="lightbox__nav lightbox__nav--prev" type="button" aria-label="Предыдущий">‹</button>
	 <button class="lightbox__nav lightbox__nav--next" type="button" aria-label="Следующий">›</button>
	 <div class="lightbox__stage"><img class="lightbox__img" src="" alt=""></div>
	 `;
	 document.body.appendChild( lb );

	 const backdrop = lb.querySelector( '.lightbox__backdrop' );
	 const img      = lb.querySelector( '.lightbox__img' );
	 const btnClose = lb.querySelector( '.lightbox__close' );
	 const btnPrev  = lb.querySelector( '.lightbox__nav--prev' );
	 const btnNext  = lb.querySelector( '.lightbox__nav--next' );

	 const total = links.length;
	 let current   = 0;
	 let isOpen    = false;
	 let lastFocus = null;

	 function setImage( i ) {
		 current = ( i + total ) % total;
		 const a = links[ current ];
		 img.src = a.getAttribute( 'href' );
		 const innerImg = a.querySelector( 'img' );
		 img.alt = innerImg ? innerImg.alt : '';
	 }

	 function open( i ) {
		 lastFocus = document.activeElement;
		 setImage( i );
		 lb.classList.add( 'is-open' );
		 lb.setAttribute( 'aria-hidden', 'false' );
		 document.body.classList.add( 'lightbox-open' );
		 isOpen = true;

		 gsap.killTweensOf( [ lb, img ] );
		 gsap.set( lb, { display: 'flex' } );
		 gsap.fromTo( lb,  { opacity: 0 },                   { opacity: 1, duration: 0.25, ease: 'power2.out' } );
		 gsap.fromTo( img, { opacity: 0, scale: 0.92 },      { opacity: 1, scale: 1, duration: 0.35, ease: 'power2.out' } );
	 }

	 function close() {
		 if ( ! isOpen ) return;
		 gsap.killTweensOf( [ lb, img ] );
		 gsap.to( img, { opacity: 0, scale: 0.94, duration: 0.2, ease: 'power2.in' } );
		 gsap.to( lb, {
			 opacity: 0, duration: 0.25, ease: 'power2.in',
			onComplete: function () {
				lb.classList.remove( 'is-open' );
				lb.setAttribute( 'aria-hidden', 'true' );
				gsap.set( lb, { display: 'none' } );
				document.body.classList.remove( 'lightbox-open' );
				isOpen = false;
				if ( lastFocus && lastFocus.focus ) lastFocus.focus();
			}
		 } );
	 }

	 function nav( dir ) {
		 gsap.killTweensOf( img );
		 gsap.to( img, {
			 opacity: 0, scale: 0.98, duration: 0.15, ease: 'power1.in',
			onComplete: function () {
				setImage( current + dir );
				gsap.fromTo( img, { opacity: 0, scale: 0.98 }, { opacity: 1, scale: 1, duration: 0.25, ease: 'power1.out' } );
			}
		 } );
	 }

	 links.forEach( function ( a, i ) {
		 a.addEventListener( 'click', function ( e ) {
			 e.preventDefault();
			 open( i );
		 } );
	 } );

	 btnClose.addEventListener( 'click', close );
	 backdrop.addEventListener( 'click', close );
	 btnPrev.addEventListener( 'click', function () { nav( -1 ); } );
	 btnNext.addEventListener( 'click', function () { nav( 1 ); } );

	 document.addEventListener( 'keydown', function ( e ) {
		 if ( ! isOpen ) return;
		 if ( e.key === 'Escape' ) close();
		 else if ( e.key === 'ArrowLeft' ) nav( -1 );
		 else if ( e.key === 'ArrowRight' ) nav( 1 );
	 } );

		 let touchStartX = 0;
		 lb.addEventListener( 'touchstart', function ( e ) {
			 touchStartX = e.changedTouches[ 0 ].clientX;
		 }, { passive: true } );
		 lb.addEventListener( 'touchend', function ( e ) {
			 const dx = e.changedTouches[ 0 ].clientX - touchStartX;
			 if ( Math.abs( dx ) > 50 ) nav( dx > 0 ? -1 : 1 );
		 }, { passive: true } );
 })();

 /* ============================================================
  *   MODAL CALLBACK — открытие/закрытие/фокус-трап
  *   ============================================================ */
 (function () {
	 const modal = document.getElementById('modal-callback');
	 if (!modal) return;

	 const dialog = modal.querySelector('.modal-callback__dialog');
	 let lastFocused = null;

	 function openModal() {
		 lastFocused = document.activeElement;
		 modal.classList.add('is-open');
		 modal.setAttribute('aria-hidden', 'false');
		 document.body.classList.add('modal-open');

		 const first = modal.querySelector('input:not([type="hidden"]):not([type="checkbox"]), textarea, select');
		 if (first) setTimeout(function () { first.focus(); }, 120);
	 }

	 function closeModal() {
		 modal.classList.remove('is-open');
		 modal.setAttribute('aria-hidden', 'true');
		 document.body.classList.remove('modal-open');
		 if (lastFocused && lastFocused.focus) lastFocused.focus();
	 }

	 // Открытие — любой элемент с классом .js-open-callback
	 document.addEventListener('click', function (e) {
		 const trigger = e.target.closest('.js-open-callback');
		 if (!trigger) return;
		 e.preventDefault();
		 openModal();
	 });

	 // Закрытие — клик по overlay или крестику
	 modal.addEventListener('click', function (e) {
		 if (e.target.closest('[data-modal-close]')) {
			 e.preventDefault();
			 closeModal();
		 }
	 });

	 // ESC
	 document.addEventListener('keydown', function (e) {
		 if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
	 });

		 // Фокус-трап
		 modal.addEventListener('keydown', function (e) {
			 if (e.key !== 'Tab' || !modal.classList.contains('is-open')) return;
			 const f = dialog.querySelectorAll('button, input:not([type="hidden"]), textarea, select, a[href]');
			 if (!f.length) return;
			 const first = f[0];
			 const last = f[f.length - 1];
			 if (e.shiftKey && document.activeElement === first) {
				 e.preventDefault();
				 last.focus();
			 } else if (!e.shiftKey && document.activeElement === last) {
				 e.preventDefault();
				 first.focus();
			 }
		 });

		 // Публичный API — если где-то понадобится открыть из JS
		 window.ingiOpenCallback = openModal;
 })();

 /* ============================================================
  *   SPOILER (аккордеон услуг) — поддержка вложенности
  *   ============================================================ */
 document.addEventListener('click', function (e) {
	 const header = e.target.closest('.spoiler__header');
	 if (!header) return;
	 const spoiler = header.closest('.spoiler');
	 if (!spoiler) return;
	 if (spoiler.classList.contains('spoiler--static')) return; // нераскрывающиеся
	 e.preventDefault();
	 spoiler.classList.toggle('is-open');
 });
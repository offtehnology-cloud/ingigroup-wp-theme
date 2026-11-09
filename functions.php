<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'INGI_VERSION', '1.0.0' );
define( 'INGI_DIR', get_template_directory() );
define( 'INGI_URI', get_template_directory_uri() );

require_once INGI_DIR . '/inc/setup.php';
require_once INGI_DIR . '/inc/enqueue.php';
require_once INGI_DIR . '/inc/customizer.php';
require_once INGI_DIR . '/inc/cpt.php';
require_once INGI_DIR . '/inc/ajax-form.php';
require get_template_directory() . '/inc/meta-boxes-production-gallery.php';

add_filter( 'ingigroup_company_stats', function ( $stats ) {
	$stats[0]['value'] = '4+';
	return $stats;
} );

require get_template_directory() . '/inc/meta-boxes-opinion.php';

// Отключаем кэширование sitemap в Rank Math для мгновенного обновления
add_filter( 'rank_math/sitemap/enable_caching', '__return_false' );

// Убираем jquery-migrate (лишний вес, нужен только для старых плагинов)
add_action( 'wp_default_scripts', function ( $scripts ) {
	if ( ! empty( $scripts->registered['jquery'] ) ) {
		$scripts->registered['jquery']->deps = array_diff(
			$scripts->registered['jquery']->deps,
			array( 'jquery-migrate' )
		);
	}
} );

/**
 * Оптимизация скорости: Добавляем defer к скриптам в подвале
 */
add_filter( 'script_loader_tag', function ( $tag, $handle ) {
	// Список скриптов, которым нужен defer (все, что в футере)
	$defer_handles = [ 'ingi-main', 'aos', 'gsap', 'gsap-scrolltrigger' ];

	if ( in_array( $handle, $defer_handles, true ) ) {
		return str_replace( ' src', ' defer="defer" src', $tag );
	}
	return $tag;
}, 10, 2 );

/**
 * Preload для LCP-изображений на страницах услуг
 */
add_action( 'wp_head', function () {
	// Массив соответствия: slug страницы => имя файла картинки
	$hero_images = [
		'service'      => 'service-rsr-hero.jpg',
		'production'   => 'production-hero.jpg',
		'rent'         => 'rent-hero.jpg',
		'development'  => 'rent-hero.jpg', // По хендоверу у development фон rent-hero.jpg
		'felling'      => 'felling-hero.jpg',
	];

	// Если мы на одной из этих страниц, добавляем preload
	if ( is_page( array_keys( $hero_images ) ) ) {
		$page_slug = get_post_field( 'post_name' );
		if ( isset( $hero_images[ $page_slug ] ) ) {
			$img_url = INGI_URI . '/assets/images/' . $hero_images[ $page_slug ];
			echo '<link rel="preload" href="' . esc_url( $img_url ) . '" as="image" fetchpriority="high">' . "\n";
		}
	}
}, 1 ); // Приоритет 1, чтобы сработало раньше остальных тегов

add_action( 'wp_print_scripts', function () {
	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery-migrate' );
	}
}, 100 );

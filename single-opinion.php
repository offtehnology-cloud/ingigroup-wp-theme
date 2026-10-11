<?php
/**
 * Одиночный отзыв — редирект на архив.
 *
 * У отзывов нет отдельной страницы: весь контент живёт на /opinions/.
 * Если кто-то откроет /opinions/<slug>/ — уводим на архив.
 *
 * @package ingigroup
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$archive = get_post_type_archive_link( 'opinion' );

if ( $archive ) {
	wp_safe_redirect( $archive, 301 );
	exit;
}

// Фолбэк, если архив почему-то не зарегистрирован — на всякий случай.
wp_safe_redirect( home_url( '/' ), 301 );
exit;
<?php
/**
 * Хлебные крошки.
 *
 * Поддерживает:
 *  - Главную
 *  - Обычные страницы (в т.ч. вложенные)
 *  - Архив, таксономию и одиночный CPT `project`
 *  - Архивы любых других CPT (certificate, opinion, service)
 *  - Записи и архив блога
 *  - Поиск и 404
 *
 * @package Ingigroup
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

$items   = array();
$items[] = array(
	'url'   => home_url( '/' ),
	'label' => 'Главная',
);

/* ---------- 1. ПРОЕКТЫ (архив / категория / одиночный) ---------- */
if ( is_post_type_archive( 'project' ) || is_tax( 'project_category' ) || is_singular( 'project' ) ) {
	$items[] = array(
		'url'   => get_post_type_archive_link( 'project' ),
		'label' => 'Реализованные проекты',
	);
}

/* ---------- 1b. АРХИВЫ ДРУГИХ CPT (certificate, opinion, service) ---------- */
elseif ( is_post_type_archive( array( 'certificate', 'opinion', 'service' ) ) ) {

	$pt_slug = get_query_var( 'post_type' );
	if ( is_array( $pt_slug ) ) {
		$pt_slug = reset( $pt_slug );
	}
	$pt_obj = $pt_slug ? get_post_type_object( $pt_slug ) : null;

	if ( $pt_obj ) {
		$items[] = array(
			'url'   => '',
			'label' => $pt_obj->labels->name, // «Сертификаты» / «Отзывы» / «Услуги»
		);
	}
}

/* ---------- 2. ТАКСОНОМИЯ project_category ---------- */
if ( is_tax( 'project_category' ) ) {
	$term = get_queried_object();
	if ( $term && ! is_wp_error( $term ) ) {
		$items[] = array(
			'url'   => '',
			'label' => $term->name,
		);
	}
}

/* ---------- 3. ОДИНОЧНЫЙ ПРОЕКТ ---------- */
elseif ( is_singular( 'project' ) ) {
	$terms = get_the_terms( get_the_ID(), 'project_category' );
	if ( $terms && ! is_wp_error( $terms ) ) {
		$items[] = array(
			'url'   => get_term_link( $terms[0] ),
			'label' => $terms[0]->name,
		);
	}
	// Заголовок проекта не добавляем — он выводится ниже как H1.
}

/* ---------- 4. ОБЫЧНЫЕ СТРАНИЦЫ (в т.ч. вложенные) ---------- */
elseif ( is_page() ) {
	$ancestors = array_reverse( get_post_ancestors( get_the_ID() ) );
	foreach ( $ancestors as $ancestor_id ) {
		$items[] = array(
			'url'   => get_permalink( $ancestor_id ),
			'label' => get_the_title( $ancestor_id ),
		);
	}
	$items[] = array(
		'url'   => '',
		'label' => get_the_title(),
	);
}

/* ---------- 5. ЗАПИСИ БЛОГА ---------- */
elseif ( is_singular( 'post' ) ) {
	$blog_url = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' );
	$items[]  = array(
		'url'   => $blog_url,
		'label' => 'Блог',
	);
	$items[]  = array(
		'url'   => '',
		'label' => get_the_title(),
	);
}

/* ---------- 6. АРХИВ ЗАПИСЕЙ БЛОГА ---------- */
elseif ( is_home() && ! is_front_page() ) {
	$items[] = array(
		'url'   => '',
		'label' => 'Блог',
	);
}

/* ---------- 7. ПОИСК / 404 (фолбэк) ---------- */
elseif ( is_search() ) {
	$items[] = array(
		'url'   => '',
		'label' => 'Результаты поиска',
	);
} elseif ( is_404() ) {
	$items[] = array(
		'url'   => '',
		'label' => 'Страница не найдена',
	);
}
?>

<?php if ( ! empty( $items ) ) : ?>
<div class="container">
<nav class="breadcrumbs" aria-label="Хлебные крошки">
<?php foreach ( $items as $i => $item ) : ?>
<?php if ( $i > 0 ) : ?>
<span class="breadcrumbs__sep" aria-hidden="true">›</span>
<?php endif; ?>

<?php if ( ! empty( $item['url'] ) ) : ?>
<a href="<?php echo esc_url( $item['url'] ); ?>">
<?php echo esc_html( $item['label'] ); ?>
</a>
<?php else : ?>
<span class="breadcrumbs__current">
<?php echo esc_html( $item['label'] ); ?>
</span>
<?php endif; ?>
<?php endforeach; ?>
</nav>
</div>
<?php endif; ?>
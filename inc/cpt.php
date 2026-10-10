<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', function () {

	register_post_type( 'service', [
		'labels' => [
			'name'          => 'Услуги',
			'singular_name' => 'Услуга',
			'add_new_item'  => 'Добавить услугу',
			'edit_item'     => 'Редактировать услугу',
		],
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-hammer',
		'rewrite'      => [ 'slug' => 'services' ],
		'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ],
		'show_in_rest' => true,
	] );

	register_post_type( 'project', [
		'labels' => [
			'name'          => 'Проекты',
			'singular_name' => 'Проект',
			'add_new_item'  => 'Добавить проект',
		],
		'public'            => true,
		'has_archive'       => 'projects',           // архив на /projects/
		'menu_icon'         => 'dashicons-portfolio',
		'rewrite'           => [
			'slug'       => 'project',               // одиночный проект: /project/<slug>/
			'with_front' => false,
		],
		'supports'          => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ],
		'show_in_rest'      => true,
		'publicly_queryable'=> true,
	] );

	/**
	 * Таксономия для проектов: 3 подраздела
	 * URL: /projects/<slug>/
	 */
	register_taxonomy( 'project_category', 'project', [
		'labels' => [
			'name'              => 'Категории проектов',
			'singular_name'     => 'Категория проекта',
			'search_items'      => 'Искать категории',
			'all_items'         => 'Все категории',
			'parent_item'       => 'Родительская категория',
			'parent_item_colon' => 'Родительская категория:',
			'edit_item'         => 'Редактировать категорию',
			'update_item'       => 'Обновить категорию',
			'add_new_item'      => 'Добавить категорию',
			'new_item_name'     => 'Название новой категории',
			'menu_name'         => 'Категории проектов',
		],
		'hierarchical'       => true,
		'public'             => true,
		'publicly_queryable' => true,
		'query_var'          => 'project_category',
		'rewrite'            => [
			'slug'         => 'projects',            // URL: /projects/<term>/
			'with_front'   => false,
			'hierarchical' => false,
		],
		'show_in_rest'       => true,
		'show_admin_column'  => true,
	] );

	register_post_type( 'opinion', [
		'labels' => [
			'name'          => 'Отзывы',
			'singular_name' => 'Отзыв',
			'add_new_item'  => 'Добавить отзыв',
		],
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-format-quote',
		'rewrite'      => [ 'slug' => 'opinions' ],
		'supports'     => [ 'title', 'editor', 'thumbnail' ],
		'show_in_rest' => true,
	] );

	register_post_type( 'certificate', [
		'labels' => [
			'name'          => 'Сертификаты',
			'singular_name' => 'Сертификат',
			'add_new_item'  => 'Добавить сертификат',
		],
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-awards',
		'rewrite'      => [ 'slug' => 'certificates' ],
		'supports'     => [ 'title', 'thumbnail', 'page-attributes' ],
		'show_in_rest' => true,
	] );
} );

/**
 * Отдаём приоритет правилу архива CPT над правилами таксономии.
 * Без этого /projects/ будет матчиться как термин и отдавать 404.
 */
add_filter( 'rewrite_rules_array', function ( $rules ) {
	$prefix = [
		'projects/?$'                 => 'index.php?post_type=project',
		'projects/page/([0-9]+)/?$'   => 'index.php?post_type=project&paged=$matches[1]',
	];
	return $prefix + $rules;
} );

/**
 * Автосоздание трёх подразделов проектов при активации темы.
 */
add_action( 'after_switch_theme', function () {

	$terms = [
		'ustanovka-rsp'             => 'Установка рельсовых страховочных пакетов',
		'vyrubka-dkr'               => 'Вырубка древесно-кустарниковой растительности',
		'obshchestroitelnye-raboty' => 'Общестроительные работы',
	];

	foreach ( $terms as $slug => $name ) {
		if ( ! term_exists( $slug, 'project_category' ) ) {
			wp_insert_term( $name, 'project_category', [ 'slug' => $slug ] );
		}
	}

	flush_rewrite_rules();
} );
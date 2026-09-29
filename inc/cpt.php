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
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-portfolio',
        'rewrite'      => [ 'slug' => 'projects' ],
        'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'show_in_rest' => true,
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
<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'after_setup_theme', function () {
    load_theme_textdomain( 'ingigroup', INGI_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', [
        'height'      => 60,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
    add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'responsive-embeds' );

    register_nav_menus( [
        'primary'         => 'Главное меню (шапка)',
        'services_menu'   => 'Меню услуг (оранжевая полоса)',
        'footer_services' => 'Подвал — Услуги',
        'footer_docs'     => 'Подвал — Документы',
    ] );

    add_image_size( 'service-card', 700, 500, true );
    add_image_size( 'cert-thumb',   400, 560, false );
} );
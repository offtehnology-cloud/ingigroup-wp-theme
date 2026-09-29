<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'ingi-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap',
        [], null
    );

    wp_enqueue_style( 'ingi-main',       INGI_URI . '/assets/css/main.css',       [ 'ingi-fonts' ], INGI_VERSION );
    wp_enqueue_style( 'ingi-responsive', INGI_URI . '/assets/css/responsive.css', [ 'ingi-main' ],  INGI_VERSION );
        wp_enqueue_style( 'ingi-hotfix',     INGI_URI . '/assets/css/hotfix.css',     [ 'ingi-responsive' ], INGI_VERSION );
    wp_enqueue_style( 'ingi-style',      get_stylesheet_uri(),                   [ 'ingi-main' ],  INGI_VERSION );

    wp_enqueue_script( 'ingi-main', INGI_URI . '/assets/js/main.js', [ 'jquery' ], INGI_VERSION, true );
    wp_localize_script( 'ingi-main', 'ingiAjax', [
        'url'   => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'ingi_form' ),
    ]);
} );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
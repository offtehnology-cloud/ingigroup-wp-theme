<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', function () {

    /* ---------- Автоматические версии по mtime ---------- */
    $ver = function ( $rel_path ) {
        $abs = INGI_DIR . $rel_path;
        return file_exists( $abs ) ? filemtime( $abs ) : INGI_VERSION;
    };

    /* ---------- Стили ---------- */
    wp_enqueue_style(
        'ingi-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap',
        [], null
    );

    // AOS — появление блоков при скролле
    wp_enqueue_style(
        'aos',
        'https://unpkg.com/aos@2.3.1/dist/aos.css',
        [], '2.3.1'
    );

    wp_enqueue_style(
        'ingi-main',
        INGI_URI . '/assets/css/main.css',
        [ 'ingi-fonts' ],
        $ver( '/assets/css/main.css' )
    );

    wp_enqueue_style(
        'ingi-responsive',
        INGI_URI . '/assets/css/responsive.css',
        [ 'ingi-main' ],
        $ver( '/assets/css/responsive.css' )
    );

    wp_enqueue_style(
        'ingi-hotfix',
        INGI_URI . '/assets/css/hotfix.css',
        [ 'ingi-responsive' ],
        $ver( '/assets/css/hotfix.css' )
    );

    wp_enqueue_style(
        'ingi-style',
        get_stylesheet_uri(),
        [ 'ingi-main' ],
        $ver( '/style.css' )
    );

    /* ---------- Скрипты ---------- */
    // AOS
    wp_enqueue_script(
        'aos',
        'https://unpkg.com/aos@2.3.1/dist/aos.js',
        [], '2.3.1', true
    );

    // GSAP + ScrollTrigger
    wp_enqueue_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
        [], '3.12.2', true
    );

    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
        [ 'gsap' ], '3.12.2', true
    );

    // Основной скрипт темы
    wp_enqueue_script(
        'ingi-main',
        INGI_URI . '/assets/js/main.js',
        [ 'jquery', 'aos', 'gsap', 'gsap-scrolltrigger' ],
        $ver( '/assets/js/main.js' ),
        true
    );

    wp_localize_script( 'ingi-main', 'ingiAjax', [
        'url'   => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'ingi_form' ),
    ]);
} );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
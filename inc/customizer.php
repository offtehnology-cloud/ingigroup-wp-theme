<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'customize_register', function ( $wp_customize ) {

    $wp_customize->add_section( 'ingi_contacts', [
        'title'    => 'ИНЖИГРУПП — Контакты',
        'priority' => 30,
    ] );

    $fields = [
        'ingi_slogan'     => [ 'label' => 'Слоган в шапке', 'default' => 'КОМПЛЕКС РАБОТ ПО УСТАНОВКЕ СТРАХОВОЧНЫХ РЕЛЬСОВЫХ ПАКЕТОВ' ],
        'ingi_phone'      => [ 'label' => 'Телефон',        'default' => '+7 (917) 909-99-96' ],
        'ingi_email'      => [ 'label' => 'Email',          'default' => 'info@ingigroup.ru' ],
        'ingi_addr_main'  => [ 'label' => 'Основной офис',  'default' => 'Республика Татарстан, г. Казань, ул. Гвардейская, д. 33, офис 210' ],
        'ingi_addr_extra' => [ 'label' => 'Доп. офис',      'default' => 'г. Москва, ул. Жебрунова, д. 6, стр. 1, офис 224' ],
        'ingi_telegram'   => [ 'label' => 'Telegram (URL)', 'default' => '' ],
        'ingi_whatsapp'   => [ 'label' => 'WhatsApp (URL)', 'default' => '' ],
        'ingi_copyright'  => [ 'label' => 'Копирайт',       'default' => '© 2023–2026 гг. ООО «ИНЖИГРУПП»' ],
        'ingi_map_lat'    => [ 'label' => 'Широта карты',   'default' => '55.785548' ],
        'ingi_map_lon'    => [ 'label' => 'Долгота карты',  'default' => '49.171925' ],
    ];

    foreach ( $fields as $key => $cfg ) {
        $wp_customize->add_setting( $key, [
            'default'           => $cfg['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => $cfg['label'],
            'section' => 'ingi_contacts',
            'type'    => 'text',
        ] );
    }
} );
<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'customize_register', function ( $wp_customize ) {

	$wp_customize->add_section( 'ingi_contacts', [
		'title'    => 'ИНЖИГРУПП — Контакты',
		'priority' => 30,
	] );

	$fields = [
		// --- Существующие ---
		'ingi_slogan'     => [ 'label' => 'Слоган в шапке', 'default' => 'КОМПЛЕКС РАБОТ ПО УСТАНОВКЕ СТРАХОВОЧНЫХ РЕЛЬСОВЫХ ПАКЕТОВ' ],
		'ingi_phone'      => [ 'label' => 'Телефон',        'default' => '+7 (917) 909-99-96' ],
		'ingi_email'      => [ 'label' => 'Email',          'default' => 'info@ingigroup.ru' ],
		'ingi_addr_main'  => [ 'label' => 'Основной офис (адрес)', 'default' => 'Республика Татарстан, г. Казань, ул. Гвардейская, д. 33, офис 210' ],
		'ingi_addr_extra' => [ 'label' => 'Доп. офис (адрес)',     'default' => 'г. Москва, ул. Жебрунова, д. 6, стр. 1, офис 224' ],
		'ingi_telegram'   => [ 'label' => 'Telegram (URL)', 'default' => '' ],
		'ingi_whatsapp'   => [ 'label' => 'WhatsApp (URL)', 'default' => '' ],
		'ingi_copyright'  => [ 'label' => 'Копирайт',       'default' => '© 2023–2026 гг. ООО «ИНЖИГРУПП»' ],
		'ingi_map_lat'    => [ 'label' => 'Широта основного офиса',  'default' => '55.785548' ],
		'ingi_map_lon'    => [ 'label' => 'Долгота основного офиса', 'default' => '49.171925' ],

		// --- НОВЫЕ: города/бейджи офисов ---
		'ingi_office1_city'  => [ 'label' => 'Офис 1 — город', 'default' => 'Казань' ],
		'ingi_office1_badge' => [ 'label' => 'Офис 1 — бейдж', 'default' => 'Основной офис' ],
		'ingi_office2_city'  => [ 'label' => 'Офис 2 — город', 'default' => 'Москва' ],
		'ingi_office2_badge' => [ 'label' => 'Офис 2 — бейдж', 'default' => 'Дополнительный офис' ],

		// --- НОВЫЕ: координаты доп. офиса (Москва) ---
		'ingi_office2_lat'   => [ 'label' => 'Широта доп. офиса',  'default' => '55.784425' ],
		'ingi_office2_lon'   => [ 'label' => 'Долгота доп. офиса', 'default' => '37.681703' ],

		// --- НОВЫЕ: реквизиты ---
		'ingi_legal_name' => [ 'label' => 'Юр. наименование', 'default' => 'ООО «ИНЖИГРУПП»' ],
		'ingi_inn'        => [ 'label' => 'ИНН',              'default' => '1686011615' ],
		'ingi_ogrn'       => [ 'label' => 'ОГРН',             'default' => '1221600041409' ],
		'ingi_okpo'       => [ 'label' => 'ОКПО',             'default' => '71981987' ],
	];

	foreach ( $fields as $key => $cfg ) {
		$sanitize = ( 'ingi_email' === $key ) ? 'sanitize_email' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, [
			'default'           => $cfg['default'],
			'sanitize_callback' => $sanitize,
		] );
		$wp_customize->add_control( $key, [
			'label'   => $cfg['label'],
			'section' => 'ingi_contacts',
			'type'    => 'text',
		] );
	}
} );
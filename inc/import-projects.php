<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Импортёр демо-проектов для оценки.
 * Запуск: в админке открыть
 * https://ingigroup.xyz/wp-admin/?ingigroup_import=demo
 * (только для администратора)
 *
 * Файл можно удалить после импорта.
 */

add_action( 'admin_init', function () {

	if ( ! isset( $_GET['ingigroup_import'] ) || $_GET['ingigroup_import'] !== 'demo' ) {
		return;
	}
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Недостаточно прав.' );
	}

	// Нужны функции для работы с медиа
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	// Гарантируем, что категория есть
	$term = term_exists( 'ustanovka-rsp', 'project_category' );
	if ( ! $term ) {
		$term = wp_insert_term(
			'Установка рельсовых страховочных пакетов',
			'project_category',
			[ 'slug' => 'ustanovka-rsp' ]
		);
	}
	$term_id = is_array( $term ) ? (int) $term['term_id'] : (int) $term;

	$projects = ingigroup_demo_projects();

	$log = [];

	foreach ( $projects as $i => $p ) {

		// Пропускаем, если уже импортирован (по slug)
		$existing = get_page_by_path( $p['slug'], OBJECT, 'project' );
		if ( $existing ) {
			$log[] = sprintf( 'Проект «%s» уже существует (ID %d), пропущен.', $p['title'], $existing->ID );
			continue;
		}

		// Создаём запись
		$post_id = wp_insert_post( [
			'post_type'   => 'project',
			'post_status' => 'publish',
			'post_title'  => $p['title'],
			'post_name'   => $p['slug'],
			'menu_order'  => $i + 1,
		], true );

		if ( is_wp_error( $post_id ) ) {
			$log[] = sprintf( 'Ошибка создания «%s»: %s', $p['title'], $post_id->get_error_message() );
			continue;
		}

		// Привязываем категорию
		wp_set_object_terms( $post_id, [ $term_id ], 'project_category', false );

		// Скачиваем главное изображение
		$main_id = 0;
		if ( ! empty( $p['main_image'] ) ) {
			$main_id = ingigroup_sideload( $p['main_image'], $post_id, $p['title'] . ' — главное' );
			if ( $main_id && ! is_wp_error( $main_id ) ) {
				set_post_thumbnail( $post_id, $main_id );
			} else {
				$log[] = sprintf( 'Не удалось скачать главное фото для «%s»', $p['title'] );
			}
		}

		// Скачиваем галерею
		$gallery_ids = [];
		foreach ( $p['gallery'] as $k => $url ) {
			$att_id = ingigroup_sideload( $url, $post_id, sprintf( '%s — фото %d', $p['title'], $k + 1 ) );
			if ( $att_id && ! is_wp_error( $att_id ) ) {
				$gallery_ids[] = (int) $att_id;
			}
		}

		// Записываем метаполя
		update_post_meta( $post_id, '_project_region',     $p['region'] );
		update_post_meta( $post_id, '_project_customer',   $p['customer'] );
		update_post_meta( $post_id, '_project_works',      implode( "\n", $p['works'] ) );
		update_post_meta( $post_id, '_project_additional', implode( "\n", $p['additional'] ) );
		update_post_meta( $post_id, '_project_gallery',    implode( ',', $gallery_ids ) );

		// Если был объект — сохраняем как контент
		if ( ! empty( $p['object'] ) ) {
			wp_update_post( [
				'ID'           => $post_id,
				'post_content' => 'Объект: ' . $p['object'],
			] );
		}

		$log[] = sprintf(
			'✅ «%s» — ID %d, изображений: %d',
			$p['title'],
			$post_id,
			count( $gallery_ids ) + ( $main_id ? 1 : 0 )
		);
	}

	// Вывод отчёта
	wp_die(
		'<h1>Импорт завершён</h1><pre>' . esc_html( implode( "\n", $log ) ) . '</pre>'
		. '<p><a href="' . esc_url( admin_url( 'edit.php?post_type=project' ) ) . '">→ Перейти к списку проектов</a></p>'
		. '<p><a href="' . esc_url( home_url( '/projects/ustanovka-rsp/' ) ) . '">→ Открыть подраздел «Установка РСП»</a></p>',
		'Импорт демо-проектов',
		[ 'response' => 200 ]
	);
} );

/**
 * Обёртка над media_sideload_image, возвращает ID или WP_Error.
 */
function ingigroup_sideload( $url, $post_id, $desc ) {
	if ( ! filter_var( $url, FILTER_VALIDATE_URL ) ) {
		return new WP_Error( 'bad_url', 'Некорректный URL: ' . $url );
	}
	$id = media_sideload_image( $url, $post_id, $desc, 'id' );
	return $id;
}

/**
 * Три демо-проекта, извлечённые из HTML донора вручную.
 */
function ingigroup_demo_projects() {
	return [

		// ------- Проект 01 -------
		[
			'slug'     => 'ustanovka-1-komplekta-l-12-5-nizhegorodskaya',
			'title'    => 'Установка 1 (одного) комплекта рельсового страховочного пакета длиной L=12,5 метров',
			'region'   => 'Нижегородская область',
			'customer' => 'ООО «Нижкомлексстрой»',
			'object'   => '«Строительство водовода d315 мм от водовода D 500 мм в к. п. Зеленый город до водопровода 2 D 225 мм в районе НПЭК»',
			'works'    => [
				'Доставка 1 (одного) комплекта РСП к месту производства работ',
				'Установка 1 (одного) комплекта РСП',
				'Обслуживание/содержание РСП в период эксплуатации',
				'Демонтаж 1 (одного) комплекта РСП',
			],
			'additional' => [],
			'main_image' => 'https://img1.creatium.ru/disk2/27/20/d4/35db086fee3b97284089883474f90e4195/1_glavnoe_foto.jpg',
			'gallery'    => [
				'https://img1.creatium.ru/disk2/f4/09/a5/33cbe555b8838f024ce1d5b61ba45c7dbe/2_foto.jpg',
				'https://img1.creatium.ru/disk2/62/9e/79/e813c096b6b495b0f2cd7123822642a743/3_foto.jpg',
				'https://img1.creatium.ru/disk2/0e/ed/0e/69c29b52c39fec7b128476c353aa0b09b5/4_foto.jpg',
				'https://img1.creatium.ru/disk2/b9/f5/bb/624bcb2b186c03ee8e033559f1d8c3baa2/5_foto.jpg',
			],
		],

		// ------- Проект 02 -------
		[
			'slug'     => 'ustanovka-3-komplektov-l-12-5-moskva-dtm',
			'title'    => 'Установка 3 (трех) комплектов рельсовых страховочных пакетов длиной L=12,5 метров',
			'region'   => 'г. Москва',
			'customer' => 'ООО «ДТМ-СЕКЬЮРИТИ»',
			'object'   => '«ст. Ховрино – ст. Москва-Товарная»',
			'works'    => [
				'Доставка 3 (трех) комплектов РСП к месту производства работ',
				'Установка 3 (трех) комплектов РСП',
				'Обслуживание/содержание РСП в период эксплуатации',
				'Демонтаж 3 (трех) комплектов РСП',
			],
			'additional' => [],
			'main_image' => 'https://img1.creatium.ru/disk2/45/8e/cb/46c96caa5bfc899510cb75de29eebaccaa/1_glavnoe_foto.jpg',
			'gallery'    => [
				'https://img1.creatium.ru/disk2/e2/88/bf/d36cd4e1fe00006f1b5e5bde0aa501b63b/2_foto.jpg',
				'https://img1.creatium.ru/disk2/b2/5f/2c/ea24ccba778d38ee8f5d28b541f94ad775/3_foto.jpg',
				'https://img1.creatium.ru/disk2/cc/65/d5/3f0efcfca96d59db7735dd1685e7bc4dfe/4.jpg',
				'https://img1.creatium.ru/disk2/e6/07/d0/4cfadceae8bb96728acdf9572b0932f659/5.jpg',
			],
		],

		// ------- Проект 03 -------
		[
			'slug'     => 'ustanovka-1-komplekta-l-25-kaluzhskaya-gazprom',
			'title'    => 'Установка 1 (одного) комплекта рельсового страховочного пакета длиной L=25 метров',
			'region'   => 'Калужская область',
			'customer' => 'АО «ГАЗПРОМ ГАЗОРАСПРЕДЕЛЕНИЕ КАЛУГА»',
			'object'   => '«Газопровод межпоселковый к дер. Малые Зимницы Кировского района — дер. Рассвет — дер. Ряполово Думиничского района Калужской области»',
			'works'    => [
				'Разработка и согласование со структурными подразделениями ОАО «РЖД» проекта производства работ с последующим получением комплекта разрешительной документации (акт-допуск, наряд-допуск)',
				'Заключение договоров на технический надзор со структурными подразделениями ОАО «РЖД», получение технологических «окон» в ОАО «РЖД» на производство работ',
				'Доставка 1 (одного) комплекта РСП к месту производства работ',
				'Установка 1 (одного) комплекта РСП',
				'Обслуживание/содержание РСП в период эксплуатации',
				'Демонтаж 1 (одного) комплекта РСП',
			],
			'additional' => [
				'Разработка и согласование проекта производства работ на буровые и общестроительные работы с получением акта-допуска от ОАО «РЖД» на объект: «Газопровод межпоселковый к дер. Малые Зимницы Кировского района — дер. Рассвет — дер. Ряполово Думиничского района Калужской области»',
			],
			'main_image' => 'https://img1.creatium.ru/disk2/97/1a/ef/16489db71a234bb36789fe847e228b71db/1.jpg',
			'gallery'    => [
				'https://img1.creatium.ru/disk2/2c/63/6d/1ccadba4144cf28bec12579c123c165d27/2.jpg',
				'https://img1.creatium.ru/disk2/06/de/fe/d6770bb6da75d99e19b5acab5ad17a8634/3.jpg',
				'https://img1.creatium.ru/disk2/6f/de/f5/245f9681fbc9220ee297aedffa8ff6cc4c/4.jpg',
			],
		],

	];
}
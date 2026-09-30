<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_ajax_ingi_send',        'ingi_handle_form' );
add_action( 'wp_ajax_nopriv_ingi_send', 'ingi_handle_form' );

function ingi_handle_form() {
    check_ajax_referer( 'ingi_form', 'nonce' );

    $inn   = sanitize_text_field( $_POST['inn']   ?? '' );
    $name  = sanitize_text_field( $_POST['name']  ?? '' );
    $phone = sanitize_text_field( $_POST['phone'] ?? '' );
    $agree = ! empty( $_POST['agree'] );

    if ( ! $phone || ! $agree ) {
        wp_send_json_error( [ 'message' => 'Заполните телефон и подтвердите согласие.' ] );
    }

    $to      = get_theme_mod( 'ingi_email', 'info@ingigroup.ru' );
    $subject = 'Заявка с сайта ingigroup.ru';
    $body    = "ИНН: {$inn}\nИмя: {$name}\nТелефон: {$phone}";
    $headers = [ 'Content-Type: text/plain; charset=UTF-8' ];

    $sent = wp_mail( $to, $subject, $body, $headers );

    $sent
        ? wp_send_json_success( [ 'message' => 'Спасибо! Мы свяжемся с вами.' ] )
        : wp_send_json_error(   [ 'message' => 'Ошибка отправки. Позвоните нам.' ] );
}
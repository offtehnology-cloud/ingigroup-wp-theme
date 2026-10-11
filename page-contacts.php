<?php
/**
 * Template Name: Контакты
 * Шаблон страницы «Контакты» — /contacts
 *
 * @package IngiGroup
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

/* =========================================================
   ДАННЫЕ ИЗ CUSTOMIZER
   ========================================================= */
$phone      = get_theme_mod( 'ingi_phone',      '+7 (917) 909-99-96' );
$email      = get_theme_mod( 'ingi_email',      'info@ingigroup.ru' );
$legal_name = get_theme_mod( 'ingi_legal_name', 'ООО «ИНЖИГРУПП»' );
$inn        = get_theme_mod( 'ingi_inn',        '1686011615' );
$ogrn       = get_theme_mod( 'ingi_ogrn',       '1221600041409' );
$okpo       = get_theme_mod( 'ingi_okpo',       '71981987' );

$offices = array(
    array(
        'badge'   => get_theme_mod( 'ingi_office1_badge', 'Основной офис' ),
        'city'    => get_theme_mod( 'ingi_office1_city',  'Казань' ),
        'address' => get_theme_mod( 'ingi_addr_main',     'Республика Татарстан, г. Казань, ул. Гвардейская, д. 33, офис 210' ),
        'lat'     => get_theme_mod( 'ingi_map_lat',       '55.785548' ),
        'lon'     => get_theme_mod( 'ingi_map_lon',       '49.171925' ),
    ),
    array(
        'badge'   => get_theme_mod( 'ingi_office2_badge', 'Дополнительный офис' ),
        'city'    => get_theme_mod( 'ingi_office2_city',  'Москва' ),
        'address' => get_theme_mod( 'ingi_addr_extra',    'г. Москва, ул. Жебрунова, д. 6, стр. 1, офис 224' ),
        'lat'     => get_theme_mod( 'ingi_office2_lat',   '55.784425' ),
        'lon'     => get_theme_mod( 'ingi_office2_lon',   '37.681703' ),
    ),
);

$tel_href = 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );
?>

<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

<main class="contacts-archive">
    <div class="container">

        <h1 class="page-title"><?php the_title(); ?></h1>

        <?php // ----- Общие контакты ----- ?>
        <div class="contacts-general">
            <div class="contacts-general__item">
                <span class="contacts-general__label">Телефон</span>
                <a class="contacts-general__value contacts-general__value--phone" href="<?php echo esc_attr( $tel_href ); ?>">
                    <?php echo esc_html( $phone ); ?>
                </a>
            </div>
            <div class="contacts-general__item">
                <span class="contacts-general__label">E-mail</span>
                <a class="contacts-general__value" href="mailto:<?php echo esc_attr( $email ); ?>">
                    <?php echo esc_html( $email ); ?>
                </a>
            </div>
        </div>

        <?php // ----- Офисы + карты ----- ?>
        <div class="contacts-offices">
            <?php foreach ( $offices as $office ) :
                $lat = trim( (string) $office['lat'] );
                $lon = trim( (string) $office['lon'] );
                $has_map = ( '' !== $lat && '' !== $lon );

                $map_url      = '';
                $external_url = '';
                if ( $has_map ) {
                    // Яндекс: порядок lon,lat
                    $map_url      = 'https://yandex.ru/map-widget/v1/?ll=' . rawurlencode( $lon . ',' . $lat )
                                  . '&z=17&l=map&pt=' . rawurlencode( $lon . ',' . $lat );
                    $external_url = 'https://yandex.ru/maps/?pt=' . rawurlencode( $lon . ',' . $lat ) . '&z=17&l=map';
                }
            ?>
                <div class="contact-office">
                    <div class="contact-office__head">
                        <span class="contact-office__badge"><?php echo esc_html( $office['badge'] ); ?></span>
                        <h2 class="contact-office__city"><?php echo esc_html( $office['city'] ); ?></h2>
                    </div>

                    <div class="contact-office__address">
                        <?php echo esc_html( $office['address'] ); ?>
                    </div>

                    <?php if ( $has_map ) : ?>
                        <a class="contact-office__link"
                           href="<?php echo esc_url( $external_url ); ?>"
                           target="_blank" rel="noopener">
                            Открыть в Яндекс.Картах →
                        </a>

                        <div class="contact-office__map">
                            <iframe
                                src="<?php echo esc_url( $map_url ); ?>"
                                loading="lazy"
                                allowfullscreen
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Карта: <?php echo esc_attr( $office['city'] ); ?>">
                            </iframe>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php // ----- Реквизиты ----- ?>
        <div class="contacts-requisites">
            <h2 class="contacts-requisites__title">Реквизиты</h2>
            <dl class="contacts-requisites__list">
                <div class="contacts-requisites__row">
                    <dt>Наименование</dt>
                    <dd><?php echo esc_html( $legal_name ); ?></dd>
                </div>
                <div class="contacts-requisites__row">
                    <dt>ИНН</dt>
                    <dd><?php echo esc_html( $inn ); ?></dd>
                </div>
                <div class="contacts-requisites__row">
                    <dt>ОГРН</dt>
                    <dd><?php echo esc_html( $ogrn ); ?></dd>
                </div>
                <div class="contacts-requisites__row">
                    <dt>ОКПО</dt>
                    <dd><?php echo esc_html( $okpo ); ?></dd>
                </div>
            </dl>
        </div>

    </div>

    <?php get_template_part( 'template-parts/cta-form' ); ?>
</main>

<?php get_footer();
<?php
/**
 * Template Name: Услуга — Вырубка древесно-кустарниковой растительности
 *
 * @package IngiGroup
 */

get_header();
$theme_uri = get_template_directory_uri();
$post_id   = get_the_ID();
?>

<!-- ============================================================
     HERO
     ============================================================ -->
<section class="service-hero felling-hero">
    <div class="service-hero__bg" style="background-image:url('<?php echo esc_url( $theme_uri ); ?>/assets/images/felling-hero.jpg');"></div>
    <div class="service-hero__inner container">
        <div class="service-hero__content">
            <h1 class="service-hero__title">Вырубка древесно-кустарниковой растительности</h1>
            <p class="service-hero__sub">на объектах инфраструктуры ОАО «РЖД»</p>
            <button type="button" class="service-hero__btn js-open-callback">Оставить заявку</button>
        </div>
    </div>
</section>

<!-- ============================================================
     ХЛЕБНЫЕ КРОШКИ (ниже hero)
     ============================================================ -->
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

<!-- ============================================================
     H2 + INTRO (фото слева + текст справа)
     ============================================================ -->
<section class="felling-page">
    <div class="container">

        <h2 class="felling-page__h2">Вырубка древесно-кустарниковой растительности на объектах инфраструктуры ОАО «РЖД»</h2>

        <div class="felling-intro">
            <div class="felling-intro__grid">
                <div class="felling-intro__img">
                    <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/felling-intro.jpg" alt="">
                </div>
                <div class="felling-intro__text">
                    <p><strong>ООО «ИНЖИГРУПП»</strong> с 2022 года осуществляет свою производственную деятельность по вырубке древесно-кустарниковой растительности, валке опасных деревьев, угрожающих своим падением на путь на объектах инфраструктуры <strong>ОАО «РЖД»</strong>, а также в охранных зонах воздушных линий электропередач на объектах структурных подразделений Трансэнерго – филиала <strong>ОАО «РЖД»</strong>.</p>
                    <p>Мы гарантируем высокое качество работы, а также соблюдение всех необходимых норм, правил, а также нормативных документов ОАО «РЖД».</p>
                </div>
            </div>
        </div>

        <!-- ============================================================
             СПОЙЛЕР: нормативные документы
             ============================================================ -->
        <details class="felling-spoiler" open>
            <summary class="felling-spoiler__summary">
                <span class="felling-spoiler__title">Список нормативных документов ОАО «РЖД».</span>
            </summary>
            <div class="felling-spoiler__body">
                <p>1. Распоряжение ОАО «РЖД» от 14 декабря 2016 г. № 2540р «Инструкция по обеспечению безопасности движения поездов при производстве путевых работ»</p>
                <p>2. Приказ Министерства транспорта РФ от 23 июня 2022 г. № 250 «Об утверждении Правил технической эксплуатации железных дорог Российской Федерации».</p>
                <p>3. Распоряжение ОАО «РЖД» от 17 декабря 2021 г. № 2888/р «Об утверждении правил назначения ремонтов железнодорожного пути»</p>
                <p>4. Постановление Правительства Российской Федерации от 24 февраля 2009 г. № 160 «О порядке установления охранных зон объектов электросетевого хозяйства и особых условий использования земельных участков, расположенных в границах таких зон».</p>
                <p>5. Федеральный закон от 10 января 2003 г. № 17-ФЗ «О железнодорожном транспорте в Российской Федерации».</p>
                <p>6. Федеральный закон от 21 декабря 1994 г. № 69-ФЗ «О пожарной безопасности».</p>
                <p>7. Распоряжение ОАО «РЖД» от 29 ноября 2019 г. № 2675р «Об утверждении Положения об организации комплексного обслуживания объектов инфраструктуры хозяйства пути и сооружений».</p>
                <p>8. Распоряжение ОАО «РЖД» от 17 августа 2009 г. № 1722р «Положение о взаимодействии между ОАО «РЖД» и подрядными организациями в сфере охраны труда».</p>
                <p>9. Распоряжение ОАО «РЖД» от 3 декабря 2015 г. № 2828р «Регламент взаимодействия ОАО «РЖД» с подрядными организациями при организации и выполнении работ (услуг) в области защитного лесоразведения, содержания земельных участков полосы отвода и охранных зон, борьбы с нежелательной растительностью на эксплуатационных объектах инфраструктуры».</p>
                <p>10. Распоряжение ОАО «РЖД» от 22 марта 2019 г. № 539р «Инструкция по текущему содержанию земельных участков полосы отвода и охранных зон, защитных лесонасаждений, озеленения и благоустройства, борьбы с нежелательной растительностью».</p>
                <p>11. Федеральный закон от 21 июля 1997 г. № 116-ФЗ «О промышленной безопасности опасных производственных объектов».</p>
                <p>12. Распоряжение ОАО «РЖД» № 2697р от 21 декабря 2017 г. «Об утверждении Норм времени на работы по содержанию защитных лесонасаждений и благоустройству полосы отвода на железнодорожном транспорте».</p>
                <p>13. Федеральный закон Российской Федерации «О транспортной безопасности» от 9 февраля 2007 г. № 16-ФЗ.</p>
                <p>14. ГОСТ 12.4.281-2021 «Система стандартов безопасности труда. Одежда специальная повышенной видимости. Технические требования и методы испытаний».</p>
                <p>15. Правила по безопасному нахождению работников ОАО «РЖД» на железнодорожных путях, утвержденные распоряжением ОАО «РЖД» от 24.12.2012 № 2665 р.</p>
                <p>16. Распоряжение ОАО «РЖД» № 1091р от 5 мая 2014 г. «Об единичных стоимостях работ/услуг в области защитного лесоразведения, содержания земельных участков полосы отвода и охранных зон, озеленения и благоустройства, борьбы с нежелательной растительностью на эксплуатационных объектах инфраструктуры ОАО «РЖД».</p>
            </div>
        </details>

        <!-- ============================================================
             ТЕКСТ + ОБЪЁМЫ РАБОТ + КНОПКА
             ============================================================ -->
        <p class="felling-text">Несмотря на относительно не большой период производства работ компания имеет на своем счету более 7 реализованных договоров на объектах ОАО «РЖД».</p>
        <p class="felling-text felling-text--lead">Нарастающим итогом нами выполнены следующие объемы работ:</p>

        <div class="felling-volumes">
            <div class="felling-volumes__grid">
                <div class="felling-volumes__text">
                    <p>- <strong>Валка деревьев</strong> диаметром от 11 см до 32 см и свыше 32 см – 10 774 шт.</p>
                    <p>- <strong>Сплошная вырубка древесно-кустарниковой растительности</strong> и поросли их возобновления – 315,94 га;</p>
                    <p>- <strong>Уборка полосы отвода и лесокультурной площади методом измельчения (утилизация)</strong>: от древесно-кустарниковой растительности (кустарника и мелколесья) – 257,45 га.</p>
                </div>
                <div class="felling-volumes__btn-wrap">
                    <a href="<?php echo esc_url( home_url( '/projects#13' ) ); ?>" class="felling-btn felling-btn--outline">Реализованные проекты</a>
                </div>
            </div>
        </div>

        <p class="felling-text">В своем распоряжении имеем штат квалифицированного и рабочего персонала, прошедшего обучение по профессии, <em>Лесоруб</em>, <em>Вальщик леса</em>, <em>Рабочий зеленого хозяйства</em> в образовательных центрах профессиональной подготовки.</p>

    </div>
</section>

<!-- ============================================================
     ПРЕИМУЩЕСТВА
     ============================================================ -->
<section class="felling-advantages">
    <div class="container">
        <h2 class="felling-advantages__h2">Преимущества</h2>

        <div class="felling-advantages__grid">

            <div class="felling-advantages__item">
                <div class="felling-advantages__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h9"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <circle cx="17" cy="17" r="3"/>
                        <path d="M17 14v-2a2 2 0 0 1 2-2"/>
                    </svg>
                </div>
                <p class="felling-advantages__title">Профессиональный кадровый состав</p>
            </div>

            <div class="felling-advantages__item">
                <div class="felling-advantages__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 17V7h11l3 5h3v5h-2"/>
                        <circle cx="6.5" cy="17.5" r="2"/>
                        <circle cx="17" cy="17.5" r="2"/>
                        <line x1="9" y1="17.5" x2="15" y2="17.5"/>
                    </svg>
                </div>
                <p class="felling-advantages__title">Современная техника для производства комплекса работ</p>
            </div>

            <div class="felling-advantages__item">
                <div class="felling-advantages__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"/>
                        <circle cx="19" cy="4" r="1.5"/>
                        <circle cx="4" cy="4" r="1.5"/>
                        <circle cx="20" cy="18" r="1.5"/>
                        <line x1="10" y1="10" x2="18" y2="5"/>
                        <line x1="5" y1="5" x2="10" y2="10"/>
                    </svg>
                </div>
                <p class="felling-advantages__title">Технологии, отвечающие требованиям производства и экологии</p>
            </div>

            <div class="felling-advantages__item">
                <div class="felling-advantages__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="2 12 8 6 8 9 11 9 11 15 8 15 8 18"/>
                        <polygon points="22 12 16 6 16 9 13 9 13 15 16 15 16 18"/>
                    </svg>
                </div>
                <p class="felling-advantages__title">Мобильность и универсальность</p>
            </div>

            <div class="felling-advantages__item">
                <div class="felling-advantages__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l8 3v6c0 5-3.5 9-8 11-4.5-2-8-6-8-11V5z"/>
                    </svg>
                </div>
                <p class="felling-advantages__title">Постоянный контроль качества выполняемых работ и услуг</p>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     ВИДЫ УСЛУГ
     ============================================================ -->
<section class="felling-services">
    <div class="container">
        <h2 class="felling-services__h2">Виды услуг</h2>

        <div class="felling-services__grid">
            <div class="felling-services__img">
                <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/felling-services.jpg" alt="">
            </div>
            <div class="felling-services__text">
                <ul class="felling-services__list">
                    <li>Валка опасных деревьев в полосе отвода, в охранных зонах воздушных линий электропередач ОАО «РЖД»;</li>
                    <li>Сплошная вырубка древесно-кустарниковой растительности;</li>
                    <li>Утилизация порубочных остатков;</li>
                    <li>Кронирование деревьев;</li>
                    <li>Химическая обработка гербицидами железнодорожных путей, земельных участков технической полосы отвода и охранных зон, площадей под защитными лесонасаждениями.</li>
                    <li>Противопожарная опашка защитных лесонасаждений;</li>
                    <li>Посадка деревьев и кустарника;</li>
                    <li>Благоустройство и озеленение городов и поселений;</li>
                </ul>
            </div>
        </div>

        <div class="felling-services__cta">
            <p class="felling-services__cta-text"><strong>ООО «ИНЖИГРУПП»</strong> вносит свой вклад в обеспечение безопасности и бесперебойности перевозочного процесса на железных дорогах России, а также противопожарной безопасности объектов инфраструктуры <strong>ОАО «РЖД»</strong>.</p>
            <div class="felling-services__cta-btn-wrap">
                <button type="button" class="felling-btn felling-btn--outline js-open-callback">Заказать услуги по вырубке</button>
            </div>
        </div>

        <!-- ============================================================
             ГАЛЕРЕЯ
             1) приоритет — метабокс «Галерея изображений» (как у /production)
             2) фолбэк — файлы assets/images/felling-gallery-N.jpg
             ============================================================ -->
        <?php
        // --- 1) Пытаемся взять из метабокса ---
        // ВАЖНО: имя ключа замени на то, что реально пишет твой метабокс.
        // По умолчанию в inc/meta-boxes-production-gallery.php — '_ingi_gallery'.
        $gallery_meta = get_post_meta( $post_id, '_ingi_gallery', true );

        $gallery_urls = []; // массив ['full' => ..., 'thumb' => ...]

        if ( ! empty( $gallery_meta ) && is_array( $gallery_meta ) ) {
            foreach ( $gallery_meta as $item ) {
                // Метабокс может хранить либо ID вложения, либо URL — поддержим оба.
                if ( is_numeric( $item ) ) {
                    $full  = wp_get_attachment_image_url( (int) $item, 'full' );
                    $thumb = wp_get_attachment_image_url( (int) $item, 'large' );
                } else {
                    $full  = $item;
                    $thumb = $item;
                }
                if ( $full ) {
                    $gallery_urls[] = [ 'full' => $full, 'thumb' => $thumb ?: $full ];
                }
            }
        }

        // --- 2) Если метабокс пуст — файловый фолбэк ---
        if ( empty( $gallery_urls ) ) {
            $files = [
                'felling-gallery-1.jpg',
                'felling-gallery-2.jpg',
                'felling-gallery-3.jpg',
                'felling-gallery-4.jpg',
                'felling-gallery-5.jpg',
                'felling-gallery-6.jpg',
                'felling-gallery-7.jpg',
                'felling-gallery-8.jpg',
            ];
            foreach ( $files as $file ) {
                if ( file_exists( get_template_directory() . '/assets/images/' . $file ) ) {
                    $url            = $theme_uri . '/assets/images/' . $file;
                    $gallery_urls[] = [ 'full' => $url, 'thumb' => $url ];
                }
            }
        }
        ?>

        <?php if ( ! empty( $gallery_urls ) ) : ?>
            <div class="felling-gallery__grid">
                <?php foreach ( $gallery_urls as $img ) : ?>
                    <a href="<?php echo esc_url( $img['full'] ); ?>" class="felling-gallery__item" target="_blank" rel="noopener">
                        <img src="<?php echo esc_url( $img['thumb'] ); ?>" alt="" loading="lazy">
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- ============================================================
     CTA-ФОРМА
     ============================================================ -->
<?php get_template_part( 'template-parts/cta-form' ); ?>

<!-- ============================================================
     КАРТА
     ============================================================ -->
<?php
if ( locate_template( 'template-parts/map.php' ) ) {
    get_template_part( 'template-parts/map' );
}
?>

<?php get_footer(); ?>
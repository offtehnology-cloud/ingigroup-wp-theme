<?php
/**
 * Template Name: Услуга — Изготовление РСП (подсказка; в админке выбирать Default template)
 * Страница услуги: /production
 */
get_header();
?>

<!-- HERO — переиспользуем .service-hero, отличается только фон и подзаголовок -->
<section class="service-hero" style="background-image:url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-hero.jpg' ); ?>');">
    <div class="service-hero__bg"></div>
    <div class="container service-hero__inner">
        <div class="service-hero__content">
            <h1 class="service-hero__title">Страховочные рельсовые пакеты</h1>
            <p class="service-hero__sub">Изготовление и продажа рельсовых страховочных пакетов</p>
            <button type="button" class="service-hero__btn js-open-callback">Оставить заявку</button>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

<!-- CONTENT -->
<section class="production-page">
    <div class="container">

        <h2 class="production-page__h2">Изготовление и продажа рельсовых страховочных пакетов</h2>
        <p class="production-page__lead">Страховочные пакеты для монтажа и эксплуатации систем безопасности на рельсовом пути и инженерных сооружениях</p>

        <div class="production-page__two-images">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-1.jpg' ); ?>" alt="">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-2.jpg' ); ?>" alt="">
        </div>

        <p class="production-page__text">Страховочные рельсовые пакеты применяются на объектах для движения подвижного состава, тем самым являются необходимыми элементами безопасности при проведении работ по монтажу и обслуживанию контактных сетей, мостовых сооружений, тоннелей и т.д. Страховочные рельсовые пакеты обеспечивают безопасность работающего персонала при выполнении работ на высоте. Конструкция страховочного рельсового пакета позволяет в короткий срок приступить к решению поставленных задач. Страховочный рельсовый пакет изготавливается из чёрного металла и покрывается горячим цинком, что позволяет исключить коррозию и значительно продлить срок службы.</p>

        <h2 class="production-page__h2 production-page__h2--mt">Комплектность страховочного рельсового пакета</h2>
        <p class="production-page__text">Комплектность страховочного рельсового пакета при монтаже и эксплуатации в ООО «ИНЖИГРУПП» изготовляется под учёт шпальной решётки. Общая длина страховочного рельсового пакета рассчитывается на основании опоры шпал от 1840 мм до 2200 мм на 6 м длине прямых и разных участках пути и составляет:</p>

        <div class="production-specs">

            <!-- 1 -->
            <div class="production-specs__item">
                <div class="production-specs__body">
                    <h3 class="production-specs__num">1. Плашка ПБ</h3>
                    <p class="production-specs__desc">состоит из:</p>
                    <ul class="production-specs__list">
                        <li>балки №14;</li>
                        <li>гайки М24 – 8 шт.;</li>
                        <li>шайбы плоской – 8 шт.;</li>
                        <li>пружинной шайбы М24 – 8 шт.;</li>
                        <li>болта М24×70 с двумя плоскими шайбами М24 и гайки М24.</li>
                    </ul>
                    <p class="production-specs__desc">Количество плашек ПБ на страховочной рельсовый пакет длиной 12,5 метров — <b>84 шт.</b> Длина 12 метров = 84 шт.</p>
                    <p class="production-specs__desc">На покрытие устанавливается в пределах 1 потолочной балки.</p>
                </div>
                <div class="production-specs__imgs">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-spec-1.jpg' ); ?>" alt="">
                </div>
            </div>

            <!-- 2 -->
            <div class="production-specs__item">
                <div class="production-specs__body">
                    <h3 class="production-specs__num">2. Комплект хомутов на страховочный рельсовый пакет длиной 12,5 м – 46 шт.</h3>
                    <p class="production-specs__desc">Комплект X — хомут размеров типа КВБ, либо размеров типа Р50 служит для крепления рельс к страховочному рельсовому пакету.</p>
                    <p class="production-specs__mark">Количество хомутов на страховочной рельсовый пакет длиной 12,5 метров — 84 шт.</p>
                </div>
                <div class="production-specs__imgs">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-spec-2a.jpg' ); ?>" alt="">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-spec-2b.jpg' ); ?>" alt="">
                </div>
            </div>

            <!-- 3 -->
            <div class="production-specs__item">
                <div class="production-specs__body">
                    <h3 class="production-specs__num">3. Болт М24×180 в комплекте с двусторонней шайбой М25, упорной пластиной и т-образным болтом Т-30 длиной 30 мм, для крепления шайбы к подкладке.</h3>
                    <p class="production-specs__mark">Количество болтов и гаек с шайбами, упорные пластины и гайками на страховочной рельсовый пакет длиной 12,5 метров — 168 шт.</p>
                </div>
                <div class="production-specs__imgs">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-spec-3a.jpg' ); ?>" alt="">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-spec-3b.jpg' ); ?>" alt="">
                </div>
            </div>

            <!-- 4 -->
            <div class="production-specs__item">
                <div class="production-specs__body">
                    <h3 class="production-specs__num">4. Конечный болт в комплекте с двусторонней шайбой М25, упорной пластиной и гайкой М24, для крепления консольной ПБ к существующей путевому рельсу.</h3>
                </div>
                <div class="production-specs__imgs">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-spec-4a.jpg' ); ?>" alt="">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-spec-4b.jpg' ); ?>" alt="">
                </div>
            </div>

            <!-- 5 -->
            <div class="production-specs__item">
                <div class="production-specs__body">
                    <h3 class="production-specs__num">5. Отбойный брус — устанавливается под конец рельса страховочного рельсового пакета и служит для защиты от удара и зацепления подвижного состава.</h3>
                    <p class="production-specs__mark">Количество отбойных брусьев на страховочной рельсовый пакет длиной 12,5 метров — 8 шт.</p>
                </div>
                <div class="production-specs__imgs">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-spec-5.jpg' ); ?>" alt="">
                </div>
            </div>

            <!-- 6 -->
            <div class="production-specs__item">
                <div class="production-specs__body">
                    <h3 class="production-specs__num">6. Подклад улучшенный — надёжный элемент пакета для скрепления, перевозки и монтажа рельса с приложением к элементам для фиксации верхнего строения обводнённых путей.</h3>
                    <p class="production-specs__mark">Количество подкладов, уложенных на страховочной рельсовый пакет длиной 12,5 метров — 84 шт.</p>
                </div>
                <div class="production-specs__imgs">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-spec-6.jpg' ); ?>" alt="">
                </div>
            </div>

            <!-- 7 -->
            <div class="production-specs__item">
                <div class="production-specs__body">
                    <h3 class="production-specs__num">7. Кассета для хомутов — надёжный элемент пакета для скрепления, перевозки и монтажа рельса с приложением к элементам для фиксации верхнего строения обводнённых путей.</h3>
                    <p class="production-specs__mark">Количество кассет для хомутов на страховочной рельсовый пакет длиной 12,5 метров — 7 шт.</p>
                </div>
                <div class="production-specs__imgs">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/production-spec-7.jpg' ); ?>" alt="">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- GALLERY -->
<?php
// 1) Сначала пробуем галерею из метабокса (медиатека)
$ids = get_post_meta( get_the_ID(), '_ingi_gallery', true );
$ids = $ids ? array_filter( array_map( 'intval', explode( ',', $ids ) ) ) : [];

$gallery_items = []; // [ [ 'full' => URL, 'thumb' => URL ], ... ]

if ( $ids ) {
    foreach ( $ids as $id ) {
        $full  = wp_get_attachment_image_url( $id, 'full' );
        $thumb = wp_get_attachment_image_url( $id, 'medium_large' );
        if ( ! $full ) continue;
        $gallery_items[] = [ 'full' => $full, 'thumb' => $thumb ?: $full ];
    }
} else {
    // 2) Фолбэк: файлы из темы — берём только те, что реально существуют на диске
    $dir = get_template_directory() . '/assets/images/production/';
    $uri = get_template_directory_uri() . '/assets/images/production/';
    for ( $i = 1; $i <= 28; $i++ ) {
        $file = $dir . 'gallery-' . $i . '.jpg';
        if ( ! file_exists( $file ) ) continue;
        $gallery_items[] = [
            'full'  => $uri . 'gallery-' . $i . '.jpg',
            'thumb' => $uri . 'gallery-' . $i . '.jpg',
        ];
    }
}

// 3) Если после этого ничего нет — секцию вообще не выводим
if ( $gallery_items ) : ?>
    <section class="production-gallery">
        <div class="container">
            <div class="production-gallery__grid">
                <?php foreach ( $gallery_items as $item ) : ?>
                    <a href="<?php echo esc_url( $item['full'] ); ?>" class="certificate-card">
                        <img src="<?php echo esc_url( $item['thumb'] ); ?>" alt="" loading="lazy">
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_template_part( 'template-parts/cta-form' ); ?>

<?php
if ( locate_template( 'template-parts/map.php' ) ) {
    get_template_part( 'template-parts/map' );
}
?>

<?php get_footer(); ?>
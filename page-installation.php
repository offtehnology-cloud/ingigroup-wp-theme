<?php
/**
 * Template Name: Услуга — Монтаж инженерных сетей
 */
get_header();
$theme_uri = get_template_directory_uri();
?>

<!-- HERO -->
<section class="service-hero installation-hero">
    <div class="service-hero__bg" style="background-image: url('<?php echo esc_url($theme_uri . '/assets/images/service-rsr-hero.jpg'); ?>');"></div>
    <div class="service-hero__inner">
        <div class="service-hero__content">
            <h1 class="service-hero__title">Монтаж и устройство инженерных<br>и кабельных сетей</h1>
            <button type="button" class="service-hero__btn js-open-callback">Оставить заявку</button>
        </div>
    </div>
</section>

<!-- BREADCRUMBS (ниже hero) -->
<?php get_template_part('template-parts/breadcrumbs'); ?>

<!-- INTRO (светлая секция) -->
<section class="installation-intro">
    <div class="container">
        <h2 class="installation-intro__h2">Монтаж и устройство наружных инженерных и кабельных сетей</h2>
        <p class="installation-intro__lead">Наружные инженерные сети — это системы инженерных коммуникаций, которые обеспечивают подачу и распределение различных ресурсов, а также отвод сточных вод и других отходов за пределы зданий. К наружным сетям относятся: водопроводные, канализационные, тепловые, газовые и электрические сети, а также сети связи.</p>
    </div>
</section>

<!-- ABOUT: картинка + список -->
<section class="installation-about">
    <div class="container">
        <div class="installation-about__grid">
            <div class="installation-about__img">
                <img src="<?php echo esc_url($theme_uri . '/assets/images/snimok_ekrana_2025_03_05_142107.png'); ?>" alt="Монтаж инженерных сетей">
            </div>
            <div class="installation-about__content">
                <h3 class="installation-about__h3">Наша компания обеспечит вам:</h3>
                <ul class="installation-about__list">
                    <li>Правильный и технологический монтаж сетей для последующего их безопасного функционирования</li>
                    <li>Сохранение всех имеющихся коммуникаций при прокладке труб и земляных работах</li>
                    <li>Сохранение грунтовых вод и экологических стандартов</li>
                    <li>Соблюдение всех строительных норм и правил</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- WORKS: вложенный список + 2 картинки -->
<section class="installation-works">
    <div class="container">
        <h3 class="installation-works__h3">Мы предлагаем вам строительные услуги по следующим работам:</h3>
        <div class="installation-works__grid">
            <div class="installation-works__text">
                <ul class="installation-works__list">
                    <li>Устройство колодцев, рытье котлованов, траншей</li>
                    <li>Планировка площадок, отголовков, лотков, перемещение грунта</li>
                    <li>Монтаж наружных сетей водоснабжения (монтаж сетей водопровода):
                        <ul>
                            <li>монтаж сетей хозяйственно-питьевого водоснабжения;</li>
                            <li>монтаж противопожарных сетей водоснабжения;</li>
                            <li>производственных сетей водоснабжения;</li>
                            <li>прокладка трубопроводов (стальных, ПНД и др.);</li>
                            <li>промывка и гидравлические испытания сетей водоснабжения;</li>
                        </ul>
                    </li>
                    <li>Монтаж наружных канализационных сетей (монтаж сетей канализации):
                        <ul>
                            <li>монтаж наружных сетей хозяйственно-бытовой канализации;</li>
                            <li>монтаж наружных сетей ливневой (дождевой) канализации;</li>
                            <li>монтаж наружных сетей производственной канализации;</li>
                            <li>монтаж сетей напорной (пригрунтовой) канализации;</li>
                            <li>строительство канализационных колодцев и сливов;</li>
                        </ul>
                    </li>
                    <li>Монтаж кабельных линий СЦБ и связи на объектах инфраструктуры ОАО «РЖД»</li>
                </ul>
            </div>
            <div class="installation-works__imgs">
                <img src="<?php echo esc_url($theme_uri . '/assets/images/snimok_ekrana_2025_03_05_142426.png'); ?>" alt="Монтаж наружных сетей">
                <img src="<?php echo esc_url($theme_uri . '/assets/images/snimok_ekrana_2025_03_05_142632.png'); ?>" alt="Монтаж наружных сетей">
            </div>
        </div>
    </div>
</section>

<!-- STEPS -->
<section class="installation-steps">
    <div class="container">
        <h3 class="installation-steps__h3">Монтаж наружных сетей осуществляется в несколько этапов:</h3>
        <ol class="installation-steps__list">
            <li>
                <span class="installation-steps__num">1.</span>
                <div class="installation-steps__body">
                    <div class="installation-steps__title">Подготовительные работы:</div>
                    <div class="installation-steps__desc">Разметка трассы сетей, подготовка строительной площадки, земляные работы (рытье траншей и котлованов).</div>
                </div>
            </li>
            <li>
                <span class="installation-steps__num">2.</span>
                <div class="installation-steps__body">
                    <div class="installation-steps__title">Укладка трубопроводов и кабелей:</div>
                    <div class="installation-steps__desc">Прокладка трубопроводов для водоснабжения, канализации, тепловых и газовых сетей, а также укладка кабелей для электрических и телекоммуникационных сетей.</div>
                </div>
            </li>
            <li>
                <span class="installation-steps__num">3.</span>
                <div class="installation-steps__body">
                    <div class="installation-steps__title">Установка оборудования:</div>
                    <div class="installation-steps__desc">Монтаж насосных станций, колодцев, камер, тепловых пунктов, газораспределительных пунктов, трансформаторных подстанций и другого оборудования.</div>
                </div>
            </li>
            <li>
                <span class="installation-steps__num">4.</span>
                <div class="installation-steps__body">
                    <div class="installation-steps__title">Сварочные и изоляционные работы:</div>
                    <div class="installation-steps__desc">Сварка стыков трубопроводов, изоляция соединений и участков труб, защита от коррозии и гидроизоляция.</div>
                </div>
            </li>
            <li>
                <span class="installation-steps__num">5.</span>
                <div class="installation-steps__body">
                    <div class="installation-steps__title">Испытания и проверки:</div>
                    <div class="installation-steps__desc">Проведение гидравлических, пневматических и электрических испытаний для проверки герметичности и работоспособности сетей.</div>
                </div>
            </li>
            <li>
                <span class="installation-steps__num">6.</span>
                <div class="installation-steps__body">
                    <div class="installation-steps__title">Засыпка траншей и благоустройство территории:</div>
                    <div class="installation-steps__desc">Обратная засыпка траншей с послойным уплотнением грунта, восстановление дорожных покрытий, озеленение и благоустройство территории.</div>
                </div>
            </li>
            <li>
                <span class="installation-steps__num">7.</span>
                <div class="installation-steps__body">
                    <div class="installation-steps__title">Ввод в эксплуатацию:</div>
                    <div class="installation-steps__desc">Подключение сетей к магистралям и потребителям, проведение пусконаладочных работ, сдача объекта в эксплуатацию и оформление необходимой документации.</div>
                </div>
            </li>
        </ol>
        <div class="installation-steps__btn-wrap">
            <button type="button" class="installation-steps__btn js-open-callback">Заказать</button>
        </div>
    </div>
</section>

<!-- CTA -->
<?php get_template_part('template-parts/cta-form'); ?>

<!-- MAP -->
<?php
if ( locate_template( 'template-parts/map.php' ) ) {
    get_template_part( 'template-parts/map' );
}
?>

<?php get_footer(); ?>
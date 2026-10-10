<?php
get_header();
the_post();

$region     = get_post_meta(get_the_ID(), '_project_region', true);
$customer   = get_post_meta(get_the_ID(), '_project_customer', true);
$works      = get_post_meta(get_the_ID(), '_project_works', true);
$additional = get_post_meta(get_the_ID(), '_project_additional', true);
$gallery    = get_post_meta(get_the_ID(), '_project_gallery', true);

$works_arr   = $works ? array_filter(array_map('trim', explode("\n", $works))) : [];
$add_arr     = $additional ? array_filter(array_map('trim', explode("\n", $additional))) : [];
$gallery_ids = $gallery ? array_filter(array_map('intval', explode(',', $gallery))) : [];

// категория проекта — для кнопки «назад»
$terms = get_the_terms(get_the_ID(), 'project_category');
$back_url = ($terms && !is_wp_error($terms)) ? get_term_link($terms[0]) : get_post_type_archive_link('project');
?>

<main class="project-single">
    <div class="container">
        <?php get_template_part('template-parts/breadcrumbs'); ?>

        <h1 class="project-single__title"><?php the_title(); ?></h1>

        <div class="project-single__meta">
            <?php if ($region): ?>
                <span class="project-single__region">Регион: <?php echo esc_html($region); ?></span>
            <?php endif; ?>
            <?php if ($customer): ?>
                <span class="project-single__customer">ЗАКАЗЧИК: <?php echo esc_html($customer); ?></span>
            <?php endif; ?>
        </div>

        <?php if (has_post_thumbnail()): ?>
            <div class="project-single__hero">
                <?php the_post_thumbnail('full'); ?>
            </div>
        <?php endif; ?>

        <?php if (get_the_content()): ?>
            <div class="project-single__content"><?php the_content(); ?></div>
        <?php endif; ?>

        <?php if ($works_arr): ?>
            <section class="project-single__section">
                <h2>Состав работ</h2>
                <ul>
                    <?php foreach ($works_arr as $w): ?>
                        <li><?php echo esc_html($w); ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if ($add_arr): ?>
            <section class="project-single__section">
                <h2>Дополнительно</h2>
                <ul>
                    <?php foreach ($add_arr as $w): ?>
                        <li><?php echo esc_html($w); ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if ($gallery_ids): ?>
            <section class="project-single__gallery">
                <?php foreach ($gallery_ids as $id): ?>
                    <a href="<?php echo esc_url(wp_get_attachment_url($id)); ?>" data-lightbox="project">
                        <?php echo wp_get_attachment_image($id, 'large'); ?>
                    </a>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <div class="project-single__back">
            <a href="<?php echo esc_url($back_url); ?>" class="btn btn--outline-orange">← Назад к списку</a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
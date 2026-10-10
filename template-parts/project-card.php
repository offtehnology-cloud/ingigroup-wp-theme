<?php
$number     = $args['number'] ?? 0;
$region     = get_post_meta(get_the_ID(), '_project_region', true);
$customer   = get_post_meta(get_the_ID(), '_project_customer', true);
$works      = get_post_meta(get_the_ID(), '_project_works', true);
$additional = get_post_meta(get_the_ID(), '_project_additional', true);
$gallery    = get_post_meta(get_the_ID(), '_project_gallery', true);

$works_arr   = $works ? array_filter(array_map('trim', explode("\n", $works))) : [];
$add_arr     = $additional ? array_filter(array_map('trim', explode("\n", $additional))) : [];
$gallery_ids = $gallery ? array_filter(array_map('intval', explode(',', $gallery))) : [];
?>

<article class="project-card" id="project-<?php echo (int)$number; ?>">

    <div class="project-card__head">
        <span class="project-card__number"><?php echo str_pad($number, 2, '0', STR_PAD_LEFT); ?></span>
        <h2 class="project-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
    </div>

    <?php if ($region): ?>
        <div class="project-card__region">Регион: <?php echo esc_html($region); ?></div>
    <?php endif; ?>

    <?php if ($customer): ?>
        <div class="project-card__customer">
            <span>ЗАКАЗЧИК:</span> <?php echo esc_html($customer); ?>
        </div>
    <?php endif; ?>

    <?php if ($works_arr): ?>
        <div class="project-card__works">
            <strong>Состав работ:</strong>
            <ul>
                <?php foreach ($works_arr as $w): ?>
                    <li><?php echo esc_html($w); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php if ($add_arr): ?>
                <p><strong>Дополнительно:</strong></p>
                <ul>
                    <?php foreach ($add_arr as $w): ?>
                        <li><?php echo esc_html($w); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="project-card__gallery">
        <?php if (has_post_thumbnail()): ?>
            <a href="<?php the_permalink(); ?>" class="project-card__main-img">
                <?php the_post_thumbnail('large'); ?>
            </a>
        <?php endif; ?>

        <?php if ($gallery_ids): ?>
            <div class="project-card__thumbs">
                <?php foreach (array_slice($gallery_ids, 0, 4) as $id): ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php echo wp_get_attachment_image($id, 'medium'); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <a href="<?php the_permalink(); ?>" class="btn btn--outline-orange project-card__more">
        Подробнее о проекте →
    </a>
</article>
<?php
get_header();

$term = get_queried_object();

$q = new WP_Query([
    'post_type'      => 'project',
    'posts_per_page' => -1,
    'orderby'        => ['menu_order' => 'ASC', 'date' => 'ASC'],
    'tax_query'      => [[
        'taxonomy' => 'project_category',
        'field'    => 'term_id',
        'terms'    => $term->term_id,
    ]],
]);

$total = $q->found_posts;
?>

<main class="projects-page">
    <div class="container">
        <?php get_template_part('template-parts/breadcrumbs'); ?>

        <h1 class="projects-page__title"><?php echo esc_html($term->name); ?></h1>
        <p class="projects-page__subtitle">Сданные объекты — <?php echo $total; ?></p>

        <?php if ($q->have_posts()): ?>

            <div class="projects-nav">
                <?php $i = 1; while ($q->have_posts()): $q->the_post(); ?>
                    <a href="#project-<?php echo $i; ?>" class="projects-nav__item" title="<?php the_title_attribute(); ?>">
                        <?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>
                    </a>
                <?php $i++; endwhile; ?>
            </div>

            <div class="projects-list">
                <?php
                $i = 1;
                while ($q->have_posts()): $q->the_post();
                    get_template_part('template-parts/project-card', null, ['number' => $i]);
                    $i++;
                endwhile;
                ?>
            </div>

        <?php else: ?>
            <p class="projects-empty">В этой категории пока нет проектов.</p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</main>

<?php get_footer(); ?>
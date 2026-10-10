<?php get_header(); ?>

<main class="projects-archive">
    <div class="container">
        <?php get_template_part('template-parts/breadcrumbs'); ?>

        <h1 class="projects-archive__title">Реализованные проекты</h1>
        <p class="projects-archive__subtitle">Сданные объекты</p>

        <div class="projects-hub">
            <?php
            $terms = get_terms(['taxonomy' => 'project_category', 'hide_empty' => false]);
            foreach ($terms as $t) :
                $count = (int) $t->count;
                ?>
                <a href="<?php echo esc_url(get_term_link($t)); ?>" class="projects-hub__card">
                    <span class="projects-hub__count"><?php echo $count; ?></span>
                    <h2 class="projects-hub__name"><?php echo esc_html($t->name); ?></h2>
                    <span class="projects-hub__arrow">→</span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
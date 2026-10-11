<?php
get_header();
the_post();

$region     = get_post_meta( get_the_ID(), '_project_region', true );
$customer   = get_post_meta( get_the_ID(), '_project_customer', true );
$works      = get_post_meta( get_the_ID(), '_project_works', true );
$additional = get_post_meta( get_the_ID(), '_project_additional', true );
$gallery    = get_post_meta( get_the_ID(), '_project_gallery', true );

$works_arr   = $works ? array_filter( array_map( 'trim', explode( "\n", $works ) ) ) : [];
$add_arr     = $additional ? array_filter( array_map( 'trim', explode( "\n", $additional ) ) ) : [];
$gallery_ids = $gallery ? array_filter( array_map( 'intval', explode( ',', $gallery ) ) ) : [];

// Объект лежит первой строкой контента в формате "Объект: ..."
$content_raw = trim( get_the_content() );
$object      = '';
if ( preg_match( '/^Объект:\s*(.+)$/us', $content_raw, $m ) ) {
    $object = trim( $m[1] );
}

$terms    = get_the_terms( get_the_ID(), 'project_category' );
$term     = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0] : null;
$back_url = $term ? get_term_link( $term ) : get_post_type_archive_link( 'project' );
$all_url  = get_post_type_archive_link( 'project' );
?>

<main class="project-single">
    <div class="container">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>

        <h1 class="project-single__title"><?php the_title(); ?></h1>
        <div class="project-single__divider"></div>

        <div class="project-single__meta">
            <?php if ( $region ) : ?>
                <span class="project-single__region">Регион: <?php echo esc_html( $region ); ?></span>
            <?php endif; ?>
            <?php if ( $customer ) : ?>
                <span class="project-single__customer">ЗАКАЗЧИК: <?php echo esc_html( $customer ); ?></span>
            <?php endif; ?>
        </div>

        <div class="project-single__hero-grid">

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="project-single__hero">
                    <?php the_post_thumbnail( 'large' ); ?>
                </div>
            <?php endif; ?>

            <div class="project-single__details">

                <?php if ( $object ) : ?>
                    <div class="project-single__object">
                        <span class="project-single__object-label">Объект:</span>
                        <?php echo esc_html( $object ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $works_arr ) : ?>
    <div class="project-single__section">
        <h2>Состав работ</h2>
        <ul>
            <?php foreach ( $works_arr as $w ) :
                if ( str_starts_with( $w, '## ' ) ) : ?>
                    <li class="project-single__works-subhead">
                        <strong><?php echo esc_html( substr( $w, 3 ) ); ?></strong>
                    </li>
                <?php else : ?>
                    <li><?php echo esc_html( $w ); ?></li>
                <?php endif;
            endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

                <?php if ( $add_arr ) : ?>
                    <div class="project-single__section">
                        <h2>Дополнительно</h2>
                        <ul>
                            <?php foreach ( $add_arr as $w ) : ?>
                                <li><?php echo esc_html( $w ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

            </div>
        </div>

        <?php if ( $gallery_ids ) : ?>
            <section class="project-single__gallery">
                <?php foreach ( $gallery_ids as $id ) : ?>
                    <a href="<?php echo esc_url( wp_get_attachment_url( $id ) ); ?>" data-lightbox="project">
                        <?php echo wp_get_attachment_image( $id, 'large' ); ?>
                    </a>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <div class="project-single__back">
            <a href="<?php echo esc_url( $back_url ); ?>" class="btn btn--outline-orange">← Назад к списку</a>
            <?php if ( $term ) : ?>
                <a href="<?php echo esc_url( $all_url ); ?>" class="project-single__all-link">Все проекты →</a>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
<?php
$number    = $args['number'] ?? 0;
$region    = get_post_meta( get_the_ID(), '_project_region', true );
$works     = get_post_meta( get_the_ID(), '_project_works', true );

// Все строки из поля «Состав работ»
$all = $works ? array_filter( array_map( 'trim', explode( "\n", $works ) ) ) : [];

// В карточке подзаголовки (строки, начинающиеся с «## ») не показываем —
// только обычные пункты списка.
$works_arr = array_values( array_filter( $all, function ( $w ) {
    return strpos( $w, '## ' ) !== 0;
} ) );
?>

<article class="project-card" id="project-<?php echo (int) $number; ?>">

    <a href="<?php the_permalink(); ?>" class="project-card__image">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium_large' ); ?>
        <?php else : ?>
            <span class="project-card__no-image">Нет фото</span>
        <?php endif; ?>
    </a>

    <div class="project-card__body">

        <?php if ( $region ) : ?>
            <span class="project-card__region"><?php echo esc_html( $region ); ?></span>
        <?php endif; ?>

        <h3 class="project-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <?php if ( $works_arr ) : ?>
            <ul class="project-card__works">
                <?php
                $shown = array_slice( $works_arr, 0, 3 );
                foreach ( $shown as $w ) :
                    ?>
                    <li><?php echo esc_html( $w ); ?></li>
                <?php endforeach; ?>

                <?php if ( count( $works_arr ) > 3 ) : ?>
                    <li class="project-card__works-more">
                        …и ещё <?php echo count( $works_arr ) - 3; ?>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>

        <a href="<?php the_permalink(); ?>" class="project-card__more">
            Подробнее о проекте
        </a>

    </div>
</article>
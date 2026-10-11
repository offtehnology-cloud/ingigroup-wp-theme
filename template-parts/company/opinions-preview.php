<?php
/**
 * Тизер «Отзывы» — 3 превью + кнопка.
 *
 * @package Ingigroup
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$limit = 3;

$q = new WP_Query( array(
	'post_type'      => 'opinion',
	'posts_per_page' => $limit,
	'no_found_rows'  => true,
) );

if ( ! $q->have_posts() ) return;
?>
<section class="company-section company-opinions-preview">
	<div class="container">
		<h2 class="company-section__title">Отзывы</h2>

		<div class="opinions-list">
			<?php while ( $q->have_posts() ) : $q->the_post(); ?>
				<a class="opinions-list__item"
				   href="<?php the_post_thumbnail_url( 'full' ); ?>"
				   target="_blank" rel="noopener">
					<?php the_post_thumbnail( 'medium', array( 'loading' => 'lazy' ) ); ?>
				</a>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<div class="company-section__more">
			<a class="btn btn--orange" href="<?php echo esc_url( home_url( '/opinions/' ) ); ?>">
				Все отзывы
			</a>
		</div>
	</div>
</section>
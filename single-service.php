<?php
/**
 * Универсальный шаблон услуги (fallback).
 * Для услуг без своего single-service-{slug}.php.
 */
if ( ! defined( 'ABSPATH' ) ) return;
get_header();
?>

<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

<article class="service-page">
	<div class="container">

		<h1 class="page-title"><?php the_title(); ?></h1>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="service-page__thumb">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
		<?php endif; ?>

		<div class="service-page__content">
			<?php the_content(); ?>
		</div>

		<div class="service-page__cta">
			<button type="button" class="btn btn--orange js-open-callback">Оставить заявку</button>
		</div>

	</div>
</article>

<?php get_template_part( 'template-parts/cta-form' ); ?>

<?php if ( locate_template( 'template-parts/map.php' ) ) get_template_part( 'template-parts/map' ); ?>

<?php get_footer(); ?>
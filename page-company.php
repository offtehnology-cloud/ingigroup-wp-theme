<?php
/**
 * Template Name: О компании
 * Description: Страница «О компании» — интро, цифры, тизеры разделов, CTA.
 *
 * @package Ingigroup
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Флаги отображения необязательных секций.
 * Переключайте здесь — шаблон сам решит, что рендерить.
 */
$show_certs    = true;
$show_opinions = true;

get_header();
?>

<main id="primary" class="site-main company-page">

	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<div class="container">

			<header class="page-header">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</header>

			<div class="company-intro">
				<div class="company-intro__text entry-content">
					<?php the_content(); ?>
				</div>
				<?php get_template_part( 'template-parts/company/director' ); ?>
			</div>

			<?php get_template_part( 'template-parts/company/stats' ); ?>

		</div>

		<?php get_template_part( 'template-parts/company/projects-preview' ); ?>

		<?php if ( $show_certs ) : ?>
			<?php get_template_part( 'template-parts/company/certs-preview' ); ?>
		<?php endif; ?>

		<?php if ( $show_opinions ) : ?>
			<?php get_template_part( 'template-parts/company/opinions-preview' ); ?>
		<?php endif; ?>

	<?php endwhile; ?>

	<?php get_template_part( 'template-parts/cta-form' ); ?>

	<?php
	if ( locate_template( 'template-parts/map.php' ) ) {
		get_template_part( 'template-parts/map' );
	}
	?>

</main>

<?php
get_footer();
<?php
/**
 * Archive: Отзывы (CPT opinion)
 *
 * Логика вывода:
 *   - Есть посты CPT  → карточки
 *   - Есть сканы       → сетка внизу; H2 «Оригиналы отзывов» только если
 *                        выше уже что-то было (иначе сканы = основной контент)
 *   - Ничего нет       → «Отзывы скоро появятся»
 *
 * @package ingigroup
 */

get_header();

$opinions = new WP_Query( [
	'post_type'      => 'opinion',
	'posts_per_page' => -1,
	'orderby'        => [
		'menu_order' => 'ASC',
		'date'       => 'ASC',
	],
	'no_found_rows'  => true,
] );

$has_posts = $opinions->have_posts();

// Сканы-оригиналы
$scans = [];
$dir   = get_template_directory() . '/assets/images/';
$uri   = get_template_directory_uri() . '/assets/images/';

for ( $i = 1; $i <= 9; $i++ ) {
	$file = 'opinion-' . $i . '.jpg';
	if ( file_exists( $dir . $file ) ) {
		$scans[] = [
			'thumb' => $uri . $file,
			'full'  => $uri . $file,
			'alt'   => 'Отзыв ИНЖИГРУПП ' . $i,
		];
	}
}

$has_scans = ! empty( $scans );
?>

<main class="opinions-archive">
	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

	<div class="container">
		<h1 class="page-title">Отзывы</h1>

		<?php if ( $has_posts ) : ?>
			<div class="opinions-grid">
				<?php
				while ( $opinions->have_posts() ) :
					$opinions->the_post();
					$author = get_post_meta( get_the_ID(), '_opinion_author', true );
					$role   = get_post_meta( get_the_ID(), '_opinion_role', true );
					$text   = trim( get_the_content() );
					$logo   = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
					?>
					<article class="opinion-card">
						<?php if ( $logo ) : ?>
							<div class="opinion-card__logo">
								<img src="<?php echo esc_url( $logo ); ?>"
								     alt="<?php the_title_attribute(); ?>"
								     loading="lazy"
								     decoding="async">
							</div>
						<?php endif; ?>

						<h2 class="opinion-card__company"><?php the_title(); ?></h2>

						<?php if ( $text ) : ?>
							<blockquote class="opinion-card__quote">
								<?php the_content(); ?>
							</blockquote>
						<?php endif; ?>

						<?php if ( $author || $role ) : ?>
							<footer class="opinion-card__sign">
								<?php if ( $author ) : ?>
									<span class="opinion-card__author"><?php echo esc_html( $author ); ?></span>
								<?php endif; ?>
								<?php if ( $role ) : ?>
									<span class="opinion-card__role"><?php echo esc_html( $role ); ?></span>
								<?php endif; ?>
							</footer>
						<?php endif; ?>
					</article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
	</div>

	<?php if ( $has_scans ) : ?>
		<div class="container">
			<div class="opinions-scans">
				<?php if ( $has_posts ) : ?>
					<h2 class="opinions-scans__title">Оригиналы отзывов</h2>
				<?php endif; ?>

				<div class="opinions-scans-grid">
					<?php foreach ( $scans as $scan ) : ?>
						<a href="<?php echo esc_url( $scan['full'] ); ?>"
						   class="certificate-card"
						   aria-label="Открыть: <?php echo esc_attr( $scan['alt'] ); ?>">
							<img src="<?php echo esc_url( $scan['thumb'] ); ?>"
							     alt="<?php echo esc_attr( $scan['alt'] ); ?>"
							     loading="lazy"
							     decoding="async">
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( ! $has_posts && ! $has_scans ) : ?>
		<div class="container">
			<p class="opinions-empty">Отзывы скоро появятся.</p>
		</div>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/cta-form' ); ?>

	<?php if ( locate_template( 'template-parts/map.php' ) ) : ?>
		<?php get_template_part( 'template-parts/map' ); ?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
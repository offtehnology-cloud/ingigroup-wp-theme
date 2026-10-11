<?php
/**
 * Archive: Сертификаты (CPT certificate)
 *
 * @package ingigroup
 */

get_header();

// Формируем список сертификатов: сначала пробуем CPT,
// если пусто — фолбэк на файлы /assets/images/cert-N.jpg
$certificates = [];

$q = new WP_Query( [
	'post_type'      => 'certificate',
	'posts_per_page' => -1,
	'orderby'        => [
		'menu_order' => 'ASC',
		'date'       => 'ASC',
	],
	'no_found_rows'  => true,
] );

if ( $q->have_posts() ) {
	while ( $q->have_posts() ) {
		$q->the_post();
		$thumb_id = get_post_thumbnail_id();
		if ( ! $thumb_id ) {
			continue;
		}
		$certificates[] = [
			'thumb' => wp_get_attachment_image_url( $thumb_id, 'large' ),
			'full'  => wp_get_attachment_image_url( $thumb_id, 'full' ),
			'alt'   => get_the_title(),
		];
	}
	wp_reset_postdata();
}

// Фолбэк на файлы в assets/images/
if ( empty( $certificates ) ) {
	$dir = get_template_directory() . '/assets/images/';
	$uri = get_template_directory_uri() . '/assets/images/';
	for ( $i = 1; $i <= 10; $i++ ) {
		$file = 'cert-' . $i . '.jpg';
		if ( file_exists( $dir . $file ) ) {
			$certificates[] = [
				'thumb' => $uri . $file,
				'full'  => $uri . $file,
				'alt'   => 'Сертификат ИНЖИГРУПП ' . $i,
			];
		}
	}
}
?>

<main class="certificates-archive">
	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

	<div class="container">
		<h1 class="page-title">Сертификаты</h1>

		<?php if ( ! empty( $certificates ) ) : ?>
			<div class="certificates-grid">
				<?php foreach ( $certificates as $cert ) : ?>
					<a href="<?php echo esc_url( $cert['full'] ); ?>"
					   class="certificate-card"
					   aria-label="Открыть: <?php echo esc_attr( $cert['alt'] ); ?>">
						<img src="<?php echo esc_url( $cert['thumb'] ); ?>"
						     alt="<?php echo esc_attr( $cert['alt'] ); ?>"
						     loading="lazy"
						     decoding="async">
					</a>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="certificates-empty">Сертификаты скоро появятся.</p>
		<?php endif; ?>
	</div>

	<?php get_template_part( 'template-parts/cta-form' ); ?>

	<?php if ( locate_template( 'template-parts/map.php' ) ) : ?>
		<?php get_template_part( 'template-parts/map' ); ?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
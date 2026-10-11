<?php
/**
 * Тизер «Сданные объекты» — выборка из портфолио.
 *
 * @package Ingigroup
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$limit = 6;

$q = new WP_Query( array(
	'post_type'      => 'project',
	'posts_per_page' => $limit,
	'orderby'        => 'menu_order date',
	'order'          => 'ASC',
	'no_found_rows'  => false, // нужно для found_posts
) );

if ( ! $q->have_posts() ) return;

// Всего опубликованных проектов в базе
$total = (int) wp_count_posts( 'project' )->publish;

// Показываем счётчик только если он осмысленный (больше, чем выводим)
$show_total = $total > $limit;
?>
<section class="company-section company-projects-preview">
	<div class="container">

		<h2 class="company-section__title">
			Сданные объекты
			<?php if ( $show_total ) : ?>
				<span>
					<?php echo esc_html( sprintf(
						'Примеры из %d реализованных проектов',
						$total
					) ); ?>
				</span>
			<?php else : ?>
				<span>Примеры из нашего портфолио</span>
			<?php endif; ?>
		</h2>

		<div class="works-list">
			<?php $i = 0; while ( $q->have_posts() ) : $q->the_post(); $i++; ?>
				<a class="work-item" href="<?php the_permalink(); ?>">
					<span class="work-item__num"><?php echo esc_html( sprintf( '%02d', $i ) ); ?></span>
					<span class="work-item__thumb">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'thumbnail', array( 'loading' => 'lazy' ) ); ?>
						<?php endif; ?>
					</span>
					<span class="work-item__title"><?php the_title(); ?></span>
				</a>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<div class="company-section__more">
			<a class="btn btn--orange"
			   href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>">
				<?php
				echo esc_html( $show_total
					? sprintf( 'Все %d проектов', $total )
					: 'Все проекты'
				);
				?>
			</a>
		</div>

	</div>
</section>
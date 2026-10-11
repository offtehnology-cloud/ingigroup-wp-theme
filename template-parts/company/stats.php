<?php
/**
 * Блок «Цифры» — 3 плитки. Редактируется через фильтр.
 *
 * @package Ingigroup
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$stats = apply_filters( 'ingigroup_company_stats', array(
	array( 'value' => '3+',    'label' => 'года на рынке' ),
	array( 'value' => '30+',   'label' => 'сданных объектов' ),
	array( 'value' => '5 лет', 'label' => 'срок аттестации специалистов' ),
) );

if ( empty( $stats ) ) return;
?>
<div class="company-stats">
	<?php foreach ( $stats as $item ) : ?>
		<div class="company-stats__item">
			<div class="company-stats__value"><?php echo esc_html( $item['value'] ); ?></div>
			<div class="company-stats__label"><?php echo esc_html( $item['label'] ); ?></div>
		</div>
	<?php endforeach; ?>
</div>
<?php
/**
 * Блок «Директор компании».
 *
 * @package Ingigroup
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$photo = get_theme_file_uri( 'assets/img/director.jpg' );
$name  = apply_filters( 'ingigroup_director_name', 'Марат Хуснутдинов' );
$role  = apply_filters( 'ingigroup_director_role', 'Директор ООО «ИНЖИГРУПП»' );
?>
<aside class="company-director">
	<div class="company-director__photo">
		<img src="<?php echo esc_url( $photo ); ?>"
		     alt="<?php echo esc_attr( $name . ' — ' . $role ); ?>"
		     loading="lazy" width="320" height="400">
	</div>
	<div class="company-director__meta">
		<strong class="company-director__name"><?php echo esc_html( $name ); ?></strong>
		<span class="company-director__role"><?php echo esc_html( $role ); ?></span>
	</div>
</aside>
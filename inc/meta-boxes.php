<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Метаполя проекта: регион, заказчик, состав работ, доп. работы, галерея
 */

add_action( 'add_meta_boxes', function () {
	add_meta_box(
		'project_details',
		'Детали проекта',
		'ingigroup_project_meta_box',
		'project',
		'normal',
		'high'
	);
} );

function ingigroup_project_meta_box( $post ) {
	wp_nonce_field( 'ingigroup_project_save', 'ingigroup_project_nonce' );

	$region     = get_post_meta( $post->ID, '_project_region', true );
	$customer   = get_post_meta( $post->ID, '_project_customer', true );
	$works      = get_post_meta( $post->ID, '_project_works', true );
	$additional = get_post_meta( $post->ID, '_project_additional', true );
	$gallery    = get_post_meta( $post->ID, '_project_gallery', true );
	?>
	<style>
		.ingi-field { margin-bottom: 16px; }
		.ingi-field > label { display:block; font-weight:600; margin-bottom:6px; }
		.ingi-field input[type=text],
		.ingi-field textarea { width:100%; }
		.ingi-field textarea { min-height:120px; font-family:monospace; }
		.ingi-gallery-preview { display:flex; flex-wrap:wrap; gap:8px; margin-top:10px; }
		.ingi-gallery-preview img { width:80px; height:80px; object-fit:cover; border-radius:4px; }
	</style>

	<div class="ingi-field">
		<label>Регион</label>
		<input type="text" name="project_region" value="<?php echo esc_attr( $region ); ?>" placeholder="г. Москва">
	</div>

	<div class="ingi-field">
		<label>Заказчик</label>
		<input type="text" name="project_customer" value="<?php echo esc_attr( $customer ); ?>" placeholder="ООО «РОСЖЕЛДОР»">
	</div>

	<div class="ingi-field">
		<label>Состав работ — по одному пункту на строку</label>
		<textarea name="project_works" placeholder="Разработка и согласование проекта производства работ&#10;Доставка комплектов РСП&#10;Установка комплектов РСП"><?php echo esc_textarea( $works ); ?></textarea>
	</div>

	<div class="ingi-field">
		<label>Дополнительно — по одному пункту на строку (необязательно)</label>
		<textarea name="project_additional" placeholder="Дополнительные работы..."><?php echo esc_textarea( $additional ); ?></textarea>
	</div>

	<div class="ingi-field">
		<label>Галерея</label>
		<input type="text" name="project_gallery" id="project_gallery" value="<?php echo esc_attr( $gallery ); ?>" readonly>
		<button type="button" class="button" id="project_gallery_add">Выбрать изображения</button>
		<button type="button" class="button" id="project_gallery_clear">Очистить</button>
		<div class="ingi-gallery-preview" id="project_gallery_preview">
			<?php if ( $gallery ) :
				foreach ( explode( ',', $gallery ) as $id ) :
					$id = (int) $id;
					if ( $id ) echo wp_get_attachment_image( $id, 'thumbnail' );
				endforeach;
			endif; ?>
		</div>
	</div>

	<script>
	jQuery(function($){
		var frame;
		$('#project_gallery_add').on('click', function(e){
			e.preventDefault();
			if (frame) { frame.open(); return; }
			frame = wp.media({
				title: 'Выберите изображения',
				button: { text: 'Добавить' },
				multiple: true
			});
			frame.on('select', function(){
				var ids = [], html = '';
				frame.state().get('selection').each(function(att){
					var a = att.toJSON();
					ids.push(a.id);
					var url = (a.sizes && a.sizes.thumbnail) ? a.sizes.thumbnail.url : a.url;
					html += '<img src="'+url+'">';
				});
				$('#project_gallery').val(ids.join(','));
				$('#project_gallery_preview').html(html);
			});
			frame.open();
		});
		$('#project_gallery_clear').on('click', function(e){
			e.preventDefault();
			$('#project_gallery').val('');
			$('#project_gallery_preview').html('');
		});
	});
	</script>
	<?php
}

add_action( 'save_post_project', function ( $post_id ) {
	if ( ! isset( $_POST['ingigroup_project_nonce'] ) ||
		! wp_verify_nonce( $_POST['ingigroup_project_nonce'], 'ingigroup_project_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	foreach ( [ 'project_region', 'project_customer', 'project_works', 'project_additional', 'project_gallery' ] as $f ) {
		if ( isset( $_POST[ $f ] ) ) {
			update_post_meta( $post_id, '_' . $f, wp_kses_post( $_POST[ $f ] ) );
		}
	}
} );

add_action( 'admin_enqueue_scripts', function ( $hook ) {
	global $post_type;
	if ( ( $hook === 'post.php' || $hook === 'post-new.php' ) && $post_type === 'project' ) {
		wp_enqueue_media();
	}
} );
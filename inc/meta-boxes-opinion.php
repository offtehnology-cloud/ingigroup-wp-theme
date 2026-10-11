<?php
/**
 * Метаполя отзыва: автор, должность.
 *
 * @package ingigroup
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'add_meta_boxes', function () {
	add_meta_box(
		'opinion_details',
		'Подпись отзыва',
		'ingigroup_opinion_meta_box',
		'opinion',
		'normal',
		'high'
	);
} );

function ingigroup_opinion_meta_box( $post ) {
	wp_nonce_field( 'ingigroup_opinion_save', 'ingigroup_opinion_nonce' );

	$author = get_post_meta( $post->ID, '_opinion_author', true );
	$role   = get_post_meta( $post->ID, '_opinion_role', true );
	?>
	<p>
		<label for="opinion_author"><strong>Автор (ФИО):</strong></label><br>
		<input type="text" id="opinion_author" name="opinion_author"
		       value="<?php echo esc_attr( $author ); ?>"
		       style="width:100%;margin-top:4px;">
	</p>

	<p>
		<label for="opinion_role"><strong>Должность:</strong></label><br>
		<input type="text" id="opinion_role" name="opinion_role"
		       value="<?php echo esc_attr( $role ); ?>"
		       style="width:100%;margin-top:4px;">
	</p>

	<p style="color:#666;font-size:12px;margin-top:16px;">
		Заголовок поста — <strong>название компании</strong>.<br>
		Основной редактор — <strong>текст отзыва</strong>.<br>
		Миниатюра — <strong>логотип компании</strong> (необязательно, выводится сверху).
	</p>
	<?php
}

add_action( 'save_post_opinion', function ( $post_id ) {

	if ( ! isset( $_POST['ingigroup_opinion_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['ingigroup_opinion_nonce'], 'ingigroup_opinion_save' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['opinion_author'] ) ) {
		update_post_meta( $post_id, '_opinion_author', sanitize_text_field( $_POST['opinion_author'] ) );
	}
	if ( isset( $_POST['opinion_role'] ) ) {
		update_post_meta( $post_id, '_opinion_role', sanitize_text_field( $_POST['opinion_role'] ) );
	}
} );
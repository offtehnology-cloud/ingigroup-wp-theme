<?php
/**
 * Метабокс «Галерея» для страниц услуг (по умолчанию — /production).
 * Хранит ID вложений в мета-поле _ingi_gallery (comma-separated).
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Слаги страниц, на которых показывать метабокс.
 * Позже — добавить 'rent', 'installation' и т.д.
 */
function ingi_gallery_enabled_slugs() {
    return [
        'production',
        'felling',   // ← добавили
    ];
}

function ingi_gallery_is_enabled_for_current() {
    $post = get_post();
    if ( ! $post || $post->post_type !== 'page' ) return false;
    return in_array( $post->post_name, ingi_gallery_enabled_slugs(), true );
}

/* ---------- Метка ---------- */
add_action( 'add_meta_boxes', function () {
    if ( ! ingi_gallery_is_enabled_for_current() ) return;

    add_meta_box(
        'ingi_gallery',
        'Галерея изображений',
        'ingi_gallery_render_metabox',
        'page',
        'normal',
        'high'
    );
} );

function ingi_gallery_render_metabox( $post ) {
    wp_nonce_field( 'ingi_gallery_save', 'ingi_gallery_nonce' );
    $ids = get_post_meta( $post->ID, '_ingi_gallery', true );
    $ids = $ids ? array_filter( array_map( 'intval', explode( ',', $ids ) ) ) : [];
    ?>
    <div id="ingi-gallery-wrap" class="ingi-gallery-wrap">
        <input type="hidden" id="ingi-gallery-ids" name="ingi_gallery_ids"
               value="<?php echo esc_attr( implode( ',', $ids ) ); ?>">

        <div class="ingi-gallery-preview" id="ingi-gallery-preview">
            <?php foreach ( $ids as $id ) :
                $thumb = wp_get_attachment_image_url( $id, 'thumbnail' );
                if ( ! $thumb ) continue; ?>
                <div class="ingi-gallery-item" data-id="<?php echo esc_attr( $id ); ?>">
                    <img src="<?php echo esc_url( $thumb ); ?>" alt="">
                    <button type="button" class="ingi-gallery-remove" aria-label="Удалить">×</button>
                </div>
            <?php endforeach; ?>
        </div>

        <p>
            <button type="button" class="button button-primary" id="ingi-gallery-add">Добавить изображения</button>
            <button type="button" class="button" id="ingi-gallery-clear">Очистить</button>
        </p>
        <p class="description">
            Можно выбрать сразу много файлов. Перетаскивайте миниатюры для изменения порядка.
            Если галерея пуста — на странице показываются картинки-фолбэки из темы.
        </p>
    </div>
    <?php
}

/* ---------- Сохранение ---------- */
add_action( 'save_post_page', function ( $post_id ) {
    if ( ! isset( $_POST['ingi_gallery_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['ingi_gallery_nonce'], 'ingi_gallery_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $raw = isset( $_POST['ingi_gallery_ids'] ) ? (string) $_POST['ingi_gallery_ids'] : '';
    $ids = array_filter( array_map( 'intval', explode( ',', $raw ) ) );

    if ( $ids ) {
        update_post_meta( $post_id, '_ingi_gallery', implode( ',', $ids ) );
    } else {
        delete_post_meta( $post_id, '_ingi_gallery' );
    }
} );

/* ---------- Админ-скрипт ---------- */
add_action( 'admin_enqueue_scripts', function ( $hook ) {
    if ( ! in_array( $hook, [ 'post.php', 'post-new.php' ], true ) ) return;
    if ( ! ingi_gallery_is_enabled_for_current() ) return;

    wp_enqueue_media();
    wp_enqueue_script( 'jquery-ui-sortable' );

    $js = <<<'JS'
    jQuery(function($){
        var $wrap = $('#ingi-gallery-wrap');
        if ( ! $wrap.length ) return;

        var $ids     = $('#ingi-gallery-ids');
        var $preview = $('#ingi-gallery-preview');
        var frame;

        $preview.sortable({
            items: '.ingi-gallery-item',
            cursor: 'move',
            update: syncIds
        });

        $('#ingi-gallery-add').on('click', function(e){
            e.preventDefault();
            if ( frame ) { frame.open(); return; }

            frame = wp.media({
                title: 'Выберите изображения',
                button: { text: 'Добавить в галерею' },
                library: { type: 'image' },
                multiple: true
            });

            frame.on('select', function(){
                var sel = frame.state().get('selection');
                sel.each(function(att){
                    var id = att.id;
                    if ( $preview.find('[data-id="'+id+'"]').length ) return;

                    var url = (att.attributes.sizes && att.attributes.sizes.thumbnail)
                        ? att.attributes.sizes.thumbnail.url
                        : att.attributes.url;

                    $preview.append(
                        '<div class="ingi-gallery-item" data-id="'+id+'">'+
                            '<img src="'+url+'" alt="">'+
                            '<button type="button" class="ingi-gallery-remove" aria-label="Удалить">×</button>'+
                        '</div>'
                    );
                });
                syncIds();
            });

            frame.open();
        });

        $preview.on('click', '.ingi-gallery-remove', function(e){
            e.preventDefault();
            $(this).closest('.ingi-gallery-item').remove();
            syncIds();
        });

        $('#ingi-gallery-clear').on('click', function(e){
            e.preventDefault();
            if ( ! confirm('Удалить все изображения из галереи?') ) return;
            $preview.empty();
            syncIds();
        });

        function syncIds(){
            var ids = [];
            $preview.find('.ingi-gallery-item').each(function(){
                ids.push( $(this).data('id') );
            });
            $ids.val( ids.join(',') );
        }
    });
JS;
    wp_add_inline_script( 'jquery', $js );
} );

/* ---------- Админ-стили ---------- */
add_action( 'admin_head', function () {
    $screen = get_current_screen();
    if ( ! $screen || $screen->base !== 'post' || $screen->post_type !== 'page' ) return;
    if ( ! ingi_gallery_is_enabled_for_current() ) return;
    ?>
    <style>
        .ingi-gallery-preview { display:flex; flex-wrap:wrap; gap:8px; margin:6px 0 12px; min-height:60px; }
        .ingi-gallery-item { position:relative; width:90px; height:90px; cursor:move; border:1px solid #ddd; background:#f6f7f7; }
        .ingi-gallery-item img { width:100%; height:100%; object-fit:cover; display:block; }
        .ingi-gallery-remove {
            position:absolute; top:-6px; right:-6px; width:20px; height:20px; border-radius:50%;
            border:0; background:#d63638; color:#fff; cursor:pointer; font-size:14px; line-height:1; padding:0;
        }
        .ingi-gallery-item.ui-sortable-helper { opacity:.7; }
    </style>
    <?php
} );
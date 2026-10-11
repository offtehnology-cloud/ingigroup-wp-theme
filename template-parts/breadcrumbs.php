<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$items = [];
$items[] = [ 'url' => home_url( '/' ), 'label' => 'Главная' ];

if ( is_post_type_archive( 'project' ) || is_tax( 'project_category' ) || is_singular( 'project' ) ) {
    $items[] = [ 'url' => get_post_type_archive_link( 'project' ), 'label' => 'Реализованные проекты' ];
}

if ( is_tax( 'project_category' ) ) {
    $term = get_queried_object();
    if ( $term ) {
        $items[] = [ 'url' => '', 'label' => $term->name ];
    }
} elseif ( is_singular( 'project' ) ) {
    $terms = get_the_terms( get_the_ID(), 'project_category' );
    if ( $terms && ! is_wp_error( $terms ) ) {
        $items[] = [ 'url' => get_term_link( $terms[0] ), 'label' => $terms[0]->name ];
    }
    // заголовок проекта сюда не добавляем — он ниже как H1
}
?>
<nav class="breadcrumbs" aria-label="Хлебные крошки">
    <?php foreach ( $items as $i => $item ) :
        if ( $i > 0 ) echo '<span class="breadcrumbs__sep">›</span>';
        if ( ! empty( $item['url'] ) ) : ?>
            <a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
        <?php else : ?>
            <span><?php echo esc_html( $item['label'] ); ?></span>
        <?php endif;
    endforeach; ?>
</nav>
<?php
$items = [];
for ($i = 1; $i <= 9; $i++) {
    $items[] = INGI_URI . '/assets/images/opinion-' . $i . '.jpg';
}
?>
<section class="opinions" id="opinions">
  <div class="container">
    <h2 class="section-title section-title--ghost">ОТЗЫВЫ</h2>
    <div class="opinions__grid">
      <?php foreach ( $items as $src ) : ?>
        <a class="opinions__item" href="<?php echo esc_url( $src ); ?>" target="_blank">
          <img src="<?php echo esc_url( $src ); ?>" alt="Отзыв">
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
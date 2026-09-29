<?php
// Пока галерея из 10 изображений (2 ряда по 5). Позже — из CPT `certificate`.
$certs = [];
for ( $i = 1; $i <= 9; $i++ ) {
    $certs[] = INGI_URI . '/assets/images/cert-' . $i . '.jpg';
}
?>
<section class="certificates" id="sertificats">
  <div class="container">
    <h2 class="section-title section-title--ghost">СЕРТИФИКАТЫ</h2>
    <div class="certificates__grid">
      <?php foreach ( $certs as $src ) : ?>
        <a class="certificates__item" href="<?php echo esc_url( $src ); ?>" target="_blank">
          <img src="<?php echo esc_url( $src ); ?>" alt="Сертификат">
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
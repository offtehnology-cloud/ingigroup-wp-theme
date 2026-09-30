<?php
// Пока галерея из 9 изображений. Позже — из CPT `certificate`.
$certs = [];
for ( $i = 1; $i <= 9; $i++ ) {
    $certs[] = INGI_URI . '/assets/images/cert-' . $i . '.jpg';
}
?>
<section class="certificates" id="sertificats">
  <div class="container">
    <h2 class="section-title section-title--ghost" data-aos="fade-up">СЕРТИФИКАТЫ</h2>
    <div class="certificates__grid">
      <?php foreach ( $certs as $i => $src ) : ?>
        <a class="certificates__item"
           href="<?php echo esc_url( $src ); ?>"
           target="_blank"
           data-aos="zoom-in"
           data-aos-delay="<?php echo esc_attr( ( $i % 5 ) * 80 ); ?>">
          <img src="<?php echo esc_url( $src ); ?>" alt="Сертификат">
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
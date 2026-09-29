<?php
/**
 * 4 карточки услуг. Данные пока жёстко прописаны — позже заменим на CPT `service`.
 */
$services = [
    [
        'title'    => 'СТРАХОВОЧНЫЕ РЕЛЬСОВЫЕ <br>ПАКЕТЫ',
        'img'      => 'service-1.jpg',
        'url'      => home_url( '/service' ),
        'subitems' => [
            [ 'text' => 'Услуги по установке рельсовых страховочных пакетов', 'url' => home_url( '/service' ) ],
            [ 'text' => 'Изготовление и продажа рельсовых страховочных пакетов', 'url' => home_url( '/production' ) ],
            [ 'text' => 'Аренда рельсовых страховочных пакетов', 'url' => home_url( '/rent' ) ],
        ],
    ],
    [
        'title' => 'МОНТАЖ И УСТРОЙСТВО<br>ИНЖЕНЕРНЫХ И КАБЕЛЬНЫХ<br>СЕТЕЙ',
        'img'   => 'service-2.jpg',
        'url'   => home_url( '/installation' ),
    ],
    [
        'title' => 'РАЗРАБОТКА ПРОЕКТОВ<br>ПРОИЗВОДСТВА РАБОТ (ППР)',
        'img'   => 'service-3.jpg',
        'url'   => home_url( '/development' ),
    ],
    [
        'title'    => 'ВЫРУБКА ДРЕВЕСНО-<br>КУСТАРНИКОВОЙ<br>РАСТИТЕЛЬНОСТИ',
        'subtitle' => 'НА ОБЪЕКТАХ ИНФРАСТРУКТУРЫ ОАО «РЖД»',
        'img'      => 'service-4.jpg',
        'url'      => home_url( '/felling' ),
    ],
];
?>
<section class="services" id="service">
  <div class="services__heading">
    <div class="container">
      <h2 class="section-title section-title--white">НАШИ УСЛУГИ</h2>
    </div>
  </div>

  <div class="services__grid">
    <?php foreach ( $services as $s ) : ?>
      <div class="service-card"
           style="background-image:url('<?php echo esc_url( INGI_URI . '/assets/images/' . $s['img'] ); ?>');">
        <div class="service-card__gradient"></div>
        <a href="<?php echo esc_url( $s['url'] ); ?>" class="service-card__link" aria-label="<?php echo esc_attr( wp_strip_all_tags( $s['title'] ) ); ?>"></a>
        <div class="service-card__body">
          <h3 class="service-card__title"><?php echo wp_kses_post( $s['title'] ); ?></h3>
          <?php if ( ! empty( $s['subtitle'] ) ) : ?>
            <p class="service-card__subtitle"><?php echo esc_html( $s['subtitle'] ); ?></p>
          <?php endif; ?>
        </div>

        <?php if ( ! empty( $s['subitems'] ) ) : ?>
          <div class="service-card__hover">
            <?php foreach ( $s['subitems'] as $it ) : ?>
              <a class="service-card__sublink" href="<?php echo esc_url( $it['url'] ); ?>">
                <?php echo esc_html( $it['text'] ); ?>
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>
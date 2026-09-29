<?php
$items = [
    [ 'ico' => 'shield',   'text' => 'Компания является <strong>членом СРО</strong>, имеет сертификат соответствия ГОСТ Р ИСО 45001-2020' ],
    [ 'ico' => 'helmet',   'text' => 'Сотрудники прошли <strong>аттестацию</strong> в ОАО «РЖД»' ],
    [ 'ico' => 'price',    'text' => '<strong>Фиксированная цена</strong>, включающая в себя все виды работ и подготовку документации' ],
    [ 'ico' => 'truck',    'text' => 'Собственный парк техники' ],
    [ 'ico' => 'star',     'text' => '<strong>Гарантия качества</strong> на все виды работ' ],
    [ 'ico' => 'clock',    'text' => '<strong>Соблюдение</strong> договорных <strong>сроков</strong>' ],
    [ 'ico' => 'gear',     'text' => 'Полное <strong>техническое обеспечение</strong>' ],
];
?>
<section class="advantages">
  <div class="container">
    <h2 class="section-title section-title--ghost">ПРЕИМУЩЕСТВА</h2>
    <div class="advantages__grid">
      <?php foreach ( $items as $it ) : ?>
        <div class="adv-card">
          <div class="adv-card__icon">✦</div>
          <p class="adv-card__text"><?php echo wp_kses_post( $it['text'] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
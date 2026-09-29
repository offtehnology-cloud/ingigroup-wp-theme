<section class="map-section" id="contacts">
  <div class="map-section__panel">
    <h2 class="map-section__title">НАШ АДРЕС</h2>
    <p class="map-section__addr"><?php echo esc_html( get_theme_mod( 'ingi_addr_main' ) ); ?></p>
  </div>
  <div class="map-section__canvas" id="ingi-map"
       data-lat="<?php echo esc_attr( get_theme_mod( 'ingi_map_lat', '55.785548' ) ); ?>"
       data-lon="<?php echo esc_attr( get_theme_mod( 'ingi_map_lon', '49.171925' ) ); ?>">
  </div>
</section>
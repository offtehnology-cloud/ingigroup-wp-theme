<footer class="site-footer">
  <div class="container footer__grid">
    <div class="footer__col footer__col--brand">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo">
        <img src="<?php echo esc_url( INGI_URI . '/assets/images/logo-horizontal.png' ); ?>"
             alt="<?php bloginfo( 'name' ); ?>">
      </a>
      <div class="footer__socials">
        <?php if ( get_theme_mod( 'ingi_telegram', '' ) ) : ?>
          <a href="<?php echo esc_url( get_theme_mod( 'ingi_telegram' ) ); ?>" aria-label="Telegram">TG</a>
        <?php endif; ?>
        <?php if ( get_theme_mod( 'ingi_whatsapp', '' ) ) : ?>
          <a href="<?php echo esc_url( get_theme_mod( 'ingi_whatsapp' ) ); ?>" aria-label="WhatsApp">WA</a>
        <?php endif; ?>
      </div>
    </div>

    <div class="footer__col">
      <h4>УСЛУГИ</h4>
      <?php wp_nav_menu( [
          'theme_location' => 'footer_services',
          'container'      => false,
          'menu_class'     => 'footer__menu',
          'fallback_cb'    => false,
      ] ); ?>
    </div>

    <div class="footer__col">
      <h4>ДОКУМЕНТЫ</h4>
      <?php wp_nav_menu( [
          'theme_location' => 'footer_docs',
          'container'      => false,
          'menu_class'     => 'footer__menu',
          'fallback_cb'    => false,
      ] ); ?>
    </div>

    <div class="footer__col">
      <h4>КОНТАКТЫ</h4>

      <?php
      $phone  = get_theme_mod( 'ingi_phone',      '+7 (917) 909-99-96' );
      $email  = get_theme_mod( 'ingi_email',      'info@ingigroup.ru' );
      $addr1  = get_theme_mod( 'ingi_addr_main',  'Республика Татарстан, г. Казань, ул. Гвардейская, д. 33, офис 210' );
      $addr2  = get_theme_mod( 'ingi_addr_extra', 'г. Москва, ул. Жебрунова, д. 6, стр. 1, офис 224' );
      ?>

      <a class="footer__phone"
         href="tel:<?php echo esc_attr( preg_replace( '/\D/', '', $phone ) ); ?>">
        <?php echo esc_html( $phone ); ?>
      </a>

      <p>✉ <a href="mailto:<?php echo esc_attr( $email ); ?>">
        <?php echo esc_html( $email ); ?>
      </a></p>

      <p><strong>Основной офис:</strong><br><?php echo esc_html( $addr1 ); ?></p>

      <p><strong>Дополнительный офис:</strong><br><?php echo esc_html( $addr2 ); ?></p>
    </div>
  </div>

  <div class="footer__bottom">
    <div class="container">
      <span><?php echo esc_html( get_theme_mod( 'ingi_copyright', '© 2023–2026 гг. ООО «ИНЖИГРУПП»' ) ); ?></span>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
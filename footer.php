<footer class="site-footer">
  <div class="container">

    <div class="footer__top">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo">
        <img src="<?php echo esc_url( INGI_URI . '/assets/images/logo-horizontal.png' ); ?>"
             alt="<?php bloginfo( 'name' ); ?>">
      </a>

      <div class="footer__socials">
        <?php
        $tg = get_theme_mod( 'ingi_telegram', 'https://t.me/79179099996' );
        $wa = get_theme_mod( 'ingi_whatsapp', 'https://wa.me/79179099996' );
        ?>
        <a href="<?php echo esc_url( $tg ); ?>" aria-label="Telegram" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M22.05 2.4 1.6 10.28c-1.32.53-1.31 1.27-.24 1.6l5.25 1.64 2.02 6.18c.25.69.5.9 1.02.9.4 0 .58-.18.8-.4l1.9-1.85 3.95 2.91c.73.4 1.25.2 1.43-.68L22.7 3.9c.26-1.16-.44-1.68-1.2-1.3zM9.1 13.5l9.03-5.7-6.98 6.4-.27 3.2-1.78-3.9z"/>
          </svg>
        </a>
        <a href="<?php echo esc_url( $wa ); ?>" aria-label="WhatsApp" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M20.5 3.5A11.7 11.7 0 0 0 12 .2C5.5.2.2 5.5.2 12c0 2.1.5 4.1 1.6 5.9L0 24l6.3-1.7c1.7.9 3.7 1.4 5.7 1.4 6.5 0 11.8-5.3 11.8-11.8 0-3.2-1.2-6.1-3.3-8.4zM12 21.6c-1.7 0-3.4-.5-4.9-1.4l-.3-.2-3.7 1 1-3.6-.2-.3c-1-1.5-1.5-3.3-1.5-5.1 0-5.4 4.4-9.8 9.8-9.8 2.6 0 5.1 1 6.9 2.9 1.8 1.8 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm5.4-7.3c-.3-.1-1.7-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8.9-.9 1.1-.2.2-.3.2-.6.1-.3-.1-1.2-.5-2.3-1.5-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.4.1-.6.1-.1.3-.3.4-.4.1-.1.2-.3.3-.4.1-.2 0-.3 0-.4 0-.1-.7-1.6-.9-2.2-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 .9-1 2.3 0 1.3.9 2.6 1 2.8.1.2 1.7 2.7 4.2 3.8.6.3 1 .4 1.4.5.6.2 1.1.2 1.5.1.5-.1 1.4-.6 1.6-1.1.2-.6.2-1 .1-1.1-.1-.2-.3-.3-.6-.4z"/>
          </svg>
        </a>
      </div>
    </div>

    <div class="footer__cols">

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
        $phone = get_theme_mod( 'ingi_phone', '+7 (917) 909-99-96' );
        $email = get_theme_mod( 'ingi_email',      'info@ingigroup.ru' );
        $addr1 = get_theme_mod( 'ingi_addr_main',  'Республика Татарстан, г. Казань, ул. Гвардейская, д. 33 офис 210' );
        $addr2 = get_theme_mod( 'ingi_addr_extra', 'г. Москва, ул. Жебрунова, д. 6, стр. 1, офис 224' );
        ?>

        <a class="footer__phone"
           href="tel:<?php echo esc_attr( preg_replace( '/\D/', '', $phone ) ); ?>">
          <?php echo esc_html( $phone ); ?>
        </a>

        <p class="footer__line footer__line--email">
          <svg class="footer__ico" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.6">
            <rect x="3" y="5" width="18" height="14" rx="1"/>
            <polyline points="3,7 12,13 21,7"/>
          </svg>
          <a href="mailto:<?php echo esc_attr( $email ); ?>">Email: <?php echo esc_html( $email ); ?></a>
        </p>

        <p class="footer__line footer__line--addr">
          <span class="footer__label">Основной офис:</span>
          <svg class="footer__ico" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 2C8.1 2 5 5.1 5 9c0 5.3 7 13 7 13s7-7.7 7-13c0-3.9-3.1-7-7-7z" fill="currentColor"/>
            <circle cx="12" cy="9" r="2.6" fill="#1e1e1e"/>
          </svg>
          <?php echo esc_html( $addr1 ); ?>
        </p>

        <p class="footer__line footer__line--addr">
          <span class="footer__label">Дополнительный офис:</span>
          <svg class="footer__ico" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 2C8.1 2 5 5.1 5 9c0 5.3 7 13 7 13s7-7.7 7-13c0-3.9-3.1-7-7-7z" fill="currentColor"/>
            <circle cx="12" cy="9" r="2.6" fill="#1e1e1e"/>
          </svg>
          <?php echo esc_html( $addr2 ); ?>
        </p>
      </div>
    </div>

    <div class="footer__bottom">
      <span class="footer__copy"><?php echo esc_html( get_theme_mod( 'ingi_copyright', '© 2025 - 2026 гг., ООО «ИНЖИГРУПП»' ) ); ?></span>
      <a class="footer__design" href="#" target="_blank" rel="noopener">Дизайн - Светлана Кузнецова</a>
    </div>

  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
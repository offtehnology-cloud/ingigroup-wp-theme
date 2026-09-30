<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <!-- Верхняя тёмная полоса -->
  <div class="topbar">
    <div class="container topbar__inner">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="topbar__logo">
        <img src="<?php echo esc_url( INGI_URI . '/assets/images/logo-horizontal.png' ); ?>"
             alt="<?php bloginfo( 'name' ); ?>">
      </a>
      <div class="topbar__slogan">
        <?php echo esc_html( get_theme_mod( 'ingi_slogan', 'КОМПЛЕКС РАБОТ ПО УСТАНОВКЕ СТРАХОВОЧНЫХ РЕЛЬСОВЫХ ПАКЕТОВ' ) ); ?>
      </div>
      <nav class="topbar__nav">
        <?php wp_nav_menu( [
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'topbar__menu',
            'fallback_cb'    => false,
        ] ); ?>
      </nav>

      <div class="topbar__actions">
        <a class="topbar__phone"
   href="tel:<?php echo esc_attr( preg_replace( '/\D/', '', get_theme_mod( 'ingi_phone', '+7 (917) 909-99-96' ) ) ); ?>">
  <?php echo esc_html( get_theme_mod( 'ingi_phone', '+7 (917) 909-99-96' ) ); ?>
</a>
        <button type="button" class="topbar__burger js-burger" aria-label="Меню" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </div>

  <!-- Оранжевая полоса услуг (только десктоп) -->
  <div class="services-bar">
    <div class="container">
      <?php wp_nav_menu( [
          'theme_location' => 'services_menu',
          'container'      => false,
          'menu_class'     => 'services-bar__menu',
          'fallback_cb'    => false,
      ] ); ?>
    </div>
  </div>

  <!-- Мобильное меню (оранжевое, раскрывается по бургеру) -->
  <div class="mobile-menu" id="mobile-menu" hidden>
    <div class="mobile-menu__inner">
      <?php wp_nav_menu( [
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'mobile-menu__list',
          'fallback_cb'    => false,
      ] ); ?>
      <?php wp_nav_menu( [
          'theme_location' => 'services_menu',
          'container'      => false,
          'menu_class'     => 'mobile-menu__list',
          'fallback_cb'    => false,
      ] ); ?>
    </div>
  </div>
</header>
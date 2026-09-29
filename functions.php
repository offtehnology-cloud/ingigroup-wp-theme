<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'INGI_VERSION', '1.0.0' );
define( 'INGI_DIR', get_template_directory() );
define( 'INGI_URI', get_template_directory_uri() );

require_once INGI_DIR . '/inc/setup.php';
require_once INGI_DIR . '/inc/enqueue.php';
require_once INGI_DIR . '/inc/customizer.php';
require_once INGI_DIR . '/inc/cpt.php';
require_once INGI_DIR . '/inc/ajax-form.php';
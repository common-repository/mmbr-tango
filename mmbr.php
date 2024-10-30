<?php
/*
Plugin name: MMBR Tango
Plugin URL: http://www.mmbr.io
Description: MMBR is the best way to charge for access to content on your WordPress site. Go to http://www.mmbr.io/wordpress and follow the installation instructions to create a MMBR account and configure the MMBR plugin for your WordPress site.
Version: 0.0.1
Author: MMBR
Author URL: http://www.mmbr.io
License: GPL-2.0+
*/

  if ( !defined( 'ABSPATH' ) ) {
      exit;
  }

  if( ! defined('WP_PLUGIN_DIR')) {
    die('This Wordpress Plugin is not supported by your system.');
  }

  // Make sure we don't expose any info if called directly
  if ( !function_exists( 'add_action' ) ) {
  	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  	exit;
  }

  if( ! defined('MMBR_PLUGIN_FILE_PATH')) {
    define('MMBR_PLUGIN_FILE_PATH', plugin_dir_path(__FILE__) . "/mmbr.php");
  }
  if( ! defined('MMBR_IMAGE_DIR')) {
    define('MMBR_IMAGE_DIR', plugin_dir_url(__FILE__) . 'assets/images/');
  }
  if( ! defined('MMBR_FAVICON')) {
    define('MMBR_FAVICON', plugin_dir_url(__FILE__) . 'assets/images/favicon.png');
  }
  if( ! defined('MMBR_OPTION_KEY')) {
    define('MMBR_OPTION_KEY', 'mmbr-tango-site-key');
  }
  if( ! defined('MMBR_PLUGIN_URL')) {
    define('MMBR_PLUGIN_URL', 'https://api.mmbr.io/comma/v1/init.js?key='.get_option(MMBR_OPTION_KEY));
  }

  //setup
  if (is_admin()) {
  	require_once dirname(__FILE__) . '/mmbr-admin.php';
  }

  register_activation_hook(__FILE__, 'mmbr_activate');

  register_deactivation_hook(__FILE__, 'mmbr_deactivate');

  add_filter('wp_footer', 'mmbr_get_footer');

  function mmbr_get_footer() {
    if(strlen(trim(get_option(MMBR_OPTION_KEY))) > 0) {
      mmbr_get_assets();
    }
  }

  function mmbr_get_assets() {
    wp_register_script('mmbr_init', MMBR_PLUGIN_URL, null, null, true);
    wp_enqueue_script('mmbr_init');
  }
 ?>

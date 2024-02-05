<?php
/**
 * Plugin Name: CZtenis.cz PLUGIN
 * Description: Plugin for displaying your cztenis team matches 
 * Version: 1.0
 * Author: František Kaiser +420 605 720 349
 * Author URI: mailto:fkaiser.email@gmail.com
 * Requires at least: 6.3
 * Requires PHP: 7.0
 */


if (!defined('ABSPATH')) {
      die('You cannot be here');
}

if (!class_exists('CZtenisPlugin')) {

      class CZtenisPlugin
      {
            public function __construct()
            {
                  define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));
                  define('MY_PLUGIN_URL', plugin_dir_url(__FILE__));

                  require_once(MY_PLUGIN_PATH . '/vendor/autoload.php');

                  wp_enqueue_script('jquery');
            }


            public function initialize()
            {
                  include_once MY_PLUGIN_PATH . 'includes/CZtenisDruzstva.php';
            }

      }

      $cztenis_plugin = new CZtenisPlugin();
      $cztenis_plugin->initialize();

}
<?php
/**
 * Plugin Name: Popup trigger PLUGIN
 * Description: Plugin for triggering popup on Nth page visit 
 * Version: 1.0
 * Author: František Kaiser +420 605 720 349
 * Author URI: mailto:fkaiser.email@gmail.com
 * Requires at least: 6.3
 * Requires PHP: 7.0
 */


if (!defined('ABSPATH')) {
      die('You cannot be here');
}


use Carbon_Fields\Container;
use Carbon_Fields\Field;

if (!class_exists('FanticPopupTrigger')) {


      class FanticPopupTrigger
      {
            
            private static $instance;

            public static function get_instance()
            {
                  if (null === self::$instance) {
                        self::$instance = new self();
                  }

                  return self::$instance;
            }
            public function __construct()
            {
                  define('POPUP_PLUGIN_PATH', plugin_dir_path(__FILE__));
                  define('POUPUP_PLUGIN_URL', plugin_dir_url(__FILE__));

                  require_once(POPUP_PLUGIN_PATH . '/vendor/autoload.php');


                  add_action('after_setup_theme', array($this, 'load_carbon_fields'));
                  add_action('carbon_fields_register_fields', array($this, 'create_options_page'));

                  add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_scripts']);
            }

            function enqueue_scripts() {
                  wp_enqueue_script('jquery');

                  $version = time(); // Current timestamp
                  wp_enqueue_script('popup-plugin', POUPUP_PLUGIN_URL . '/assets/js/popupTrigger.js', ['jquery', 'wp-element'], $version, true);
                  wp_localize_script('popup-plugin', 'appLocalizer', [
                      'triggerPopupLimit' => carbon_get_theme_option("trigger_popup_limit"),
                      "triggerPopupId" => carbon_get_theme_option("trigger_popup_id"),
                      "triggerPopupMinutesSession" => carbon_get_theme_option("trigger_popup_minutes_session"),
                  ]);
            }

            function load_carbon_fields()
            {
                  \Carbon_Fields\Carbon_Fields::boot();
            }

            function create_options_page()
            {
                  Container::make('theme_options', __('Nastavení popup trigger'))

                        ->set_page_menu_position(2)

                        ->set_icon('dashicons-beer')

                        ->add_fields(
                              array(
                                    Field::make('text', 'trigger_popup_limit', __('Trigger popup návštěva N')),
                                    Field::make('text', 'trigger_popup_id', __('Trigger popup ID popupu (ELEMENTOR)')),
                                    Field::make('text', 'trigger_popup_minutes_session', __('Doba jedné relace v minutách (jedna návštěva)'))
                              )
                        );
            }

            function get_trigger_popup_limit()
            {
                  return carbon_get_theme_option("trigger_popup_limit");
            }

            function get_trigger_popup_id()
            {
                  return carbon_get_theme_option("trigger_popup_id");
            }



      }

      $popup_plugin = FanticPopupTrigger::get_instance();

}
<?php
/**
 * Plugin Name: Woo Show Description
 * Description: Plugin for displaying description to your woo-commerce product 
 * Version: 1.0
 * Author: František Kaiser +420 605 720 349
 * Author URI: mailto:fkaiser.email@gmail.com
 */


if (!defined('ABSPATH')) {
      die('You cannot be here');
}


use Carbon_Fields\Container;
use Carbon_Fields\Field;


if (!class_exists('FanticWooDescription')) {


      class FanticWooDescription
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

                  require_once(plugin_dir_path(__FILE__) . 'vendor/autoload.php');
                  // require_once(plugin_dir_path(__FILE__) . 'includes/templates/product-template.php');

                  // wp_enqueue_script('jquery');


                  add_action('after_setup_theme', array($this, 'load_carbon_fields'));
                  add_action('carbon_fields_register_fields', array($this, 'create_options_page'));


                  // add_action('wp_enqueue_scripts', array($this, 'enqueue_plugin_styles'));



                  add_action('woocommerce_after_shop_loop_item', array($this, 'display_product_description'), 30);
                  //add_action('woocommerce_after_shop_loop_item_title', array($this, 'display_product_description'), 30);
            }

            function enqueue_plugin_styles()
            {
                  wp_enqueue_style('fantic-woo-description-styles', plugin_dir_url(__FILE__) . 'assets/css/fantic-woo-description.css', array(), '1.0.0', 'all');
            }

            function load_carbon_fields()
            {
                  \Carbon_Fields\Carbon_Fields::boot();
            }


            public function get_description_length()
            {
                  // Get the product description length from theme options
                  $description_length = 20; // Default value if option is not set or Carbon Fields is not available
                  if (function_exists('carbon_get_theme_option')) {
                        $description_length = carbon_get_theme_option("fantic_woo_description_length");
                  }

                  return $description_length;

                  // // Include product template with the description length
                  // include plugin_dir_path(__FILE__) . 'includes/templates/product-template.php';

            }


            function display_product_description()
            {
                  include plugin_dir_path(__FILE__) . 'includes/templates/product-template.php';
            }



            function create_options_page()
            {
                  Container::make('theme_options', __('Popisek produktů'))
                        ->set_page_menu_position(56)
                        ->set_icon('dashicons-beer')
                        ->add_fields(
                              array(
                                    Field::make('text', 'fantic_woo_description_length', __('Délka popisku produktu'))
                                          ->set_help_text('Počet slov popisku produktu'),
                              )
                        );
            }


      }

      $fantic_woo_description = FanticWooDescription::get_instance();

}
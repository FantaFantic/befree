<?php

if (!defined('ABSPATH')) {
      die('Neoprávněný přístup!');
}



use Carbon_Fields\Container;
use Carbon_Fields\Field;


if (!class_exists('CZtenisDruzstva')) {



      class CZtenisDruzstva
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


                  add_action('after_setup_theme', array($this, 'load_carbon_fields'));
                  add_action('carbon_fields_register_fields', array($this, 'create_options_page'));

                  add_shortcode('cztenis_include_druzstvo', array($this, 'include_druzstvo_page'));
            }

            function initialize()
            {

            }

            function load_carbon_fields()
            {
                  \Carbon_Fields\Carbon_Fields::boot();
            }

            function create_options_page()
            {
                  Container::make('theme_options', __('Nastavení družstva'))

                        ->set_page_menu_position(2)

                        ->set_icon('dashicons-beer')

                        ->add_fields(
                              array(
                                    Field::make('text', 'cztenis_druzstva_link', __('Odkaz na své družstvo'))->set_attribute('placeholder', 'Přímý odkaz na váš tým v tabulce družstev (kliknutí na své družstvo, zkopírování odkazu)')->set_help_text('např. <a href="https://www.cztenis.cz/dospeli/druzstva/sezona/2023/soutez/8216/druzstvo/6" target="_blank">https://www.cztenis.cz/dospeli/druzstva/sezona/2023/soutez/8216/druzstvo/6</a>'),
                              )
                        );
            }

            function include_druzstvo_page()
            {
                  // ob_start();
                  // include MY_PLUGIN_PATH . 'includes/templates/druzstvo.php';
                  // return ob_get_clean();

                  $url = $this->get_druzstvo_url();

                  // Check if the URL is valid
                  if (filter_var($url, FILTER_VALIDATE_URL)) {
                      $content = file_get_contents($url);
          
                      // Check if content retrieval was successful
                      if ($content !== false) {
                          $doc = new DOMDocument();
                          libxml_use_internal_errors(true); // Disable libxml errors
                          $doc->loadHTML($content);
                          libxml_clear_errors(); // Clear any libxml errors
          
                          $xpath = new DOMXPath($doc);
          
                          // Find the div with class "span12"
                          $span12Div = $xpath->query('//div[@class="span12"]')->item(0);
          
                          // Output the content of the found div
                          if ($span12Div) {
                              echo '<div class="span12">' . $doc->saveHTML($span12Div) . '</div>';
                          } else {
                              echo 'Div with class "span12" not found in the fetched content.';
                          }
                      } else {
                          echo 'Error fetching content from URL.';
                      }
                  } else {
                      echo 'Invalid URL.';
                  }


            }

            function get_druzstvo_url()
            {
                  return carbon_get_theme_option("cztenis_druzstva_link");
            }
      }

      $cztenis_druzstva = CZtenisDruzstva::get_instance();
      $cztenis_druzstva->initialize();
}




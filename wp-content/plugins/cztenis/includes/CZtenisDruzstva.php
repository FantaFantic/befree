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
                  ob_start();
                  include MY_PLUGIN_PATH . 'includes/templates/druzstvo.php';
                  return ob_get_clean();
            }

            function get_druzstvo_url()
            {
                  return carbon_get_theme_option("cztenis_druzstva_link");
            }

            public function replace_links($content)
            {
                  // Replace links starting with "/"
                  $content = preg_replace('/href="\/([^"]+)"/', 'href="https://www.cztenis.cz/$1" target="_blank"', $content);

                  return $content;
            }

            public function extract_main_div($divContent)
            {
                  // Use a DOM parser to extract content within div.span12
                  $doc = new DOMDocument();
                  libxml_use_internal_errors(true);
                  $doc->loadHTML($divContent);
                  libxml_clear_errors();

                  $xpath = new DOMXPath($doc);

                  // Find the div with class "span12"
                  $span12Div = $xpath->query('//div[@class="span12"]')->item(0);

                  // If the div is found, get its innerHTML
                  if ($span12Div) {
                        return $doc->saveHTML($span12Div);
                  } else {
                        return 'Div with class "span12" not found in the fetched content.';
                  }
            }

            function replace_image_links($content)
            {
                  // Replace image links with Dashicons and make them clickable
                  $content = preg_replace('/<a\s+([^>]+)><img\s+([^>]+)><\/a>/', '<a $1><span class="dashicons dashicons-code-standards"></span><span style="display:none;">$2</span></a>', $content);

                  return $content;
            }
      }

      $cztenis_druzstva = CZtenisDruzstva::get_instance();
      $cztenis_druzstva->initialize();
}




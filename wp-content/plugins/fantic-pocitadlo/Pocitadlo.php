<?php
/**
 * Plugin Name: Počítadlo PLUGIN
 * Description: Plugin pro zobrazování římského počítadla návštěv 
 * Version: 1.0
 * Author: František Kaiser +420 605 720 349
 * Author URI: mailto:fkaiser.email@gmail.com
 * Requires at least: 6.3
 * Requires PHP: 7.0
 */


if (!defined('ABSPATH')) {
      die('You cannot be here');
}

if (!class_exists('FanticPocitadlo')) {

      class FanticPocitadlo
      {
            public function __construct()
            {
                  add_shortcode('pocitadlo', array($this, 'include_pocitadlo'));
            }

            function include_pocitadlo()
            {
                  $pocet = $this->get_pocitadlo_value();

                  $this->set_pocitadlo_value($pocet + 1);

                  echo $this->number_to_abacus_string(($pocet + 1));
            }

            function number_to_abacus_string($number)
            {
                // Convert the number to Roman numerals
                function number_to_roman($number)
                {
                    $numerals = array(
                        "M" => 1000, "CM" => 900, "D" => 500, "CD" => 400,
                        "C" => 100, "XC" => 90, "L" => 50, "XL" => 40,
                        "X" => 10, "IX" => 9, "V" => 5, "IV" => 4, "I" => 1
                    );
            
                    $result = '';
                    foreach ($numerals as $key => $value) {
                        while ($number >= $value) {
                            $result .= $key;
                            $number -= $value;
                        }
                    }
            
                    return $result;
                }
            
                // Handle thousands separately
                $thousands = floor($number / 1000);
                $remainder = $number % 1000;
            
                // Convert thousands to Roman numerals
                $thousands_roman = number_to_roman($thousands);
            
                // Convert the remainder to Roman numerals
                $remainder_roman = number_to_roman($remainder);
            
                // Construct the ABACUS string
                $abacus_string = "ABACUS:$thousands_roman$remainder_roman";
            
                return $abacus_string;
            }
            public function set_pocitadlo_value(int $pocet)
            {
                  $file = plugin_dir_path(__FILE__) . "pocitadlo.inc"; // File path
                  $open_file = fopen($file, 'r+'); // Open file for reading and writing
                  rewind($open_file); // Reset file pointer
                  fwrite($open_file, $pocet); // Write updated count to file
                  fclose($open_file); // Close file
            }


            public function get_pocitadlo_value()
            {
                  $file = plugin_dir_path(__FILE__) . "pocitadlo.inc"; // File path
                  if (!file_exists($file)) {
                        $handle = fopen($file, 'w'); // Create file if it doesn't exist
                        fclose($handle);
                  }

                  $open_file = fopen($file, 'r+'); // Open file for reading and writing
                  $pocet = fread($open_file, filesize($file)); // Read file contents
                  return (int) $pocet;
            }

      }

      $pocitadlo_plugin = new FanticPocitadlo();

}
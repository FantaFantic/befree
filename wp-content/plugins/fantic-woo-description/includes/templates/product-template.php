<?php
/**
 * Custom template for displaying product content within loops.
 *
 * @package Your_Plugin
 */

global $product;

$fantic_woo_description = FanticWooDescription::get_instance();

$description_length = $fantic_woo_description->get_description_length();
// $description_length = 5;
// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>

<p>

    <?php
    echo wp_kses_post(wp_trim_words($product->get_description(), $description_length)); 
    ?>

</p>
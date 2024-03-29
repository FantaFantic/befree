<?php

if (!defined('ABSPATH')) {
      die('Neoprávněný přístup!');
}
?>



<style>
    .wrapper {
        width: 100vw;
        height: 100vh;
        overflow-x: auto;
        overflow-y: auto;
        white-space: nowrap;
    }

    .span12 {
        display: inline-block;
    }
</style>

<div class="wrapper">

<?php

$cztenis_druzstva = CZtenisDruzstva::get_instance();

$url = $cztenis_druzstva->get_druzstvo_url();

// Check if the URL is valid
if (filter_var($url, FILTER_VALIDATE_URL)) {
      $content = file_get_contents($url);

      // Check if content retrieval was successful
      if ($content !== false) {
            $content = file_get_contents($url);

            // Check if content retrieval was successful
            if ($content !== false) {
                // Extract content from within the div.span12
                $divContent = $cztenis_druzstva->extract_main_div($content);

                // Replace links in the extracted content
                $divContent = $cztenis_druzstva->replace_links($divContent);
                $divContent = $cztenis_druzstva->replace_image_links($divContent);

                // Output the modified content within the div.span12
                echo '<div class="span12">' . $divContent . '</div>';
            } else {
                  echo 'Nenalezeno.';
            }
      } else {
            echo 'Nenalezeno.';
      }
} else {
      echo 'Neexistující URL.';
}

?>

</div>

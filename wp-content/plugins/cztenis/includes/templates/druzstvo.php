<?php

if( !defined('ABSPATH') )
{
      die('Neoprávněný přístup!');
}


$cztenis_druzstva = CZtenisDruzstva::get_instance();

echo $cztenis_druzstva->get_druzstvo_url();

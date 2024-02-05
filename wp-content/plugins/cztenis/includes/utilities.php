<?php

if( !defined('ABSPATH') )
{
      die('Neoprávněný přístup!');
}

function get_plugin_options($name)
{
      return carbon_get_theme_option( $name );
}
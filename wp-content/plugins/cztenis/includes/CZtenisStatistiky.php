<?php
if (!defined('ABSPATH')){
    exit();
}
    
if (!class_exists('CZTenisStatistiky')) {

    class CZTenisStatistiky
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

            add_action('admin_enqueue_scripts', array($this, 'load_scripts'));

            
            define('CZTENIS_STATISTIKY_PATH', MY_PLUGIN_PATH . 'includes/cztenis_statistiky/');
            define('CZTENIS_STATISTIKY_URL', MY_PLUGIN_URL . 'includes/cztenis_statistiky/');
        }

        function load_scripts()
        {
            wp_enqueue_script('cztenis-statistiky', CZTENIS_STATISTIKY_URL . 'dist/bundle.js', ['jquery', 'wp-element'], wp_rand(), true);
            wp_localize_script('cztenis-statistiky', 'appLocalizer', [
                'apiUrl' => home_url('/wp-json'),
                'nonce' => wp_create_nonce('wp_rest'),
            ]);
        }
    }
    
    CZTenisStatistiky::get_instance();
}

<?php
if (!defined('ABSPATH')){
    exit();
}
    
if (!class_exists('CZTenisStatistiky')) {

    class CZTenisStatistiky
    {

        private static $instance;

        private string $reactContainerId = "cztenis-statistiky-menu-page";

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
            add_action( 'admin_menu', [ $this, 'create_admin_menu' ] );
        }
    
        public function create_admin_menu() {
            $capability = 'manage_options';
            $slug = 'cztenis-statistiky-menu-options';
    
            add_menu_page(
                __( 'React WP test', 'cztenis-statistiky' ),
                __( 'React WP test', 'cztenis-statistiky' ),
                $capability,
                $slug,
                [ $this, 'menu_page_template' ],
                'dashicons-buddicons-replies',
                3
            );
        }
    
        public function menu_page_template() {
            echo '<div class="wrap"><div id="'. $this->reactContainerId .'"></div></div>';
        }

        function load_scripts()
        {
            wp_enqueue_script('cztenis-statistiky', CZTENIS_STATISTIKY_URL . 'dist/bundle.js', ['jquery', 'wp-element'], wp_rand(), true);
            wp_localize_script('cztenis-statistiky', 'appLocalizer', [
                'apiUrl' => home_url('/wp-json'),
                'nonce' => wp_create_nonce('wp_rest'),
                'reactContainerId' => $this->reactContainerId,
            ]);
        }
    }
    
    CZTenisStatistiky::get_instance();
}

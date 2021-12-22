<?php
if( ! class_exists( 'ww7_syonet_api_ajax' ) ){

    class ww7_syonet_api_ajax{
    
    private $plugin_slug;
    private $plugin_slug_db;
    private $plugin_dir;

        public function __construct( $slug, $slug_db, $dir ){

            $this->plugin_slug = $slug;
            $this->plugin_slug_db = $slug_db;
            $this->plugin_dir = $dir;


            $ajax_action = 'getData_ajax';
            add_action( "wp_ajax_$ajax_action", [ $this, 'getData_ajax' ] );
            add_action( "wp_ajax_nopriv_$ajax_action", [ $this, 'getData_ajax' ] );

            add_action( 'wp_enqueue_scripts', [ $this, 'addTheScript' ] );
            add_action( 'wp_enqueue_scripts', [ $this, 'addTheScript' ] );

        }

        public function addTheScript(){

            wp_enqueue_script( 
                $this->plugin_slug_db . '_script',
                plugins_url( $this->plugin_slug . '/public/js/pfr-c7-ajax.js' ),
                ['jquery'],
                '',
                false
            );
            
            wp_localize_script( 
                $this->plugin_slug_db . '_script',
                'script_ajax',
                [ 'ajax_url' => admin_url( 'admin-ajax.php' ) ]
            );
        
        }

        public function getData_ajax(){

            require_once $this->plugin_dir . 'includes/' . $this->plugin_slug . '-connection.php';
        
        }
    }

}
?>
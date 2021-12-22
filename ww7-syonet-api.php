<?php

/*
 * Plugin Name:       WW7 - Syonet API
 * Plugin URI:        https://ww7.group7.digital
 * Description:       Cria uma cópia de envio de formulário para o sistema da Syonet.
 * Version:           0.0.9
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Pedro figueira - Ruivo
 * Author URI:        https://github.com/PedroFigueiraRuivo
 * Text Domain:       ww7-syonet-api
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

if( !defined( 'PFR__WWW7_SA_VERSION' ) ){
    define( 'PFR__WWW7_SA_VERSION', '0.0.9' );
}

if( !defined( 'PFR__WWW7_SA_NAME' ) ){
    define( 'PFR__WWW7_SA_NAME', 'WW7 - Syonet API' );
}

if( !defined( 'PFR__WWW7_SA_SLUG' ) ){
    define( 'PFR__WWW7_SA_SLUG', 'ww7-syonet-api' );
}

if( !defined( 'PFR__WWW7_SA_SLUG_DB' ) ){
    define( 'PFR__WWW7_SA_SLUG_DB', 'ww7_syonet_api' );
}

if( !defined( 'PFR__WWW7_SA_Basename' ) ){
    define( 'PFR__WWW7_SA_Basename', plugin_basename( __FILE__ ) );
}

if( !defined( 'PFR__WWW7_SA_DIR' ) ){
    define( 'PFR__WWW7_SA_DIR', plugin_dir_path( __FILE__ ) );
}

if( !defined( 'PFR__WWW7_SA_ADMIN_FIELDS' ) ){
    define( 
        'PFR__WWW7_SA_ADMIN_FIELDS', 
        [

            [ // table 1
                'Login Settings',
                [ 'login_name', 'Login Name', 'Username', 'text' ], 
                [ 'login_pass', 'Login Pass', 'Password', 'password' ] 
            ],
        
            [ // table 2
                'Integration',
                [ 'url_wsdl', 'URL of wsdl', 'webservice integration link', 'text' ],
            ],
        
            [ // table 3
                'Connection Settings',
                [ 'client_domain', 'Domain client', 'Client Domain', 'text' ],
                [ 'event_group', 'Event group', 'Event Group', 'text' ],
                [ 'event_type', 'Event type', 'Event Type', 'text' ],
                [ 'media', 'Media', 'Media', 'text' ],
                [ 'origin', 'Origin', 'Origin', 'text' ]
            ]
        
        ]
    );
}


require_once PFR__WWW7_SA_DIR . 'includes/class-' . PFR__WWW7_SA_SLUG . '-ajax.php';
require_once PFR__WWW7_SA_DIR . 'includes/class-' . PFR__WWW7_SA_SLUG . '-shortcode.php';

$pfr__ww7_syonet_api_ajax = new ww7_syonet_api_ajax( PFR__WWW7_SA_SLUG, PFR__WWW7_SA_SLUG_DB, PFR__WWW7_SA_DIR );
$pfr__ww7_syonet_api_shortcode = new ww7_syonet_api_shortcode( PFR__WWW7_SA_SLUG, PFR__WWW7_SA_SLUG_DB );

if( is_admin() ){
    require_once PFR__WWW7_SA_DIR . 'includes/class-' . PFR__WWW7_SA_SLUG . '-admin.php';
    
    $pfr__ww7_syonet_api_admin = new ww7_syonet_api_admin( PFR__WWW7_SA_NAME, PFR__WWW7_SA_Basename, PFR__WWW7_SA_SLUG, PFR__WWW7_SA_SLUG_DB, PFR__WWW7_SA_VERSION, PFR__WWW7_SA_ADMIN_FIELDS );
}

?>
<?php

if( ! class_exists( 'ww7_syonet_api_admin' ) ){

    class ww7_syonet_api_admin{

        private $options;
        private $plugin_name;
        private $plugin_basename;
        private $plugin_slug;
        private $plugin_slug_db;
        private $plugin_version;
        private $argsFields;

        public function __construct( $name, $basename, $slug, $slug_db, $version, $fieldsConfig ){
            $this->options          = get_option( 'ww7_syonet_api' );
            $this->plugin_name      = $name;
            $this->plugin_basename  = $basename;
            $this->plugin_slug      = $slug;
            $this->plugin_slug_db   = $slug_db;
            $this->plugin_version   = $version;
            $this->argsFields       = $fieldsConfig;

            add_action( 'admin_menu', [ $this, 'pfr__wsa__addPluginPage' ] );
            add_action( 'admin_init', [ $this, 'pfr__wsa__pageInit' ] );
            add_action( 'admin_footer_text', [ $this, 'pfr__wsa__pageFooter' ] );
            add_filter( 'plugin_action_links_' . $this->plugin_basename, [ $this, 'pfr_add_settings_link' ] );
        }

        public function pfr__wsa__addPluginPage(){
            add_menu_page(
                __( 'Settings: ' . $this->plugin_name ),
                $this->plugin_name,
                'manage_options',
                $this->plugin_slug,
                [ $this, 'pfr__wsa__pageOptions' ],
                plugins_url( $this->plugin_slug . '/public/img/ico1.png' )
            );
        }

        public function pfr__wsa__pageOptions(){
            ?>
            <div class="wrap">
                <h1><?php echo $this->plugin_name; ?></h1>
                <form method="post" action="options.php">
                    <?php
                    settings_fields( $this->plugin_slug_db . '_options' );
                    do_settings_sections( $this->plugin_slug . '-admin' );
                    submit_button( 'Submit' );
                    ?>
                </form>
            </div>
            <?php
        }

        public function pfr__wsa__pageInit(){

            register_setting(
                $this->plugin_slug_db . '_options',
                $this->plugin_slug_db,
                [ $this, 'sanitize' ]
            );

            for( $II = 0; $II < count( $this->argsFields ); $II++ ){

                add_settings_section( 
                    ( 'settings_section_id_' . ( $II + 1 ) ),
                    __( $this->argsFields[ $II ][ 0 ], $this->plugin_slug ),
                    null,
                    $this->plugin_slug . '-admin'
                );

                for( $JJ = 1; $JJ < count( $this->argsFields[ $II ] ); $JJ++ ){

                    add_settings_field(
                        $this->argsFields[ $II ][ $JJ ][ 0 ],
                        __( $this->argsFields[ $II ][ $JJ ][ 1 ], $this->plugin_slug ),
                        [ $this, 'pfr_callback' ],
                        $this->plugin_slug . '-admin',
                        ( 'settings_section_id_' . ( $II + 1 ) ),
                        [ //args
                            'base'          => $this->argsFields[ $II ][ $JJ ][ 0 ],
                            'description'   => $this->argsFields[ $II ][ $JJ ][ 2 ],
                            'typeField'     => $this->argsFields[ $II ][ $JJ ][ 3 ]
                        ]
                    );

                }

            }

        }

        public function pfr_callback( $args ){

            $value = isset( $this->options[ $args[ 'base' ] ] ) ? esc_attr( $this->options[ $args[ 'base' ] ] ) : '';

            ?>
            
            <input type="<?php echo $args[ 'typeField' ] ?>" id="<?php echo $args[ 'base' ] ?>" name="<?php echo $this->plugin_slug_db . '[' . $args[ 'base' ] . ']' ;?>"  value="<?php echo $value; ?>" class="regular-text"><br>
            <p class="description"><?php echo __( $args[ 'description' ] . ' - defined by syonet', $this->plugin_slug ); ?></p>
            
            <?php

        }

        public function sanitize( $input ){
            $new_input = [];

            for( $II = 0; $II < count( $this->argsFields ); $II++ ){
                for( $JJ = 1; $JJ < count( $this->argsFields[ $II ] ); $JJ++ ){

                    if( isset( $input[ $this->argsFields[ $II ][ $JJ ][ 0 ] ] ) ){
                        $new_input[ $this->argsFields[ $II ][ $JJ ][ 0 ] ] = sanitize_text_field( $input[ $this->argsFields[ $II ][ $JJ ][ 0 ] ] );
                    }

                }
            }

            return $new_input;
        }
        

        public function pfr__wsa__pageFooter(){
            return __( 'WW7 - Syonet API: v', $this->plugin_slug ) . $this->plugin_version;
        }

        public function pfr_add_settings_link( $links ){
            $settings_link = '<a href="options-general.php?page=' . $this->plugin_slug . '">' . __( 'Settings', $this->plugin_slug ) . '</a>';
            array_unshift( $links, $settings_link );
            return $links;
        }
    }
}

?>
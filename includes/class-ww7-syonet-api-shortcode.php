<?php

if( ! class_exists( 'ww7_syonet_api_shortcode' ) ){

    class ww7_syonet_api_shortcode{
    
    private $plugin_slug;
    private $plugin_slug_db;

        public function __construct( $slug, $slug_db ){

            $this->plugin_slug = $slug;
            $this->plugin_slug_db = $slug_db;


            add_shortcode( $this->plugin_slug, [ $this, 'pfr__theShortcode_C7' ] );

        }

        public function pfr__theShortcode_C7( $args, $content = null ){

            if( $args ){

                extract( $args );

                if( isset( $form ) && $form == 'C7' ){

                    $shortcode_unique_id = $this->plugin_slug_db . '_shortcode' . wp_rand( 1, 1000 );

                    $content = "
                    <script>

                        const divToButtonSubmit = document.getElementById('ww7syonetapi_submit');

                        if( divToButtonSubmit != null ){

                            divToButtonSubmit.children[0].setAttribute( 'onclick', 'PFR_SC__runTheAjax()' );
                        
                        }

                    </script>
                    ";
                    return $content;
                }else{
                    return "<script>console.error( 'WW7 - Syonet API: Incorrect parameter' );</script>";
                }
            }else{
                return "<script>console.error( 'WW7 - Syonet API: No parameters passed' );</script>";
            }
        }
    }
}
?>
<?php

// Make sure we don't expose any info if called directly
if ( !function_exists( "add_action" ) ) {
    echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
    exit;
}

//Define Dirpath for hooks
define( "DIR_PATH", plugin_dir_path( __FILE__ ) );

/**
 * Plugin Name: SIT WP SAML
 * Description:
 * Version: 1.0.0
 * Author: SIT:Jaroslav Dvořák
 **/

require_once( __DIR__ . "/../../../../vendor/autoload.php" );

use OneLogin\Saml2\Auth;
use OneLogin\Saml2\Settings;

if ( ! class_exists( "SitWpSaml" ) ) {

    class SitWpSaml {

        public function __construct() {

            add_action( "init", $this->saml_sso(), 1 );

        }

        public function saml_sso( string $backlink = "" ):bool {

            // Je SAML zapnuty?

            //
            if ( is_user_logged_in() ) {
                return true;
            }

            $settings = "";

            $auth = false;

            //$auth = new Auth( $settings );

            if ( $auth === false ) {
                //wp_redirect(home_url());
                //exit();
            }

            $auth->login( $backlink );

            return false;
        }

    }

    // instantiate the plugin class
    $sit_wp_saml = new SitWpSaml();

}

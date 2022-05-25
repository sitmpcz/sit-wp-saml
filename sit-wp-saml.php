<?php
/**
 * Plugin Name: SIT WP SAML
 * Description:
 * Version: 1.0.0
 * Author: SIT:Jaroslav Dvořák
 **/

// Make sure we don't expose any info if called directly
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

require_once( __DIR__ . "/../../../../vendor/autoload.php" );

use OneLogin\Saml2\Auth;
use OneLogin\Saml2\Settings;

add_action( "init", "saml_sso", 1 );

function saml_sso( $backlink ) {

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

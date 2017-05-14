<?php
/*
	Plugin Name: 	WP Customer Area - Authentication Forms
	Description: 	Integrate the login and registration forms to your website
	Plugin URI: 	http://wp-customerarea.com
	Version: 		4.3.0
	Author: 		MarvinLabs
	Author URI: 	http://www.marvinlabs.com
	Text Domain: 	cuarlf
	Domain Path: 	/languages
*/

/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com) */

//------------------------------------------------------------
// Main plugin detection stuff

include(dirname(__FILE__) . '/libs/cuar/cuar_commons.php');
if (cuar_is_main_plugin_missing()) return;

// End of main plugin detection stuff
//------------------------------------------------------------

define( 'CUARLF_STORE_ITEM_NAME', 	'Customer Area – Login & Register Forms' );
define( 'CUARLF_STORE_ITEM_ID', 	4253 );
define( 'CUARLF_PLUGIN_VERSION', 	'4.3.0' );

define( 'CUARLF_PLUGIN_DIR', 	WP_PLUGIN_DIR . '/customer-area-login-form' );
define( 'CUARLF_LANGUAGE_DIR', 	'customer-area-login-form/languages' );
define( 'CUARLF_INCLUDES_DIR', 	CUARLF_PLUGIN_DIR . '/src/php' );
define( 'CUARLF_PLUGIN_FILE',	CUARLF_PLUGIN_DIR . '/customer-area-login-form.php' );

// Load the addon
include_once( CUARLF_INCLUDES_DIR . '/customer-login/customer-login-addon.class.php' );
include_once( CUARLF_INCLUDES_DIR . '/customer-register/customer-register-addon.class.php' );
include_once( CUARLF_INCLUDES_DIR . '/customer-forgot-password/customer-forgot-password-addon.class.php' );
include_once( CUARLF_INCLUDES_DIR . '/customer-reset-password/customer-reset-password-addon.class.php' );

include_once( CUARLF_INCLUDES_DIR . '/widget-login.class.php' );
include_once( CUARLF_INCLUDES_DIR . '/login-form-addon.class.php' );
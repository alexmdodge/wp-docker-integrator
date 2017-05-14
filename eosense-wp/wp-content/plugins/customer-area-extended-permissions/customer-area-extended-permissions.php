<?php
/*
 	Plugin Name: 	WP Customer Area - Additional Owner Types
	Description: 	Make your private content visible to user groups and roles
	Plugin URI: 	http://wp-customerarea.com
	Version: 		4.1.2
	Author: 		MarvinLabs
	Author URI: 	http://www.marvinlabs.com
	Text Domain: 	cuarep
	Domain Path: 	/languages
*/

/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com) */

//------------------------------------------------------------
// Main plugin detection stuff

include(dirname(__FILE__) . '/libs/cuar/cuar_commons.php');
if (cuar_is_main_plugin_missing()) return;

// End of main plugin detection stuff
//------------------------------------------------------------

define( 'CUAREP_STORE_ITEM_NAME', 	'Customer Area – Extended Permissions' );
define( 'CUAREP_STORE_ITEM_ID', 	4254 );
define( 'CUAREP_PLUGIN_VERSION',    '4.1.2' );

define( 'CUAREP_PLUGIN_DIR', 	WP_PLUGIN_DIR . '/customer-area-extended-permissions' );
define( 'CUAREP_LANGUAGE_DIR', 	'customer-area-extended-permissions/languages' );
define( 'CUAREP_INCLUDES_DIR', 	CUAREP_PLUGIN_DIR . '/src/php' );
define( 'CUAREP_PLUGIN_FILE',	CUAREP_PLUGIN_DIR . '/customer-area-extended-permissions.php' );

// Load the addon
include_once( CUAREP_INCLUDES_DIR . '/user-group/user-group-addon.class.php' );
include_once( CUAREP_INCLUDES_DIR . '/extended-permissions/extended-permissions-addon.class.php' );
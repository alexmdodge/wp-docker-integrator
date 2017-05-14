<?php
/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com) */

require_once( CUARLF_INCLUDES_DIR . '/login-forms-page-addon.class.php' );

if (!class_exists('CUAR_CustomerForgotPasswordAddOn')) :

/**
 * Add-on to log the current user in
 *
 * @author Vincent Prat @ MarvinLabs
 */
class CUAR_CustomerForgotPasswordAddOn extends CUAR_LoginFormsPageAddOn {
	
	public function __construct() {
		parent::__construct( 'forgot-password', '5.0.0' );
	}
	
	public function get_form_label() {
		return __( 'Forgot Password', 'cuarlf' );
	}
		
	public function get_hint() {
		return __( 'This page allows the users to request a password reset.', 'cuarlf' );
	}	

	public function run_addon( $plugin ) {
		parent::run_addon( $plugin );	
	}

	/*------- PAGE HANDLING -----------------------------------------------------------------------------------------*/

	public function print_form_header() {
		parent::print_form_header();				
	}

	/*------- FORM HANDLING -----------------------------------------------------------------------------------------*/

	public function handle_form_submission() {
        if ( !parent::handle_form_submission() ) return;
			
		// Check captch if enabled
		if ( class_exists( "ReallySimpleCaptcha" ) ) {
			$captcha_instance = new ReallySimpleCaptcha();
							
			if ( !isset( $_POST['cuar_captcha_prefix'] ) || !isset( $_POST['captcha'] ) ) {
				$this->form_errors[] = new WP_Error( 'captcha',
				__("You must write the code displayed in the image above.", 'cuarlf' ) );
        		return;
			} else {				
				$prefix = $_POST['cuar_captcha_prefix'];
				$code = $_POST['captcha'];
				
				$captcha_checked = $captcha_instance->check( $prefix, $code );
				$captcha_instance->remove( $prefix );
				$captcha_instance->cleanup();
				
				if ( !$captcha_checked ) {
					$this->form_errors[] = new WP_Error( 'captcha', __("The code you entered is not correct.", 'cuarlf' ) );
       		 		return;
				}
			}				
		}
        
        $result = CUAR_WPLoginHelper::retrieve_password();
        if ( is_wp_error( $result ) ) {
            $this->form_errors[] = $result;
        }
        
		$lf_addon = $this->plugin->get_addon('login-forms');
		$this->form_messages[] = sprintf( __( 'An email has been sent with the instructions to reset your password. '
						. 'You can then go to the <a href="%1$s" class="alert-link">login page</a>', 'cuarlf' ), $lf_addon->get_login_url() );
		$this->should_print_form = false;
	}
}

// Make sure the addon is loaded
new CUAR_CustomerForgotPasswordAddOn();

endif; // if (!class_exists('CUAR_CustomerForgotPasswordAddOn')) :
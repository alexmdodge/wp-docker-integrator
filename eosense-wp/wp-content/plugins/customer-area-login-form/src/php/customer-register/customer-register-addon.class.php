<?php
/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com) */

require_once(CUARLF_INCLUDES_DIR . '/login-forms-page-addon.class.php');

if ( !class_exists('CUAR_CustomerRegisterAddOn')) :

    /**
     * Add-on to log the current user in
     *
     * @author Vincent Prat @ MarvinLabs
     */
    class CUAR_CustomerRegisterAddOn extends CUAR_LoginFormsPageAddOn
    {

        public function __construct()
        {
            parent::__construct('register', '5.0.0');
        }

        public function get_form_label()
        {
            return __('Register', 'cuarlf');
        }

        public function get_hint()
        {
            return __('This page allows the users to create an account', 'cuarlf');
        }

        public function run_addon($plugin)
        {
            parent::run_addon($plugin);
        }

        /*------- PAGE HANDLING -----------------------------------------------------------------------------------------*/

        public function print_form_header()
        {
            parent::print_form_header();
        }

        /*------- FORM HANDLING -----------------------------------------------------------------------------------------*/

        public function should_print_form()
        {
            if ( !get_option('users_can_register'))
            {
                echo __('Registration is disabled', 'cuarlf');

                return false;
            }

            return parent::should_print_form();
        }

        public function handle_form_submission()
        {
            if ( !get_option('users_can_register'))
            {
                $this->form_errors[] = new WP_Error('registration-disabled', __('Registration is disabled', 'cuarlf'));

                return;
            }

            if ( !parent::handle_form_submission()) return;

            if (isset($_POST['user_login']) && isset($_POST['user_email']))
            {
                $user_login = $_POST['user_login'];
                $user_email = $_POST['user_email'];

                // Check captch if enabled
                if (class_exists("ReallySimpleCaptcha"))
                {
                    $captcha_instance = new ReallySimpleCaptcha();

                    if ( !isset($_POST['cuar_captcha_prefix']) || !isset($_POST['captcha']))
                    {
                        $this->form_errors[] = new WP_Error('captcha',
                            __("You must write the code displayed in the image above.", 'cuarlf'));

                        return;
                    }
                    else
                    {
                        $prefix = $_POST['cuar_captcha_prefix'];
                        $code = $_POST['captcha'];

                        $captcha_checked = $captcha_instance->check($prefix, $code);
                        $captcha_instance->remove($prefix);
                        $captcha_instance->cleanup();

                        if ( !$captcha_checked)
                        {
                            $this->form_errors[] = new WP_Error('captcha', __("The code you entered is not correct.", 'cuarlf'));

                            return;
                        }
                    }
                }

                $errors = CUAR_WPLoginHelper::register_new_user($user_login, $user_email);
                if (is_wp_error($errors))
                {
                    $this->form_errors[] = $errors;

                    return;
                }
            }
            else
            {
                $this->form_errors[] = new WP_Error('user_login', __("You must enter a valid username and a valid email address.", 'cuarlf'));

                return;
            }

            $lf_addon = $this->plugin->get_addon('login-forms');
            $this->form_messages[] = sprintf(__('An email has been sent with the instructions to activate your account. '
                . 'You can then go to the <a href="%1$s" class="alert-link">login page</a>', 'cuarlf'), $lf_addon->get_login_url());
            $this->should_print_form = false;
        }
    }

// Make sure the addon is loaded
    new CUAR_CustomerRegisterAddOn();

endif; // if (!class_exists('CUAR_CustomerRegisterAddOn')) :
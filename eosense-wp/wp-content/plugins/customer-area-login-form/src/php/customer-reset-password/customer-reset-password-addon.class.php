<?php
/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com) */

require_once(CUARLF_INCLUDES_DIR . '/login-forms-page-addon.class.php');

if ( !class_exists('CUAR_CustomerResetPasswordAddOn')) :

    /**
     * Add-on to log the current user in
     *
     * @author Vincent Prat @ MarvinLabs
     */
    class CUAR_CustomerResetPasswordAddOn extends CUAR_LoginFormsPageAddOn
    {

        public function __construct()
        {
            parent::__construct('reset-password', '5.0.0');
        }

        public function get_form_label()
        {
            return __('Reset Password', 'cuarlf');
        }

        public function get_hint()
        {
            return __('This page allows the users to actually reset his password.', 'cuarlf');
        }

        public function run_addon($plugin)
        {
            parent::run_addon($plugin);
        }

        public function get_reset_password_url($key, $login)
        {
            $url = add_query_arg(array('key' => $key, 'login' => $login), $this->get_page_url());

            return $url;
        }

        /*------- PAGE HANDLING -----------------------------------------------------------------------------------------*/

        public function print_form_header()
        {
            parent::print_form_header();

            $key = $this->get_key();
            if ( !empty($key)) printf('<input type="hidden" name="key" value="%1$s" />', $key);

            $login = $this->get_login();
            if ( !empty($login)) printf('<input type="hidden" name="login" value="%1$s" />', $login);
        }

        /*------- FORM HANDLING -----------------------------------------------------------------------------------------*/

        private function get_key()
        {
            $key = '';
            if (isset($_GET['key'])) $key = $_GET['key'];
            if (isset($_POST['key'])) $key = $_POST['key'];

            return $key;
        }

        private function get_login()
        {
            $login = '';
            if (isset($_GET['login'])) $login = $_GET['login'];
            if (isset($_POST['login'])) $login = $_POST['login'];

            return $login;
        }

        public function handle_form_submission()
        {
            $key = $this->get_key();
            $login = $this->get_login();
            if (empty($key) || empty($login))
            {
                $this->form_messages[] = __('It seems you have not followed the link properly. Please make sure that the address includes a "key" and a "login" parameter.',
                    'cuarlf');
                $this->should_print_form = false;

                return;
            }

            if ( !parent::handle_form_submission()) return;

            $user = CUAR_WPLoginHelper::check_password_reset_key($this->get_key(), $this->get_login());

            // Is the reset key valid?
            if (is_wp_error($user))
            {
                $this->form_errors[] = $user;

                return;
            }

            // Is the new password valid?
            else if ( !isset($_POST['new-pass']) || empty($_POST['new-pass']))
            {
                $this->form_errors[] = new WP_Error('invalid', __('Password is empty!', 'cuarlf'));

                return;
            }
            // Does the confirm password match the new password?
            else if ($_POST['new-pass'] != $_POST['new-pass-confirm'])
            {
                $this->form_errors[] = new WP_Error('nomatch', __('Passwords do not match! Please try again.', 'cuarlf'));

                return;
            }
            // Everything checks out sir, update the password!
            else
            {
                $errors = null;
                do_action('validate_password_reset', $errors, $user);

                if (is_wp_error($errors))
                {
                    $this->form_errors[] = $errors;

                    return;
                }
            }

            CUAR_WPLoginHelper::reset_password($user, $_POST['new-pass']);

            $lf_addon = $this->plugin->get_addon('login-forms');
            $this->form_messages[] = sprintf(__('You can now <a href="%1$s" class="alert-link">login with your new password</a>.', 'cuarlf'),
                $lf_addon->get_login_url());
            $this->should_print_form = false;
        }
    }

// Make sure the addon is loaded
    new CUAR_CustomerResetPasswordAddOn();

endif; // if (!class_exists('CUAR_CustomerResetPasswordAddOn')) :
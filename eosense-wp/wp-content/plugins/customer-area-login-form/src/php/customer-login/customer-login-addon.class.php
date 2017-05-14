<?php
/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com) */

require_once(CUARLF_INCLUDES_DIR . '/login-forms-page-addon.class.php');

if ( !class_exists('CUAR_CustomerLoginAddOn')) :

    /**
     * Add-on to log the current user in
     *
     * @author Vincent Prat @ MarvinLabs
     */
    class CUAR_CustomerLoginAddOn extends CUAR_LoginFormsPageAddOn
    {

        public function __construct()
        {
            parent::__construct('login', '5.0.0', true, false);
        }

        public function get_form_label()
        {
            return __('Login', 'cuarlf');
        }

        public function get_hint()
        {
            return __('This page allows users to log in', 'cuarlf');
        }

        public function run_addon($plugin)
        {
            parent::run_addon($plugin);
            add_filter('cuar/routing/login-url', array(&$this, 'get_login_url'), 5, 2);
        }

        /*------- PAGE HANDLING -----------------------------------------------------------------------------------------*/

        public function print_form_header()
        {
            parent::print_form_header();

            $redirect = $this->get_requested_redirect_url();
            if ( !empty($redirect)) printf('<input type="hidden" name="redirect" value="%1$s" />', esc_url($redirect));
        }

        /*------- FORM HANDLING -----------------------------------------------------------------------------------------*/

        public function handle_form_submission()
        {
            if ( !parent::handle_form_submission()) return;

            if (isset($_POST['testcookie']) && empty($_COOKIE[TEST_COOKIE]))
            {
                $this->form_errors[] = new WP_Error('test_cookie',
                    __("Cookies are blocked or not supported by your browser. You must <a href='http://www.google.com/cookies.html'>enable cookies</a> to login here.",
                        'cuarlf'));

                return;
            }

            $user = wp_authenticate($_POST['username'], $_POST['pwd']);
            if (is_wp_error($user))
            {
                if ($user->get_error_code() == 'invalid_username')
                {
                    $lf_addon = $this->plugin->get_addon('login-forms');

                    $this->form_errors[] = new WP_Error('invalid_username', sprintf(__(
                        'The username or password you entered is incorrect. <a href="%s" title="Password Lost and Found" class="alert-link">Lost your password</a>?',
                        'cuarlf'),
                        $lf_addon->get_forgot_password_url()
                    ));

                    return;
                }
                else if ($user->get_error_code() == 'incorrect_password')
                {
                    $lf_addon = $this->plugin->get_addon('login-forms');

                    $this->form_errors[] = new WP_Error('incorrect_password', sprintf(__(
                        'The username or password you entered is incorrect. <a href="%s" title="Password Lost and Found" class="alert-link">Lost your password</a>?',
                        'cuarlf'),
                        $lf_addon->get_forgot_password_url()
                    ));

                    return;
                }
                else
                {
                    $this->form_errors[] = $user;

                    return;
                }
            }

            // We are logging in!
            $remember = (isset($_POST['remember']) && $_POST['remember'] == 'forever');
            $username = $_POST['username'];

            wp_set_current_user($user->ID, $username);
            wp_set_auth_cookie($user->ID, $remember);

            do_action('wp_login', $user->user_login, $user);

            // Redirect the user
            $redirect = $this->get_requested_redirect_url();
            $redirect_to = !empty($redirect) ? $redirect : home_url();
            $user = wp_get_current_user();
            $redirect_to = apply_filters('login_redirect', $redirect_to, $redirect_to, $user);

            wp_redirect($redirect_to);
        }

        /*------- FORM URLS ---------------------------------------------------------------------------------------------*/

        public function get_requested_redirect_url()
        {
            if (isset($_GET['redirect'])) return $_GET['redirect'];
            if (isset($_POST['redirect'])) return $_POST['redirect'];

            $cp_addon = $this->plugin->get_addon('customer-pages');

            return $cp_addon->get_page_url('customer-dashboard');
        }

        public function get_login_url($current_url = null, $redirect_to = null)
        {
            if (false == $this->get_page_id() && !is_admin())
            {
                return wp_login_url($redirect_to == null ? '' : $redirect_to);
            }

            $login_url = $this->get_page_url();
            if ($redirect_to != null && !empty($redirect_to))
            {
                $login_url = add_query_arg(array('redirect' => urlencode($redirect_to)), $login_url);
            }

            return $login_url;
        }
    }

// Make sure the addon is loaded
    new CUAR_CustomerLoginAddOn();

endif; // if (!class_exists('CUAR_CustomerLoginAddOn')) :
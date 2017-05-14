<?php
/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com) */

require_once(CUAR_INCLUDES_DIR . '/core-classes/addon.class.php');

require_once(dirname(__FILE__) . '/wp-login-helper.class.php');

if ( !class_exists('CUAR_LoginFormAddOn')) :

    /**
     * Add-on to add a login form in the customer area
     *
     * @author Vincent Prat @ MarvinLabs
     */
    class CUAR_LoginFormAddOn extends CUAR_AddOn
    {

        public function __construct()
        {
            parent::__construct('login-forms', '6.3.0');
        }

        public function get_addon_name()
        {
            return __('Authentication Forms', 'cuarlf');
        }

        public function run_addon($plugin)
        {
            $this->enable_licensing(CUARLF_STORE_ITEM_ID, CUARLF_STORE_ITEM_NAME, CUARLF_PLUGIN_FILE, CUARLF_PLUGIN_VERSION);

            add_action('init', array(&$this, 'load_textdomain'));

            if ($this->is_wordpress_url_override_enabled())
            {
                add_filter('login_url', array($this, 'override_wp_login_url'), 10, 2);
                add_filter('register_url', array($this, 'override_wp_register_url'), 10, 1);
                add_filter('lostpassword_url', array($this, 'override_wp_lostpassword_url'), 10, 2);
                add_filter('logout_url', array($this, 'override_wp_logout_url'), 10, 2);
            }

            if (is_admin())
            {
                // Settings
                add_action('cuar/core/settings/print-settings?tab=cuar_core', array(&$this, 'print_core_settings'), 20, 2);
                add_filter('cuar/core/settings/validate-settings?tab=cuar_core', array(&$this, 'validate_core_options'), 20, 3);

                add_filter('cuar/core/status/directories-to-scan', array(&$this, 'add_hook_discovery_directory'));
            }

            // Filter out the wrong urls in the reset password emails
            add_filter('retrieve_password_message', array($this, 'filter_retrieve_password_message'), 10, 2);
            add_filter('registration_complete_message', array($this, 'filter_registration_complete_message'), 10, 2);

            // Enable login using emails if needed
            if ($this->is_email_login_enabled())
            {
                remove_filter('authenticate', 'wp_authenticate_username_password', 20);
                add_filter('authenticate', array($this, 'handle_authentication'), 20, 3);
            }

            // Enable our widgets
            add_action('widgets_init', array($this, 'register_widgets'));
        }

        public function add_hook_discovery_directory($dirs)
        {
            $dirs[CUARLF_PLUGIN_DIR] = $this->get_addon_name();

            return $dirs;
        }

        /**
         * Set the default values for the options
         *
         * @param array $defaults
         *
         * @return array
         */
        public function set_default_options($defaults)
        {
            $defaults = parent::set_default_options($defaults);
            $defaults[self::$OPTION_OVERRIDE_WORDPRESS_URLS] = true;
            $defaults[self::$OPTION_ALLOW_EMAIL_LOGIN] = true;

            return $defaults;
        }

        /**
         * Load the translation file for current language.
         */
        public function load_textdomain()
        {
            $this->plugin->load_textdomain('cuarlf', 'customer-area-login-form');
        }

        /*------- WIDGETS -----------------------------------------------------------------------------------------------*/

        public function register_widgets()
        {
            register_widget("CUAR_LoginFormWidget");
        }

        /*------- SETTINGS PAGE -----------------------------------------------------------------------------------------*/

        public function is_wordpress_url_override_enabled()
        {
            return $this->plugin->get_option(self::$OPTION_OVERRIDE_WORDPRESS_URLS);
        }

        public function is_email_login_enabled()
        {
            return $this->plugin->get_option(self::$OPTION_ALLOW_EMAIL_LOGIN);
        }

        /**
         * Add our fields to the settings page
         *
         * @param CUAR_Settings $cuar_settings The settings class
         */
        public function print_core_settings($cuar_settings, $options_group)
        {
            add_settings_section(
                'cuar_authentication_forms',
                __('Authentication Forms', 'cuarlf'),
                array(&$cuar_settings, 'print_empty_section_info'),
                CUAR_Settings::$OPTIONS_PAGE_SLUG
            );

            add_settings_field(
                self::$OPTION_OVERRIDE_WORDPRESS_URLS,
                __('Override WordPress forms', 'cuarlf'),
                array(&$cuar_settings, 'print_input_field'),
                CUAR_Settings::$OPTIONS_PAGE_SLUG,
                'cuar_authentication_forms',
                array(
                    'option_id' => self::$OPTION_OVERRIDE_WORDPRESS_URLS,
                    'type'      => 'checkbox',
                    'after'     => __('Change all default WordPress URLs for the Customer Area forms.', 'cuarlf')
                        . '<p class="description">'
                        . __('If you check this box, all the links output by WordPress (for example in the <em>Meta</em> widget) will take the user to the corresponding form in the Customer Area. Use this if you would like WP Customer Area to be your main login page.',
                            'cuarlf')
                        . '</p>'
                )
            );

            add_settings_field(
                self::$OPTION_ALLOW_EMAIL_LOGIN,
                __('Login using email', 'cuarlf'),
                array(&$cuar_settings, 'print_input_field'),
                CUAR_Settings::$OPTIONS_PAGE_SLUG,
                'cuar_authentication_forms',
                array(
                    'option_id' => self::$OPTION_ALLOW_EMAIL_LOGIN,
                    'type'      => 'checkbox',
                    'after'     => __('Allow users to login by using either their username or their email address.', 'cuarlf')
                )
            );
        }

        /**
         * Validate our options
         *
         * @param CUAR_Settings $cuar_settings
         * @param array         $input
         * @param array         $validated
         *
         * @return array
         */
        public function validate_core_options($validated, $cuar_settings, $input)
        {
            $cuar_settings->validate_boolean($input, $validated, self::$OPTION_ALLOW_EMAIL_LOGIN);
            $cuar_settings->validate_boolean($input, $validated, self::$OPTION_OVERRIDE_WORDPRESS_URLS);

            return $validated;
        }

        private static $OPTION_ALLOW_EMAIL_LOGIN = 'cuar_lf_allow_email_login';
        private static $OPTION_OVERRIDE_WORDPRESS_URLS = 'cuar_lf_override_wordpress_urls';

        /*------- WP URL OVERRIDES ---------------------------------------------------------------------------------------*/

        public function override_wp_logout_url($url, $redirect)
        {
            return $this->get_logout_url($redirect);
        }

        public function override_wp_lostpassword_url($url, $redirect)
        {
            return $this->get_forgot_password_url($redirect);
        }

        public function override_wp_register_url($url)
        {
            return $this->get_register_url();
        }

        public function override_wp_login_url($url, $redirect)
        {
            return $this->get_login_url($redirect);
        }

        /*------- URL BUILDERS -------------------------------------------------------------------------------------------*/

        public function get_login_url($redirect = null)
        {
            $addon = $this->plugin->get_addon('customer-login');

            return apply_filters('cuar/authentication-forms/form-url?action=login', $addon->get_login_url(null, $redirect), $redirect);
        }

        public function get_register_url()
        {
            $addon = $this->plugin->get_addon('customer-register');

            return apply_filters('cuar/authentication-forms/form-url?action=register', $addon->get_page_url());
        }

        public function get_forgot_password_url($redirect = null)
        {
            $addon = $this->plugin->get_addon('customer-forgot-password');

            return apply_filters('cuar/authentication-forms/form-url?action=forgot-password', $addon->get_page_url());
        }

        public function get_reset_password_url($key, $login)
        {
            $addon = $this->plugin->get_addon('customer-reset-password');

            return apply_filters('cuar/authentication-forms/form-url?action=reset-password', $addon->get_reset_password_url($key, $login), $key, $login);
        }

        public function get_logout_url($redirect = null)
        {
            $addon = $this->plugin->get_addon('customer-logout');

            return apply_filters('cuar/authentication-forms/form-url?action=logout', $addon->get_page_url());
        }

        /*------- INITIALISATION -----------------------------------------------------------------------------------------*/

        /**
         * Filters out the incorrect URL's in registration email and replaces them with the ones for this add-on.
         *
         * @param $message
         *
         * @return mixed
         */
        public function filter_registration_complete_message($message)
        {
            // Only filter if sent from our own form
            if ( !isset($_POST['cuar_do_register'])) return $message;

            // Do the replacements
            if (strpos($_POST['user_login'], '@') !== false)
            {
                $user_data = get_user_by('email', trim($_POST['user_login']));
            }
            else
            {
                $login = trim($_POST['user_login']);
                $user_data = get_user_by('login', $login);
            }

            $user_login = $user_data->user_login;

            $ca_addon = $this->plugin->get_addon('customer-account');
            $reset_url = $ca_addon->get_page_url();

            $message = preg_replace('(.+wp\-login\.php.*)', $reset_url, $message);

            return $message;
        }

        /**
         * Filters out the incorrect URL's in password reset email and replaces them with the ones for this add-on.
         *
         * @param $message
         * @param $key
         *
         * @return mixed
         */
        public function filter_retrieve_password_message($message, $key)
        {
            // Only filter if sent from our own form
            if ( !isset($_POST['cuar_do_forgot_password'])) return $message;

            // Do the replacements
            if (strpos($_POST['user_login'], '@') !== false)
            {
                $user_data = get_user_by('email', trim($_POST['user_login']));
            }
            else
            {
                $login = trim($_POST['user_login']);
                $user_data = get_user_by('login', $login);
            }

            $user_login = $user_data->user_login;

            $reset_url = $this->get_reset_password_url($key, rawurlencode($user_login));

            $message = preg_replace('/<(.+wp\-login\.php.*)>/', $reset_url, $message);

            return $message;
        }

        /*------- URL BUILDERS -------------------------------------------------------------------------------------------*/

        /**
         * If an email address is entered in the username box, then look up the matching username and authenticate as per normal, using that.
         *
         * @param string $user
         * @param string $username
         * @param string $password
         *
         * @return Results of authenticating via wp_authenticate_username_password(), using the username found when looking up via email.
         */
        public static function handle_authentication($user, $username, $password)
        {
            if (is_a($user, 'WP_User'))
            {
                return $user;
            }

            if ( !empty($username))
            {
                $username = str_replace('&', '&amp;', stripslashes($username));
                $user = get_user_by('email', $username);
                if (isset($user, $user->user_login, $user->user_status) && 0 == (int)$user->user_status)
                {
                    $username = $user->user_login;
                }
            }

            return wp_authenticate_username_password(null, $username, $password);
        }

        public function handle_reset_password()
        {
            if ( !wp_verify_nonce($_POST["cuar_reset_password_nonce"], 'cuar_reset_password'))
            {
                die('An attempt to bypass security checks was detected! Please go back and try again.');
            }

            $errors = null;

            $user = CUAR_WPLoginHelper::check_password_reset_key($_GET['key'], $_GET['login']);

            // Is the reset key valid?
            if (is_wp_error($user))
            {
                $errors = $user;
            }
            // Is the new password valid?
            else if ( !isset($_POST['new-pass']) || empty($_POST['new-pass']))
            {
                $errors = new WP_Error('invalid', 'Password is empty!');
            }
            // Does the confirm password match the new password?
            else if ($_POST['new-pass'] != $_POST['new-pass-confirm'])
            {
                $errors = new WP_Error('nomatch',
                    'Passwords do not match! Please try again.', 'cuarlf');
            }
            // Everything checks out sir, update the password!
            else
            {
                do_action('validate_password_reset', $errors, $user);

                if ( !is_wp_error($errors) || !$errors->get_error_code())
                {
                    CUAR_WPLoginHelper::reset_password($user, $_POST['new-pass']);

                    $this->action = 'login';

                    return __('You can now login with your new password', 'cuarlf');
                }
            }

            return $errors;
        }

        /**
         * Print the requested form
         */
        public function print_form()
        {
            $errors = $this->errors;
            $action = $this->get_action();
            $redirect_url = isset($_GET['redirect']) ? $_GET['redirect'] : $this->get_customer_area_url();

            switch ($action)
            {
                case 'register': // Register user if allowed
                    if ( !get_option('users_can_register'))
                    {
                        $errors = new WP_Error('disabled',
                            __('User registration is disabled on this site.', 'cuarlf'));

                        $template = $this->plugin->get_template_file_path(
                            dirname(__FILE__),
                            'login-form.template.php',
                            'templates');
                    }
                    else
                    {
                        $template = $this->plugin->get_template_file_path(
                            dirname(__FILE__),
                            'register-form.template.php',
                            'templates');
                    }
                    break;

                case 'reset':
                    $template = $this->plugin->get_template_file_path(
                        dirname(__FILE__),
                        'reset-password-form.template.php',
                        'templates');
                    break;

                case 'forgot':
                    $template = $this->plugin->get_template_file_path(
                        dirname(__FILE__),
                        'lost-password-form.template.php',
                        'templates');
                    break;

                case 'logout':
                case 'login':
                    $template = $this->plugin->get_template_file_path(
                        dirname(__FILE__),
                        'login-form.template.php',
                        'templates');
                    break;

                default:
                    $template = $this->plugin->get_template_file_path(
                        dirname(__FILE__),
                        'login-form.template.php',
                        'templates');
            }

            if ($template) include($template);
        }


    }

// Make sure the addon is loaded
    new CUAR_LoginFormAddOn();

endif; // if (!class_exists('CUAR_LoginFormAddOn')) 

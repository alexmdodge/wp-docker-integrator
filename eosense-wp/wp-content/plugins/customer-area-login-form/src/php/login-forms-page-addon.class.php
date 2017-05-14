<?php
/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com) */

require_once(CUAR_INCLUDES_DIR . '/core-classes/addon-page.class.php');

if ( !class_exists('CUAR_LoginFormsPageAddOn')) :

    /**
     * Add-on to log the current user in
     *
     * @author Vincent Prat @ MarvinLabs
     */
    abstract class CUAR_LoginFormsPageAddOn extends CUAR_AbstractPageAddOn
    {

        public function __construct($form_id, $min_cuar_version = null, $hide_if_logged_in = true, $hide_in_menu = true)
        {
            parent::__construct('customer-' . $form_id, $min_cuar_version);

            $this->form_id = $form_id;

            $this->set_page_parameters(990, array(
                    'slug'              => 'customer-' . $form_id,
                    'hide_if_logged_in' => $hide_if_logged_in,
                    'hide_in_menu'      => $hide_in_menu,
                    'parent_slug'       => 'customer-home',
                    'requires_login'    => false
                )
            );

            $this->set_page_shortcode('customer-area-' . $form_id);
        }

        protected abstract function get_form_label();

        public function get_label()
        {
            return $this->get_form_label();
        }

        public function get_title()
        {
            return $this->get_form_label();
        }

        public function run_addon($plugin)
        {
            parent::run_addon($plugin);

            add_filter('template_redirect', array(&$this, 'handle_form_submission'), 1000);
            add_filter('template_redirect', array(&$this, 'redirect_logged_in_users'), 1001);
        }

        public function get_page_addon_path()
        {
            return CUARLF_INCLUDES_DIR . '/customer-' . $this->form_id;
        }

        /*------- FORM HANDLING -----------------------------------------------------------------------------------------*/

        public function handle_form_submission()
        {
            if ( !isset($_POST['cuar_form_id']) || $_POST['cuar_form_id'] != $this->form_id) return false;

            if ( !wp_verify_nonce($_POST["cuar_" . $this->form_id . "_nonce"], 'cuar_' . $this->form_id))
            {
                die('An attempt to bypass security checks was detected! Please go back and try again.');
            }

            return true;
        }

        public function redirect_logged_in_users()
        {
            if (is_user_logged_in() && get_queried_object_id() == $this->get_page_id())
            {
                if (isset($_GET['redirect']))
                {
                    $redirect_to = $_GET['redirect'];
                }
                else if (isset($_POST['redirect']))
                {
                    $redirect_to = $_POST['redirect'];
                }
                else
                {
                    /** @var CUAR_CustomerPagesAddOn $cp_addon */
                    $cp_addon = $this->plugin->get_addon('customer-pages');
                    $redirect_to = $cp_addon->get_page_url(apply_filters('cuar/routing/home-slug', 'customer-dashboard'));
                }
                wp_redirect($redirect_to, 302);
                exit;
            }
        }

        public function should_print_form()
        {
            if ( !empty($this->form_messages))
            {
                foreach ($this->form_messages as $msg)
                {
                    printf('<p class="alert alert-success">%s</p>', $msg);
                }
            }

            return $this->should_print_form;
        }

        /*------- PAGE HANDLING -----------------------------------------------------------------------------------------*/

        public function print_form_header()
        {
            printf('<form name="%1$s" method="post" class="cuar-form cuar-%1$s-form" action="%2$s">', $this->form_id, $this->get_page_url());

            wp_nonce_field('cuar_' . $this->form_id, 'cuar_' . $this->form_id . '_nonce');

            printf('<input type="hidden" name="cuar_form_id" value="%1$s" />', $this->form_id);

            if ( !empty($this->form_errors))
            {
                foreach ($this->form_errors as $error)
                {
                    if (is_wp_error($error))
                    {
                        printf('<p class="alert alert-warning">%s</p>', $error->get_error_message());
                    }
                    else if ($error !== false && !empty($error) && !is_array($error))
                    {
                        printf('<p class="alert alert-info">%s</p>', $error);
                    }
                }
            }
        }

        public function print_form_footer()
        {
            $form_links = $this->get_form_links();
            if ( !empty($form_links))
            {
                echo '<p class="cuar-form-links">';
                echo implode(' | ', $form_links);
                echo '</p>';
            }
            echo '</form>';
        }

        public function get_form_links()
        {
            $lf_addon = $this->plugin->get_addon('login-forms');
            $form_links = array();

            if ($this->form_id == 'reset-password') return $form_links;

            if ($this->form_id != 'login')
            {
                $form_links['login'] = sprintf('<a href="%1$s">%2$s</a>',
                    esc_attr($lf_addon->get_login_url()),
                    esc_html(__('Login', 'cuarlf'))
                );
            }

            if ($this->form_id != 'forgot-password')
            {
                $form_links['forgot-password'] = sprintf('<a href="%1$s">%2$s</a>',
                    esc_attr($lf_addon->get_forgot_password_url()),
                    esc_html(__('Forgot your password?', 'cuarlf'))
                );
            }

            if ($this->form_id != 'register' && get_option('users_can_register'))
            {
                $form_links['register'] = sprintf('<a href="%1$s">%2$s</a>',
                    esc_attr($lf_addon->get_register_url()),
                    esc_html(__('Create your account', 'cuarlf'))
                );
            }

            return apply_filters('cuar/authentication-forms/form-links', $form_links, $this->form_id);
        }

        protected $should_print_form = true;

        protected $form_id;

        protected $form_errors = array();

        protected $form_messages = array();
    }

endif; // if (!class_exists('CUAR_LoginFormsPageAddOn')) :
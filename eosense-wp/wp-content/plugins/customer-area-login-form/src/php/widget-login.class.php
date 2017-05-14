<?php
/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

require_once(CUAR_INCLUDES_DIR . '/core-classes/addon-page.class.php');

if ( !class_exists('CUAR_LoginFormWidget')) :

    /**
     * Widget to show the login form
     *
     * @author Vincent Prat @ MarvinLabs
     */
    class CUAR_LoginFormWidget extends WP_Widget
    {
        /**
         * Register widget with WordPress.
         */
        function __construct()
        {
            parent::__construct(
                'cuar_login_form',
                __('WPCA - Login form', 'cuarlf'),
                array(
                    'description' => __('Shows a login form to guest users (else, nothing)', 'cuarlf'),
                )
            );
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance)
        {
            // Don't output anything if we are logged in
            if (is_user_logged_in())
            {
                $show_when_logged_in = isset($instance['show_when_logged_in']) ? $instance['show_when_logged_in'] : 'nothing';

                switch ($show_when_logged_in) {
                    case 'logout':
                        $this->print_logout_link();
                        break;

                    case 'nothing':
                    default:
                }

                return;
            }

            echo $args['before_widget'];

            $title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '');
            if ( !empty($title))
            {
                echo $args['before_title'] . $title . $args['after_title'];
            }

            $this->print_login_form();

            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         *
         * @return string|void
         */
        public function form($instance)
        {
            if (isset($instance['title']))
            {
                $title = $instance['title'];
            }
            else
            {
                $title = '';
            }

            if (isset($instance['show_when_logged_in']))
            {
                $show_when_logged_in = $instance['show_when_logged_in'];
            }
            else
            {
                $show_when_logged_in = 'nothing';
            }
            ?>

            <?php
            $field_id = $this->get_field_id('title');
            $field_name = $this->get_field_name('title');
            ?>
            <p>
                <label for="<?php echo $field_id; ?>"><?php _e('Title:', 'cuarlf'); ?></label>
                <input class="widefat" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>" type="text" value="<?php echo esc_attr($title); ?>">
            </p>

            <?php
            $field_id = $this->get_field_id('show_when_logged_in');
            $field_name = $this->get_field_name('show_when_logged_in');
            ?>
            <p>
                <label for="<?php echo $field_id; ?>"><?php _e('When logged-in:', 'cuarlf'); ?></label>
                <select class="widefat" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>">
                    <option value="nothing" <?php selected('nothing', $show_when_logged_in); ?>><?php _e('Hide widget', 'cuarlf'); ?></option>
                    <option value="logout" <?php selected('logout', $show_when_logged_in); ?>><?php _e('Show logout link', 'cuarlf'); ?></option>
                </select>
            </p>
            <?php
        }

        public function print_logout_link()
        {
            /** @var CUAR_CustomerPagesAddOn $cp_addon */
            $cp_addon = cuar_addon('customer-pages');

            printf('<a href="%1$s">%2$s</a>',
                $cp_addon->get_page_url('customer-logout'),
                __('Logout', 'cuarlf'));
        }

        public function print_login_form()
        {
            /** @var CUAR_CustomerLoginAddOn $cl_addon */
            $cl_addon = cuar_addon('customer-login');
            $cl_addon->print_page_content();
        }
    }

endif; // if (!class_exists('CUAR_PrivateFileCategoriesWidget')) 

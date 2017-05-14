<?php
/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com) */

require_once(CUAR_INCLUDES_DIR . '/core-classes/addon.class.php');

require_once(dirname(__FILE__) . '/user-group-admin-interface.class.php');

if ( !class_exists('CUAR_UserGroupAddOn')) :

    /**
     * Add-on to put user groups in the customer area
     *
     * @author Vincent Prat @ MarvinLabs
     */
    class CUAR_UserGroupAddOn extends CUAR_AddOn
    {

        public function __construct()
        {
            parent::__construct('user-group', '5.0.0');
        }

        public function get_addon_name()
        {
            return __('User Groups', 'cuarep');
        }

        public function run_addon($plugin)
        {
            add_action('init', array(&$this, 'register_custom_types'));
            add_filter('cuar/core/permission-groups', array(&$this, 'get_configurable_capability_groups'));

            add_action('delete_user', array(&$this, 'before_user_deleted'));

            add_action('cuar/core/admin/submenu-items?group=users', array(&$this, 'add_menu_items'), 13);

            // Init the admin interface if needed
            if (is_admin())
            {
                $this->admin_interface = new CUAR_UserGroupAdminInterface($plugin, $this);
            }
            else
            {
            }
        }

        /*------- ADMIN MENU --------------------------------------------------------------------------------------------*/

        /**
         * Add the menu item
         *
         * @param $submenus
         *
         * @return array
         */
        public function add_menu_items($submenus)
        {
            $post_type = get_post_type_object('cuar_user_group');

            $item = array(
                'page_title' => __($post_type->labels->name, 'cuarep'),
                'title'      => __($post_type->labels->name, 'cuarep'),
                'slug'       => 'edit.php?post_type=' . $post_type->name,
                'function'   => null,
                'capability' => 'cuar_ug_read'
            );

            $item['children'] = array();
            $item['children'][] = array(
                'title' => sprintf(__('All %s', 'cuarep'), strtolower(__($post_type->labels->name, 'cuarep'))),
                'slug'  => 'list-' . $post_type->name,
                'href'  => admin_url('edit.php?post_type=' . $post_type->name)
            );
            $item['children'][] = array(
                'title' => sprintf(__('New %s', 'cuarep'), strtolower(__($post_type->labels->singular_name, 'cuarep'))),
                'slug'  => 'new-' . $post_type->name,
                'href'  => admin_url('post-new.php?post_type=' . $post_type->name)
            );

            $submenus[] = $item;

            return $submenus;
        }

        /*------- FUNCTIONS TO ACCESS THE GROUPS ------------------------------------------------------------------------*/

        /**
         * Get all the user groups in the system
         *
         * @return array An array of posts
         */
        public function get_all_groups()
        {
            // Use WordPress to bring back the projects
            $groups = get_posts(array(
                'post_type'   => "cuar_user_group",
                'numberposts' => -1
            ));

            return $groups;
        }

        /**
         * Get the groups to which a user belongs
         *
         * @param int $user_id The user we are interested about
         *
         * @return array An array of posts
         */
        public function get_groups_of_user($user_id)
        {
            $groups = get_posts(array(
                'post_type'   => "cuar_user_group",
                'numberposts' => -1,
                'orderby'     => 'title',
                'order'       => 'ASC',
                'meta_query'  => array(
                    array(
                        'key'     => self::$META_GROUP_MEMBERS,
                        'value'   => '|' . $user_id . '|',
                        'compare' => 'LIKE'
                    )
                )
            ));

            return $groups;
        }

        /**
         * Persist the group members
         *
         * @param int   $group_id
         * @param array $user_ids
         */
        public function set_group_members($group_id, $user_ids)
        {
            update_post_meta($group_id, self::$META_GROUP_MEMBERS, $this->encode_members($user_ids));
        }

        /**
         * Retrieve the group members
         *
         * @param int $group_id
         *
         * @return array the user ids
         */
        public function get_group_members($group_id)
        {
            return $this->decode_members(get_post_meta($group_id, self::$META_GROUP_MEMBERS, true));
        }

        /**
         * Add a user to a group (the group must exist)
         *
         * @param unknown $user_id
         * @param unknown $group_id
         */
        public function add_user_to_group($user_id, $group_id)
        {
            $members = $this->get_group_members($group_id);

            // Already a member
            if (in_array($user_id, $members))
            {
                return;
            }

            $members[] = $user_id;
            $this->set_group_members($group_id, $members);
        }

        /**
         * Remove a user from a group (the group must exist)
         *
         * @param unknown $user_id
         * @param unknown $group_id
         */
        public function remove_user_from_group($user_id, $group_id)
        {
            $members = $this->get_group_members($group_id);

            // Not a member
            if ( !in_array($user_id, $members))
            {
                return;
            }

            $members = array_diff($members, array($user_id));
            $this->set_group_members($group_id, $members);
        }

        /**
         * Decode an array of users/user groups as stored in the meta table. We store users in an array. The array items
         * are formed by concatenation of the role and the id (separated by |). For instance:
         * [ 'tpress_group_project_coworker|12,14,34,54|', 'tpress_group_project_leader|22,13|' ]
         */
        private function decode_members($raw)
        {
            if ( !isset($raw) || $raw == null || empty($raw))
            {
                return array();
            }

            return array_filter(explode('|', $raw));
        }

        /**
         * Encode an array of users/user groups for storage in the meta table. We expect a dictionnary where the keys are
         * user groups and values are arrays of user IDs.
         */
        private static function encode_members($user_ids)
        {
            if ( !isset($user_ids) || $user_ids == null || empty($user_ids))
            {
                $user_ids = array();
            }

            $raw = '|' . implode('|', array_filter($user_ids)) . '|';

            return $raw;
        }

        private static $META_GROUP_MEMBERS = 'cuar_group_members';

        /*------- GENERAL MAINTAINANCE FUNCTIONS ------------------------------------------------------------------------*/

        /**
         * Remove a user from a group if he is deleted
         *
         * @param int $user_id
         */
        public function before_user_deleted($user_id)
        {
            $groups = $this->get_groups_of_user($user_id);

            foreach ($groups as $group)
            {
                $users = $this->get_group_members($group->ID);
                $new_users = array_diff($users, array($user_id));
                $this->set_group_members($group->ID, $new_users);
            }
        }

        /*------- INITIALISATIONS ----------------------------------------------------------------------------------------*/

        public function get_configurable_capability_groups($capability_groups)
        {
            $capability_groups['cuar_user_group'] = array(
                'label'  => __('User Groups', 'cuarep'),
                'groups' => array(
                    'back-office' => array(
                        'group_name'   => __('Back-office', 'cuarep'),
                        'capabilities' => array(
                            'cuar_ug_edit'         => __('Create/Edit user groups', 'cuarep'),
                            'cuar_ug_delete'       => __('Delete user groups', 'cuarep'),
                            'cuar_ug_read'         => __('Access user groups', 'cuarep'),
                            'cuar_ug_view_profile' => __('View the groups from a user profile', 'cuarep'),
                            'cuar_ug_edit_profile' => __('Edit the groups from a user profile', 'cuarep')
                        )
                    ),
                )
            );

            return $capability_groups;
        }

        /**
         * Register the custom post type for files and the associated taxonomies
         */
        public function register_custom_types()
        {
            $labels = array(
                'name'               => _x('User Groups', 'cuar_user_group', 'cuarep'),
                'singular_name'      => _x('User Group', 'cuar_user_group', 'cuarep'),
                'add_new'            => _x('Add New', 'cuar_user_group', 'cuarep'),
                'add_new_item'       => _x('Add New User Group', 'cuar_user_group', 'cuarep'),
                'edit_item'          => _x('Edit User Group', 'cuar_user_group', 'cuarep'),
                'new_item'           => _x('New User Group', 'cuar_user_group', 'cuarep'),
                'view_item'          => _x('View User Group', 'cuar_user_group', 'cuarep'),
                'search_items'       => _x('Search User Groups', 'cuar_user_group', 'cuarep'),
                'not_found'          => _x('No user groups found', 'cuar_user_group', 'cuarep'),
                'not_found_in_trash' => _x('No user groups found in Trash', 'cuar_user_group', 'cuarep'),
                'parent_item_colon'  => _x('Parent User Group:', 'cuar_user_group', 'cuarep'),
                'menu_name'          => _x('User Groups', 'cuar_user_group', 'cuarep'),
            );

            $args = array(
                'labels'              => $labels,
                'hierarchical'        => false,
                'supports'            => array('title'),
                'taxonomies'          => array(),
                'public'              => false,
                'show_ui'             => true,
                'show_in_menu'        => false,
                'show_in_nav_menus'   => false,
                'publicly_queryable'  => false,
                'exclude_from_search' => true,
                'has_archive'         => false,
                'can_export'          => false,
                'rewrite'             => false,
                'capabilities'        => array(
                    'edit_post'          => 'cuar_ug_edit',
                    'edit_posts'         => 'cuar_ug_edit',
                    'edit_others_posts'  => 'cuar_ug_edit',
                    'publish_posts'      => 'cuar_ug_edit',
                    'read_post'          => 'cuar_ug_read',
                    'read_private_posts' => 'cuar_ug_read',
                    'delete_post'        => 'cuar_ug_delete',
                    'delete_posts'       => 'cuar_ug_delete'
                )
            );

            register_post_type('cuar_user_group',
                apply_filters('cuar/content-container/groups/register-post-type-args', $args));
        }

        /** @var CUAR_UserGroupAdminInterface */
        private $admin_interface;
    }

// Make sure the addon is loaded
    new CUAR_UserGroupAddOn();

endif; // if (!class_exists('CUAR_UserGroupAddOn')) 

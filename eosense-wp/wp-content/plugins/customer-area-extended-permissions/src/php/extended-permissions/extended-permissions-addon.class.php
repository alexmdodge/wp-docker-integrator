<?php
/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com) */

require_once( CUAR_INCLUDES_DIR . '/core-classes/addon.class.php' );

if (!class_exists('CUAR_ExtendedPermissionsAddOn')) :

/**
 * Add-on to allow setting user groups or user roles as owner of a private content
*
* @author Vincent Prat @ MarvinLabs
*/
class CUAR_ExtendedPermissionsAddOn extends CUAR_AddOn {
	
	public function __construct() {
		parent::__construct( 'extended-permissions', '6.0.0' );
	}
	
	public function get_addon_name() {
		return __( 'Additional owner types', 'cuarep' );
	}

	public function run_addon( $plugin ) {
		$this->enable_licensing( CUAREP_STORE_ITEM_ID, CUAREP_STORE_ITEM_NAME, CUAREP_PLUGIN_FILE, CUAREP_PLUGIN_VERSION );
		
		add_action( 'init', array( &$this, 'load_textdomain' ) );
		
		add_filter( 'cuar/core/ownership/content/meta-query', array( &$this, 'extend_private_posts_meta_query' ), 10, 2 );
		add_filter( 'cuar/core/ownership/owner-types', array( &$this, 'declare_new_owner_types' ) );
		add_filter( 'cuar/core/ownership/real-user-ids?owner-type=rol', array( &$this, 'get_post_owner_user_ids_from_rol' ), 10, 2 );
		add_filter( 'cuar/core/ownership/real-user-ids?owner-type=grp', array( &$this, 'get_post_owner_user_ids_from_grp' ), 10, 2 );
		add_filter( 'cuar/core/ownership/validate-post-ownership', array( &$this, 'is_user_owner_of_post' ), 10, 5 );
		add_action( 'cuar/core/ownership/printable-owners?owner-type=rol', array( &$this, 'get_printable_owners_for_type_rol'), 10 );
		add_action( 'cuar/core/ownership/printable-owners?owner-type=grp', array( &$this, 'get_printable_owners_for_type_grp'), 10 );
		add_filter( 'cuar/core/ownership/enable-multiple-select?owner-type=usr', array( &$this, 'enable_multiple_select_for_type_usr'), 10, 2);
		add_filter( 'cuar/core/ownership/enable-multiple-select?owner-type=grp', array( &$this, 'enable_multiple_select_for_type_grp'), 10, 2);
		add_filter( 'cuar/core/ownership/enable-multiple-select?owner-type=rol', array( &$this, 'enable_multiple_select_for_type_rol'), 10, 2);
		add_action( 'cuar/core/ownership/saved-displayname', array( &$this, 'saved_post_owner_displayname'), 10, 4);	

		if ( is_admin() ) {
			add_filter( 'cuar/core/status/directories-to-scan', array( &$this, 'add_hook_discovery_directory' ) );
		}		
	}	
	
	public function add_hook_discovery_directory( $dirs ) {
		$dirs[ CUAREP_PLUGIN_DIR ] = $this->get_addon_name();
		return $dirs;
	}
	
	/**
	 * Set the default values for the options
	 * 
	 * @param array $defaults
	 * @return array
	 */
	public function set_default_options( $defaults ) {
		$defaults = parent::set_default_options($defaults);	
		return $defaults;
	}
	
	/*------- EXTEND THE OWNER TYPES AVAILABLE ----------------------------------------------------------------------*/
	
	/**
	 * Give the display name for our owner types
	 */
	public function saved_post_owner_displayname( $displayname, $post_id, $post_owner_ids, $post_owner_type ) {
		$names = array();
		
		if ( $post_owner_type=='rol' ) {
			global $wp_roles;
			if ( !isset( $wp_roles ) ) $wp_roles = new WP_Roles();
			
			foreach ( $post_owner_ids as $rid ) {
				if ( isset( $wp_roles->role_names[ $rid ] ) ) {
					$names[] = translate_user_role( $wp_roles->role_names[ $rid ] );
				}
			}
		} else if ( $post_owner_type=='grp' ) {
			foreach ( $post_owner_ids as $gid ) {
				$title = get_the_title( $gid );
				if ( $title!=null && !empty( $title ) ) $names[] = $title;
			}
		}	
		asort( $names );	
		return empty( $names ) ? $displayname : implode( ", ", $names );
	}
	
	/**
	 * Check if a user owns the given post
	 * 
	 * @param boolean $initial_result
	 * @param int $post_id
	 * @param int $user_id
	 * @param string $post_owner_type
	 * @param string $post_owner_id
	 * @return boolean true if the user owns the post
	 */
	public function is_user_owner_of_post( $initial_result, $post_id, $user_id, $post_owner_type, $post_owner_ids ) {
		if ( $initial_result ) return true;
		
		// If post owner type is a role, check the user has the given role
		if ( $post_owner_type=='rol' ) {
			$user = new WP_User( $user_id );
			$user_roles = $user->roles;
			if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
				foreach ( $user->roles as $role ) {
					if ( in_array( $role, $post_owner_ids ) ) return true;
				}
			}
		} else if ( $post_owner_type=='grp' ) {
			$ug_addon = $this->plugin->get_addon( 'user-group' );
			$user_groups = $ug_addon->get_groups_of_user( $user_id );
			
			if ( !empty( $user_groups ) && is_array( $user_groups ) ) {
				foreach ( $user_groups as $g ) {
					if ( in_array( $g->ID, $post_owner_ids ) ) return true;
				}
			}
		} 
		
		return false;
	}
	
	/**
	 * Print a select field with all roles
	 * @param unknown $current_owner_type
	 * @param unknown $current_owner_id
	 */
	public function get_printable_owners_for_type_rol( $in ) {
		$all_roles = apply_filters( 'cuar/core/ownership/selectable-owners?owner-type=rol', null );
		if ( null===$all_roles ) {
			global $wp_roles;
			if ( !isset( $wp_roles ) ) $wp_roles = new WP_Roles();
			$all_roles = $wp_roles->role_names;
		}
			
		$out = $in;
		foreach ( $all_roles as $role => $name ) {
			$out[ $role ] = translate_user_role( $name );
		}
		return $out;
	}
	
	/**
	 * Print a select field with all user groups
	 * @param unknown $current_owner_type
	 * @param unknown $current_owner_id
	 */
	public function get_printable_owners_for_type_grp( $in ) {		
		$all_groups = apply_filters( 'cuar/core/ownership/selectable-owners?owner-type=grp', null );
		if ( null===$all_groups ) {
			$ug_addon = $this->plugin->get_addon( 'user-group' );
			$all_groups = $ug_addon->get_all_groups();
		}
			
		$out = $in;
		foreach ( $all_groups as $group ) {
			$out[ $group->ID ] = get_the_title( $group );
		}
		return $out;
	}
	
	public function enable_multiple_select_for_type_usr( $val ) {
		return true;
	}
	
	public function enable_multiple_select_for_type_grp( $val ) {
		return true;
	}
	
	public function enable_multiple_select_for_type_rol( $val ) {
		return true;
	}
	
	/**
	 * Extend the meta query to fetch private posts belonging to a user (also fetches the posts for his role and 
	 * groups)
	 * 
	 * @param array $base_meta_query
	 * @param int $user_id The user we want to fetch private posts for
	 * 
	 * @return array
	 */
	public function extend_private_posts_meta_query( $base_meta_query, $user_id ) {
		// For roles
		$roles_meta_query = array();		
		$user = new WP_User( $user_id );
		$user_roles = $user->roles;
		if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
			foreach ( $user->roles as $role ) {
				$roles_meta_query[] = array(
						'key' 		=> CUAR_PostOwnerAddOn::$META_OWNER_QUERYABLE,
						'value' 	=> '|rol_' . $role . '|',
						'compare' 	=> 'LIKE'
					);
			}
		}
		
		// For user groups
		$groups_meta_query = array();
		$ug_addon = $this->plugin->get_addon( 'user-group' );
		$user_groups = $ug_addon->get_groups_of_user( $user_id );
			
		if ( !empty( $user_groups ) && is_array( $user_groups ) ) {
			foreach ( $user_groups as $g ) {
				$groups_meta_query[] = array(
						'key' 		=> CUAR_PostOwnerAddOn::$META_OWNER_QUERYABLE,
						'value' 	=> '|grp_' . $g->ID . '|',
						'compare' 	=> 'LIKE'
					);
			}
		}

		// Deal with all this
		return array_merge( $base_meta_query, $roles_meta_query, $groups_meta_query );
	}
	
	/**
	 * Declare the new owner types managed by this add-on
	 * 
	 * @param array $types the existing types
	 * @return array The existing types + our types
	 */
	public function declare_new_owner_types( $types ) {
		$new_types = array(
				'rol' 	=> __('Role', 'cuarep'),
				'grp' 	=> __('User Group', 'cuarep')
			);

		return array_merge( $types, $new_types );
	}
	
	/**
	 * Return all user IDs that belong to the given role
	 * 
	 * @param array $users the initial users
	 * @param string $role_id The role id
	 * @return array
	 */
	public function get_post_owner_user_ids_from_rol( $users, $role_ids ) {
		$all_users = $users;
		
		foreach ( $role_ids as $role_id ) {
			$users_for_role = get_users( array( 
					'role' 		=> $role_id,
					'fields' 	=> 'ID',
					'orderby'	=> 'display_name' ) );
			
			$all_users = array_merge( $all_users, $users_for_role );
		}
				
		return array_unique( $all_users, SORT_REGULAR );
	}
	
	/**
	 * Return all user IDs that belong to the given group
	 * 
	 * @param array $users the initial users
	 * @param string $role_id The role id
	 * @return array
	 */
	public function get_post_owner_user_ids_from_grp( $users, $group_ids ) {
		$ug_addon = $this->plugin->get_addon( 'user-group' );

		$all_users = $users;
		
		foreach ( $group_ids as $group_id ) {
			$users_for_group = $ug_addon->get_group_members( $group_id );
			
			$all_users = array_merge( $all_users, $users_for_group );
		}
				
		return array_unique( $all_users, SORT_REGULAR );
	}
	
	/*------- INITIALISATION ----------------------------------------------------------------------------------------*/
		
	/**
	 * Load the translation file for current language.
	 */
	public function load_textdomain() {
		$this->plugin->load_textdomain( 'cuarep', 'customer-area-extended-permissions' );
	}
}

// Make sure the addon is loaded
new CUAR_ExtendedPermissionsAddOn();

endif; // if (!class_exists('CUAR_ExtendedPermissionsAddOn')) 

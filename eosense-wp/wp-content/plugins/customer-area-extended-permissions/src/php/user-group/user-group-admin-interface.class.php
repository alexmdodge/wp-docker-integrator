<?php
/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com) */

require_once( CUAR_INCLUDES_DIR . '/core-classes/settings.class.php' );

if (!class_exists('CUAR_UserGroupAdminInterface')) :

/**
 * Administation area for private files
 * 
 * @author Vincent Prat @ MarvinLabs
 */
class CUAR_UserGroupAdminInterface {
	
	public function __construct( $plugin, $user_group_addon ) {
		$this->plugin = $plugin;
		$this->user_group_addon = $user_group_addon;

		// Admin menu
		add_action( "admin_footer", array( &$this, 'highlight_menu_item' ) );
		
		// Group edit page
		add_action( 'add_meta_boxes', array( &$this, 'register_edit_page_meta_boxes' ) );
		add_action( 'save_post', array( &$this, 'do_save_post' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_scripts' ) );

		// Group list page
		add_filter( "manage_edit-cuar_user_group_columns", array( &$this, 'group_column_register' ));
		add_action( "manage_cuar_user_group_posts_custom_column", array( &$this, 'group_column_display'), 10, 2 );
		
		// User profile
		add_action( 'show_user_profile', array( &$this, 'show_user_profile' ) );
		add_action( 'edit_user_profile', array( &$this, 'edit_user_profile' ) );
		add_action( 'personal_options_update', array( &$this, 'personal_options_update' ) );
		add_action( 'edit_user_profile_update', array( &$this, 'edit_user_profile_update' ) );
	}


	/*------- ADMIN MENU --------------------------------------------------------------------------------------------*/
		
	/**
	 * Highlight the proper menu item in the customer area
	 */
	public function highlight_menu_item() {
		global $post;
	
		// For posts
		if ( isset( $post ) && get_post_type( $post )=='cuar_user_group' ) {
			$highlight_top 	= '#toplevel_page_wpca';
			$unhighligh_top = '#menu-posts';
		} else {
			$highlight_top 	= null;
			$unhighligh_top = null;
		}
	
		if ( $highlight_top && $unhighligh_top ) {
			?>
	<script type="text/javascript">
	jQuery(document).ready( function($) {
		$('<?php echo $unhighligh_top; ?>')
			.removeClass('wp-has-current-submenu')
			.addClass('wp-not-current-submenu');
		$('<?php echo $highlight_top; ?>')
			.removeClass('wp-not-current-submenu')
			.addClass('wp-has-current-submenu current');
	});     
	</script>
	<?php
		}
	}


	/*------- USER PROFILE ------------------------------------------------------------------------------------------*/
	
	public function show_user_profile( $user ) {
		if ( current_user_can( 'cuar_ug_edit_profile' ) ) {
			$this->edit_user_profile( $user );
		} else if ( current_user_can( 'cuar_ug_view_profile' ) ) {
			$user_groups = $this->user_group_addon->get_groups_of_user( $user->ID );
			$is_own_profile = ( $user->ID == get_current_user_id() );
			 
			include( $this->plugin->get_template_file_path(
					CUAREP_INCLUDES_DIR . '/user-group',
					"user-groups_profile_list.template.php",
					'templates' ) );
		}
	}
	
	public function edit_user_profile( $user ) {
		if ( current_user_can( 'cuar_ug_edit_profile' ) ) {		
			$all_groups = $this->user_group_addon->get_all_groups();
			$user_groups = $this->user_group_addon->get_groups_of_user( $user->ID );
			$is_own_profile = ( $user->ID == get_current_user_id() );
			
			include( $this->plugin->get_template_file_path(
					CUAREP_INCLUDES_DIR . '/user-group',
					"user-groups_profile_edit.template.php",
					'templates' ) );
		} else if ( current_user_can( 'cuar_ug_view_profile' ) ) {
			$this->show_user_profile( $user );
		}
	}
	
	public function personal_options_update( $user_id ) {
		$this->edit_user_profile_update( $user_id );
	}
	
	public function edit_user_profile_update( $user_id ) {
		if ( !current_user_can( 'cuar_ug_edit_profile' ) ) return;
		
		$new_group_ids = isset( $_POST['cuar_group_ids'] ) && is_array( $_POST['cuar_group_ids'] ) ? $_POST['cuar_group_ids'] : array();
		$user_groups = $this->user_group_addon->get_groups_of_user( $user_id );
		
		// Remove from current groups that are not selected anymore 
		foreach ( $user_groups as $group ) {
			if ( !in_array( $group->ID, $new_group_ids ) ) {
				$this->user_group_addon->remove_user_from_group( $user_id, $group->ID );
			}
		}
		
		// Add to all groups 
		foreach ( $new_group_ids as $new_group_id ) {
			$this->user_group_addon->add_user_to_group( $user_id, $new_group_id );
		}
	}
	
	/*------- CUSTOMISATION OF THE LISTING OF POSTS -----------------------------------------------------------------*/

	/**
	 * Enqueues the select script on the user-edit and profile screens.
	 */
	public function enqueue_scripts() {
		$screen = get_current_screen();
		
		if ( isset( $screen->id ) ) {
			switch( $screen->id ) {
				case 'cuar_user_group' :
					$this->plugin->enable_library('jquery.select2');
					break;
					
				case 'user-edit' :
				case 'profile' :
					$this->plugin->enable_library('jquery.select2');
					break;
			}
		}
	}
		
	/**
	 * Register the owner column
	 */
	public function group_column_register( $columns ) {
		$columns['cuar_members'] = __( 'Members', 'cuarep' );
		return $columns;
	}
	
	/**
	 * Display the column content
	 */
	public function group_column_display( $column_name, $post_id ) {
		if ( 'cuar_members' != $column_name )
			return;

		$current_members = $this->user_group_addon->get_group_members( $post_id );
		$member_list = array();
		foreach ( $current_members as $uid ) {
			$u = new WP_User( $uid );
			$member_list[] = $u->display_name;
		}
		
		echo implode( ", ", $member_list );
	}
	
	/*------- CUSTOMISATION OF THE GROUP EDIT PAGE ------------------------------------------------------------------*/

	/**
	 * Register some additional boxes on the page to edit the files
	 */
	public function register_edit_page_meta_boxes($post_type)
	{
		if ($post_type!='cuar_user_group') return;

		add_meta_box(
				'cuar_user_group_members',
				__('Members', 'cuarep'),
				array( &$this, 'print_members_meta_box'),
				'cuar_user_group',
				'normal', 
				'high');
	}

	/**
	 * Print the metabox to set members
	 */
	public function print_members_meta_box() {
		global $post;
		wp_nonce_field( plugin_basename(__FILE__), 'wp_cuar_nonce_members' );
	
		$all_users = get_users( array( 'orderby' => 'display_name', 'fields' => 'all_with_meta' ) );
		$current_members = $this->user_group_addon->get_group_members( $post->ID );
?>		
		<div class="metabox-row">
			<span class="label"><label for="cuar_owner">
				<?php _e('Select the group members', 'cuarep'); ?></label></span>
			<br/>
			<br/>
			<select name="cuar_group_members[]" id="cuar_group_members" multiple="multiple" size="10" data-placeholder="<?php esc_attr_e('Select group members (hint: you can also type to search a user)', 'cuarep'); ?>" >
<?php 		foreach ( $all_users as $u ) : 
				$selected = in_array( $u->ID, $current_members ) ? ' selected="selected"' : '';
?>
				<option value="<?php echo $u->ID; ?>" <?php echo $selected; ?>><?php echo $u->display_name; ?></option>
<?php 		endforeach; ?>
			</select>
		</div>
		<script type="text/javascript">
		<!--
			jQuery("document").ready(function($){
				$("#cuar_group_members").select2({ 
						width:						"100%"
					});
			});
		//-->
		</script>
<?php 	
	}
	
	/**
	 * Callback to handle saving a post
	 *
	 * @param int $post_id
	 * @param string $post
	 * @return void|unknown
	 */
	public function do_save_post( $post_id, $post ) {
		global $post;
	
		// When auto-saving, we don't do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
	
		// Only take care of our own post type
		if ( !$post || get_post_type( $post->ID )!='cuar_user_group' ) return;
	
		// Save the file
		if ( !wp_verify_nonce( $_POST['wp_cuar_nonce_members'], plugin_basename(__FILE__) ) ) return $post_id;
	
		$member_ids = $_POST['cuar_group_members'];		
		$this->user_group_addon->set_group_members( $post->ID, $member_ids ) ;
		
		$this->plugin->add_admin_notice( 
				sprintf( __('This group now has %d member(s)', 'cuarep' ), count($member_ids) ),
				'updated' );
	}

	// UserGroup options
		
	/** @var CUAR_Plugin */
	private $plugin;

	/** @var CUAR_UserGroupAddOn */
	private $user_group_addon;
}

endif; // if (!class_exists('CUAR_UserGroupAdminInterface')) :
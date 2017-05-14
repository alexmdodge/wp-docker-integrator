<?php
/**
 * Ambition defining constants, adding files and WordPress core functionality.
 *
 * Defining some constants, loading all the required files and Adding some core functionality.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menu() To add support for navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
	add_action('after_setup_theme', 'ambition_setup');
	/**
	 * This content width is based on the theme structure and style.
	 */
	function ambition_setup()
	{
		global $content_width;
		if (!isset($content_width)) {
			$content_width = 770;
		}
	}
	add_action('after_setup_theme', 'ambition_featured');
	if (!function_exists('ambition_featured')):
		function ambition_featured()
		{
			// Add theme support for Jetpack Featured Content
			add_theme_support('featured-content', array(
				'featured_content_filter' => 'ambition_get_featured_posts',
				'max_posts' => 6,
			));
		}
	endif;
		add_action('ambition_init', 'ambition_constants', 10);
		/**
		 * This function defines the Ambition theme constants
		 *
		 * @since 1.0
		 */
	function ambition_constants()
	{
		/** Define Directory Location Constants */
		define('AMBITION_PARENT_DIR', get_template_directory());
		define('AMBITION_CHILD_DIR', get_stylesheet_directory());
		define('AMBITION_INC_DIR', AMBITION_PARENT_DIR . '/inc');
		define('AMBITION_ADMIN_DIR', AMBITION_INC_DIR . '/admin');
		define('AMBITION_ADMIN_JS_DIR', AMBITION_ADMIN_DIR . '/js');
		define('AMBITION_ADMIN_CSS_DIR', AMBITION_ADMIN_DIR . '/css');
		define('AMBITION_JS_DIR', AMBITION_PARENT_DIR . '/js');
		define('AMBITION_FUNCTIONS_DIR', AMBITION_INC_DIR . '/functions');
		define('AMBITION_SHORTCODES_DIR', AMBITION_INC_DIR . '/footer-info');
		define('AMBITION_STRUCTURE_DIR', AMBITION_INC_DIR . '/structure');
		if (!defined('AMBITION_LANGUAGES_DIR'))
		/** So we can define with a child theme */ {
			define('AMBITION_LANGUAGES_DIR', AMBITION_PARENT_DIR . '/languages');
		}
		define('AMBITION_WIDGETS_DIR', AMBITION_INC_DIR . '/widgets');
	}
		add_action('ambition_init', 'ambition_load_files', 15);
		/**
		 * Loading the included files.
		 *
		 * @since 1.0
		 */
	function ambition_load_files()
	{
		/**
		 * ambition_add_files hook
		 *
		 * Adding other addtional files if needed.
		 */
		do_action('ambition_add_files');
		/** Load functions */
		require_once (AMBITION_FUNCTIONS_DIR . '/i18n.php');

		require_once (AMBITION_FUNCTIONS_DIR . '/custom-header.php');

		require_once (AMBITION_FUNCTIONS_DIR . '/functions.php');

		require_once (AMBITION_FUNCTIONS_DIR . '/custom-style.php');

		require_once (AMBITION_FUNCTIONS_DIR . '/customizer.php');

		require_once (AMBITION_FUNCTIONS_DIR . '/featured-content.php');

		require_once (AMBITION_ADMIN_DIR . '/ambition-metaboxes.php');

		/** Load Footer Info */
		require_once (AMBITION_SHORTCODES_DIR . '/ambition-footer-info.php');

		/** Load Structure */
		require_once (AMBITION_STRUCTURE_DIR . '/header-extensions.php');

		require_once (AMBITION_STRUCTURE_DIR . '/footer-extensions.php');

		require_once (AMBITION_STRUCTURE_DIR . '/content-extensions.php');

		/** Load Widgets and Widgetized Area */
		require_once (AMBITION_WIDGETS_DIR . '/ambition-widgets.php');

	}
	add_action('ambition_init', 'ambition_core_functionality', 20);
	/**
	 * Adding the core functionality of WordPess.
	 *
	 * @since 1.0
	 */
	function ambition_core_functionality()
	{
		/**
		 * ambition_add_functionality hook
		 *
		 * Adding other addtional functionality if needed.
		 */
		do_action('ambition_add_functionality');
		// Add default posts and comments RSS feed links to head
		add_theme_support('automatic-feed-links');
		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support('title-tag');
		// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
		add_theme_support('post-thumbnails');
		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(array(
			'primary' => __('Primary Navigation', 'ambition') ,
			'social' => __('Social Navigation', 'ambition') ,
		));
		add_theme_support( 'infinite-scroll', array(
			'type'           => 'scroll',
			'footer_widgets' => false,
			'container'      => 'content',
			'wrapper'        => true,
			'render'         => false,
			'posts_per_page' => false,
		) );
		// Add Ambition custom image sizes
		add_image_size('ambition-featured-large', 1170, 650, true); // used to show blog image large
		add_image_size('ambition-recent-work', 670, 420, true); // used to show recent work image
		add_image_size('ambition-icon', 210, 210, true); // used to show icon image

		/**
		 * This theme supports custom background color and image
		 */
		add_theme_support('custom-background');
		// Adding excerpt option box for pages as well
		add_post_type_support('page', 'excerpt');
	}
		/**
		 * ambition_init hook
		 *
		 * Hooking some functions of functions.php file to this action hook.
		 */
		do_action('ambition_init');
	function ambition_get_featured_posts()
	{
		/**
		 * Filter the featured posts to return in Ambition.
		 * @param array|bool $posts Array of featured posts, otherwise false.
		 */
		return apply_filters('ambition_get_featured_posts', array());
	}
		/**
		 * A helper conditional function that returns a boolean value.
		 * @return bool Whether there are featured posts.
		 */
	function ambition_has_featured_posts()
	{
		return !is_paged() && (bool)ambition_get_featured_posts();
	}
function ambition_get_option_defaults() {
	global $array_of_default_settings;
	$array_of_default_settings = array(
		'design_layout' => 'on',
		'content_layout' => 'right',
		'site_title_setting' => 0,
		'img-upload-site-title' => '',
		'header_settings' => 0,
		'img-upload-header-logo' => '',
		'search_header_settings' => 0,
		'header_settings' => 'header_text',
		'img-upload-header-logo' =>'',
		'fav_settings' => 0,
		'img-upload-fav-icon' => '',
		'web_settings' => 0,
		'img-upload-webclip-icon' => '',
		'css_settings' => '',
		'disable_slider' => 0,
		'ambition_secondary_text' => '',
		'ambition_secondary_url' => '',
		'ambition_slider_content' => 'on',
		'ambition_transition_effect' => 'fade',
		'ambition_transition_delay' => '4',
		'ambition_transition_duration' => '1',
		'ambition_categories'	=>array(),
		'disable_setting'	=>0,
	);
	return apply_filters( 'ambition_get_option_defaults', $array_of_default_settings );
}
?>
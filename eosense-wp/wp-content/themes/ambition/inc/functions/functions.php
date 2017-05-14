<?php
/**
 * Ambition functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
/****************************************************************************************/
add_action('wp_enqueue_scripts', 'ambition_scripts_styles_method');
/**
 * Register jquery scripts
 */
function ambition_scripts_styles_method() {
	global $disable_slider, $ambition_settings;
	/**
	 * Loads our main stylesheet.
	 */
	// Load our main stylesheet.
	wp_enqueue_style('ambition_style', get_stylesheet_uri());
	wp_style_add_data('ambition-ie', 'conditional', 'lt IE 9');
	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	wp_enqueue_script('jquery_cycle', get_template_directory_uri().'/js/jquery.cycle.all.min.js', array('jquery'), '2.9999.5', true);
	wp_enqueue_style( 'ambition-fonts', ambition_font_url(), array(), null ); 
	/**
	 * Enqueue Slider setup js file.
	 * Enqueue Fancy Box setup js and css file.
	 */
	$disable_slider = $ambition_settings['disable_slider'];
	if ((is_home() || is_front_page()) && empty($disable_slider)) {
		wp_enqueue_script('ambition_slider', get_template_directory_uri().'/js/ambition-slider-setting.js', array('jquery_cycle'), false, true);
	}
	wp_enqueue_script('scripts', get_template_directory_uri().'/js/scripts.js', array('jquery'), false, true);
	wp_enqueue_style( 'ambition-fonts' );
}
/****************************************************************************************/
function ambition_add_editor_styles() {
	add_editor_style( array( 'editor-style.css', ambition_font_url() ) );
}
add_action( 'after_setup_theme', 'ambition_add_editor_styles' );
/****************************************************************************************/
add_action('admin_enqueue_scripts', 'ambition_media_js', 10);
/**
 * Register scripts for image upload
 *
 * Hooked to admin_print_scripts action hook
 */
function ambition_media_js( $hook ) {
    if( $hook != 'widgets.php' )
		return;
	wp_enqueue_script('ambition_meta_upload_widget', get_template_directory_uri().'/inc/admin/js/add-image-script-widget.js', array('jquery', 'media-upload', 'thickbox'), false, true);
}
/****************************************************************************************/
add_filter('wp_page_menu', 'ambition_wp_page_menu');
/**
 * Remove div from wp_page_menu() and replace with ul.
 * @uses wp_page_menu filter
 */
function ambition_wp_page_menu($page_markup) {
	preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
	$divclass   = $matches[1];
	$replace    = array('<div class="'.$divclass.'">', '</div>');
	$new_markup = str_replace($replace, '', $page_markup);
	$new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
	return $new_markup;
}
/****************************************************************************************/
if (!function_exists('ambition_pass_slider_effect_cycle_parameters')):
/**
 *Functions that Passes slider effect  parameters from php files to jquery file.
 */
function ambition_pass_slider_effect_cycle_parameters() {
	global $ambition_settings;
	$transition_effect   = $ambition_settings['ambition_transition_effect'];
	$transition_delay    = $ambition_settings['ambition_transition_delay'] *1000;
	$transition_duration = $ambition_settings['ambition_transition_duration'] * 1000;
	wp_localize_script(
		'ambition_slider',
		'ambition_slider_value',
		array(
			'transition_effect'   => $transition_effect,
			'transition_delay'    => $transition_delay,
			'transition_duration' => $transition_duration,
		)
	);
}
endif;
/****************************************************************************************/
add_filter('excerpt_length', 'ambition_excerpt_length');
/**
 * Sets the post excerpt length to 50 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function ambition_excerpt_length($length) {
	return 50;// this will return 50 words in the excerpt
}
add_filter('excerpt_more', 'ambition_continue_reading');
/**
 * Returns a "Continue Reading" link for excerpts
 */
function ambition_continue_reading() {
	return '&hellip; ';
}
add_filter('body_class', 'ambition_body_class');
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function ambition_body_class($classes) {
	global $site_layout, $content_layout, $ambition_settings,$array_of_default_settings;
	$ambition_settings = wp_parse_args(  get_option( 'ambition_theme_settings', array() ),  ambition_get_option_defaults() );
	global $post;
	if ($post) {
		$layout = get_post_meta($post->ID, 'ambition_sidebarlayout', true);
	}
	$site_layout = $ambition_settings['design_layout'];
	$content_layout = $ambition_settings['content_layout'];
	$frontpage_id = get_option('page_on_front'); // for front page
	$banner = get_post_meta( $frontpage_id, 'ambition_sidebarlayout', true );
	$page_id = ( 'page' == get_option( 'show_on_front' ) ? get_option( 'page_for_posts' ) : get_the_ID() );
	$home_blog = get_post_meta( $page_id, 'ambition_sidebarlayout', true ); 
	if (empty($layout) || is_archive() || is_search() || is_home()) {
		$layout = 'default';
	}
	if(!is_page_template('page-templates/page-template-business.php') && !is_home() && !is_front_page() ):

		if ('default' == $layout) {
			$themeoption_layout = $content_layout;
			if ('left' == $themeoption_layout) {
				$classes[] = 'left-sidebar-layout';
			}
			elseif ('right' == $themeoption_layout) {
				$classes[] = '';
			}
			elseif ('fullwidth' == $themeoption_layout) {
				$classes[] = 'full-width-layout';
			}
			elseif ('nosidebar' == $themeoption_layout) {
				$classes[] = 'no-sidebar-layout';
			}
		}elseif ('left-sidebar' == $layout) {

		$classes[] = 'left-sidebar-layout';
		}
		elseif ('right-sidebar' == $layout) {
			$classes[] = '';//css blank
		}
		elseif ('no-sidebar-full-width' == $layout) {
			$classes[] = 'full-width-layout';
		}
		elseif ('no-sidebar' == $layout) {
			$classes[] = 'no-sidebar-layout';//css for no-sidebar-layout from <body >
		}
	endif;
	if (is_page_template('page-templates/page-template-business.php')) {
		$classes[] = 'business-layout';
	}
	if (is_page_template('page-templates/page-template-contact.php')) {
			$classes[] = 'contact';
	}
	if ($site_layout =='off') {

		$classes[] = 'narrow-layout';
	}
	if(is_front_page() && $banner && !is_page_template('page-templates/page-template-business.php') ){
		if ('default' == $banner) {
			$themeoption_layout = $content_layout;
			if ('left' == $themeoption_layout) {
				$classes[] = 'left-sidebar-layout';
			}
			elseif ('right' == $themeoption_layout) {
				$classes[] = '';
			}
			elseif ('fullwidth' == $themeoption_layout) {
				$classes[] = 'full-width-layout';
			}
			elseif ('nosidebar' == $themeoption_layout) {
				$classes[] = 'no-sidebar-layout';
			}
		}elseif ('left-sidebar' == $banner) {

		$classes[] = 'left-sidebar-layout';
		}
		elseif ('right-sidebar' == $banner) {
			$classes[] = '';//css blank
		}
		elseif ('no-sidebar-full-width' == $banner) {
			$classes[] = 'full-width-layout';
		}
		elseif ('no-sidebar' == $banner) {
			$classes[] = 'no-sidebar-layout';//css for no-sidebar-layout from <body >
		}
	} elseif(is_front_page() && !is_page_template('page-templates/page-template-business.php') ) {
		if ('default' == $layout) { 
			$themeoption_layout = $content_layout;
			if ('left' == $themeoption_layout) {
				$classes[] = 'left-sidebar-layout';
			}
			elseif ('right' == $themeoption_layout) {
				$classes[] = '';
			}
			elseif ('fullwidth' == $themeoption_layout) {
				$classes[] = 'full-width-layout';
			}
			elseif ('nosidebar' == $themeoption_layout) {
				$classes[] = 'no-sidebar-layout';
			}
		}elseif ('left-sidebar' == $layout) {

		$classes[] = 'left-sidebar-layout';
		}
		elseif ('right-sidebar' == $layout) {
			$classes[] = '';//css blank
		}
		elseif ('no-sidebar-full-width' == $layout) {
			$classes[] = 'full-width-layout';
		}
		elseif ('no-sidebar' == $layout) {
			$classes[] = 'no-sidebar-layout';//css for no-sidebar-layout from <body >
		}
	} elseif(is_home()){
		if ('default' == $home_blog) {
			$themeoption_layout = $content_layout;
			if ('left' == $themeoption_layout) {
				$classes[] = 'left-sidebar-layout';
			}
			elseif ('right' == $themeoption_layout) {
				$classes[] = '';
			}
			elseif ('fullwidth' == $themeoption_layout) {
				$classes[] = 'full-width-layout';
			}
			elseif ('nosidebar' == $themeoption_layout) {
				$classes[] = 'no-sidebar-layout';
			}
		}elseif ('left-sidebar' == $home_blog) {

		$classes[] = 'left-sidebar-layout';
		}
		elseif ('right-sidebar' == $home_blog) {
			$classes[] = '';//css blank
		}
		elseif ('no-sidebar-full-width' == $home_blog) {
			$classes[] = 'full-width-layout';
		}
		elseif ('no-sidebar' == $home_blog) {
			$classes[] = 'no-sidebar-layout';//css for no-sidebar-layout from <body >
		}
	}
	return $classes;
}
/****************************************************************************************/
add_action('wp_head', 'ambition_internal_css');
/**
 * Hooks the Custom Internal CSS to head section
 */
function ambition_internal_css() {
	global $ambition_settings,$array_of_default_settings;
	$ambition_settings = wp_parse_args(  get_option( 'ambition_theme_settings', array() ),  ambition_get_option_defaults() );
	$custom_css = $ambition_settings['css_settings'];
	if (!empty($custom_css) ){
		$ambition_internal_css = '<!-- '.get_bloginfo('name').' Custom CSS Styles -->'."\n";
		$ambition_internal_css .= '<style type="text/css" media="screen">'."\n";
		$ambition_internal_css .= $custom_css."\n";
		$ambition_internal_css .= '</style>'."\n";
	}
	if (isset($ambition_internal_css)) {
		echo $ambition_internal_css;
	}
}
/****************************************************************************************/
add_action('pre_get_posts', 'ambition_alter_home');
/**
 * Alter the query for the main loop in home page
 *
 * @uses pre_get_posts hook
 */
function ambition_alter_home($query) {
	global $ambition_settings,$array_of_default_settings;
	$ambition_settings = wp_parse_args(  get_option( 'ambition_theme_settings', array() ),  ambition_get_option_defaults() );
	$disable_setting = $ambition_settings['disable_setting'];
	$catID = array($ambition_settings['ambition_categories']);
	if ( $disable_setting == 0 ) {
		if ( !in_array( 0, $catID) ) {
			if( $query->is_main_query() && $query->is_home() ) {
				$query->query_vars['category__in'] = $ambition_settings['ambition_categories'];
			}
		}
	}
}
/****************************************************************************************/
add_filter('wp_page_menu', 'ambition_wp_page_menu_filter');
/**
 * @uses wp_page_menu filter hook
 */
if (!function_exists('ambition_wp_page_menu_filter')) {
	function ambition_wp_page_menu_filter($text) {
		$replace = array(
			'current_page_item' => 'current-menu-item',
		);
		$text = str_replace(array_keys($replace), $replace, $text);
		return $text;
	}
}
/**************************************************************************************/
function ambition_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	$lato = _x( 'on', 'Lato font: on or off', 'ambition' );
	if ( 'off' !== $lato) {
		$font_url = add_query_arg('family', urlencode('Lato:400,700,300'), "//fonts.googleapis.com/css");
	}
	return $font_url;
}
/**************************************************************************************/
add_action( 'init', 'ambition_register_nav_menus' );
function ambition_register_nav_menus() {
	register_nav_menu( 'social', __( 'Social Navigation', 'ambition' ) );
}
/****************************************************************************************/
add_action( 'admin_enqueue_scripts', 'ambition_jquery_javascript_file' );
/**
 *
 */
function ambition_jquery_javascript_file() {
	wp_enqueue_media();
   wp_enqueue_style('thickbox');
   	if( is_admin() ) {
			wp_enqueue_script('metabox', get_template_directory_uri().'/inc/admin/js/metabox.js'); 
	}
}
?>

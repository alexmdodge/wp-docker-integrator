<?php
/**
 * Displays the header section of the theme.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset');?>" />
	<?php
		/**
		 * ambition_title hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * ambition_add_meta_name 5
		 *
		 */
		do_action('ambition_title');
		/**
		 * ambition_meta hook
		 */
		do_action('ambition_meta');
		/**
		 * ambition_links hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * ambition_favicon 15
		 * ambition_webpage_icon 20
		 *
		 */
		do_action('ambition_links'); ?>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri();?>/js/html5.min.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
		</head>
		<body <?php body_class(); ?>>
			<div id="page" class="hfeed site">
				<header id="masthead" class="site-header" role="banner">
					<?php
						/**
						 * ambition_header hook
						 *
						 * HOOKED_FUNCTION_NAME PRIORITY
						 *
						 * ambition_headercontent_details 10
						 */
						do_action('ambition_header');
					?>
				</header><!-- #masthead -->
				<div id="content">
						<?php
						if (!is_page_template('page-templates/page-template-business.php')) : ?>
							<div class="container clearfix">
						<?php endif; ?>
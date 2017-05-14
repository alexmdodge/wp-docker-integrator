<?php
/**
 * Adds header structures.
 *
 * @package 		Theme Horse
 * @subpackage 		Ambition
 * @since 			Ambition 1.0
 * @license 		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link 			http://themehorse.com/themes/ambition
 */
/****************************************************************************************/
add_action('ambition_title', 'ambition_viewport', 5);
/**
 * Add meta tags.
 */
function ambition_viewport() { ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php
}
/****************************************************************************************/
// Load Favicon in Header Section
add_action('ambition_links', 'ambition_favicon', 15);
// Load Favicon in Admin Section
add_action('admin_head', 'ambition_favicon');
/**
 * Get the favicon Image from theme options
 * display favicon
 *
 */
function ambition_favicon() {
	global $ambition_settings, $array_of_default_settings;
	$ambition_settings = wp_parse_args( 
    get_option( 'ambition_theme_settings', array() ), 
    ambition_get_option_defaults());
	$fav_settings = $ambition_settings['fav_settings'];
	if (0 != $fav_settings) { 
		if ($ambition_settings['img-upload-fav-icon'] !='') {
			echo '<link rel="shortcut icon" href="'.esc_url($ambition_settings['img-upload-fav-icon']).'" type="image/x-icon" />';
		}
	}
}
/****************************************************************************************/
// Load webpageicon in Header Section
add_action('ambition_links', 'ambition_webpage_icon', 20);
/**
 * Get the webpageicon Image from theme options
 * display webpageicon
 *
 */
function ambition_webpage_icon() {
	global $ambition_settings;
	$ambition_webpage_icon = $ambition_settings['img-upload-webclip-icon'];
	$ambition_webpage_settings = $ambition_settings['web_settings'];

	if (0 != $ambition_webpage_settings) {
		if ($ambition_webpage_icon !='') {
			echo '<link rel="apple-touch-icon-precomposed" href="'.esc_url($ambition_webpage_icon).'" />';
		}
	}
}
/****************************************************************************************/
add_action('ambition_header', 'ambition_headercontent_details', 10);
/**
 * Shows Header content details
 *
 * Shows the site logo, title, description, searchbar, social icons and many more
 */
function ambition_headercontent_details() { ?>
	<?php global $ambition_settings;
	$header_image = get_header_image();
	if (!empty($header_image)):?>
			<a href="<?php echo esc_url(home_url('/'));?>"><img src="<?php echo esc_url($header_image);?>" class="header-image" width="<?php echo get_custom_header()->width;?>" height="<?php echo get_custom_header()->height;?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display'));?>"> 
			</a>
	<?php
		endif;?>
	<div class="hgroup-wrap">
		<div class="container clearfix">
		<?php
		$ambition_settings = wp_parse_args(  get_option( 'ambition_theme_settings', array() ),  ambition_get_option_defaults() );
			$header_display = $ambition_settings['header_settings'];
			$header_logo = $ambition_settings['img-upload-header-logo'];
			if ($header_display != 'disable_both' && $header_display == 'header_text') { ?>
			<section id="site-logo" class="clearfix">
			<?php if(is_single() || (!is_page_template('page-templates/page-template-business.php' )) && !is_home()){ ?>
				<h2 id="site-title"> 
					<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home">
					<?php bloginfo('name');?>
					</a> 
				</h2><!-- #site-title -->
				<?php } else { ?>
				<h1 id="site-title"> 
					<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home">
					<?php bloginfo('name');?>
					</a> 
				</h1><!-- #site-title -->
				<?php }
				$site_description = get_bloginfo( 'description', 'display' );
				if($site_description){?>
					<h2 id="site-description"> <?php bloginfo('description');?> </h2>
				<?php } ?>
			</section><!-- #site-logo -->
				<?php
			}	elseif ($header_display != 'disable_both' && $header_display == 'header_logo') {
				?>
			<section id="site-logo" class="clearfix">
			<?php if(is_single() || (!is_page_template('page-templates/page-template-business.php' )) && !is_home()){ ?>
				<h2 id="site-title">
					<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home"> <img src="<?php echo $header_logo;?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display'));?>"></a>
				</h2>
				<?php }else{ ?>
				<h1 id="site-title">
					<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home"> <img src="<?php echo $header_logo;?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display'));?>"></a>
				</h1>
				<?php } ?>
			</section><!-- #site-logo -->
			<?php }?>
			<button class="menu-toggle"><?php _e('Responsive Menu', 'ambition' ); ?></button>
			<?php  
			if (has_nav_menu('primary')) {// if there is nav menu then content displayed from nav menu else from pages ?>
			<section class="hgroup-right">
			<?php $args = array(
						'theme_location' => 'primary',
						'container'      => '',
						'items_wrap'     => '<ul class="nav-menu">%3$s</ul>',
					); ?>
				<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
					<?php wp_nav_menu($args);//extract the content from apperance-> nav menu ?>
				</nav><!-- #access -->
		<?php } else {// extract the content from page menu only ?>
			<section class="hgroup-right">
				<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
					<?php	wp_page_menu(array('menu_class' => 'nav-menu')); ?>
				</nav><!-- #access -->
			<?php	}
			$search_form = $ambition_settings['search_header_settings'];
			if (1 != $search_form) { ?>
				<div class="search-toggle"></div><!-- .search-toggle -->
				<div id="search-box" class="hide">
					<?php get_search_form();?>
					<span class="arrow"></span>
				</div><!-- #search-box -->
						<?php } ?>
			</section><!-- .hgroup-right -->
		</div><!-- .container -->
	</div><!-- .hgroup-wrap -->

			<?php global $disable_slider;
				global $ambition_settings;
			if (is_front_page()) {
				$disable_slider = $ambition_settings['disable_slider'];
				if (empty($disable_slider)) {
					if (function_exists('ambition_pass_slider_effect_cycle_parameters')) {
						ambition_pass_slider_effect_cycle_parameters();
					}
					if (function_exists('ambition_featured_sliders')) {
						ambition_featured_sliders();
					}
				}
			} else {
				if (('' != ambition_header_title()) || function_exists('bcn_display_list')) {
					$sitetitle_img_setting = $ambition_settings['site_title_setting'];

					$sitetitle_image = $ambition_settings['img-upload-site-title']; ?>
					<div class="page-title-wrap" <?php if ( $sitetitle_img_setting != '1'  && $sitetitle_image != '' ){ ?> style="background-image:url('<?php echo esc_url($sitetitle_image);?>');" <?php } ?> >
						<div class="container clearfix">
						<?php if(is_home()){?>
							<h2 class="page-title"><?php echo ambition_header_title();?></h2><!-- .page-title -->
						<?php } else { ?>
							<h1 class="page-title"><?php echo ambition_header_title();?></h1><!-- .page-title -->
						<?php }
							if (function_exists('ambition_breadcrumb')) {
								ambition_breadcrumb();
							}
						?>
						</div><!-- .container -->
					</div><!-- .page-title-wrap -->
			<?php
				}
			}
}

/****************************************************************************************/
if (!function_exists('ambition_featured_sliders')):
/**
 * displaying the featured image in home page
 *
 */
function ambition_featured_sliders() {
	if ( is_front_page() && ambition_has_featured_posts() ) {
		echo get_template_part( 'featured-content' );
	}
}
endif;
/****************************************************************************************/
if (!function_exists('ambition_breadcrumb')):
/**
 * Display breadcrumb on header.
 *
 * If the page is home or front page, slider is displayed.
 * In other pages, breadcrumb will display if breadcrumb NavXT plugin exists.
 */
function ambition_breadcrumb() {
	if (function_exists('bcn_display')) { ?>
		<div class="breadcrumb">
			<?php bcn_display(); ?>
		</div> <!-- .breadcrumb -->
	<?php }
}
endif;
/****************************************************************************************/
if (!function_exists('ambition_header_title')):
/**
 * Show the title in header
 *
 * @since Ambition 1.0
 */
function ambition_header_title() {
	if (is_archive()) {
		$ambition_header_title = single_cat_title('', FALSE);
	} elseif (is_home()){
		$ambition_header_title = get_the_title( get_option( 'page_for_posts' ) );
	} elseif (is_404()) {
		$ambition_header_title = __('Page NOT Found', 'ambition');
	} elseif (is_search()) {
		$ambition_header_title = __('Search Results', 'ambition');
	} elseif (is_page_template()) {
		$ambition_header_title = get_the_title();
	} else {
		$ambition_header_title = get_the_title();
	}
	return $ambition_header_title;
}
endif;
?>

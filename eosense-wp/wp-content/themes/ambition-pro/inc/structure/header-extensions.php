<?php
/**
 * Adds header structures.
 *
 * @package 		Theme Horse
 * @subpackage 		Ambition Pro
 * @since 			Ambition Pro 1.0
 * @license 		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link 			http://themehorse.com/themes/ambition
 */
/****************************************************************************************/
add_action('ambition_title', 'ambition_viewport', 5);
/**
 * Add meta tags.
 */
function ambition_viewport() {
	global $ambition_settings, $array_of_default_settings;
	$ambition_settings = wp_parse_args( 
    get_option( 'ambition_theme_settings', array() ), 
    ambition_get_option_defaults());
	$responsive_layout = $ambition_settings['ambition_responsive'];
   if( $responsive_layout == 'on' ) { ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php } else {?>
	<meta name="viewport" content="width=1270" />
<?php 
	}
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
	<?php if (!function_exists('ambition_footer_infoblog')):
		global $phone_no, $email_id, $location, $skype,$ambition_settings;
		$ambition_settings = wp_parse_args( 
    get_option( 'ambition_theme_settings', array() ), 
    ambition_get_option_defaults());
		$phone_no = $ambition_settings['ambition_phone_no'];
		$email_id = $ambition_settings['ambition_email_id'];
		$location = $ambition_settings['ambition_location'];
		$skype = $ambition_settings['ambition_skype'];
	/**
	 * This function for social links display on header
	 */
	function ambition_footer_infoblog() {
		global $phone_no, $email_id, $location, $skype, $ambition_settings;
		$ambition_settings = wp_parse_args( 
    get_option( 'ambition_theme_settings', array() ), 
    ambition_get_option_defaults());
		$ambition_footer_infoblog 			= '';
		if ($phone_no !='' || $email_id!='' || $location != '' || $skype !='') {
				$ambition_footer_infoblog 	  .= '<div class="info clearfix"><ul>';
			if ($phone_no !='') {
				$ambition_footer_infoblog .= '<li class='.'"phone-number"'.'><a title='.__('"Call Us"','ambition').' '.'href='.'"tel:';
				$ambition_footer_infoblog .= preg_replace("/[^0-9+]/", '', $ambition_settings['ambition_phone_no']);
				$ambition_footer_infoblog .= '">';
				$ambition_footer_infoblog .= preg_replace("/[^() 0-9+-]/", '', $ambition_settings['ambition_phone_no']);
				$ambition_footer_infoblog .= '</a></li>';
			}
			if ($email_id!='') {
				$ambition_footer_infoblog .= '<li class='.'"email"'.'><a title='.__('"Mail Us"','ambition').' '.'href='.'"mailto:';
				$ambition_footer_infoblog .= is_email($ambition_settings['ambition_email_id']);
				$ambition_footer_infoblog .= '">';
				$ambition_footer_infoblog .= is_email($ambition_settings['ambition_email_id']);
				$ambition_footer_infoblog .= '</a></li>';
			}
			if ($location != '') {
				$ambition_footer_infoblog .= '<li class='.'"address"'.'><a title='.__('"My Location"','ambition').' target ='.'"_blank"'.' '.'href='.'"';
				$ambition_footer_infoblog .= esc_url($ambition_settings['ambition_location_url']);
				$ambition_footer_infoblog .= '">';
				$ambition_footer_infoblog .= esc_attr($ambition_settings['ambition_location']);
				$ambition_footer_infoblog .= '</a></li>';
			}
			if ($skype !='') {
				$ambition_footer_infoblog .= '<li class='.'"skype"'.'><a title='.__('"Connect with Us"','ambition').' '.'href='.'"skype:';
				$ambition_footer_infoblog .= esc_attr($ambition_settings['ambition_skype']);
				$ambition_footer_infoblog .= '?chat">';
				$ambition_footer_infoblog .= esc_attr($ambition_settings['ambition_skype']);
				$ambition_footer_infoblog .= '</a></li>';
			}
				$ambition_footer_infoblog .= '</ul></div><!-- .info -->';
		}
		echo $ambition_footer_infoblog;
	}
	global $phone_no, $email_id, $location, $skype, $ambition_settings;
	$ambition_settings = wp_parse_args( 
    get_option( 'ambition_theme_settings', array() ), 
    ambition_get_option_defaults());
	$info_bar_top = $ambition_settings['contact_info_bar_top'];
	if (($phone_no !='' || $email_id!='' || $location != '' || $skype !='' || has_nav_menu('social')) && $info_bar_top ==0){
		echo '<div class="info-bar">';
		echo '<div class="container clearfix">';
		ambition_footer_infoblog();
		ambition_socialnetworks();
		echo '</div><!-- .container -->';
		echo '</div><!-- .info-bar -->';
	}
		endif;
	?>
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
				<?php } else { ?>
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
				$slider_type = $ambition_settings['ambition_slider_type'];
				$disable_slider = $ambition_settings['disable_slider'];
				$ambition_slider_status = $ambition_settings['ambition_slider_status'];
				if ($disable_slider==0) {
					if($slider_type == 'revolution'){
					$header_slider = $ambition_settings['ambition_revolution_options'];
					$ambition_display_homepage = $ambition_settings['ambition_display_homepage'];
						if( !empty( $header_slider ) && function_exists( 'putRevSlider' ) ) {
							$ambition_revolution_pageid = $ambition_settings['ambition_revolution_pageid'];
							$ambition_rev_page_array = explode( ',', $ambition_revolution_pageid );
							if( '1' == $ambition_display_homepage && ( is_home() || is_front_page() ) ) {
							putRevSlider( $header_slider, "homepage" );
							$ambition_show_breadcrumb = 'false';
							}
							if ( !empty( $ambition_revolution_pageid ) && is_page( $ambition_rev_page_array ) ) {
							putRevSlider( $header_slider, $ambition_revolution_pageid );
							$ambition_show_breadcrumb = 'false';
							}
						}
					} else{
						if ( ( 'allpage' == $ambition_slider_status ) || ( ( is_home() || is_front_page() ) &&  'homepage' == 
$ambition_slider_status ) ) { 
							if (function_exists('ambition_pass_slider_effect_cycle_parameters')) {
								ambition_pass_slider_effect_cycle_parameters();
							}
							if($ambition_settings['ambition_slider_type'] == 'defaults' && function_exists( 'ambition_featured_sliders' ) ) {
									ambition_featured_sliders();
							}
							if($ambition_settings['ambition_slider_type'] == 'page' && function_exists( 'ambition_post_page_sliders' ) ) {
									ambition_post_page_sliders();
							}
							if($ambition_settings['ambition_slider_type'] == 'image' && function_exists( 'ambition_image_sliders' ) ) {
									ambition_image_sliders();
							}
						}
					}
				}
			if (!is_front_page()) {
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
	global $ambition_settings;
	$ambition_slider_status = $ambition_settings['ambition_slider_status'];
	if ( ( 'allpage' == $ambition_slider_status ) || ( ( is_home() || is_front_page() ) &&  'homepage' == 
$ambition_slider_status ) && ambition_has_featured_posts()) {
		echo get_template_part( 'featured-content' );
	}
}
endif;
/****************************************************************************************/
if (!function_exists('ambition_post_page_sliders')):
/**
 * displaying the featured Post/ Page image
 *
 */
function ambition_post_page_sliders() {
	global $ambition_settings;
	global $excerpt_length;
	global $excerpt_text;
	$secondary_text = $ambition_settings['ambition_secondary_text'];
	$secondary_url = $ambition_settings['ambition_secondary_url'];
	global $post;
	$ambition_post_page_sliders_display = '';
	$ambition_page_post_no 		= 0; 
	$list_post_page				= array();
	for( $i = 1; $i <= $ambition_settings['ambition_slide_no']; $i++ ){
		if( isset ( $ambition_settings['featured_post_page_slider_' . $i] ) && $ambition_settings['featured_post_page_slider_' . $i] > 0 ){
			$ambition_page_post_no++;

			$list_post_page	=	array_merge( $list_post_page, array( $ambition_settings['featured_post_page_slider_' . $i] ) );
		}

	}
		if ( !empty( $list_post_page ) && $ambition_page_post_no > 0 ) {
			$ambition_post_page_sliders_display 	.= '<section class="featured-slider">
	<div class="slider-cycle">';
					$get_featured_posts 		= new WP_Query(array(
					'posts_per_page'      	=> $ambition_settings['ambition_slide_no'],
					'post_type'           	=> array('post', 'page'),
					'post__in'            	=> $list_post_page,
					'orderby'             	=> 'post__in',
					'ignore_sticky_posts' 	=> 1
				));
			$i = 0;
			while ($get_featured_posts->have_posts()):$get_featured_posts->the_post();
			$attachment_id = get_post_thumbnail_id();
			$image_attributes = wp_get_attachment_image_src($attachment_id,'full');
						$i++;
						$title_attribute       	 	 = apply_filters('the_title', get_the_title($post->ID));
						$excerpt               	 	 = get_the_excerpt();
						if (1 == $i) {$classes   	 = "slides displayblock";} else { $classes = "slides displaynone";}
				$ambition_post_page_sliders_display    	.= '<div class="'.$classes.'">';
				if ($image_attributes) {
					$ambition_post_page_sliders_display 	.= '<div class="featured-image" title="'.the_title('', '', false).'"' .' style="background-image:url(' ."'" .esc_url($image_attributes[0])."'" .')">';
				}
				if ($title_attribute != '' || $excerpt != '') {
					$ambition_post_page_sliders_display 	.= '<div class="container clearfix">
				<article class="featured-text">';
					if ($title_attribute != '') {
						$ambition_post_page_sliders_display .= '<h2 class="featured-title"><a href="'.get_permalink().'" title="'.the_title('', '', false).'" rel="bookmark">'.get_the_title().'</a></h2><!-- .featured-title -->';
					}
					if ($excerpt != '') {
						$ambition_post_page_sliders_display .= '<div class="featured-content">'.$excerpt.'</div><!-- .featured-content -->';
						$ambition_post_page_sliders_display 	.= '<a title='.'"'.$ambition_settings[ 'ambition_excerpt_text' ]. '"'. ' '.'href="'.get_permalink().'"'.' class="call-to-action active" target = "_blank">'.$ambition_settings[ 'ambition_excerpt_text' ].'</a>';
						if(!empty($secondary_text)){
							$ambition_post_page_sliders_display 	.= '<a title="'.esc_attr($secondary_text).'"' .' href="'.esc_url($secondary_url). '"'. 'class="call-to-action" target="_blank">'.esc_attr($secondary_text). '</a>';

						}
					}
				$ambition_post_page_sliders_display 	.='</article><!-- .featured-text -->
				</div><!-- .container -->';
				}
				if ($image_attributes) {
					$ambition_post_page_sliders_display 	.='</div><!-- .featured-image -->';
				}
					$ambition_post_page_sliders_display 	.='</div><!-- .slides -->';
			endwhile;
					wp_reset_query();
					$ambition_post_page_sliders_display .= '</div>	<!-- .slider-cycle --><nav id="controllers" class="clearfix"></nav><!-- #controllers --></section><!-- .featured-slider -->';
		}
				echo $ambition_post_page_sliders_display;
}
endif;
/****************************************************************************************/
if (!function_exists('ambition_image_sliders')):
/**
 * displaying the featured image
 *
 */
function ambition_image_sliders() {
	global $ambition_settings;
	$secondary_text = $ambition_settings['ambition_secondary_text'];
	$secondary_url = $ambition_settings['ambition_secondary_url'];
	global $post;
	$ambition_image_slider_display = '';
	$ambition_image_slider_display .= '<section class="featured-slider">
	<div class="slider-cycle">';
	for( $i = 1; $i <= $ambition_settings['ambition_slide_no']; $i++ ){
			if( !empty( $ambition_settings[ 'redirect_link' . $i ] ) ) { $redirect_link = $ambition_settings[ 'redirect_link' . $i ]; } else { $redirect_link = '#'; }

			if( !empty( $ambition_settings[ 'image_title'. $i ] ) ) { $image_title = $ambition_settings[ 'image_title'. $i ]; } else { $image_title = ''; }

			if( !empty( $ambition_settings[ 'featured_image_slider_'. $i ] ) ) { $featured_image_slider = $ambition_settings[ 'featured_image_slider_'. $i ]; } else { $featured_image_slider = ''; }

			if( !empty( $ambition_settings[ 'link_text'. $i ] ) ) { $link_text = $ambition_settings[ 'link_text'. $i ]; } else { $link_text = ''; }

			if( !empty( $ambition_settings[ 'image_description'. $i ] ) ) { $image_description = $ambition_settings[ 'image_description'. $i ]; } else { $image_description = ''; }

			if ( 1 == $i ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }

			$ambition_image_slider_display .= '<div class="'.$classes.'">';
			if (!empty($featured_image_slider)) {
					$ambition_image_slider_display 	.= '<div class="featured-image" title="'.esc_attr($image_title).'"' .' style="background-image:url(' ."'" .esc_url($featured_image_slider)."'" .')">';
			}

			if(!empty($image_title) || ($image_description)){
				$ambition_image_slider_display 	.= '<div class="container clearfix">
				<article class="featured-text">';
				if(!empty($image_title)){
					$ambition_image_slider_display 	.= '<h2 class="featured-title"><a href="'.esc_url($redirect_link).'" title="'.esc_attr($image_title).'" rel="bookmark">'.esc_attr($image_title).'</a></h2><!-- .featured-title -->';
					if (!empty($image_description)) {
							$ambition_image_slider_display .= '<div class="featured-content">'.$image_description.'</div><!-- .featured-content -->';
							$ambition_image_slider_display 	.= '<a title='.'"'.esc_attr($link_text). '"'. ' '.'href="'.esc_url($redirect_link).'"'.' class="call-to-action active" target = "_blank">'.esc_attr($link_text).'</a>';
							if(!empty($secondary_text)){
								$ambition_image_slider_display 	.= '<a title="'.esc_attr($secondary_text).'"' .' href="'.esc_url($secondary_url). '"'. 'class="call-to-action" target="_blank">'.esc_attr($secondary_text). '</a>';
							}
					}
				}
				$ambition_image_slider_display 	.='</article><!-- .featured-text -->
				</div><!-- .container -->';
				if(!empty($image_title)){
					$ambition_image_slider_display 	.='</div><!-- .featured-image -->';
				}
					$ambition_image_slider_display 	.='</div><!-- .slides -->';
			}
	}
	$ambition_image_slider_display .= '</div>	<!-- .slider-cycle --><nav id="controllers" class="clearfix"></nav><!-- #controllers --></section><!-- .featured-slider -->';
				echo $ambition_image_slider_display;
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
			<?php 
			if( is_plugin_active('woocommerce/woocommerce.php') && is_shop()){
				echo '<a href = "' .esc_url( home_url( '/' ) ).'">' . get_bloginfo() . '</a>'. ' / ' .get_the_title( get_option( 'woocommerce_shop_page_id' ) );
				}else{
					bcn_display();
				} ?>
		</div> <!-- .breadcrumb -->
	<?php }
}
endif;
/****************************************************************************************/
if (!function_exists('ambition_header_title')):
/**
 * Show the title in header
 *
 * @since Ambition Pro 1.0
 */
function ambition_header_title() {
	if (is_archive()) {
		if( is_plugin_active('woocommerce/woocommerce.php') && is_woocommerce()){
		$ambition_header_title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
		} else{
		$ambition_header_title = single_cat_title('', FALSE);
		}
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

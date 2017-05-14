<?php
/**
 * Ambition Pro style functions and definitions
 *
 * This file contains all the functions related to styles.
 * 
 * @package Theme Horse
 * @subpackage Ambition Pro
 * @since Ambition Pro 1.0
 */
/****************************************************************************************/
/**
 * Changes the style according to theme options value
 */
add_action( 'wp_head', 'ambition_infobar_information');
function ambition_infobar_information() {
	global $ambition_settings;
	$slider_content = $ambition_settings['ambition_slider_content'];
	$text_position = $ambition_settings['ambition_slider_textposition'];
	if (('off' == $slider_content) || ('middle' !=$text_position)) {?>
		<style type="text/css">
		<?php } 
		if ('on' != $slider_content) { ?>
			.featured-text {
				display: none;
			}
		<?php } 
		if ('left' == $text_position) {?>/* Left Align */
		.featured-text {
			text-align: left;
			width: 50%;
			padding: 0;
		}
		.featured-text .call-to-action {
			margin: 10px 20px 0 0;
		}
		@media only screen and (max-width: 767px) {
			.featured-text {
				text-align: center;
				width: 90%;
				padding: 0 5%;
			}
			.featured-text .call-to-action {
				margin: 10px 10px 0;
			}
		}
		<?php }
		if ('right' == $text_position) {?>
		/* Right Align */
		.featured-text {
			float: right;
			text-align: left;
			width: 50%;
			padding: 0;
		}
		.featured-text .call-to-action {
			margin: 10px 20px 0 0;
		}
		@media only screen and (max-width: 767px) {
			.featured-text {
				text-align: center;
				width: 90%;
				padding: 0 5%;
			}
			.featured-text .call-to-action {
				margin: 10px 10px 0;
			}
		}
		<?php } ?>
	<?php if (('on' != $slider_content) || ('middle' !=$text_position)) {?>
		</style>
		<?php } ?>
<?php 
}
/****************************************************************************************/
add_action( 'wp_head', 'ambition_options_style');
    function ambition_options_style() {
    	global $ambition_settings;
		$color_scheme       = ambition_get_color_scheme();
		$default_color      = $color_scheme[3];
		$ambition_links_color = get_option( 'ambition_links_color', $default_color );
		$ambition_navigation_color = get_option( 'ambition_navigation_color', $default_color );
		$ambition_buttons = get_option( 'ambition_buttons', $default_color );
		$ambition_promotionalbar = get_option( 'ambition_promotionalbar', $default_color );
		//background color options 
		$top_contact_infobar_background = get_option( 'top_contact_infobar_background', '#f2f2f2');
		$site_title_logo_background = get_option( 'site_title_logo_background', '#ffffff');
		$site_title_navigation_background = get_option( 'site_title_navigation_background', '#ffffff');
		$main_content_background = get_option( 'main_content_background', '#ffffff');
		$featured_pg_background = get_option( 'featured_pg_background', '#ffffff');
		$widgets_featured_recent_work_background = get_option( 'widgets_featured_recent_work_background', '#ffffff');
		$services_background = get_option( 'services_background', '#ffffff');
		$testimonial_background = get_option( 'testimonial_background', '#f2f2f2');
		$wid_clien_pro_background = get_option( 'wid_clien_pro_background', '#ffffff');
		$footer_widget_section_background = get_option( 'footer_widget_section_background', '#262626');
		$bottom_contact_infobar_background = get_option( 'bottom_contact_infobar_background', '#202020');
		$site_info_background = get_option( 'site_info_background', '#1a1a1a');
		$blockquote_sticky_background = get_option( 'blockquote_sticky_background', '#f2f2f2');
		$form_input_textfield_background = get_option( 'form_input_textfield_background', '#f9f9f9');
		// Font color options
		$font_color_content = get_option( 'font_color_content', '#666666');
		$font_color_top_infobar = get_option( 'font_color_top_infobar', '#888888');
		$font_color_sitetitle = get_option( 'font_color_sitetitle', '#666666');
		$font_color_navigation = get_option( 'font_color_navigation', '#666666');
		$font_color_pagetitle_breadcrumbs = get_option( 'font_color_pagetitle_breadcrumbs', '#ffffff');
		$font_color_slidertitle_content_button = get_option( 'font_color_slidertitle_content_button', '#ffffff');
		$font_color_headings_titles = get_option( 'font_color_headings_titles', '#333333');
		$font_color_sidebar_widget_titles = get_option( 'font_color_sidebar_widget_titles', '#333333');
		$font_color_pormotionalbar = get_option( 'font_color_pormotionalbar', '#ffffff');
		$font_color_sidebar_content = get_option( 'font_color_sidebar_content', '#666666');
		$font_color_footer_widget_titles = get_option( 'font_color_footer_widget_titles', '#ffffff');
		$font_color_footer_content = get_option( 'font_color_footer_content', '#888888');
		$font_color_footer_infobar = get_option( 'font_color_footer_infobar', '#888888');
		$font_color_site_info = get_option( 'font_color_site_info', '#666666');
		$font_color_siteinfo_links = get_option( 'font_color_siteinfo_links', '#888888');
		// Font Size
		$ambition_content_size = $ambition_settings[ 'ambition_content_size'];
		$ambition_button_size = $ambition_settings[ 'ambition_button_size'];
		$ambition_topinfobar_size = $ambition_settings[ 'ambition_topinfobar_size'];
		$ambition_sitetitle_size = $ambition_settings[ 'ambition_sitetitle_size'];
		$ambition_navigation_size = $ambition_settings[ 'ambition_navigation_size'];
		$ambition_featured_slidertitle_size = $ambition_settings[ 'ambition_featured_slidertitle_size'];
		$ambition_slider_content_fontsize = $ambition_settings[ 'ambition_slider_content_fontsize'];
		$ambition_featured_slider_button_size = $ambition_settings[ 'ambition_featured_slider_button_size'];
		$ambition_alltitle_size = $ambition_settings[ 'ambition_alltitle_size'];
		$ambition_widget_sec_content_size = $ambition_settings[ 'ambition_widget_sec_content_size'];
		$ambition_ser_recent_head_titles_size = $ambition_settings[ 'ambition_ser_recent_head_titles_size'];
		$ambition_pagetitle_size = $ambition_settings[ 'ambition_pagetitle_size'];
		$ambition_breadcrumbs_size = $ambition_settings[ 'ambition_breadcrumbs_size'];
		$ambition_widgettitle_size = $ambition_settings[ 'ambition_widgettitle_size'];
		$ambition_footer_content_size = $ambition_settings[ 'ambition_footer_content_size'];
		$ambition_bottom_infobar_size = $ambition_settings[ 'ambition_bottom_infobar_size'];
		$ambition_site_info_size = $ambition_settings[ 'ambition_site_info_size'];

		$ambition_fontfamily_content = $ambition_settings['ambition_fontfamily_content'];
		$ambition_fontfamily_navigation = $ambition_settings['ambition_fontfamily_navigation'];
		$ambition_fontfamily_titles_heading = $ambition_settings['ambition_fontfamily_titles_heading'];?>

<style type="text/css">

<?php /***************************** Font Family *********************************************/ ?>
<?php if( $ambition_fontfamily_content != 'Lato' ) : ?>/* Content */
body,
input,
textarea {
	font-family: '<?php echo esc_attr( $ambition_fontfamily_content ); ?>', sans-serif;
}
<?php endif; ?>
<?php if( $ambition_fontfamily_navigation != 'Lato' ) : ?>/* Navigation */
.main-navigation a {
	font-family: '<?php echo esc_attr( $ambition_fontfamily_navigation ); ?>', sans-serif;
}
<?php endif; ?>
<?php if( $ambition_fontfamily_titles_heading != 'Lato' ) : ?> /* All Headings/Titles */
h1, h2, h3, h4, h5, h6 {
    font-family: '<?php echo esc_attr( $ambition_fontfamily_titles_heading ); ?>', sans-serif;
}
<?php endif; ?>
<?php  /******************************* Color skin *************************************/ ?>

<?php if( $ambition_links_color != $default_color) : ?>/* links */
::selection {
	background-color: <?php echo esc_attr( $ambition_links_color); ?>;
	color: #fff;
}
::-moz-selection {
	background-color: <?php echo esc_attr( $ambition_links_color); ?>;
color: #fff;
	}
a,
#site-title a:hover,
#site-title a:focus,
#site-title a:active,
.info-bar ul li a:hover,
.info-bar .info ul li:before,
#main ul a:hover,
#main ol a:hover,
#main .gal-filter li.active a,
.entry-title a:hover,
.entry-title a:focus,
.entry-title a:active,
.entry-meta a:hover,
.entry-meta .cat-links a:hover,
.custom-gallery-title a:hover,
.widget ul li a:hover,
.widget-title a:hover,
.widget_tag_cloud a:hover,
.widget_service .service-title a:hover,
#colophon .widget ul li a:hover,
.site-info .copyright a:hover,
.woocommerce-page #main ul a,
.woocommerce-page #main ol a,
.woocommerce-page #main ul a:hover,
.woocommerce-page #main ol a:hover,
.woocommerce-page .star-rating,
.woocommerce-page .star-rating:before {
	color: <?php echo esc_attr($ambition_links_color); ?>;
}
<?php endif; ?>
<?php if( $ambition_navigation_color != $default_color) : ?>/* Navigation */
.main-navigation a:hover,
.main-navigation ul li.current-menu-item a,
.main-navigation ul li.current_page_ancestor a,
.main-navigation ul li.current-menu-ancestor a,
.main-navigation ul li.current_page_item a,
.main-navigation ul li:hover > a,
.main-navigation ul li ul li a:hover,
.main-navigation ul li ul li:hover > a,
.main-navigation ul li.current-menu-item ul li a:hover {
	color: <?php echo esc_attr($ambition_navigation_color); ?>;
}
<?php endif; ?>
<?php if( $ambition_buttons != $default_color) : ?>/* Buttons and Custom Tag Cloud Widget */
.search-toggle:hover,
.hgroup-right .active,
.featured-text .active:hover {
	color: <?php echo esc_attr($ambition_buttons); ?>;
}
input[type="reset"],
input[type="button"],
input[type="submit"],
.widget_custom-tagcloud a:hover,
.back-to-top a:hover,
#bbpress-forums button,
#wp_page_numbers ul li a:hover,
#wp_page_numbers ul li.active_page a,
.wp-pagenavi .current,
.wp-pagenavi a:hover,
ul.default-wp-page li a:hover,
.pagination a:hover span,
.pagination span,
.call-to-action:hover,
.featured-text .active,
.woocommerce-page #respond input#submit,
.woocommerce-page a.button,
.woocommerce-page button.button,
.woocommerce-page input.button,
.woocommerce-page #respond input#submit.alt,
.woocommerce-page a.button.alt,
.woocommerce-page button.button.alt,
.woocommerce-page input.button.alt,
.woocommerce-page span.onsale,
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle {
	background-color: <?php echo esc_attr($ambition_buttons); ?>;
}
blockquote,
.widget_custom-tagcloud a:hover,
#wp_page_numbers ul li a:hover,
#wp_page_numbers ul li.active_page a,
.wp-pagenavi .current,
.wp-pagenavi a:hover,
ul.default-wp-page li a:hover,
.pagination a:hover span,
.pagination span,
.call-to-action:hover,
.widget_promotional_bar .call-to-action:hover, 
.featured-text .active {
	border-color: <?php echo esc_attr($ambition_buttons); ?>;
}
<?php endif; ?>
<?php if( $ambition_promotionalbar != $default_color) : ?>/* Promotional Bar/ Page Title */
.promotional_bar_content,
.page-title-wrap {
	background-color: <?php echo esc_attr($ambition_promotionalbar); ?>;
}
<?php endif; ?>

<?php /***************************** Background Color ***************************************/ ?>

<?php if( $top_contact_infobar_background != '#f2f2f2') : ?>/* Top Contact Info Bar */
	.info-bar {
		background-color: <?php echo esc_attr($top_contact_infobar_background); ?>;
}
<?php endif; ?>
<?php if( $site_title_logo_background != '#ffffff') : ?>/* Site Title/ Logo */
	.hgroup-wrap {
		background-color: <?php echo esc_attr($site_title_logo_background); ?>;
}
@media only screen and (max-width: 767px) {
	#site-navigation ul li ul {
		background-color: <?php echo esc_attr($site_title_logo_background); ?>;
	}
}
<?php endif; ?>
<?php if( $site_title_navigation_background != '#ffffff') : ?>/* Navigation Dropdown */
	.main-navigation ul li ul { 
		background-color: <?php echo esc_attr($site_title_navigation_background); ?>;
}
<?php endif; ?>
<?php if( $main_content_background != '#ffffff') : ?>/* Main Content */
	#content {
		background-color: <?php echo esc_attr($main_content_background); ?>;
}
<?php endif; ?>
<?php if( $featured_pg_background != '#ffffff') : ?>/* Widget Featured Page */
	.widget_featured_page {
		background-color: <?php echo esc_attr($featured_pg_background); ?>;
}
<?php endif; ?>
<?php if( $widgets_featured_recent_work_background != '#ffffff') : ?>/* Widget Featured Recent Work */
	.widget_recent_work {
		background-color: <?php echo esc_attr($widgets_featured_recent_work_background); ?>;
}
<?php endif; ?>
<?php if( $services_background != '#ffffff') : ?>/* Widget Services */
	.widget_service {
		background-color: <?php echo esc_attr($services_background); ?>;
}
<?php endif; ?>
<?php if( $testimonial_background != '#f2f2f2') : ?>/* Widget Testimonial */
	.widget_testimonial,
	.testimonials-template .widget_testimonial {
		background-color: <?php echo esc_attr($testimonial_background); ?>;
}
<?php endif; ?>
<?php if( $wid_clien_pro_background != '#ffffff') : ?>/* Widget Featured Clients/ Products */
	.widget_ourclients {
		background-color: <?php echo esc_attr($wid_clien_pro_background); ?>;
}
<?php endif; ?>
<?php if( $footer_widget_section_background != '#262626') : ?>/* Footer Widget Section */
	#colophon .widget-wrap {
		background-color: <?php echo esc_attr($footer_widget_section_background); ?>;
}
<?php endif; ?>
<?php if( $bottom_contact_infobar_background != '#202020') : ?>/* Bottom Contact Info Bar */
	#colophon .info-bar {
		background-color: <?php echo esc_attr($bottom_contact_infobar_background); ?>;
}
<?php endif; ?>
<?php if( $site_info_background != '#1a1a1a') : ?>/* Site Info */
	.site-info {
		background-color: <?php echo esc_attr($site_info_background); ?>;
}
<?php endif; ?>
<?php if( $blockquote_sticky_background != '#f2f2f2') : ?>/* Blockquote and Sticky Post */
	pre,
	code,
	kbd,
	blockquote,
	#main .sticky {
		background-color: <?php echo esc_attr($blockquote_sticky_background); ?>;
	}
<?php endif; ?>
<?php if( $form_input_textfield_background != '#f9f9f9') : ?>/* Form Input/ Textarea Fields */
	input[type="text"],
	input[type="email"],
	input[type="search"],
	input[type="password"],
	textarea {
		background-color: <?php echo esc_attr($form_input_textfield_background); ?>;
	}
<?php endif; ?>

<?php /***************************** Font Color Options ***************************************/ ?>
<?php if( $font_color_content != '#666666') : ?>/* Content */
	body,
	input,
	textarea,
	#site-description,
	#main ul a,
	#main ol a,
	#wp_page_numbers ul li.page_info,
	#wp_page_numbers ul li a,
	.wp-pagenavi .pages,
	.wp-pagenavi a,
	ul.default-wp-page li a,
	.pagination,
	.pagination a span,
	.entry-meta,
	.entry-meta a {
		color: <?php echo esc_attr($font_color_content); ?>;
		}
	#wp_page_numbers ul li a,
	.wp-pagenavi a,
	ul.default-wp-page li a,
	.pagination a span {
		border-color: <?php echo esc_attr($font_color_content); ?>;
	}
<?php endif; ?>
<?php if( $font_color_top_infobar != '#888888') : ?>/* Top Info Bar */
	.info-bar,
	.info-bar .info ul li a {
		color: <?php echo esc_attr($font_color_top_infobar); ?>;
	}
<?php endif; ?>
<?php if( $font_color_sitetitle != '#666666') : ?>/* Site Title */
	#site-title a,
	.menu-toggle {
		color: <?php echo esc_attr($font_color_sitetitle); ?>;
	}
<?php endif; ?>
<?php if( $font_color_navigation != '#666666') : ?>/* Navigation */
	.main-navigation a,
	.main-navigation ul li ul li a,
	.main-navigation ul li.current-menu-item ul li a,
	.main-navigation ul li ul li.current-menu-item a,
	.main-navigation ul li.current_page_ancestor ul li a,
	.main-navigation ul li.current-menu-ancestor ul li a,
	.main-navigation ul li.current_page_item ul li a {
		color: <?php echo esc_attr($font_color_navigation); ?>;
	}
<?php endif; ?>
<?php if( $font_color_pagetitle_breadcrumbs != '#ffffff') : ?>/* Page Title and Breadcrumb */
	.page-title,
	.breadcrumb,
	.breadcrumb a,
	.breadcrumb a:hover {
		color: <?php echo esc_attr($font_color_pagetitle_breadcrumbs); ?>;
	}
<?php endif; ?>
<?php if( $font_color_slidertitle_content_button != '#ffffff') : ?>/* Featured Slider Title/ Content */
	.featured-text .featured-title a,
	.featured-text .featured-content { 
		color: <?php echo esc_attr($font_color_slidertitle_content_button); ?>;
	}
<?php endif; ?>
<?php if( $font_color_headings_titles != '#333333') : ?>/* All Headings/ Titles */
	#main .widget_service .service-title a,
	#main .widget-title,
	#main .widget-title a,
	.entry-title,
	.entry-title a,
	.entry-meta .cat-links,
	.entry-meta .cat-links a,
	.tag-links,
	.tag-links:before,
	.tag-links a,
	th {
		color: <?php echo esc_attr($font_color_headings_titles); ?>;
	}
<?php endif; ?>
<?php if( $font_color_sidebar_widget_titles != '#333333') : ?>/* Sidebar Widget Titles */
	.widget-title,
	.widget-title a {
		color: <?php echo esc_attr($font_color_sidebar_widget_titles); ?>;
	}
<?php endif; ?>
<?php if( $font_color_pormotionalbar != '#ffffff') : ?>/* Promotional Bar */
	.widget_promotional_bar .promotional_bar_content,
	#main .widget_promotional_bar .widget-title ,
	.widget_promotional_bar .call-to-action,
	.widget_promotional_bar .call-to-action:hover {
		color: <?php echo esc_attr($font_color_pormotionalbar); ?>;
	}
	.widget_promotional_bar .call-to-action {
		border-color: <?php echo esc_attr($font_color_pormotionalbar); ?>;
	}
<?php endif; ?>
<?php if( $font_color_sidebar_content != '#666666') : ?>/* Sidebar Content */
	#secondary,
	#secondary .widget ul li a,
	.widget_search input.s,
	.widget_custom-tagcloud a {
		color: <?php echo esc_attr($font_color_sidebar_content); ?>;
	}
	.widget_custom-tagcloud a {
		border-color: <?php echo esc_attr($font_color_sidebar_content); ?>; 
	}
<?php endif; ?>
<?php if( $font_color_footer_widget_titles != '#ffffff') : ?>/* Footer Widget Titles */
	#colophon .widget-title {
		color: <?php echo esc_attr($font_color_footer_widget_titles); ?>;
	}
<?php endif; ?>
<?php if( $font_color_footer_content != '#888888') : ?>/* Footer Content */
	#colophon .widget-wrap,
	#colophon .widget ul li a {
		color: <?php echo esc_attr($font_color_footer_content); ?>;
	}
<?php endif; ?>
<?php if( $font_color_footer_infobar != '#888888') : ?>/* Footer Info Bar */
	#colophon .info-bar .info ul li a {
		color: <?php echo esc_attr($font_color_footer_infobar); ?>;
	}
<?php endif; ?>
<?php if( $font_color_site_info != '#666666') : ?>/* Site Info */
	.site-info {
		color: <?php echo esc_attr($font_color_site_info); ?>;
	}
<?php endif; ?>
<?php if( $font_color_siteinfo_links != '#888888') : ?>/* Site Info Links */
	.site-info .copyright a {
		color: <?php echo esc_attr($font_color_siteinfo_links); ?>;
	}
<?php endif; ?>

<?php /***************************** Font Size *********************************************/ ?>

<?php if( $ambition_content_size != '16') : ?>/* Content */
	body,
	input,
	textarea,
	#site-description,
	#bbpress-forums ul.bbp-lead-topic,
	#bbpress-forums ul.bbp-topics,
	#bbpress-forums ul.bbp-forums,
	#bbpress-forums ul.bbp-replies,
	#bbpress-forums ul.bbp-search-results {
		font-size:<?php echo esc_attr($ambition_content_size).'px'; ?>;
	}
<?php endif; ?>
<?php if( $ambition_button_size != '16') : ?>/* Buttons */
	input[type="reset"],
	input[type="button"],
	input[type="submit"],
	div.bbp-search-form input,
	div.bbp-search-form button,
	#bbpress-forums button,
	.woocommerce-page #respond input#submit,
	.woocommerce-page a.button,
	.woocommerce-page button.button,
	.woocommerce-page input.button,
	.woocommerce-page #respond input#submit.alt,
	.woocommerce-page a.button.alt,
	.woocommerce-page button.button.alt,
	.woocommerce-page input.button.alt {
		font-size:<?php echo esc_attr($ambition_button_size).'px'; ?>;
	}
<?php endif; ?>
<?php if( $ambition_topinfobar_size != '14') : ?>/* Top Info Bar */
	#masthead .info-bar { 
		font-size:<?php echo esc_attr($ambition_topinfobar_size).'px'; ?>;
	}
<?php endif; ?>
<?php if( $ambition_sitetitle_size != '25') : ?>/* Site Title */
	#site-title {
		font-size:<?php echo esc_attr($ambition_sitetitle_size).'px'; ?>;
	}
<?php endif; ?>
<?php if( $ambition_navigation_size != '13') : ?>/* Navigation */
	.main-navigation a,
	.main-navigation ul li ul li a,
	.main-navigation ul li.current-menu-item ul li a,
	.main-navigation ul li ul li.current-menu-item a,
	.main-navigation ul li.current_page_ancestor ul li a,
	.main-navigation ul li.current-menu-ancestor ul li a,
	.main-navigation ul li.current_page_item ul li a {
		font-size:<?php echo esc_attr($ambition_navigation_size).'px'; ?>;
	}
<?php endif; ?>
<?php if( $ambition_featured_slidertitle_size != '60') : ?>/* Featured Slider Title */
	.featured-text .featured-title {
		font-size:<?php echo esc_attr($ambition_featured_slidertitle_size).'px'; ?>;
		line-height: normal;
	}
<?php endif; ?>
<?php if( $ambition_slider_content_fontsize != '20') : ?>/* Featured Slider Content */
	.featured-text .featured-content {
		font-size:<?php echo esc_attr($ambition_slider_content_fontsize).'px'; ?>;
		line-height: normal;
	}
<?php endif; ?>
<?php if( $ambition_featured_slider_button_size != '16') : ?>/* Featured Slider Button */
	.featured-text .call-to-action {
		font-size:<?php echo esc_attr($ambition_featured_slider_button_size).'px'; ?>;
	}
<?php endif; ?>
<?php if( $ambition_alltitle_size != '30') : ?>/* Business/ Our Team/ Testimonial/ Service Template Widget Titles, Post Title */
	.business-layout .widget-title,
	.services-template .widget-title,
	.our-team-template .widget-title,
	.testimonials-template .widget-title,
	.entry-title,
	.comments-title,
	#respond h3#reply-title {
		font-size:<?php echo esc_attr($ambition_alltitle_size).'px'; ?>;
		line-height: normal;
	}
<?php endif; ?>
<?php if( $ambition_widget_sec_content_size != '20') : ?>/* Featured Page Widget Secondary Content */
	.widget_featured_page .highlighted-content {
		font-size:<?php echo esc_attr($ambition_widget_sec_content_size).'px'; ?>;
		line-height: normal;
	}
<?php endif; ?>
<?php if( $ambition_ser_recent_head_titles_size != '25') : ?>/* Services Item/ Featured Recent Work Item/ Our Team Name/ Table Heading Titles */
	th,
	.widget_recent_work .recent-work-col a .recent-work-title,
	.widget_service .service-title,
	#main .widget_our_team .our-team-name,
	.woocommerce-page ul.products li.product h3 {
		font-size:<?php echo esc_attr($ambition_ser_recent_head_titles_size).'px'; ?>;
		line-height: normal;
	}
<?php endif; ?>
<?php if( $ambition_pagetitle_size != '30') : ?>/* Page Title */
	.page-title {
		font-size:<?php echo esc_attr($ambition_pagetitle_size).'px'; ?>;
		line-height: normal;
	}
<?php endif; ?>
<?php if( $ambition_breadcrumbs_size != '14') : ?>/* Breadcrumb */
	.breadcrumb {
		font-size:<?php echo esc_attr($ambition_breadcrumbs_size).'px'; ?>;
		line-height: normal;
	}
<?php endif; ?>
<?php if( $ambition_widgettitle_size != '16') : ?>/* Sidebar/Colophon Widget Title */
	#secondary .widget-title,
	#colophon .widget-title {
		font-size:<?php echo esc_attr($ambition_widgettitle_size).'px'; ?>;
		line-height: normal;
	}
<?php endif; ?>
<?php if( $ambition_footer_content_size != '16') : ?>/* Footer Content */
	#colophon .widget-area {
		font-size:<?php echo esc_attr($ambition_footer_content_size).'px'; ?>;
	}
<?php endif; ?>
<?php if( $ambition_bottom_infobar_size != '14') : ?>/* Bottom Info Bar */
	#colophon .info-bar { 
		font-size:<?php echo esc_attr($ambition_bottom_infobar_size).'px'; ?>;
	}
<?php endif; ?>
<?php if( $ambition_site_info_size != '14') : ?>/* Site Info */
	.site-info {
		font-size:<?php echo esc_attr($ambition_site_info_size).'px'; ?>;
	}
<?php endif; ?>
</style>
<?php } ?>
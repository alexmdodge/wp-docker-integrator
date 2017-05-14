<?php
/**
 * Adds footer structures.
 *
 * @package 		Theme Horse
 * @subpackage 		Ambition
 * @since 			Ambition 1.0
 * @license 		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link 			http://themehorse.com/themes/ambition
 */
/****************************************************************************************/
add_action( 'ambition_footer', 'ambition_footer_widget_area', 15 );
/** 
 * Displays the footer widgets
 */
function ambition_footer_widget_area() {
	get_sidebar( 'footer' );
}
/****************************************************************************************/
add_action( 'ambition_footer', 'ambition_open_siteinfo_div', 20 );
/**
 * Opens the site generator div.
 */
function ambition_open_siteinfo_div() { ?>
	<div class="site-info clearfix">
		<div class="container">
<?php }
/****************************************************************************************/
add_action( 'ambition_footer', 'ambition_socialnetworks', 25 );
/**
 * This function for social links display on footer
 *
 */
function ambition_socialnetworks(){
	if ( has_nav_menu( 'social' ) ) : ?>
		<div class="social-profiles clearfix">
		<?php
					// Social links navigation menu.
					wp_nav_menu( array(
						'theme_location' 	=> 'social',
						'container' 		=> '',
						'depth'          	=> 1,
						'items_wrap'      => '<ul>%3$s</ul>',
						'link_before'    	=> '<span class="screen-reader-text">',
						'link_after'     	=> '</span>',
					) );
				?>
		</div><!-- .social-profiles -->
	<?php endif;
}
/****************************************************************************************/
add_action( 'ambition_footer', 'ambition_footer_info', 30 );
/**
 * function to show the footer info, copyright information
 */
function ambition_footer_info() {      
	$output = '<div class="copyright">'.__( '&copy;', 'ambition' ).' '.ambition_the_year().' ' .ambition_site_link().' | ' . ' ' .ambition_themehorse_link().' | '.' ' .ambition_wp_link() .'</div><!-- .copyright -->';
	echo $output;
}
/****************************************************************************************/
add_action( 'ambition_footer', 'ambition_close_siteinfo_div', 40 );
/**
 * Shows the back to top icon to go to top.
 */
function ambition_close_siteinfo_div() { ?>
		</div><!-- .container -->
	</div><!-- .site-info -->
<?php }
/****************************************************************************************/
add_action( 'ambition_footer', 'ambition_backtotop_html', 45 );
/**
 * Shows the back to top icon to go to top.
 */
function ambition_backtotop_html() { ?>
	<div class="back-to-top"><a title="<?php _e('Go to Top', 'ambition');?>" href="#masthead"></a></div><!-- .back-to-top -->
<?php } ?>

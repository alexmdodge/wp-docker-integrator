<?php
/**
 * Contains all the current date, year of the theme.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
?>
<?php
	/**
	 * To display the current year.
	 *
	 * @uses date() Gets the current year.
	 * @return string
	 */
	function ambition_the_year() {
	   return date( 'Y' );
	}
	/**
	 * To display a link back to the site.
	 *
	 * @uses get_bloginfo() Gets the site link
	 * @return string
	 */
	function ambition_site_link() {
	   return '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';
	}
	/**
	 * To display a link to WordPress.org.
	 *
	 * @return string
	 */
	function ambition_wp_link() {
	   return __('Proudly Powered by: ', 'ambition') .'<a href="'.esc_url( 'http://wordpress.org','ambition' ).'" target="_blank" title="' . sprintf( __( '%s', 'ambition' ), 'WordPress'). '"><span>' . sprintf( __( '%s', 'ambition' ), 'WordPress') . '</span></a>';
	}
	/**
	 * To display a link to ambition.com.
	 *
	 * @return string
	 */
	function ambition_themehorse_link() {
	   return __('Theme by: ', 'ambition') .'<a href="'.esc_url( 'http://themehorse.com','ambition' ).'" target="_blank" title="' . sprintf( __( '%s', 'ambition' ), 'Theme Horse').'" ><span>'.sprintf( __( '%s', 'ambition' ), 'Theme Horse') .'</span></a>';
	}
?>

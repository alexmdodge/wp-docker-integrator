<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Ambition
 * @since Ambition 1.0
 */
?>
<?php
// Calling the right sidebar
	if ( is_active_sidebar( 'ambition_right_sidebar' ) ) :
		dynamic_sidebar( 'ambition_right_sidebar' );
	endif;
?>

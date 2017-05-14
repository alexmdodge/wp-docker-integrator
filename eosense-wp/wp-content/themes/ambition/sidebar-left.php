<?php
/**
 * Displays the left sidebar of the theme.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
?>
<?php
// Calling the left sidebar
	if ( is_active_sidebar( 'ambition_left_sidebar' ) ) :
		dynamic_sidebar( 'ambition_left_sidebar' );
	endif;
?>

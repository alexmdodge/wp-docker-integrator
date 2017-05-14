<?php
/**
 * Displays the sidebar on contact page template.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
?>
<?php
// Calling the conatact page sidebar
	if ( is_active_sidebar( 'ambition_contact_page_sidebar' ) ) :
		dynamic_sidebar( 'ambition_contact_page_sidebar' );
	endif;
?>

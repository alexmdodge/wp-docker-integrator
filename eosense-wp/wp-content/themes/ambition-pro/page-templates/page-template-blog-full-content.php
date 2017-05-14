<?php
/**
 * Template Name: Blog Full Content Display
 *
 * Displays the Blog with Full Content Display.
 *
 * @package Theme Horse
 * @subpackage Ambition Pro
 * @since Ambition Pro 1.0
 */
?>
<?php get_header(); ?>
	<?php
		/** 
		 * ambition_before_main_container hook
		 */
		do_action( 'ambition_before_main_container' );
	?>
<?php
		/** 
		 * ambition_main_container hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * ambition_content 10
		 */
		do_action( 'ambition_main_container' );
	?>
	<?php
		/** 
		 * ambition_after_main_container hook
		 */
		do_action( 'ambition_after_main_container' );
	?>
<?php get_footer(); ?>

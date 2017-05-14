<?php
/**
 * Template Name: Business Template
 *
 * Displays the Business Layout of the theme.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.1
 */
?>
<?php get_header(); ?>
	<?php
		/** 
		 * ambition_before_main_container hook
		 */
		do_action( 'ambition_before_main_container' );
		/** 
		 * ambition_business_template_content hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * ambition_display_business_template_content 10
		 */
		do_action( 'ambition_business_template_content' );
		/** 
		 * ambition_after_main_container hook
		 */
		do_action( 'ambition_after_main_container' );
	?>
<?php get_footer(); ?>

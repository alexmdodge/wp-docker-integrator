<?php
/**
 * Template Name: Contact Page Template
 *
 * Displays the contact page template.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
?>
<?php get_header(); ?>
	<?php
		/** 
		 * ambition_before_main_container hook
		 */
		do_action( 'ambition_before_main_container' );
		/** 
		 * ambition_contact_page_template_content hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * ambition_display_contact_page_template_content 10
		 */
		do_action( 'ambition_contact_page_template_content' );
		/** 
		 * ambition_after_main_container hook
		 */
		do_action( 'ambition_after_main_container' );
	?>
<?php get_footer(); ?>

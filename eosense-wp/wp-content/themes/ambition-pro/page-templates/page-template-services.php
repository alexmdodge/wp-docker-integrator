<?php
/**
 * Template Name: Services Page Template
 *
 * Displays the Services page template.
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
		 * ambition_services_page_template_content hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * ambition_display_services_page_template_content 10
		 */
		do_action( 'ambition_services_page_template_content' );
	?>
<?php
	/** 
	 * ambition_after_main_container hook
	 */
	do_action( 'ambition_after_main_container' );
?>
<?php get_footer(); ?>
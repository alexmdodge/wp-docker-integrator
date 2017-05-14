<?php
/**
 * This file displays page with right sidebar.
 *
 * @package Theme Horse
 * @subpackage Ambition Pro
 * @since Ambition Pro 1.0
 */
?>
	<?php
	/**
	 * ambition_before_primary
	 */
	do_action('ambition_before_primary');
	?>
	<div id="primary">
	 <?php
	/**
	 * ambition_before_loop_content
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 * ambition_loop_before 10
	 */
	do_action('ambition_before_loop_content');
	/**
	 * ambition_loop_content
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 * ambition_theloop 10
	 */
	do_action('ambition_loop_content');
	/**
	 * ambition_after_loop_content
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 * ambition_next_previous 5
	 * ambition_loop_after 10
	 */
	do_action('ambition_after_loop_content');
	?>
	</div><!-- #primary -->
	<?php
	/**
	 * ambition_after_primary
	 */
	do_action('ambition_after_primary');
	?>
	<div id="secondary">
	  <?php
	  if (is_page_template('page-templates/page-template-contact.php')) {
	  	get_sidebar( 'contact-page' );
	  }else{
		get_sidebar('right');
		} ?>
	</div><!-- #secondary -->
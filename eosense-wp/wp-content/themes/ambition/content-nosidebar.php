<?php
/**
 * This file displays page with no sidebar.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
?>
<?php
   /**
    * ambition_before_loop_content
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 * ambition_loop_before 10
    */
   do_action( 'ambition_before_loop_content' );
   /**
    * ambition_loop_content
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 * ambition_theloop 10
    */
   do_action( 'ambition_loop_content' );
   /**
    * ambition_after_loop_content
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 * ambition_next_previous 5
	 * ambition_loop_after 10
    */
   do_action( 'ambition_after_loop_content' );
?>

<?php
/**
 * Ambition style functions and definitions
 *
 * This file contains all the functions related to styles.
 * 
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
/****************************************************************************************/
/**
 * Changes the style according to theme options value
 */
add_action( 'wp_head', 'ambition_infobar_information');
function ambition_infobar_information() {
	global $ambition_settings;
	$slider_content = $ambition_settings['ambition_slider_content'];
	if ('off' == $slider_content) { ?>
		<style type="text/css">
			.featured-text {
			display: none;
			}
		</style>
<?php 
	}
}
?>
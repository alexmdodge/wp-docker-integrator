<?php
/**
 * Displays the searchform of the theme.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
?>
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="searchform clearfix">
		<label class="assistive-text"> <?php _e( 'Search', 'ambition' ); ?> </label>
		<input type="search" placeholder="<?php esc_attr_e( 'Search', 'ambition' ); ?>" class="s field" name="s">
		<input type="submit" value="<?php esc_attr_e( 'Search', 'ambition' ); ?>" class="search-submit">
	</form><!-- .search-form -->

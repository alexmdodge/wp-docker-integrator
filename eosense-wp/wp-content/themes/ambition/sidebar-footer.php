<?php
/**
 * Displays the footer sidebar of the theme.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
?>
<?php
	if( is_active_sidebar( 'ambition_footer_sidebar' ) || is_active_sidebar( 'ambition_footer_column2' ) || is_active_sidebar( 'ambition_footer_column3' ) ) {
		?>
		<div class="widget-wrap">
			<div class="container">
				<div class="widget-area clearfix">
					<div class="one-fourth">
						<?php
							// Calling the footer column 1 sidebar
							if ( is_active_sidebar( 'ambition_footer_sidebar' ) ) :
								dynamic_sidebar( 'ambition_footer_sidebar' );
							endif;
						?>
					</div><!-- .one-fourth -->
					<div class="one-fourth">
						<?php
							// Calling the footer column 2 sidebar
							if ( is_active_sidebar( 'ambition_footer_column2' ) ) :
								dynamic_sidebar( 'ambition_footer_column2' );
							endif;
						?>
					</div><!-- .one-fourth -->
					<div class="one-fourth">
						<?php
							// Calling the footer column 3 sidebar
							if ( is_active_sidebar( 'ambition_footer_column3' ) ) :
								dynamic_sidebar( 'ambition_footer_column3' );
							endif;
						?>
					</div><!-- .one-fourth -->
					<div class="one-fourth">
						<?php
							// Calling the footer column 3 sidebar
							if ( is_active_sidebar( 'ambition_footer_column4' ) ) :
								dynamic_sidebar( 'ambition_footer_column4' );
							endif;
						?>
					</div><!-- .one-fourth -->
				</div><!-- .widget-area --> 
			</div><!-- .container --> 
		</div><!-- .widget-wrap -->
<?php
	}
?>

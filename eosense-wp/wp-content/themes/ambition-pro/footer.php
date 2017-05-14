<?php
/**
 * Displays the footer section of the theme.
 *
 * @package 		Theme Horse
 * @subpackage 		Ambition Pro
 * @since 			Ambition Pro 1.0
 */
?>
			<?php 
				if( is_page_template( 'page-templates/page-template-business.php') ||  is_page_template( 'page-templates/page-template-testimonial.php')  ||  is_page_template( 'page-templates/page-template-services.php') ||  is_page_template( 'page-templates/page-template-ourteam.php') ) { 
					echo '';
				}else{
					echo '</div><!-- .container -->';
			} ?>
			</div><!-- #content -->
			<?php
			/**
			 * ambition_after_main hook
			 */
			do_action('ambition_after_main');
			?>
			<?php
			/**
			 * ambition_before_footer hook
			 */
			do_action('ambition_before_footer');
			?>
			<footer id="colophon" class="site-footer clearfix" role="contentinfo">
			<?php
			/**
			 * ambition_footer hook
			 *
			 * HOOKED_FUNCTION_NAME PRIORITY
			 * ambition_footer_widget_area 15
			 * ambition_footer_infobar 18
			 * ambition_open_siteinfo_div 20
			 * ambition_socialnetworks 25
			 * ambition_footer_info 30
			 * ambition_close_siteinfo_div 40
			 * ambition_backtotop_html 45
			 */
			do_action('ambition_footer');
			?>
			</footer><!-- #colophon -->
		</div><!-- #page -->
		<?php
		/**
		 * ambition_after hook
		 */
		do_action('ambition_after');
		wp_footer(); ?>
	</body>
</html>
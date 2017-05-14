<?php
/**
 * Displays the 404 error page of the theme.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
?>
<?php
get_header(); ?>
	<div id="main">
		<header class="entry-header">
			<h1 class="entry-title">
				<?php
_e('Error 404-Page NOT Found', 'ambition'); ?>
			</h1>
		</header>
	<div class="entry-content clearfix" >
		<p>
			<?php
_e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'ambition'); ?>
		</p>
		<h3>
			<?php
_e('This might be because:', 'ambition'); ?>
		</h3>
		<p>
			<?php
_e('You have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.', 'ambition'); ?>
		</p>
		<h3>
			<?php
_e('Please try the following instead:', 'ambition'); ?>
		</h3>
		<p>
			<?php
_e('Check for a mis-typed URL error, then press the refresh button on your browser.', 'ambition'); ?>
		</p>
	</div> <!-- .entry-content --> 
</div><!-- #main -->
<?php
get_footer(); ?>
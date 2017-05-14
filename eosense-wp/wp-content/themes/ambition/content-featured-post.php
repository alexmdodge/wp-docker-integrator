<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package WordPress
 * @subpackage Ambition
 * @since ambition 1.0
 */
	global $post, $ambition_settings;
	$excerpt = get_the_excerpt();
	$secondary_text = $ambition_settings['ambition_secondary_text'];
	$secondary_url = $ambition_settings['ambition_secondary_url'];
	?>
	<div class="container">
		<article class="featured-text">
			<?php the_title( sprintf( '<h2 class="featured-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ) .'<!-- .featured-title -->';
			if ($excerpt != '') { ?>
				<div class="featured-content"> <?php echo $excerpt; ?></div><!-- .featured-content -->
					<a title="<?php _e('Read More', 'ambition'); ?>" href="<?php
				echo get_permalink(); ?>" class="call-to-action active"><?php
				_e('Read More', 'ambition') ?></a>
				<?php if(!empty($secondary_text)):?>
					<a title="<?php echo esc_attr($secondary_text); ?>" href="<?php
				echo esc_url($secondary_url); ?>" class="call-to-action" target="_blank"><?php echo esc_attr($secondary_text); ?></a>
				<?php endif;
			} ?>
		</article><!-- .featured-text -->
	</div><!-- .container -->
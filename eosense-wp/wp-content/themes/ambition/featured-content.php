<?php
/**
 * The template for displaying featured content
 *
 * @package WordPress
 * @subpackage Ambition
 * @since Ambition 1.0
 */
?>
<section class="featured-slider">
	<div class="slider-cycle">
	<?php
	$i = 0;
	$featured_posts = ambition_get_featured_posts();
	foreach((array)$featured_posts as $order => $post):
		setup_postdata($post);
		$i++;
		$title_attribute = the_title_attribute( array( 'echo' => false ) );
		$excerpt = get_the_excerpt();
		if (1 == $i) {
			$classes = "slides displayblock";
		}
		else {
			$classes = "slides displaynone";
		} ?>
			<div class="<?php echo $classes; ?>">
			<?php
			$attachment_id = get_post_thumbnail_id();
			$image_attributes = wp_get_attachment_image_src($attachment_id,'full'); // returns an array
			if ($image_attributes) { ?>
				<div class="featured-image" title="<?php echo the_title_attribute('', '', false); ?>" style="background-image:url('<?php echo esc_url($image_attributes[0]); ?>')" >
					<?php get_template_part('content', 'featured-post'); ?>
				</div><!-- .featured-image -->
				<?php
			} ?>
			</div><!-- .slides -->
			<?php
	endforeach; ?>
	</div>	<!-- .slider-cycle -->
		<nav id="controllers" class="clearfix"></nav><!-- #controllers -->
</section><!-- .featured-slider -->
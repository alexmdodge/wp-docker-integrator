<?php
/**
 * Adds content structures.
 *
 * @package 		Theme Horse
 * @subpackage 		Ambition
 * @since 			Ambition 1.0
 * @license 		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link 			http://themehorse.com/themes/ambition
 */
/****************************************************************************************/
add_action( 'ambition_main_container', 'ambition_content', 10 );
/**
 * Function to display the content for the single post, single page, archive page, index page etc.
 */
function ambition_content() {
	global $post;	
	global $content_layout;
	if( $post ) {
		$layout = get_post_meta( $post->ID, 'ambition_sidebarlayout', true );
		$frontpage_id = get_option('page_on_front'); // for front page
		$banner = get_post_meta( $frontpage_id, 'ambition_sidebarlayout', true );
		$page_id = ( 'page' == get_option( 'show_on_front' ) ? get_option( 'page_for_posts' ) : get_the_ID() );
		$home_blog = get_post_meta( $page_id, 'ambition_sidebarlayout', true ); 
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}
	if(is_front_page() && $banner):
		if( 'default' == $banner ) {//checked from the themeoptions.
		$themeoption_layout = $content_layout;
			if( 'left' == $themeoption_layout ) { 
			get_template_part( 'content','leftsidebar' );//used content-leftsidebar.php
			}
			elseif( 'right' == $themeoption_layout ) { 
			get_template_part( 'content','rightsidebar' );//used content-rightsidebar.php
			}
			else {
			get_template_part( 'content','nosidebar' );//used content-nosidebar.php
			}
		}
		elseif( 'left-sidebar' == $banner ) { //checked from the particular page / post.
			get_template_part( 'content','leftsidebar' );//used content-leftsidebar.php
		}
		elseif( 'right-sidebar' == $banner ) {
			get_template_part( 'content','rightsidebar' );//used content-rightsidebar.php
		}
		else { 
			get_template_part( 'content','nosidebar' );//used content-nosidebar.php
		}
		elseif(is_front_page()):
		if( 'default' == $layout ) {//checked from the themeoptions.
		$themeoption_layout = $content_layout;
			if( 'left' == $themeoption_layout ) { 
			get_template_part( 'content','leftsidebar' );//used content-leftsidebar.php
			}
			elseif( 'right' == $themeoption_layout ) { 
			get_template_part( 'content','rightsidebar' );//used content-rightsidebar.php
			}
			else {
			get_template_part( 'content','nosidebar' );//used content-nosidebar.php
			}
		}
		elseif( 'left-sidebar' == $layout ) { //checked from the particular page / post.
			get_template_part( 'content','leftsidebar' );//used content-leftsidebar.php
		}
		elseif( 'right-sidebar' == $layout ) {
			get_template_part( 'content','rightsidebar' );//used content-rightsidebar.php
		}
		else { 
			get_template_part( 'content','nosidebar' );//used content-nosidebar.php
		}
	elseif(is_home()):
		if( 'default' == $home_blog ) {//checked from the themeoptions.
		$themeoption_layout = $content_layout;
			if( 'left' == $themeoption_layout ) { 
			get_template_part( 'content','leftsidebar' );//used content-leftsidebar.php
			}
			elseif( 'right' == $themeoption_layout ) { 
			get_template_part( 'content','rightsidebar' );//used content-rightsidebar.php
			}
			else {
			get_template_part( 'content','nosidebar' );//used content-nosidebar.php
			}
		}
		elseif( 'left-sidebar' == $home_blog ) { //checked from the particular page / post.
			get_template_part( 'content','leftsidebar' );//used content-leftsidebar.php
		}
		elseif( 'right-sidebar' == $home_blog ) {
			get_template_part( 'content','rightsidebar' );//used content-rightsidebar.php
		}
		else { 
			get_template_part( 'content','nosidebar' );//used content-nosidebar.php
		}
	else:
		if( 'default' == $layout ) { //checked from the themeoptions.
		$themeoption_layout = $content_layout;
			if( 'left' == $themeoption_layout ) {

			get_template_part( 'content','leftsidebar' );//used content-leftsidebar.php
			}
			elseif( 'right' == $themeoption_layout ) {
			get_template_part( 'content','rightsidebar' );//used content-rightsidebar.php
			}
			else {
			get_template_part( 'content','nosidebar' );//used content-nosidebar.php
			}
		}
		elseif( 'left-sidebar' == $layout ) {//checked from the particular page / post.
			get_template_part( 'content','leftsidebar' );//used content-leftsidebar.php
		}
		elseif( 'right-sidebar' == $layout ) {
			get_template_part( 'content','rightsidebar' );//used content-rightsidebar.php
		}
		else {
			get_template_part( 'content','nosidebar' );//used content-nosidebar.php
		}
	endif;
}
/****************************************************************************************/
add_action( 'ambition_before_loop_content', 'ambition_loop_before', 10 );
/**
 * Contains the opening div
 */
function ambition_loop_before() {
	echo '<div id="main">';
}
/****************************************************************************************/
add_action( 'ambition_loop_content', 'ambition_theloop', 10 );
/**
 * Shows the loop content
 */
function ambition_theloop() {
	if( is_page() ) {
		ambition_theloop_for_page();
	}
	elseif( is_single() ) {
		ambition_theloop_for_single();
	}
	elseif( is_search() ) {
		ambition_theloop_for_search();
	}
	else {
		ambition_theloop_for_archive();
	}
}
/****************************************************************************************/
if ( ! function_exists( 'ambition_theloop_for_archive' ) ) :
/**
 * Fuction to show the archive loop content.
 */
function ambition_theloop_for_archive() {
	global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			do_action( 'ambition_before_post' ); ?>
		<section id="post-<?php the_ID(); ?> clearfix" <?php post_class(); ?>>
			<?php do_action( 'ambition_before_post_header' ); ?>
			<article>
				<header class="entry-header">
				<?php 
				if (get_the_author() !=''){?>
					<div class="entry-meta">
						<span class="cat-links"><?php the_category(', '); ?></span><!-- .cat-links --> 
					</div> <!-- .entry-meta -->
				<?php
				} ?>
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
							<?php the_title();?>
						</a>
					</h2><!-- .entry-title -->
				<?php 
		      if (has_category() !=''){?>
					<div class="entry-meta clearfix">
						<div class="by-author vcard author">
							<span class="fn">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php  esc_attr(the_author()); ?>">
								<?php the_author(); ?> </a>
							</span>
						</div>
						<div class="date updated"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_time() ); ?>">
							<?php the_time( get_option( 'date_format' ) ); ?></a>
						</div>
						<?php 
						if ( comments_open() ) { ?>
						<div class="comments">
							<?php comments_popup_link( __( 'No Comments', 'ambition' ), __( '1 Comment', 'ambition' ), __( '% Comments', 'ambition' ), '', __( 'Comments Off', 'ambition' ) ); ?>
						</div>
						<?php
						} ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->
				<?php
					if( has_post_thumbnail() ) {
						$image = '';        			
						$title_attribute = the_title_attribute( array( 'echo' => false ) );
						$image .= '<figure class="post-featured-image">';
						$image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
						$image .= get_the_post_thumbnail( $post->ID, 'ambition-featured-large', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
						$image .= '</figure><!-- .post-featured-image -->';
						echo $image;
					} ?>
				<div class="entry-content clearfix">
					<?php the_excerpt(); ?>
					<p><a href="<?php the_permalink();?>" class="readmore"><?php _e('Read More','ambition')?></a>
					</p>
				</div><!-- .entry-content -->
					<?php $tag_list = get_the_tag_list( '', __( ', ', 'ambition' ) ); ?>
				<footer class="entry-meta clearfix">
					<?php if(!empty($tag_list)){ ?>
					<span class="tag-links">
						<?php   echo $tag_list; ?>
					</span><!-- .tag-links -->
				<?php  } ?>
				</footer><!-- .entry-meta -->
				<?php 
				}else { 
					the_content();
				} ?>
			</article>
		</section><!-- .post -->
		<?php
			do_action( 'ambition_after_post' );
		}
	}
	else {
	?>
		<h2 class="entry-title">
			<?php _e( 'No Posts Found.', 'ambition' ); ?>
		</h2>
	<?php
	}
}
endif;
/****************************************************************************************/
if ( ! function_exists( 'ambition_theloop_for_page' ) ) :
/**
 * Fuction to show the page content.
 */
function ambition_theloop_for_page() {
	global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			do_action( 'ambition_before_post' ); ?>
				<?php
					if( is_home() || is_front_page() ) { ?>
				<header class="entry-header">
					<h2 class="entry-title">
						<?php the_title(); ?>
					</h2><!-- .entry-title -->
				</header>
				<?php
					} ?>
				<?php do_action( 'ambition_after_post_header' ); ?>
				<?php do_action( 'ambition_before_post_content' );
					the_content(); ?>
				<?php
					wp_link_pages( array( 
					'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'ambition' ),
					'after'             => '</div>',
					'link_before'       => '<span>',
					'link_after'        => '</span>',
					'pagelink'          => '%',
					'echo'              => 1
					) );
				?>
				<?php 
					do_action( 'ambition_after_post_content' );
					do_action( 'ambition_before_comments_template' );
					comments_template(); 
					do_action ( 'ambition_after_comments_template' );
				?>
		<?php
			do_action( 'ambition_after_post' );
		}
	}
	else { ?>
	<h2 class="entry-title">
		<?php _e( 'No Posts Found.', 'ambition' ); ?>
	</h2>
<?php
	}
}
endif;
/****************************************************************************************/
if ( ! function_exists( 'ambition_theloop_for_single' ) ) :
/**
 * Fuction to show the single post content.
 */
function ambition_theloop_for_single() {
	global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			do_action( 'ambition_before_post' ); ?>
		<section id="post-<?php the_ID(); ?> clearfix" <?php post_class(); ?>>
			<article>
				<header class="entry-header">
					<?php if(get_the_time( get_option( 'date_format' ) )) { ?>
					<div class="entry-meta">
						<span class="cat-links">
							<?php the_category(', '); ?>
						</span><!-- .cat-links --> 
					</div><!-- .entry-meta -->
					<h2 class="entry-title">
						<?php the_title();?>
					</h2> <!-- .entry-title -->
					<div class="entry-meta clearfix">
						<div class="by-author vcard author">
							<span class="fn">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"  title="<?php  esc_attr(the_author()); ?>">
								<?php the_author(); ?> </a>
							</span>
						</div>
						<div class="date updated"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_time() ); ?>">
							<?php the_time( get_option( 'date_format' ) ); ?> </a>
						</div>
						<?php if ( comments_open() ) { ?>
						<div class="comments">
							<?php comments_popup_link( __( 'No Comments', 'ambition' ), __( '1 Comment', 'ambition' ), __( '% Comments', 'ambition' ), '', __( 'Comments Off', 'ambition' ) ); ?>
						</div>
						<?php } ?>
					</div><!-- .entry-meta --> 
				</header><!-- .entry-header -->
				<?php
					} ?>
				<div class="entry-content clearfix">
					<?php the_content();
					wp_link_pages( array( 
						'before'			=> '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'ambition' ),
						'after'			=> '</div>',
						'link_before'	=> '<span>',
						'link_after'	=> '</span>',
						'pagelink'		=> '%',
						'echo'			=> 1
					) ); ?>
				</div><!-- entry content clearfix -->
					<?php if(get_the_time( get_option( 'date_format' ) )) { ?>
				</header>
				<?php } ?>
					<?php if( is_single() ) {
						$tag_list = get_the_tag_list( '', __( ' ', 'ambition' ) ); ?>
				<footer class="entry-meta clearfix">
					<?php if( !empty( $tag_list ) ) { ?>
						<span class="tag-links">
							<?php echo $tag_list;?>
						</span><!-- .tag-links -->
					<?php } ?>
				</footer><!-- .entry-meta -->
				<?php 
					do_action( 'ambition_after_post_content' );
				}
					do_action( 'ambition_before_comments_template' );
					comments_template();
					do_action ( 'ambition_after_comments_template' );
				?>
			</article>
		</section><!-- .post -->
<?php
			do_action( 'ambition_after_post' );
		}
	}
	else {
	?>
		<h2 class="entry-title">
			<?php _e( 'No Posts Found.', 'ambition' ); ?>
		</h2>
	<?php
	}
}
endif;
/****************************************************************************************/
if ( ! function_exists( 'ambition_theloop_for_search' ) ) :
/**
 * Fuction to show the search results.
 */
function ambition_theloop_for_search() {
	global $post;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			do_action( 'ambition_before_post' ); ?>
		<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<article>
				<?php do_action( 'ambition_before_post_header' ); ?>
				<header class="entry-header">
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
							<?php the_title(); ?>
						</a>
					</h2><!-- .entry-title -->
				</header>
				<?php do_action( 'ambition_after_post_header' ); ?>
				<?php do_action( 'ambition_before_post_content' ); ?>
				<div class="entry-content clearfix">
					<?php the_excerpt(); ?>
				</div>
				<?php do_action( 'ambition_after_post_content' ); ?>
			</article>
		</section>
			<?php do_action( 'ambition_after_post' );
		}
	}
	else {
		?>
	<h2 class="entry-title">
		<?php _e( 'No Posts Found.', 'ambition' ); ?>
	</h2>
<?php
	}
}
endif;
/****************************************************************************************/
add_action( 'ambition_after_loop_content', 'ambition_next_previous', 5 );
/**
 * Shows the next or previous posts
 */
function ambition_next_previous() {
	if( is_archive() || is_home() || is_search() ) {
		/**
		 * Checking WP-PageNaviplugin exist
		 */
		if ( function_exists('wp_pagenavi' ) ) :
			wp_pagenavi();
		else: 
			global $wp_query;
			if ( $wp_query->max_num_pages > 1 ) : ?>
				<ul class="default-wp-page clearfix">
					<li class="previous">
						<?php next_posts_link( __( '&laquo; Previous', 'ambition' ) ); ?>
					</li>
					<li class="next">
						<?php previous_posts_link( __( 'Next &raquo;', 'ambition' ) ); ?>
					</li>
				</ul>
			<?php
			endif;
		endif;
	}
}
/****************************************************************************************/
add_action( 'ambition_after_post_content', 'ambition_next_previous_post_link', 10 );
/**
 * Shows the next or previous posts link with respective names.
 */
function ambition_next_previous_post_link() {
	if ( is_single() ) {
		if( is_attachment() ) {
		?>
		<ul class="default-wp-page clearfix">
			<li class="previous">
				<?php previous_image_link( false, __( '&larr; Previous', 'ambition' ) ); ?>
			</li>
			<li class="next">
				<?php next_image_link( false, __( 'Next &rarr;', 'ambition' ) ); ?>
			</li>
		</ul>
		<?php
		}
		else {
		?>
		<ul class="default-wp-page clearfix">
			<li class="previous">
				<?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'ambition' ) . '</span> %title' ); ?>
			</li>
			<li class="next">
				<?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'ambition' ) . '</span>' ); ?>
			</li>
		</ul>
<?php
		}
	}
}
/****************************************************************************************/
add_action( 'ambition_after_loop_content', 'ambition_loop_after', 10 );
/**
 * Contains the closing div
 */
function ambition_loop_after() {
	echo '</div><!-- #main -->';
}
/****************************************************************************************/
if ( ! function_exists( 'ambition_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own ambition_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Ambition 1.0
 */
function ambition_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	case 'pingback' :
	case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	<p>
		<?php _e( 'Pingback:', 'ambition' ); ?>
		<?php comment_author_link(); ?>
		<?php edit_comment_link( __( '(Edit)', 'ambition' ), '<span class="edit-link">', '</span>' ); ?>
	</p>
	<?php
		break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<article id="comment-<?php comment_ID(); ?>" class="comment">
		<header class="comment-meta comment-author vcard">
			<?php
				echo get_avatar( $comment, 44 );
				printf( '<cite class="fn">%1$s %2$s</cite>',
				get_comment_author_link(),
				// If current post author is also comment author, make it known visually.
				( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'ambition' ) . '</span>' : ''
				);
				printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
				esc_url( get_comment_link( $comment->comment_ID ) ),
				get_comment_time( 'c' ),
				/* translators: 1: date, 2: time */
				sprintf( __( '%1$s at %2$s', 'ambition' ), get_comment_date(), get_comment_time() )
				);
			?>
		</header> <!-- .comment-meta -->
		<?php if ( '0' == $comment->comment_approved ) : ?>
			<p class="comment-awaiting-moderation">
				<?php _e( 'Your comment is awaiting moderation.', 'ambition' ); ?>
			</p>
		<?php endif; ?>
		<section class="comment-content comment">
			<?php comment_text(); ?>
			<?php edit_comment_link( __( 'Edit', 'ambition' ), '<p class="edit-link">', '</p>' ); ?>
		</section><!-- .comment-content -->
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'ambition' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply --> 
	</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
/****************************************************************************************/
add_action( 'ambition_contact_page_template_content', 'ambition_display_contact_page_template_content', 10 );
/**
 * Displays the contact page template content.
 */
function ambition_display_contact_page_template_content() {
	global $post;	
	global $content_layout;
	if( $post ) {
		$layout = get_post_meta( $post->ID, 'ambition_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}
	if( 'default' == $layout ) { //checked from the themeoptions.
	$themeoption_layout = $content_layout;
		if( 'left' == $themeoption_layout ) {
		get_template_part( 'content','leftsidebar' );//used content-leftsidebar.php
		}
		elseif( 'right' == $themeoption_layout ) {
		get_template_part( 'content','rightsidebar' );//used content-rightsidebar.php
		}
		else {
		get_template_part( 'content','nosidebar' );//used content-nosidebar.php
		}
	}
	elseif( 'left-sidebar' == $layout ) { //checked from the particular page / post.
		get_template_part( 'content','leftsidebar' );//used content-leftsidebar.php
	}
	elseif( 'right-sidebar' == $layout ) {
		get_template_part( 'content','rightsidebar' );//used content-rightsidebar.php
	}
	else {
		get_template_part( 'content','nosidebar' );//used content-nosidebar.php
	}
}
/****************************************************************************************/
add_action( 'ambition_business_template_content', 'ambition_business_template_widgetized_content');
/**
 * Displays the widget as contents
 */
function ambition_business_template_widgetized_content() { ?>
  <?php if( is_active_sidebar( 'ambition_business_page_sidebar' ) ) : ?>
			<div id="main">
			<?php // Calling the footer sidebar
				dynamic_sidebar( 'ambition_business_page_sidebar' ); ?>
			</div><!-- #main -->
			<?php endif;
}
?>

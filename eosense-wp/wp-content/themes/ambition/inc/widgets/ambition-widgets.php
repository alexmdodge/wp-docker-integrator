<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
/****************************************************************************************/
add_action('widgets_init', 'ambition_widgets_init');
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function ambition_widgets_init()
{
	// Registering main left sidebar
	register_sidebar(array(
		'name' => __('Left Sidebar', 'ambition') ,
		'id' => 'ambition_left_sidebar',
		'description' => __('Shows widgets at Left side.', 'ambition') ,
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	// Registering main right sidebar
	register_sidebar(array(
		'name' => __('Right Sidebar', 'ambition') ,
		'id' => 'ambition_right_sidebar',
		'description' => __('Shows widgets at Right side.', 'ambition') ,
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	// Registering Business Page template sidebar
	register_sidebar(array(
		'name' => __('Business Page Section', 'ambition') ,
		'id' => 'ambition_business_page_sidebar',
		'description' => __('Shows widgets on Business Page Template. Suitable widget: TH: Featured Page, TH: Featured Recent Work, TH: Testimonial, TH: Services, TH: PromoBox', 'ambition') ,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	// Registering contact Page sidebar
	register_sidebar(array(
		'name' => __('Contact Page Sidebar', 'ambition') ,
		'id' => 'ambition_contact_page_sidebar',
		'description' => __('Shows widgets on Contact Page Template.', 'ambition') ,
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	/**
	 * Registering footer sidebar 1
	 * For upgrade compatible reason footer id not kept ambition_footer_column1
	 */
	register_sidebar(array(
		'name' => __('Footer - Column1', 'ambition') ,
		'id' => 'ambition_footer_sidebar',
		'description' => __('Shows widgets at footer Column 1.', 'ambition') ,
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	// Registering footer sidebar 2
	register_sidebar(array(
		'name' => __('Footer - Column2', 'ambition') ,
		'id' => 'ambition_footer_column2',
		'description' => __('Shows widgets at footer Column 2.', 'ambition') ,
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	// Registering footer sidebar 3
	register_sidebar(array(
		'name' => __('Footer - Column3', 'ambition') ,
		'id' => 'ambition_footer_column3',
		'description' => __('Shows widgets at footer Column 3.', 'ambition') ,
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	// Registering footer sidebar 4
	register_sidebar(array(
		'name' => __('Footer - Column4', 'ambition') ,
		'id' => 'ambition_footer_column4',
		'description' => __('Shows widgets at footer Column 4.', 'ambition') ,
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	// Registering widgets
	register_widget("ambition_custom_tag_widget");
	register_widget("ambition_service_widget");
	register_widget("ambition_promobox_widget");
	register_widget("ambition_recent_work_widget");
	register_widget("ambition_Widget_Testimonial");
	register_widget("ambition_Widget_featured_page");
	register_widget("ambition_featured_image_widget");
}
/****************************************************************************************/
/**
 * Widget for business layout that shows selected page content,title and featured image.
 * Construct the widget.
 * i.e. Name, description and control options.
 */
class ambition_Widget_featured_page extends WP_Widget

{
	function ambition_Widget_featured_page()
	{
		$widget_ops = array(
			'classname' => 'widget_featured_page',
			'description' => __('Display Featured Page ( Business Layout )', 'ambition')
		);
		$control_ops = array(
			'width' => 200,
			'height' => 250
		);
		parent::__construct(false, $name = __('TH: Featured Page', 'ambition') , $widget_ops, $control_ops);
	}
	function form($instance)
	{

		$instance = wp_parse_args((array)$instance, array(
			'description' => '', 'left' => true, 'right' => false, 'middle' => false 
		));
		for ($i = 0; $i < 1; $i++) {
			$var = 'page_id' . $i;
			$defaults[$var] = '';
		}
		$instance = wp_parse_args((array)$instance, $defaults);
		for ($i = 0; $i < 1; $i++) {
			$var = 'page_id' . $i;
			$var = absint($instance[$var]);
		}
		$description = esc_textarea($instance['description']);
		$featured_display = ( isset( $instance['featured_display'] ) && is_numeric( $instance['featured_display'] ) ) ? (int) $instance['featured_display'] : 1; ?>
		<p>
			<legend><?php _e('Display your Featured Page Content:','ambition');?></legend>
			<input type="radio" id="<?php echo ($this->get_field_id( 'featured_display' ) . '-1') ?>" name="<?php echo ($this->get_field_name( 'featured_display' )) ?>" value="1" <?php checked( $featured_display == 1, true) ?>>
			<label for="<?php echo ($this->get_field_id( 'featured_display' ) . '-1' ) ?>"><?php _e('Left', 'ambition') ?></label> 

			<input type="radio" id="<?php echo ($this->get_field_id( 'featured_display' ) . '-2') ?>" name="<?php echo ($this->get_field_name( 'featured_display' )) ?>" value="2" <?php checked( $featured_display == 2, true) ?>>
			<label for="<?php echo ($this->get_field_id( 'featured_display' ) . '-2' ) ?>"><?php _e('Right', 'ambition') ?></label> 

			<input type="radio" id="<?php echo ($this->get_field_id( 'featured_display' ) . '-3') ?>" name="<?php echo ($this->get_field_name( 'featured_display' )) ?>" value="3" <?php checked( $featured_display == 3, true) ?>>
			<label for="<?php echo ($this->get_field_id( 'featured_display' ) . '-3' ) ?>"><?php _e('Middle', 'ambition') ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>">
					<?php _e('Description:', 'ambition'); ?>
			</label>
			<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo $description; ?></textarea>
		</p>
		<?php
		for ($i = 0; $i < 1; $i++) { ?>
			<label for="<?php
			echo $this->get_field_id(key($defaults)); ?>">
							<?php
			_e('Page', 'ambition'); ?>
						:</label>
						<?php
			wp_dropdown_pages(array(
				'show_option_none' => ' ',
				'name' => $this->get_field_name(key($defaults)) ,
				'selected' => $instance[key($defaults) ]
			)); ?>
		<?php
			next($defaults); // forwards the key of $defaults array
		}
	}
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['description'] = esc_textarea($new_instance['description']);
		$instance['featured_display'] = ( isset( $new_instance['featured_display'] ) && $new_instance['featured_display'] > 0 && $new_instance['featured_display'] < 4 ) ? (int) $new_instance['featured_display'] : 0;
		for ($i = 0; $i < 1; $i++) {
			$var = 'page_id' . $i;
			$instance[$var] = absint($new_instance[$var]);	
		}
		return $instance;
	}
	function widget($args, $instance)
	{
		$featured_display = ( isset( $instance['featured_display'] ) && is_numeric( $instance['featured_display'] ) ) ? (int) $instance['featured_display'] : 1;
		extract($args);
		extract($instance);
		global $post;
		$page_array = array();
		for ($i = 0; $i < 1; $i++) {
			$var = 'page_id' . $i;
			$page_id = isset($instance[$var]) ? $instance[$var] : '';
			if (!empty($page_id)) {
				array_push($page_array, $page_id);
			}
			// Push the page id in the array
		}
		$get_featured_pages = new WP_Query(array(
			'posts_per_page' => - 1,
			'post_type' => array(
				'page'
			) ,
			'post__in' => $page_array,
			'orderby' => 'post__in'
		));
		echo $before_widget;
		$j = 1;
		$description = apply_filters('description', empty($instance['description']) ? '' : $instance['description'], $instance, $this->id_base);
		while ($get_featured_pages->have_posts()):
			$get_featured_pages->the_post();
			$page_title = get_the_title();?>
			<div class="container clearfix<?php if($featured_display == 2){ echo ' opp'; }elseif($featured_display == 3){ echo ' midd'; } else{ echo ''; } ?>">
				<div class="featured-page-content">
					<h2 class="widget-title"><?php echo $page_title; ?></h2>
					<?php if(!empty($description)){ ?>
					<p class="highlighted-content"><?php echo $description; ?></p>
					<?php } ?>
					<?php the_excerpt(); ?>
					<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="call-to-action"><?php _e('Read more', 'ambition'); ?></a>
				</div>
				<?php if (has_post_thumbnail()) { ?>
				<div class="featured-page-image">
					<figure><?php
					$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
					<img alt="<?php echo esc_attr($page_title); ?>" src="<?php echo esc_url($url); ?>"></figure>
				</div>
				<?php } ?>
			</div><!-- .container -->
		<?php
		$j++;
		endwhile;
		// Reset Post Data
		wp_reset_query(); ?>
		<?php
		echo $after_widget . '<!-- .widget_featured_page -->';
	}
}
/****************************************************************************************/
/**
 * Extends class wp_widget
 *
 * Creates a function CustomTagWidget
 * $widget_ops option array passed to wp_register_sidebar_widget().
 * $control_ops option array passed to wp_register_widget_control().
 * $name, Name for this widget which appear on widget bar.
 */
class ambition_custom_tag_widget extends WP_Widget

{
	function ambition_custom_tag_widget()
	{
		$widget_ops = array(
			'classname' => 'widget_custom-tagcloud',
			'description' => __('Displays Custom Tag Cloud', 'ambition')
		);
		$control_ops = array(
			'width' => 200,
			'height' => 250
		);
		parent::__construct(false, $name = __('TH: Custom Tag Cloud', 'ambition') , $widget_ops, $control_ops);
	}
	/** Displays the Widget in the front-end.
	 *
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */
	function widget($args, $instance)
	{
		extract($args);
		extract($instance);
		$title = empty($instance['title']) ? 'Tags' : $instance['title'];
		echo $before_widget;
		if ($title):
			echo $before_title . $title . $after_title;
		endif;
		wp_tag_cloud('smallest=13&largest=13px&unit=px');
		echo $after_widget . '<!-- .widget .widget_custom-tagcloud -->';
	}
	/**
	 * update the particular instant
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	/**
	 * Creates the form for the widget in the back-end which includes the Title
	 * $instance Current settings
	 */
	function form($instance)
	{
		$instance = wp_parse_args(( array )$instance, array(
			'title' => 'Tags'
		));
		$title = esc_attr($instance['title']); ?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">
					<?php _e('Title:', 'ambition'); ?>
				</label>
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>
		<?php
	}
}
/****************************************************************************************/
/**
 * Widget for business layout that shows selected page content,title and featured image.
 * Construct the widget.
 * i.e. Name, description and control options.
 */
class ambition_service_widget extends WP_Widget

{
	function ambition_service_widget()
	{
		$widget_ops = array(
			'classname' => 'widget_service',
			'description' => __('Display Services ( Business Layout )', 'ambition')
		);
		$control_ops = array(
			'width' => 200,
			'height' => 250
		);
		parent::__construct(false, $name = __('TH: Services', 'ambition') , $widget_ops, $control_ops);
	}
	function form($instance)
	{
		for ($i = 0; $i < 6; $i++) {
			$var = 'page_id' . $i;
			$defaults[$var] = '';
		}
		$instance = wp_parse_args((array)$instance, $defaults);
		for ($i = 0; $i < 6; $i++) {
			$var = 'page_id' . $i;
			$var = absint($instance[$var]);
		}
		for ($i = 0; $i < 6; $i++) { ?>
			<p>
				<label for="<?php echo $this->get_field_id(key($defaults)); ?>">
					<?php _e('Page', 'ambition'); ?>
				:</label>
					<?php wp_dropdown_pages(array(
								'show_option_none' => ' ',
								'name' => $this->get_field_name(key($defaults)) ,
								'selected' => $instance[key($defaults) ]
							)); ?>
			</p>
		<?php next($defaults); // forwards the key of $defaults array
		}
	}
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		for ($i = 0; $i < 6; $i++) {
			$var = 'page_id' . $i;
			$instance[$var] = absint($new_instance[$var]);
		}
		return $instance;
	}
	function widget($args, $instance)
	{
		extract($args);
		extract($instance);
		global $post;
		$page_array = array();
		for ($i = 0; $i < 6; $i++) {
			$var = 'page_id' . $i;
			$page_id = isset($instance[$var]) ? $instance[$var] : '';
			if (!empty($page_id)) {
				array_push($page_array, $page_id);
			}
			// Push the page id in the array
		}
		$get_featured_pages = new WP_Query(array(
			'posts_per_page' => - 1,
			'post_type' => array(
				'page'
			) ,
			'post__in' => $page_array,
			'orderby' => 'post__in'
		));
		echo $before_widget; ?>
			<div class="container clearfix">
				<div class="column clearfix">
				<?php
					$j = 1;
					while ($get_featured_pages->have_posts()):$get_featured_pages->the_post();
					$page_title = get_the_title();
					if ($j%6 == 1  && $j > 1) {
							$service_class = "one-third clearfix-half clearfix-third";
					}
					elseif ($j%2 == 1 && $j > 1) {
						$service_class = "one-third clearfix-half";
					}
					 elseif ($j%3 == 1 && $j > 1) {
						$service_class = "one-third clearfix-third";
					}
					
					 else {
						$service_class = "one-third";
					}
				?>
				<div class="<?php echo $service_class; ?>">
				<?php
					if (has_post_thumbnail()) { ?>
					<div class="service-img"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"> <?php echo get_the_post_thumbnail( $post->ID, 'ambition-icon'); ?> </a>
					</div>
					<?php	} ?>
					<h3 class="service-title"><a title="<?php echo esc_attr($page_title); ?>" href="<?php the_permalink(); ?>"><?php echo esc_attr($page_title); ?></a></h3>
					<?php 
					$excerpt = get_the_excerpt();
					if($excerpt !=''): ?>
					<article>
						<p><?php if(strlen($excerpt) >130){
							$excerpt_length = substr($excerpt, 0 , 130);	
							echo $excerpt_length . '...'; ?>
						</p>
					</article>
					<a title="<?php the_title_attribute(); ?>" href="<?php
					the_permalink(); ?>" class="more-link"><?php _e('Read more', 'ambition'); ?></a>
					<?php }else{
						echo $excerpt; ?>
					</article>
					<?php	}
					endif; ?>
				</div><!-- .one-third -->
				<?php
					$j++; ?>
					<?php
				endwhile;
				// Reset Post Data
				wp_reset_query(); ?>
				</div><!-- .column -->
			</div><!-- .container -->
	<?php echo $after_widget;
	}
}
/**************************************************************************************/
/**
 * Widget for business layout that shows Promo Box.
 * Construct the widget.
 * i.e. Home Page PromoBox1, Home Page PromoBox2, Redirect Button Text and Redirect Button Link
 */
class ambition_promobox_widget extends WP_Widget

{
	function ambition_promobox_widget()
	{
		$widget_ops = array(
			'classname' => 'widget_promotional_bar',
			'description' => __('Display PromoBox ( Business Layout )', 'ambition')
		);
		$control_ops = array(
			'width' => 200,
			'height' => 250
		);
		parent::__construct(false, $name = __('TH: PromoBox', 'ambition') , $widget_ops, $control_ops);
	}
	function widget($args, $instance)
	{
		extract($args);
		$ambition_promotional_img_background = apply_filters('ambition_promotional_img_background', empty($instance['ambition_promotional_img_background']) ? '' : $instance['ambition_promotional_img_background'], $instance, $this->id_base);
		$ambition_widget_primary = apply_filters('ambition_widget_primary', empty($instance['ambition_widget_primary']) ? '' : $instance['ambition_widget_primary'], $instance, $this->id_base);
		$ambition_widget_secondary = apply_filters('ambition_widget_secondary', empty($instance['ambition_widget_secondary']) ? '' : $instance['ambition_widget_secondary'], $instance, $this->id_base);
		$ambition_redirect_text = apply_filters('ambition_redirect_text', empty($instance['ambition_redirect_text']) ? '' : $instance['ambition_redirect_text'], $instance);
		$ambition_widget_redirecturl = apply_filters('ambition_widget_redirecturl', empty($instance['ambition_widget_redirecturl']) ? '' : $instance['ambition_widget_redirecturl'], $instance, $this->id_base);
		echo $before_widget; ?>
		<div class="promotional_bar_content" <?php if (!empty($ambition_promotional_img_background)) { ?> style="background-image:url('<?php echo esc_url($ambition_promotional_img_background); ?>');" <?php } ?> >
			<div class="container clearfix">
				<?php
				if (!empty($ambition_widget_primary)) { ?>
				<h2 class="widget-title"><?php echo esc_html($ambition_widget_primary); ?> </h2>
				<?php } 
				if(!empty($ambition_widget_secondary)) { ?> 
				<p class="highlight-content"><?php echo esc_html($ambition_widget_secondary); ?> </p>
				<?php }
				if(!empty($ambition_redirect_text)) { ?>
				<a class="call-to-action" href="<?php echo esc_html($ambition_widget_redirecturl); ?>" title="<?php echo $ambition_redirect_text; ?>"><?php echo esc_html($ambition_redirect_text); ?></a><!-- .call-to-action -->
				<?php } ?>
			</div><!-- .container -->
		</div><!-- .promotional_bar_content -->
		<?php echo $after_widget . '<!-- .widget_promotional_bar -->';
	}
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['ambition_promotional_img_background'] = strip_tags($new_instance['ambition_promotional_img_background']);
		$instance['ambition_widget_primary'] = esc_textarea($new_instance['ambition_widget_primary']);
		$instance['ambition_widget_secondary'] = esc_textarea($new_instance['ambition_widget_secondary']);
		$instance['ambition_widget_redirecturl'] = esc_url($new_instance['ambition_widget_redirecturl']);
		$instance['ambition_redirect_text'] = strip_tags($new_instance['ambition_redirect_text']);
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}
	function form($instance)
	{
		$instance = wp_parse_args((array)$instance, array(
			'ambition_promotional_img_background' => '',
			'ambition_widget_primary' => '',
			'ambition_widget_secondary' => '',
			'ambition_redirect_text' => '',
			'ambition_widget_redirecturl' => ''
		));
		$ambition_promotional_img_background = strip_tags($instance['ambition_promotional_img_background']);
		$ambition_widget_primary = esc_textarea($instance['ambition_widget_primary']);
		$ambition_widget_secondary = esc_textarea($instance['ambition_widget_secondary']);
		$ambition_redirect_text = strip_tags($instance['ambition_redirect_text']);
		$ambition_widget_redirecturl = esc_url($instance['ambition_widget_redirecturl']); ?>
		<p>
			<label for="<?php echo $this->get_field_id('ambition_promotional_img_background'); ?>">
				<?php _e('Background Image:', 'ambition'); ?>
			</label>
			<input type="text" class="upload1" id="<?php echo $this->get_field_id( 'ambition_promotional_img_background' ); ?>" name="<?php echo $this->get_field_name('ambition_promotional_img_background'); ?>" value="<?php echo $ambition_promotional_img_background; ?>"/>

         <input type="button" class="button  custom_media_button"name="<?php echo $this->get_field_name('ambition_promotional_img_background'); ?>" id="custom_media_button_services" value="Upload Image" onclick="mediaupload.uploader( '<?php echo $this->get_field_id( 'ambition_promotional_img_background' ); ?>' ); return false;"/>

		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ambition_widget_primary'); ?>">
				<?php _e('Primary Promotional:', 'ambition'); ?>
			</label>
			<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('ambition_widget_primary'); ?>" name="<?php echo $this->get_field_name('ambition_widget_primary'); ?>"><?php echo $ambition_widget_primary;?></textarea>
		</p>
				<?php _e('Secondary Promotional', 'ambition'); ?>
			<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('ambition_widget_secondary'); ?>" name="<?php echo $this->get_field_name('ambition_widget_secondary'); ?>"><?php echo $ambition_widget_secondary; ?></textarea>
		<p>
			<label for="<?php echo $this->get_field_id('ambition_redirect_text'); ?>">
				<?php _e('Redirect Text:', 'ambition'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('ambition_redirect_text'); ?>" name="<?php echo $this->get_field_name('ambition_redirect_text'); ?>" type="text" value="<?php echo esc_attr($ambition_redirect_text); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ambition_widget_redirecturl'); ?>">
				<?php _e('Redirect Url:', 'ambition'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('ambition_widget_redirecturl'); ?>" name="<?php echo $this->get_field_name('ambition_widget_redirecturl'); ?>" type="text" value="<?php echo $ambition_widget_redirecturl; ?>" />
		</p>
		<?php
	}
}
/**************************************************************************************/
/**
 * Widget for business layout that shows Featured page title and featured image.
 * Construct the widget.
 * Widget for the recent work
 * i.e. Name, description and control options.
 */
class ambition_recent_work_widget extends WP_Widget

{
	function ambition_recent_work_widget()
	{
		$widget_ops = array(
			'classname' => 'widget_recent_work clearfix',
			'description' => __('Use this widget to show recent work, portfolio or any pages as your wish ( Business Layout )', 'ambition')
		);
		$control_ops = array(
			'width' => 200,
			'height' => 250
		);
		parent::__construct(false, $name = __('TH: Featured Recent Work', 'ambition') , $widget_ops, $control_ops);
	}
	function form($instance)
	{
		for ($i = 0; $i < 3; $i++) {
			$var = 'page_id' . $i;
			$defaults[$var] = '';
		}
		$att_defaults = $defaults;
		$att_defaults['title'] = '';
		$att_defaults['text'] = '';
		$instance = wp_parse_args((array)$instance, $att_defaults);
		for ($i = 0; $i < 3; $i++) {
			$var = 'page_id' . $i;
			$var = absint($instance[$var]);
		}
		$title = esc_attr($instance['title']);
		$text = esc_textarea($instance['text']); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Title:', 'ambition'); ?>
			</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
			<?php _e('Description', 'ambition'); ?>
		<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
		<?php
		for ($i = 0; $i < 3; $i++) { ?>
		<p>
			<label for="<?php echo $this->get_field_id(key($defaults)); ?>">
				<?php _e('Page', 'ambition'); ?>
			:</label>
			<?php wp_dropdown_pages(array(
				'show_option_none' => ' ',
				'name' => $this->get_field_name(key($defaults)) ,
				'selected' => $instance[key($defaults) ]
			)); ?>
		</p>
		<?php
		next($defaults); // forwards the key of $defaults array
		}
	}
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		for ($i = 0; $i < 3; $i++) {
			$var = 'page_id' . $i;
			$instance[$var] = absint($new_instance[$var]);
		}
		if (current_user_can('unfiltered_html')) {
			$instance['text'] = $new_instance['text'];
		}
		else {
			$instance['text'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['text'])));
		}
		// wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}
	function widget($args, $instance)
	{
		extract($args);
		extract($instance);
		global $post;
		$title = isset($instance['title']) ? $instance['title'] : '';
		$text = apply_filters('widget_text', empty($instance['text']) ? '' : $instance['text'], $instance);
		$page_array = array();
		for ($i = 0; $i < 3; $i++) {
			$var = 'page_id' . $i;
			$page_id = isset($instance[$var]) ? $instance[$var] : '';
			if (!empty($page_id)) {
				array_push($page_array, $page_id);
			}
			// Push the page id in the array
		}
		$get_featured_pages = new WP_Query(array(
			'posts_per_page' => - 1,
			'post_type' => array(
				'page'
			) ,
			'post__in' => $page_array,
			'orderby' => 'post__in'
		));
		echo $before_widget; ?>
		<div class="container clearfix">
		<?php if (!empty($title)) {
			echo $before_title . esc_html($title) . $after_title; ?>
			<p><?php echo esc_textarea($text); ?></p>
		<?php } ?>
		</div><!-- .container -->
		<?php $j = 1;
		while ($get_featured_pages->have_posts()):
			$get_featured_pages->the_post();
			$page_title = get_the_title(); ?>
			<div class="recent-work-col">
			<?php
				if (has_post_thumbnail()) {?>
				<a href="<?php the_permalink(); ?>" title="<?php echo $page_title; ?>">
				<?php echo get_the_post_thumbnail($post->ID, 'ambition-recent-work'); ?> 
					<span class="recent-work-content">
						<span class="recent-work-title"><?php echo $page_title; ?></span>
						<?php 
						$excerpt = get_the_excerpt();
						if(strlen($excerpt) >130){
							$excerpt_length = substr($excerpt, 0 , 130);	
							echo $excerpt_length . '...'; 
						} else{
							echo $excerpt;
							}?>
					</span><!-- .recent_work-content -->
				</a>
				<?php } ?>
			</div><!-- .recent_work-col -->
		<?php $j++;
		endwhile;
		// Reset Post Data
		wp_reset_query();
		echo $after_widget . '<!-- .widget_recent_work -->';
	}
}
/**************************************************************************************/
/**
 * Testimonial widget
 */
class ambition_Widget_Testimonial extends WP_Widget

{
	function ambition_Widget_Testimonial()
	{
		$widget_ops = array(
			'classname' => 'widget_testimonial',
			'description' => __('Display Testimonial ( Business Layout ) recommendation size ( 168 * 168 )', 'ambition')
		);
		$control_ops = array(
			'width' => 200,
			'height' => 250
		);
		parent::__construct(false, $name = __('TH: Testimonial', 'ambition') , $widget_ops, $control_ops);
	}
	function form($instance)
	{
		$instance = wp_parse_args((array)$instance, array(
			'title' => '',
			'image1' => '',
			'text1' => '',
			'name1' => '',
			'designation1' => '',
			'company_name1' => '',
			'company_link1' => ''
		));
		$title = strip_tags($instance['title']);
		for ($i = 1; $i <= 1; $i++) {
			$image = 'image' . $i;
			$text = 'text' . $i;
			$name = 'name' . $i;
			$designation = 'designation' . $i;
			$company_name = 'company_name' . $i;
			$company_link = 'company_link' . $i;
			$instance[$image] = esc_url($instance[$image]);
			$instance[$text] = strip_tags($instance[$text]);
			$instance[$name] = strip_tags($instance[$name]);
			$instance[$designation] = strip_tags($instance[$designation]);
			$instance[$company_name] = strip_tags($instance[$company_name]);
			$instance[$company_link] = esc_url($instance[$company_link]);
		}
?>
		<p>
		  <label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Title:', 'ambition'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<?php
		for ($i = 1; $i <= 1; $i++) {
			$image = 'image' . $i;
			$text = 'text' . $i;
			$name = 'name' . $i;
			$designation = 'designation' . $i;
			$company_name = 'company_name' . $i;
			$company_link = 'company_link' . $i;
			$instance[$image] = esc_url($instance[$image]);
			$instance[$text] = strip_tags($instance[$text]);
			$instance[$name] = strip_tags($instance[$name]);
			$instance[$designation] = strip_tags($instance[$designation]);
			$instance[$company_name] = strip_tags($instance[$company_name]);
			$instance[$company_link] = esc_url($instance[$company_link]); ?>
		<p>	
			<?php
			_e('Testimonial Description ', 'ambition'); ?>
			<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id($text); ?>" name="<?php echo $this->get_field_name($text); ?>"><?php echo esc_attr($instance[$text]); ?></textarea>
		</p>
		<p>
			<input class="upload1" type="text" id="<?php echo $this->get_field_id( $image ); ?>" name="<?php echo $this->get_field_name($image); ?>" value="<?php if (isset($instance[$image])) echo esc_url($instance[$image]); ?>" />
			<input class="button  custom_media_button" name="image-add" id="custom_media_button_services" type="button" value="<?php esc_attr_e('Add Image', 'ambition'); ?>" onclick="mediaupload.uploader( '<?php echo $this->get_field_id( $image ); ?>' ); return false;"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('name'); ?>">
				<?php _e('Name ', 'ambition'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id($name); ?>" name="<?php echo $this->get_field_name($name); ?>" type="text" value="<?php if (isset($instance[$name])) echo esc_attr($instance[$name]); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('designation'); ?>">
				<?php _e('Designation ', 'ambition'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id($designation); ?>" name="<?php echo $this->get_field_name($designation); ?>" type="text" value="<?php if (isset($instance[$designation])) echo esc_attr($instance[$designation]); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('company_name'); ?>">
				<?php _e('Company Name ', 'ambition'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id($company_name); ?>" name="<?php echo $this->get_field_name($company_name); ?>" type="text" value="<?php if (isset($instance[$company_name])) echo esc_attr($instance[$company_name]); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('company_link'); ?>">
				<?php _e('Company Link ', 'ambition'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id($company_link); ?>" name="<?php echo $this->get_field_name($company_link); ?>" type="text" value="<?php
			if (isset($instance[$company_link])) echo esc_url_raw($instance[$company_link]); ?>" />
		</p>
		<p>&nbsp; </p>
		<hr>
		<p>&nbsp; </p>
			<?php
		}
	}
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		for ($i = 1; $i <= 1; $i++) {
			$image = 'image' . $i;
			$text = 'text' . $i;
			$name = 'name' . $i;
			$designation = 'designation' . $i;
			$company_name = 'company_name' . $i;
			$company_link = 'company_link' . $i;
			$instance[$image] = esc_url_raw($new_instance[$image]);
			$instance[$text] = strip_tags($new_instance[$text]);
			$instance[$name] = strip_tags($new_instance[$name]);
			$instance[$designation] = strip_tags($new_instance[$designation]);
			$instance[$company_name] = strip_tags($new_instance[$company_name]);
			$instance[$company_link] = esc_url_raw($new_instance[$company_link]);
		}
		return $instance;
	}
	function widget($args, $instance)
	{
		extract($args);
		$title = empty($instance['title']) ? '' : $instance['title'];
		$image_array = array();
		$text_array = array();
		$name_array = array();
		$designation_array = array();
		$company_name_array = array();
		$company_link_array = array();
		for ($i = 1; $i <= 1; $i++) {
			$image = 'image' . $i;
			$text = 'text' . $i;
			$name = 'name' . $i;
			$designation = 'designation' . $i;
			$company_name = 'company_name' . $i;
			$company_link = 'company_link' . $i;
			$image = isset($instance[$image]) ? $instance[$image] : '';
			$text = isset($instance[$text]) ? $instance[$text] : '';
			$name = isset($instance[$name]) ? $instance[$name] : '';
			$designation = isset($instance[$designation]) ? $instance[$designation] : '';
			$company_name = isset($instance[$company_name]) ? $instance[$company_name] : '';
			$company_link = isset($instance[$company_link]) ? $instance[$company_link] : '';
			if (!empty($image) || !empty($text) || !empty($name) || !empty($designation) || !empty($company_name) || !empty($company_link)) {
				if (!empty($image)) array_push($image_array, $image);
				else array_push($image_array, "");
				if (!empty($text)) array_push($text_array, $text);
				else array_push($text_array, "");
				if (!empty($name)) array_push($name_array, $name);
				else array_push($name_array, "");
				if (!empty($designation)) array_push($designation_array, $designation);
				else array_push($designation_array, "");
				if (!empty($company_name)) array_push($company_name_array, $company_name);
				else array_push($company_name_array, "");
				if (!empty($company_link)) array_push($company_link_array, $company_link);
				else array_push($company_link_array, "");
			}
		}
		echo $before_widget; ?>
		<div class="container clearfix">
		<?php if (!empty($title)) {
			echo $before_title . esc_html($title) . $after_title;
		}
		for ($i = 0; $i < 1; $i++) {
			if (!empty($text_array[$i])) { ?>
			<p> <?php echo $text_array[$i]; ?> </p>
			<?php }
			if (!empty($image_array[$i])) { ?> 
			<div class="testimonial-image">
				<img src="<?php if (!empty($image_array[$i])) { echo $image_array[$i]; } ?>" alt="<?php if (!empty($name_array[$i])) { echo $name_array[$i]; } ?>" title="<?php if (!empty($name_array[$i])) { echo $name_array[$i]; } ?>">
			</div>
			<?php }
			if ((!empty($name_array[$i])) || (!empty($designation_array[$i])) || (!empty($company_name_array[$i])) || (!empty($company_link_array[$i]))) { ?>
			<div class="testimonial-meta">
				<?php
				if (!empty($name_array[$i])) { ?><strong><?php echo $name_array[$i]; ?></strong><?php } ?> <?php echo $designation_array[$i];  if (!empty($company_name_array[$i])) { echo ' - '; } if(!empty($company_link_array[$i])) : ?><a href="<?php if (!empty($company_link_array[$i])) { echo $company_link_array[$i]; } ?>" title="<?php if (!empty($company_link_array[$i])) { echo $company_link_array[$i]; } ?>" target="_blank"><?php endif; ?> <?php if (!empty($company_name_array[$i])) { echo $company_name_array[$i]; } if(!empty($company_link_array[$i])) : ?></a> <?php endif; ?>
			</div>
			<?php } 
		} ?>
		</div><!-- .container -->
		<?php echo $after_widget .'<!-- .widget_testimonial -->';
	}
}
/*********************************************************************************************************/
class ambition_featured_image_widget extends WP_Widget {
	function ambition_featured_image_widget() {
		$widget_ops = array( 'classname' => 'widget_ourclients', 'description' => __( 'Display Featured Clients/ Products ( Business Layout )', 'ambition') );
		$control_ops = array('width' => 200, 'height' => 250);
		parent::__construct( false, $name='TH: Featured Clients/ Products', $widget_ops, $control_ops );
	}
	function form( $instance ) {		
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number' => '5', 'path0' => '', 'path1' => '', 'path2' => '', 'path3' => '', 'path4' => '', 'path5' => '', 'redirectlink0' => '', 'redirectlink1' => '', 'redirectlink2' => '', 'redirectlink3' => '', 'redirectlink4' => '', 'redirectlink5' => '') );	
		$title = strip_tags($instance['title']);
		$number = absint( $instance[ 'number' ] );	 
		for ( $i=0; $i<$number; $i++ ) {
			$var = 'path'.$i;
			$var1 = 'redirectlink'.$i;
			$instance[ $var ] = esc_url( $instance[ $var ] );
			$instance[ $var1 ] = esc_url( $instance[ $var1 ] );
		}		
		?>
		<p class="description">
			<?php _e( 'Note: Recommended size for the image is 400px (width) and 150px (height). If you want more image adding fields then first enter the number and click on Save, this will allow you more image adding fields', 'ambition' ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Image Title:', 'ambition'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">
				<?php _e( 'Number of Images:', 'ambition' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		<?php for ( $i=0; $i<$number; $i++ ) {
			$var = 'path'.$i;
			$var1 = 'redirectlink'.$i;
			?>
			<p>
				<input type="text" class="upload1" id="<?php echo $this->get_field_id( $var ); ?>" name="<?php echo $this->get_field_name( $var ); ?>" value="<?php if(isset ( $instance[$var] ) ) echo esc_url( $instance[$var] ); ?>" />
				<input class="button  custom_media_button" name="<?php echo $this->get_field_name( $var ); ?>" type="button" id="custom_media_button_services" value="<?php echo esc_attr( 'Add Image'); ?>"onclick="mediaupload.uploader( '<?php echo $this->get_field_id( $var ); ?>' ); return false;"/>
				<br />
			</p>
			<p>
				<?php _e('Redirect Link:', 'ambition'); ?>
				<input class="widefat" name="<?php echo $this->get_field_name($var1); ?>" type="text" value="<?php if(isset ( $instance[$var1] ) ) echo esc_url( $instance[$var1] ); ?>" />
			</p>
			<?php } ?>
			<?php
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['number'] = absint( $new_instance['number'] );

			for( $i=0; $i<$instance[ 'number' ]; $i++ ) {
				$var = 'path'.$i;
				$var1 = 'redirectlink'.$i;
				$instance[ $var] = esc_url_raw( $new_instance[ $var ] );			
				$instance[ $var1] = esc_url_raw( $new_instance[ $var1 ] );
			}
			return $instance;
		}	
		function widget( $args, $instance ) {
			extract($args);
			$title = empty( $instance['title'] ) ? '' : $instance['title'];
			$number = empty( $instance['number'] ) ? 5 : $instance['number'];
			$path_array = array();
			$redirectlink_array = array();
			for( $i=0; $i<$number; $i++ ) {
				$var = 'path'.$i;
				$var1 = 'redirectlink'.$i;
				$path = isset( $instance[ $var ] ) ? $instance[ $var ] : '';
				$redirectlink = isset( $instance[ $var1 ] ) ? $instance[ $var1 ] : ''; 			
			if( !empty( $path )  || !empty( $redirectlink ))  {		
				if( !empty( $path ) ){
 				array_push( $path_array, $path ); // Push the page id in the array
		 			}else{
		 			 array_push($path_array, "");
		 			}
	 			if( !empty( $redirectlink ) ){
	 				array_push( $redirectlink_array, $redirectlink ); // Push the page id in the array
		 			}else{
		 			 array_push($redirectlink_array, "");
		 			}
		 		}
	 		}
 		echo $before_widget;
 		if ( !empty( $path_array ) ) {
 			$output = '';
 			$output .= '<div class="container">';
 			$output .= '<ul>';
 			for( $i=0; $i<$number; $i++ ) {
 				$output .= '<li>';
 				if((!empty( $redirectlink_array[$i] )) || (!empty( $path_array[$i] )) ) {
 					$output .= '<a href="'.$redirectlink_array[$i].'" title="'.$title.'" target="_blank">
 					<img src="'.$path_array[$i].'" alt="'.$title.'">
 					</a>';
 				}
 				else {
 					if(!empty($path_array[$i])){
 						$output .= '<img src="'.$path_array[$i].'" alt="'.$title.'">';
 					}
 				}
 				$output .=	'</li>';
 			}
 			$output .= '</ul>';

 			$output .= '</div>';

 			echo $output;
 		}
 		echo $after_widget .'<!-- .widget_ourclients -->';
 	}
 } ?>
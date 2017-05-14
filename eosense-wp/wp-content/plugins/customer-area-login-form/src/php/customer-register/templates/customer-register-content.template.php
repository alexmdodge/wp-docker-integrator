<?php /** Template version: 1.0.0 */ ?>

<?php if ( $this->should_print_form() ) : ?>

<?php $this->print_form_header(); ?>

	<div class="form-group">
		<label for="user_login" class="control-label"><?php _e( 'Username', 'cuarlf' ); ?></label>
		<div class="control-container">
			<input type="text" name="user_login" id="user_login" value="<?php if ( isset( $_POST['user_login'] ) ) echo $_POST['user_login']; ?>" class="form-control" />
		</div>
	</div>
	
	<div class="form-group">
		<label for="user_email" class="control-label"><?php _e( 'Email Address', 'cuarlf' ); ?></label>
		<div class="control-container">
			<input type="email" name="user_email" id="user_email" value="<?php if ( isset( $_POST['user_email'] ) ) echo $_POST['user_email']; ?>" class="form-control" />
			<span class="help-block"><?php _e( "A password will be e-mailed to you.", 'cuarlf' );?></span>
		</div>
	</div>
	
<?php if ( class_exists( "ReallySimpleCaptcha" ) ) : ?>
<?php 
	$captcha_instance = new ReallySimpleCaptcha();
	$word = $captcha_instance->generate_random_word();
	$prefix = mt_rand();
	$captcha_src = WP_CONTENT_URL . '/plugins/really-simple-captcha/tmp/' 
		. $captcha_instance->generate_image( $prefix, $word );
?>
	<div class="form-group">
		<label for="captcha" class="control-label"><?php _e( 'Spam Check', 'cuarlf' ); ?></label>
		<div class="control-container">
			<img src="<?php echo $captcha_src; ?>" alt="captcha" class="captcha" />
			
			<input type="text" name="captcha" id="captcha" required="required" class="form-control" />
			<span class="help-block"><?php _e( "Copy the code shown above in the input field.", 'cuarlf' );?></span>
			
			<input id="cuar_captcha_prefix" name="cuar_captcha_prefix" type="hidden" value="<?php echo $prefix; ?>" />
		</div>
	</div>
<?php endif; ?>
	
<?php do_action('register_form'); ?>
	
	<div class="form-group">
		<div class="submit-container">
    		<input type="submit" name="cuar_do_register" value="<?php _e( "Register", 'cuarlf' );?>" class="btn btn-default" />
		</div>
	</div>

<?php $this->print_form_footer(); ?>
	
<?php endif; ?>	
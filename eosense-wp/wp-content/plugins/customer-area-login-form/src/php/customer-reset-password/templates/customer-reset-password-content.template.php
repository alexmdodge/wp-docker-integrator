<?php /** Template version: 1.0.0 */ ?>

<?php if ( $this->should_print_form() ) : ?>

<?php $this->print_form_header(); ?>

	<div class="form-group">
		<label for="new-pass" class="control-label"><?php _e( 'New Password', 'cuarlf' ); ?></label>
		<div class="control-container">
			<input type="password" name="new-pass" id="new-pass" class="form-control" />
		</div>
	</div>
	<div class="form-group">
		<label for="new-pass-confirm" class="control-label">&nbsp;</label>
		<div class="control-container">
			<input type="password" name="new-pass-confirm" id="new-pass-confirm" class="form-control" />
			<span class="help-block"><?php _e( "Type your new password again.", 'cuarlf' );?></span>
		</div>
	</div>
	
	<div class="form-group">
		<div class="submit-container">
    		<input type="submit" name="cuar_do_forgot_password" value="<?php _e( "Change Password", 'cuarlf' );?>" class="btn btn-default" />
		</div>
	</div>

<?php $this->print_form_footer(); ?>
	
<?php endif; ?>	
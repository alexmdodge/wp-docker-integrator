<?php /** Template version: 1.1.0
 *
 * -= 1.1.0 =-
 * Change label if we allow login in with email
 */ ?>

<?php
/** @var CUAR_LoginFormAddOn $lf_addon */
$lf_addon = cuar_addon('login-forms');
$is_email_login_enabled = $lf_addon->is_email_login_enabled();
?>

<?php /** @var CUAR_CustomerLoginAddOn $this */ ?>

<?php if ($this->should_print_form()) : ?>

    <?php $this->print_form_header(); ?>

    <div class="form-group">
        <label for="username" class="control-label"><?php
            echo($is_email_login_enabled ? __('Email or username', 'cuarlf') : __('Username', 'cuarlf')); ?></label>

        <div class="control-container">
            <input type="text" name="username" id="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" class="form-control"/>
        </div>
    </div>

    <div class="form-group">
        <label for="pwd" class="control-label"><?php _e('Password', 'cuarlf'); ?></label>

        <div class="control-container">
            <input type="password" name="pwd" id="pwd" class="form-control"/>
        </div>
    </div>

    <div class="form-group">
        <div class="checkbox-container">
            <div class="checkbox">
                <label for="remember-me">
                    <input type="checkbox" id="remember-me" name="remember" value="forever"/>&nbsp;<?php _e('Remember me', 'cuarlf'); ?>
                </label>
            </div>
        </div>
    </div>

    <?php do_action('login_form'); ?>

    <div class="form-group">
        <div class="submit-container">
            <input type="submit" name="cuar_do_login" value="<?php _e("Login", 'cuarlf'); ?>" class="btn btn-default"/>
        </div>
    </div>

    <?php $this->print_form_footer(); ?>

<?php endif; ?>	
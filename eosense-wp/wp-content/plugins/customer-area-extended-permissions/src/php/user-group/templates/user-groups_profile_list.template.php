<?php /** Template version: 1.0.0 */ ?>

<h3><?php _e( 'User Groups', 'cuarep' ); ?></h3>

<?php	if ( empty( $user_groups ) ) : ?>
	
	<p><?php 	
				if ( $is_own_profile ) : _e( 'You do not belong to any group', 'cuarep' );
				else : _e( 'This user does not belong to any group', 'cuarep' );
				endif;
	?></p>

<?php 	else : ?>

	<ul class="ul-disc">
<?php 		foreach ( $user_groups as $group ) : ?>
				<li><?php echo get_the_title( $group ); ?></li>	
<?php 		endforeach; ?>
	</ul>

<?php 	endif; ?>


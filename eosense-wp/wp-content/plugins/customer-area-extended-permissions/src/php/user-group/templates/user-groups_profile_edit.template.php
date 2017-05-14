<?php /** Template version: 1.0.1

 -= 1.0.1 =-
 * Replace __ by _e where needed when no groups

 */ ?>

<h3><?php _e( 'User Groups', 'cuarep' ); ?></h3>
<table class="form-table">
	<tbody>
		<tr>
			<th><label for="cuar_group_ids"><?php _e( 'Edit user groups', 'cuarep' ); ?></label></th>
			<td>
<?php	if ( empty( $all_groups ) ) : ?>
				<p><?php _e('You have not yet created any groups.', 'cuarep'); ?></p>
<?php 	else : ?>

				<select id="cuar_group_ids" class="groups" name="cuar_group_ids[]" multiple="multiple" data-placeholder="<?php esc_attr_e( 'Choose groups', 'cuarep' ); ?>">
	
<?php 		foreach ( $all_groups as $group ) :
				$is_member = in_array( $group, $user_groups );
				
				$selected = $is_member ? ' selected="selected" ' : '';
?>
					<option value="<?php echo $group->ID; ?>" <?php echo $selected; ?>><?php echo get_the_title( $group ); ?></option>
<?php 		endforeach; ?>
				</select>
				
				<script type="text/javascript">
					<!--
					jQuery("document").ready(function($){
						$("#cuar_group_ids").select2({
							width:						"100%"
						});
					});
					//-->
				</script>
<?php 	endif; ?>

			</td>
		</tr>
	</tbody>
</table>
<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;
?>
<?php if ($users->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_usersmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($users->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $users->TableLeftColumnClass ?>"><?php echo $users->id->caption() ?></td>
			<td <?php echo $users->id->cellAttributes() ?>>
<span id="el_users_id">
<span<?php echo $users->id->viewAttributes() ?>><?php echo $users->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($users->first_names->Visible) { // first_names ?>
		<tr id="r_first_names">
			<td class="<?php echo $users->TableLeftColumnClass ?>"><?php echo $users->first_names->caption() ?></td>
			<td <?php echo $users->first_names->cellAttributes() ?>>
<span id="el_users_first_names">
<span<?php echo $users->first_names->viewAttributes() ?>><?php echo $users->first_names->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($users->last_names->Visible) { // last_names ?>
		<tr id="r_last_names">
			<td class="<?php echo $users->TableLeftColumnClass ?>"><?php echo $users->last_names->caption() ?></td>
			<td <?php echo $users->last_names->cellAttributes() ?>>
<span id="el_users_last_names">
<span<?php echo $users->last_names->viewAttributes() ?>><?php echo $users->last_names->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($users->_email->Visible) { // email ?>
		<tr id="r__email">
			<td class="<?php echo $users->TableLeftColumnClass ?>"><?php echo $users->_email->caption() ?></td>
			<td <?php echo $users->_email->cellAttributes() ?>>
<span id="el_users__email">
<span<?php echo $users->_email->viewAttributes() ?>><?php echo $users->_email->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($users->user_level->Visible) { // user_level ?>
		<tr id="r_user_level">
			<td class="<?php echo $users->TableLeftColumnClass ?>"><?php echo $users->user_level->caption() ?></td>
			<td <?php echo $users->user_level->cellAttributes() ?>>
<span id="el_users_user_level">
<span<?php echo $users->user_level->viewAttributes() ?>><?php echo $users->user_level->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($users->created_at->Visible) { // created_at ?>
		<tr id="r_created_at">
			<td class="<?php echo $users->TableLeftColumnClass ?>"><?php echo $users->created_at->caption() ?></td>
			<td <?php echo $users->created_at->cellAttributes() ?>>
<span id="el_users_created_at">
<span<?php echo $users->created_at->viewAttributes() ?>><?php echo $users->created_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($users->updated_at->Visible) { // updated_at ?>
		<tr id="r_updated_at">
			<td class="<?php echo $users->TableLeftColumnClass ?>"><?php echo $users->updated_at->caption() ?></td>
			<td <?php echo $users->updated_at->cellAttributes() ?>>
<span id="el_users_updated_at">
<span<?php echo $users->updated_at->viewAttributes() ?>><?php echo $users->updated_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
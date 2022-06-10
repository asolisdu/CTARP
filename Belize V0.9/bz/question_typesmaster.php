<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;
?>
<?php if ($question_types->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_question_typesmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($question_types->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $question_types->TableLeftColumnClass ?>"><?php echo $question_types->id->caption() ?></td>
			<td <?php echo $question_types->id->cellAttributes() ?>>
<span id="el_question_types_id">
<span<?php echo $question_types->id->viewAttributes() ?>><?php echo $question_types->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($question_types->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="<?php echo $question_types->TableLeftColumnClass ?>"><?php echo $question_types->name->caption() ?></td>
			<td <?php echo $question_types->name->cellAttributes() ?>>
<span id="el_question_types_name">
<span<?php echo $question_types->name->viewAttributes() ?>><?php echo $question_types->name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($question_types->desc->Visible) { // desc ?>
		<tr id="r_desc">
			<td class="<?php echo $question_types->TableLeftColumnClass ?>"><?php echo $question_types->desc->caption() ?></td>
			<td <?php echo $question_types->desc->cellAttributes() ?>>
<span id="el_question_types_desc">
<span<?php echo $question_types->desc->viewAttributes() ?>><?php echo $question_types->desc->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($question_types->active->Visible) { // active ?>
		<tr id="r_active">
			<td class="<?php echo $question_types->TableLeftColumnClass ?>"><?php echo $question_types->active->caption() ?></td>
			<td <?php echo $question_types->active->cellAttributes() ?>>
<span id="el_question_types_active">
<span<?php echo $question_types->active->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_active" class="custom-control-input" value="<?php echo $question_types->active->getViewValue() ?>" disabled<?php if (ConvertToBool($question_types->active->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_active"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($question_types->created_at->Visible) { // created_at ?>
		<tr id="r_created_at">
			<td class="<?php echo $question_types->TableLeftColumnClass ?>"><?php echo $question_types->created_at->caption() ?></td>
			<td <?php echo $question_types->created_at->cellAttributes() ?>>
<span id="el_question_types_created_at">
<span<?php echo $question_types->created_at->viewAttributes() ?>><?php echo $question_types->created_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($question_types->updated_at->Visible) { // updated_at ?>
		<tr id="r_updated_at">
			<td class="<?php echo $question_types->TableLeftColumnClass ?>"><?php echo $question_types->updated_at->caption() ?></td>
			<td <?php echo $question_types->updated_at->cellAttributes() ?>>
<span id="el_question_types_updated_at">
<span<?php echo $question_types->updated_at->viewAttributes() ?>><?php echo $question_types->updated_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
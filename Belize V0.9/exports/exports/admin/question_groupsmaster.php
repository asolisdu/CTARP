<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;
?>
<?php if ($question_groups->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_question_groupsmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($question_groups->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $question_groups->TableLeftColumnClass ?>"><?php echo $question_groups->id->caption() ?></td>
			<td <?php echo $question_groups->id->cellAttributes() ?>>
<span id="el_question_groups_id">
<span<?php echo $question_groups->id->viewAttributes() ?>><?php echo $question_groups->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($question_groups->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="<?php echo $question_groups->TableLeftColumnClass ?>"><?php echo $question_groups->name->caption() ?></td>
			<td <?php echo $question_groups->name->cellAttributes() ?>>
<span id="el_question_groups_name">
<span<?php echo $question_groups->name->viewAttributes() ?>><?php echo $question_groups->name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($question_groups->desc->Visible) { // desc ?>
		<tr id="r_desc">
			<td class="<?php echo $question_groups->TableLeftColumnClass ?>"><?php echo $question_groups->desc->caption() ?></td>
			<td <?php echo $question_groups->desc->cellAttributes() ?>>
<span id="el_question_groups_desc">
<span<?php echo $question_groups->desc->viewAttributes() ?>><?php echo $question_groups->desc->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
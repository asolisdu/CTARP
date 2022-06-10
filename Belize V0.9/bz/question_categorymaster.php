<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;
?>
<?php if ($question_category->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_question_categorymaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($question_category->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $question_category->TableLeftColumnClass ?>"><?php echo $question_category->id->caption() ?></td>
			<td <?php echo $question_category->id->cellAttributes() ?>>
<span id="el_question_category_id">
<span<?php echo $question_category->id->viewAttributes() ?>><?php echo $question_category->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($question_category->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="<?php echo $question_category->TableLeftColumnClass ?>"><?php echo $question_category->name->caption() ?></td>
			<td <?php echo $question_category->name->cellAttributes() ?>>
<span id="el_question_category_name">
<span<?php echo $question_category->name->viewAttributes() ?>><?php echo $question_category->name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($question_category->desc->Visible) { // desc ?>
		<tr id="r_desc">
			<td class="<?php echo $question_category->TableLeftColumnClass ?>"><?php echo $question_category->desc->caption() ?></td>
			<td <?php echo $question_category->desc->cellAttributes() ?>>
<span id="el_question_category_desc">
<span<?php echo $question_category->desc->viewAttributes() ?>><?php echo $question_category->desc->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
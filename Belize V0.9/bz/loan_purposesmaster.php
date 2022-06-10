<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;
?>
<?php if ($loan_purposes->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_loan_purposesmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($loan_purposes->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $loan_purposes->TableLeftColumnClass ?>"><?php echo $loan_purposes->id->caption() ?></td>
			<td <?php echo $loan_purposes->id->cellAttributes() ?>>
<span id="el_loan_purposes_id">
<span<?php echo $loan_purposes->id->viewAttributes() ?>><?php echo $loan_purposes->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($loan_purposes->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="<?php echo $loan_purposes->TableLeftColumnClass ?>"><?php echo $loan_purposes->name->caption() ?></td>
			<td <?php echo $loan_purposes->name->cellAttributes() ?>>
<span id="el_loan_purposes_name">
<span<?php echo $loan_purposes->name->viewAttributes() ?>><?php echo $loan_purposes->name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($loan_purposes->desc->Visible) { // desc ?>
		<tr id="r_desc">
			<td class="<?php echo $loan_purposes->TableLeftColumnClass ?>"><?php echo $loan_purposes->desc->caption() ?></td>
			<td <?php echo $loan_purposes->desc->cellAttributes() ?>>
<span id="el_loan_purposes_desc">
<span<?php echo $loan_purposes->desc->viewAttributes() ?>><?php echo $loan_purposes->desc->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($loan_purposes->created_at->Visible) { // created_at ?>
		<tr id="r_created_at">
			<td class="<?php echo $loan_purposes->TableLeftColumnClass ?>"><?php echo $loan_purposes->created_at->caption() ?></td>
			<td <?php echo $loan_purposes->created_at->cellAttributes() ?>>
<span id="el_loan_purposes_created_at">
<span<?php echo $loan_purposes->created_at->viewAttributes() ?>><?php echo $loan_purposes->created_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($loan_purposes->updated_at->Visible) { // updated_at ?>
		<tr id="r_updated_at">
			<td class="<?php echo $loan_purposes->TableLeftColumnClass ?>"><?php echo $loan_purposes->updated_at->caption() ?></td>
			<td <?php echo $loan_purposes->updated_at->cellAttributes() ?>>
<span id="el_loan_purposes_updated_at">
<span<?php echo $loan_purposes->updated_at->viewAttributes() ?>><?php echo $loan_purposes->updated_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
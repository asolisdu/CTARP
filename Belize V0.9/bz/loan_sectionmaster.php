<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;
?>
<?php if ($loan_section->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_loan_sectionmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($loan_section->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $loan_section->TableLeftColumnClass ?>"><?php echo $loan_section->id->caption() ?></td>
			<td <?php echo $loan_section->id->cellAttributes() ?>>
<span id="el_loan_section_id">
<span<?php echo $loan_section->id->viewAttributes() ?>><?php echo $loan_section->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($loan_section->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="<?php echo $loan_section->TableLeftColumnClass ?>"><?php echo $loan_section->name->caption() ?></td>
			<td <?php echo $loan_section->name->cellAttributes() ?>>
<span id="el_loan_section_name">
<span<?php echo $loan_section->name->viewAttributes() ?>><?php echo $loan_section->name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($loan_section->desc->Visible) { // desc ?>
		<tr id="r_desc">
			<td class="<?php echo $loan_section->TableLeftColumnClass ?>"><?php echo $loan_section->desc->caption() ?></td>
			<td <?php echo $loan_section->desc->cellAttributes() ?>>
<span id="el_loan_section_desc">
<span<?php echo $loan_section->desc->viewAttributes() ?>><?php echo $loan_section->desc->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($loan_section->created_at->Visible) { // created_at ?>
		<tr id="r_created_at">
			<td class="<?php echo $loan_section->TableLeftColumnClass ?>"><?php echo $loan_section->created_at->caption() ?></td>
			<td <?php echo $loan_section->created_at->cellAttributes() ?>>
<span id="el_loan_section_created_at">
<span<?php echo $loan_section->created_at->viewAttributes() ?>><?php echo $loan_section->created_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($loan_section->updated_at->Visible) { // updated_at ?>
		<tr id="r_updated_at">
			<td class="<?php echo $loan_section->TableLeftColumnClass ?>"><?php echo $loan_section->updated_at->caption() ?></td>
			<td <?php echo $loan_section->updated_at->cellAttributes() ?>>
<span id="el_loan_section_updated_at">
<span<?php echo $loan_section->updated_at->viewAttributes() ?>><?php echo $loan_section->updated_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
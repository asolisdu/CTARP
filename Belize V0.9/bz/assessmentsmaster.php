<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;
?>
<?php if ($assessments->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_assessmentsmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($assessments->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->id->caption() ?></td>
			<td <?php echo $assessments->id->cellAttributes() ?>>
<span id="el_assessments_id">
<span<?php echo $assessments->id->viewAttributes() ?>><?php echo $assessments->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->user_id->Visible) { // user_id ?>
		<tr id="r_user_id">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->user_id->caption() ?></td>
			<td <?php echo $assessments->user_id->cellAttributes() ?>>
<span id="el_assessments_user_id">
<span<?php echo $assessments->user_id->viewAttributes() ?>><?php echo $assessments->user_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->customer_id->Visible) { // customer_id ?>
		<tr id="r_customer_id">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->customer_id->caption() ?></td>
			<td <?php echo $assessments->customer_id->cellAttributes() ?>>
<span id="el_assessments_customer_id">
<span<?php echo $assessments->customer_id->viewAttributes() ?>><?php echo $assessments->customer_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->customer_first_name->Visible) { // customer_first_name ?>
		<tr id="r_customer_first_name">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->customer_first_name->caption() ?></td>
			<td <?php echo $assessments->customer_first_name->cellAttributes() ?>>
<span id="el_assessments_customer_first_name">
<span<?php echo $assessments->customer_first_name->viewAttributes() ?>><?php echo $assessments->customer_first_name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->customer_age->Visible) { // customer_age ?>
		<tr id="r_customer_age">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->customer_age->caption() ?></td>
			<td <?php echo $assessments->customer_age->cellAttributes() ?>>
<span id="el_assessments_customer_age">
<span<?php echo $assessments->customer_age->viewAttributes() ?>><?php echo $assessments->customer_age->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->sex->Visible) { // sex ?>
		<tr id="r_sex">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->sex->caption() ?></td>
			<td <?php echo $assessments->sex->cellAttributes() ?>>
<span id="el_assessments_sex">
<span<?php echo $assessments->sex->viewAttributes() ?>><?php echo $assessments->sex->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->address->Visible) { // address ?>
		<tr id="r_address">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->address->caption() ?></td>
			<td <?php echo $assessments->address->cellAttributes() ?>>
<span id="el_assessments_address">
<span<?php echo $assessments->address->viewAttributes() ?>><?php echo $assessments->address->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->total_score->Visible) { // total_score ?>
		<tr id="r_total_score">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->total_score->caption() ?></td>
			<td <?php echo $assessments->total_score->cellAttributes() ?>>
<span id="el_assessments_total_score">
<span<?php echo $assessments->total_score->viewAttributes() ?>><?php echo $assessments->total_score->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->status->Visible) { // status ?>
		<tr id="r_status">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->status->caption() ?></td>
			<td <?php echo $assessments->status->cellAttributes() ?>>
<span id="el_assessments_status">
<span<?php echo $assessments->status->viewAttributes() ?>><?php echo $assessments->status->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->loan_purpose->Visible) { // loan_purpose ?>
		<tr id="r_loan_purpose">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->loan_purpose->caption() ?></td>
			<td <?php echo $assessments->loan_purpose->cellAttributes() ?>>
<span id="el_assessments_loan_purpose">
<span<?php echo $assessments->loan_purpose->viewAttributes() ?>><?php echo $assessments->loan_purpose->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->loan_section->Visible) { // loan_section ?>
		<tr id="r_loan_section">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->loan_section->caption() ?></td>
			<td <?php echo $assessments->loan_section->cellAttributes() ?>>
<span id="el_assessments_loan_section">
<span<?php echo $assessments->loan_section->viewAttributes() ?>><?php echo $assessments->loan_section->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->lat->Visible) { // lat ?>
		<tr id="r_lat">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->lat->caption() ?></td>
			<td <?php echo $assessments->lat->cellAttributes() ?>>
<span id="el_assessments_lat">
<span<?php echo $assessments->lat->viewAttributes() ?>><?php echo $assessments->lat->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->lon->Visible) { // lon ?>
		<tr id="r_lon">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->lon->caption() ?></td>
			<td <?php echo $assessments->lon->cellAttributes() ?>>
<span id="el_assessments_lon">
<span<?php echo $assessments->lon->viewAttributes() ?>><?php echo $assessments->lon->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->created_at->Visible) { // created_at ?>
		<tr id="r_created_at">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->created_at->caption() ?></td>
			<td <?php echo $assessments->created_at->cellAttributes() ?>>
<span id="el_assessments_created_at">
<span<?php echo $assessments->created_at->viewAttributes() ?>><?php echo $assessments->created_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($assessments->updated_at->Visible) { // updated_at ?>
		<tr id="r_updated_at">
			<td class="<?php echo $assessments->TableLeftColumnClass ?>"><?php echo $assessments->updated_at->caption() ?></td>
			<td <?php echo $assessments->updated_at->cellAttributes() ?>>
<span id="el_assessments_updated_at">
<span<?php echo $assessments->updated_at->viewAttributes() ?>><?php echo $assessments->updated_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
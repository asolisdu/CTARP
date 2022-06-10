<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;
?>
<?php if ($sections->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_sectionsmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($sections->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $sections->TableLeftColumnClass ?>"><?php echo $sections->id->caption() ?></td>
			<td <?php echo $sections->id->cellAttributes() ?>>
<span id="el_sections_id">
<span<?php echo $sections->id->viewAttributes() ?>><?php echo $sections->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($sections->title->Visible) { // title ?>
		<tr id="r_title">
			<td class="<?php echo $sections->TableLeftColumnClass ?>"><?php echo $sections->title->caption() ?></td>
			<td <?php echo $sections->title->cellAttributes() ?>>
<span id="el_sections_title">
<span<?php echo $sections->title->viewAttributes() ?>><?php echo $sections->title->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($sections->desc->Visible) { // desc ?>
		<tr id="r_desc">
			<td class="<?php echo $sections->TableLeftColumnClass ?>"><?php echo $sections->desc->caption() ?></td>
			<td <?php echo $sections->desc->cellAttributes() ?>>
<span id="el_sections_desc">
<span<?php echo $sections->desc->viewAttributes() ?>><?php echo $sections->desc->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($sections->order->Visible) { // order ?>
		<tr id="r_order">
			<td class="<?php echo $sections->TableLeftColumnClass ?>"><?php echo $sections->order->caption() ?></td>
			<td <?php echo $sections->order->cellAttributes() ?>>
<span id="el_sections_order">
<span<?php echo $sections->order->viewAttributes() ?>><?php echo $sections->order->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($sections->created_at->Visible) { // created_at ?>
		<tr id="r_created_at">
			<td class="<?php echo $sections->TableLeftColumnClass ?>"><?php echo $sections->created_at->caption() ?></td>
			<td <?php echo $sections->created_at->cellAttributes() ?>>
<span id="el_sections_created_at">
<span<?php echo $sections->created_at->viewAttributes() ?>><?php echo $sections->created_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($sections->updated_at->Visible) { // updated_at ?>
		<tr id="r_updated_at">
			<td class="<?php echo $sections->TableLeftColumnClass ?>"><?php echo $sections->updated_at->caption() ?></td>
			<td <?php echo $sections->updated_at->cellAttributes() ?>>
<span id="el_sections_updated_at">
<span<?php echo $sections->updated_at->viewAttributes() ?>><?php echo $sections->updated_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
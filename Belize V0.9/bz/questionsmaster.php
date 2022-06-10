<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;
?>
<?php if ($questions->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_questionsmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($questions->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->id->caption() ?></td>
			<td <?php echo $questions->id->cellAttributes() ?>>
<span id="el_questions_id">
<span<?php echo $questions->id->viewAttributes() ?>><?php echo $questions->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->title->Visible) { // title ?>
		<tr id="r_title">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->title->caption() ?></td>
			<td <?php echo $questions->title->cellAttributes() ?>>
<span id="el_questions_title">
<span<?php echo $questions->title->viewAttributes() ?>><?php echo $questions->title->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->placeholder->Visible) { // placeholder ?>
		<tr id="r_placeholder">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->placeholder->caption() ?></td>
			<td <?php echo $questions->placeholder->cellAttributes() ?>>
<span id="el_questions_placeholder">
<span<?php echo $questions->placeholder->viewAttributes() ?>><?php echo $questions->placeholder->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->questions->Visible) { // questions ?>
		<tr id="r_questions">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->questions->caption() ?></td>
			<td <?php echo $questions->questions->cellAttributes() ?>>
<span id="el_questions_questions">
<span<?php echo $questions->questions->viewAttributes() ?>><?php echo $questions->questions->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->scores->Visible) { // scores ?>
		<tr id="r_scores">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->scores->caption() ?></td>
			<td <?php echo $questions->scores->cellAttributes() ?>>
<span id="el_questions_scores">
<span<?php echo $questions->scores->viewAttributes() ?>><?php echo $questions->scores->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->type->Visible) { // type ?>
		<tr id="r_type">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->type->caption() ?></td>
			<td <?php echo $questions->type->cellAttributes() ?>>
<span id="el_questions_type">
<span<?php echo $questions->type->viewAttributes() ?>><?php echo $questions->type->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->section->Visible) { // section ?>
		<tr id="r_section">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->section->caption() ?></td>
			<td <?php echo $questions->section->cellAttributes() ?>>
<span id="el_questions_section">
<span<?php echo $questions->section->viewAttributes() ?>><?php echo $questions->section->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->active->Visible) { // active ?>
		<tr id="r_active">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->active->caption() ?></td>
			<td <?php echo $questions->active->cellAttributes() ?>>
<span id="el_questions_active">
<span<?php echo $questions->active->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_active" class="custom-control-input" value="<?php echo $questions->active->getViewValue() ?>" disabled<?php if (ConvertToBool($questions->active->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_active"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->created_at->Visible) { // created_at ?>
		<tr id="r_created_at">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->created_at->caption() ?></td>
			<td <?php echo $questions->created_at->cellAttributes() ?>>
<span id="el_questions_created_at">
<span<?php echo $questions->created_at->viewAttributes() ?>><?php echo $questions->created_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->updated_at->Visible) { // updated_at ?>
		<tr id="r_updated_at">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->updated_at->caption() ?></td>
			<td <?php echo $questions->updated_at->cellAttributes() ?>>
<span id="el_questions_updated_at">
<span<?php echo $questions->updated_at->viewAttributes() ?>><?php echo $questions->updated_at->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->has_recommendations->Visible) { // has_recommendations ?>
		<tr id="r_has_recommendations">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->has_recommendations->caption() ?></td>
			<td <?php echo $questions->has_recommendations->cellAttributes() ?>>
<span id="el_questions_has_recommendations">
<span<?php echo $questions->has_recommendations->viewAttributes() ?>><?php echo $questions->has_recommendations->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->group->Visible) { // group ?>
		<tr id="r_group">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->group->caption() ?></td>
			<td <?php echo $questions->group->cellAttributes() ?>>
<span id="el_questions_group">
<span<?php echo $questions->group->viewAttributes() ?>><?php echo $questions->group->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->category->Visible) { // category ?>
		<tr id="r_category">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->category->caption() ?></td>
			<td <?php echo $questions->category->cellAttributes() ?>>
<span id="el_questions_category">
<span<?php echo $questions->category->viewAttributes() ?>><?php echo $questions->category->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->order->Visible) { // order ?>
		<tr id="r_order">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->order->caption() ?></td>
			<td <?php echo $questions->order->cellAttributes() ?>>
<span id="el_questions_order">
<span<?php echo $questions->order->viewAttributes() ?>><?php echo $questions->order->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->recommendation_score->Visible) { // recommendation_score ?>
		<tr id="r_recommendation_score">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->recommendation_score->caption() ?></td>
			<td <?php echo $questions->recommendation_score->cellAttributes() ?>>
<span id="el_questions_recommendation_score">
<span<?php echo $questions->recommendation_score->viewAttributes() ?>><?php echo $questions->recommendation_score->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->related->Visible) { // related ?>
		<tr id="r_related">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->related->caption() ?></td>
			<td <?php echo $questions->related->cellAttributes() ?>>
<span id="el_questions_related">
<span<?php echo $questions->related->viewAttributes() ?>><?php echo $questions->related->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($questions->trigger_related_val->Visible) { // trigger_related_val ?>
		<tr id="r_trigger_related_val">
			<td class="<?php echo $questions->TableLeftColumnClass ?>"><?php echo $questions->trigger_related_val->caption() ?></td>
			<td <?php echo $questions->trigger_related_val->cellAttributes() ?>>
<span id="el_questions_trigger_related_val">
<span<?php echo $questions->trigger_related_val->viewAttributes() ?>><?php echo $questions->trigger_related_val->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
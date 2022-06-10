<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$questions_delete = new questions_delete();

// Run the page
$questions_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$questions_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fquestionsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fquestionsdelete = currentForm = new ew.Form("fquestionsdelete", "delete");
	loadjs.done("fquestionsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $questions_delete->showPageHeader(); ?>
<?php
$questions_delete->showMessage();
?>
<form name="fquestionsdelete" id="fquestionsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="questions">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($questions_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($questions_delete->id->Visible) { // id ?>
		<th class="<?php echo $questions_delete->id->headerCellClass() ?>"><span id="elh_questions_id" class="questions_id"><?php echo $questions_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->title->Visible) { // title ?>
		<th class="<?php echo $questions_delete->title->headerCellClass() ?>"><span id="elh_questions_title" class="questions_title"><?php echo $questions_delete->title->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->placeholder->Visible) { // placeholder ?>
		<th class="<?php echo $questions_delete->placeholder->headerCellClass() ?>"><span id="elh_questions_placeholder" class="questions_placeholder"><?php echo $questions_delete->placeholder->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->questions->Visible) { // questions ?>
		<th class="<?php echo $questions_delete->questions->headerCellClass() ?>"><span id="elh_questions_questions" class="questions_questions"><?php echo $questions_delete->questions->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->scores->Visible) { // scores ?>
		<th class="<?php echo $questions_delete->scores->headerCellClass() ?>"><span id="elh_questions_scores" class="questions_scores"><?php echo $questions_delete->scores->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->type->Visible) { // type ?>
		<th class="<?php echo $questions_delete->type->headerCellClass() ?>"><span id="elh_questions_type" class="questions_type"><?php echo $questions_delete->type->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->section->Visible) { // section ?>
		<th class="<?php echo $questions_delete->section->headerCellClass() ?>"><span id="elh_questions_section" class="questions_section"><?php echo $questions_delete->section->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->active->Visible) { // active ?>
		<th class="<?php echo $questions_delete->active->headerCellClass() ?>"><span id="elh_questions_active" class="questions_active"><?php echo $questions_delete->active->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->created_at->Visible) { // created_at ?>
		<th class="<?php echo $questions_delete->created_at->headerCellClass() ?>"><span id="elh_questions_created_at" class="questions_created_at"><?php echo $questions_delete->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->updated_at->Visible) { // updated_at ?>
		<th class="<?php echo $questions_delete->updated_at->headerCellClass() ?>"><span id="elh_questions_updated_at" class="questions_updated_at"><?php echo $questions_delete->updated_at->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->has_recommendations->Visible) { // has_recommendations ?>
		<th class="<?php echo $questions_delete->has_recommendations->headerCellClass() ?>"><span id="elh_questions_has_recommendations" class="questions_has_recommendations"><?php echo $questions_delete->has_recommendations->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->group->Visible) { // group ?>
		<th class="<?php echo $questions_delete->group->headerCellClass() ?>"><span id="elh_questions_group" class="questions_group"><?php echo $questions_delete->group->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->category->Visible) { // category ?>
		<th class="<?php echo $questions_delete->category->headerCellClass() ?>"><span id="elh_questions_category" class="questions_category"><?php echo $questions_delete->category->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->order->Visible) { // order ?>
		<th class="<?php echo $questions_delete->order->headerCellClass() ?>"><span id="elh_questions_order" class="questions_order"><?php echo $questions_delete->order->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->recommendation_score->Visible) { // recommendation_score ?>
		<th class="<?php echo $questions_delete->recommendation_score->headerCellClass() ?>"><span id="elh_questions_recommendation_score" class="questions_recommendation_score"><?php echo $questions_delete->recommendation_score->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->related->Visible) { // related ?>
		<th class="<?php echo $questions_delete->related->headerCellClass() ?>"><span id="elh_questions_related" class="questions_related"><?php echo $questions_delete->related->caption() ?></span></th>
<?php } ?>
<?php if ($questions_delete->trigger_related_val->Visible) { // trigger_related_val ?>
		<th class="<?php echo $questions_delete->trigger_related_val->headerCellClass() ?>"><span id="elh_questions_trigger_related_val" class="questions_trigger_related_val"><?php echo $questions_delete->trigger_related_val->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$questions_delete->RecordCount = 0;
$i = 0;
while (!$questions_delete->Recordset->EOF) {
	$questions_delete->RecordCount++;
	$questions_delete->RowCount++;

	// Set row properties
	$questions->resetAttributes();
	$questions->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$questions_delete->loadRowValues($questions_delete->Recordset);

	// Render row
	$questions_delete->renderRow();
?>
	<tr <?php echo $questions->rowAttributes() ?>>
<?php if ($questions_delete->id->Visible) { // id ?>
		<td <?php echo $questions_delete->id->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_id" class="questions_id">
<span<?php echo $questions_delete->id->viewAttributes() ?>><?php echo $questions_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->title->Visible) { // title ?>
		<td <?php echo $questions_delete->title->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_title" class="questions_title">
<span<?php echo $questions_delete->title->viewAttributes() ?>><?php echo $questions_delete->title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->placeholder->Visible) { // placeholder ?>
		<td <?php echo $questions_delete->placeholder->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_placeholder" class="questions_placeholder">
<span<?php echo $questions_delete->placeholder->viewAttributes() ?>><?php echo $questions_delete->placeholder->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->questions->Visible) { // questions ?>
		<td <?php echo $questions_delete->questions->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_questions" class="questions_questions">
<span<?php echo $questions_delete->questions->viewAttributes() ?>><?php echo $questions_delete->questions->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->scores->Visible) { // scores ?>
		<td <?php echo $questions_delete->scores->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_scores" class="questions_scores">
<span<?php echo $questions_delete->scores->viewAttributes() ?>><?php echo $questions_delete->scores->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->type->Visible) { // type ?>
		<td <?php echo $questions_delete->type->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_type" class="questions_type">
<span<?php echo $questions_delete->type->viewAttributes() ?>><?php echo $questions_delete->type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->section->Visible) { // section ?>
		<td <?php echo $questions_delete->section->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_section" class="questions_section">
<span<?php echo $questions_delete->section->viewAttributes() ?>><?php echo $questions_delete->section->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->active->Visible) { // active ?>
		<td <?php echo $questions_delete->active->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_active" class="questions_active">
<span<?php echo $questions_delete->active->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_active" class="custom-control-input" value="<?php echo $questions_delete->active->getViewValue() ?>" disabled<?php if (ConvertToBool($questions_delete->active->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_active"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->created_at->Visible) { // created_at ?>
		<td <?php echo $questions_delete->created_at->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_created_at" class="questions_created_at">
<span<?php echo $questions_delete->created_at->viewAttributes() ?>><?php echo $questions_delete->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->updated_at->Visible) { // updated_at ?>
		<td <?php echo $questions_delete->updated_at->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_updated_at" class="questions_updated_at">
<span<?php echo $questions_delete->updated_at->viewAttributes() ?>><?php echo $questions_delete->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->has_recommendations->Visible) { // has_recommendations ?>
		<td <?php echo $questions_delete->has_recommendations->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_has_recommendations" class="questions_has_recommendations">
<span<?php echo $questions_delete->has_recommendations->viewAttributes() ?>><?php echo $questions_delete->has_recommendations->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->group->Visible) { // group ?>
		<td <?php echo $questions_delete->group->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_group" class="questions_group">
<span<?php echo $questions_delete->group->viewAttributes() ?>><?php echo $questions_delete->group->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->category->Visible) { // category ?>
		<td <?php echo $questions_delete->category->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_category" class="questions_category">
<span<?php echo $questions_delete->category->viewAttributes() ?>><?php echo $questions_delete->category->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->order->Visible) { // order ?>
		<td <?php echo $questions_delete->order->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_order" class="questions_order">
<span<?php echo $questions_delete->order->viewAttributes() ?>><?php echo $questions_delete->order->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->recommendation_score->Visible) { // recommendation_score ?>
		<td <?php echo $questions_delete->recommendation_score->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_recommendation_score" class="questions_recommendation_score">
<span<?php echo $questions_delete->recommendation_score->viewAttributes() ?>><?php echo $questions_delete->recommendation_score->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->related->Visible) { // related ?>
		<td <?php echo $questions_delete->related->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_related" class="questions_related">
<span<?php echo $questions_delete->related->viewAttributes() ?>><?php echo $questions_delete->related->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($questions_delete->trigger_related_val->Visible) { // trigger_related_val ?>
		<td <?php echo $questions_delete->trigger_related_val->cellAttributes() ?>>
<span id="el<?php echo $questions_delete->RowCount ?>_questions_trigger_related_val" class="questions_trigger_related_val">
<span<?php echo $questions_delete->trigger_related_val->viewAttributes() ?>><?php echo $questions_delete->trigger_related_val->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$questions_delete->Recordset->moveNext();
}
$questions_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $questions_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$questions_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$questions_delete->terminate();
?>
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
$questions_view = new questions_view();

// Run the page
$questions_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$questions_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$questions_view->isExport()) { ?>
<script>
var fquestionsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fquestionsview = currentForm = new ew.Form("fquestionsview", "view");
	loadjs.done("fquestionsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$questions_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $questions_view->ExportOptions->render("body") ?>
<?php $questions_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $questions_view->showPageHeader(); ?>
<?php
$questions_view->showMessage();
?>
<form name="fquestionsview" id="fquestionsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="questions">
<input type="hidden" name="modal" value="<?php echo (int)$questions_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($questions_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_id"><?php echo $questions_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $questions_view->id->cellAttributes() ?>>
<span id="el_questions_id">
<span<?php echo $questions_view->id->viewAttributes() ?>><?php echo $questions_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->title->Visible) { // title ?>
	<tr id="r_title">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_title"><?php echo $questions_view->title->caption() ?></span></td>
		<td data-name="title" <?php echo $questions_view->title->cellAttributes() ?>>
<span id="el_questions_title">
<span<?php echo $questions_view->title->viewAttributes() ?>><?php echo $questions_view->title->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->placeholder->Visible) { // placeholder ?>
	<tr id="r_placeholder">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_placeholder"><?php echo $questions_view->placeholder->caption() ?></span></td>
		<td data-name="placeholder" <?php echo $questions_view->placeholder->cellAttributes() ?>>
<span id="el_questions_placeholder">
<span<?php echo $questions_view->placeholder->viewAttributes() ?>><?php echo $questions_view->placeholder->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->questions->Visible) { // questions ?>
	<tr id="r_questions">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_questions"><?php echo $questions_view->questions->caption() ?></span></td>
		<td data-name="questions" <?php echo $questions_view->questions->cellAttributes() ?>>
<span id="el_questions_questions">
<span<?php echo $questions_view->questions->viewAttributes() ?>><?php echo $questions_view->questions->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->scores->Visible) { // scores ?>
	<tr id="r_scores">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_scores"><?php echo $questions_view->scores->caption() ?></span></td>
		<td data-name="scores" <?php echo $questions_view->scores->cellAttributes() ?>>
<span id="el_questions_scores">
<span<?php echo $questions_view->scores->viewAttributes() ?>><?php echo $questions_view->scores->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->type->Visible) { // type ?>
	<tr id="r_type">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_type"><?php echo $questions_view->type->caption() ?></span></td>
		<td data-name="type" <?php echo $questions_view->type->cellAttributes() ?>>
<span id="el_questions_type">
<span<?php echo $questions_view->type->viewAttributes() ?>><?php echo $questions_view->type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->section->Visible) { // section ?>
	<tr id="r_section">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_section"><?php echo $questions_view->section->caption() ?></span></td>
		<td data-name="section" <?php echo $questions_view->section->cellAttributes() ?>>
<span id="el_questions_section">
<span<?php echo $questions_view->section->viewAttributes() ?>><?php echo $questions_view->section->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->active->Visible) { // active ?>
	<tr id="r_active">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_active"><?php echo $questions_view->active->caption() ?></span></td>
		<td data-name="active" <?php echo $questions_view->active->cellAttributes() ?>>
<span id="el_questions_active">
<span<?php echo $questions_view->active->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_active" class="custom-control-input" value="<?php echo $questions_view->active->getViewValue() ?>" disabled<?php if (ConvertToBool($questions_view->active->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_active"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_created_at"><?php echo $questions_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $questions_view->created_at->cellAttributes() ?>>
<span id="el_questions_created_at">
<span<?php echo $questions_view->created_at->viewAttributes() ?>><?php echo $questions_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_updated_at"><?php echo $questions_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $questions_view->updated_at->cellAttributes() ?>>
<span id="el_questions_updated_at">
<span<?php echo $questions_view->updated_at->viewAttributes() ?>><?php echo $questions_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->has_recommendations->Visible) { // has_recommendations ?>
	<tr id="r_has_recommendations">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_has_recommendations"><?php echo $questions_view->has_recommendations->caption() ?></span></td>
		<td data-name="has_recommendations" <?php echo $questions_view->has_recommendations->cellAttributes() ?>>
<span id="el_questions_has_recommendations">
<span<?php echo $questions_view->has_recommendations->viewAttributes() ?>><?php echo $questions_view->has_recommendations->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->group->Visible) { // group ?>
	<tr id="r_group">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_group"><?php echo $questions_view->group->caption() ?></span></td>
		<td data-name="group" <?php echo $questions_view->group->cellAttributes() ?>>
<span id="el_questions_group">
<span<?php echo $questions_view->group->viewAttributes() ?>><?php echo $questions_view->group->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->category->Visible) { // category ?>
	<tr id="r_category">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_category"><?php echo $questions_view->category->caption() ?></span></td>
		<td data-name="category" <?php echo $questions_view->category->cellAttributes() ?>>
<span id="el_questions_category">
<span<?php echo $questions_view->category->viewAttributes() ?>><?php echo $questions_view->category->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->order->Visible) { // order ?>
	<tr id="r_order">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_order"><?php echo $questions_view->order->caption() ?></span></td>
		<td data-name="order" <?php echo $questions_view->order->cellAttributes() ?>>
<span id="el_questions_order">
<span<?php echo $questions_view->order->viewAttributes() ?>><?php echo $questions_view->order->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->recommendation_by_score->Visible) { // recommendation_by_score ?>
	<tr id="r_recommendation_by_score">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_recommendation_by_score"><?php echo $questions_view->recommendation_by_score->caption() ?></span></td>
		<td data-name="recommendation_by_score" <?php echo $questions_view->recommendation_by_score->cellAttributes() ?>>
<span id="el_questions_recommendation_by_score">
<span<?php echo $questions_view->recommendation_by_score->viewAttributes() ?>><?php echo $questions_view->recommendation_by_score->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->recommendation_score->Visible) { // recommendation_score ?>
	<tr id="r_recommendation_score">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_recommendation_score"><?php echo $questions_view->recommendation_score->caption() ?></span></td>
		<td data-name="recommendation_score" <?php echo $questions_view->recommendation_score->cellAttributes() ?>>
<span id="el_questions_recommendation_score">
<span<?php echo $questions_view->recommendation_score->viewAttributes() ?>><?php echo $questions_view->recommendation_score->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->related->Visible) { // related ?>
	<tr id="r_related">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_related"><?php echo $questions_view->related->caption() ?></span></td>
		<td data-name="related" <?php echo $questions_view->related->cellAttributes() ?>>
<span id="el_questions_related">
<span<?php echo $questions_view->related->viewAttributes() ?>><?php echo $questions_view->related->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($questions_view->trigger_related_val->Visible) { // trigger_related_val ?>
	<tr id="r_trigger_related_val">
		<td class="<?php echo $questions_view->TableLeftColumnClass ?>"><span id="elh_questions_trigger_related_val"><?php echo $questions_view->trigger_related_val->caption() ?></span></td>
		<td data-name="trigger_related_val" <?php echo $questions_view->trigger_related_val->cellAttributes() ?>>
<span id="el_questions_trigger_related_val">
<span<?php echo $questions_view->trigger_related_val->viewAttributes() ?>><?php echo $questions_view->trigger_related_val->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("answers", explode(",", $questions->getCurrentDetailTable())) && $answers->DetailView) {
?>
<?php if ($questions->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("answers", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "answersgrid.php" ?>
<?php } ?>
</form>
<?php
$questions_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$questions_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$questions_view->terminate();
?>
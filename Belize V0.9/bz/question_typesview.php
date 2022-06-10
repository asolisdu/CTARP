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
$question_types_view = new question_types_view();

// Run the page
$question_types_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$question_types_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$question_types_view->isExport()) { ?>
<script>
var fquestion_typesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fquestion_typesview = currentForm = new ew.Form("fquestion_typesview", "view");
	loadjs.done("fquestion_typesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$question_types_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $question_types_view->ExportOptions->render("body") ?>
<?php $question_types_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $question_types_view->showPageHeader(); ?>
<?php
$question_types_view->showMessage();
?>
<form name="fquestion_typesview" id="fquestion_typesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="question_types">
<input type="hidden" name="modal" value="<?php echo (int)$question_types_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($question_types_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $question_types_view->TableLeftColumnClass ?>"><span id="elh_question_types_id"><?php echo $question_types_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $question_types_view->id->cellAttributes() ?>>
<span id="el_question_types_id">
<span<?php echo $question_types_view->id->viewAttributes() ?>><?php echo $question_types_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($question_types_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $question_types_view->TableLeftColumnClass ?>"><span id="elh_question_types_name"><?php echo $question_types_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $question_types_view->name->cellAttributes() ?>>
<span id="el_question_types_name">
<span<?php echo $question_types_view->name->viewAttributes() ?>><?php echo $question_types_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($question_types_view->desc->Visible) { // desc ?>
	<tr id="r_desc">
		<td class="<?php echo $question_types_view->TableLeftColumnClass ?>"><span id="elh_question_types_desc"><?php echo $question_types_view->desc->caption() ?></span></td>
		<td data-name="desc" <?php echo $question_types_view->desc->cellAttributes() ?>>
<span id="el_question_types_desc">
<span<?php echo $question_types_view->desc->viewAttributes() ?>><?php echo $question_types_view->desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($question_types_view->active->Visible) { // active ?>
	<tr id="r_active">
		<td class="<?php echo $question_types_view->TableLeftColumnClass ?>"><span id="elh_question_types_active"><?php echo $question_types_view->active->caption() ?></span></td>
		<td data-name="active" <?php echo $question_types_view->active->cellAttributes() ?>>
<span id="el_question_types_active">
<span<?php echo $question_types_view->active->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_active" class="custom-control-input" value="<?php echo $question_types_view->active->getViewValue() ?>" disabled<?php if (ConvertToBool($question_types_view->active->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_active"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($question_types_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $question_types_view->TableLeftColumnClass ?>"><span id="elh_question_types_created_at"><?php echo $question_types_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $question_types_view->created_at->cellAttributes() ?>>
<span id="el_question_types_created_at">
<span<?php echo $question_types_view->created_at->viewAttributes() ?>><?php echo $question_types_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($question_types_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $question_types_view->TableLeftColumnClass ?>"><span id="elh_question_types_updated_at"><?php echo $question_types_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $question_types_view->updated_at->cellAttributes() ?>>
<span id="el_question_types_updated_at">
<span<?php echo $question_types_view->updated_at->viewAttributes() ?>><?php echo $question_types_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("questions", explode(",", $question_types->getCurrentDetailTable())) && $questions->DetailView) {
?>
<?php if ($question_types->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("questions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "questionsgrid.php" ?>
<?php } ?>
</form>
<?php
$question_types_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$question_types_view->isExport()) { ?>
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
$question_types_view->terminate();
?>
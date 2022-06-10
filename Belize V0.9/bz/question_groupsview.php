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
$question_groups_view = new question_groups_view();

// Run the page
$question_groups_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$question_groups_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$question_groups_view->isExport()) { ?>
<script>
var fquestion_groupsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fquestion_groupsview = currentForm = new ew.Form("fquestion_groupsview", "view");
	loadjs.done("fquestion_groupsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$question_groups_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $question_groups_view->ExportOptions->render("body") ?>
<?php $question_groups_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $question_groups_view->showPageHeader(); ?>
<?php
$question_groups_view->showMessage();
?>
<form name="fquestion_groupsview" id="fquestion_groupsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="question_groups">
<input type="hidden" name="modal" value="<?php echo (int)$question_groups_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($question_groups_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $question_groups_view->TableLeftColumnClass ?>"><span id="elh_question_groups_id"><?php echo $question_groups_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $question_groups_view->id->cellAttributes() ?>>
<span id="el_question_groups_id">
<span<?php echo $question_groups_view->id->viewAttributes() ?>><?php echo $question_groups_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($question_groups_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $question_groups_view->TableLeftColumnClass ?>"><span id="elh_question_groups_name"><?php echo $question_groups_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $question_groups_view->name->cellAttributes() ?>>
<span id="el_question_groups_name">
<span<?php echo $question_groups_view->name->viewAttributes() ?>><?php echo $question_groups_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($question_groups_view->desc->Visible) { // desc ?>
	<tr id="r_desc">
		<td class="<?php echo $question_groups_view->TableLeftColumnClass ?>"><span id="elh_question_groups_desc"><?php echo $question_groups_view->desc->caption() ?></span></td>
		<td data-name="desc" <?php echo $question_groups_view->desc->cellAttributes() ?>>
<span id="el_question_groups_desc">
<span<?php echo $question_groups_view->desc->viewAttributes() ?>><?php echo $question_groups_view->desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("questions", explode(",", $question_groups->getCurrentDetailTable())) && $questions->DetailView) {
?>
<?php if ($question_groups->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("questions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "questionsgrid.php" ?>
<?php } ?>
</form>
<?php
$question_groups_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$question_groups_view->isExport()) { ?>
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
$question_groups_view->terminate();
?>
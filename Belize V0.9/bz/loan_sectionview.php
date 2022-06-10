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
$loan_section_view = new loan_section_view();

// Run the page
$loan_section_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$loan_section_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$loan_section_view->isExport()) { ?>
<script>
var floan_sectionview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	floan_sectionview = currentForm = new ew.Form("floan_sectionview", "view");
	loadjs.done("floan_sectionview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$loan_section_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $loan_section_view->ExportOptions->render("body") ?>
<?php $loan_section_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $loan_section_view->showPageHeader(); ?>
<?php
$loan_section_view->showMessage();
?>
<form name="floan_sectionview" id="floan_sectionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="loan_section">
<input type="hidden" name="modal" value="<?php echo (int)$loan_section_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($loan_section_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $loan_section_view->TableLeftColumnClass ?>"><span id="elh_loan_section_id"><?php echo $loan_section_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $loan_section_view->id->cellAttributes() ?>>
<span id="el_loan_section_id">
<span<?php echo $loan_section_view->id->viewAttributes() ?>><?php echo $loan_section_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($loan_section_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $loan_section_view->TableLeftColumnClass ?>"><span id="elh_loan_section_name"><?php echo $loan_section_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $loan_section_view->name->cellAttributes() ?>>
<span id="el_loan_section_name">
<span<?php echo $loan_section_view->name->viewAttributes() ?>><?php echo $loan_section_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($loan_section_view->desc->Visible) { // desc ?>
	<tr id="r_desc">
		<td class="<?php echo $loan_section_view->TableLeftColumnClass ?>"><span id="elh_loan_section_desc"><?php echo $loan_section_view->desc->caption() ?></span></td>
		<td data-name="desc" <?php echo $loan_section_view->desc->cellAttributes() ?>>
<span id="el_loan_section_desc">
<span<?php echo $loan_section_view->desc->viewAttributes() ?>><?php echo $loan_section_view->desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($loan_section_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $loan_section_view->TableLeftColumnClass ?>"><span id="elh_loan_section_created_at"><?php echo $loan_section_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $loan_section_view->created_at->cellAttributes() ?>>
<span id="el_loan_section_created_at">
<span<?php echo $loan_section_view->created_at->viewAttributes() ?>><?php echo $loan_section_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($loan_section_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $loan_section_view->TableLeftColumnClass ?>"><span id="elh_loan_section_updated_at"><?php echo $loan_section_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $loan_section_view->updated_at->cellAttributes() ?>>
<span id="el_loan_section_updated_at">
<span<?php echo $loan_section_view->updated_at->viewAttributes() ?>><?php echo $loan_section_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("assessments", explode(",", $loan_section->getCurrentDetailTable())) && $assessments->DetailView) {
?>
<?php if ($loan_section->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("assessments", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "assessmentsgrid.php" ?>
<?php } ?>
</form>
<?php
$loan_section_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$loan_section_view->isExport()) { ?>
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
$loan_section_view->terminate();
?>
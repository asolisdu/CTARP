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
$loan_purposes_view = new loan_purposes_view();

// Run the page
$loan_purposes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$loan_purposes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$loan_purposes_view->isExport()) { ?>
<script>
var floan_purposesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	floan_purposesview = currentForm = new ew.Form("floan_purposesview", "view");
	loadjs.done("floan_purposesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$loan_purposes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $loan_purposes_view->ExportOptions->render("body") ?>
<?php $loan_purposes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $loan_purposes_view->showPageHeader(); ?>
<?php
$loan_purposes_view->showMessage();
?>
<form name="floan_purposesview" id="floan_purposesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="loan_purposes">
<input type="hidden" name="modal" value="<?php echo (int)$loan_purposes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($loan_purposes_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $loan_purposes_view->TableLeftColumnClass ?>"><span id="elh_loan_purposes_id"><?php echo $loan_purposes_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $loan_purposes_view->id->cellAttributes() ?>>
<span id="el_loan_purposes_id">
<span<?php echo $loan_purposes_view->id->viewAttributes() ?>><?php echo $loan_purposes_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($loan_purposes_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $loan_purposes_view->TableLeftColumnClass ?>"><span id="elh_loan_purposes_name"><?php echo $loan_purposes_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $loan_purposes_view->name->cellAttributes() ?>>
<span id="el_loan_purposes_name">
<span<?php echo $loan_purposes_view->name->viewAttributes() ?>><?php echo $loan_purposes_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($loan_purposes_view->desc->Visible) { // desc ?>
	<tr id="r_desc">
		<td class="<?php echo $loan_purposes_view->TableLeftColumnClass ?>"><span id="elh_loan_purposes_desc"><?php echo $loan_purposes_view->desc->caption() ?></span></td>
		<td data-name="desc" <?php echo $loan_purposes_view->desc->cellAttributes() ?>>
<span id="el_loan_purposes_desc">
<span<?php echo $loan_purposes_view->desc->viewAttributes() ?>><?php echo $loan_purposes_view->desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($loan_purposes_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $loan_purposes_view->TableLeftColumnClass ?>"><span id="elh_loan_purposes_created_at"><?php echo $loan_purposes_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $loan_purposes_view->created_at->cellAttributes() ?>>
<span id="el_loan_purposes_created_at">
<span<?php echo $loan_purposes_view->created_at->viewAttributes() ?>><?php echo $loan_purposes_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($loan_purposes_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $loan_purposes_view->TableLeftColumnClass ?>"><span id="elh_loan_purposes_updated_at"><?php echo $loan_purposes_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $loan_purposes_view->updated_at->cellAttributes() ?>>
<span id="el_loan_purposes_updated_at">
<span<?php echo $loan_purposes_view->updated_at->viewAttributes() ?>><?php echo $loan_purposes_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("assessments", explode(",", $loan_purposes->getCurrentDetailTable())) && $assessments->DetailView) {
?>
<?php if ($loan_purposes->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("assessments", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "assessmentsgrid.php" ?>
<?php } ?>
</form>
<?php
$loan_purposes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$loan_purposes_view->isExport()) { ?>
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
$loan_purposes_view->terminate();
?>
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
$results_view = new results_view();

// Run the page
$results_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$results_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$results_view->isExport()) { ?>
<script>
var fresultsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fresultsview = currentForm = new ew.Form("fresultsview", "view");
	loadjs.done("fresultsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$results_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $results_view->ExportOptions->render("body") ?>
<?php $results_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $results_view->showPageHeader(); ?>
<?php
$results_view->showMessage();
?>
<form name="fresultsview" id="fresultsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="results">
<input type="hidden" name="modal" value="<?php echo (int)$results_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($results_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $results_view->TableLeftColumnClass ?>"><span id="elh_results_id"><?php echo $results_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $results_view->id->cellAttributes() ?>>
<span id="el_results_id">
<span<?php echo $results_view->id->viewAttributes() ?>><?php echo $results_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($results_view->assessment_id->Visible) { // assessment_id ?>
	<tr id="r_assessment_id">
		<td class="<?php echo $results_view->TableLeftColumnClass ?>"><span id="elh_results_assessment_id"><?php echo $results_view->assessment_id->caption() ?></span></td>
		<td data-name="assessment_id" <?php echo $results_view->assessment_id->cellAttributes() ?>>
<span id="el_results_assessment_id">
<span<?php echo $results_view->assessment_id->viewAttributes() ?>><?php echo $results_view->assessment_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($results_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $results_view->TableLeftColumnClass ?>"><span id="elh_results_created_at"><?php echo $results_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $results_view->created_at->cellAttributes() ?>>
<span id="el_results_created_at">
<span<?php echo $results_view->created_at->viewAttributes() ?>><?php echo $results_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($results_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $results_view->TableLeftColumnClass ?>"><span id="elh_results_updated_at"><?php echo $results_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $results_view->updated_at->cellAttributes() ?>>
<span id="el_results_updated_at">
<span<?php echo $results_view->updated_at->viewAttributes() ?>><?php echo $results_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($results_view->answers->Visible) { // answers ?>
	<tr id="r_answers">
		<td class="<?php echo $results_view->TableLeftColumnClass ?>"><span id="elh_results_answers"><?php echo $results_view->answers->caption() ?></span></td>
		<td data-name="answers" <?php echo $results_view->answers->cellAttributes() ?>>
<span id="el_results_answers">
<span<?php echo $results_view->answers->viewAttributes() ?>><?php echo $results_view->answers->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$results_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$results_view->isExport()) { ?>
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
$results_view->terminate();
?>
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
$results_delete = new results_delete();

// Run the page
$results_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$results_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fresultsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fresultsdelete = currentForm = new ew.Form("fresultsdelete", "delete");
	loadjs.done("fresultsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $results_delete->showPageHeader(); ?>
<?php
$results_delete->showMessage();
?>
<form name="fresultsdelete" id="fresultsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="results">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($results_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($results_delete->id->Visible) { // id ?>
		<th class="<?php echo $results_delete->id->headerCellClass() ?>"><span id="elh_results_id" class="results_id"><?php echo $results_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($results_delete->assessment_id->Visible) { // assessment_id ?>
		<th class="<?php echo $results_delete->assessment_id->headerCellClass() ?>"><span id="elh_results_assessment_id" class="results_assessment_id"><?php echo $results_delete->assessment_id->caption() ?></span></th>
<?php } ?>
<?php if ($results_delete->created_at->Visible) { // created_at ?>
		<th class="<?php echo $results_delete->created_at->headerCellClass() ?>"><span id="elh_results_created_at" class="results_created_at"><?php echo $results_delete->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($results_delete->updated_at->Visible) { // updated_at ?>
		<th class="<?php echo $results_delete->updated_at->headerCellClass() ?>"><span id="elh_results_updated_at" class="results_updated_at"><?php echo $results_delete->updated_at->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$results_delete->RecordCount = 0;
$i = 0;
while (!$results_delete->Recordset->EOF) {
	$results_delete->RecordCount++;
	$results_delete->RowCount++;

	// Set row properties
	$results->resetAttributes();
	$results->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$results_delete->loadRowValues($results_delete->Recordset);

	// Render row
	$results_delete->renderRow();
?>
	<tr <?php echo $results->rowAttributes() ?>>
<?php if ($results_delete->id->Visible) { // id ?>
		<td <?php echo $results_delete->id->cellAttributes() ?>>
<span id="el<?php echo $results_delete->RowCount ?>_results_id" class="results_id">
<span<?php echo $results_delete->id->viewAttributes() ?>><?php echo $results_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($results_delete->assessment_id->Visible) { // assessment_id ?>
		<td <?php echo $results_delete->assessment_id->cellAttributes() ?>>
<span id="el<?php echo $results_delete->RowCount ?>_results_assessment_id" class="results_assessment_id">
<span<?php echo $results_delete->assessment_id->viewAttributes() ?>><?php echo $results_delete->assessment_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($results_delete->created_at->Visible) { // created_at ?>
		<td <?php echo $results_delete->created_at->cellAttributes() ?>>
<span id="el<?php echo $results_delete->RowCount ?>_results_created_at" class="results_created_at">
<span<?php echo $results_delete->created_at->viewAttributes() ?>><?php echo $results_delete->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($results_delete->updated_at->Visible) { // updated_at ?>
		<td <?php echo $results_delete->updated_at->cellAttributes() ?>>
<span id="el<?php echo $results_delete->RowCount ?>_results_updated_at" class="results_updated_at">
<span<?php echo $results_delete->updated_at->viewAttributes() ?>><?php echo $results_delete->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$results_delete->Recordset->moveNext();
}
$results_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $results_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$results_delete->showPageFooter();
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
$results_delete->terminate();
?>
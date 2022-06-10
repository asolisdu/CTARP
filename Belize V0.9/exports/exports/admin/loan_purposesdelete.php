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
$loan_purposes_delete = new loan_purposes_delete();

// Run the page
$loan_purposes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$loan_purposes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var floan_purposesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	floan_purposesdelete = currentForm = new ew.Form("floan_purposesdelete", "delete");
	loadjs.done("floan_purposesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $loan_purposes_delete->showPageHeader(); ?>
<?php
$loan_purposes_delete->showMessage();
?>
<form name="floan_purposesdelete" id="floan_purposesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="loan_purposes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($loan_purposes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($loan_purposes_delete->id->Visible) { // id ?>
		<th class="<?php echo $loan_purposes_delete->id->headerCellClass() ?>"><span id="elh_loan_purposes_id" class="loan_purposes_id"><?php echo $loan_purposes_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($loan_purposes_delete->name->Visible) { // name ?>
		<th class="<?php echo $loan_purposes_delete->name->headerCellClass() ?>"><span id="elh_loan_purposes_name" class="loan_purposes_name"><?php echo $loan_purposes_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($loan_purposes_delete->desc->Visible) { // desc ?>
		<th class="<?php echo $loan_purposes_delete->desc->headerCellClass() ?>"><span id="elh_loan_purposes_desc" class="loan_purposes_desc"><?php echo $loan_purposes_delete->desc->caption() ?></span></th>
<?php } ?>
<?php if ($loan_purposes_delete->created_at->Visible) { // created_at ?>
		<th class="<?php echo $loan_purposes_delete->created_at->headerCellClass() ?>"><span id="elh_loan_purposes_created_at" class="loan_purposes_created_at"><?php echo $loan_purposes_delete->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($loan_purposes_delete->updated_at->Visible) { // updated_at ?>
		<th class="<?php echo $loan_purposes_delete->updated_at->headerCellClass() ?>"><span id="elh_loan_purposes_updated_at" class="loan_purposes_updated_at"><?php echo $loan_purposes_delete->updated_at->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$loan_purposes_delete->RecordCount = 0;
$i = 0;
while (!$loan_purposes_delete->Recordset->EOF) {
	$loan_purposes_delete->RecordCount++;
	$loan_purposes_delete->RowCount++;

	// Set row properties
	$loan_purposes->resetAttributes();
	$loan_purposes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$loan_purposes_delete->loadRowValues($loan_purposes_delete->Recordset);

	// Render row
	$loan_purposes_delete->renderRow();
?>
	<tr <?php echo $loan_purposes->rowAttributes() ?>>
<?php if ($loan_purposes_delete->id->Visible) { // id ?>
		<td <?php echo $loan_purposes_delete->id->cellAttributes() ?>>
<span id="el<?php echo $loan_purposes_delete->RowCount ?>_loan_purposes_id" class="loan_purposes_id">
<span<?php echo $loan_purposes_delete->id->viewAttributes() ?>><?php echo $loan_purposes_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($loan_purposes_delete->name->Visible) { // name ?>
		<td <?php echo $loan_purposes_delete->name->cellAttributes() ?>>
<span id="el<?php echo $loan_purposes_delete->RowCount ?>_loan_purposes_name" class="loan_purposes_name">
<span<?php echo $loan_purposes_delete->name->viewAttributes() ?>><?php echo $loan_purposes_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($loan_purposes_delete->desc->Visible) { // desc ?>
		<td <?php echo $loan_purposes_delete->desc->cellAttributes() ?>>
<span id="el<?php echo $loan_purposes_delete->RowCount ?>_loan_purposes_desc" class="loan_purposes_desc">
<span<?php echo $loan_purposes_delete->desc->viewAttributes() ?>><?php echo $loan_purposes_delete->desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($loan_purposes_delete->created_at->Visible) { // created_at ?>
		<td <?php echo $loan_purposes_delete->created_at->cellAttributes() ?>>
<span id="el<?php echo $loan_purposes_delete->RowCount ?>_loan_purposes_created_at" class="loan_purposes_created_at">
<span<?php echo $loan_purposes_delete->created_at->viewAttributes() ?>><?php echo $loan_purposes_delete->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($loan_purposes_delete->updated_at->Visible) { // updated_at ?>
		<td <?php echo $loan_purposes_delete->updated_at->cellAttributes() ?>>
<span id="el<?php echo $loan_purposes_delete->RowCount ?>_loan_purposes_updated_at" class="loan_purposes_updated_at">
<span<?php echo $loan_purposes_delete->updated_at->viewAttributes() ?>><?php echo $loan_purposes_delete->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$loan_purposes_delete->Recordset->moveNext();
}
$loan_purposes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $loan_purposes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$loan_purposes_delete->showPageFooter();
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
$loan_purposes_delete->terminate();
?>
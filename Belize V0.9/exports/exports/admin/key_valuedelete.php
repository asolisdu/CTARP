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
$key_value_delete = new key_value_delete();

// Run the page
$key_value_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$key_value_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkey_valuedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fkey_valuedelete = currentForm = new ew.Form("fkey_valuedelete", "delete");
	loadjs.done("fkey_valuedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $key_value_delete->showPageHeader(); ?>
<?php
$key_value_delete->showMessage();
?>
<form name="fkey_valuedelete" id="fkey_valuedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="key_value">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($key_value_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($key_value_delete->id->Visible) { // id ?>
		<th class="<?php echo $key_value_delete->id->headerCellClass() ?>"><span id="elh_key_value_id" class="key_value_id"><?php echo $key_value_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($key_value_delete->name->Visible) { // name ?>
		<th class="<?php echo $key_value_delete->name->headerCellClass() ?>"><span id="elh_key_value_name" class="key_value_name"><?php echo $key_value_delete->name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$key_value_delete->RecordCount = 0;
$i = 0;
while (!$key_value_delete->Recordset->EOF) {
	$key_value_delete->RecordCount++;
	$key_value_delete->RowCount++;

	// Set row properties
	$key_value->resetAttributes();
	$key_value->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$key_value_delete->loadRowValues($key_value_delete->Recordset);

	// Render row
	$key_value_delete->renderRow();
?>
	<tr <?php echo $key_value->rowAttributes() ?>>
<?php if ($key_value_delete->id->Visible) { // id ?>
		<td <?php echo $key_value_delete->id->cellAttributes() ?>>
<span id="el<?php echo $key_value_delete->RowCount ?>_key_value_id" class="key_value_id">
<span<?php echo $key_value_delete->id->viewAttributes() ?>><?php echo $key_value_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($key_value_delete->name->Visible) { // name ?>
		<td <?php echo $key_value_delete->name->cellAttributes() ?>>
<span id="el<?php echo $key_value_delete->RowCount ?>_key_value_name" class="key_value_name">
<span<?php echo $key_value_delete->name->viewAttributes() ?>><?php echo $key_value_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$key_value_delete->Recordset->moveNext();
}
$key_value_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $key_value_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$key_value_delete->showPageFooter();
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
$key_value_delete->terminate();
?>
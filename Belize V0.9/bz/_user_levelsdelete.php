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
$_user_levels_delete = new _user_levels_delete();

// Run the page
$_user_levels_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_user_levels_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_user_levelsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	f_user_levelsdelete = currentForm = new ew.Form("f_user_levelsdelete", "delete");
	loadjs.done("f_user_levelsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_user_levels_delete->showPageHeader(); ?>
<?php
$_user_levels_delete->showMessage();
?>
<form name="f_user_levelsdelete" id="f_user_levelsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_user_levels">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($_user_levels_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($_user_levels_delete->id->Visible) { // id ?>
		<th class="<?php echo $_user_levels_delete->id->headerCellClass() ?>"><span id="elh__user_levels_id" class="_user_levels_id"><?php echo $_user_levels_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($_user_levels_delete->name->Visible) { // name ?>
		<th class="<?php echo $_user_levels_delete->name->headerCellClass() ?>"><span id="elh__user_levels_name" class="_user_levels_name"><?php echo $_user_levels_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($_user_levels_delete->desc->Visible) { // desc ?>
		<th class="<?php echo $_user_levels_delete->desc->headerCellClass() ?>"><span id="elh__user_levels_desc" class="_user_levels_desc"><?php echo $_user_levels_delete->desc->caption() ?></span></th>
<?php } ?>
<?php if ($_user_levels_delete->created_at->Visible) { // created_at ?>
		<th class="<?php echo $_user_levels_delete->created_at->headerCellClass() ?>"><span id="elh__user_levels_created_at" class="_user_levels_created_at"><?php echo $_user_levels_delete->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($_user_levels_delete->updated_at->Visible) { // updated_at ?>
		<th class="<?php echo $_user_levels_delete->updated_at->headerCellClass() ?>"><span id="elh__user_levels_updated_at" class="_user_levels_updated_at"><?php echo $_user_levels_delete->updated_at->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$_user_levels_delete->RecordCount = 0;
$i = 0;
while (!$_user_levels_delete->Recordset->EOF) {
	$_user_levels_delete->RecordCount++;
	$_user_levels_delete->RowCount++;

	// Set row properties
	$_user_levels->resetAttributes();
	$_user_levels->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$_user_levels_delete->loadRowValues($_user_levels_delete->Recordset);

	// Render row
	$_user_levels_delete->renderRow();
?>
	<tr <?php echo $_user_levels->rowAttributes() ?>>
<?php if ($_user_levels_delete->id->Visible) { // id ?>
		<td <?php echo $_user_levels_delete->id->cellAttributes() ?>>
<span id="el<?php echo $_user_levels_delete->RowCount ?>__user_levels_id" class="_user_levels_id">
<span<?php echo $_user_levels_delete->id->viewAttributes() ?>><?php echo $_user_levels_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_user_levels_delete->name->Visible) { // name ?>
		<td <?php echo $_user_levels_delete->name->cellAttributes() ?>>
<span id="el<?php echo $_user_levels_delete->RowCount ?>__user_levels_name" class="_user_levels_name">
<span<?php echo $_user_levels_delete->name->viewAttributes() ?>><?php echo $_user_levels_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_user_levels_delete->desc->Visible) { // desc ?>
		<td <?php echo $_user_levels_delete->desc->cellAttributes() ?>>
<span id="el<?php echo $_user_levels_delete->RowCount ?>__user_levels_desc" class="_user_levels_desc">
<span<?php echo $_user_levels_delete->desc->viewAttributes() ?>><?php echo $_user_levels_delete->desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_user_levels_delete->created_at->Visible) { // created_at ?>
		<td <?php echo $_user_levels_delete->created_at->cellAttributes() ?>>
<span id="el<?php echo $_user_levels_delete->RowCount ?>__user_levels_created_at" class="_user_levels_created_at">
<span<?php echo $_user_levels_delete->created_at->viewAttributes() ?>><?php echo $_user_levels_delete->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_user_levels_delete->updated_at->Visible) { // updated_at ?>
		<td <?php echo $_user_levels_delete->updated_at->cellAttributes() ?>>
<span id="el<?php echo $_user_levels_delete->RowCount ?>__user_levels_updated_at" class="_user_levels_updated_at">
<span<?php echo $_user_levels_delete->updated_at->viewAttributes() ?>><?php echo $_user_levels_delete->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$_user_levels_delete->Recordset->moveNext();
}
$_user_levels_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $_user_levels_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$_user_levels_delete->showPageFooter();
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
$_user_levels_delete->terminate();
?>
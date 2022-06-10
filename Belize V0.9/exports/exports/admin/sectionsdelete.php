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
$sections_delete = new sections_delete();

// Run the page
$sections_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sections_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsectionsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsectionsdelete = currentForm = new ew.Form("fsectionsdelete", "delete");
	loadjs.done("fsectionsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sections_delete->showPageHeader(); ?>
<?php
$sections_delete->showMessage();
?>
<form name="fsectionsdelete" id="fsectionsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sections">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($sections_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($sections_delete->id->Visible) { // id ?>
		<th class="<?php echo $sections_delete->id->headerCellClass() ?>"><span id="elh_sections_id" class="sections_id"><?php echo $sections_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($sections_delete->title->Visible) { // title ?>
		<th class="<?php echo $sections_delete->title->headerCellClass() ?>"><span id="elh_sections_title" class="sections_title"><?php echo $sections_delete->title->caption() ?></span></th>
<?php } ?>
<?php if ($sections_delete->desc->Visible) { // desc ?>
		<th class="<?php echo $sections_delete->desc->headerCellClass() ?>"><span id="elh_sections_desc" class="sections_desc"><?php echo $sections_delete->desc->caption() ?></span></th>
<?php } ?>
<?php if ($sections_delete->order->Visible) { // order ?>
		<th class="<?php echo $sections_delete->order->headerCellClass() ?>"><span id="elh_sections_order" class="sections_order"><?php echo $sections_delete->order->caption() ?></span></th>
<?php } ?>
<?php if ($sections_delete->created_at->Visible) { // created_at ?>
		<th class="<?php echo $sections_delete->created_at->headerCellClass() ?>"><span id="elh_sections_created_at" class="sections_created_at"><?php echo $sections_delete->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($sections_delete->updated_at->Visible) { // updated_at ?>
		<th class="<?php echo $sections_delete->updated_at->headerCellClass() ?>"><span id="elh_sections_updated_at" class="sections_updated_at"><?php echo $sections_delete->updated_at->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$sections_delete->RecordCount = 0;
$i = 0;
while (!$sections_delete->Recordset->EOF) {
	$sections_delete->RecordCount++;
	$sections_delete->RowCount++;

	// Set row properties
	$sections->resetAttributes();
	$sections->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$sections_delete->loadRowValues($sections_delete->Recordset);

	// Render row
	$sections_delete->renderRow();
?>
	<tr <?php echo $sections->rowAttributes() ?>>
<?php if ($sections_delete->id->Visible) { // id ?>
		<td <?php echo $sections_delete->id->cellAttributes() ?>>
<span id="el<?php echo $sections_delete->RowCount ?>_sections_id" class="sections_id">
<span<?php echo $sections_delete->id->viewAttributes() ?>><?php echo $sections_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sections_delete->title->Visible) { // title ?>
		<td <?php echo $sections_delete->title->cellAttributes() ?>>
<span id="el<?php echo $sections_delete->RowCount ?>_sections_title" class="sections_title">
<span<?php echo $sections_delete->title->viewAttributes() ?>><?php echo $sections_delete->title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sections_delete->desc->Visible) { // desc ?>
		<td <?php echo $sections_delete->desc->cellAttributes() ?>>
<span id="el<?php echo $sections_delete->RowCount ?>_sections_desc" class="sections_desc">
<span<?php echo $sections_delete->desc->viewAttributes() ?>><?php echo $sections_delete->desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sections_delete->order->Visible) { // order ?>
		<td <?php echo $sections_delete->order->cellAttributes() ?>>
<span id="el<?php echo $sections_delete->RowCount ?>_sections_order" class="sections_order">
<span<?php echo $sections_delete->order->viewAttributes() ?>><?php echo $sections_delete->order->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sections_delete->created_at->Visible) { // created_at ?>
		<td <?php echo $sections_delete->created_at->cellAttributes() ?>>
<span id="el<?php echo $sections_delete->RowCount ?>_sections_created_at" class="sections_created_at">
<span<?php echo $sections_delete->created_at->viewAttributes() ?>><?php echo $sections_delete->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sections_delete->updated_at->Visible) { // updated_at ?>
		<td <?php echo $sections_delete->updated_at->cellAttributes() ?>>
<span id="el<?php echo $sections_delete->RowCount ?>_sections_updated_at" class="sections_updated_at">
<span<?php echo $sections_delete->updated_at->viewAttributes() ?>><?php echo $sections_delete->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$sections_delete->Recordset->moveNext();
}
$sections_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sections_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$sections_delete->showPageFooter();
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
$sections_delete->terminate();
?>
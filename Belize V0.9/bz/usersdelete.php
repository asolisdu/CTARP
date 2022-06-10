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
$users_delete = new users_delete();

// Run the page
$users_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fusersdelete = currentForm = new ew.Form("fusersdelete", "delete");
	loadjs.done("fusersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_delete->showPageHeader(); ?>
<?php
$users_delete->showMessage();
?>
<form name="fusersdelete" id="fusersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($users_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($users_delete->id->Visible) { // id ?>
		<th class="<?php echo $users_delete->id->headerCellClass() ?>"><span id="elh_users_id" class="users_id"><?php echo $users_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->first_names->Visible) { // first_names ?>
		<th class="<?php echo $users_delete->first_names->headerCellClass() ?>"><span id="elh_users_first_names" class="users_first_names"><?php echo $users_delete->first_names->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->last_names->Visible) { // last_names ?>
		<th class="<?php echo $users_delete->last_names->headerCellClass() ?>"><span id="elh_users_last_names" class="users_last_names"><?php echo $users_delete->last_names->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->_email->Visible) { // email ?>
		<th class="<?php echo $users_delete->_email->headerCellClass() ?>"><span id="elh_users__email" class="users__email"><?php echo $users_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->user_level->Visible) { // user_level ?>
		<th class="<?php echo $users_delete->user_level->headerCellClass() ?>"><span id="elh_users_user_level" class="users_user_level"><?php echo $users_delete->user_level->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->created_at->Visible) { // created_at ?>
		<th class="<?php echo $users_delete->created_at->headerCellClass() ?>"><span id="elh_users_created_at" class="users_created_at"><?php echo $users_delete->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->updated_at->Visible) { // updated_at ?>
		<th class="<?php echo $users_delete->updated_at->headerCellClass() ?>"><span id="elh_users_updated_at" class="users_updated_at"><?php echo $users_delete->updated_at->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$users_delete->RecordCount = 0;
$i = 0;
while (!$users_delete->Recordset->EOF) {
	$users_delete->RecordCount++;
	$users_delete->RowCount++;

	// Set row properties
	$users->resetAttributes();
	$users->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$users_delete->loadRowValues($users_delete->Recordset);

	// Render row
	$users_delete->renderRow();
?>
	<tr <?php echo $users->rowAttributes() ?>>
<?php if ($users_delete->id->Visible) { // id ?>
		<td <?php echo $users_delete->id->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_id" class="users_id">
<span<?php echo $users_delete->id->viewAttributes() ?>><?php echo $users_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->first_names->Visible) { // first_names ?>
		<td <?php echo $users_delete->first_names->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_first_names" class="users_first_names">
<span<?php echo $users_delete->first_names->viewAttributes() ?>><?php echo $users_delete->first_names->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->last_names->Visible) { // last_names ?>
		<td <?php echo $users_delete->last_names->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_last_names" class="users_last_names">
<span<?php echo $users_delete->last_names->viewAttributes() ?>><?php echo $users_delete->last_names->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->_email->Visible) { // email ?>
		<td <?php echo $users_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users__email" class="users__email">
<span<?php echo $users_delete->_email->viewAttributes() ?>><?php echo $users_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->user_level->Visible) { // user_level ?>
		<td <?php echo $users_delete->user_level->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_user_level" class="users_user_level">
<span<?php echo $users_delete->user_level->viewAttributes() ?>><?php echo $users_delete->user_level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->created_at->Visible) { // created_at ?>
		<td <?php echo $users_delete->created_at->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_created_at" class="users_created_at">
<span<?php echo $users_delete->created_at->viewAttributes() ?>><?php echo $users_delete->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->updated_at->Visible) { // updated_at ?>
		<td <?php echo $users_delete->updated_at->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_updated_at" class="users_updated_at">
<span<?php echo $users_delete->updated_at->viewAttributes() ?>><?php echo $users_delete->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$users_delete->Recordset->moveNext();
}
$users_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$users_delete->showPageFooter();
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
$users_delete->terminate();
?>
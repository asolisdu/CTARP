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
$question_types_delete = new question_types_delete();

// Run the page
$question_types_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$question_types_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fquestion_typesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fquestion_typesdelete = currentForm = new ew.Form("fquestion_typesdelete", "delete");
	loadjs.done("fquestion_typesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $question_types_delete->showPageHeader(); ?>
<?php
$question_types_delete->showMessage();
?>
<form name="fquestion_typesdelete" id="fquestion_typesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="question_types">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($question_types_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($question_types_delete->id->Visible) { // id ?>
		<th class="<?php echo $question_types_delete->id->headerCellClass() ?>"><span id="elh_question_types_id" class="question_types_id"><?php echo $question_types_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($question_types_delete->name->Visible) { // name ?>
		<th class="<?php echo $question_types_delete->name->headerCellClass() ?>"><span id="elh_question_types_name" class="question_types_name"><?php echo $question_types_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($question_types_delete->desc->Visible) { // desc ?>
		<th class="<?php echo $question_types_delete->desc->headerCellClass() ?>"><span id="elh_question_types_desc" class="question_types_desc"><?php echo $question_types_delete->desc->caption() ?></span></th>
<?php } ?>
<?php if ($question_types_delete->active->Visible) { // active ?>
		<th class="<?php echo $question_types_delete->active->headerCellClass() ?>"><span id="elh_question_types_active" class="question_types_active"><?php echo $question_types_delete->active->caption() ?></span></th>
<?php } ?>
<?php if ($question_types_delete->created_at->Visible) { // created_at ?>
		<th class="<?php echo $question_types_delete->created_at->headerCellClass() ?>"><span id="elh_question_types_created_at" class="question_types_created_at"><?php echo $question_types_delete->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($question_types_delete->updated_at->Visible) { // updated_at ?>
		<th class="<?php echo $question_types_delete->updated_at->headerCellClass() ?>"><span id="elh_question_types_updated_at" class="question_types_updated_at"><?php echo $question_types_delete->updated_at->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$question_types_delete->RecordCount = 0;
$i = 0;
while (!$question_types_delete->Recordset->EOF) {
	$question_types_delete->RecordCount++;
	$question_types_delete->RowCount++;

	// Set row properties
	$question_types->resetAttributes();
	$question_types->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$question_types_delete->loadRowValues($question_types_delete->Recordset);

	// Render row
	$question_types_delete->renderRow();
?>
	<tr <?php echo $question_types->rowAttributes() ?>>
<?php if ($question_types_delete->id->Visible) { // id ?>
		<td <?php echo $question_types_delete->id->cellAttributes() ?>>
<span id="el<?php echo $question_types_delete->RowCount ?>_question_types_id" class="question_types_id">
<span<?php echo $question_types_delete->id->viewAttributes() ?>><?php echo $question_types_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($question_types_delete->name->Visible) { // name ?>
		<td <?php echo $question_types_delete->name->cellAttributes() ?>>
<span id="el<?php echo $question_types_delete->RowCount ?>_question_types_name" class="question_types_name">
<span<?php echo $question_types_delete->name->viewAttributes() ?>><?php echo $question_types_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($question_types_delete->desc->Visible) { // desc ?>
		<td <?php echo $question_types_delete->desc->cellAttributes() ?>>
<span id="el<?php echo $question_types_delete->RowCount ?>_question_types_desc" class="question_types_desc">
<span<?php echo $question_types_delete->desc->viewAttributes() ?>><?php echo $question_types_delete->desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($question_types_delete->active->Visible) { // active ?>
		<td <?php echo $question_types_delete->active->cellAttributes() ?>>
<span id="el<?php echo $question_types_delete->RowCount ?>_question_types_active" class="question_types_active">
<span<?php echo $question_types_delete->active->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_active" class="custom-control-input" value="<?php echo $question_types_delete->active->getViewValue() ?>" disabled<?php if (ConvertToBool($question_types_delete->active->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_active"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($question_types_delete->created_at->Visible) { // created_at ?>
		<td <?php echo $question_types_delete->created_at->cellAttributes() ?>>
<span id="el<?php echo $question_types_delete->RowCount ?>_question_types_created_at" class="question_types_created_at">
<span<?php echo $question_types_delete->created_at->viewAttributes() ?>><?php echo $question_types_delete->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($question_types_delete->updated_at->Visible) { // updated_at ?>
		<td <?php echo $question_types_delete->updated_at->cellAttributes() ?>>
<span id="el<?php echo $question_types_delete->RowCount ?>_question_types_updated_at" class="question_types_updated_at">
<span<?php echo $question_types_delete->updated_at->viewAttributes() ?>><?php echo $question_types_delete->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$question_types_delete->Recordset->moveNext();
}
$question_types_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $question_types_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$question_types_delete->showPageFooter();
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
$question_types_delete->terminate();
?>
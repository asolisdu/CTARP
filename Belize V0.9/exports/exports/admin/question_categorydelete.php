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
$question_category_delete = new question_category_delete();

// Run the page
$question_category_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$question_category_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fquestion_categorydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fquestion_categorydelete = currentForm = new ew.Form("fquestion_categorydelete", "delete");
	loadjs.done("fquestion_categorydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $question_category_delete->showPageHeader(); ?>
<?php
$question_category_delete->showMessage();
?>
<form name="fquestion_categorydelete" id="fquestion_categorydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="question_category">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($question_category_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($question_category_delete->id->Visible) { // id ?>
		<th class="<?php echo $question_category_delete->id->headerCellClass() ?>"><span id="elh_question_category_id" class="question_category_id"><?php echo $question_category_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($question_category_delete->name->Visible) { // name ?>
		<th class="<?php echo $question_category_delete->name->headerCellClass() ?>"><span id="elh_question_category_name" class="question_category_name"><?php echo $question_category_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($question_category_delete->desc->Visible) { // desc ?>
		<th class="<?php echo $question_category_delete->desc->headerCellClass() ?>"><span id="elh_question_category_desc" class="question_category_desc"><?php echo $question_category_delete->desc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$question_category_delete->RecordCount = 0;
$i = 0;
while (!$question_category_delete->Recordset->EOF) {
	$question_category_delete->RecordCount++;
	$question_category_delete->RowCount++;

	// Set row properties
	$question_category->resetAttributes();
	$question_category->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$question_category_delete->loadRowValues($question_category_delete->Recordset);

	// Render row
	$question_category_delete->renderRow();
?>
	<tr <?php echo $question_category->rowAttributes() ?>>
<?php if ($question_category_delete->id->Visible) { // id ?>
		<td <?php echo $question_category_delete->id->cellAttributes() ?>>
<span id="el<?php echo $question_category_delete->RowCount ?>_question_category_id" class="question_category_id">
<span<?php echo $question_category_delete->id->viewAttributes() ?>><?php echo $question_category_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($question_category_delete->name->Visible) { // name ?>
		<td <?php echo $question_category_delete->name->cellAttributes() ?>>
<span id="el<?php echo $question_category_delete->RowCount ?>_question_category_name" class="question_category_name">
<span<?php echo $question_category_delete->name->viewAttributes() ?>><?php echo $question_category_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($question_category_delete->desc->Visible) { // desc ?>
		<td <?php echo $question_category_delete->desc->cellAttributes() ?>>
<span id="el<?php echo $question_category_delete->RowCount ?>_question_category_desc" class="question_category_desc">
<span<?php echo $question_category_delete->desc->viewAttributes() ?>><?php echo $question_category_delete->desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$question_category_delete->Recordset->moveNext();
}
$question_category_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $question_category_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$question_category_delete->showPageFooter();
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
$question_category_delete->terminate();
?>
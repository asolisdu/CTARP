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
$answers_delete = new answers_delete();

// Run the page
$answers_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$answers_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fanswersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fanswersdelete = currentForm = new ew.Form("fanswersdelete", "delete");
	loadjs.done("fanswersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $answers_delete->showPageHeader(); ?>
<?php
$answers_delete->showMessage();
?>
<form name="fanswersdelete" id="fanswersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="answers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($answers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($answers_delete->id->Visible) { // id ?>
		<th class="<?php echo $answers_delete->id->headerCellClass() ?>"><span id="elh_answers_id" class="answers_id"><?php echo $answers_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($answers_delete->question_id->Visible) { // question_id ?>
		<th class="<?php echo $answers_delete->question_id->headerCellClass() ?>"><span id="elh_answers_question_id" class="answers_question_id"><?php echo $answers_delete->question_id->caption() ?></span></th>
<?php } ?>
<?php if ($answers_delete->assessment_id->Visible) { // assessment_id ?>
		<th class="<?php echo $answers_delete->assessment_id->headerCellClass() ?>"><span id="elh_answers_assessment_id" class="answers_assessment_id"><?php echo $answers_delete->assessment_id->caption() ?></span></th>
<?php } ?>
<?php if ($answers_delete->section_id->Visible) { // section_id ?>
		<th class="<?php echo $answers_delete->section_id->headerCellClass() ?>"><span id="elh_answers_section_id" class="answers_section_id"><?php echo $answers_delete->section_id->caption() ?></span></th>
<?php } ?>
<?php if ($answers_delete->_response->Visible) { // response ?>
		<th class="<?php echo $answers_delete->_response->headerCellClass() ?>"><span id="elh_answers__response" class="answers__response"><?php echo $answers_delete->_response->caption() ?></span></th>
<?php } ?>
<?php if ($answers_delete->score->Visible) { // score ?>
		<th class="<?php echo $answers_delete->score->headerCellClass() ?>"><span id="elh_answers_score" class="answers_score"><?php echo $answers_delete->score->caption() ?></span></th>
<?php } ?>
<?php if ($answers_delete->created_at->Visible) { // created_at ?>
		<th class="<?php echo $answers_delete->created_at->headerCellClass() ?>"><span id="elh_answers_created_at" class="answers_created_at"><?php echo $answers_delete->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($answers_delete->updated_at->Visible) { // updated_at ?>
		<th class="<?php echo $answers_delete->updated_at->headerCellClass() ?>"><span id="elh_answers_updated_at" class="answers_updated_at"><?php echo $answers_delete->updated_at->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$answers_delete->RecordCount = 0;
$i = 0;
while (!$answers_delete->Recordset->EOF) {
	$answers_delete->RecordCount++;
	$answers_delete->RowCount++;

	// Set row properties
	$answers->resetAttributes();
	$answers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$answers_delete->loadRowValues($answers_delete->Recordset);

	// Render row
	$answers_delete->renderRow();
?>
	<tr <?php echo $answers->rowAttributes() ?>>
<?php if ($answers_delete->id->Visible) { // id ?>
		<td <?php echo $answers_delete->id->cellAttributes() ?>>
<span id="el<?php echo $answers_delete->RowCount ?>_answers_id" class="answers_id">
<span<?php echo $answers_delete->id->viewAttributes() ?>><?php echo $answers_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($answers_delete->question_id->Visible) { // question_id ?>
		<td <?php echo $answers_delete->question_id->cellAttributes() ?>>
<span id="el<?php echo $answers_delete->RowCount ?>_answers_question_id" class="answers_question_id">
<span<?php echo $answers_delete->question_id->viewAttributes() ?>><?php echo $answers_delete->question_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($answers_delete->assessment_id->Visible) { // assessment_id ?>
		<td <?php echo $answers_delete->assessment_id->cellAttributes() ?>>
<span id="el<?php echo $answers_delete->RowCount ?>_answers_assessment_id" class="answers_assessment_id">
<span<?php echo $answers_delete->assessment_id->viewAttributes() ?>><?php echo $answers_delete->assessment_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($answers_delete->section_id->Visible) { // section_id ?>
		<td <?php echo $answers_delete->section_id->cellAttributes() ?>>
<span id="el<?php echo $answers_delete->RowCount ?>_answers_section_id" class="answers_section_id">
<span<?php echo $answers_delete->section_id->viewAttributes() ?>><?php echo $answers_delete->section_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($answers_delete->_response->Visible) { // response ?>
		<td <?php echo $answers_delete->_response->cellAttributes() ?>>
<span id="el<?php echo $answers_delete->RowCount ?>_answers__response" class="answers__response">
<span<?php echo $answers_delete->_response->viewAttributes() ?>><?php echo $answers_delete->_response->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($answers_delete->score->Visible) { // score ?>
		<td <?php echo $answers_delete->score->cellAttributes() ?>>
<span id="el<?php echo $answers_delete->RowCount ?>_answers_score" class="answers_score">
<span<?php echo $answers_delete->score->viewAttributes() ?>><?php echo $answers_delete->score->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($answers_delete->created_at->Visible) { // created_at ?>
		<td <?php echo $answers_delete->created_at->cellAttributes() ?>>
<span id="el<?php echo $answers_delete->RowCount ?>_answers_created_at" class="answers_created_at">
<span<?php echo $answers_delete->created_at->viewAttributes() ?>><?php echo $answers_delete->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($answers_delete->updated_at->Visible) { // updated_at ?>
		<td <?php echo $answers_delete->updated_at->cellAttributes() ?>>
<span id="el<?php echo $answers_delete->RowCount ?>_answers_updated_at" class="answers_updated_at">
<span<?php echo $answers_delete->updated_at->viewAttributes() ?>><?php echo $answers_delete->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$answers_delete->Recordset->moveNext();
}
$answers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $answers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$answers_delete->showPageFooter();
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
$answers_delete->terminate();
?>
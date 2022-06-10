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
$assessments_delete = new assessments_delete();

// Run the page
$assessments_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$assessments_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fassessmentsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fassessmentsdelete = currentForm = new ew.Form("fassessmentsdelete", "delete");
	loadjs.done("fassessmentsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $assessments_delete->showPageHeader(); ?>
<?php
$assessments_delete->showMessage();
?>
<form name="fassessmentsdelete" id="fassessmentsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="assessments">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($assessments_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($assessments_delete->id->Visible) { // id ?>
		<th class="<?php echo $assessments_delete->id->headerCellClass() ?>"><span id="elh_assessments_id" class="assessments_id"><?php echo $assessments_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->user_id->Visible) { // user_id ?>
		<th class="<?php echo $assessments_delete->user_id->headerCellClass() ?>"><span id="elh_assessments_user_id" class="assessments_user_id"><?php echo $assessments_delete->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->customer_id->Visible) { // customer_id ?>
		<th class="<?php echo $assessments_delete->customer_id->headerCellClass() ?>"><span id="elh_assessments_customer_id" class="assessments_customer_id"><?php echo $assessments_delete->customer_id->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->customer_first_name->Visible) { // customer_first_name ?>
		<th class="<?php echo $assessments_delete->customer_first_name->headerCellClass() ?>"><span id="elh_assessments_customer_first_name" class="assessments_customer_first_name"><?php echo $assessments_delete->customer_first_name->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->customer_age->Visible) { // customer_age ?>
		<th class="<?php echo $assessments_delete->customer_age->headerCellClass() ?>"><span id="elh_assessments_customer_age" class="assessments_customer_age"><?php echo $assessments_delete->customer_age->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->sex->Visible) { // sex ?>
		<th class="<?php echo $assessments_delete->sex->headerCellClass() ?>"><span id="elh_assessments_sex" class="assessments_sex"><?php echo $assessments_delete->sex->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->address->Visible) { // address ?>
		<th class="<?php echo $assessments_delete->address->headerCellClass() ?>"><span id="elh_assessments_address" class="assessments_address"><?php echo $assessments_delete->address->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->total_score->Visible) { // total_score ?>
		<th class="<?php echo $assessments_delete->total_score->headerCellClass() ?>"><span id="elh_assessments_total_score" class="assessments_total_score"><?php echo $assessments_delete->total_score->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->status->Visible) { // status ?>
		<th class="<?php echo $assessments_delete->status->headerCellClass() ?>"><span id="elh_assessments_status" class="assessments_status"><?php echo $assessments_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->loan_purpose->Visible) { // loan_purpose ?>
		<th class="<?php echo $assessments_delete->loan_purpose->headerCellClass() ?>"><span id="elh_assessments_loan_purpose" class="assessments_loan_purpose"><?php echo $assessments_delete->loan_purpose->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->loan_section->Visible) { // loan_section ?>
		<th class="<?php echo $assessments_delete->loan_section->headerCellClass() ?>"><span id="elh_assessments_loan_section" class="assessments_loan_section"><?php echo $assessments_delete->loan_section->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->lat->Visible) { // lat ?>
		<th class="<?php echo $assessments_delete->lat->headerCellClass() ?>"><span id="elh_assessments_lat" class="assessments_lat"><?php echo $assessments_delete->lat->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->lon->Visible) { // lon ?>
		<th class="<?php echo $assessments_delete->lon->headerCellClass() ?>"><span id="elh_assessments_lon" class="assessments_lon"><?php echo $assessments_delete->lon->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->created_at->Visible) { // created_at ?>
		<th class="<?php echo $assessments_delete->created_at->headerCellClass() ?>"><span id="elh_assessments_created_at" class="assessments_created_at"><?php echo $assessments_delete->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($assessments_delete->updated_at->Visible) { // updated_at ?>
		<th class="<?php echo $assessments_delete->updated_at->headerCellClass() ?>"><span id="elh_assessments_updated_at" class="assessments_updated_at"><?php echo $assessments_delete->updated_at->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$assessments_delete->RecordCount = 0;
$i = 0;
while (!$assessments_delete->Recordset->EOF) {
	$assessments_delete->RecordCount++;
	$assessments_delete->RowCount++;

	// Set row properties
	$assessments->resetAttributes();
	$assessments->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$assessments_delete->loadRowValues($assessments_delete->Recordset);

	// Render row
	$assessments_delete->renderRow();
?>
	<tr <?php echo $assessments->rowAttributes() ?>>
<?php if ($assessments_delete->id->Visible) { // id ?>
		<td <?php echo $assessments_delete->id->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_id" class="assessments_id">
<span<?php echo $assessments_delete->id->viewAttributes() ?>><?php echo $assessments_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->user_id->Visible) { // user_id ?>
		<td <?php echo $assessments_delete->user_id->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_user_id" class="assessments_user_id">
<span<?php echo $assessments_delete->user_id->viewAttributes() ?>><?php echo $assessments_delete->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->customer_id->Visible) { // customer_id ?>
		<td <?php echo $assessments_delete->customer_id->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_customer_id" class="assessments_customer_id">
<span<?php echo $assessments_delete->customer_id->viewAttributes() ?>><?php echo $assessments_delete->customer_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->customer_first_name->Visible) { // customer_first_name ?>
		<td <?php echo $assessments_delete->customer_first_name->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_customer_first_name" class="assessments_customer_first_name">
<span<?php echo $assessments_delete->customer_first_name->viewAttributes() ?>><?php echo $assessments_delete->customer_first_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->customer_age->Visible) { // customer_age ?>
		<td <?php echo $assessments_delete->customer_age->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_customer_age" class="assessments_customer_age">
<span<?php echo $assessments_delete->customer_age->viewAttributes() ?>><?php echo $assessments_delete->customer_age->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->sex->Visible) { // sex ?>
		<td <?php echo $assessments_delete->sex->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_sex" class="assessments_sex">
<span<?php echo $assessments_delete->sex->viewAttributes() ?>><?php echo $assessments_delete->sex->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->address->Visible) { // address ?>
		<td <?php echo $assessments_delete->address->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_address" class="assessments_address">
<span<?php echo $assessments_delete->address->viewAttributes() ?>><?php echo $assessments_delete->address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->total_score->Visible) { // total_score ?>
		<td <?php echo $assessments_delete->total_score->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_total_score" class="assessments_total_score">
<span<?php echo $assessments_delete->total_score->viewAttributes() ?>><?php echo $assessments_delete->total_score->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->status->Visible) { // status ?>
		<td <?php echo $assessments_delete->status->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_status" class="assessments_status">
<span<?php echo $assessments_delete->status->viewAttributes() ?>><?php echo $assessments_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->loan_purpose->Visible) { // loan_purpose ?>
		<td <?php echo $assessments_delete->loan_purpose->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_loan_purpose" class="assessments_loan_purpose">
<span<?php echo $assessments_delete->loan_purpose->viewAttributes() ?>><?php echo $assessments_delete->loan_purpose->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->loan_section->Visible) { // loan_section ?>
		<td <?php echo $assessments_delete->loan_section->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_loan_section" class="assessments_loan_section">
<span<?php echo $assessments_delete->loan_section->viewAttributes() ?>><?php echo $assessments_delete->loan_section->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->lat->Visible) { // lat ?>
		<td <?php echo $assessments_delete->lat->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_lat" class="assessments_lat">
<span<?php echo $assessments_delete->lat->viewAttributes() ?>><?php echo $assessments_delete->lat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->lon->Visible) { // lon ?>
		<td <?php echo $assessments_delete->lon->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_lon" class="assessments_lon">
<span<?php echo $assessments_delete->lon->viewAttributes() ?>><?php echo $assessments_delete->lon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->created_at->Visible) { // created_at ?>
		<td <?php echo $assessments_delete->created_at->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_created_at" class="assessments_created_at">
<span<?php echo $assessments_delete->created_at->viewAttributes() ?>><?php echo $assessments_delete->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($assessments_delete->updated_at->Visible) { // updated_at ?>
		<td <?php echo $assessments_delete->updated_at->cellAttributes() ?>>
<span id="el<?php echo $assessments_delete->RowCount ?>_assessments_updated_at" class="assessments_updated_at">
<span<?php echo $assessments_delete->updated_at->viewAttributes() ?>><?php echo $assessments_delete->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$assessments_delete->Recordset->moveNext();
}
$assessments_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $assessments_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$assessments_delete->showPageFooter();
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
$assessments_delete->terminate();
?>
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
$assessments_view = new assessments_view();

// Run the page
$assessments_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$assessments_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$assessments_view->isExport()) { ?>
<script>
var fassessmentsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fassessmentsview = currentForm = new ew.Form("fassessmentsview", "view");
	loadjs.done("fassessmentsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$assessments_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $assessments_view->ExportOptions->render("body") ?>
<?php $assessments_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $assessments_view->showPageHeader(); ?>
<?php
$assessments_view->showMessage();
?>
<form name="fassessmentsview" id="fassessmentsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="assessments">
<input type="hidden" name="modal" value="<?php echo (int)$assessments_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($assessments_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_id"><?php echo $assessments_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $assessments_view->id->cellAttributes() ?>>
<span id="el_assessments_id">
<span<?php echo $assessments_view->id->viewAttributes() ?>><?php echo $assessments_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->user_id->Visible) { // user_id ?>
	<tr id="r_user_id">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_user_id"><?php echo $assessments_view->user_id->caption() ?></span></td>
		<td data-name="user_id" <?php echo $assessments_view->user_id->cellAttributes() ?>>
<span id="el_assessments_user_id">
<span<?php echo $assessments_view->user_id->viewAttributes() ?>><?php echo $assessments_view->user_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->customer_id->Visible) { // customer_id ?>
	<tr id="r_customer_id">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_customer_id"><?php echo $assessments_view->customer_id->caption() ?></span></td>
		<td data-name="customer_id" <?php echo $assessments_view->customer_id->cellAttributes() ?>>
<span id="el_assessments_customer_id">
<span<?php echo $assessments_view->customer_id->viewAttributes() ?>><?php echo $assessments_view->customer_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->customer_first_name->Visible) { // customer_first_name ?>
	<tr id="r_customer_first_name">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_customer_first_name"><?php echo $assessments_view->customer_first_name->caption() ?></span></td>
		<td data-name="customer_first_name" <?php echo $assessments_view->customer_first_name->cellAttributes() ?>>
<span id="el_assessments_customer_first_name">
<span<?php echo $assessments_view->customer_first_name->viewAttributes() ?>><?php echo $assessments_view->customer_first_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->customer_age->Visible) { // customer_age ?>
	<tr id="r_customer_age">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_customer_age"><?php echo $assessments_view->customer_age->caption() ?></span></td>
		<td data-name="customer_age" <?php echo $assessments_view->customer_age->cellAttributes() ?>>
<span id="el_assessments_customer_age">
<span<?php echo $assessments_view->customer_age->viewAttributes() ?>><?php echo $assessments_view->customer_age->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->sex->Visible) { // sex ?>
	<tr id="r_sex">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_sex"><?php echo $assessments_view->sex->caption() ?></span></td>
		<td data-name="sex" <?php echo $assessments_view->sex->cellAttributes() ?>>
<span id="el_assessments_sex">
<span<?php echo $assessments_view->sex->viewAttributes() ?>><?php echo $assessments_view->sex->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->address->Visible) { // address ?>
	<tr id="r_address">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_address"><?php echo $assessments_view->address->caption() ?></span></td>
		<td data-name="address" <?php echo $assessments_view->address->cellAttributes() ?>>
<span id="el_assessments_address">
<span<?php echo $assessments_view->address->viewAttributes() ?>><?php echo $assessments_view->address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->total_score->Visible) { // total_score ?>
	<tr id="r_total_score">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_total_score"><?php echo $assessments_view->total_score->caption() ?></span></td>
		<td data-name="total_score" <?php echo $assessments_view->total_score->cellAttributes() ?>>
<span id="el_assessments_total_score">
<span<?php echo $assessments_view->total_score->viewAttributes() ?>><?php echo $assessments_view->total_score->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_status"><?php echo $assessments_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $assessments_view->status->cellAttributes() ?>>
<span id="el_assessments_status">
<span<?php echo $assessments_view->status->viewAttributes() ?>><?php echo $assessments_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->loan_purpose->Visible) { // loan_purpose ?>
	<tr id="r_loan_purpose">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_loan_purpose"><?php echo $assessments_view->loan_purpose->caption() ?></span></td>
		<td data-name="loan_purpose" <?php echo $assessments_view->loan_purpose->cellAttributes() ?>>
<span id="el_assessments_loan_purpose">
<span<?php echo $assessments_view->loan_purpose->viewAttributes() ?>><?php echo $assessments_view->loan_purpose->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->loan_section->Visible) { // loan_section ?>
	<tr id="r_loan_section">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_loan_section"><?php echo $assessments_view->loan_section->caption() ?></span></td>
		<td data-name="loan_section" <?php echo $assessments_view->loan_section->cellAttributes() ?>>
<span id="el_assessments_loan_section">
<span<?php echo $assessments_view->loan_section->viewAttributes() ?>><?php echo $assessments_view->loan_section->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->lat->Visible) { // lat ?>
	<tr id="r_lat">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_lat"><?php echo $assessments_view->lat->caption() ?></span></td>
		<td data-name="lat" <?php echo $assessments_view->lat->cellAttributes() ?>>
<span id="el_assessments_lat">
<span<?php echo $assessments_view->lat->viewAttributes() ?>><?php echo $assessments_view->lat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->lon->Visible) { // lon ?>
	<tr id="r_lon">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_lon"><?php echo $assessments_view->lon->caption() ?></span></td>
		<td data-name="lon" <?php echo $assessments_view->lon->cellAttributes() ?>>
<span id="el_assessments_lon">
<span<?php echo $assessments_view->lon->viewAttributes() ?>><?php echo $assessments_view->lon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_created_at"><?php echo $assessments_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $assessments_view->created_at->cellAttributes() ?>>
<span id="el_assessments_created_at">
<span<?php echo $assessments_view->created_at->viewAttributes() ?>><?php echo $assessments_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($assessments_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $assessments_view->TableLeftColumnClass ?>"><span id="elh_assessments_updated_at"><?php echo $assessments_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $assessments_view->updated_at->cellAttributes() ?>>
<span id="el_assessments_updated_at">
<span<?php echo $assessments_view->updated_at->viewAttributes() ?>><?php echo $assessments_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("results", explode(",", $assessments->getCurrentDetailTable())) && $results->DetailView) {
?>
<?php if ($assessments->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("results", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $assessments_view->results_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "resultsgrid.php" ?>
<?php } ?>
<?php
	if (in_array("answers", explode(",", $assessments->getCurrentDetailTable())) && $answers->DetailView) {
?>
<?php if ($assessments->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("answers", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $assessments_view->answers_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "answersgrid.php" ?>
<?php } ?>
</form>
<?php
$assessments_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$assessments_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$assessments_view->terminate();
?>
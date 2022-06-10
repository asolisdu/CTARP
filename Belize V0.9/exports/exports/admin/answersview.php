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
$answers_view = new answers_view();

// Run the page
$answers_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$answers_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$answers_view->isExport()) { ?>
<script>
var fanswersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fanswersview = currentForm = new ew.Form("fanswersview", "view");
	loadjs.done("fanswersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$answers_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $answers_view->ExportOptions->render("body") ?>
<?php $answers_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $answers_view->showPageHeader(); ?>
<?php
$answers_view->showMessage();
?>
<form name="fanswersview" id="fanswersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="answers">
<input type="hidden" name="modal" value="<?php echo (int)$answers_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($answers_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $answers_view->TableLeftColumnClass ?>"><span id="elh_answers_id"><?php echo $answers_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $answers_view->id->cellAttributes() ?>>
<span id="el_answers_id">
<span<?php echo $answers_view->id->viewAttributes() ?>><?php echo $answers_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answers_view->question_id->Visible) { // question_id ?>
	<tr id="r_question_id">
		<td class="<?php echo $answers_view->TableLeftColumnClass ?>"><span id="elh_answers_question_id"><?php echo $answers_view->question_id->caption() ?></span></td>
		<td data-name="question_id" <?php echo $answers_view->question_id->cellAttributes() ?>>
<span id="el_answers_question_id">
<span<?php echo $answers_view->question_id->viewAttributes() ?>><?php echo $answers_view->question_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answers_view->assessment_id->Visible) { // assessment_id ?>
	<tr id="r_assessment_id">
		<td class="<?php echo $answers_view->TableLeftColumnClass ?>"><span id="elh_answers_assessment_id"><?php echo $answers_view->assessment_id->caption() ?></span></td>
		<td data-name="assessment_id" <?php echo $answers_view->assessment_id->cellAttributes() ?>>
<span id="el_answers_assessment_id">
<span<?php echo $answers_view->assessment_id->viewAttributes() ?>><?php echo $answers_view->assessment_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answers_view->section_id->Visible) { // section_id ?>
	<tr id="r_section_id">
		<td class="<?php echo $answers_view->TableLeftColumnClass ?>"><span id="elh_answers_section_id"><?php echo $answers_view->section_id->caption() ?></span></td>
		<td data-name="section_id" <?php echo $answers_view->section_id->cellAttributes() ?>>
<span id="el_answers_section_id">
<span<?php echo $answers_view->section_id->viewAttributes() ?>><?php echo $answers_view->section_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answers_view->_response->Visible) { // response ?>
	<tr id="r__response">
		<td class="<?php echo $answers_view->TableLeftColumnClass ?>"><span id="elh_answers__response"><?php echo $answers_view->_response->caption() ?></span></td>
		<td data-name="_response" <?php echo $answers_view->_response->cellAttributes() ?>>
<span id="el_answers__response">
<span<?php echo $answers_view->_response->viewAttributes() ?>><?php echo $answers_view->_response->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answers_view->score->Visible) { // score ?>
	<tr id="r_score">
		<td class="<?php echo $answers_view->TableLeftColumnClass ?>"><span id="elh_answers_score"><?php echo $answers_view->score->caption() ?></span></td>
		<td data-name="score" <?php echo $answers_view->score->cellAttributes() ?>>
<span id="el_answers_score">
<span<?php echo $answers_view->score->viewAttributes() ?>><?php echo $answers_view->score->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answers_view->recommendations->Visible) { // recommendations ?>
	<tr id="r_recommendations">
		<td class="<?php echo $answers_view->TableLeftColumnClass ?>"><span id="elh_answers_recommendations"><?php echo $answers_view->recommendations->caption() ?></span></td>
		<td data-name="recommendations" <?php echo $answers_view->recommendations->cellAttributes() ?>>
<span id="el_answers_recommendations">
<span<?php echo $answers_view->recommendations->viewAttributes() ?>><?php echo $answers_view->recommendations->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answers_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $answers_view->TableLeftColumnClass ?>"><span id="elh_answers_created_at"><?php echo $answers_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $answers_view->created_at->cellAttributes() ?>>
<span id="el_answers_created_at">
<span<?php echo $answers_view->created_at->viewAttributes() ?>><?php echo $answers_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answers_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $answers_view->TableLeftColumnClass ?>"><span id="elh_answers_updated_at"><?php echo $answers_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $answers_view->updated_at->cellAttributes() ?>>
<span id="el_answers_updated_at">
<span<?php echo $answers_view->updated_at->viewAttributes() ?>><?php echo $answers_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$answers_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$answers_view->isExport()) { ?>
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
$answers_view->terminate();
?>
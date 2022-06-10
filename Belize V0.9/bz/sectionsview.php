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
$sections_view = new sections_view();

// Run the page
$sections_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sections_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sections_view->isExport()) { ?>
<script>
var fsectionsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsectionsview = currentForm = new ew.Form("fsectionsview", "view");
	loadjs.done("fsectionsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sections_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $sections_view->ExportOptions->render("body") ?>
<?php $sections_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $sections_view->showPageHeader(); ?>
<?php
$sections_view->showMessage();
?>
<form name="fsectionsview" id="fsectionsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sections">
<input type="hidden" name="modal" value="<?php echo (int)$sections_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($sections_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $sections_view->TableLeftColumnClass ?>"><span id="elh_sections_id"><?php echo $sections_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $sections_view->id->cellAttributes() ?>>
<span id="el_sections_id">
<span<?php echo $sections_view->id->viewAttributes() ?>><?php echo $sections_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sections_view->title->Visible) { // title ?>
	<tr id="r_title">
		<td class="<?php echo $sections_view->TableLeftColumnClass ?>"><span id="elh_sections_title"><?php echo $sections_view->title->caption() ?></span></td>
		<td data-name="title" <?php echo $sections_view->title->cellAttributes() ?>>
<span id="el_sections_title">
<span<?php echo $sections_view->title->viewAttributes() ?>><?php echo $sections_view->title->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sections_view->desc->Visible) { // desc ?>
	<tr id="r_desc">
		<td class="<?php echo $sections_view->TableLeftColumnClass ?>"><span id="elh_sections_desc"><?php echo $sections_view->desc->caption() ?></span></td>
		<td data-name="desc" <?php echo $sections_view->desc->cellAttributes() ?>>
<span id="el_sections_desc">
<span<?php echo $sections_view->desc->viewAttributes() ?>><?php echo $sections_view->desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sections_view->order->Visible) { // order ?>
	<tr id="r_order">
		<td class="<?php echo $sections_view->TableLeftColumnClass ?>"><span id="elh_sections_order"><?php echo $sections_view->order->caption() ?></span></td>
		<td data-name="order" <?php echo $sections_view->order->cellAttributes() ?>>
<span id="el_sections_order">
<span<?php echo $sections_view->order->viewAttributes() ?>><?php echo $sections_view->order->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sections_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $sections_view->TableLeftColumnClass ?>"><span id="elh_sections_created_at"><?php echo $sections_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $sections_view->created_at->cellAttributes() ?>>
<span id="el_sections_created_at">
<span<?php echo $sections_view->created_at->viewAttributes() ?>><?php echo $sections_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sections_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $sections_view->TableLeftColumnClass ?>"><span id="elh_sections_updated_at"><?php echo $sections_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $sections_view->updated_at->cellAttributes() ?>>
<span id="el_sections_updated_at">
<span<?php echo $sections_view->updated_at->viewAttributes() ?>><?php echo $sections_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("questions", explode(",", $sections->getCurrentDetailTable())) && $questions->DetailView) {
?>
<?php if ($sections->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("questions", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $sections_view->questions_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "questionsgrid.php" ?>
<?php } ?>
</form>
<?php
$sections_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sections_view->isExport()) { ?>
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
$sections_view->terminate();
?>
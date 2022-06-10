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
$_user_levels_view = new _user_levels_view();

// Run the page
$_user_levels_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_user_levels_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_user_levels_view->isExport()) { ?>
<script>
var f_user_levelsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	f_user_levelsview = currentForm = new ew.Form("f_user_levelsview", "view");
	loadjs.done("f_user_levelsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$_user_levels_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $_user_levels_view->ExportOptions->render("body") ?>
<?php $_user_levels_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $_user_levels_view->showPageHeader(); ?>
<?php
$_user_levels_view->showMessage();
?>
<form name="f_user_levelsview" id="f_user_levelsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_user_levels">
<input type="hidden" name="modal" value="<?php echo (int)$_user_levels_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($_user_levels_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $_user_levels_view->TableLeftColumnClass ?>"><span id="elh__user_levels_id"><?php echo $_user_levels_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $_user_levels_view->id->cellAttributes() ?>>
<span id="el__user_levels_id">
<span<?php echo $_user_levels_view->id->viewAttributes() ?>><?php echo $_user_levels_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_user_levels_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $_user_levels_view->TableLeftColumnClass ?>"><span id="elh__user_levels_name"><?php echo $_user_levels_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $_user_levels_view->name->cellAttributes() ?>>
<span id="el__user_levels_name">
<span<?php echo $_user_levels_view->name->viewAttributes() ?>><?php echo $_user_levels_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_user_levels_view->desc->Visible) { // desc ?>
	<tr id="r_desc">
		<td class="<?php echo $_user_levels_view->TableLeftColumnClass ?>"><span id="elh__user_levels_desc"><?php echo $_user_levels_view->desc->caption() ?></span></td>
		<td data-name="desc" <?php echo $_user_levels_view->desc->cellAttributes() ?>>
<span id="el__user_levels_desc">
<span<?php echo $_user_levels_view->desc->viewAttributes() ?>><?php echo $_user_levels_view->desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_user_levels_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $_user_levels_view->TableLeftColumnClass ?>"><span id="elh__user_levels_created_at"><?php echo $_user_levels_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $_user_levels_view->created_at->cellAttributes() ?>>
<span id="el__user_levels_created_at">
<span<?php echo $_user_levels_view->created_at->viewAttributes() ?>><?php echo $_user_levels_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_user_levels_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $_user_levels_view->TableLeftColumnClass ?>"><span id="elh__user_levels_updated_at"><?php echo $_user_levels_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $_user_levels_view->updated_at->cellAttributes() ?>>
<span id="el__user_levels_updated_at">
<span<?php echo $_user_levels_view->updated_at->viewAttributes() ?>><?php echo $_user_levels_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$_user_levels_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_user_levels_view->isExport()) { ?>
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
$_user_levels_view->terminate();
?>
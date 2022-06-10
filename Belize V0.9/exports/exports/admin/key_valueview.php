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
$key_value_view = new key_value_view();

// Run the page
$key_value_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$key_value_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$key_value_view->isExport()) { ?>
<script>
var fkey_valueview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkey_valueview = currentForm = new ew.Form("fkey_valueview", "view");
	loadjs.done("fkey_valueview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$key_value_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $key_value_view->ExportOptions->render("body") ?>
<?php $key_value_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $key_value_view->showPageHeader(); ?>
<?php
$key_value_view->showMessage();
?>
<form name="fkey_valueview" id="fkey_valueview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="key_value">
<input type="hidden" name="modal" value="<?php echo (int)$key_value_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($key_value_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $key_value_view->TableLeftColumnClass ?>"><span id="elh_key_value_id"><?php echo $key_value_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $key_value_view->id->cellAttributes() ?>>
<span id="el_key_value_id">
<span<?php echo $key_value_view->id->viewAttributes() ?>><?php echo $key_value_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($key_value_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $key_value_view->TableLeftColumnClass ?>"><span id="elh_key_value_name"><?php echo $key_value_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $key_value_view->name->cellAttributes() ?>>
<span id="el_key_value_name">
<span<?php echo $key_value_view->name->viewAttributes() ?>><?php echo $key_value_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($key_value_view->value->Visible) { // value ?>
	<tr id="r_value">
		<td class="<?php echo $key_value_view->TableLeftColumnClass ?>"><span id="elh_key_value_value"><?php echo $key_value_view->value->caption() ?></span></td>
		<td data-name="value" <?php echo $key_value_view->value->cellAttributes() ?>>
<span id="el_key_value_value">
<span<?php echo $key_value_view->value->viewAttributes() ?>><?php echo $key_value_view->value->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$key_value_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$key_value_view->isExport()) { ?>
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
$key_value_view->terminate();
?>
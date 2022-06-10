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
$users_view = new users_view();

// Run the page
$users_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$users_view->isExport()) { ?>
<script>
var fusersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fusersview = currentForm = new ew.Form("fusersview", "view");
	loadjs.done("fusersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$users_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $users_view->ExportOptions->render("body") ?>
<?php $users_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $users_view->showPageHeader(); ?>
<?php
$users_view->showMessage();
?>
<form name="fusersview" id="fusersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="modal" value="<?php echo (int)$users_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($users_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_id"><?php echo $users_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $users_view->id->cellAttributes() ?>>
<span id="el_users_id">
<span<?php echo $users_view->id->viewAttributes() ?>><?php echo $users_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->first_names->Visible) { // first_names ?>
	<tr id="r_first_names">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_first_names"><?php echo $users_view->first_names->caption() ?></span></td>
		<td data-name="first_names" <?php echo $users_view->first_names->cellAttributes() ?>>
<span id="el_users_first_names">
<span<?php echo $users_view->first_names->viewAttributes() ?>><?php echo $users_view->first_names->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->last_names->Visible) { // last_names ?>
	<tr id="r_last_names">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_last_names"><?php echo $users_view->last_names->caption() ?></span></td>
		<td data-name="last_names" <?php echo $users_view->last_names->cellAttributes() ?>>
<span id="el_users_last_names">
<span<?php echo $users_view->last_names->viewAttributes() ?>><?php echo $users_view->last_names->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users__email"><?php echo $users_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $users_view->_email->cellAttributes() ?>>
<span id="el_users__email">
<span<?php echo $users_view->_email->viewAttributes() ?>><?php echo $users_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->password->Visible) { // password ?>
	<tr id="r_password">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_password"><?php echo $users_view->password->caption() ?></span></td>
		<td data-name="password" <?php echo $users_view->password->cellAttributes() ?>>
<span id="el_users_password">
<span<?php echo $users_view->password->viewAttributes() ?>><?php echo $users_view->password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->user_level->Visible) { // user_level ?>
	<tr id="r_user_level">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_user_level"><?php echo $users_view->user_level->caption() ?></span></td>
		<td data-name="user_level" <?php echo $users_view->user_level->cellAttributes() ?>>
<span id="el_users_user_level">
<span<?php echo $users_view->user_level->viewAttributes() ?>><?php echo $users_view->user_level->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_created_at"><?php echo $users_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $users_view->created_at->cellAttributes() ?>>
<span id="el_users_created_at">
<span<?php echo $users_view->created_at->viewAttributes() ?>><?php echo $users_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_updated_at"><?php echo $users_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $users_view->updated_at->cellAttributes() ?>>
<span id="el_users_updated_at">
<span<?php echo $users_view->updated_at->viewAttributes() ?>><?php echo $users_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("assessments", explode(",", $users->getCurrentDetailTable())) && $assessments->DetailView) {
?>
<?php if ($users->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("assessments", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "assessmentsgrid.php" ?>
<?php } ?>
</form>
<?php
$users_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$users_view->isExport()) { ?>
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
$users_view->terminate();
?>
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
$users_add = new users_add();

// Run the page
$users_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fusersadd = currentForm = new ew.Form("fusersadd", "add");

	// Validate form
	fusersadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($users_add->first_names->Required) { ?>
				elm = this.getElements("x" + infix + "_first_names");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->first_names->caption(), $users_add->first_names->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->last_names->Required) { ?>
				elm = this.getElements("x" + infix + "_last_names");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->last_names->caption(), $users_add->last_names->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->_email->caption(), $users_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->password->caption(), $users_add->password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->user_level->Required) { ?>
				elm = this.getElements("x" + infix + "_user_level");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->user_level->caption(), $users_add->user_level->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fusersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fusersadd.lists["x_user_level"] = <?php echo $users_add->user_level->Lookup->toClientList($users_add) ?>;
	fusersadd.lists["x_user_level"].options = <?php echo JsonEncode($users_add->user_level->options(FALSE, TRUE)) ?>;
	loadjs.done("fusersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_add->showPageHeader(); ?>
<?php
$users_add->showMessage();
?>
<form name="fusersadd" id="fusersadd" class="<?php echo $users_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$users_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($users_add->first_names->Visible) { // first_names ?>
	<div id="r_first_names" class="form-group row">
		<label id="elh_users_first_names" for="x_first_names" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->first_names->caption() ?><?php echo $users_add->first_names->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->first_names->cellAttributes() ?>>
<span id="el_users_first_names">
<input type="text" data-table="users" data-field="x_first_names" name="x_first_names" id="x_first_names" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($users_add->first_names->getPlaceHolder()) ?>" value="<?php echo $users_add->first_names->EditValue ?>"<?php echo $users_add->first_names->editAttributes() ?>>
</span>
<?php echo $users_add->first_names->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->last_names->Visible) { // last_names ?>
	<div id="r_last_names" class="form-group row">
		<label id="elh_users_last_names" for="x_last_names" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->last_names->caption() ?><?php echo $users_add->last_names->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->last_names->cellAttributes() ?>>
<span id="el_users_last_names">
<input type="text" data-table="users" data-field="x_last_names" name="x_last_names" id="x_last_names" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($users_add->last_names->getPlaceHolder()) ?>" value="<?php echo $users_add->last_names->EditValue ?>"<?php echo $users_add->last_names->editAttributes() ?>>
</span>
<?php echo $users_add->last_names->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_users__email" for="x__email" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->_email->caption() ?><?php echo $users_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->_email->cellAttributes() ?>>
<span id="el_users__email">
<input type="text" data-table="users" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($users_add->_email->getPlaceHolder()) ?>" value="<?php echo $users_add->_email->EditValue ?>"<?php echo $users_add->_email->editAttributes() ?>>
</span>
<?php echo $users_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_users_password" for="x_password" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->password->caption() ?><?php echo $users_add->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->password->cellAttributes() ?>>
<span id="el_users_password">
<div class="input-group"><input type="password" name="x_password" id="x_password" autocomplete="new-password" data-field="x_password" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($users_add->password->getPlaceHolder()) ?>"<?php echo $users_add->password->editAttributes() ?>><div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div></div>
</span>
<?php echo $users_add->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->user_level->Visible) { // user_level ?>
	<div id="r_user_level" class="form-group row">
		<label id="elh_users_user_level" for="x_user_level" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->user_level->caption() ?><?php echo $users_add->user_level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->user_level->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_users_user_level">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($users_add->user_level->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_users_user_level">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="users" data-field="x_user_level" data-value-separator="<?php echo $users_add->user_level->displayValueSeparatorAttribute() ?>" id="x_user_level" name="x_user_level"<?php echo $users_add->user_level->editAttributes() ?>>
			<?php echo $users_add->user_level->selectOptionListHtml("x_user_level") ?>
		</select>
</div>
</span>
<?php } ?>
<?php echo $users_add->user_level->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("assessments", explode(",", $users->getCurrentDetailTable())) && $assessments->DetailAdd) {
?>
<?php if ($users->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("assessments", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "assessmentsgrid.php" ?>
<?php } ?>
<?php if (!$users_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$users_add->showPageFooter();
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
$users_add->terminate();
?>
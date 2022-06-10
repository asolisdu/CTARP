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
$register = new register();

// Run the page
$register->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$register->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fregister, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "register";
	fregister = currentForm = new ew.Form("fregister", "register");

	// Validate form
	fregister.validate = function() {
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
			<?php if ($register->first_names->Required) { ?>
				elm = this.getElements("x" + infix + "_first_names");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->first_names->caption(), $register->first_names->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->last_names->Required) { ?>
				elm = this.getElements("x" + infix + "_last_names");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->last_names->caption(), $register->last_names->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, ew.language.phrase("EnterUserName"));
			<?php } ?>
			<?php if ($register->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, ew.language.phrase("EnterPassword"));
			<?php } ?>
				if (fobj.c_password.value != fobj.x_password.value)
					return this.onError(fobj.c_password, ew.language.phrase("MismatchPassword"));
			<?php if ($register->user_level->Required) { ?>
				elm = this.getElements("x" + infix + "_user_level");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->user_level->caption(), $register->user_level->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fregister.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fregister.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fregister.lists["x_user_level"] = <?php echo $register->user_level->Lookup->toClientList($register) ?>;
	fregister.lists["x_user_level"].options = <?php echo JsonEncode($register->user_level->options(FALSE, TRUE)) ?>;
	loadjs.done("fregister");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $register->showPageHeader(); ?>
<?php
$register->showMessage();
?>
<form name="fregister" id="fregister" class="<?php echo $register->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$register->IsModal ?>">
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<div class="ew-register-div"><!-- page* -->
<?php if ($register->first_names->Visible) { // first_names ?>
	<div id="r_first_names" class="form-group row">
		<label id="elh_users_first_names" for="x_first_names" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->first_names->caption() ?><?php echo $register->first_names->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->first_names->cellAttributes() ?>>
<span id="el_users_first_names">
<input type="text" data-table="users" data-field="x_first_names" name="x_first_names" id="x_first_names" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($register->first_names->getPlaceHolder()) ?>" value="<?php echo $register->first_names->EditValue ?>"<?php echo $register->first_names->editAttributes() ?>>
</span>
<?php echo $register->first_names->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->last_names->Visible) { // last_names ?>
	<div id="r_last_names" class="form-group row">
		<label id="elh_users_last_names" for="x_last_names" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->last_names->caption() ?><?php echo $register->last_names->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->last_names->cellAttributes() ?>>
<span id="el_users_last_names">
<input type="text" data-table="users" data-field="x_last_names" name="x_last_names" id="x_last_names" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($register->last_names->getPlaceHolder()) ?>" value="<?php echo $register->last_names->EditValue ?>"<?php echo $register->last_names->editAttributes() ?>>
</span>
<?php echo $register->last_names->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_users__email" for="x__email" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->_email->caption() ?><?php echo $register->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->_email->cellAttributes() ?>>
<span id="el_users__email">
<input type="text" data-table="users" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($register->_email->getPlaceHolder()) ?>" value="<?php echo $register->_email->EditValue ?>"<?php echo $register->_email->editAttributes() ?>>
</span>
<?php echo $register->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_users_password" for="x_password" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->password->caption() ?><?php echo $register->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->password->cellAttributes() ?>>
<span id="el_users_password">
<div class="input-group"><input type="password" name="x_password" id="x_password" autocomplete="new-password" data-field="x_password" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($register->password->getPlaceHolder()) ?>"<?php echo $register->password->editAttributes() ?>><div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div></div>
</span>
<?php echo $register->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->password->Visible) { // password ?>
	<div id="r_c_password" class="form-group row">
		<label id="elh_c_users_password" for="c_password" class="<?php echo $register->LeftColumnClass ?>"><?php echo $Language->phrase("Confirm") ?> <?php echo $register->password->caption() ?><?php echo $register->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->password->cellAttributes() ?>>
<span id="el_c_users_password">
<div class="input-group"><input type="password" name="c_password" id="c_password" autocomplete="new-password" data-field="x_password" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($register->password->getPlaceHolder()) ?>"<?php echo $register->password->editAttributes() ?>><div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div></div>
</span>
</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$register->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $register->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("RegisterBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$register->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$register->terminate();
?>
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
$key_value_add = new key_value_add();

// Run the page
$key_value_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$key_value_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkey_valueadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fkey_valueadd = currentForm = new ew.Form("fkey_valueadd", "add");

	// Validate form
	fkey_valueadd.validate = function() {
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
			<?php if ($key_value_add->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $key_value_add->name->caption(), $key_value_add->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($key_value_add->value->Required) { ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $key_value_add->value->caption(), $key_value_add->value->RequiredErrorMessage)) ?>");
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
	fkey_valueadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkey_valueadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fkey_valueadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $key_value_add->showPageHeader(); ?>
<?php
$key_value_add->showMessage();
?>
<form name="fkey_valueadd" id="fkey_valueadd" class="<?php echo $key_value_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="key_value">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$key_value_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($key_value_add->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_key_value_name" for="x_name" class="<?php echo $key_value_add->LeftColumnClass ?>"><?php echo $key_value_add->name->caption() ?><?php echo $key_value_add->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $key_value_add->RightColumnClass ?>"><div <?php echo $key_value_add->name->cellAttributes() ?>>
<span id="el_key_value_name">
<input type="text" data-table="key_value" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($key_value_add->name->getPlaceHolder()) ?>" value="<?php echo $key_value_add->name->EditValue ?>"<?php echo $key_value_add->name->editAttributes() ?>>
</span>
<?php echo $key_value_add->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($key_value_add->value->Visible) { // value ?>
	<div id="r_value" class="form-group row">
		<label id="elh_key_value_value" for="x_value" class="<?php echo $key_value_add->LeftColumnClass ?>"><?php echo $key_value_add->value->caption() ?><?php echo $key_value_add->value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $key_value_add->RightColumnClass ?>"><div <?php echo $key_value_add->value->cellAttributes() ?>>
<span id="el_key_value_value">
<textarea data-table="key_value" data-field="x_value" name="x_value" id="x_value" cols="35" rows="4" placeholder="<?php echo HtmlEncode($key_value_add->value->getPlaceHolder()) ?>"<?php echo $key_value_add->value->editAttributes() ?>><?php echo $key_value_add->value->EditValue ?></textarea>
</span>
<?php echo $key_value_add->value->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$key_value_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $key_value_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $key_value_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$key_value_add->showPageFooter();
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
$key_value_add->terminate();
?>
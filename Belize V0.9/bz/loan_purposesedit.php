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
$loan_purposes_edit = new loan_purposes_edit();

// Run the page
$loan_purposes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$loan_purposes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var floan_purposesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	floan_purposesedit = currentForm = new ew.Form("floan_purposesedit", "edit");

	// Validate form
	floan_purposesedit.validate = function() {
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
			<?php if ($loan_purposes_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $loan_purposes_edit->name->caption(), $loan_purposes_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($loan_purposes_edit->desc->Required) { ?>
				elm = this.getElements("x" + infix + "_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $loan_purposes_edit->desc->caption(), $loan_purposes_edit->desc->RequiredErrorMessage)) ?>");
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
	floan_purposesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	floan_purposesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("floan_purposesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $loan_purposes_edit->showPageHeader(); ?>
<?php
$loan_purposes_edit->showMessage();
?>
<form name="floan_purposesedit" id="floan_purposesedit" class="<?php echo $loan_purposes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="loan_purposes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$loan_purposes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($loan_purposes_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_loan_purposes_name" for="x_name" class="<?php echo $loan_purposes_edit->LeftColumnClass ?>"><?php echo $loan_purposes_edit->name->caption() ?><?php echo $loan_purposes_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $loan_purposes_edit->RightColumnClass ?>"><div <?php echo $loan_purposes_edit->name->cellAttributes() ?>>
<span id="el_loan_purposes_name">
<input type="text" data-table="loan_purposes" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($loan_purposes_edit->name->getPlaceHolder()) ?>" value="<?php echo $loan_purposes_edit->name->EditValue ?>"<?php echo $loan_purposes_edit->name->editAttributes() ?>>
</span>
<?php echo $loan_purposes_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($loan_purposes_edit->desc->Visible) { // desc ?>
	<div id="r_desc" class="form-group row">
		<label id="elh_loan_purposes_desc" for="x_desc" class="<?php echo $loan_purposes_edit->LeftColumnClass ?>"><?php echo $loan_purposes_edit->desc->caption() ?><?php echo $loan_purposes_edit->desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $loan_purposes_edit->RightColumnClass ?>"><div <?php echo $loan_purposes_edit->desc->cellAttributes() ?>>
<span id="el_loan_purposes_desc">
<input type="text" data-table="loan_purposes" data-field="x_desc" name="x_desc" id="x_desc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($loan_purposes_edit->desc->getPlaceHolder()) ?>" value="<?php echo $loan_purposes_edit->desc->EditValue ?>"<?php echo $loan_purposes_edit->desc->editAttributes() ?>>
</span>
<?php echo $loan_purposes_edit->desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="loan_purposes" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($loan_purposes_edit->id->CurrentValue) ?>">
<?php
	if (in_array("assessments", explode(",", $loan_purposes->getCurrentDetailTable())) && $assessments->DetailEdit) {
?>
<?php if ($loan_purposes->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("assessments", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "assessmentsgrid.php" ?>
<?php } ?>
<?php if (!$loan_purposes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $loan_purposes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $loan_purposes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$loan_purposes_edit->showPageFooter();
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
$loan_purposes_edit->terminate();
?>
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
$loan_section_add = new loan_section_add();

// Run the page
$loan_section_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$loan_section_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var floan_sectionadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	floan_sectionadd = currentForm = new ew.Form("floan_sectionadd", "add");

	// Validate form
	floan_sectionadd.validate = function() {
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
			<?php if ($loan_section_add->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $loan_section_add->name->caption(), $loan_section_add->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($loan_section_add->desc->Required) { ?>
				elm = this.getElements("x" + infix + "_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $loan_section_add->desc->caption(), $loan_section_add->desc->RequiredErrorMessage)) ?>");
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
	floan_sectionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	floan_sectionadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("floan_sectionadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $loan_section_add->showPageHeader(); ?>
<?php
$loan_section_add->showMessage();
?>
<form name="floan_sectionadd" id="floan_sectionadd" class="<?php echo $loan_section_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="loan_section">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$loan_section_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($loan_section_add->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_loan_section_name" for="x_name" class="<?php echo $loan_section_add->LeftColumnClass ?>"><?php echo $loan_section_add->name->caption() ?><?php echo $loan_section_add->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $loan_section_add->RightColumnClass ?>"><div <?php echo $loan_section_add->name->cellAttributes() ?>>
<span id="el_loan_section_name">
<input type="text" data-table="loan_section" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($loan_section_add->name->getPlaceHolder()) ?>" value="<?php echo $loan_section_add->name->EditValue ?>"<?php echo $loan_section_add->name->editAttributes() ?>>
</span>
<?php echo $loan_section_add->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($loan_section_add->desc->Visible) { // desc ?>
	<div id="r_desc" class="form-group row">
		<label id="elh_loan_section_desc" for="x_desc" class="<?php echo $loan_section_add->LeftColumnClass ?>"><?php echo $loan_section_add->desc->caption() ?><?php echo $loan_section_add->desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $loan_section_add->RightColumnClass ?>"><div <?php echo $loan_section_add->desc->cellAttributes() ?>>
<span id="el_loan_section_desc">
<input type="text" data-table="loan_section" data-field="x_desc" name="x_desc" id="x_desc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($loan_section_add->desc->getPlaceHolder()) ?>" value="<?php echo $loan_section_add->desc->EditValue ?>"<?php echo $loan_section_add->desc->editAttributes() ?>>
</span>
<?php echo $loan_section_add->desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("assessments", explode(",", $loan_section->getCurrentDetailTable())) && $assessments->DetailAdd) {
?>
<?php if ($loan_section->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("assessments", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "assessmentsgrid.php" ?>
<?php } ?>
<?php if (!$loan_section_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $loan_section_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $loan_section_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$loan_section_add->showPageFooter();
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
$loan_section_add->terminate();
?>
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
$sections_edit = new sections_edit();

// Run the page
$sections_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sections_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsectionsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsectionsedit = currentForm = new ew.Form("fsectionsedit", "edit");

	// Validate form
	fsectionsedit.validate = function() {
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
			<?php if ($sections_edit->title->Required) { ?>
				elm = this.getElements("x" + infix + "_title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sections_edit->title->caption(), $sections_edit->title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sections_edit->desc->Required) { ?>
				elm = this.getElements("x" + infix + "_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sections_edit->desc->caption(), $sections_edit->desc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sections_edit->order->Required) { ?>
				elm = this.getElements("x" + infix + "_order");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sections_edit->order->caption(), $sections_edit->order->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_order");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($sections_edit->order->errorMessage()) ?>");
			<?php if ($sections_edit->weight->Required) { ?>
				elm = this.getElements("x" + infix + "_weight");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sections_edit->weight->caption(), $sections_edit->weight->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_weight");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($sections_edit->weight->errorMessage()) ?>");

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
	fsectionsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsectionsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsectionsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sections_edit->showPageHeader(); ?>
<?php
$sections_edit->showMessage();
?>
<form name="fsectionsedit" id="fsectionsedit" class="<?php echo $sections_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sections">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$sections_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($sections_edit->title->Visible) { // title ?>
	<div id="r_title" class="form-group row">
		<label id="elh_sections_title" for="x_title" class="<?php echo $sections_edit->LeftColumnClass ?>"><?php echo $sections_edit->title->caption() ?><?php echo $sections_edit->title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sections_edit->RightColumnClass ?>"><div <?php echo $sections_edit->title->cellAttributes() ?>>
<span id="el_sections_title">
<input type="text" data-table="sections" data-field="x_title" name="x_title" id="x_title" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($sections_edit->title->getPlaceHolder()) ?>" value="<?php echo $sections_edit->title->EditValue ?>"<?php echo $sections_edit->title->editAttributes() ?>>
</span>
<?php echo $sections_edit->title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sections_edit->desc->Visible) { // desc ?>
	<div id="r_desc" class="form-group row">
		<label id="elh_sections_desc" for="x_desc" class="<?php echo $sections_edit->LeftColumnClass ?>"><?php echo $sections_edit->desc->caption() ?><?php echo $sections_edit->desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sections_edit->RightColumnClass ?>"><div <?php echo $sections_edit->desc->cellAttributes() ?>>
<span id="el_sections_desc">
<input type="text" data-table="sections" data-field="x_desc" name="x_desc" id="x_desc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($sections_edit->desc->getPlaceHolder()) ?>" value="<?php echo $sections_edit->desc->EditValue ?>"<?php echo $sections_edit->desc->editAttributes() ?>>
</span>
<?php echo $sections_edit->desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sections_edit->order->Visible) { // order ?>
	<div id="r_order" class="form-group row">
		<label id="elh_sections_order" for="x_order" class="<?php echo $sections_edit->LeftColumnClass ?>"><?php echo $sections_edit->order->caption() ?><?php echo $sections_edit->order->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sections_edit->RightColumnClass ?>"><div <?php echo $sections_edit->order->cellAttributes() ?>>
<span id="el_sections_order">
<input type="text" data-table="sections" data-field="x_order" name="x_order" id="x_order" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($sections_edit->order->getPlaceHolder()) ?>" value="<?php echo $sections_edit->order->EditValue ?>"<?php echo $sections_edit->order->editAttributes() ?>>
</span>
<?php echo $sections_edit->order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sections_edit->weight->Visible) { // weight ?>
	<div id="r_weight" class="form-group row">
		<label id="elh_sections_weight" for="x_weight" class="<?php echo $sections_edit->LeftColumnClass ?>"><?php echo $sections_edit->weight->caption() ?><?php echo $sections_edit->weight->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sections_edit->RightColumnClass ?>"><div <?php echo $sections_edit->weight->cellAttributes() ?>>
<span id="el_sections_weight">
<input type="text" data-table="sections" data-field="x_weight" name="x_weight" id="x_weight" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($sections_edit->weight->getPlaceHolder()) ?>" value="<?php echo $sections_edit->weight->EditValue ?>"<?php echo $sections_edit->weight->editAttributes() ?>>
</span>
<?php echo $sections_edit->weight->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="sections" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($sections_edit->id->CurrentValue) ?>">
<?php
	if (in_array("questions", explode(",", $sections->getCurrentDetailTable())) && $questions->DetailEdit) {
?>
<?php if ($sections->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("questions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "questionsgrid.php" ?>
<?php } ?>
<?php if (!$sections_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $sections_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sections_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$sections_edit->showPageFooter();
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
$sections_edit->terminate();
?>
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
$sections_add = new sections_add();

// Run the page
$sections_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sections_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsectionsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fsectionsadd = currentForm = new ew.Form("fsectionsadd", "add");

	// Validate form
	fsectionsadd.validate = function() {
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
			<?php if ($sections_add->title->Required) { ?>
				elm = this.getElements("x" + infix + "_title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sections_add->title->caption(), $sections_add->title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sections_add->desc->Required) { ?>
				elm = this.getElements("x" + infix + "_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sections_add->desc->caption(), $sections_add->desc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sections_add->order->Required) { ?>
				elm = this.getElements("x" + infix + "_order");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sections_add->order->caption(), $sections_add->order->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_order");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($sections_add->order->errorMessage()) ?>");
			<?php if ($sections_add->weight->Required) { ?>
				elm = this.getElements("x" + infix + "_weight");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sections_add->weight->caption(), $sections_add->weight->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_weight");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($sections_add->weight->errorMessage()) ?>");

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
	fsectionsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsectionsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsectionsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sections_add->showPageHeader(); ?>
<?php
$sections_add->showMessage();
?>
<form name="fsectionsadd" id="fsectionsadd" class="<?php echo $sections_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sections">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$sections_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($sections_add->title->Visible) { // title ?>
	<div id="r_title" class="form-group row">
		<label id="elh_sections_title" for="x_title" class="<?php echo $sections_add->LeftColumnClass ?>"><?php echo $sections_add->title->caption() ?><?php echo $sections_add->title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sections_add->RightColumnClass ?>"><div <?php echo $sections_add->title->cellAttributes() ?>>
<span id="el_sections_title">
<input type="text" data-table="sections" data-field="x_title" name="x_title" id="x_title" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($sections_add->title->getPlaceHolder()) ?>" value="<?php echo $sections_add->title->EditValue ?>"<?php echo $sections_add->title->editAttributes() ?>>
</span>
<?php echo $sections_add->title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sections_add->desc->Visible) { // desc ?>
	<div id="r_desc" class="form-group row">
		<label id="elh_sections_desc" for="x_desc" class="<?php echo $sections_add->LeftColumnClass ?>"><?php echo $sections_add->desc->caption() ?><?php echo $sections_add->desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sections_add->RightColumnClass ?>"><div <?php echo $sections_add->desc->cellAttributes() ?>>
<span id="el_sections_desc">
<input type="text" data-table="sections" data-field="x_desc" name="x_desc" id="x_desc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($sections_add->desc->getPlaceHolder()) ?>" value="<?php echo $sections_add->desc->EditValue ?>"<?php echo $sections_add->desc->editAttributes() ?>>
</span>
<?php echo $sections_add->desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sections_add->order->Visible) { // order ?>
	<div id="r_order" class="form-group row">
		<label id="elh_sections_order" for="x_order" class="<?php echo $sections_add->LeftColumnClass ?>"><?php echo $sections_add->order->caption() ?><?php echo $sections_add->order->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sections_add->RightColumnClass ?>"><div <?php echo $sections_add->order->cellAttributes() ?>>
<span id="el_sections_order">
<input type="text" data-table="sections" data-field="x_order" name="x_order" id="x_order" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($sections_add->order->getPlaceHolder()) ?>" value="<?php echo $sections_add->order->EditValue ?>"<?php echo $sections_add->order->editAttributes() ?>>
</span>
<?php echo $sections_add->order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sections_add->weight->Visible) { // weight ?>
	<div id="r_weight" class="form-group row">
		<label id="elh_sections_weight" for="x_weight" class="<?php echo $sections_add->LeftColumnClass ?>"><?php echo $sections_add->weight->caption() ?><?php echo $sections_add->weight->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sections_add->RightColumnClass ?>"><div <?php echo $sections_add->weight->cellAttributes() ?>>
<span id="el_sections_weight">
<input type="text" data-table="sections" data-field="x_weight" name="x_weight" id="x_weight" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($sections_add->weight->getPlaceHolder()) ?>" value="<?php echo $sections_add->weight->EditValue ?>"<?php echo $sections_add->weight->editAttributes() ?>>
</span>
<?php echo $sections_add->weight->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("questions", explode(",", $sections->getCurrentDetailTable())) && $questions->DetailAdd) {
?>
<?php if ($sections->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("questions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "questionsgrid.php" ?>
<?php } ?>
<?php if (!$sections_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $sections_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sections_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$sections_add->showPageFooter();
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
$sections_add->terminate();
?>
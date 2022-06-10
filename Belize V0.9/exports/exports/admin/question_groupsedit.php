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
$question_groups_edit = new question_groups_edit();

// Run the page
$question_groups_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$question_groups_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fquestion_groupsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fquestion_groupsedit = currentForm = new ew.Form("fquestion_groupsedit", "edit");

	// Validate form
	fquestion_groupsedit.validate = function() {
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
			<?php if ($question_groups_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $question_groups_edit->id->caption(), $question_groups_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($question_groups_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $question_groups_edit->name->caption(), $question_groups_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($question_groups_edit->desc->Required) { ?>
				elm = this.getElements("x" + infix + "_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $question_groups_edit->desc->caption(), $question_groups_edit->desc->RequiredErrorMessage)) ?>");
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
	fquestion_groupsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fquestion_groupsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fquestion_groupsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $question_groups_edit->showPageHeader(); ?>
<?php
$question_groups_edit->showMessage();
?>
<form name="fquestion_groupsedit" id="fquestion_groupsedit" class="<?php echo $question_groups_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="question_groups">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$question_groups_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($question_groups_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_question_groups_id" class="<?php echo $question_groups_edit->LeftColumnClass ?>"><?php echo $question_groups_edit->id->caption() ?><?php echo $question_groups_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $question_groups_edit->RightColumnClass ?>"><div <?php echo $question_groups_edit->id->cellAttributes() ?>>
<span id="el_question_groups_id">
<span<?php echo $question_groups_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($question_groups_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="question_groups" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($question_groups_edit->id->CurrentValue) ?>">
<?php echo $question_groups_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($question_groups_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_question_groups_name" for="x_name" class="<?php echo $question_groups_edit->LeftColumnClass ?>"><?php echo $question_groups_edit->name->caption() ?><?php echo $question_groups_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $question_groups_edit->RightColumnClass ?>"><div <?php echo $question_groups_edit->name->cellAttributes() ?>>
<span id="el_question_groups_name">
<input type="text" data-table="question_groups" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($question_groups_edit->name->getPlaceHolder()) ?>" value="<?php echo $question_groups_edit->name->EditValue ?>"<?php echo $question_groups_edit->name->editAttributes() ?>>
</span>
<?php echo $question_groups_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($question_groups_edit->desc->Visible) { // desc ?>
	<div id="r_desc" class="form-group row">
		<label id="elh_question_groups_desc" for="x_desc" class="<?php echo $question_groups_edit->LeftColumnClass ?>"><?php echo $question_groups_edit->desc->caption() ?><?php echo $question_groups_edit->desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $question_groups_edit->RightColumnClass ?>"><div <?php echo $question_groups_edit->desc->cellAttributes() ?>>
<span id="el_question_groups_desc">
<input type="text" data-table="question_groups" data-field="x_desc" name="x_desc" id="x_desc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($question_groups_edit->desc->getPlaceHolder()) ?>" value="<?php echo $question_groups_edit->desc->EditValue ?>"<?php echo $question_groups_edit->desc->editAttributes() ?>>
</span>
<?php echo $question_groups_edit->desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("questions", explode(",", $question_groups->getCurrentDetailTable())) && $questions->DetailEdit) {
?>
<?php if ($question_groups->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("questions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "questionsgrid.php" ?>
<?php } ?>
<?php if (!$question_groups_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $question_groups_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $question_groups_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$question_groups_edit->showPageFooter();
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
$question_groups_edit->terminate();
?>
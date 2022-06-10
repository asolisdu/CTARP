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
$results_edit = new results_edit();

// Run the page
$results_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$results_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fresultsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fresultsedit = currentForm = new ew.Form("fresultsedit", "edit");

	// Validate form
	fresultsedit.validate = function() {
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
			<?php if ($results_edit->assessment_id->Required) { ?>
				elm = this.getElements("x" + infix + "_assessment_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $results_edit->assessment_id->caption(), $results_edit->assessment_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_assessment_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($results_edit->assessment_id->errorMessage()) ?>");
			<?php if ($results_edit->answers->Required) { ?>
				elm = this.getElements("x" + infix + "_answers");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $results_edit->answers->caption(), $results_edit->answers->RequiredErrorMessage)) ?>");
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
	fresultsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fresultsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fresultsedit.lists["x_assessment_id"] = <?php echo $results_edit->assessment_id->Lookup->toClientList($results_edit) ?>;
	fresultsedit.lists["x_assessment_id"].options = <?php echo JsonEncode($results_edit->assessment_id->lookupOptions()) ?>;
	fresultsedit.autoSuggests["x_assessment_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fresultsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $results_edit->showPageHeader(); ?>
<?php
$results_edit->showMessage();
?>
<form name="fresultsedit" id="fresultsedit" class="<?php echo $results_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="results">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$results_edit->IsModal ?>">
<?php if ($results->getCurrentMasterTable() == "assessments") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="assessments">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($results_edit->assessment_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($results_edit->assessment_id->Visible) { // assessment_id ?>
	<div id="r_assessment_id" class="form-group row">
		<label id="elh_results_assessment_id" class="<?php echo $results_edit->LeftColumnClass ?>"><?php echo $results_edit->assessment_id->caption() ?><?php echo $results_edit->assessment_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $results_edit->RightColumnClass ?>"><div <?php echo $results_edit->assessment_id->cellAttributes() ?>>
<?php if ($results_edit->assessment_id->getSessionValue() != "") { ?>
<span id="el_results_assessment_id">
<span<?php echo $results_edit->assessment_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($results_edit->assessment_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_assessment_id" name="x_assessment_id" value="<?php echo HtmlEncode($results_edit->assessment_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_results_assessment_id">
<?php
$onchange = $results_edit->assessment_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$results_edit->assessment_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_assessment_id">
	<input type="text" class="form-control" name="sv_x_assessment_id" id="sv_x_assessment_id" value="<?php echo RemoveHtml($results_edit->assessment_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($results_edit->assessment_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($results_edit->assessment_id->getPlaceHolder()) ?>"<?php echo $results_edit->assessment_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="results" data-field="x_assessment_id" data-value-separator="<?php echo $results_edit->assessment_id->displayValueSeparatorAttribute() ?>" name="x_assessment_id" id="x_assessment_id" value="<?php echo HtmlEncode($results_edit->assessment_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fresultsedit"], function() {
	fresultsedit.createAutoSuggest({"id":"x_assessment_id","forceSelect":false});
});
</script>
<?php echo $results_edit->assessment_id->Lookup->getParamTag($results_edit, "p_x_assessment_id") ?>
</span>
<?php } ?>
<?php echo $results_edit->assessment_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($results_edit->answers->Visible) { // answers ?>
	<div id="r_answers" class="form-group row">
		<label id="elh_results_answers" for="x_answers" class="<?php echo $results_edit->LeftColumnClass ?>"><?php echo $results_edit->answers->caption() ?><?php echo $results_edit->answers->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $results_edit->RightColumnClass ?>"><div <?php echo $results_edit->answers->cellAttributes() ?>>
<span id="el_results_answers">
<textarea data-table="results" data-field="x_answers" name="x_answers" id="x_answers" cols="35" rows="4" placeholder="<?php echo HtmlEncode($results_edit->answers->getPlaceHolder()) ?>"<?php echo $results_edit->answers->editAttributes() ?>><?php echo $results_edit->answers->EditValue ?></textarea>
</span>
<?php echo $results_edit->answers->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="results" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($results_edit->id->CurrentValue) ?>">
<?php if (!$results_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $results_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $results_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$results_edit->showPageFooter();
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
$results_edit->terminate();
?>
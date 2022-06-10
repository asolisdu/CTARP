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
$answers_add = new answers_add();

// Run the page
$answers_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$answers_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fanswersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fanswersadd = currentForm = new ew.Form("fanswersadd", "add");

	// Validate form
	fanswersadd.validate = function() {
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
			<?php if ($answers_add->question_id->Required) { ?>
				elm = this.getElements("x" + infix + "_question_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_add->question_id->caption(), $answers_add->question_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_question_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($answers_add->question_id->errorMessage()) ?>");
			<?php if ($answers_add->assessment_id->Required) { ?>
				elm = this.getElements("x" + infix + "_assessment_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_add->assessment_id->caption(), $answers_add->assessment_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_assessment_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($answers_add->assessment_id->errorMessage()) ?>");
			<?php if ($answers_add->section_id->Required) { ?>
				elm = this.getElements("x" + infix + "_section_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_add->section_id->caption(), $answers_add->section_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_section_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($answers_add->section_id->errorMessage()) ?>");
			<?php if ($answers_add->_response->Required) { ?>
				elm = this.getElements("x" + infix + "__response");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_add->_response->caption(), $answers_add->_response->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($answers_add->score->Required) { ?>
				elm = this.getElements("x" + infix + "_score");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_add->score->caption(), $answers_add->score->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_score");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($answers_add->score->errorMessage()) ?>");
			<?php if ($answers_add->recommendations->Required) { ?>
				elm = this.getElements("x" + infix + "_recommendations");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_add->recommendations->caption(), $answers_add->recommendations->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($answers_add->weight->Required) { ?>
				elm = this.getElements("x" + infix + "_weight");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_add->weight->caption(), $answers_add->weight->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_weight");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($answers_add->weight->errorMessage()) ?>");

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
	fanswersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fanswersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fanswersadd.lists["x_question_id"] = <?php echo $answers_add->question_id->Lookup->toClientList($answers_add) ?>;
	fanswersadd.lists["x_question_id"].options = <?php echo JsonEncode($answers_add->question_id->lookupOptions()) ?>;
	fanswersadd.autoSuggests["x_question_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fanswersadd.lists["x_assessment_id"] = <?php echo $answers_add->assessment_id->Lookup->toClientList($answers_add) ?>;
	fanswersadd.lists["x_assessment_id"].options = <?php echo JsonEncode($answers_add->assessment_id->lookupOptions()) ?>;
	fanswersadd.autoSuggests["x_assessment_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fanswersadd.lists["x_section_id"] = <?php echo $answers_add->section_id->Lookup->toClientList($answers_add) ?>;
	fanswersadd.lists["x_section_id"].options = <?php echo JsonEncode($answers_add->section_id->lookupOptions()) ?>;
	fanswersadd.autoSuggests["x_section_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fanswersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $answers_add->showPageHeader(); ?>
<?php
$answers_add->showMessage();
?>
<form name="fanswersadd" id="fanswersadd" class="<?php echo $answers_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="answers">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$answers_add->IsModal ?>">
<?php if ($answers->getCurrentMasterTable() == "questions") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="questions">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($answers_add->question_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($answers->getCurrentMasterTable() == "assessments") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="assessments">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($answers_add->assessment_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($answers_add->question_id->Visible) { // question_id ?>
	<div id="r_question_id" class="form-group row">
		<label id="elh_answers_question_id" class="<?php echo $answers_add->LeftColumnClass ?>"><?php echo $answers_add->question_id->caption() ?><?php echo $answers_add->question_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $answers_add->RightColumnClass ?>"><div <?php echo $answers_add->question_id->cellAttributes() ?>>
<?php if ($answers_add->question_id->getSessionValue() != "") { ?>
<span id="el_answers_question_id">
<span<?php echo $answers_add->question_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_add->question_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_question_id" name="x_question_id" value="<?php echo HtmlEncode($answers_add->question_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_answers_question_id">
<?php
$onchange = $answers_add->question_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$answers_add->question_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_question_id">
	<input type="text" class="form-control" name="sv_x_question_id" id="sv_x_question_id" value="<?php echo RemoveHtml($answers_add->question_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($answers_add->question_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($answers_add->question_id->getPlaceHolder()) ?>"<?php echo $answers_add->question_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_question_id" data-value-separator="<?php echo $answers_add->question_id->displayValueSeparatorAttribute() ?>" name="x_question_id" id="x_question_id" value="<?php echo HtmlEncode($answers_add->question_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fanswersadd"], function() {
	fanswersadd.createAutoSuggest({"id":"x_question_id","forceSelect":false});
});
</script>
<?php echo $answers_add->question_id->Lookup->getParamTag($answers_add, "p_x_question_id") ?>
</span>
<?php } ?>
<?php echo $answers_add->question_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($answers_add->assessment_id->Visible) { // assessment_id ?>
	<div id="r_assessment_id" class="form-group row">
		<label id="elh_answers_assessment_id" class="<?php echo $answers_add->LeftColumnClass ?>"><?php echo $answers_add->assessment_id->caption() ?><?php echo $answers_add->assessment_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $answers_add->RightColumnClass ?>"><div <?php echo $answers_add->assessment_id->cellAttributes() ?>>
<?php if ($answers_add->assessment_id->getSessionValue() != "") { ?>
<span id="el_answers_assessment_id">
<span<?php echo $answers_add->assessment_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_add->assessment_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_assessment_id" name="x_assessment_id" value="<?php echo HtmlEncode($answers_add->assessment_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_answers_assessment_id">
<?php
$onchange = $answers_add->assessment_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$answers_add->assessment_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_assessment_id">
	<input type="text" class="form-control" name="sv_x_assessment_id" id="sv_x_assessment_id" value="<?php echo RemoveHtml($answers_add->assessment_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($answers_add->assessment_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($answers_add->assessment_id->getPlaceHolder()) ?>"<?php echo $answers_add->assessment_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_assessment_id" data-value-separator="<?php echo $answers_add->assessment_id->displayValueSeparatorAttribute() ?>" name="x_assessment_id" id="x_assessment_id" value="<?php echo HtmlEncode($answers_add->assessment_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fanswersadd"], function() {
	fanswersadd.createAutoSuggest({"id":"x_assessment_id","forceSelect":false});
});
</script>
<?php echo $answers_add->assessment_id->Lookup->getParamTag($answers_add, "p_x_assessment_id") ?>
</span>
<?php } ?>
<?php echo $answers_add->assessment_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($answers_add->section_id->Visible) { // section_id ?>
	<div id="r_section_id" class="form-group row">
		<label id="elh_answers_section_id" class="<?php echo $answers_add->LeftColumnClass ?>"><?php echo $answers_add->section_id->caption() ?><?php echo $answers_add->section_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $answers_add->RightColumnClass ?>"><div <?php echo $answers_add->section_id->cellAttributes() ?>>
<span id="el_answers_section_id">
<?php
$onchange = $answers_add->section_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$answers_add->section_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_section_id">
	<input type="text" class="form-control" name="sv_x_section_id" id="sv_x_section_id" value="<?php echo RemoveHtml($answers_add->section_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($answers_add->section_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($answers_add->section_id->getPlaceHolder()) ?>"<?php echo $answers_add->section_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_section_id" data-value-separator="<?php echo $answers_add->section_id->displayValueSeparatorAttribute() ?>" name="x_section_id" id="x_section_id" value="<?php echo HtmlEncode($answers_add->section_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fanswersadd"], function() {
	fanswersadd.createAutoSuggest({"id":"x_section_id","forceSelect":false});
});
</script>
<?php echo $answers_add->section_id->Lookup->getParamTag($answers_add, "p_x_section_id") ?>
</span>
<?php echo $answers_add->section_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($answers_add->_response->Visible) { // response ?>
	<div id="r__response" class="form-group row">
		<label id="elh_answers__response" for="x__response" class="<?php echo $answers_add->LeftColumnClass ?>"><?php echo $answers_add->_response->caption() ?><?php echo $answers_add->_response->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $answers_add->RightColumnClass ?>"><div <?php echo $answers_add->_response->cellAttributes() ?>>
<span id="el_answers__response">
<input type="text" data-table="answers" data-field="x__response" name="x__response" id="x__response" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($answers_add->_response->getPlaceHolder()) ?>" value="<?php echo $answers_add->_response->EditValue ?>"<?php echo $answers_add->_response->editAttributes() ?>>
</span>
<?php echo $answers_add->_response->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($answers_add->score->Visible) { // score ?>
	<div id="r_score" class="form-group row">
		<label id="elh_answers_score" for="x_score" class="<?php echo $answers_add->LeftColumnClass ?>"><?php echo $answers_add->score->caption() ?><?php echo $answers_add->score->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $answers_add->RightColumnClass ?>"><div <?php echo $answers_add->score->cellAttributes() ?>>
<span id="el_answers_score">
<input type="text" data-table="answers" data-field="x_score" name="x_score" id="x_score" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($answers_add->score->getPlaceHolder()) ?>" value="<?php echo $answers_add->score->EditValue ?>"<?php echo $answers_add->score->editAttributes() ?>>
</span>
<?php echo $answers_add->score->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($answers_add->recommendations->Visible) { // recommendations ?>
	<div id="r_recommendations" class="form-group row">
		<label id="elh_answers_recommendations" for="x_recommendations" class="<?php echo $answers_add->LeftColumnClass ?>"><?php echo $answers_add->recommendations->caption() ?><?php echo $answers_add->recommendations->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $answers_add->RightColumnClass ?>"><div <?php echo $answers_add->recommendations->cellAttributes() ?>>
<span id="el_answers_recommendations">
<textarea data-table="answers" data-field="x_recommendations" name="x_recommendations" id="x_recommendations" cols="35" rows="4" placeholder="<?php echo HtmlEncode($answers_add->recommendations->getPlaceHolder()) ?>"<?php echo $answers_add->recommendations->editAttributes() ?>><?php echo $answers_add->recommendations->EditValue ?></textarea>
</span>
<?php echo $answers_add->recommendations->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($answers_add->weight->Visible) { // weight ?>
	<div id="r_weight" class="form-group row">
		<label id="elh_answers_weight" for="x_weight" class="<?php echo $answers_add->LeftColumnClass ?>"><?php echo $answers_add->weight->caption() ?><?php echo $answers_add->weight->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $answers_add->RightColumnClass ?>"><div <?php echo $answers_add->weight->cellAttributes() ?>>
<span id="el_answers_weight">
<input type="text" data-table="answers" data-field="x_weight" name="x_weight" id="x_weight" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($answers_add->weight->getPlaceHolder()) ?>" value="<?php echo $answers_add->weight->EditValue ?>"<?php echo $answers_add->weight->editAttributes() ?>>
</span>
<?php echo $answers_add->weight->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$answers_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $answers_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $answers_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$answers_add->showPageFooter();
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
$answers_add->terminate();
?>
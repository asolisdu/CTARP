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
$questions_answers_search = new questions_answers_search();

// Run the page
$questions_answers_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$questions_answers_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fquestions_answerssearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($questions_answers_search->IsModal) { ?>
	fquestions_answerssearch = currentAdvancedSearchForm = new ew.Form("fquestions_answerssearch", "search");
	<?php } else { ?>
	fquestions_answerssearch = currentForm = new ew.Form("fquestions_answerssearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fquestions_answerssearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_question_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->question_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_question_section_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->question_section_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_question_order");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->question_order->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_answer_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->answer_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_answer_score");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->answer_score->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_assessment_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->assessment_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_answer_weight");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->answer_weight->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_answer_section_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->answer_section_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_assessment_status");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->assessment_status->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_assessment_total_score");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->assessment_total_score->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_assessment_user_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->assessment_user_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_assessment_customer_age");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->assessment_customer_age->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_assessment_lat");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->assessment_lat->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_assessment_lon");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->assessment_lon->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_created_at");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->created_at->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_updated_at");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->updated_at->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_loan_purpose_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->loan_purpose_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_loan_sector_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_search->loan_sector_id->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fquestions_answerssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fquestions_answerssearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fquestions_answerssearch.lists["x_question_active[]"] = <?php echo $questions_answers_search->question_active->Lookup->toClientList($questions_answers_search) ?>;
	fquestions_answerssearch.lists["x_question_active[]"].options = <?php echo JsonEncode($questions_answers_search->question_active->options(FALSE, TRUE)) ?>;
	fquestions_answerssearch.lists["x_question_section_id"] = <?php echo $questions_answers_search->question_section_id->Lookup->toClientList($questions_answers_search) ?>;
	fquestions_answerssearch.lists["x_question_section_id"].options = <?php echo JsonEncode($questions_answers_search->question_section_id->lookupOptions()) ?>;
	fquestions_answerssearch.autoSuggests["x_question_section_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fquestions_answerssearch.lists["x_question_type"] = <?php echo $questions_answers_search->question_type->Lookup->toClientList($questions_answers_search) ?>;
	fquestions_answerssearch.lists["x_question_type"].options = <?php echo JsonEncode($questions_answers_search->question_type->lookupOptions()) ?>;
	fquestions_answerssearch.lists["x_question_has_recommendations[]"] = <?php echo $questions_answers_search->question_has_recommendations->Lookup->toClientList($questions_answers_search) ?>;
	fquestions_answerssearch.lists["x_question_has_recommendations[]"].options = <?php echo JsonEncode($questions_answers_search->question_has_recommendations->options(FALSE, TRUE)) ?>;
	fquestions_answerssearch.lists["x_question_group_id"] = <?php echo $questions_answers_search->question_group_id->Lookup->toClientList($questions_answers_search) ?>;
	fquestions_answerssearch.lists["x_question_group_id"].options = <?php echo JsonEncode($questions_answers_search->question_group_id->lookupOptions()) ?>;
	fquestions_answerssearch.lists["x_question_category_id"] = <?php echo $questions_answers_search->question_category_id->Lookup->toClientList($questions_answers_search) ?>;
	fquestions_answerssearch.lists["x_question_category_id"].options = <?php echo JsonEncode($questions_answers_search->question_category_id->lookupOptions()) ?>;
	fquestions_answerssearch.lists["x_assessment_id"] = <?php echo $questions_answers_search->assessment_id->Lookup->toClientList($questions_answers_search) ?>;
	fquestions_answerssearch.lists["x_assessment_id"].options = <?php echo JsonEncode($questions_answers_search->assessment_id->lookupOptions()) ?>;
	fquestions_answerssearch.autoSuggests["x_assessment_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fquestions_answerssearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $questions_answers_search->showPageHeader(); ?>
<?php
$questions_answers_search->showMessage();
?>
<form name="fquestions_answerssearch" id="fquestions_answerssearch" class="<?php echo $questions_answers_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="questions_answers">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$questions_answers_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($questions_answers_search->question_id->Visible) { // question_id ?>
	<div id="r_question_id" class="form-group row">
		<label for="x_question_id" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_id"><?php echo $questions_answers_search->question_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_question_id" id="z_question_id" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_id->cellAttributes() ?>>
			<span id="el_questions_answers_question_id" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_question_id" name="x_question_id" id="x_question_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_answers_search->question_id->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->question_id->EditValue ?>"<?php echo $questions_answers_search->question_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_title->Visible) { // question_title ?>
	<div id="r_question_title" class="form-group row">
		<label for="x_question_title" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_title"><?php echo $questions_answers_search->question_title->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_question_title" id="z_question_title" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_title->cellAttributes() ?>>
			<span id="el_questions_answers_question_title" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_question_title" name="x_question_title" id="x_question_title" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->question_title->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->question_title->EditValue ?>"<?php echo $questions_answers_search->question_title->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_placeholder->Visible) { // question_placeholder ?>
	<div id="r_question_placeholder" class="form-group row">
		<label for="x_question_placeholder" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_placeholder"><?php echo $questions_answers_search->question_placeholder->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_question_placeholder" id="z_question_placeholder" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_placeholder->cellAttributes() ?>>
			<span id="el_questions_answers_question_placeholder" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_question_placeholder" name="x_question_placeholder" id="x_question_placeholder" size="35" maxlength="512" placeholder="<?php echo HtmlEncode($questions_answers_search->question_placeholder->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->question_placeholder->EditValue ?>"<?php echo $questions_answers_search->question_placeholder->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_questions->Visible) { // question_questions ?>
	<div id="r_question_questions" class="form-group row">
		<label for="x_question_questions" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_questions"><?php echo $questions_answers_search->question_questions->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_question_questions" id="z_question_questions" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_questions->cellAttributes() ?>>
			<span id="el_questions_answers_question_questions" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_question_questions" name="x_question_questions" id="x_question_questions" size="35" maxlength="1028" placeholder="<?php echo HtmlEncode($questions_answers_search->question_questions->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->question_questions->EditValue ?>"<?php echo $questions_answers_search->question_questions->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_scores->Visible) { // question_scores ?>
	<div id="r_question_scores" class="form-group row">
		<label for="x_question_scores" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_scores"><?php echo $questions_answers_search->question_scores->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_question_scores" id="z_question_scores" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_scores->cellAttributes() ?>>
			<span id="el_questions_answers_question_scores" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_question_scores" name="x_question_scores" id="x_question_scores" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->question_scores->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->question_scores->EditValue ?>"<?php echo $questions_answers_search->question_scores->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_active->Visible) { // question_active ?>
	<div id="r_question_active" class="form-group row">
		<label class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_active"><?php echo $questions_answers_search->question_active->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_question_active" id="z_question_active" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_active->cellAttributes() ?>>
			<span id="el_questions_answers_question_active" class="ew-search-field">
<?php
$selwrk = ConvertToBool($questions_answers_search->question_active->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="questions_answers" data-field="x_question_active" name="x_question_active[]" id="x_question_active[]_668283" value="1"<?php echo $selwrk ?><?php echo $questions_answers_search->question_active->editAttributes() ?>>
	<label class="custom-control-label" for="x_question_active[]_668283"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_section_id->Visible) { // question_section_id ?>
	<div id="r_question_section_id" class="form-group row">
		<label class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_section_id"><?php echo $questions_answers_search->question_section_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_question_section_id" id="z_question_section_id" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_section_id->cellAttributes() ?>>
			<span id="el_questions_answers_question_section_id" class="ew-search-field">
<?php
$onchange = $questions_answers_search->question_section_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$questions_answers_search->question_section_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_question_section_id">
	<input type="text" class="form-control" name="sv_x_question_section_id" id="sv_x_question_section_id" value="<?php echo RemoveHtml($questions_answers_search->question_section_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_answers_search->question_section_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($questions_answers_search->question_section_id->getPlaceHolder()) ?>"<?php echo $questions_answers_search->question_section_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions_answers" data-field="x_question_section_id" data-value-separator="<?php echo $questions_answers_search->question_section_id->displayValueSeparatorAttribute() ?>" name="x_question_section_id" id="x_question_section_id" value="<?php echo HtmlEncode($questions_answers_search->question_section_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fquestions_answerssearch"], function() {
	fquestions_answerssearch.createAutoSuggest({"id":"x_question_section_id","forceSelect":false});
});
</script>
<?php echo $questions_answers_search->question_section_id->Lookup->getParamTag($questions_answers_search, "p_x_question_section_id") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_type->Visible) { // question_type ?>
	<div id="r_question_type" class="form-group row">
		<label for="x_question_type" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_type"><?php echo $questions_answers_search->question_type->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_question_type" id="z_question_type" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_type->cellAttributes() ?>>
			<span id="el_questions_answers_question_type" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($questions_answers_search->question_type->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $questions_answers_search->question_type->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_question_type" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $questions_answers_search->question_type->radioButtonListHtml(TRUE, "x_question_type") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_question_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="questions_answers" data-field="x_question_type" data-value-separator="<?php echo $questions_answers_search->question_type->displayValueSeparatorAttribute() ?>" name="x_question_type" id="x_question_type" value="{value}"<?php echo $questions_answers_search->question_type->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$questions_answers_search->question_type->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $questions_answers_search->question_type->Lookup->getParamTag($questions_answers_search, "p_x_question_type") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_has_recommendations->Visible) { // question_has_recommendations ?>
	<div id="r_question_has_recommendations" class="form-group row">
		<label class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_has_recommendations"><?php echo $questions_answers_search->question_has_recommendations->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_question_has_recommendations" id="z_question_has_recommendations" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_has_recommendations->cellAttributes() ?>>
			<span id="el_questions_answers_question_has_recommendations" class="ew-search-field">
<div id="tp_x_question_has_recommendations" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="questions_answers" data-field="x_question_has_recommendations" data-value-separator="<?php echo $questions_answers_search->question_has_recommendations->displayValueSeparatorAttribute() ?>" name="x_question_has_recommendations[]" id="x_question_has_recommendations[]" value="{value}"<?php echo $questions_answers_search->question_has_recommendations->editAttributes() ?>></div>
<div id="dsl_x_question_has_recommendations" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $questions_answers_search->question_has_recommendations->checkBoxListHtml(FALSE, "x_question_has_recommendations[]") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_group_id->Visible) { // question_group_id ?>
	<div id="r_question_group_id" class="form-group row">
		<label for="x_question_group_id" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_group_id"><?php echo $questions_answers_search->question_group_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_question_group_id" id="z_question_group_id" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_group_id->cellAttributes() ?>>
			<span id="el_questions_answers_question_group_id" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="questions_answers" data-field="x_question_group_id" data-value-separator="<?php echo $questions_answers_search->question_group_id->displayValueSeparatorAttribute() ?>" id="x_question_group_id" name="x_question_group_id"<?php echo $questions_answers_search->question_group_id->editAttributes() ?>>
			<?php echo $questions_answers_search->question_group_id->selectOptionListHtml("x_question_group_id") ?>
		</select>
</div>
<?php echo $questions_answers_search->question_group_id->Lookup->getParamTag($questions_answers_search, "p_x_question_group_id") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_category_id->Visible) { // question_category_id ?>
	<div id="r_question_category_id" class="form-group row">
		<label for="x_question_category_id" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_category_id"><?php echo $questions_answers_search->question_category_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_question_category_id" id="z_question_category_id" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_category_id->cellAttributes() ?>>
			<span id="el_questions_answers_question_category_id" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="questions_answers" data-field="x_question_category_id" data-value-separator="<?php echo $questions_answers_search->question_category_id->displayValueSeparatorAttribute() ?>" id="x_question_category_id" name="x_question_category_id"<?php echo $questions_answers_search->question_category_id->editAttributes() ?>>
			<?php echo $questions_answers_search->question_category_id->selectOptionListHtml("x_question_category_id") ?>
		</select>
</div>
<?php echo $questions_answers_search->question_category_id->Lookup->getParamTag($questions_answers_search, "p_x_question_category_id") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_order->Visible) { // question_order ?>
	<div id="r_question_order" class="form-group row">
		<label for="x_question_order" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_order"><?php echo $questions_answers_search->question_order->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_question_order" id="z_question_order" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_order->cellAttributes() ?>>
			<span id="el_questions_answers_question_order" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_question_order" name="x_question_order" id="x_question_order" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_answers_search->question_order->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->question_order->EditValue ?>"<?php echo $questions_answers_search->question_order->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->answer_id->Visible) { // answer_id ?>
	<div id="r_answer_id" class="form-group row">
		<label for="x_answer_id" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_answer_id"><?php echo $questions_answers_search->answer_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_answer_id" id="z_answer_id" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->answer_id->cellAttributes() ?>>
			<span id="el_questions_answers_answer_id" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_answer_id" name="x_answer_id" id="x_answer_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_answers_search->answer_id->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->answer_id->EditValue ?>"<?php echo $questions_answers_search->answer_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->answer_response->Visible) { // answer_response ?>
	<div id="r_answer_response" class="form-group row">
		<label for="x_answer_response" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_answer_response"><?php echo $questions_answers_search->answer_response->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_answer_response" id="z_answer_response" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->answer_response->cellAttributes() ?>>
			<span id="el_questions_answers_answer_response" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_answer_response" name="x_answer_response" id="x_answer_response" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->answer_response->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->answer_response->EditValue ?>"<?php echo $questions_answers_search->answer_response->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->answer_score->Visible) { // answer_score ?>
	<div id="r_answer_score" class="form-group row">
		<label for="x_answer_score" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_answer_score"><?php echo $questions_answers_search->answer_score->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_answer_score" id="z_answer_score" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->answer_score->cellAttributes() ?>>
			<span id="el_questions_answers_answer_score" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_answer_score" name="x_answer_score" id="x_answer_score" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($questions_answers_search->answer_score->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->answer_score->EditValue ?>"<?php echo $questions_answers_search->answer_score->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_id->Visible) { // assessment_id ?>
	<div id="r_assessment_id" class="form-group row">
		<label class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_id"><?php echo $questions_answers_search->assessment_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_assessment_id" id="z_assessment_id" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_id->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_id" class="ew-search-field">
<?php
$onchange = $questions_answers_search->assessment_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$questions_answers_search->assessment_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_assessment_id">
	<input type="text" class="form-control" name="sv_x_assessment_id" id="sv_x_assessment_id" value="<?php echo RemoveHtml($questions_answers_search->assessment_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_id->getPlaceHolder()) ?>"<?php echo $questions_answers_search->assessment_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions_answers" data-field="x_assessment_id" data-value-separator="<?php echo $questions_answers_search->assessment_id->displayValueSeparatorAttribute() ?>" name="x_assessment_id" id="x_assessment_id" value="<?php echo HtmlEncode($questions_answers_search->assessment_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fquestions_answerssearch"], function() {
	fquestions_answerssearch.createAutoSuggest({"id":"x_assessment_id","forceSelect":false});
});
</script>
<?php echo $questions_answers_search->assessment_id->Lookup->getParamTag($questions_answers_search, "p_x_assessment_id") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->answer_weight->Visible) { // answer_weight ?>
	<div id="r_answer_weight" class="form-group row">
		<label for="x_answer_weight" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_answer_weight"><?php echo $questions_answers_search->answer_weight->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_answer_weight" id="z_answer_weight" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->answer_weight->cellAttributes() ?>>
			<span id="el_questions_answers_answer_weight" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_answer_weight" name="x_answer_weight" id="x_answer_weight" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($questions_answers_search->answer_weight->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->answer_weight->EditValue ?>"<?php echo $questions_answers_search->answer_weight->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->answer_section_id->Visible) { // answer_section_id ?>
	<div id="r_answer_section_id" class="form-group row">
		<label for="x_answer_section_id" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_answer_section_id"><?php echo $questions_answers_search->answer_section_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_answer_section_id" id="z_answer_section_id" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->answer_section_id->cellAttributes() ?>>
			<span id="el_questions_answers_answer_section_id" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_answer_section_id" name="x_answer_section_id" id="x_answer_section_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_answers_search->answer_section_id->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->answer_section_id->EditValue ?>"<?php echo $questions_answers_search->answer_section_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->answer_recommendations->Visible) { // answer_recommendations ?>
	<div id="r_answer_recommendations" class="form-group row">
		<label for="x_answer_recommendations" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_answer_recommendations"><?php echo $questions_answers_search->answer_recommendations->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_answer_recommendations" id="z_answer_recommendations" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->answer_recommendations->cellAttributes() ?>>
			<span id="el_questions_answers_answer_recommendations" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_answer_recommendations" name="x_answer_recommendations" id="x_answer_recommendations" size="35" maxlength="65535" placeholder="<?php echo HtmlEncode($questions_answers_search->answer_recommendations->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->answer_recommendations->EditValue ?>"<?php echo $questions_answers_search->answer_recommendations->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_type_name->Visible) { // question_type_name ?>
	<div id="r_question_type_name" class="form-group row">
		<label for="x_question_type_name" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_type_name"><?php echo $questions_answers_search->question_type_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_question_type_name" id="z_question_type_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_type_name->cellAttributes() ?>>
			<span id="el_questions_answers_question_type_name" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_question_type_name" name="x_question_type_name" id="x_question_type_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->question_type_name->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->question_type_name->EditValue ?>"<?php echo $questions_answers_search->question_type_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_group_name->Visible) { // question_group_name ?>
	<div id="r_question_group_name" class="form-group row">
		<label for="x_question_group_name" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_group_name"><?php echo $questions_answers_search->question_group_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_question_group_name" id="z_question_group_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_group_name->cellAttributes() ?>>
			<span id="el_questions_answers_question_group_name" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_question_group_name" name="x_question_group_name" id="x_question_group_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->question_group_name->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->question_group_name->EditValue ?>"<?php echo $questions_answers_search->question_group_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->question_category_name->Visible) { // question_category_name ?>
	<div id="r_question_category_name" class="form-group row">
		<label for="x_question_category_name" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_question_category_name"><?php echo $questions_answers_search->question_category_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_question_category_name" id="z_question_category_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->question_category_name->cellAttributes() ?>>
			<span id="el_questions_answers_question_category_name" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_question_category_name" name="x_question_category_name" id="x_question_category_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->question_category_name->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->question_category_name->EditValue ?>"<?php echo $questions_answers_search->question_category_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_customer_id->Visible) { // assessment_customer_id ?>
	<div id="r_assessment_customer_id" class="form-group row">
		<label for="x_assessment_customer_id" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_customer_id"><?php echo $questions_answers_search->assessment_customer_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_assessment_customer_id" id="z_assessment_customer_id" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_customer_id->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_customer_id" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_customer_id" name="x_assessment_customer_id" id="x_assessment_customer_id" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_customer_id->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_customer_id->EditValue ?>"<?php echo $questions_answers_search->assessment_customer_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_customer_first_name->Visible) { // assessment_customer_first_name ?>
	<div id="r_assessment_customer_first_name" class="form-group row">
		<label for="x_assessment_customer_first_name" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_customer_first_name"><?php echo $questions_answers_search->assessment_customer_first_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_assessment_customer_first_name" id="z_assessment_customer_first_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_customer_first_name->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_customer_first_name" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_customer_first_name" name="x_assessment_customer_first_name" id="x_assessment_customer_first_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_customer_first_name->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_customer_first_name->EditValue ?>"<?php echo $questions_answers_search->assessment_customer_first_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_status->Visible) { // assessment_status ?>
	<div id="r_assessment_status" class="form-group row">
		<label for="x_assessment_status" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_status"><?php echo $questions_answers_search->assessment_status->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_assessment_status" id="z_assessment_status" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_status->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_status" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_status" name="x_assessment_status" id="x_assessment_status" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_status->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_status->EditValue ?>"<?php echo $questions_answers_search->assessment_status->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_total_score->Visible) { // assessment_total_score ?>
	<div id="r_assessment_total_score" class="form-group row">
		<label for="x_assessment_total_score" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_total_score"><?php echo $questions_answers_search->assessment_total_score->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_assessment_total_score" id="z_assessment_total_score" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_total_score->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_total_score" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_total_score" name="x_assessment_total_score" id="x_assessment_total_score" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_total_score->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_total_score->EditValue ?>"<?php echo $questions_answers_search->assessment_total_score->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_customer_last_name->Visible) { // assessment_customer_last_name ?>
	<div id="r_assessment_customer_last_name" class="form-group row">
		<label for="x_assessment_customer_last_name" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_customer_last_name"><?php echo $questions_answers_search->assessment_customer_last_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_assessment_customer_last_name" id="z_assessment_customer_last_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_customer_last_name->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_customer_last_name" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_customer_last_name" name="x_assessment_customer_last_name" id="x_assessment_customer_last_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_customer_last_name->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_customer_last_name->EditValue ?>"<?php echo $questions_answers_search->assessment_customer_last_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_user_id->Visible) { // assessment_user_id ?>
	<div id="r_assessment_user_id" class="form-group row">
		<label for="x_assessment_user_id" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_user_id"><?php echo $questions_answers_search->assessment_user_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_assessment_user_id" id="z_assessment_user_id" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_user_id->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_user_id" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_user_id" name="x_assessment_user_id" id="x_assessment_user_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_user_id->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_user_id->EditValue ?>"<?php echo $questions_answers_search->assessment_user_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_user_first_name->Visible) { // assessment_user_first_name ?>
	<div id="r_assessment_user_first_name" class="form-group row">
		<label for="x_assessment_user_first_name" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_user_first_name"><?php echo $questions_answers_search->assessment_user_first_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_assessment_user_first_name" id="z_assessment_user_first_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_user_first_name->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_user_first_name" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_user_first_name" name="x_assessment_user_first_name" id="x_assessment_user_first_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_user_first_name->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_user_first_name->EditValue ?>"<?php echo $questions_answers_search->assessment_user_first_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_user_last_name->Visible) { // assessment_user_last_name ?>
	<div id="r_assessment_user_last_name" class="form-group row">
		<label for="x_assessment_user_last_name" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_user_last_name"><?php echo $questions_answers_search->assessment_user_last_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_assessment_user_last_name" id="z_assessment_user_last_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_user_last_name->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_user_last_name" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_user_last_name" name="x_assessment_user_last_name" id="x_assessment_user_last_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_user_last_name->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_user_last_name->EditValue ?>"<?php echo $questions_answers_search->assessment_user_last_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_user_email->Visible) { // assessment_user_email ?>
	<div id="r_assessment_user_email" class="form-group row">
		<label for="x_assessment_user_email" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_user_email"><?php echo $questions_answers_search->assessment_user_email->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_assessment_user_email" id="z_assessment_user_email" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_user_email->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_user_email" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_user_email" name="x_assessment_user_email" id="x_assessment_user_email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_user_email->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_user_email->EditValue ?>"<?php echo $questions_answers_search->assessment_user_email->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_personal_id->Visible) { // assessment_personal_id ?>
	<div id="r_assessment_personal_id" class="form-group row">
		<label for="x_assessment_personal_id" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_personal_id"><?php echo $questions_answers_search->assessment_personal_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_assessment_personal_id" id="z_assessment_personal_id" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_personal_id->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_personal_id" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_personal_id" name="x_assessment_personal_id" id="x_assessment_personal_id" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_personal_id->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_personal_id->EditValue ?>"<?php echo $questions_answers_search->assessment_personal_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_customer_age->Visible) { // assessment_customer_age ?>
	<div id="r_assessment_customer_age" class="form-group row">
		<label for="x_assessment_customer_age" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_customer_age"><?php echo $questions_answers_search->assessment_customer_age->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_assessment_customer_age" id="z_assessment_customer_age" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_customer_age->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_customer_age" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_customer_age" name="x_assessment_customer_age" id="x_assessment_customer_age" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_customer_age->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_customer_age->EditValue ?>"<?php echo $questions_answers_search->assessment_customer_age->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_sex->Visible) { // assessment_sex ?>
	<div id="r_assessment_sex" class="form-group row">
		<label for="x_assessment_sex" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_sex"><?php echo $questions_answers_search->assessment_sex->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_assessment_sex" id="z_assessment_sex" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_sex->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_sex" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_sex" name="x_assessment_sex" id="x_assessment_sex" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_sex->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_sex->EditValue ?>"<?php echo $questions_answers_search->assessment_sex->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_address->Visible) { // assessment_address ?>
	<div id="r_assessment_address" class="form-group row">
		<label for="x_assessment_address" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_address"><?php echo $questions_answers_search->assessment_address->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_assessment_address" id="z_assessment_address" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_address->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_address" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_address" name="x_assessment_address" id="x_assessment_address" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_address->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_address->EditValue ?>"<?php echo $questions_answers_search->assessment_address->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_lat->Visible) { // assessment_lat ?>
	<div id="r_assessment_lat" class="form-group row">
		<label for="x_assessment_lat" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_lat"><?php echo $questions_answers_search->assessment_lat->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_assessment_lat" id="z_assessment_lat" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_lat->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_lat" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_lat" name="x_assessment_lat" id="x_assessment_lat" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_lat->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_lat->EditValue ?>"<?php echo $questions_answers_search->assessment_lat->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_lon->Visible) { // assessment_lon ?>
	<div id="r_assessment_lon" class="form-group row">
		<label for="x_assessment_lon" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_lon"><?php echo $questions_answers_search->assessment_lon->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_assessment_lon" id="z_assessment_lon" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_lon->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_lon" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_lon" name="x_assessment_lon" id="x_assessment_lon" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_lon->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_lon->EditValue ?>"<?php echo $questions_answers_search->assessment_lon->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_loan_purpose->Visible) { // assessment_loan_purpose ?>
	<div id="r_assessment_loan_purpose" class="form-group row">
		<label for="x_assessment_loan_purpose" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_loan_purpose"><?php echo $questions_answers_search->assessment_loan_purpose->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_assessment_loan_purpose" id="z_assessment_loan_purpose" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_loan_purpose->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_loan_purpose" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_loan_purpose" name="x_assessment_loan_purpose" id="x_assessment_loan_purpose" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_loan_purpose->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_loan_purpose->EditValue ?>"<?php echo $questions_answers_search->assessment_loan_purpose->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->assessment_loan_section->Visible) { // assessment_loan_section ?>
	<div id="r_assessment_loan_section" class="form-group row">
		<label for="x_assessment_loan_section" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_assessment_loan_section"><?php echo $questions_answers_search->assessment_loan_section->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_assessment_loan_section" id="z_assessment_loan_section" value="LIKE">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->assessment_loan_section->cellAttributes() ?>>
			<span id="el_questions_answers_assessment_loan_section" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_assessment_loan_section" name="x_assessment_loan_section" id="x_assessment_loan_section" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_answers_search->assessment_loan_section->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->assessment_loan_section->EditValue ?>"<?php echo $questions_answers_search->assessment_loan_section->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->created_at->Visible) { // created_at ?>
	<div id="r_created_at" class="form-group row">
		<label for="x_created_at" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_created_at"><?php echo $questions_answers_search->created_at->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_created_at" id="z_created_at" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->created_at->cellAttributes() ?>>
			<span id="el_questions_answers_created_at" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_created_at" name="x_created_at" id="x_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($questions_answers_search->created_at->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->created_at->EditValue ?>"<?php echo $questions_answers_search->created_at->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->updated_at->Visible) { // updated_at ?>
	<div id="r_updated_at" class="form-group row">
		<label for="x_updated_at" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_updated_at"><?php echo $questions_answers_search->updated_at->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_updated_at" id="z_updated_at" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->updated_at->cellAttributes() ?>>
			<span id="el_questions_answers_updated_at" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_updated_at" name="x_updated_at" id="x_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($questions_answers_search->updated_at->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->updated_at->EditValue ?>"<?php echo $questions_answers_search->updated_at->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->loan_purpose_id->Visible) { // loan_purpose_id ?>
	<div id="r_loan_purpose_id" class="form-group row">
		<label for="x_loan_purpose_id" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_loan_purpose_id"><?php echo $questions_answers_search->loan_purpose_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_loan_purpose_id" id="z_loan_purpose_id" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->loan_purpose_id->cellAttributes() ?>>
			<span id="el_questions_answers_loan_purpose_id" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_loan_purpose_id" name="x_loan_purpose_id" id="x_loan_purpose_id" maxlength="10" placeholder="<?php echo HtmlEncode($questions_answers_search->loan_purpose_id->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->loan_purpose_id->EditValue ?>"<?php echo $questions_answers_search->loan_purpose_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($questions_answers_search->loan_sector_id->Visible) { // loan_sector_id ?>
	<div id="r_loan_sector_id" class="form-group row">
		<label for="x_loan_sector_id" class="<?php echo $questions_answers_search->LeftColumnClass ?>"><span id="elh_questions_answers_loan_sector_id"><?php echo $questions_answers_search->loan_sector_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_loan_sector_id" id="z_loan_sector_id" value="=">
</span>
		</label>
		<div class="<?php echo $questions_answers_search->RightColumnClass ?>"><div <?php echo $questions_answers_search->loan_sector_id->cellAttributes() ?>>
			<span id="el_questions_answers_loan_sector_id" class="ew-search-field">
<input type="text" data-table="questions_answers" data-field="x_loan_sector_id" name="x_loan_sector_id" id="x_loan_sector_id" maxlength="10" placeholder="<?php echo HtmlEncode($questions_answers_search->loan_sector_id->getPlaceHolder()) ?>" value="<?php echo $questions_answers_search->loan_sector_id->EditValue ?>"<?php echo $questions_answers_search->loan_sector_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$questions_answers_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $questions_answers_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$questions_answers_search->showPageFooter();
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
$questions_answers_search->terminate();
?>
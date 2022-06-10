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
$questions_add = new questions_add();

// Run the page
$questions_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$questions_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fquestionsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fquestionsadd = currentForm = new ew.Form("fquestionsadd", "add");

	// Validate form
	fquestionsadd.validate = function() {
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
			<?php if ($questions_add->title->Required) { ?>
				elm = this.getElements("x" + infix + "_title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->title->caption(), $questions_add->title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_add->placeholder->Required) { ?>
				elm = this.getElements("x" + infix + "_placeholder");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->placeholder->caption(), $questions_add->placeholder->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_add->questions->Required) { ?>
				elm = this.getElements("x" + infix + "_questions");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->questions->caption(), $questions_add->questions->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_add->scores->Required) { ?>
				elm = this.getElements("x" + infix + "_scores");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->scores->caption(), $questions_add->scores->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_add->type->Required) { ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->type->caption(), $questions_add->type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_add->section->Required) { ?>
				elm = this.getElements("x" + infix + "_section");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->section->caption(), $questions_add->section->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_section");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_add->section->errorMessage()) ?>");
			<?php if ($questions_add->active->Required) { ?>
				elm = this.getElements("x" + infix + "_active[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->active->caption(), $questions_add->active->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_add->has_recommendations->Required) { ?>
				elm = this.getElements("x" + infix + "_has_recommendations[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->has_recommendations->caption(), $questions_add->has_recommendations->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_add->group->Required) { ?>
				elm = this.getElements("x" + infix + "_group");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->group->caption(), $questions_add->group->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_add->category->Required) { ?>
				elm = this.getElements("x" + infix + "_category");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->category->caption(), $questions_add->category->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_add->order->Required) { ?>
				elm = this.getElements("x" + infix + "_order");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->order->caption(), $questions_add->order->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_order");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_add->order->errorMessage()) ?>");
			<?php if ($questions_add->recommendation_by_score->Required) { ?>
				elm = this.getElements("x" + infix + "_recommendation_by_score");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->recommendation_by_score->caption(), $questions_add->recommendation_by_score->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_add->recommendation_score->Required) { ?>
				elm = this.getElements("x" + infix + "_recommendation_score");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->recommendation_score->caption(), $questions_add->recommendation_score->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recommendation_score");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_add->recommendation_score->errorMessage()) ?>");
			<?php if ($questions_add->related->Required) { ?>
				elm = this.getElements("x" + infix + "_related");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->related->caption(), $questions_add->related->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_related");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_add->related->errorMessage()) ?>");
			<?php if ($questions_add->trigger_related_val->Required) { ?>
				elm = this.getElements("x" + infix + "_trigger_related_val");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_add->trigger_related_val->caption(), $questions_add->trigger_related_val->RequiredErrorMessage)) ?>");
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
	fquestionsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fquestionsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fquestionsadd.lists["x_type"] = <?php echo $questions_add->type->Lookup->toClientList($questions_add) ?>;
	fquestionsadd.lists["x_type"].options = <?php echo JsonEncode($questions_add->type->lookupOptions()) ?>;
	fquestionsadd.lists["x_section"] = <?php echo $questions_add->section->Lookup->toClientList($questions_add) ?>;
	fquestionsadd.lists["x_section"].options = <?php echo JsonEncode($questions_add->section->lookupOptions()) ?>;
	fquestionsadd.autoSuggests["x_section"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fquestionsadd.lists["x_active[]"] = <?php echo $questions_add->active->Lookup->toClientList($questions_add) ?>;
	fquestionsadd.lists["x_active[]"].options = <?php echo JsonEncode($questions_add->active->options(FALSE, TRUE)) ?>;
	fquestionsadd.lists["x_has_recommendations[]"] = <?php echo $questions_add->has_recommendations->Lookup->toClientList($questions_add) ?>;
	fquestionsadd.lists["x_has_recommendations[]"].options = <?php echo JsonEncode($questions_add->has_recommendations->options(FALSE, TRUE)) ?>;
	fquestionsadd.lists["x_group"] = <?php echo $questions_add->group->Lookup->toClientList($questions_add) ?>;
	fquestionsadd.lists["x_group"].options = <?php echo JsonEncode($questions_add->group->lookupOptions()) ?>;
	fquestionsadd.lists["x_category"] = <?php echo $questions_add->category->Lookup->toClientList($questions_add) ?>;
	fquestionsadd.lists["x_category"].options = <?php echo JsonEncode($questions_add->category->lookupOptions()) ?>;
	loadjs.done("fquestionsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $questions_add->showPageHeader(); ?>
<?php
$questions_add->showMessage();
?>
<form name="fquestionsadd" id="fquestionsadd" class="<?php echo $questions_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="questions">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$questions_add->IsModal ?>">
<?php if ($questions->getCurrentMasterTable() == "question_types") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="question_types">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($questions_add->type->getSessionValue()) ?>">
<?php } ?>
<?php if ($questions->getCurrentMasterTable() == "sections") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="sections">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($questions_add->section->getSessionValue()) ?>">
<?php } ?>
<?php if ($questions->getCurrentMasterTable() == "question_groups") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="question_groups">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($questions_add->group->getSessionValue()) ?>">
<?php } ?>
<?php if ($questions->getCurrentMasterTable() == "question_category") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="question_category">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($questions_add->category->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($questions_add->title->Visible) { // title ?>
	<div id="r_title" class="form-group row">
		<label id="elh_questions_title" for="x_title" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->title->caption() ?><?php echo $questions_add->title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->title->cellAttributes() ?>>
<span id="el_questions_title">
<input type="text" data-table="questions" data-field="x_title" name="x_title" id="x_title" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_add->title->getPlaceHolder()) ?>" value="<?php echo $questions_add->title->EditValue ?>"<?php echo $questions_add->title->editAttributes() ?>>
</span>
<?php echo $questions_add->title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->placeholder->Visible) { // placeholder ?>
	<div id="r_placeholder" class="form-group row">
		<label id="elh_questions_placeholder" for="x_placeholder" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->placeholder->caption() ?><?php echo $questions_add->placeholder->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->placeholder->cellAttributes() ?>>
<span id="el_questions_placeholder">
<textarea data-table="questions" data-field="x_placeholder" name="x_placeholder" id="x_placeholder" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_add->placeholder->getPlaceHolder()) ?>"<?php echo $questions_add->placeholder->editAttributes() ?>><?php echo $questions_add->placeholder->EditValue ?></textarea>
</span>
<?php echo $questions_add->placeholder->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->questions->Visible) { // questions ?>
	<div id="r_questions" class="form-group row">
		<label id="elh_questions_questions" for="x_questions" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->questions->caption() ?><?php echo $questions_add->questions->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->questions->cellAttributes() ?>>
<span id="el_questions_questions">
<textarea data-table="questions" data-field="x_questions" name="x_questions" id="x_questions" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_add->questions->getPlaceHolder()) ?>"<?php echo $questions_add->questions->editAttributes() ?>><?php echo $questions_add->questions->EditValue ?></textarea>
</span>
<?php echo $questions_add->questions->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->scores->Visible) { // scores ?>
	<div id="r_scores" class="form-group row">
		<label id="elh_questions_scores" for="x_scores" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->scores->caption() ?><?php echo $questions_add->scores->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->scores->cellAttributes() ?>>
<span id="el_questions_scores">
<textarea data-table="questions" data-field="x_scores" name="x_scores" id="x_scores" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_add->scores->getPlaceHolder()) ?>"<?php echo $questions_add->scores->editAttributes() ?>><?php echo $questions_add->scores->EditValue ?></textarea>
</span>
<?php echo $questions_add->scores->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->type->Visible) { // type ?>
	<div id="r_type" class="form-group row">
		<label id="elh_questions_type" for="x_type" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->type->caption() ?><?php echo $questions_add->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->type->cellAttributes() ?>>
<?php if ($questions_add->type->getSessionValue() != "") { ?>
<span id="el_questions_type">
<span<?php echo $questions_add->type->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_add->type->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_type" name="x_type" value="<?php echo HtmlEncode($questions_add->type->CurrentValue) ?>">
<?php } else { ?>
<span id="el_questions_type">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($questions_add->type->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $questions_add->type->ViewValue ?></button>
		<div id="dsl_x_type" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $questions_add->type->radioButtonListHtml(TRUE, "x_type") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="questions" data-field="x_type" data-value-separator="<?php echo $questions_add->type->displayValueSeparatorAttribute() ?>" name="x_type" id="x_type" value="{value}"<?php echo $questions_add->type->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$questions_add->type->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $questions_add->type->Lookup->getParamTag($questions_add, "p_x_type") ?>
</span>
<?php } ?>
<?php echo $questions_add->type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->section->Visible) { // section ?>
	<div id="r_section" class="form-group row">
		<label id="elh_questions_section" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->section->caption() ?><?php echo $questions_add->section->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->section->cellAttributes() ?>>
<?php if ($questions_add->section->getSessionValue() != "") { ?>
<span id="el_questions_section">
<span<?php echo $questions_add->section->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_add->section->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_section" name="x_section" value="<?php echo HtmlEncode($questions_add->section->CurrentValue) ?>">
<?php } else { ?>
<span id="el_questions_section">
<?php
$onchange = $questions_add->section->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$questions_add->section->EditAttrs["onchange"] = "";
?>
<span id="as_x_section">
	<input type="text" class="form-control" name="sv_x_section" id="sv_x_section" value="<?php echo RemoveHtml($questions_add->section->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_add->section->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($questions_add->section->getPlaceHolder()) ?>"<?php echo $questions_add->section->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions" data-field="x_section" data-value-separator="<?php echo $questions_add->section->displayValueSeparatorAttribute() ?>" name="x_section" id="x_section" value="<?php echo HtmlEncode($questions_add->section->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fquestionsadd"], function() {
	fquestionsadd.createAutoSuggest({"id":"x_section","forceSelect":false});
});
</script>
<?php echo $questions_add->section->Lookup->getParamTag($questions_add, "p_x_section") ?>
</span>
<?php } ?>
<?php echo $questions_add->section->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->active->Visible) { // active ?>
	<div id="r_active" class="form-group row">
		<label id="elh_questions_active" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->active->caption() ?><?php echo $questions_add->active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->active->cellAttributes() ?>>
<span id="el_questions_active">
<?php
$selwrk = ConvertToBool($questions_add->active->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="questions" data-field="x_active" name="x_active[]" id="x_active[]_564032" value="1"<?php echo $selwrk ?><?php echo $questions_add->active->editAttributes() ?>>
	<label class="custom-control-label" for="x_active[]_564032"></label>
</div>
</span>
<?php echo $questions_add->active->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->has_recommendations->Visible) { // has_recommendations ?>
	<div id="r_has_recommendations" class="form-group row">
		<label id="elh_questions_has_recommendations" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->has_recommendations->caption() ?><?php echo $questions_add->has_recommendations->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->has_recommendations->cellAttributes() ?>>
<span id="el_questions_has_recommendations">
<div id="tp_x_has_recommendations" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="questions" data-field="x_has_recommendations" data-value-separator="<?php echo $questions_add->has_recommendations->displayValueSeparatorAttribute() ?>" name="x_has_recommendations[]" id="x_has_recommendations[]" value="{value}"<?php echo $questions_add->has_recommendations->editAttributes() ?>></div>
<div id="dsl_x_has_recommendations" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $questions_add->has_recommendations->checkBoxListHtml(FALSE, "x_has_recommendations[]") ?>
</div></div>
</span>
<?php echo $questions_add->has_recommendations->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->group->Visible) { // group ?>
	<div id="r_group" class="form-group row">
		<label id="elh_questions_group" for="x_group" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->group->caption() ?><?php echo $questions_add->group->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->group->cellAttributes() ?>>
<?php if ($questions_add->group->getSessionValue() != "") { ?>
<span id="el_questions_group">
<span<?php echo $questions_add->group->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_add->group->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_group" name="x_group" value="<?php echo HtmlEncode($questions_add->group->CurrentValue) ?>">
<?php } else { ?>
<span id="el_questions_group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="questions" data-field="x_group" data-value-separator="<?php echo $questions_add->group->displayValueSeparatorAttribute() ?>" id="x_group" name="x_group"<?php echo $questions_add->group->editAttributes() ?>>
			<?php echo $questions_add->group->selectOptionListHtml("x_group") ?>
		</select>
</div>
<?php echo $questions_add->group->Lookup->getParamTag($questions_add, "p_x_group") ?>
</span>
<?php } ?>
<?php echo $questions_add->group->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->category->Visible) { // category ?>
	<div id="r_category" class="form-group row">
		<label id="elh_questions_category" for="x_category" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->category->caption() ?><?php echo $questions_add->category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->category->cellAttributes() ?>>
<?php if ($questions_add->category->getSessionValue() != "") { ?>
<span id="el_questions_category">
<span<?php echo $questions_add->category->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_add->category->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_category" name="x_category" value="<?php echo HtmlEncode($questions_add->category->CurrentValue) ?>">
<?php } else { ?>
<span id="el_questions_category">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="questions" data-field="x_category" data-value-separator="<?php echo $questions_add->category->displayValueSeparatorAttribute() ?>" id="x_category" name="x_category"<?php echo $questions_add->category->editAttributes() ?>>
			<?php echo $questions_add->category->selectOptionListHtml("x_category") ?>
		</select>
</div>
<?php echo $questions_add->category->Lookup->getParamTag($questions_add, "p_x_category") ?>
</span>
<?php } ?>
<?php echo $questions_add->category->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->order->Visible) { // order ?>
	<div id="r_order" class="form-group row">
		<label id="elh_questions_order" for="x_order" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->order->caption() ?><?php echo $questions_add->order->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->order->cellAttributes() ?>>
<span id="el_questions_order">
<input type="text" data-table="questions" data-field="x_order" name="x_order" id="x_order" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_add->order->getPlaceHolder()) ?>" value="<?php echo $questions_add->order->EditValue ?>"<?php echo $questions_add->order->editAttributes() ?>>
</span>
<?php echo $questions_add->order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->recommendation_by_score->Visible) { // recommendation_by_score ?>
	<div id="r_recommendation_by_score" class="form-group row">
		<label id="elh_questions_recommendation_by_score" for="x_recommendation_by_score" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->recommendation_by_score->caption() ?><?php echo $questions_add->recommendation_by_score->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->recommendation_by_score->cellAttributes() ?>>
<span id="el_questions_recommendation_by_score">
<textarea data-table="questions" data-field="x_recommendation_by_score" name="x_recommendation_by_score" id="x_recommendation_by_score" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_add->recommendation_by_score->getPlaceHolder()) ?>"<?php echo $questions_add->recommendation_by_score->editAttributes() ?>><?php echo $questions_add->recommendation_by_score->EditValue ?></textarea>
</span>
<?php echo $questions_add->recommendation_by_score->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->recommendation_score->Visible) { // recommendation_score ?>
	<div id="r_recommendation_score" class="form-group row">
		<label id="elh_questions_recommendation_score" for="x_recommendation_score" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->recommendation_score->caption() ?><?php echo $questions_add->recommendation_score->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->recommendation_score->cellAttributes() ?>>
<span id="el_questions_recommendation_score">
<input type="text" data-table="questions" data-field="x_recommendation_score" name="x_recommendation_score" id="x_recommendation_score" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($questions_add->recommendation_score->getPlaceHolder()) ?>" value="<?php echo $questions_add->recommendation_score->EditValue ?>"<?php echo $questions_add->recommendation_score->editAttributes() ?>>
</span>
<?php echo $questions_add->recommendation_score->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->related->Visible) { // related ?>
	<div id="r_related" class="form-group row">
		<label id="elh_questions_related" for="x_related" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->related->caption() ?><?php echo $questions_add->related->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->related->cellAttributes() ?>>
<span id="el_questions_related">
<input type="text" data-table="questions" data-field="x_related" name="x_related" id="x_related" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_add->related->getPlaceHolder()) ?>" value="<?php echo $questions_add->related->EditValue ?>"<?php echo $questions_add->related->editAttributes() ?>>
</span>
<?php echo $questions_add->related->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_add->trigger_related_val->Visible) { // trigger_related_val ?>
	<div id="r_trigger_related_val" class="form-group row">
		<label id="elh_questions_trigger_related_val" for="x_trigger_related_val" class="<?php echo $questions_add->LeftColumnClass ?>"><?php echo $questions_add->trigger_related_val->caption() ?><?php echo $questions_add->trigger_related_val->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_add->RightColumnClass ?>"><div <?php echo $questions_add->trigger_related_val->cellAttributes() ?>>
<span id="el_questions_trigger_related_val">
<input type="text" data-table="questions" data-field="x_trigger_related_val" name="x_trigger_related_val" id="x_trigger_related_val" size="30" maxlength="128" placeholder="<?php echo HtmlEncode($questions_add->trigger_related_val->getPlaceHolder()) ?>" value="<?php echo $questions_add->trigger_related_val->EditValue ?>"<?php echo $questions_add->trigger_related_val->editAttributes() ?>>
</span>
<?php echo $questions_add->trigger_related_val->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("answers", explode(",", $questions->getCurrentDetailTable())) && $answers->DetailAdd) {
?>
<?php if ($questions->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("answers", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "answersgrid.php" ?>
<?php } ?>
<?php if (!$questions_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $questions_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $questions_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$questions_add->showPageFooter();
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
$questions_add->terminate();
?>
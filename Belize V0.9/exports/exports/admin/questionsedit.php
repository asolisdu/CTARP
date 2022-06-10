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
$questions_edit = new questions_edit();

// Run the page
$questions_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$questions_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fquestionsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fquestionsedit = currentForm = new ew.Form("fquestionsedit", "edit");

	// Validate form
	fquestionsedit.validate = function() {
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
			<?php if ($questions_edit->title->Required) { ?>
				elm = this.getElements("x" + infix + "_title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->title->caption(), $questions_edit->title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_edit->placeholder->Required) { ?>
				elm = this.getElements("x" + infix + "_placeholder");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->placeholder->caption(), $questions_edit->placeholder->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_edit->questions->Required) { ?>
				elm = this.getElements("x" + infix + "_questions");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->questions->caption(), $questions_edit->questions->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_edit->scores->Required) { ?>
				elm = this.getElements("x" + infix + "_scores");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->scores->caption(), $questions_edit->scores->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_edit->type->Required) { ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->type->caption(), $questions_edit->type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_edit->section->Required) { ?>
				elm = this.getElements("x" + infix + "_section");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->section->caption(), $questions_edit->section->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_section");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_edit->section->errorMessage()) ?>");
			<?php if ($questions_edit->active->Required) { ?>
				elm = this.getElements("x" + infix + "_active[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->active->caption(), $questions_edit->active->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_edit->has_recommendations->Required) { ?>
				elm = this.getElements("x" + infix + "_has_recommendations[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->has_recommendations->caption(), $questions_edit->has_recommendations->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_edit->group->Required) { ?>
				elm = this.getElements("x" + infix + "_group");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->group->caption(), $questions_edit->group->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_edit->category->Required) { ?>
				elm = this.getElements("x" + infix + "_category");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->category->caption(), $questions_edit->category->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_edit->order->Required) { ?>
				elm = this.getElements("x" + infix + "_order");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->order->caption(), $questions_edit->order->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_order");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_edit->order->errorMessage()) ?>");
			<?php if ($questions_edit->recommendation_by_score->Required) { ?>
				elm = this.getElements("x" + infix + "_recommendation_by_score");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->recommendation_by_score->caption(), $questions_edit->recommendation_by_score->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_edit->recommendation_score->Required) { ?>
				elm = this.getElements("x" + infix + "_recommendation_score");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->recommendation_score->caption(), $questions_edit->recommendation_score->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recommendation_score");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_edit->recommendation_score->errorMessage()) ?>");
			<?php if ($questions_edit->related->Required) { ?>
				elm = this.getElements("x" + infix + "_related");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->related->caption(), $questions_edit->related->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_related");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_edit->related->errorMessage()) ?>");
			<?php if ($questions_edit->trigger_related_val->Required) { ?>
				elm = this.getElements("x" + infix + "_trigger_related_val");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_edit->trigger_related_val->caption(), $questions_edit->trigger_related_val->RequiredErrorMessage)) ?>");
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
	fquestionsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fquestionsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fquestionsedit.lists["x_type"] = <?php echo $questions_edit->type->Lookup->toClientList($questions_edit) ?>;
	fquestionsedit.lists["x_type"].options = <?php echo JsonEncode($questions_edit->type->lookupOptions()) ?>;
	fquestionsedit.lists["x_section"] = <?php echo $questions_edit->section->Lookup->toClientList($questions_edit) ?>;
	fquestionsedit.lists["x_section"].options = <?php echo JsonEncode($questions_edit->section->lookupOptions()) ?>;
	fquestionsedit.autoSuggests["x_section"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fquestionsedit.lists["x_active[]"] = <?php echo $questions_edit->active->Lookup->toClientList($questions_edit) ?>;
	fquestionsedit.lists["x_active[]"].options = <?php echo JsonEncode($questions_edit->active->options(FALSE, TRUE)) ?>;
	fquestionsedit.lists["x_has_recommendations[]"] = <?php echo $questions_edit->has_recommendations->Lookup->toClientList($questions_edit) ?>;
	fquestionsedit.lists["x_has_recommendations[]"].options = <?php echo JsonEncode($questions_edit->has_recommendations->options(FALSE, TRUE)) ?>;
	fquestionsedit.lists["x_group"] = <?php echo $questions_edit->group->Lookup->toClientList($questions_edit) ?>;
	fquestionsedit.lists["x_group"].options = <?php echo JsonEncode($questions_edit->group->lookupOptions()) ?>;
	fquestionsedit.lists["x_category"] = <?php echo $questions_edit->category->Lookup->toClientList($questions_edit) ?>;
	fquestionsedit.lists["x_category"].options = <?php echo JsonEncode($questions_edit->category->lookupOptions()) ?>;
	loadjs.done("fquestionsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $questions_edit->showPageHeader(); ?>
<?php
$questions_edit->showMessage();
?>
<form name="fquestionsedit" id="fquestionsedit" class="<?php echo $questions_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="questions">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$questions_edit->IsModal ?>">
<?php if ($questions->getCurrentMasterTable() == "question_types") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="question_types">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($questions_edit->type->getSessionValue()) ?>">
<?php } ?>
<?php if ($questions->getCurrentMasterTable() == "sections") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="sections">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($questions_edit->section->getSessionValue()) ?>">
<?php } ?>
<?php if ($questions->getCurrentMasterTable() == "question_groups") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="question_groups">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($questions_edit->group->getSessionValue()) ?>">
<?php } ?>
<?php if ($questions->getCurrentMasterTable() == "question_category") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="question_category">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($questions_edit->category->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($questions_edit->title->Visible) { // title ?>
	<div id="r_title" class="form-group row">
		<label id="elh_questions_title" for="x_title" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->title->caption() ?><?php echo $questions_edit->title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->title->cellAttributes() ?>>
<span id="el_questions_title">
<input type="text" data-table="questions" data-field="x_title" name="x_title" id="x_title" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_edit->title->getPlaceHolder()) ?>" value="<?php echo $questions_edit->title->EditValue ?>"<?php echo $questions_edit->title->editAttributes() ?>>
</span>
<?php echo $questions_edit->title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->placeholder->Visible) { // placeholder ?>
	<div id="r_placeholder" class="form-group row">
		<label id="elh_questions_placeholder" for="x_placeholder" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->placeholder->caption() ?><?php echo $questions_edit->placeholder->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->placeholder->cellAttributes() ?>>
<span id="el_questions_placeholder">
<textarea data-table="questions" data-field="x_placeholder" name="x_placeholder" id="x_placeholder" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_edit->placeholder->getPlaceHolder()) ?>"<?php echo $questions_edit->placeholder->editAttributes() ?>><?php echo $questions_edit->placeholder->EditValue ?></textarea>
</span>
<?php echo $questions_edit->placeholder->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->questions->Visible) { // questions ?>
	<div id="r_questions" class="form-group row">
		<label id="elh_questions_questions" for="x_questions" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->questions->caption() ?><?php echo $questions_edit->questions->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->questions->cellAttributes() ?>>
<span id="el_questions_questions">
<textarea data-table="questions" data-field="x_questions" name="x_questions" id="x_questions" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_edit->questions->getPlaceHolder()) ?>"<?php echo $questions_edit->questions->editAttributes() ?>><?php echo $questions_edit->questions->EditValue ?></textarea>
</span>
<?php echo $questions_edit->questions->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->scores->Visible) { // scores ?>
	<div id="r_scores" class="form-group row">
		<label id="elh_questions_scores" for="x_scores" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->scores->caption() ?><?php echo $questions_edit->scores->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->scores->cellAttributes() ?>>
<span id="el_questions_scores">
<textarea data-table="questions" data-field="x_scores" name="x_scores" id="x_scores" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_edit->scores->getPlaceHolder()) ?>"<?php echo $questions_edit->scores->editAttributes() ?>><?php echo $questions_edit->scores->EditValue ?></textarea>
</span>
<?php echo $questions_edit->scores->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->type->Visible) { // type ?>
	<div id="r_type" class="form-group row">
		<label id="elh_questions_type" for="x_type" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->type->caption() ?><?php echo $questions_edit->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->type->cellAttributes() ?>>
<?php if ($questions_edit->type->getSessionValue() != "") { ?>
<span id="el_questions_type">
<span<?php echo $questions_edit->type->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_edit->type->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_type" name="x_type" value="<?php echo HtmlEncode($questions_edit->type->CurrentValue) ?>">
<?php } else { ?>
<span id="el_questions_type">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($questions_edit->type->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $questions_edit->type->ViewValue ?></button>
		<div id="dsl_x_type" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $questions_edit->type->radioButtonListHtml(TRUE, "x_type") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="questions" data-field="x_type" data-value-separator="<?php echo $questions_edit->type->displayValueSeparatorAttribute() ?>" name="x_type" id="x_type" value="{value}"<?php echo $questions_edit->type->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$questions_edit->type->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $questions_edit->type->Lookup->getParamTag($questions_edit, "p_x_type") ?>
</span>
<?php } ?>
<?php echo $questions_edit->type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->section->Visible) { // section ?>
	<div id="r_section" class="form-group row">
		<label id="elh_questions_section" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->section->caption() ?><?php echo $questions_edit->section->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->section->cellAttributes() ?>>
<?php if ($questions_edit->section->getSessionValue() != "") { ?>
<span id="el_questions_section">
<span<?php echo $questions_edit->section->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_edit->section->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_section" name="x_section" value="<?php echo HtmlEncode($questions_edit->section->CurrentValue) ?>">
<?php } else { ?>
<span id="el_questions_section">
<?php
$onchange = $questions_edit->section->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$questions_edit->section->EditAttrs["onchange"] = "";
?>
<span id="as_x_section">
	<input type="text" class="form-control" name="sv_x_section" id="sv_x_section" value="<?php echo RemoveHtml($questions_edit->section->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_edit->section->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($questions_edit->section->getPlaceHolder()) ?>"<?php echo $questions_edit->section->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions" data-field="x_section" data-value-separator="<?php echo $questions_edit->section->displayValueSeparatorAttribute() ?>" name="x_section" id="x_section" value="<?php echo HtmlEncode($questions_edit->section->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fquestionsedit"], function() {
	fquestionsedit.createAutoSuggest({"id":"x_section","forceSelect":false});
});
</script>
<?php echo $questions_edit->section->Lookup->getParamTag($questions_edit, "p_x_section") ?>
</span>
<?php } ?>
<?php echo $questions_edit->section->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->active->Visible) { // active ?>
	<div id="r_active" class="form-group row">
		<label id="elh_questions_active" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->active->caption() ?><?php echo $questions_edit->active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->active->cellAttributes() ?>>
<span id="el_questions_active">
<?php
$selwrk = ConvertToBool($questions_edit->active->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="questions" data-field="x_active" name="x_active[]" id="x_active[]_734832" value="1"<?php echo $selwrk ?><?php echo $questions_edit->active->editAttributes() ?>>
	<label class="custom-control-label" for="x_active[]_734832"></label>
</div>
</span>
<?php echo $questions_edit->active->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->has_recommendations->Visible) { // has_recommendations ?>
	<div id="r_has_recommendations" class="form-group row">
		<label id="elh_questions_has_recommendations" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->has_recommendations->caption() ?><?php echo $questions_edit->has_recommendations->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->has_recommendations->cellAttributes() ?>>
<span id="el_questions_has_recommendations">
<div id="tp_x_has_recommendations" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="questions" data-field="x_has_recommendations" data-value-separator="<?php echo $questions_edit->has_recommendations->displayValueSeparatorAttribute() ?>" name="x_has_recommendations[]" id="x_has_recommendations[]" value="{value}"<?php echo $questions_edit->has_recommendations->editAttributes() ?>></div>
<div id="dsl_x_has_recommendations" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $questions_edit->has_recommendations->checkBoxListHtml(FALSE, "x_has_recommendations[]") ?>
</div></div>
</span>
<?php echo $questions_edit->has_recommendations->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->group->Visible) { // group ?>
	<div id="r_group" class="form-group row">
		<label id="elh_questions_group" for="x_group" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->group->caption() ?><?php echo $questions_edit->group->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->group->cellAttributes() ?>>
<?php if ($questions_edit->group->getSessionValue() != "") { ?>
<span id="el_questions_group">
<span<?php echo $questions_edit->group->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_edit->group->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_group" name="x_group" value="<?php echo HtmlEncode($questions_edit->group->CurrentValue) ?>">
<?php } else { ?>
<span id="el_questions_group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="questions" data-field="x_group" data-value-separator="<?php echo $questions_edit->group->displayValueSeparatorAttribute() ?>" id="x_group" name="x_group"<?php echo $questions_edit->group->editAttributes() ?>>
			<?php echo $questions_edit->group->selectOptionListHtml("x_group") ?>
		</select>
</div>
<?php echo $questions_edit->group->Lookup->getParamTag($questions_edit, "p_x_group") ?>
</span>
<?php } ?>
<?php echo $questions_edit->group->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->category->Visible) { // category ?>
	<div id="r_category" class="form-group row">
		<label id="elh_questions_category" for="x_category" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->category->caption() ?><?php echo $questions_edit->category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->category->cellAttributes() ?>>
<?php if ($questions_edit->category->getSessionValue() != "") { ?>
<span id="el_questions_category">
<span<?php echo $questions_edit->category->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_edit->category->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_category" name="x_category" value="<?php echo HtmlEncode($questions_edit->category->CurrentValue) ?>">
<?php } else { ?>
<span id="el_questions_category">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="questions" data-field="x_category" data-value-separator="<?php echo $questions_edit->category->displayValueSeparatorAttribute() ?>" id="x_category" name="x_category"<?php echo $questions_edit->category->editAttributes() ?>>
			<?php echo $questions_edit->category->selectOptionListHtml("x_category") ?>
		</select>
</div>
<?php echo $questions_edit->category->Lookup->getParamTag($questions_edit, "p_x_category") ?>
</span>
<?php } ?>
<?php echo $questions_edit->category->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->order->Visible) { // order ?>
	<div id="r_order" class="form-group row">
		<label id="elh_questions_order" for="x_order" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->order->caption() ?><?php echo $questions_edit->order->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->order->cellAttributes() ?>>
<span id="el_questions_order">
<input type="text" data-table="questions" data-field="x_order" name="x_order" id="x_order" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_edit->order->getPlaceHolder()) ?>" value="<?php echo $questions_edit->order->EditValue ?>"<?php echo $questions_edit->order->editAttributes() ?>>
</span>
<?php echo $questions_edit->order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->recommendation_by_score->Visible) { // recommendation_by_score ?>
	<div id="r_recommendation_by_score" class="form-group row">
		<label id="elh_questions_recommendation_by_score" for="x_recommendation_by_score" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->recommendation_by_score->caption() ?><?php echo $questions_edit->recommendation_by_score->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->recommendation_by_score->cellAttributes() ?>>
<span id="el_questions_recommendation_by_score">
<textarea data-table="questions" data-field="x_recommendation_by_score" name="x_recommendation_by_score" id="x_recommendation_by_score" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_edit->recommendation_by_score->getPlaceHolder()) ?>"<?php echo $questions_edit->recommendation_by_score->editAttributes() ?>><?php echo $questions_edit->recommendation_by_score->EditValue ?></textarea>
</span>
<?php echo $questions_edit->recommendation_by_score->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->recommendation_score->Visible) { // recommendation_score ?>
	<div id="r_recommendation_score" class="form-group row">
		<label id="elh_questions_recommendation_score" for="x_recommendation_score" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->recommendation_score->caption() ?><?php echo $questions_edit->recommendation_score->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->recommendation_score->cellAttributes() ?>>
<span id="el_questions_recommendation_score">
<input type="text" data-table="questions" data-field="x_recommendation_score" name="x_recommendation_score" id="x_recommendation_score" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($questions_edit->recommendation_score->getPlaceHolder()) ?>" value="<?php echo $questions_edit->recommendation_score->EditValue ?>"<?php echo $questions_edit->recommendation_score->editAttributes() ?>>
</span>
<?php echo $questions_edit->recommendation_score->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->related->Visible) { // related ?>
	<div id="r_related" class="form-group row">
		<label id="elh_questions_related" for="x_related" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->related->caption() ?><?php echo $questions_edit->related->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->related->cellAttributes() ?>>
<span id="el_questions_related">
<input type="text" data-table="questions" data-field="x_related" name="x_related" id="x_related" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_edit->related->getPlaceHolder()) ?>" value="<?php echo $questions_edit->related->EditValue ?>"<?php echo $questions_edit->related->editAttributes() ?>>
</span>
<?php echo $questions_edit->related->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($questions_edit->trigger_related_val->Visible) { // trigger_related_val ?>
	<div id="r_trigger_related_val" class="form-group row">
		<label id="elh_questions_trigger_related_val" for="x_trigger_related_val" class="<?php echo $questions_edit->LeftColumnClass ?>"><?php echo $questions_edit->trigger_related_val->caption() ?><?php echo $questions_edit->trigger_related_val->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $questions_edit->RightColumnClass ?>"><div <?php echo $questions_edit->trigger_related_val->cellAttributes() ?>>
<span id="el_questions_trigger_related_val">
<input type="text" data-table="questions" data-field="x_trigger_related_val" name="x_trigger_related_val" id="x_trigger_related_val" size="30" maxlength="128" placeholder="<?php echo HtmlEncode($questions_edit->trigger_related_val->getPlaceHolder()) ?>" value="<?php echo $questions_edit->trigger_related_val->EditValue ?>"<?php echo $questions_edit->trigger_related_val->editAttributes() ?>>
</span>
<?php echo $questions_edit->trigger_related_val->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="questions" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($questions_edit->id->CurrentValue) ?>">
<?php
	if (in_array("answers", explode(",", $questions->getCurrentDetailTable())) && $answers->DetailEdit) {
?>
<?php if ($questions->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("answers", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "answersgrid.php" ?>
<?php } ?>
<?php if (!$questions_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $questions_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $questions_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$questions_edit->showPageFooter();
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
$questions_edit->terminate();
?>
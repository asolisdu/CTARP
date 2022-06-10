<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($questions_grid))
	$questions_grid = new questions_grid();

// Run the page
$questions_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$questions_grid->Page_Render();
?>
<?php if (!$questions_grid->isExport()) { ?>
<script>
var fquestionsgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fquestionsgrid = new ew.Form("fquestionsgrid", "grid");
	fquestionsgrid.formKeyCountName = '<?php echo $questions_grid->FormKeyCountName ?>';

	// Validate form
	fquestionsgrid.validate = function() {
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
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($questions_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->id->caption(), $questions_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_grid->title->Required) { ?>
				elm = this.getElements("x" + infix + "_title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->title->caption(), $questions_grid->title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_grid->placeholder->Required) { ?>
				elm = this.getElements("x" + infix + "_placeholder");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->placeholder->caption(), $questions_grid->placeholder->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_grid->questions->Required) { ?>
				elm = this.getElements("x" + infix + "_questions");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->questions->caption(), $questions_grid->questions->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_grid->scores->Required) { ?>
				elm = this.getElements("x" + infix + "_scores");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->scores->caption(), $questions_grid->scores->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_grid->type->Required) { ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->type->caption(), $questions_grid->type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_grid->section->Required) { ?>
				elm = this.getElements("x" + infix + "_section");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->section->caption(), $questions_grid->section->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_section");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_grid->section->errorMessage()) ?>");
			<?php if ($questions_grid->active->Required) { ?>
				elm = this.getElements("x" + infix + "_active[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->active->caption(), $questions_grid->active->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_grid->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->created_at->caption(), $questions_grid->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_grid->created_at->errorMessage()) ?>");
			<?php if ($questions_grid->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->updated_at->caption(), $questions_grid->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_grid->updated_at->errorMessage()) ?>");
			<?php if ($questions_grid->has_recommendations->Required) { ?>
				elm = this.getElements("x" + infix + "_has_recommendations[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->has_recommendations->caption(), $questions_grid->has_recommendations->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_grid->group->Required) { ?>
				elm = this.getElements("x" + infix + "_group");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->group->caption(), $questions_grid->group->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_grid->category->Required) { ?>
				elm = this.getElements("x" + infix + "_category");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->category->caption(), $questions_grid->category->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($questions_grid->order->Required) { ?>
				elm = this.getElements("x" + infix + "_order");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->order->caption(), $questions_grid->order->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_order");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_grid->order->errorMessage()) ?>");
			<?php if ($questions_grid->recommendation_score->Required) { ?>
				elm = this.getElements("x" + infix + "_recommendation_score");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->recommendation_score->caption(), $questions_grid->recommendation_score->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recommendation_score");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_grid->recommendation_score->errorMessage()) ?>");
			<?php if ($questions_grid->related->Required) { ?>
				elm = this.getElements("x" + infix + "_related");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->related->caption(), $questions_grid->related->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_related");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($questions_grid->related->errorMessage()) ?>");
			<?php if ($questions_grid->trigger_related_val->Required) { ?>
				elm = this.getElements("x" + infix + "_trigger_related_val");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $questions_grid->trigger_related_val->caption(), $questions_grid->trigger_related_val->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fquestionsgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "title", false)) return false;
		if (ew.valueChanged(fobj, infix, "placeholder", false)) return false;
		if (ew.valueChanged(fobj, infix, "questions", false)) return false;
		if (ew.valueChanged(fobj, infix, "scores", false)) return false;
		if (ew.valueChanged(fobj, infix, "type", false)) return false;
		if (ew.valueChanged(fobj, infix, "section", false)) return false;
		if (ew.valueChanged(fobj, infix, "active[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "created_at", false)) return false;
		if (ew.valueChanged(fobj, infix, "updated_at", false)) return false;
		if (ew.valueChanged(fobj, infix, "has_recommendations[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "group", false)) return false;
		if (ew.valueChanged(fobj, infix, "category", false)) return false;
		if (ew.valueChanged(fobj, infix, "order", false)) return false;
		if (ew.valueChanged(fobj, infix, "recommendation_score", false)) return false;
		if (ew.valueChanged(fobj, infix, "related", false)) return false;
		if (ew.valueChanged(fobj, infix, "trigger_related_val", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fquestionsgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fquestionsgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fquestionsgrid.lists["x_type"] = <?php echo $questions_grid->type->Lookup->toClientList($questions_grid) ?>;
	fquestionsgrid.lists["x_type"].options = <?php echo JsonEncode($questions_grid->type->lookupOptions()) ?>;
	fquestionsgrid.lists["x_section"] = <?php echo $questions_grid->section->Lookup->toClientList($questions_grid) ?>;
	fquestionsgrid.lists["x_section"].options = <?php echo JsonEncode($questions_grid->section->lookupOptions()) ?>;
	fquestionsgrid.autoSuggests["x_section"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fquestionsgrid.lists["x_active[]"] = <?php echo $questions_grid->active->Lookup->toClientList($questions_grid) ?>;
	fquestionsgrid.lists["x_active[]"].options = <?php echo JsonEncode($questions_grid->active->options(FALSE, TRUE)) ?>;
	fquestionsgrid.lists["x_has_recommendations[]"] = <?php echo $questions_grid->has_recommendations->Lookup->toClientList($questions_grid) ?>;
	fquestionsgrid.lists["x_has_recommendations[]"].options = <?php echo JsonEncode($questions_grid->has_recommendations->options(FALSE, TRUE)) ?>;
	fquestionsgrid.lists["x_group"] = <?php echo $questions_grid->group->Lookup->toClientList($questions_grid) ?>;
	fquestionsgrid.lists["x_group"].options = <?php echo JsonEncode($questions_grid->group->lookupOptions()) ?>;
	fquestionsgrid.lists["x_category"] = <?php echo $questions_grid->category->Lookup->toClientList($questions_grid) ?>;
	fquestionsgrid.lists["x_category"].options = <?php echo JsonEncode($questions_grid->category->lookupOptions()) ?>;
	loadjs.done("fquestionsgrid");
});
</script>
<?php } ?>
<?php
$questions_grid->renderOtherOptions();
?>
<?php if ($questions_grid->TotalRecords > 0 || $questions->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($questions_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> questions">
<?php if ($questions_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $questions_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fquestionsgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_questions" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_questionsgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$questions->RowType = ROWTYPE_HEADER;

// Render list options
$questions_grid->renderListOptions();

// Render list options (header, left)
$questions_grid->ListOptions->render("header", "left");
?>
<?php if ($questions_grid->id->Visible) { // id ?>
	<?php if ($questions_grid->SortUrl($questions_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $questions_grid->id->headerCellClass() ?>"><div id="elh_questions_id" class="questions_id"><div class="ew-table-header-caption"><?php echo $questions_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $questions_grid->id->headerCellClass() ?>"><div><div id="elh_questions_id" class="questions_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->title->Visible) { // title ?>
	<?php if ($questions_grid->SortUrl($questions_grid->title) == "") { ?>
		<th data-name="title" class="<?php echo $questions_grid->title->headerCellClass() ?>"><div id="elh_questions_title" class="questions_title"><div class="ew-table-header-caption"><?php echo $questions_grid->title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="title" class="<?php echo $questions_grid->title->headerCellClass() ?>"><div><div id="elh_questions_title" class="questions_title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->title->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->placeholder->Visible) { // placeholder ?>
	<?php if ($questions_grid->SortUrl($questions_grid->placeholder) == "") { ?>
		<th data-name="placeholder" class="<?php echo $questions_grid->placeholder->headerCellClass() ?>"><div id="elh_questions_placeholder" class="questions_placeholder"><div class="ew-table-header-caption"><?php echo $questions_grid->placeholder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="placeholder" class="<?php echo $questions_grid->placeholder->headerCellClass() ?>"><div><div id="elh_questions_placeholder" class="questions_placeholder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->placeholder->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->placeholder->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->placeholder->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->questions->Visible) { // questions ?>
	<?php if ($questions_grid->SortUrl($questions_grid->questions) == "") { ?>
		<th data-name="questions" class="<?php echo $questions_grid->questions->headerCellClass() ?>"><div id="elh_questions_questions" class="questions_questions"><div class="ew-table-header-caption"><?php echo $questions_grid->questions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="questions" class="<?php echo $questions_grid->questions->headerCellClass() ?>"><div><div id="elh_questions_questions" class="questions_questions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->questions->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->questions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->questions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->scores->Visible) { // scores ?>
	<?php if ($questions_grid->SortUrl($questions_grid->scores) == "") { ?>
		<th data-name="scores" class="<?php echo $questions_grid->scores->headerCellClass() ?>"><div id="elh_questions_scores" class="questions_scores"><div class="ew-table-header-caption"><?php echo $questions_grid->scores->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="scores" class="<?php echo $questions_grid->scores->headerCellClass() ?>"><div><div id="elh_questions_scores" class="questions_scores">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->scores->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->scores->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->scores->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->type->Visible) { // type ?>
	<?php if ($questions_grid->SortUrl($questions_grid->type) == "") { ?>
		<th data-name="type" class="<?php echo $questions_grid->type->headerCellClass() ?>"><div id="elh_questions_type" class="questions_type"><div class="ew-table-header-caption"><?php echo $questions_grid->type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type" class="<?php echo $questions_grid->type->headerCellClass() ?>"><div><div id="elh_questions_type" class="questions_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->type->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->section->Visible) { // section ?>
	<?php if ($questions_grid->SortUrl($questions_grid->section) == "") { ?>
		<th data-name="section" class="<?php echo $questions_grid->section->headerCellClass() ?>"><div id="elh_questions_section" class="questions_section"><div class="ew-table-header-caption"><?php echo $questions_grid->section->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="section" class="<?php echo $questions_grid->section->headerCellClass() ?>"><div><div id="elh_questions_section" class="questions_section">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->section->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->section->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->section->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->active->Visible) { // active ?>
	<?php if ($questions_grid->SortUrl($questions_grid->active) == "") { ?>
		<th data-name="active" class="<?php echo $questions_grid->active->headerCellClass() ?>"><div id="elh_questions_active" class="questions_active"><div class="ew-table-header-caption"><?php echo $questions_grid->active->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="active" class="<?php echo $questions_grid->active->headerCellClass() ?>"><div><div id="elh_questions_active" class="questions_active">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->active->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->active->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->active->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->created_at->Visible) { // created_at ?>
	<?php if ($questions_grid->SortUrl($questions_grid->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $questions_grid->created_at->headerCellClass() ?>"><div id="elh_questions_created_at" class="questions_created_at"><div class="ew-table-header-caption"><?php echo $questions_grid->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $questions_grid->created_at->headerCellClass() ?>"><div><div id="elh_questions_created_at" class="questions_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->updated_at->Visible) { // updated_at ?>
	<?php if ($questions_grid->SortUrl($questions_grid->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $questions_grid->updated_at->headerCellClass() ?>"><div id="elh_questions_updated_at" class="questions_updated_at"><div class="ew-table-header-caption"><?php echo $questions_grid->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $questions_grid->updated_at->headerCellClass() ?>"><div><div id="elh_questions_updated_at" class="questions_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->has_recommendations->Visible) { // has_recommendations ?>
	<?php if ($questions_grid->SortUrl($questions_grid->has_recommendations) == "") { ?>
		<th data-name="has_recommendations" class="<?php echo $questions_grid->has_recommendations->headerCellClass() ?>"><div id="elh_questions_has_recommendations" class="questions_has_recommendations"><div class="ew-table-header-caption"><?php echo $questions_grid->has_recommendations->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="has_recommendations" class="<?php echo $questions_grid->has_recommendations->headerCellClass() ?>"><div><div id="elh_questions_has_recommendations" class="questions_has_recommendations">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->has_recommendations->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->has_recommendations->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->has_recommendations->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->group->Visible) { // group ?>
	<?php if ($questions_grid->SortUrl($questions_grid->group) == "") { ?>
		<th data-name="group" class="<?php echo $questions_grid->group->headerCellClass() ?>"><div id="elh_questions_group" class="questions_group"><div class="ew-table-header-caption"><?php echo $questions_grid->group->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="group" class="<?php echo $questions_grid->group->headerCellClass() ?>"><div><div id="elh_questions_group" class="questions_group">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->group->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->group->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->group->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->category->Visible) { // category ?>
	<?php if ($questions_grid->SortUrl($questions_grid->category) == "") { ?>
		<th data-name="category" class="<?php echo $questions_grid->category->headerCellClass() ?>"><div id="elh_questions_category" class="questions_category"><div class="ew-table-header-caption"><?php echo $questions_grid->category->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="category" class="<?php echo $questions_grid->category->headerCellClass() ?>"><div><div id="elh_questions_category" class="questions_category">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->category->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->category->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->category->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->order->Visible) { // order ?>
	<?php if ($questions_grid->SortUrl($questions_grid->order) == "") { ?>
		<th data-name="order" class="<?php echo $questions_grid->order->headerCellClass() ?>"><div id="elh_questions_order" class="questions_order"><div class="ew-table-header-caption"><?php echo $questions_grid->order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order" class="<?php echo $questions_grid->order->headerCellClass() ?>"><div><div id="elh_questions_order" class="questions_order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->order->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->order->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->order->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->recommendation_score->Visible) { // recommendation_score ?>
	<?php if ($questions_grid->SortUrl($questions_grid->recommendation_score) == "") { ?>
		<th data-name="recommendation_score" class="<?php echo $questions_grid->recommendation_score->headerCellClass() ?>"><div id="elh_questions_recommendation_score" class="questions_recommendation_score"><div class="ew-table-header-caption"><?php echo $questions_grid->recommendation_score->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="recommendation_score" class="<?php echo $questions_grid->recommendation_score->headerCellClass() ?>"><div><div id="elh_questions_recommendation_score" class="questions_recommendation_score">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->recommendation_score->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->recommendation_score->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->recommendation_score->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->related->Visible) { // related ?>
	<?php if ($questions_grid->SortUrl($questions_grid->related) == "") { ?>
		<th data-name="related" class="<?php echo $questions_grid->related->headerCellClass() ?>"><div id="elh_questions_related" class="questions_related"><div class="ew-table-header-caption"><?php echo $questions_grid->related->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="related" class="<?php echo $questions_grid->related->headerCellClass() ?>"><div><div id="elh_questions_related" class="questions_related">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->related->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->related->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->related->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_grid->trigger_related_val->Visible) { // trigger_related_val ?>
	<?php if ($questions_grid->SortUrl($questions_grid->trigger_related_val) == "") { ?>
		<th data-name="trigger_related_val" class="<?php echo $questions_grid->trigger_related_val->headerCellClass() ?>"><div id="elh_questions_trigger_related_val" class="questions_trigger_related_val"><div class="ew-table-header-caption"><?php echo $questions_grid->trigger_related_val->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="trigger_related_val" class="<?php echo $questions_grid->trigger_related_val->headerCellClass() ?>"><div><div id="elh_questions_trigger_related_val" class="questions_trigger_related_val">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_grid->trigger_related_val->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_grid->trigger_related_val->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_grid->trigger_related_val->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$questions_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$questions_grid->StartRecord = 1;
$questions_grid->StopRecord = $questions_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($questions->isConfirm() || $questions_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($questions_grid->FormKeyCountName) && ($questions_grid->isGridAdd() || $questions_grid->isGridEdit() || $questions->isConfirm())) {
		$questions_grid->KeyCount = $CurrentForm->getValue($questions_grid->FormKeyCountName);
		$questions_grid->StopRecord = $questions_grid->StartRecord + $questions_grid->KeyCount - 1;
	}
}
$questions_grid->RecordCount = $questions_grid->StartRecord - 1;
if ($questions_grid->Recordset && !$questions_grid->Recordset->EOF) {
	$questions_grid->Recordset->moveFirst();
	$selectLimit = $questions_grid->UseSelectLimit;
	if (!$selectLimit && $questions_grid->StartRecord > 1)
		$questions_grid->Recordset->move($questions_grid->StartRecord - 1);
} elseif (!$questions->AllowAddDeleteRow && $questions_grid->StopRecord == 0) {
	$questions_grid->StopRecord = $questions->GridAddRowCount;
}

// Initialize aggregate
$questions->RowType = ROWTYPE_AGGREGATEINIT;
$questions->resetAttributes();
$questions_grid->renderRow();
if ($questions_grid->isGridAdd())
	$questions_grid->RowIndex = 0;
if ($questions_grid->isGridEdit())
	$questions_grid->RowIndex = 0;
while ($questions_grid->RecordCount < $questions_grid->StopRecord) {
	$questions_grid->RecordCount++;
	if ($questions_grid->RecordCount >= $questions_grid->StartRecord) {
		$questions_grid->RowCount++;
		if ($questions_grid->isGridAdd() || $questions_grid->isGridEdit() || $questions->isConfirm()) {
			$questions_grid->RowIndex++;
			$CurrentForm->Index = $questions_grid->RowIndex;
			if ($CurrentForm->hasValue($questions_grid->FormActionName) && ($questions->isConfirm() || $questions_grid->EventCancelled))
				$questions_grid->RowAction = strval($CurrentForm->getValue($questions_grid->FormActionName));
			elseif ($questions_grid->isGridAdd())
				$questions_grid->RowAction = "insert";
			else
				$questions_grid->RowAction = "";
		}

		// Set up key count
		$questions_grid->KeyCount = $questions_grid->RowIndex;

		// Init row class and style
		$questions->resetAttributes();
		$questions->CssClass = "";
		if ($questions_grid->isGridAdd()) {
			if ($questions->CurrentMode == "copy") {
				$questions_grid->loadRowValues($questions_grid->Recordset); // Load row values
				$questions_grid->setRecordKey($questions_grid->RowOldKey, $questions_grid->Recordset); // Set old record key
			} else {
				$questions_grid->loadRowValues(); // Load default values
				$questions_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$questions_grid->loadRowValues($questions_grid->Recordset); // Load row values
		}
		$questions->RowType = ROWTYPE_VIEW; // Render view
		if ($questions_grid->isGridAdd()) // Grid add
			$questions->RowType = ROWTYPE_ADD; // Render add
		if ($questions_grid->isGridAdd() && $questions->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$questions_grid->restoreCurrentRowFormValues($questions_grid->RowIndex); // Restore form values
		if ($questions_grid->isGridEdit()) { // Grid edit
			if ($questions->EventCancelled)
				$questions_grid->restoreCurrentRowFormValues($questions_grid->RowIndex); // Restore form values
			if ($questions_grid->RowAction == "insert")
				$questions->RowType = ROWTYPE_ADD; // Render add
			else
				$questions->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($questions_grid->isGridEdit() && ($questions->RowType == ROWTYPE_EDIT || $questions->RowType == ROWTYPE_ADD) && $questions->EventCancelled) // Update failed
			$questions_grid->restoreCurrentRowFormValues($questions_grid->RowIndex); // Restore form values
		if ($questions->RowType == ROWTYPE_EDIT) // Edit row
			$questions_grid->EditRowCount++;
		if ($questions->isConfirm()) // Confirm row
			$questions_grid->restoreCurrentRowFormValues($questions_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$questions->RowAttrs->merge(["data-rowindex" => $questions_grid->RowCount, "id" => "r" . $questions_grid->RowCount . "_questions", "data-rowtype" => $questions->RowType]);

		// Render row
		$questions_grid->renderRow();

		// Render list options
		$questions_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($questions_grid->RowAction != "delete" && $questions_grid->RowAction != "insertdelete" && !($questions_grid->RowAction == "insert" && $questions->isConfirm() && $questions_grid->emptyRow())) {
?>
	<tr <?php echo $questions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$questions_grid->ListOptions->render("body", "left", $questions_grid->RowCount);
?>
	<?php if ($questions_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $questions_grid->id->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_id" class="form-group"></span>
<input type="hidden" data-table="questions" data-field="x_id" name="o<?php echo $questions_grid->RowIndex ?>_id" id="o<?php echo $questions_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($questions_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_id" class="form-group">
<span<?php echo $questions_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_id" name="x<?php echo $questions_grid->RowIndex ?>_id" id="x<?php echo $questions_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($questions_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_id">
<span<?php echo $questions_grid->id->viewAttributes() ?>><?php echo $questions_grid->id->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_id" name="x<?php echo $questions_grid->RowIndex ?>_id" id="x<?php echo $questions_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($questions_grid->id->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_id" name="o<?php echo $questions_grid->RowIndex ?>_id" id="o<?php echo $questions_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($questions_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_id" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_id" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($questions_grid->id->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_id" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_id" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($questions_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->title->Visible) { // title ?>
		<td data-name="title" <?php echo $questions_grid->title->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_title" class="form-group">
<input type="text" data-table="questions" data-field="x_title" name="x<?php echo $questions_grid->RowIndex ?>_title" id="x<?php echo $questions_grid->RowIndex ?>_title" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_grid->title->getPlaceHolder()) ?>" value="<?php echo $questions_grid->title->EditValue ?>"<?php echo $questions_grid->title->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions" data-field="x_title" name="o<?php echo $questions_grid->RowIndex ?>_title" id="o<?php echo $questions_grid->RowIndex ?>_title" value="<?php echo HtmlEncode($questions_grid->title->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_title" class="form-group">
<input type="text" data-table="questions" data-field="x_title" name="x<?php echo $questions_grid->RowIndex ?>_title" id="x<?php echo $questions_grid->RowIndex ?>_title" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_grid->title->getPlaceHolder()) ?>" value="<?php echo $questions_grid->title->EditValue ?>"<?php echo $questions_grid->title->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_title">
<span<?php echo $questions_grid->title->viewAttributes() ?>><?php echo $questions_grid->title->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_title" name="x<?php echo $questions_grid->RowIndex ?>_title" id="x<?php echo $questions_grid->RowIndex ?>_title" value="<?php echo HtmlEncode($questions_grid->title->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_title" name="o<?php echo $questions_grid->RowIndex ?>_title" id="o<?php echo $questions_grid->RowIndex ?>_title" value="<?php echo HtmlEncode($questions_grid->title->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_title" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_title" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_title" value="<?php echo HtmlEncode($questions_grid->title->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_title" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_title" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_title" value="<?php echo HtmlEncode($questions_grid->title->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->placeholder->Visible) { // placeholder ?>
		<td data-name="placeholder" <?php echo $questions_grid->placeholder->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_placeholder" class="form-group">
<textarea data-table="questions" data-field="x_placeholder" name="x<?php echo $questions_grid->RowIndex ?>_placeholder" id="x<?php echo $questions_grid->RowIndex ?>_placeholder" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_grid->placeholder->getPlaceHolder()) ?>"<?php echo $questions_grid->placeholder->editAttributes() ?>><?php echo $questions_grid->placeholder->EditValue ?></textarea>
</span>
<input type="hidden" data-table="questions" data-field="x_placeholder" name="o<?php echo $questions_grid->RowIndex ?>_placeholder" id="o<?php echo $questions_grid->RowIndex ?>_placeholder" value="<?php echo HtmlEncode($questions_grid->placeholder->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_placeholder" class="form-group">
<textarea data-table="questions" data-field="x_placeholder" name="x<?php echo $questions_grid->RowIndex ?>_placeholder" id="x<?php echo $questions_grid->RowIndex ?>_placeholder" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_grid->placeholder->getPlaceHolder()) ?>"<?php echo $questions_grid->placeholder->editAttributes() ?>><?php echo $questions_grid->placeholder->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_placeholder">
<span<?php echo $questions_grid->placeholder->viewAttributes() ?>><?php echo $questions_grid->placeholder->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_placeholder" name="x<?php echo $questions_grid->RowIndex ?>_placeholder" id="x<?php echo $questions_grid->RowIndex ?>_placeholder" value="<?php echo HtmlEncode($questions_grid->placeholder->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_placeholder" name="o<?php echo $questions_grid->RowIndex ?>_placeholder" id="o<?php echo $questions_grid->RowIndex ?>_placeholder" value="<?php echo HtmlEncode($questions_grid->placeholder->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_placeholder" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_placeholder" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_placeholder" value="<?php echo HtmlEncode($questions_grid->placeholder->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_placeholder" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_placeholder" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_placeholder" value="<?php echo HtmlEncode($questions_grid->placeholder->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->questions->Visible) { // questions ?>
		<td data-name="questions" <?php echo $questions_grid->questions->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_questions" class="form-group">
<textarea data-table="questions" data-field="x_questions" name="x<?php echo $questions_grid->RowIndex ?>_questions" id="x<?php echo $questions_grid->RowIndex ?>_questions" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_grid->questions->getPlaceHolder()) ?>"<?php echo $questions_grid->questions->editAttributes() ?>><?php echo $questions_grid->questions->EditValue ?></textarea>
</span>
<input type="hidden" data-table="questions" data-field="x_questions" name="o<?php echo $questions_grid->RowIndex ?>_questions" id="o<?php echo $questions_grid->RowIndex ?>_questions" value="<?php echo HtmlEncode($questions_grid->questions->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_questions" class="form-group">
<textarea data-table="questions" data-field="x_questions" name="x<?php echo $questions_grid->RowIndex ?>_questions" id="x<?php echo $questions_grid->RowIndex ?>_questions" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_grid->questions->getPlaceHolder()) ?>"<?php echo $questions_grid->questions->editAttributes() ?>><?php echo $questions_grid->questions->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_questions">
<span<?php echo $questions_grid->questions->viewAttributes() ?>><?php echo $questions_grid->questions->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_questions" name="x<?php echo $questions_grid->RowIndex ?>_questions" id="x<?php echo $questions_grid->RowIndex ?>_questions" value="<?php echo HtmlEncode($questions_grid->questions->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_questions" name="o<?php echo $questions_grid->RowIndex ?>_questions" id="o<?php echo $questions_grid->RowIndex ?>_questions" value="<?php echo HtmlEncode($questions_grid->questions->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_questions" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_questions" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_questions" value="<?php echo HtmlEncode($questions_grid->questions->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_questions" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_questions" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_questions" value="<?php echo HtmlEncode($questions_grid->questions->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->scores->Visible) { // scores ?>
		<td data-name="scores" <?php echo $questions_grid->scores->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_scores" class="form-group">
<textarea data-table="questions" data-field="x_scores" name="x<?php echo $questions_grid->RowIndex ?>_scores" id="x<?php echo $questions_grid->RowIndex ?>_scores" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_grid->scores->getPlaceHolder()) ?>"<?php echo $questions_grid->scores->editAttributes() ?>><?php echo $questions_grid->scores->EditValue ?></textarea>
</span>
<input type="hidden" data-table="questions" data-field="x_scores" name="o<?php echo $questions_grid->RowIndex ?>_scores" id="o<?php echo $questions_grid->RowIndex ?>_scores" value="<?php echo HtmlEncode($questions_grid->scores->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_scores" class="form-group">
<textarea data-table="questions" data-field="x_scores" name="x<?php echo $questions_grid->RowIndex ?>_scores" id="x<?php echo $questions_grid->RowIndex ?>_scores" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_grid->scores->getPlaceHolder()) ?>"<?php echo $questions_grid->scores->editAttributes() ?>><?php echo $questions_grid->scores->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_scores">
<span<?php echo $questions_grid->scores->viewAttributes() ?>><?php echo $questions_grid->scores->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_scores" name="x<?php echo $questions_grid->RowIndex ?>_scores" id="x<?php echo $questions_grid->RowIndex ?>_scores" value="<?php echo HtmlEncode($questions_grid->scores->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_scores" name="o<?php echo $questions_grid->RowIndex ?>_scores" id="o<?php echo $questions_grid->RowIndex ?>_scores" value="<?php echo HtmlEncode($questions_grid->scores->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_scores" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_scores" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_scores" value="<?php echo HtmlEncode($questions_grid->scores->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_scores" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_scores" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_scores" value="<?php echo HtmlEncode($questions_grid->scores->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->type->Visible) { // type ?>
		<td data-name="type" <?php echo $questions_grid->type->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($questions_grid->type->getSessionValue() != "") { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_type" class="form-group">
<span<?php echo $questions_grid->type->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->type->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $questions_grid->RowIndex ?>_type" name="x<?php echo $questions_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($questions_grid->type->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_type" class="form-group">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($questions_grid->type->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $questions_grid->type->ViewValue ?></button>
		<div id="dsl_x<?php echo $questions_grid->RowIndex ?>_type" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $questions_grid->type->radioButtonListHtml(TRUE, "x{$questions_grid->RowIndex}_type") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x<?php echo $questions_grid->RowIndex ?>_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="questions" data-field="x_type" data-value-separator="<?php echo $questions_grid->type->displayValueSeparatorAttribute() ?>" name="x<?php echo $questions_grid->RowIndex ?>_type" id="x<?php echo $questions_grid->RowIndex ?>_type" value="{value}"<?php echo $questions_grid->type->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$questions_grid->type->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $questions_grid->type->Lookup->getParamTag($questions_grid, "p_x" . $questions_grid->RowIndex . "_type") ?>
</span>
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_type" name="o<?php echo $questions_grid->RowIndex ?>_type" id="o<?php echo $questions_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($questions_grid->type->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($questions_grid->type->getSessionValue() != "") { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_type" class="form-group">
<span<?php echo $questions_grid->type->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->type->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $questions_grid->RowIndex ?>_type" name="x<?php echo $questions_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($questions_grid->type->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_type" class="form-group">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($questions_grid->type->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $questions_grid->type->ViewValue ?></button>
		<div id="dsl_x<?php echo $questions_grid->RowIndex ?>_type" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $questions_grid->type->radioButtonListHtml(TRUE, "x{$questions_grid->RowIndex}_type") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x<?php echo $questions_grid->RowIndex ?>_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="questions" data-field="x_type" data-value-separator="<?php echo $questions_grid->type->displayValueSeparatorAttribute() ?>" name="x<?php echo $questions_grid->RowIndex ?>_type" id="x<?php echo $questions_grid->RowIndex ?>_type" value="{value}"<?php echo $questions_grid->type->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$questions_grid->type->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $questions_grid->type->Lookup->getParamTag($questions_grid, "p_x" . $questions_grid->RowIndex . "_type") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_type">
<span<?php echo $questions_grid->type->viewAttributes() ?>><?php echo $questions_grid->type->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_type" name="x<?php echo $questions_grid->RowIndex ?>_type" id="x<?php echo $questions_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($questions_grid->type->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_type" name="o<?php echo $questions_grid->RowIndex ?>_type" id="o<?php echo $questions_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($questions_grid->type->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_type" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_type" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($questions_grid->type->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_type" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_type" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($questions_grid->type->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->section->Visible) { // section ?>
		<td data-name="section" <?php echo $questions_grid->section->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($questions_grid->section->getSessionValue() != "") { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_section" class="form-group">
<span<?php echo $questions_grid->section->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->section->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $questions_grid->RowIndex ?>_section" name="x<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_section" class="form-group">
<?php
$onchange = $questions_grid->section->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$questions_grid->section->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $questions_grid->RowIndex ?>_section">
	<input type="text" class="form-control" name="sv_x<?php echo $questions_grid->RowIndex ?>_section" id="sv_x<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo RemoveHtml($questions_grid->section->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_grid->section->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($questions_grid->section->getPlaceHolder()) ?>"<?php echo $questions_grid->section->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions" data-field="x_section" data-value-separator="<?php echo $questions_grid->section->displayValueSeparatorAttribute() ?>" name="x<?php echo $questions_grid->RowIndex ?>_section" id="x<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fquestionsgrid"], function() {
	fquestionsgrid.createAutoSuggest({"id":"x<?php echo $questions_grid->RowIndex ?>_section","forceSelect":false});
});
</script>
<?php echo $questions_grid->section->Lookup->getParamTag($questions_grid, "p_x" . $questions_grid->RowIndex . "_section") ?>
</span>
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_section" name="o<?php echo $questions_grid->RowIndex ?>_section" id="o<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($questions_grid->section->getSessionValue() != "") { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_section" class="form-group">
<span<?php echo $questions_grid->section->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->section->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $questions_grid->RowIndex ?>_section" name="x<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_section" class="form-group">
<?php
$onchange = $questions_grid->section->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$questions_grid->section->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $questions_grid->RowIndex ?>_section">
	<input type="text" class="form-control" name="sv_x<?php echo $questions_grid->RowIndex ?>_section" id="sv_x<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo RemoveHtml($questions_grid->section->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_grid->section->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($questions_grid->section->getPlaceHolder()) ?>"<?php echo $questions_grid->section->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions" data-field="x_section" data-value-separator="<?php echo $questions_grid->section->displayValueSeparatorAttribute() ?>" name="x<?php echo $questions_grid->RowIndex ?>_section" id="x<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fquestionsgrid"], function() {
	fquestionsgrid.createAutoSuggest({"id":"x<?php echo $questions_grid->RowIndex ?>_section","forceSelect":false});
});
</script>
<?php echo $questions_grid->section->Lookup->getParamTag($questions_grid, "p_x" . $questions_grid->RowIndex . "_section") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_section">
<span<?php echo $questions_grid->section->viewAttributes() ?>><?php echo $questions_grid->section->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_section" name="x<?php echo $questions_grid->RowIndex ?>_section" id="x<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_section" name="o<?php echo $questions_grid->RowIndex ?>_section" id="o<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_section" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_section" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_section" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_section" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->active->Visible) { // active ?>
		<td data-name="active" <?php echo $questions_grid->active->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_active" class="form-group">
<?php
$selwrk = ConvertToBool($questions_grid->active->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="questions" data-field="x_active" name="x<?php echo $questions_grid->RowIndex ?>_active[]" id="x<?php echo $questions_grid->RowIndex ?>_active[]_458390" value="1"<?php echo $selwrk ?><?php echo $questions_grid->active->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $questions_grid->RowIndex ?>_active[]_458390"></label>
</div>
</span>
<input type="hidden" data-table="questions" data-field="x_active" name="o<?php echo $questions_grid->RowIndex ?>_active[]" id="o<?php echo $questions_grid->RowIndex ?>_active[]" value="<?php echo HtmlEncode($questions_grid->active->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_active" class="form-group">
<?php
$selwrk = ConvertToBool($questions_grid->active->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="questions" data-field="x_active" name="x<?php echo $questions_grid->RowIndex ?>_active[]" id="x<?php echo $questions_grid->RowIndex ?>_active[]_785670" value="1"<?php echo $selwrk ?><?php echo $questions_grid->active->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $questions_grid->RowIndex ?>_active[]_785670"></label>
</div>
</span>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_active">
<span<?php echo $questions_grid->active->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_active" class="custom-control-input" value="<?php echo $questions_grid->active->getViewValue() ?>" disabled<?php if (ConvertToBool($questions_grid->active->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_active"></label></div></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_active" name="x<?php echo $questions_grid->RowIndex ?>_active" id="x<?php echo $questions_grid->RowIndex ?>_active" value="<?php echo HtmlEncode($questions_grid->active->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_active" name="o<?php echo $questions_grid->RowIndex ?>_active[]" id="o<?php echo $questions_grid->RowIndex ?>_active[]" value="<?php echo HtmlEncode($questions_grid->active->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_active" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_active" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_active" value="<?php echo HtmlEncode($questions_grid->active->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_active" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_active[]" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_active[]" value="<?php echo HtmlEncode($questions_grid->active->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $questions_grid->created_at->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_created_at" class="form-group">
<input type="text" data-table="questions" data-field="x_created_at" name="x<?php echo $questions_grid->RowIndex ?>_created_at" id="x<?php echo $questions_grid->RowIndex ?>_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($questions_grid->created_at->getPlaceHolder()) ?>" value="<?php echo $questions_grid->created_at->EditValue ?>"<?php echo $questions_grid->created_at->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions" data-field="x_created_at" name="o<?php echo $questions_grid->RowIndex ?>_created_at" id="o<?php echo $questions_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($questions_grid->created_at->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_created_at" class="form-group">
<input type="text" data-table="questions" data-field="x_created_at" name="x<?php echo $questions_grid->RowIndex ?>_created_at" id="x<?php echo $questions_grid->RowIndex ?>_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($questions_grid->created_at->getPlaceHolder()) ?>" value="<?php echo $questions_grid->created_at->EditValue ?>"<?php echo $questions_grid->created_at->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_created_at">
<span<?php echo $questions_grid->created_at->viewAttributes() ?>><?php echo $questions_grid->created_at->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_created_at" name="x<?php echo $questions_grid->RowIndex ?>_created_at" id="x<?php echo $questions_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($questions_grid->created_at->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_created_at" name="o<?php echo $questions_grid->RowIndex ?>_created_at" id="o<?php echo $questions_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($questions_grid->created_at->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_created_at" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_created_at" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($questions_grid->created_at->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_created_at" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_created_at" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($questions_grid->created_at->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $questions_grid->updated_at->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_updated_at" class="form-group">
<input type="text" data-table="questions" data-field="x_updated_at" name="x<?php echo $questions_grid->RowIndex ?>_updated_at" id="x<?php echo $questions_grid->RowIndex ?>_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($questions_grid->updated_at->getPlaceHolder()) ?>" value="<?php echo $questions_grid->updated_at->EditValue ?>"<?php echo $questions_grid->updated_at->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions" data-field="x_updated_at" name="o<?php echo $questions_grid->RowIndex ?>_updated_at" id="o<?php echo $questions_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($questions_grid->updated_at->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_updated_at" class="form-group">
<input type="text" data-table="questions" data-field="x_updated_at" name="x<?php echo $questions_grid->RowIndex ?>_updated_at" id="x<?php echo $questions_grid->RowIndex ?>_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($questions_grid->updated_at->getPlaceHolder()) ?>" value="<?php echo $questions_grid->updated_at->EditValue ?>"<?php echo $questions_grid->updated_at->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_updated_at">
<span<?php echo $questions_grid->updated_at->viewAttributes() ?>><?php echo $questions_grid->updated_at->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_updated_at" name="x<?php echo $questions_grid->RowIndex ?>_updated_at" id="x<?php echo $questions_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($questions_grid->updated_at->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_updated_at" name="o<?php echo $questions_grid->RowIndex ?>_updated_at" id="o<?php echo $questions_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($questions_grid->updated_at->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_updated_at" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_updated_at" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($questions_grid->updated_at->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_updated_at" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_updated_at" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($questions_grid->updated_at->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->has_recommendations->Visible) { // has_recommendations ?>
		<td data-name="has_recommendations" <?php echo $questions_grid->has_recommendations->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_has_recommendations" class="form-group">
<div id="tp_x<?php echo $questions_grid->RowIndex ?>_has_recommendations" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="questions" data-field="x_has_recommendations" data-value-separator="<?php echo $questions_grid->has_recommendations->displayValueSeparatorAttribute() ?>" name="x<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" id="x<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" value="{value}"<?php echo $questions_grid->has_recommendations->editAttributes() ?>></div>
<div id="dsl_x<?php echo $questions_grid->RowIndex ?>_has_recommendations" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $questions_grid->has_recommendations->checkBoxListHtml(FALSE, "x{$questions_grid->RowIndex}_has_recommendations[]") ?>
</div></div>
</span>
<input type="hidden" data-table="questions" data-field="x_has_recommendations" name="o<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" id="o<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" value="<?php echo HtmlEncode($questions_grid->has_recommendations->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_has_recommendations" class="form-group">
<div id="tp_x<?php echo $questions_grid->RowIndex ?>_has_recommendations" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="questions" data-field="x_has_recommendations" data-value-separator="<?php echo $questions_grid->has_recommendations->displayValueSeparatorAttribute() ?>" name="x<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" id="x<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" value="{value}"<?php echo $questions_grid->has_recommendations->editAttributes() ?>></div>
<div id="dsl_x<?php echo $questions_grid->RowIndex ?>_has_recommendations" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $questions_grid->has_recommendations->checkBoxListHtml(FALSE, "x{$questions_grid->RowIndex}_has_recommendations[]") ?>
</div></div>
</span>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_has_recommendations">
<span<?php echo $questions_grid->has_recommendations->viewAttributes() ?>><?php echo $questions_grid->has_recommendations->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_has_recommendations" name="x<?php echo $questions_grid->RowIndex ?>_has_recommendations" id="x<?php echo $questions_grid->RowIndex ?>_has_recommendations" value="<?php echo HtmlEncode($questions_grid->has_recommendations->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_has_recommendations" name="o<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" id="o<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" value="<?php echo HtmlEncode($questions_grid->has_recommendations->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_has_recommendations" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_has_recommendations" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_has_recommendations" value="<?php echo HtmlEncode($questions_grid->has_recommendations->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_has_recommendations" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" value="<?php echo HtmlEncode($questions_grid->has_recommendations->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->group->Visible) { // group ?>
		<td data-name="group" <?php echo $questions_grid->group->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($questions_grid->group->getSessionValue() != "") { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_group" class="form-group">
<span<?php echo $questions_grid->group->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->group->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $questions_grid->RowIndex ?>_group" name="x<?php echo $questions_grid->RowIndex ?>_group" value="<?php echo HtmlEncode($questions_grid->group->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_group" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="questions" data-field="x_group" data-value-separator="<?php echo $questions_grid->group->displayValueSeparatorAttribute() ?>" id="x<?php echo $questions_grid->RowIndex ?>_group" name="x<?php echo $questions_grid->RowIndex ?>_group"<?php echo $questions_grid->group->editAttributes() ?>>
			<?php echo $questions_grid->group->selectOptionListHtml("x{$questions_grid->RowIndex}_group") ?>
		</select>
</div>
<?php echo $questions_grid->group->Lookup->getParamTag($questions_grid, "p_x" . $questions_grid->RowIndex . "_group") ?>
</span>
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_group" name="o<?php echo $questions_grid->RowIndex ?>_group" id="o<?php echo $questions_grid->RowIndex ?>_group" value="<?php echo HtmlEncode($questions_grid->group->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($questions_grid->group->getSessionValue() != "") { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_group" class="form-group">
<span<?php echo $questions_grid->group->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->group->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $questions_grid->RowIndex ?>_group" name="x<?php echo $questions_grid->RowIndex ?>_group" value="<?php echo HtmlEncode($questions_grid->group->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_group" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="questions" data-field="x_group" data-value-separator="<?php echo $questions_grid->group->displayValueSeparatorAttribute() ?>" id="x<?php echo $questions_grid->RowIndex ?>_group" name="x<?php echo $questions_grid->RowIndex ?>_group"<?php echo $questions_grid->group->editAttributes() ?>>
			<?php echo $questions_grid->group->selectOptionListHtml("x{$questions_grid->RowIndex}_group") ?>
		</select>
</div>
<?php echo $questions_grid->group->Lookup->getParamTag($questions_grid, "p_x" . $questions_grid->RowIndex . "_group") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_group">
<span<?php echo $questions_grid->group->viewAttributes() ?>><?php echo $questions_grid->group->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_group" name="x<?php echo $questions_grid->RowIndex ?>_group" id="x<?php echo $questions_grid->RowIndex ?>_group" value="<?php echo HtmlEncode($questions_grid->group->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_group" name="o<?php echo $questions_grid->RowIndex ?>_group" id="o<?php echo $questions_grid->RowIndex ?>_group" value="<?php echo HtmlEncode($questions_grid->group->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_group" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_group" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_group" value="<?php echo HtmlEncode($questions_grid->group->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_group" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_group" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_group" value="<?php echo HtmlEncode($questions_grid->group->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->category->Visible) { // category ?>
		<td data-name="category" <?php echo $questions_grid->category->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($questions_grid->category->getSessionValue() != "") { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_category" class="form-group">
<span<?php echo $questions_grid->category->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->category->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $questions_grid->RowIndex ?>_category" name="x<?php echo $questions_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($questions_grid->category->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_category" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="questions" data-field="x_category" data-value-separator="<?php echo $questions_grid->category->displayValueSeparatorAttribute() ?>" id="x<?php echo $questions_grid->RowIndex ?>_category" name="x<?php echo $questions_grid->RowIndex ?>_category"<?php echo $questions_grid->category->editAttributes() ?>>
			<?php echo $questions_grid->category->selectOptionListHtml("x{$questions_grid->RowIndex}_category") ?>
		</select>
</div>
<?php echo $questions_grid->category->Lookup->getParamTag($questions_grid, "p_x" . $questions_grid->RowIndex . "_category") ?>
</span>
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_category" name="o<?php echo $questions_grid->RowIndex ?>_category" id="o<?php echo $questions_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($questions_grid->category->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($questions_grid->category->getSessionValue() != "") { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_category" class="form-group">
<span<?php echo $questions_grid->category->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->category->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $questions_grid->RowIndex ?>_category" name="x<?php echo $questions_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($questions_grid->category->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_category" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="questions" data-field="x_category" data-value-separator="<?php echo $questions_grid->category->displayValueSeparatorAttribute() ?>" id="x<?php echo $questions_grid->RowIndex ?>_category" name="x<?php echo $questions_grid->RowIndex ?>_category"<?php echo $questions_grid->category->editAttributes() ?>>
			<?php echo $questions_grid->category->selectOptionListHtml("x{$questions_grid->RowIndex}_category") ?>
		</select>
</div>
<?php echo $questions_grid->category->Lookup->getParamTag($questions_grid, "p_x" . $questions_grid->RowIndex . "_category") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_category">
<span<?php echo $questions_grid->category->viewAttributes() ?>><?php echo $questions_grid->category->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_category" name="x<?php echo $questions_grid->RowIndex ?>_category" id="x<?php echo $questions_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($questions_grid->category->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_category" name="o<?php echo $questions_grid->RowIndex ?>_category" id="o<?php echo $questions_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($questions_grid->category->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_category" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_category" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($questions_grid->category->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_category" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_category" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($questions_grid->category->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->order->Visible) { // order ?>
		<td data-name="order" <?php echo $questions_grid->order->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_order" class="form-group">
<input type="text" data-table="questions" data-field="x_order" name="x<?php echo $questions_grid->RowIndex ?>_order" id="x<?php echo $questions_grid->RowIndex ?>_order" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_grid->order->getPlaceHolder()) ?>" value="<?php echo $questions_grid->order->EditValue ?>"<?php echo $questions_grid->order->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions" data-field="x_order" name="o<?php echo $questions_grid->RowIndex ?>_order" id="o<?php echo $questions_grid->RowIndex ?>_order" value="<?php echo HtmlEncode($questions_grid->order->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_order" class="form-group">
<input type="text" data-table="questions" data-field="x_order" name="x<?php echo $questions_grid->RowIndex ?>_order" id="x<?php echo $questions_grid->RowIndex ?>_order" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_grid->order->getPlaceHolder()) ?>" value="<?php echo $questions_grid->order->EditValue ?>"<?php echo $questions_grid->order->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_order">
<span<?php echo $questions_grid->order->viewAttributes() ?>><?php echo $questions_grid->order->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_order" name="x<?php echo $questions_grid->RowIndex ?>_order" id="x<?php echo $questions_grid->RowIndex ?>_order" value="<?php echo HtmlEncode($questions_grid->order->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_order" name="o<?php echo $questions_grid->RowIndex ?>_order" id="o<?php echo $questions_grid->RowIndex ?>_order" value="<?php echo HtmlEncode($questions_grid->order->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_order" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_order" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_order" value="<?php echo HtmlEncode($questions_grid->order->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_order" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_order" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_order" value="<?php echo HtmlEncode($questions_grid->order->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->recommendation_score->Visible) { // recommendation_score ?>
		<td data-name="recommendation_score" <?php echo $questions_grid->recommendation_score->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_recommendation_score" class="form-group">
<input type="text" data-table="questions" data-field="x_recommendation_score" name="x<?php echo $questions_grid->RowIndex ?>_recommendation_score" id="x<?php echo $questions_grid->RowIndex ?>_recommendation_score" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($questions_grid->recommendation_score->getPlaceHolder()) ?>" value="<?php echo $questions_grid->recommendation_score->EditValue ?>"<?php echo $questions_grid->recommendation_score->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions" data-field="x_recommendation_score" name="o<?php echo $questions_grid->RowIndex ?>_recommendation_score" id="o<?php echo $questions_grid->RowIndex ?>_recommendation_score" value="<?php echo HtmlEncode($questions_grid->recommendation_score->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_recommendation_score" class="form-group">
<input type="text" data-table="questions" data-field="x_recommendation_score" name="x<?php echo $questions_grid->RowIndex ?>_recommendation_score" id="x<?php echo $questions_grid->RowIndex ?>_recommendation_score" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($questions_grid->recommendation_score->getPlaceHolder()) ?>" value="<?php echo $questions_grid->recommendation_score->EditValue ?>"<?php echo $questions_grid->recommendation_score->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_recommendation_score">
<span<?php echo $questions_grid->recommendation_score->viewAttributes() ?>><?php echo $questions_grid->recommendation_score->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_recommendation_score" name="x<?php echo $questions_grid->RowIndex ?>_recommendation_score" id="x<?php echo $questions_grid->RowIndex ?>_recommendation_score" value="<?php echo HtmlEncode($questions_grid->recommendation_score->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_recommendation_score" name="o<?php echo $questions_grid->RowIndex ?>_recommendation_score" id="o<?php echo $questions_grid->RowIndex ?>_recommendation_score" value="<?php echo HtmlEncode($questions_grid->recommendation_score->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_recommendation_score" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_recommendation_score" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_recommendation_score" value="<?php echo HtmlEncode($questions_grid->recommendation_score->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_recommendation_score" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_recommendation_score" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_recommendation_score" value="<?php echo HtmlEncode($questions_grid->recommendation_score->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->related->Visible) { // related ?>
		<td data-name="related" <?php echo $questions_grid->related->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_related" class="form-group">
<input type="text" data-table="questions" data-field="x_related" name="x<?php echo $questions_grid->RowIndex ?>_related" id="x<?php echo $questions_grid->RowIndex ?>_related" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_grid->related->getPlaceHolder()) ?>" value="<?php echo $questions_grid->related->EditValue ?>"<?php echo $questions_grid->related->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions" data-field="x_related" name="o<?php echo $questions_grid->RowIndex ?>_related" id="o<?php echo $questions_grid->RowIndex ?>_related" value="<?php echo HtmlEncode($questions_grid->related->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_related" class="form-group">
<input type="text" data-table="questions" data-field="x_related" name="x<?php echo $questions_grid->RowIndex ?>_related" id="x<?php echo $questions_grid->RowIndex ?>_related" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_grid->related->getPlaceHolder()) ?>" value="<?php echo $questions_grid->related->EditValue ?>"<?php echo $questions_grid->related->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_related">
<span<?php echo $questions_grid->related->viewAttributes() ?>><?php echo $questions_grid->related->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_related" name="x<?php echo $questions_grid->RowIndex ?>_related" id="x<?php echo $questions_grid->RowIndex ?>_related" value="<?php echo HtmlEncode($questions_grid->related->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_related" name="o<?php echo $questions_grid->RowIndex ?>_related" id="o<?php echo $questions_grid->RowIndex ?>_related" value="<?php echo HtmlEncode($questions_grid->related->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_related" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_related" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_related" value="<?php echo HtmlEncode($questions_grid->related->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_related" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_related" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_related" value="<?php echo HtmlEncode($questions_grid->related->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($questions_grid->trigger_related_val->Visible) { // trigger_related_val ?>
		<td data-name="trigger_related_val" <?php echo $questions_grid->trigger_related_val->cellAttributes() ?>>
<?php if ($questions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_trigger_related_val" class="form-group">
<input type="text" data-table="questions" data-field="x_trigger_related_val" name="x<?php echo $questions_grid->RowIndex ?>_trigger_related_val" id="x<?php echo $questions_grid->RowIndex ?>_trigger_related_val" size="30" maxlength="128" placeholder="<?php echo HtmlEncode($questions_grid->trigger_related_val->getPlaceHolder()) ?>" value="<?php echo $questions_grid->trigger_related_val->EditValue ?>"<?php echo $questions_grid->trigger_related_val->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions" data-field="x_trigger_related_val" name="o<?php echo $questions_grid->RowIndex ?>_trigger_related_val" id="o<?php echo $questions_grid->RowIndex ?>_trigger_related_val" value="<?php echo HtmlEncode($questions_grid->trigger_related_val->OldValue) ?>">
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_trigger_related_val" class="form-group">
<input type="text" data-table="questions" data-field="x_trigger_related_val" name="x<?php echo $questions_grid->RowIndex ?>_trigger_related_val" id="x<?php echo $questions_grid->RowIndex ?>_trigger_related_val" size="30" maxlength="128" placeholder="<?php echo HtmlEncode($questions_grid->trigger_related_val->getPlaceHolder()) ?>" value="<?php echo $questions_grid->trigger_related_val->EditValue ?>"<?php echo $questions_grid->trigger_related_val->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($questions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $questions_grid->RowCount ?>_questions_trigger_related_val">
<span<?php echo $questions_grid->trigger_related_val->viewAttributes() ?>><?php echo $questions_grid->trigger_related_val->getViewValue() ?></span>
</span>
<?php if (!$questions->isConfirm()) { ?>
<input type="hidden" data-table="questions" data-field="x_trigger_related_val" name="x<?php echo $questions_grid->RowIndex ?>_trigger_related_val" id="x<?php echo $questions_grid->RowIndex ?>_trigger_related_val" value="<?php echo HtmlEncode($questions_grid->trigger_related_val->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_trigger_related_val" name="o<?php echo $questions_grid->RowIndex ?>_trigger_related_val" id="o<?php echo $questions_grid->RowIndex ?>_trigger_related_val" value="<?php echo HtmlEncode($questions_grid->trigger_related_val->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="questions" data-field="x_trigger_related_val" name="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_trigger_related_val" id="fquestionsgrid$x<?php echo $questions_grid->RowIndex ?>_trigger_related_val" value="<?php echo HtmlEncode($questions_grid->trigger_related_val->FormValue) ?>">
<input type="hidden" data-table="questions" data-field="x_trigger_related_val" name="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_trigger_related_val" id="fquestionsgrid$o<?php echo $questions_grid->RowIndex ?>_trigger_related_val" value="<?php echo HtmlEncode($questions_grid->trigger_related_val->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$questions_grid->ListOptions->render("body", "right", $questions_grid->RowCount);
?>
	</tr>
<?php if ($questions->RowType == ROWTYPE_ADD || $questions->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fquestionsgrid", "load"], function() {
	fquestionsgrid.updateLists(<?php echo $questions_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$questions_grid->isGridAdd() || $questions->CurrentMode == "copy")
		if (!$questions_grid->Recordset->EOF)
			$questions_grid->Recordset->moveNext();
}
?>
<?php
	if ($questions->CurrentMode == "add" || $questions->CurrentMode == "copy" || $questions->CurrentMode == "edit") {
		$questions_grid->RowIndex = '$rowindex$';
		$questions_grid->loadRowValues();

		// Set row properties
		$questions->resetAttributes();
		$questions->RowAttrs->merge(["data-rowindex" => $questions_grid->RowIndex, "id" => "r0_questions", "data-rowtype" => ROWTYPE_ADD]);
		$questions->RowAttrs->appendClass("ew-template");
		$questions->RowType = ROWTYPE_ADD;

		// Render row
		$questions_grid->renderRow();

		// Render list options
		$questions_grid->renderListOptions();
		$questions_grid->StartRowCount = 0;
?>
	<tr <?php echo $questions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$questions_grid->ListOptions->render("body", "left", $questions_grid->RowIndex);
?>
	<?php if ($questions_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_id" class="form-group questions_id"></span>
<?php } else { ?>
<span id="el$rowindex$_questions_id" class="form-group questions_id">
<span<?php echo $questions_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_id" name="x<?php echo $questions_grid->RowIndex ?>_id" id="x<?php echo $questions_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($questions_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_id" name="o<?php echo $questions_grid->RowIndex ?>_id" id="o<?php echo $questions_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($questions_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->title->Visible) { // title ?>
		<td data-name="title">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_title" class="form-group questions_title">
<input type="text" data-table="questions" data-field="x_title" name="x<?php echo $questions_grid->RowIndex ?>_title" id="x<?php echo $questions_grid->RowIndex ?>_title" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($questions_grid->title->getPlaceHolder()) ?>" value="<?php echo $questions_grid->title->EditValue ?>"<?php echo $questions_grid->title->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_questions_title" class="form-group questions_title">
<span<?php echo $questions_grid->title->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->title->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_title" name="x<?php echo $questions_grid->RowIndex ?>_title" id="x<?php echo $questions_grid->RowIndex ?>_title" value="<?php echo HtmlEncode($questions_grid->title->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_title" name="o<?php echo $questions_grid->RowIndex ?>_title" id="o<?php echo $questions_grid->RowIndex ?>_title" value="<?php echo HtmlEncode($questions_grid->title->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->placeholder->Visible) { // placeholder ?>
		<td data-name="placeholder">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_placeholder" class="form-group questions_placeholder">
<textarea data-table="questions" data-field="x_placeholder" name="x<?php echo $questions_grid->RowIndex ?>_placeholder" id="x<?php echo $questions_grid->RowIndex ?>_placeholder" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_grid->placeholder->getPlaceHolder()) ?>"<?php echo $questions_grid->placeholder->editAttributes() ?>><?php echo $questions_grid->placeholder->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_questions_placeholder" class="form-group questions_placeholder">
<span<?php echo $questions_grid->placeholder->viewAttributes() ?>><?php echo $questions_grid->placeholder->ViewValue ?></span>
</span>
<input type="hidden" data-table="questions" data-field="x_placeholder" name="x<?php echo $questions_grid->RowIndex ?>_placeholder" id="x<?php echo $questions_grid->RowIndex ?>_placeholder" value="<?php echo HtmlEncode($questions_grid->placeholder->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_placeholder" name="o<?php echo $questions_grid->RowIndex ?>_placeholder" id="o<?php echo $questions_grid->RowIndex ?>_placeholder" value="<?php echo HtmlEncode($questions_grid->placeholder->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->questions->Visible) { // questions ?>
		<td data-name="questions">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_questions" class="form-group questions_questions">
<textarea data-table="questions" data-field="x_questions" name="x<?php echo $questions_grid->RowIndex ?>_questions" id="x<?php echo $questions_grid->RowIndex ?>_questions" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_grid->questions->getPlaceHolder()) ?>"<?php echo $questions_grid->questions->editAttributes() ?>><?php echo $questions_grid->questions->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_questions_questions" class="form-group questions_questions">
<span<?php echo $questions_grid->questions->viewAttributes() ?>><?php echo $questions_grid->questions->ViewValue ?></span>
</span>
<input type="hidden" data-table="questions" data-field="x_questions" name="x<?php echo $questions_grid->RowIndex ?>_questions" id="x<?php echo $questions_grid->RowIndex ?>_questions" value="<?php echo HtmlEncode($questions_grid->questions->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_questions" name="o<?php echo $questions_grid->RowIndex ?>_questions" id="o<?php echo $questions_grid->RowIndex ?>_questions" value="<?php echo HtmlEncode($questions_grid->questions->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->scores->Visible) { // scores ?>
		<td data-name="scores">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_scores" class="form-group questions_scores">
<textarea data-table="questions" data-field="x_scores" name="x<?php echo $questions_grid->RowIndex ?>_scores" id="x<?php echo $questions_grid->RowIndex ?>_scores" cols="35" rows="4" placeholder="<?php echo HtmlEncode($questions_grid->scores->getPlaceHolder()) ?>"<?php echo $questions_grid->scores->editAttributes() ?>><?php echo $questions_grid->scores->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_questions_scores" class="form-group questions_scores">
<span<?php echo $questions_grid->scores->viewAttributes() ?>><?php echo $questions_grid->scores->ViewValue ?></span>
</span>
<input type="hidden" data-table="questions" data-field="x_scores" name="x<?php echo $questions_grid->RowIndex ?>_scores" id="x<?php echo $questions_grid->RowIndex ?>_scores" value="<?php echo HtmlEncode($questions_grid->scores->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_scores" name="o<?php echo $questions_grid->RowIndex ?>_scores" id="o<?php echo $questions_grid->RowIndex ?>_scores" value="<?php echo HtmlEncode($questions_grid->scores->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->type->Visible) { // type ?>
		<td data-name="type">
<?php if (!$questions->isConfirm()) { ?>
<?php if ($questions_grid->type->getSessionValue() != "") { ?>
<span id="el$rowindex$_questions_type" class="form-group questions_type">
<span<?php echo $questions_grid->type->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->type->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $questions_grid->RowIndex ?>_type" name="x<?php echo $questions_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($questions_grid->type->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_questions_type" class="form-group questions_type">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($questions_grid->type->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $questions_grid->type->ViewValue ?></button>
		<div id="dsl_x<?php echo $questions_grid->RowIndex ?>_type" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $questions_grid->type->radioButtonListHtml(TRUE, "x{$questions_grid->RowIndex}_type") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x<?php echo $questions_grid->RowIndex ?>_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="questions" data-field="x_type" data-value-separator="<?php echo $questions_grid->type->displayValueSeparatorAttribute() ?>" name="x<?php echo $questions_grid->RowIndex ?>_type" id="x<?php echo $questions_grid->RowIndex ?>_type" value="{value}"<?php echo $questions_grid->type->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$questions_grid->type->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $questions_grid->type->Lookup->getParamTag($questions_grid, "p_x" . $questions_grid->RowIndex . "_type") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_questions_type" class="form-group questions_type">
<span<?php echo $questions_grid->type->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->type->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_type" name="x<?php echo $questions_grid->RowIndex ?>_type" id="x<?php echo $questions_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($questions_grid->type->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_type" name="o<?php echo $questions_grid->RowIndex ?>_type" id="o<?php echo $questions_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($questions_grid->type->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->section->Visible) { // section ?>
		<td data-name="section">
<?php if (!$questions->isConfirm()) { ?>
<?php if ($questions_grid->section->getSessionValue() != "") { ?>
<span id="el$rowindex$_questions_section" class="form-group questions_section">
<span<?php echo $questions_grid->section->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->section->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $questions_grid->RowIndex ?>_section" name="x<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_questions_section" class="form-group questions_section">
<?php
$onchange = $questions_grid->section->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$questions_grid->section->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $questions_grid->RowIndex ?>_section">
	<input type="text" class="form-control" name="sv_x<?php echo $questions_grid->RowIndex ?>_section" id="sv_x<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo RemoveHtml($questions_grid->section->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_grid->section->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($questions_grid->section->getPlaceHolder()) ?>"<?php echo $questions_grid->section->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions" data-field="x_section" data-value-separator="<?php echo $questions_grid->section->displayValueSeparatorAttribute() ?>" name="x<?php echo $questions_grid->RowIndex ?>_section" id="x<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fquestionsgrid"], function() {
	fquestionsgrid.createAutoSuggest({"id":"x<?php echo $questions_grid->RowIndex ?>_section","forceSelect":false});
});
</script>
<?php echo $questions_grid->section->Lookup->getParamTag($questions_grid, "p_x" . $questions_grid->RowIndex . "_section") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_questions_section" class="form-group questions_section">
<span<?php echo $questions_grid->section->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->section->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_section" name="x<?php echo $questions_grid->RowIndex ?>_section" id="x<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_section" name="o<?php echo $questions_grid->RowIndex ?>_section" id="o<?php echo $questions_grid->RowIndex ?>_section" value="<?php echo HtmlEncode($questions_grid->section->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->active->Visible) { // active ?>
		<td data-name="active">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_active" class="form-group questions_active">
<?php
$selwrk = ConvertToBool($questions_grid->active->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="questions" data-field="x_active" name="x<?php echo $questions_grid->RowIndex ?>_active[]" id="x<?php echo $questions_grid->RowIndex ?>_active[]_642335" value="1"<?php echo $selwrk ?><?php echo $questions_grid->active->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $questions_grid->RowIndex ?>_active[]_642335"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_questions_active" class="form-group questions_active">
<span<?php echo $questions_grid->active->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_active" class="custom-control-input" value="<?php echo $questions_grid->active->ViewValue ?>" disabled<?php if (ConvertToBool($questions_grid->active->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_active"></label></div></span>
</span>
<input type="hidden" data-table="questions" data-field="x_active" name="x<?php echo $questions_grid->RowIndex ?>_active" id="x<?php echo $questions_grid->RowIndex ?>_active" value="<?php echo HtmlEncode($questions_grid->active->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_active" name="o<?php echo $questions_grid->RowIndex ?>_active[]" id="o<?php echo $questions_grid->RowIndex ?>_active[]" value="<?php echo HtmlEncode($questions_grid->active->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->created_at->Visible) { // created_at ?>
		<td data-name="created_at">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_created_at" class="form-group questions_created_at">
<input type="text" data-table="questions" data-field="x_created_at" name="x<?php echo $questions_grid->RowIndex ?>_created_at" id="x<?php echo $questions_grid->RowIndex ?>_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($questions_grid->created_at->getPlaceHolder()) ?>" value="<?php echo $questions_grid->created_at->EditValue ?>"<?php echo $questions_grid->created_at->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_questions_created_at" class="form-group questions_created_at">
<span<?php echo $questions_grid->created_at->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->created_at->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_created_at" name="x<?php echo $questions_grid->RowIndex ?>_created_at" id="x<?php echo $questions_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($questions_grid->created_at->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_created_at" name="o<?php echo $questions_grid->RowIndex ?>_created_at" id="o<?php echo $questions_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($questions_grid->created_at->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_updated_at" class="form-group questions_updated_at">
<input type="text" data-table="questions" data-field="x_updated_at" name="x<?php echo $questions_grid->RowIndex ?>_updated_at" id="x<?php echo $questions_grid->RowIndex ?>_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($questions_grid->updated_at->getPlaceHolder()) ?>" value="<?php echo $questions_grid->updated_at->EditValue ?>"<?php echo $questions_grid->updated_at->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_questions_updated_at" class="form-group questions_updated_at">
<span<?php echo $questions_grid->updated_at->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->updated_at->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_updated_at" name="x<?php echo $questions_grid->RowIndex ?>_updated_at" id="x<?php echo $questions_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($questions_grid->updated_at->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_updated_at" name="o<?php echo $questions_grid->RowIndex ?>_updated_at" id="o<?php echo $questions_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($questions_grid->updated_at->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->has_recommendations->Visible) { // has_recommendations ?>
		<td data-name="has_recommendations">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_has_recommendations" class="form-group questions_has_recommendations">
<div id="tp_x<?php echo $questions_grid->RowIndex ?>_has_recommendations" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="questions" data-field="x_has_recommendations" data-value-separator="<?php echo $questions_grid->has_recommendations->displayValueSeparatorAttribute() ?>" name="x<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" id="x<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" value="{value}"<?php echo $questions_grid->has_recommendations->editAttributes() ?>></div>
<div id="dsl_x<?php echo $questions_grid->RowIndex ?>_has_recommendations" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $questions_grid->has_recommendations->checkBoxListHtml(FALSE, "x{$questions_grid->RowIndex}_has_recommendations[]") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_questions_has_recommendations" class="form-group questions_has_recommendations">
<span<?php echo $questions_grid->has_recommendations->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->has_recommendations->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_has_recommendations" name="x<?php echo $questions_grid->RowIndex ?>_has_recommendations" id="x<?php echo $questions_grid->RowIndex ?>_has_recommendations" value="<?php echo HtmlEncode($questions_grid->has_recommendations->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_has_recommendations" name="o<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" id="o<?php echo $questions_grid->RowIndex ?>_has_recommendations[]" value="<?php echo HtmlEncode($questions_grid->has_recommendations->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->group->Visible) { // group ?>
		<td data-name="group">
<?php if (!$questions->isConfirm()) { ?>
<?php if ($questions_grid->group->getSessionValue() != "") { ?>
<span id="el$rowindex$_questions_group" class="form-group questions_group">
<span<?php echo $questions_grid->group->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->group->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $questions_grid->RowIndex ?>_group" name="x<?php echo $questions_grid->RowIndex ?>_group" value="<?php echo HtmlEncode($questions_grid->group->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_questions_group" class="form-group questions_group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="questions" data-field="x_group" data-value-separator="<?php echo $questions_grid->group->displayValueSeparatorAttribute() ?>" id="x<?php echo $questions_grid->RowIndex ?>_group" name="x<?php echo $questions_grid->RowIndex ?>_group"<?php echo $questions_grid->group->editAttributes() ?>>
			<?php echo $questions_grid->group->selectOptionListHtml("x{$questions_grid->RowIndex}_group") ?>
		</select>
</div>
<?php echo $questions_grid->group->Lookup->getParamTag($questions_grid, "p_x" . $questions_grid->RowIndex . "_group") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_questions_group" class="form-group questions_group">
<span<?php echo $questions_grid->group->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->group->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_group" name="x<?php echo $questions_grid->RowIndex ?>_group" id="x<?php echo $questions_grid->RowIndex ?>_group" value="<?php echo HtmlEncode($questions_grid->group->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_group" name="o<?php echo $questions_grid->RowIndex ?>_group" id="o<?php echo $questions_grid->RowIndex ?>_group" value="<?php echo HtmlEncode($questions_grid->group->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->category->Visible) { // category ?>
		<td data-name="category">
<?php if (!$questions->isConfirm()) { ?>
<?php if ($questions_grid->category->getSessionValue() != "") { ?>
<span id="el$rowindex$_questions_category" class="form-group questions_category">
<span<?php echo $questions_grid->category->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->category->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $questions_grid->RowIndex ?>_category" name="x<?php echo $questions_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($questions_grid->category->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_questions_category" class="form-group questions_category">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="questions" data-field="x_category" data-value-separator="<?php echo $questions_grid->category->displayValueSeparatorAttribute() ?>" id="x<?php echo $questions_grid->RowIndex ?>_category" name="x<?php echo $questions_grid->RowIndex ?>_category"<?php echo $questions_grid->category->editAttributes() ?>>
			<?php echo $questions_grid->category->selectOptionListHtml("x{$questions_grid->RowIndex}_category") ?>
		</select>
</div>
<?php echo $questions_grid->category->Lookup->getParamTag($questions_grid, "p_x" . $questions_grid->RowIndex . "_category") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_questions_category" class="form-group questions_category">
<span<?php echo $questions_grid->category->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->category->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_category" name="x<?php echo $questions_grid->RowIndex ?>_category" id="x<?php echo $questions_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($questions_grid->category->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_category" name="o<?php echo $questions_grid->RowIndex ?>_category" id="o<?php echo $questions_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($questions_grid->category->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->order->Visible) { // order ?>
		<td data-name="order">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_order" class="form-group questions_order">
<input type="text" data-table="questions" data-field="x_order" name="x<?php echo $questions_grid->RowIndex ?>_order" id="x<?php echo $questions_grid->RowIndex ?>_order" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_grid->order->getPlaceHolder()) ?>" value="<?php echo $questions_grid->order->EditValue ?>"<?php echo $questions_grid->order->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_questions_order" class="form-group questions_order">
<span<?php echo $questions_grid->order->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->order->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_order" name="x<?php echo $questions_grid->RowIndex ?>_order" id="x<?php echo $questions_grid->RowIndex ?>_order" value="<?php echo HtmlEncode($questions_grid->order->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_order" name="o<?php echo $questions_grid->RowIndex ?>_order" id="o<?php echo $questions_grid->RowIndex ?>_order" value="<?php echo HtmlEncode($questions_grid->order->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->recommendation_score->Visible) { // recommendation_score ?>
		<td data-name="recommendation_score">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_recommendation_score" class="form-group questions_recommendation_score">
<input type="text" data-table="questions" data-field="x_recommendation_score" name="x<?php echo $questions_grid->RowIndex ?>_recommendation_score" id="x<?php echo $questions_grid->RowIndex ?>_recommendation_score" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($questions_grid->recommendation_score->getPlaceHolder()) ?>" value="<?php echo $questions_grid->recommendation_score->EditValue ?>"<?php echo $questions_grid->recommendation_score->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_questions_recommendation_score" class="form-group questions_recommendation_score">
<span<?php echo $questions_grid->recommendation_score->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->recommendation_score->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_recommendation_score" name="x<?php echo $questions_grid->RowIndex ?>_recommendation_score" id="x<?php echo $questions_grid->RowIndex ?>_recommendation_score" value="<?php echo HtmlEncode($questions_grid->recommendation_score->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_recommendation_score" name="o<?php echo $questions_grid->RowIndex ?>_recommendation_score" id="o<?php echo $questions_grid->RowIndex ?>_recommendation_score" value="<?php echo HtmlEncode($questions_grid->recommendation_score->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->related->Visible) { // related ?>
		<td data-name="related">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_related" class="form-group questions_related">
<input type="text" data-table="questions" data-field="x_related" name="x<?php echo $questions_grid->RowIndex ?>_related" id="x<?php echo $questions_grid->RowIndex ?>_related" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_grid->related->getPlaceHolder()) ?>" value="<?php echo $questions_grid->related->EditValue ?>"<?php echo $questions_grid->related->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_questions_related" class="form-group questions_related">
<span<?php echo $questions_grid->related->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->related->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_related" name="x<?php echo $questions_grid->RowIndex ?>_related" id="x<?php echo $questions_grid->RowIndex ?>_related" value="<?php echo HtmlEncode($questions_grid->related->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_related" name="o<?php echo $questions_grid->RowIndex ?>_related" id="o<?php echo $questions_grid->RowIndex ?>_related" value="<?php echo HtmlEncode($questions_grid->related->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($questions_grid->trigger_related_val->Visible) { // trigger_related_val ?>
		<td data-name="trigger_related_val">
<?php if (!$questions->isConfirm()) { ?>
<span id="el$rowindex$_questions_trigger_related_val" class="form-group questions_trigger_related_val">
<input type="text" data-table="questions" data-field="x_trigger_related_val" name="x<?php echo $questions_grid->RowIndex ?>_trigger_related_val" id="x<?php echo $questions_grid->RowIndex ?>_trigger_related_val" size="30" maxlength="128" placeholder="<?php echo HtmlEncode($questions_grid->trigger_related_val->getPlaceHolder()) ?>" value="<?php echo $questions_grid->trigger_related_val->EditValue ?>"<?php echo $questions_grid->trigger_related_val->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_questions_trigger_related_val" class="form-group questions_trigger_related_val">
<span<?php echo $questions_grid->trigger_related_val->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($questions_grid->trigger_related_val->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="questions" data-field="x_trigger_related_val" name="x<?php echo $questions_grid->RowIndex ?>_trigger_related_val" id="x<?php echo $questions_grid->RowIndex ?>_trigger_related_val" value="<?php echo HtmlEncode($questions_grid->trigger_related_val->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="questions" data-field="x_trigger_related_val" name="o<?php echo $questions_grid->RowIndex ?>_trigger_related_val" id="o<?php echo $questions_grid->RowIndex ?>_trigger_related_val" value="<?php echo HtmlEncode($questions_grid->trigger_related_val->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$questions_grid->ListOptions->render("body", "right", $questions_grid->RowIndex);
?>
<script>
loadjs.ready(["fquestionsgrid", "load"], function() {
	fquestionsgrid.updateLists(<?php echo $questions_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($questions->CurrentMode == "add" || $questions->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $questions_grid->FormKeyCountName ?>" id="<?php echo $questions_grid->FormKeyCountName ?>" value="<?php echo $questions_grid->KeyCount ?>">
<?php echo $questions_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($questions->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $questions_grid->FormKeyCountName ?>" id="<?php echo $questions_grid->FormKeyCountName ?>" value="<?php echo $questions_grid->KeyCount ?>">
<?php echo $questions_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($questions->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fquestionsgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($questions_grid->Recordset)
	$questions_grid->Recordset->Close();
?>
<?php if ($questions_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $questions_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($questions_grid->TotalRecords == 0 && !$questions->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $questions_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$questions_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$questions_grid->terminate();
?>
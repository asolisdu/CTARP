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
$questions_answers_list = new questions_answers_list();

// Run the page
$questions_answers_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$questions_answers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$questions_answers_list->isExport()) { ?>
<script>
var fquestions_answerslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fquestions_answerslist = currentForm = new ew.Form("fquestions_answerslist", "list");
	fquestions_answerslist.formKeyCountName = '<?php echo $questions_answers_list->FormKeyCountName ?>';
	loadjs.done("fquestions_answerslist");
});
var fquestions_answerslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fquestions_answerslistsrch = currentSearchForm = new ew.Form("fquestions_answerslistsrch");

	// Validate function for search
	fquestions_answerslistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_question_section_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_list->question_section_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_assessment_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($questions_answers_list->assessment_id->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fquestions_answerslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fquestions_answerslistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fquestions_answerslistsrch.lists["x_question_section_id"] = <?php echo $questions_answers_list->question_section_id->Lookup->toClientList($questions_answers_list) ?>;
	fquestions_answerslistsrch.lists["x_question_section_id"].options = <?php echo JsonEncode($questions_answers_list->question_section_id->lookupOptions()) ?>;
	fquestions_answerslistsrch.autoSuggests["x_question_section_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fquestions_answerslistsrch.lists["x_assessment_id"] = <?php echo $questions_answers_list->assessment_id->Lookup->toClientList($questions_answers_list) ?>;
	fquestions_answerslistsrch.lists["x_assessment_id"].options = <?php echo JsonEncode($questions_answers_list->assessment_id->lookupOptions()) ?>;
	fquestions_answerslistsrch.autoSuggests["x_assessment_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fquestions_answerslistsrch.filterList = <?php echo $questions_answers_list->getFilterList() ?>;
	loadjs.done("fquestions_answerslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$questions_answers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($questions_answers_list->TotalRecords > 0 && $questions_answers_list->ExportOptions->visible()) { ?>
<?php $questions_answers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($questions_answers_list->ImportOptions->visible()) { ?>
<?php $questions_answers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($questions_answers_list->SearchOptions->visible()) { ?>
<?php $questions_answers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($questions_answers_list->FilterOptions->visible()) { ?>
<?php $questions_answers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$questions_answers_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$questions_answers_list->isExport() && !$questions_answers->CurrentAction) { ?>
<form name="fquestions_answerslistsrch" id="fquestions_answerslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fquestions_answerslistsrch-search-panel" class="<?php echo $questions_answers_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="questions_answers">
	<div class="ew-extended-search">
<?php

// Render search row
$questions_answers->RowType = ROWTYPE_SEARCH;
$questions_answers->resetAttributes();
$questions_answers_list->renderRow();
?>
<?php if ($questions_answers_list->question_section_id->Visible) { // question_section_id ?>
	<?php
		$questions_answers_list->SearchColumnCount++;
		if (($questions_answers_list->SearchColumnCount - 1) % $questions_answers_list->SearchFieldsPerRow == 0) {
			$questions_answers_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $questions_answers_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_question_section_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $questions_answers_list->question_section_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_question_section_id" id="z_question_section_id" value="=">
</span>
		<span id="el_questions_answers_question_section_id" class="ew-search-field">
<?php
$onchange = $questions_answers_list->question_section_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$questions_answers_list->question_section_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_question_section_id">
	<input type="text" class="form-control" name="sv_x_question_section_id" id="sv_x_question_section_id" value="<?php echo RemoveHtml($questions_answers_list->question_section_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_answers_list->question_section_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($questions_answers_list->question_section_id->getPlaceHolder()) ?>"<?php echo $questions_answers_list->question_section_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions_answers" data-field="x_question_section_id" data-value-separator="<?php echo $questions_answers_list->question_section_id->displayValueSeparatorAttribute() ?>" name="x_question_section_id" id="x_question_section_id" value="<?php echo HtmlEncode($questions_answers_list->question_section_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fquestions_answerslistsrch"], function() {
	fquestions_answerslistsrch.createAutoSuggest({"id":"x_question_section_id","forceSelect":false});
});
</script>
<?php echo $questions_answers_list->question_section_id->Lookup->getParamTag($questions_answers_list, "p_x_question_section_id") ?>
</span>
	</div>
	<?php if ($questions_answers_list->SearchColumnCount % $questions_answers_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_id->Visible) { // assessment_id ?>
	<?php
		$questions_answers_list->SearchColumnCount++;
		if (($questions_answers_list->SearchColumnCount - 1) % $questions_answers_list->SearchFieldsPerRow == 0) {
			$questions_answers_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $questions_answers_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_assessment_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $questions_answers_list->assessment_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_assessment_id" id="z_assessment_id" value="=">
</span>
		<span id="el_questions_answers_assessment_id" class="ew-search-field">
<?php
$onchange = $questions_answers_list->assessment_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$questions_answers_list->assessment_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_assessment_id">
	<input type="text" class="form-control" name="sv_x_assessment_id" id="sv_x_assessment_id" value="<?php echo RemoveHtml($questions_answers_list->assessment_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($questions_answers_list->assessment_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($questions_answers_list->assessment_id->getPlaceHolder()) ?>"<?php echo $questions_answers_list->assessment_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="questions_answers" data-field="x_assessment_id" data-value-separator="<?php echo $questions_answers_list->assessment_id->displayValueSeparatorAttribute() ?>" name="x_assessment_id" id="x_assessment_id" value="<?php echo HtmlEncode($questions_answers_list->assessment_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fquestions_answerslistsrch"], function() {
	fquestions_answerslistsrch.createAutoSuggest({"id":"x_assessment_id","forceSelect":false});
});
</script>
<?php echo $questions_answers_list->assessment_id->Lookup->getParamTag($questions_answers_list, "p_x_assessment_id") ?>
</span>
	</div>
	<?php if ($questions_answers_list->SearchColumnCount % $questions_answers_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($questions_answers_list->SearchColumnCount % $questions_answers_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $questions_answers_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($questions_answers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($questions_answers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $questions_answers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($questions_answers_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($questions_answers_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($questions_answers_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($questions_answers_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $questions_answers_list->showPageHeader(); ?>
<?php
$questions_answers_list->showMessage();
?>
<?php if ($questions_answers_list->TotalRecords > 0 || $questions_answers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($questions_answers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> questions_answers">
<?php if (!$questions_answers_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$questions_answers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $questions_answers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $questions_answers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fquestions_answerslist" id="fquestions_answerslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="questions_answers">
<div id="gmp_questions_answers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($questions_answers_list->TotalRecords > 0 || $questions_answers_list->isGridEdit()) { ?>
<table id="tbl_questions_answerslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$questions_answers->RowType = ROWTYPE_HEADER;

// Render list options
$questions_answers_list->renderListOptions();

// Render list options (header, left)
$questions_answers_list->ListOptions->render("header", "left");
?>
<?php if ($questions_answers_list->question_id->Visible) { // question_id ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_id) == "") { ?>
		<th data-name="question_id" class="<?php echo $questions_answers_list->question_id->headerCellClass() ?>"><div id="elh_questions_answers_question_id" class="questions_answers_question_id"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_id" class="<?php echo $questions_answers_list->question_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_id) ?>', 1);"><div id="elh_questions_answers_question_id" class="questions_answers_question_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_title->Visible) { // question_title ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_title) == "") { ?>
		<th data-name="question_title" class="<?php echo $questions_answers_list->question_title->headerCellClass() ?>"><div id="elh_questions_answers_question_title" class="questions_answers_question_title"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_title" class="<?php echo $questions_answers_list->question_title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_title) ?>', 1);"><div id="elh_questions_answers_question_title" class="questions_answers_question_title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_placeholder->Visible) { // question_placeholder ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_placeholder) == "") { ?>
		<th data-name="question_placeholder" class="<?php echo $questions_answers_list->question_placeholder->headerCellClass() ?>"><div id="elh_questions_answers_question_placeholder" class="questions_answers_question_placeholder"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_placeholder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_placeholder" class="<?php echo $questions_answers_list->question_placeholder->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_placeholder) ?>', 1);"><div id="elh_questions_answers_question_placeholder" class="questions_answers_question_placeholder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_placeholder->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_placeholder->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_placeholder->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_questions->Visible) { // question_questions ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_questions) == "") { ?>
		<th data-name="question_questions" class="<?php echo $questions_answers_list->question_questions->headerCellClass() ?>"><div id="elh_questions_answers_question_questions" class="questions_answers_question_questions"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_questions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_questions" class="<?php echo $questions_answers_list->question_questions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_questions) ?>', 1);"><div id="elh_questions_answers_question_questions" class="questions_answers_question_questions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_questions->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_questions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_questions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_scores->Visible) { // question_scores ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_scores) == "") { ?>
		<th data-name="question_scores" class="<?php echo $questions_answers_list->question_scores->headerCellClass() ?>"><div id="elh_questions_answers_question_scores" class="questions_answers_question_scores"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_scores->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_scores" class="<?php echo $questions_answers_list->question_scores->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_scores) ?>', 1);"><div id="elh_questions_answers_question_scores" class="questions_answers_question_scores">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_scores->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_scores->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_scores->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_active->Visible) { // question_active ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_active) == "") { ?>
		<th data-name="question_active" class="<?php echo $questions_answers_list->question_active->headerCellClass() ?>"><div id="elh_questions_answers_question_active" class="questions_answers_question_active"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_active->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_active" class="<?php echo $questions_answers_list->question_active->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_active) ?>', 1);"><div id="elh_questions_answers_question_active" class="questions_answers_question_active">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_active->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_active->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_active->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_section_id->Visible) { // question_section_id ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_section_id) == "") { ?>
		<th data-name="question_section_id" class="<?php echo $questions_answers_list->question_section_id->headerCellClass() ?>"><div id="elh_questions_answers_question_section_id" class="questions_answers_question_section_id"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_section_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_section_id" class="<?php echo $questions_answers_list->question_section_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_section_id) ?>', 1);"><div id="elh_questions_answers_question_section_id" class="questions_answers_question_section_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_section_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_section_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_section_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_type->Visible) { // question_type ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_type) == "") { ?>
		<th data-name="question_type" class="<?php echo $questions_answers_list->question_type->headerCellClass() ?>"><div id="elh_questions_answers_question_type" class="questions_answers_question_type"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_type" class="<?php echo $questions_answers_list->question_type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_type) ?>', 1);"><div id="elh_questions_answers_question_type" class="questions_answers_question_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_type->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_has_recommendations->Visible) { // question_has_recommendations ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_has_recommendations) == "") { ?>
		<th data-name="question_has_recommendations" class="<?php echo $questions_answers_list->question_has_recommendations->headerCellClass() ?>"><div id="elh_questions_answers_question_has_recommendations" class="questions_answers_question_has_recommendations"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_has_recommendations->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_has_recommendations" class="<?php echo $questions_answers_list->question_has_recommendations->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_has_recommendations) ?>', 1);"><div id="elh_questions_answers_question_has_recommendations" class="questions_answers_question_has_recommendations">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_has_recommendations->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_has_recommendations->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_has_recommendations->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_group_id->Visible) { // question_group_id ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_group_id) == "") { ?>
		<th data-name="question_group_id" class="<?php echo $questions_answers_list->question_group_id->headerCellClass() ?>"><div id="elh_questions_answers_question_group_id" class="questions_answers_question_group_id"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_group_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_group_id" class="<?php echo $questions_answers_list->question_group_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_group_id) ?>', 1);"><div id="elh_questions_answers_question_group_id" class="questions_answers_question_group_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_group_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_group_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_group_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_category_id->Visible) { // question_category_id ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_category_id) == "") { ?>
		<th data-name="question_category_id" class="<?php echo $questions_answers_list->question_category_id->headerCellClass() ?>"><div id="elh_questions_answers_question_category_id" class="questions_answers_question_category_id"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_category_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_category_id" class="<?php echo $questions_answers_list->question_category_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_category_id) ?>', 1);"><div id="elh_questions_answers_question_category_id" class="questions_answers_question_category_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_category_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_category_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_category_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_order->Visible) { // question_order ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_order) == "") { ?>
		<th data-name="question_order" class="<?php echo $questions_answers_list->question_order->headerCellClass() ?>"><div id="elh_questions_answers_question_order" class="questions_answers_question_order"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_order" class="<?php echo $questions_answers_list->question_order->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_order) ?>', 1);"><div id="elh_questions_answers_question_order" class="questions_answers_question_order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_order->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_order->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_order->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->answer_id->Visible) { // answer_id ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->answer_id) == "") { ?>
		<th data-name="answer_id" class="<?php echo $questions_answers_list->answer_id->headerCellClass() ?>"><div id="elh_questions_answers_answer_id" class="questions_answers_answer_id"><div class="ew-table-header-caption"><?php echo $questions_answers_list->answer_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="answer_id" class="<?php echo $questions_answers_list->answer_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->answer_id) ?>', 1);"><div id="elh_questions_answers_answer_id" class="questions_answers_answer_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->answer_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->answer_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->answer_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->answer_response->Visible) { // answer_response ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->answer_response) == "") { ?>
		<th data-name="answer_response" class="<?php echo $questions_answers_list->answer_response->headerCellClass() ?>"><div id="elh_questions_answers_answer_response" class="questions_answers_answer_response"><div class="ew-table-header-caption"><?php echo $questions_answers_list->answer_response->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="answer_response" class="<?php echo $questions_answers_list->answer_response->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->answer_response) ?>', 1);"><div id="elh_questions_answers_answer_response" class="questions_answers_answer_response">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->answer_response->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->answer_response->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->answer_response->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->answer_score->Visible) { // answer_score ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->answer_score) == "") { ?>
		<th data-name="answer_score" class="<?php echo $questions_answers_list->answer_score->headerCellClass() ?>"><div id="elh_questions_answers_answer_score" class="questions_answers_answer_score"><div class="ew-table-header-caption"><?php echo $questions_answers_list->answer_score->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="answer_score" class="<?php echo $questions_answers_list->answer_score->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->answer_score) ?>', 1);"><div id="elh_questions_answers_answer_score" class="questions_answers_answer_score">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->answer_score->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->answer_score->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->answer_score->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_id->Visible) { // assessment_id ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_id) == "") { ?>
		<th data-name="assessment_id" class="<?php echo $questions_answers_list->assessment_id->headerCellClass() ?>"><div id="elh_questions_answers_assessment_id" class="questions_answers_assessment_id"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_id" class="<?php echo $questions_answers_list->assessment_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_id) ?>', 1);"><div id="elh_questions_answers_assessment_id" class="questions_answers_assessment_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->answer_weight->Visible) { // answer_weight ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->answer_weight) == "") { ?>
		<th data-name="answer_weight" class="<?php echo $questions_answers_list->answer_weight->headerCellClass() ?>"><div id="elh_questions_answers_answer_weight" class="questions_answers_answer_weight"><div class="ew-table-header-caption"><?php echo $questions_answers_list->answer_weight->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="answer_weight" class="<?php echo $questions_answers_list->answer_weight->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->answer_weight) ?>', 1);"><div id="elh_questions_answers_answer_weight" class="questions_answers_answer_weight">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->answer_weight->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->answer_weight->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->answer_weight->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->answer_section_id->Visible) { // answer_section_id ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->answer_section_id) == "") { ?>
		<th data-name="answer_section_id" class="<?php echo $questions_answers_list->answer_section_id->headerCellClass() ?>"><div id="elh_questions_answers_answer_section_id" class="questions_answers_answer_section_id"><div class="ew-table-header-caption"><?php echo $questions_answers_list->answer_section_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="answer_section_id" class="<?php echo $questions_answers_list->answer_section_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->answer_section_id) ?>', 1);"><div id="elh_questions_answers_answer_section_id" class="questions_answers_answer_section_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->answer_section_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->answer_section_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->answer_section_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_type_name->Visible) { // question_type_name ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_type_name) == "") { ?>
		<th data-name="question_type_name" class="<?php echo $questions_answers_list->question_type_name->headerCellClass() ?>"><div id="elh_questions_answers_question_type_name" class="questions_answers_question_type_name"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_type_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_type_name" class="<?php echo $questions_answers_list->question_type_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_type_name) ?>', 1);"><div id="elh_questions_answers_question_type_name" class="questions_answers_question_type_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_type_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_type_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_type_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_group_name->Visible) { // question_group_name ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_group_name) == "") { ?>
		<th data-name="question_group_name" class="<?php echo $questions_answers_list->question_group_name->headerCellClass() ?>"><div id="elh_questions_answers_question_group_name" class="questions_answers_question_group_name"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_group_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_group_name" class="<?php echo $questions_answers_list->question_group_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_group_name) ?>', 1);"><div id="elh_questions_answers_question_group_name" class="questions_answers_question_group_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_group_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_group_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_group_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->question_category_name->Visible) { // question_category_name ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->question_category_name) == "") { ?>
		<th data-name="question_category_name" class="<?php echo $questions_answers_list->question_category_name->headerCellClass() ?>"><div id="elh_questions_answers_question_category_name" class="questions_answers_question_category_name"><div class="ew-table-header-caption"><?php echo $questions_answers_list->question_category_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_category_name" class="<?php echo $questions_answers_list->question_category_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->question_category_name) ?>', 1);"><div id="elh_questions_answers_question_category_name" class="questions_answers_question_category_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->question_category_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->question_category_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->question_category_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_customer_id->Visible) { // assessment_customer_id ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_customer_id) == "") { ?>
		<th data-name="assessment_customer_id" class="<?php echo $questions_answers_list->assessment_customer_id->headerCellClass() ?>"><div id="elh_questions_answers_assessment_customer_id" class="questions_answers_assessment_customer_id"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_customer_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_customer_id" class="<?php echo $questions_answers_list->assessment_customer_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_customer_id) ?>', 1);"><div id="elh_questions_answers_assessment_customer_id" class="questions_answers_assessment_customer_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_customer_id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_customer_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_customer_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_customer_first_name->Visible) { // assessment_customer_first_name ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_customer_first_name) == "") { ?>
		<th data-name="assessment_customer_first_name" class="<?php echo $questions_answers_list->assessment_customer_first_name->headerCellClass() ?>"><div id="elh_questions_answers_assessment_customer_first_name" class="questions_answers_assessment_customer_first_name"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_customer_first_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_customer_first_name" class="<?php echo $questions_answers_list->assessment_customer_first_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_customer_first_name) ?>', 1);"><div id="elh_questions_answers_assessment_customer_first_name" class="questions_answers_assessment_customer_first_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_customer_first_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_customer_first_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_customer_first_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_status->Visible) { // assessment_status ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_status) == "") { ?>
		<th data-name="assessment_status" class="<?php echo $questions_answers_list->assessment_status->headerCellClass() ?>"><div id="elh_questions_answers_assessment_status" class="questions_answers_assessment_status"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_status" class="<?php echo $questions_answers_list->assessment_status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_status) ?>', 1);"><div id="elh_questions_answers_assessment_status" class="questions_answers_assessment_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_status->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_total_score->Visible) { // assessment_total_score ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_total_score) == "") { ?>
		<th data-name="assessment_total_score" class="<?php echo $questions_answers_list->assessment_total_score->headerCellClass() ?>"><div id="elh_questions_answers_assessment_total_score" class="questions_answers_assessment_total_score"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_total_score->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_total_score" class="<?php echo $questions_answers_list->assessment_total_score->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_total_score) ?>', 1);"><div id="elh_questions_answers_assessment_total_score" class="questions_answers_assessment_total_score">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_total_score->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_total_score->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_total_score->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_customer_last_name->Visible) { // assessment_customer_last_name ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_customer_last_name) == "") { ?>
		<th data-name="assessment_customer_last_name" class="<?php echo $questions_answers_list->assessment_customer_last_name->headerCellClass() ?>"><div id="elh_questions_answers_assessment_customer_last_name" class="questions_answers_assessment_customer_last_name"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_customer_last_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_customer_last_name" class="<?php echo $questions_answers_list->assessment_customer_last_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_customer_last_name) ?>', 1);"><div id="elh_questions_answers_assessment_customer_last_name" class="questions_answers_assessment_customer_last_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_customer_last_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_customer_last_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_customer_last_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_user_id->Visible) { // assessment_user_id ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_user_id) == "") { ?>
		<th data-name="assessment_user_id" class="<?php echo $questions_answers_list->assessment_user_id->headerCellClass() ?>"><div id="elh_questions_answers_assessment_user_id" class="questions_answers_assessment_user_id"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_user_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_user_id" class="<?php echo $questions_answers_list->assessment_user_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_user_id) ?>', 1);"><div id="elh_questions_answers_assessment_user_id" class="questions_answers_assessment_user_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_user_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_user_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_user_first_name->Visible) { // assessment_user_first_name ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_user_first_name) == "") { ?>
		<th data-name="assessment_user_first_name" class="<?php echo $questions_answers_list->assessment_user_first_name->headerCellClass() ?>"><div id="elh_questions_answers_assessment_user_first_name" class="questions_answers_assessment_user_first_name"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_user_first_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_user_first_name" class="<?php echo $questions_answers_list->assessment_user_first_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_user_first_name) ?>', 1);"><div id="elh_questions_answers_assessment_user_first_name" class="questions_answers_assessment_user_first_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_user_first_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_user_first_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_user_first_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_user_last_name->Visible) { // assessment_user_last_name ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_user_last_name) == "") { ?>
		<th data-name="assessment_user_last_name" class="<?php echo $questions_answers_list->assessment_user_last_name->headerCellClass() ?>"><div id="elh_questions_answers_assessment_user_last_name" class="questions_answers_assessment_user_last_name"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_user_last_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_user_last_name" class="<?php echo $questions_answers_list->assessment_user_last_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_user_last_name) ?>', 1);"><div id="elh_questions_answers_assessment_user_last_name" class="questions_answers_assessment_user_last_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_user_last_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_user_last_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_user_last_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_user_email->Visible) { // assessment_user_email ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_user_email) == "") { ?>
		<th data-name="assessment_user_email" class="<?php echo $questions_answers_list->assessment_user_email->headerCellClass() ?>"><div id="elh_questions_answers_assessment_user_email" class="questions_answers_assessment_user_email"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_user_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_user_email" class="<?php echo $questions_answers_list->assessment_user_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_user_email) ?>', 1);"><div id="elh_questions_answers_assessment_user_email" class="questions_answers_assessment_user_email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_user_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_user_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_user_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_personal_id->Visible) { // assessment_personal_id ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_personal_id) == "") { ?>
		<th data-name="assessment_personal_id" class="<?php echo $questions_answers_list->assessment_personal_id->headerCellClass() ?>"><div id="elh_questions_answers_assessment_personal_id" class="questions_answers_assessment_personal_id"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_personal_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_personal_id" class="<?php echo $questions_answers_list->assessment_personal_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_personal_id) ?>', 1);"><div id="elh_questions_answers_assessment_personal_id" class="questions_answers_assessment_personal_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_personal_id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_personal_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_personal_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_customer_age->Visible) { // assessment_customer_age ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_customer_age) == "") { ?>
		<th data-name="assessment_customer_age" class="<?php echo $questions_answers_list->assessment_customer_age->headerCellClass() ?>"><div id="elh_questions_answers_assessment_customer_age" class="questions_answers_assessment_customer_age"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_customer_age->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_customer_age" class="<?php echo $questions_answers_list->assessment_customer_age->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_customer_age) ?>', 1);"><div id="elh_questions_answers_assessment_customer_age" class="questions_answers_assessment_customer_age">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_customer_age->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_customer_age->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_customer_age->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_sex->Visible) { // assessment_sex ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_sex) == "") { ?>
		<th data-name="assessment_sex" class="<?php echo $questions_answers_list->assessment_sex->headerCellClass() ?>"><div id="elh_questions_answers_assessment_sex" class="questions_answers_assessment_sex"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_sex" class="<?php echo $questions_answers_list->assessment_sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_sex) ?>', 1);"><div id="elh_questions_answers_assessment_sex" class="questions_answers_assessment_sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_address->Visible) { // assessment_address ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_address) == "") { ?>
		<th data-name="assessment_address" class="<?php echo $questions_answers_list->assessment_address->headerCellClass() ?>"><div id="elh_questions_answers_assessment_address" class="questions_answers_assessment_address"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_address" class="<?php echo $questions_answers_list->assessment_address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_address) ?>', 1);"><div id="elh_questions_answers_assessment_address" class="questions_answers_assessment_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_lat->Visible) { // assessment_lat ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_lat) == "") { ?>
		<th data-name="assessment_lat" class="<?php echo $questions_answers_list->assessment_lat->headerCellClass() ?>"><div id="elh_questions_answers_assessment_lat" class="questions_answers_assessment_lat"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_lat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_lat" class="<?php echo $questions_answers_list->assessment_lat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_lat) ?>', 1);"><div id="elh_questions_answers_assessment_lat" class="questions_answers_assessment_lat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_lat->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_lat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_lat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_lon->Visible) { // assessment_lon ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_lon) == "") { ?>
		<th data-name="assessment_lon" class="<?php echo $questions_answers_list->assessment_lon->headerCellClass() ?>"><div id="elh_questions_answers_assessment_lon" class="questions_answers_assessment_lon"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_lon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_lon" class="<?php echo $questions_answers_list->assessment_lon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_lon) ?>', 1);"><div id="elh_questions_answers_assessment_lon" class="questions_answers_assessment_lon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_lon->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_lon->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_lon->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_loan_purpose->Visible) { // assessment_loan_purpose ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_loan_purpose) == "") { ?>
		<th data-name="assessment_loan_purpose" class="<?php echo $questions_answers_list->assessment_loan_purpose->headerCellClass() ?>"><div id="elh_questions_answers_assessment_loan_purpose" class="questions_answers_assessment_loan_purpose"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_loan_purpose->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_loan_purpose" class="<?php echo $questions_answers_list->assessment_loan_purpose->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_loan_purpose) ?>', 1);"><div id="elh_questions_answers_assessment_loan_purpose" class="questions_answers_assessment_loan_purpose">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_loan_purpose->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_loan_purpose->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_loan_purpose->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->assessment_loan_section->Visible) { // assessment_loan_section ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->assessment_loan_section) == "") { ?>
		<th data-name="assessment_loan_section" class="<?php echo $questions_answers_list->assessment_loan_section->headerCellClass() ?>"><div id="elh_questions_answers_assessment_loan_section" class="questions_answers_assessment_loan_section"><div class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_loan_section->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_loan_section" class="<?php echo $questions_answers_list->assessment_loan_section->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->assessment_loan_section) ?>', 1);"><div id="elh_questions_answers_assessment_loan_section" class="questions_answers_assessment_loan_section">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->assessment_loan_section->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->assessment_loan_section->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->assessment_loan_section->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->created_at->Visible) { // created_at ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $questions_answers_list->created_at->headerCellClass() ?>"><div id="elh_questions_answers_created_at" class="questions_answers_created_at"><div class="ew-table-header-caption"><?php echo $questions_answers_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $questions_answers_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->created_at) ?>', 1);"><div id="elh_questions_answers_created_at" class="questions_answers_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->updated_at->Visible) { // updated_at ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $questions_answers_list->updated_at->headerCellClass() ?>"><div id="elh_questions_answers_updated_at" class="questions_answers_updated_at"><div class="ew-table-header-caption"><?php echo $questions_answers_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $questions_answers_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->updated_at) ?>', 1);"><div id="elh_questions_answers_updated_at" class="questions_answers_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->loan_purpose_id->Visible) { // loan_purpose_id ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->loan_purpose_id) == "") { ?>
		<th data-name="loan_purpose_id" class="<?php echo $questions_answers_list->loan_purpose_id->headerCellClass() ?>"><div id="elh_questions_answers_loan_purpose_id" class="questions_answers_loan_purpose_id"><div class="ew-table-header-caption"><?php echo $questions_answers_list->loan_purpose_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="loan_purpose_id" class="<?php echo $questions_answers_list->loan_purpose_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->loan_purpose_id) ?>', 1);"><div id="elh_questions_answers_loan_purpose_id" class="questions_answers_loan_purpose_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->loan_purpose_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->loan_purpose_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->loan_purpose_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_answers_list->loan_sector_id->Visible) { // loan_sector_id ?>
	<?php if ($questions_answers_list->SortUrl($questions_answers_list->loan_sector_id) == "") { ?>
		<th data-name="loan_sector_id" class="<?php echo $questions_answers_list->loan_sector_id->headerCellClass() ?>"><div id="elh_questions_answers_loan_sector_id" class="questions_answers_loan_sector_id"><div class="ew-table-header-caption"><?php echo $questions_answers_list->loan_sector_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="loan_sector_id" class="<?php echo $questions_answers_list->loan_sector_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_answers_list->SortUrl($questions_answers_list->loan_sector_id) ?>', 1);"><div id="elh_questions_answers_loan_sector_id" class="questions_answers_loan_sector_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_answers_list->loan_sector_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_answers_list->loan_sector_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_answers_list->loan_sector_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$questions_answers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($questions_answers_list->ExportAll && $questions_answers_list->isExport()) {
	$questions_answers_list->StopRecord = $questions_answers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($questions_answers_list->TotalRecords > $questions_answers_list->StartRecord + $questions_answers_list->DisplayRecords - 1)
		$questions_answers_list->StopRecord = $questions_answers_list->StartRecord + $questions_answers_list->DisplayRecords - 1;
	else
		$questions_answers_list->StopRecord = $questions_answers_list->TotalRecords;
}
$questions_answers_list->RecordCount = $questions_answers_list->StartRecord - 1;
if ($questions_answers_list->Recordset && !$questions_answers_list->Recordset->EOF) {
	$questions_answers_list->Recordset->moveFirst();
	$selectLimit = $questions_answers_list->UseSelectLimit;
	if (!$selectLimit && $questions_answers_list->StartRecord > 1)
		$questions_answers_list->Recordset->move($questions_answers_list->StartRecord - 1);
} elseif (!$questions_answers->AllowAddDeleteRow && $questions_answers_list->StopRecord == 0) {
	$questions_answers_list->StopRecord = $questions_answers->GridAddRowCount;
}

// Initialize aggregate
$questions_answers->RowType = ROWTYPE_AGGREGATEINIT;
$questions_answers->resetAttributes();
$questions_answers_list->renderRow();
while ($questions_answers_list->RecordCount < $questions_answers_list->StopRecord) {
	$questions_answers_list->RecordCount++;
	if ($questions_answers_list->RecordCount >= $questions_answers_list->StartRecord) {
		$questions_answers_list->RowCount++;

		// Set up key count
		$questions_answers_list->KeyCount = $questions_answers_list->RowIndex;

		// Init row class and style
		$questions_answers->resetAttributes();
		$questions_answers->CssClass = "";
		if ($questions_answers_list->isGridAdd()) {
		} else {
			$questions_answers_list->loadRowValues($questions_answers_list->Recordset); // Load row values
		}
		$questions_answers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$questions_answers->RowAttrs->merge(["data-rowindex" => $questions_answers_list->RowCount, "id" => "r" . $questions_answers_list->RowCount . "_questions_answers", "data-rowtype" => $questions_answers->RowType]);

		// Render row
		$questions_answers_list->renderRow();

		// Render list options
		$questions_answers_list->renderListOptions();
?>
	<tr <?php echo $questions_answers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$questions_answers_list->ListOptions->render("body", "left", $questions_answers_list->RowCount);
?>
	<?php if ($questions_answers_list->question_id->Visible) { // question_id ?>
		<td data-name="question_id" <?php echo $questions_answers_list->question_id->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_id">
<span<?php echo $questions_answers_list->question_id->viewAttributes() ?>><?php echo $questions_answers_list->question_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_title->Visible) { // question_title ?>
		<td data-name="question_title" <?php echo $questions_answers_list->question_title->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_title">
<span<?php echo $questions_answers_list->question_title->viewAttributes() ?>><?php echo $questions_answers_list->question_title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_placeholder->Visible) { // question_placeholder ?>
		<td data-name="question_placeholder" <?php echo $questions_answers_list->question_placeholder->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_placeholder">
<span<?php echo $questions_answers_list->question_placeholder->viewAttributes() ?>><?php echo $questions_answers_list->question_placeholder->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_questions->Visible) { // question_questions ?>
		<td data-name="question_questions" <?php echo $questions_answers_list->question_questions->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_questions">
<span<?php echo $questions_answers_list->question_questions->viewAttributes() ?>><?php echo $questions_answers_list->question_questions->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_scores->Visible) { // question_scores ?>
		<td data-name="question_scores" <?php echo $questions_answers_list->question_scores->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_scores">
<span<?php echo $questions_answers_list->question_scores->viewAttributes() ?>><?php echo $questions_answers_list->question_scores->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_active->Visible) { // question_active ?>
		<td data-name="question_active" <?php echo $questions_answers_list->question_active->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_active">
<span<?php echo $questions_answers_list->question_active->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_question_active" class="custom-control-input" value="<?php echo $questions_answers_list->question_active->getViewValue() ?>" disabled<?php if (ConvertToBool($questions_answers_list->question_active->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_question_active"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_section_id->Visible) { // question_section_id ?>
		<td data-name="question_section_id" <?php echo $questions_answers_list->question_section_id->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_section_id">
<span<?php echo $questions_answers_list->question_section_id->viewAttributes() ?>><?php echo $questions_answers_list->question_section_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_type->Visible) { // question_type ?>
		<td data-name="question_type" <?php echo $questions_answers_list->question_type->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_type">
<span<?php echo $questions_answers_list->question_type->viewAttributes() ?>><?php echo $questions_answers_list->question_type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_has_recommendations->Visible) { // question_has_recommendations ?>
		<td data-name="question_has_recommendations" <?php echo $questions_answers_list->question_has_recommendations->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_has_recommendations">
<span<?php echo $questions_answers_list->question_has_recommendations->viewAttributes() ?>><?php echo $questions_answers_list->question_has_recommendations->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_group_id->Visible) { // question_group_id ?>
		<td data-name="question_group_id" <?php echo $questions_answers_list->question_group_id->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_group_id">
<span<?php echo $questions_answers_list->question_group_id->viewAttributes() ?>><?php echo $questions_answers_list->question_group_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_category_id->Visible) { // question_category_id ?>
		<td data-name="question_category_id" <?php echo $questions_answers_list->question_category_id->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_category_id">
<span<?php echo $questions_answers_list->question_category_id->viewAttributes() ?>><?php echo $questions_answers_list->question_category_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_order->Visible) { // question_order ?>
		<td data-name="question_order" <?php echo $questions_answers_list->question_order->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_order">
<span<?php echo $questions_answers_list->question_order->viewAttributes() ?>><?php echo $questions_answers_list->question_order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->answer_id->Visible) { // answer_id ?>
		<td data-name="answer_id" <?php echo $questions_answers_list->answer_id->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_answer_id">
<span<?php echo $questions_answers_list->answer_id->viewAttributes() ?>><?php echo $questions_answers_list->answer_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->answer_response->Visible) { // answer_response ?>
		<td data-name="answer_response" <?php echo $questions_answers_list->answer_response->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_answer_response">
<span<?php echo $questions_answers_list->answer_response->viewAttributes() ?>><?php echo $questions_answers_list->answer_response->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->answer_score->Visible) { // answer_score ?>
		<td data-name="answer_score" <?php echo $questions_answers_list->answer_score->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_answer_score">
<span<?php echo $questions_answers_list->answer_score->viewAttributes() ?>><?php echo $questions_answers_list->answer_score->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_id->Visible) { // assessment_id ?>
		<td data-name="assessment_id" <?php echo $questions_answers_list->assessment_id->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_id">
<span<?php echo $questions_answers_list->assessment_id->viewAttributes() ?>><?php echo $questions_answers_list->assessment_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->answer_weight->Visible) { // answer_weight ?>
		<td data-name="answer_weight" <?php echo $questions_answers_list->answer_weight->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_answer_weight">
<span<?php echo $questions_answers_list->answer_weight->viewAttributes() ?>><?php echo $questions_answers_list->answer_weight->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->answer_section_id->Visible) { // answer_section_id ?>
		<td data-name="answer_section_id" <?php echo $questions_answers_list->answer_section_id->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_answer_section_id">
<span<?php echo $questions_answers_list->answer_section_id->viewAttributes() ?>><?php echo $questions_answers_list->answer_section_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_type_name->Visible) { // question_type_name ?>
		<td data-name="question_type_name" <?php echo $questions_answers_list->question_type_name->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_type_name">
<span<?php echo $questions_answers_list->question_type_name->viewAttributes() ?>><?php echo $questions_answers_list->question_type_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_group_name->Visible) { // question_group_name ?>
		<td data-name="question_group_name" <?php echo $questions_answers_list->question_group_name->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_group_name">
<span<?php echo $questions_answers_list->question_group_name->viewAttributes() ?>><?php echo $questions_answers_list->question_group_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->question_category_name->Visible) { // question_category_name ?>
		<td data-name="question_category_name" <?php echo $questions_answers_list->question_category_name->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_question_category_name">
<span<?php echo $questions_answers_list->question_category_name->viewAttributes() ?>><?php echo $questions_answers_list->question_category_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_customer_id->Visible) { // assessment_customer_id ?>
		<td data-name="assessment_customer_id" <?php echo $questions_answers_list->assessment_customer_id->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_customer_id">
<span<?php echo $questions_answers_list->assessment_customer_id->viewAttributes() ?>><?php echo $questions_answers_list->assessment_customer_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_customer_first_name->Visible) { // assessment_customer_first_name ?>
		<td data-name="assessment_customer_first_name" <?php echo $questions_answers_list->assessment_customer_first_name->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_customer_first_name">
<span<?php echo $questions_answers_list->assessment_customer_first_name->viewAttributes() ?>><?php echo $questions_answers_list->assessment_customer_first_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_status->Visible) { // assessment_status ?>
		<td data-name="assessment_status" <?php echo $questions_answers_list->assessment_status->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_status">
<span<?php echo $questions_answers_list->assessment_status->viewAttributes() ?>><?php echo $questions_answers_list->assessment_status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_total_score->Visible) { // assessment_total_score ?>
		<td data-name="assessment_total_score" <?php echo $questions_answers_list->assessment_total_score->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_total_score">
<span<?php echo $questions_answers_list->assessment_total_score->viewAttributes() ?>><?php echo $questions_answers_list->assessment_total_score->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_customer_last_name->Visible) { // assessment_customer_last_name ?>
		<td data-name="assessment_customer_last_name" <?php echo $questions_answers_list->assessment_customer_last_name->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_customer_last_name">
<span<?php echo $questions_answers_list->assessment_customer_last_name->viewAttributes() ?>><?php echo $questions_answers_list->assessment_customer_last_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_user_id->Visible) { // assessment_user_id ?>
		<td data-name="assessment_user_id" <?php echo $questions_answers_list->assessment_user_id->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_user_id">
<span<?php echo $questions_answers_list->assessment_user_id->viewAttributes() ?>><?php echo $questions_answers_list->assessment_user_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_user_first_name->Visible) { // assessment_user_first_name ?>
		<td data-name="assessment_user_first_name" <?php echo $questions_answers_list->assessment_user_first_name->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_user_first_name">
<span<?php echo $questions_answers_list->assessment_user_first_name->viewAttributes() ?>><?php echo $questions_answers_list->assessment_user_first_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_user_last_name->Visible) { // assessment_user_last_name ?>
		<td data-name="assessment_user_last_name" <?php echo $questions_answers_list->assessment_user_last_name->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_user_last_name">
<span<?php echo $questions_answers_list->assessment_user_last_name->viewAttributes() ?>><?php echo $questions_answers_list->assessment_user_last_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_user_email->Visible) { // assessment_user_email ?>
		<td data-name="assessment_user_email" <?php echo $questions_answers_list->assessment_user_email->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_user_email">
<span<?php echo $questions_answers_list->assessment_user_email->viewAttributes() ?>><?php echo $questions_answers_list->assessment_user_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_personal_id->Visible) { // assessment_personal_id ?>
		<td data-name="assessment_personal_id" <?php echo $questions_answers_list->assessment_personal_id->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_personal_id">
<span<?php echo $questions_answers_list->assessment_personal_id->viewAttributes() ?>><?php echo $questions_answers_list->assessment_personal_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_customer_age->Visible) { // assessment_customer_age ?>
		<td data-name="assessment_customer_age" <?php echo $questions_answers_list->assessment_customer_age->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_customer_age">
<span<?php echo $questions_answers_list->assessment_customer_age->viewAttributes() ?>><?php echo $questions_answers_list->assessment_customer_age->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_sex->Visible) { // assessment_sex ?>
		<td data-name="assessment_sex" <?php echo $questions_answers_list->assessment_sex->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_sex">
<span<?php echo $questions_answers_list->assessment_sex->viewAttributes() ?>><?php echo $questions_answers_list->assessment_sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_address->Visible) { // assessment_address ?>
		<td data-name="assessment_address" <?php echo $questions_answers_list->assessment_address->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_address">
<span<?php echo $questions_answers_list->assessment_address->viewAttributes() ?>><?php echo $questions_answers_list->assessment_address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_lat->Visible) { // assessment_lat ?>
		<td data-name="assessment_lat" <?php echo $questions_answers_list->assessment_lat->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_lat">
<span<?php echo $questions_answers_list->assessment_lat->viewAttributes() ?>><?php echo $questions_answers_list->assessment_lat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_lon->Visible) { // assessment_lon ?>
		<td data-name="assessment_lon" <?php echo $questions_answers_list->assessment_lon->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_lon">
<span<?php echo $questions_answers_list->assessment_lon->viewAttributes() ?>><?php echo $questions_answers_list->assessment_lon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_loan_purpose->Visible) { // assessment_loan_purpose ?>
		<td data-name="assessment_loan_purpose" <?php echo $questions_answers_list->assessment_loan_purpose->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_loan_purpose">
<span<?php echo $questions_answers_list->assessment_loan_purpose->viewAttributes() ?>><?php echo $questions_answers_list->assessment_loan_purpose->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->assessment_loan_section->Visible) { // assessment_loan_section ?>
		<td data-name="assessment_loan_section" <?php echo $questions_answers_list->assessment_loan_section->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_assessment_loan_section">
<span<?php echo $questions_answers_list->assessment_loan_section->viewAttributes() ?>><?php echo $questions_answers_list->assessment_loan_section->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $questions_answers_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_created_at">
<span<?php echo $questions_answers_list->created_at->viewAttributes() ?>><?php echo $questions_answers_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $questions_answers_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_updated_at">
<span<?php echo $questions_answers_list->updated_at->viewAttributes() ?>><?php echo $questions_answers_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->loan_purpose_id->Visible) { // loan_purpose_id ?>
		<td data-name="loan_purpose_id" <?php echo $questions_answers_list->loan_purpose_id->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_loan_purpose_id">
<span<?php echo $questions_answers_list->loan_purpose_id->viewAttributes() ?>><?php echo $questions_answers_list->loan_purpose_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_answers_list->loan_sector_id->Visible) { // loan_sector_id ?>
		<td data-name="loan_sector_id" <?php echo $questions_answers_list->loan_sector_id->cellAttributes() ?>>
<span id="el<?php echo $questions_answers_list->RowCount ?>_questions_answers_loan_sector_id">
<span<?php echo $questions_answers_list->loan_sector_id->viewAttributes() ?>><?php echo $questions_answers_list->loan_sector_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$questions_answers_list->ListOptions->render("body", "right", $questions_answers_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$questions_answers_list->isGridAdd())
		$questions_answers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$questions_answers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($questions_answers_list->Recordset)
	$questions_answers_list->Recordset->Close();
?>
<?php if (!$questions_answers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$questions_answers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $questions_answers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $questions_answers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($questions_answers_list->TotalRecords == 0 && !$questions_answers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $questions_answers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$questions_answers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$questions_answers_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$questions_answers_list->terminate();
?>
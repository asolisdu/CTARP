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
$assessments_list = new assessments_list();

// Run the page
$assessments_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$assessments_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$assessments_list->isExport()) { ?>
<script>
var fassessmentslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fassessmentslist = currentForm = new ew.Form("fassessmentslist", "list");
	fassessmentslist.formKeyCountName = '<?php echo $assessments_list->FormKeyCountName ?>';
	loadjs.done("fassessmentslist");
});
var fassessmentslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fassessmentslistsrch = currentSearchForm = new ew.Form("fassessmentslistsrch");

	// Validate function for search
	fassessmentslistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_user_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($assessments_list->user_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_total_score");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($assessments_list->total_score->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fassessmentslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fassessmentslistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fassessmentslistsrch.lists["x_user_id"] = <?php echo $assessments_list->user_id->Lookup->toClientList($assessments_list) ?>;
	fassessmentslistsrch.lists["x_user_id"].options = <?php echo JsonEncode($assessments_list->user_id->lookupOptions()) ?>;
	fassessmentslistsrch.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fassessmentslistsrch.filterList = <?php echo $assessments_list->getFilterList() ?>;
	loadjs.done("fassessmentslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$assessments_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($assessments_list->TotalRecords > 0 && $assessments_list->ExportOptions->visible()) { ?>
<?php $assessments_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($assessments_list->ImportOptions->visible()) { ?>
<?php $assessments_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($assessments_list->SearchOptions->visible()) { ?>
<?php $assessments_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($assessments_list->FilterOptions->visible()) { ?>
<?php $assessments_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$assessments_list->isExport() || Config("EXPORT_MASTER_RECORD") && $assessments_list->isExport("print")) { ?>
<?php
if ($assessments_list->DbMasterFilter != "" && $assessments->getCurrentMasterTable() == "users") {
	if ($assessments_list->MasterRecordExists) {
		include_once "usersmaster.php";
	}
}
?>
<?php
if ($assessments_list->DbMasterFilter != "" && $assessments->getCurrentMasterTable() == "loan_purposes") {
	if ($assessments_list->MasterRecordExists) {
		include_once "loan_purposesmaster.php";
	}
}
?>
<?php
if ($assessments_list->DbMasterFilter != "" && $assessments->getCurrentMasterTable() == "loan_section") {
	if ($assessments_list->MasterRecordExists) {
		include_once "loan_sectionmaster.php";
	}
}
?>
<?php } ?>
<?php
$assessments_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$assessments_list->isExport() && !$assessments->CurrentAction) { ?>
<form name="fassessmentslistsrch" id="fassessmentslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fassessmentslistsrch-search-panel" class="<?php echo $assessments_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="assessments">
	<div class="ew-extended-search">
<?php

// Render search row
$assessments->RowType = ROWTYPE_SEARCH;
$assessments->resetAttributes();
$assessments_list->renderRow();
?>
<?php if ($assessments_list->user_id->Visible) { // user_id ?>
	<?php
		$assessments_list->SearchColumnCount++;
		if (($assessments_list->SearchColumnCount - 1) % $assessments_list->SearchFieldsPerRow == 0) {
			$assessments_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $assessments_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_user_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $assessments_list->user_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_user_id" id="z_user_id" value="=">
</span>
		<span id="el_assessments_user_id" class="ew-search-field">
<?php
$onchange = $assessments_list->user_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_list->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_user_id">
	<input type="text" class="form-control" name="sv_x_user_id" id="sv_x_user_id" value="<?php echo RemoveHtml($assessments_list->user_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($assessments_list->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_list->user_id->getPlaceHolder()) ?>"<?php echo $assessments_list->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_user_id" data-value-separator="<?php echo $assessments_list->user_id->displayValueSeparatorAttribute() ?>" name="x_user_id" id="x_user_id" value="<?php echo HtmlEncode($assessments_list->user_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentslistsrch"], function() {
	fassessmentslistsrch.createAutoSuggest({"id":"x_user_id","forceSelect":false});
});
</script>
<?php echo $assessments_list->user_id->Lookup->getParamTag($assessments_list, "p_x_user_id") ?>
</span>
	</div>
	<?php if ($assessments_list->SearchColumnCount % $assessments_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->customer_id->Visible) { // customer_id ?>
	<?php
		$assessments_list->SearchColumnCount++;
		if (($assessments_list->SearchColumnCount - 1) % $assessments_list->SearchFieldsPerRow == 0) {
			$assessments_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $assessments_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_customer_id" class="ew-cell form-group">
		<label for="x_customer_id" class="ew-search-caption ew-label"><?php echo $assessments_list->customer_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_customer_id" id="z_customer_id" value="LIKE">
</span>
		<span id="el_assessments_customer_id" class="ew-search-field">
<input type="text" data-table="assessments" data-field="x_customer_id" name="x_customer_id" id="x_customer_id" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_list->customer_id->getPlaceHolder()) ?>" value="<?php echo $assessments_list->customer_id->EditValue ?>"<?php echo $assessments_list->customer_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($assessments_list->SearchColumnCount % $assessments_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->customer_first_name->Visible) { // customer_first_name ?>
	<?php
		$assessments_list->SearchColumnCount++;
		if (($assessments_list->SearchColumnCount - 1) % $assessments_list->SearchFieldsPerRow == 0) {
			$assessments_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $assessments_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_customer_first_name" class="ew-cell form-group">
		<label for="x_customer_first_name" class="ew-search-caption ew-label"><?php echo $assessments_list->customer_first_name->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_customer_first_name" id="z_customer_first_name" value="LIKE">
</span>
		<span id="el_assessments_customer_first_name" class="ew-search-field">
<input type="text" data-table="assessments" data-field="x_customer_first_name" name="x_customer_first_name" id="x_customer_first_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_list->customer_first_name->getPlaceHolder()) ?>" value="<?php echo $assessments_list->customer_first_name->EditValue ?>"<?php echo $assessments_list->customer_first_name->editAttributes() ?>>
</span>
	</div>
	<?php if ($assessments_list->SearchColumnCount % $assessments_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->total_score->Visible) { // total_score ?>
	<?php
		$assessments_list->SearchColumnCount++;
		if (($assessments_list->SearchColumnCount - 1) % $assessments_list->SearchFieldsPerRow == 0) {
			$assessments_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $assessments_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_total_score" class="ew-cell form-group">
		<label for="x_total_score" class="ew-search-caption ew-label"><?php echo $assessments_list->total_score->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_total_score" id="z_total_score" value="=">
</span>
		<span id="el_assessments_total_score" class="ew-search-field">
<input type="text" data-table="assessments" data-field="x_total_score" name="x_total_score" id="x_total_score" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_list->total_score->getPlaceHolder()) ?>" value="<?php echo $assessments_list->total_score->EditValue ?>"<?php echo $assessments_list->total_score->editAttributes() ?>>
</span>
	</div>
	<?php if ($assessments_list->SearchColumnCount % $assessments_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($assessments_list->SearchColumnCount % $assessments_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $assessments_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($assessments_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($assessments_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $assessments_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($assessments_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($assessments_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($assessments_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($assessments_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $assessments_list->showPageHeader(); ?>
<?php
$assessments_list->showMessage();
?>
<?php if ($assessments_list->TotalRecords > 0 || $assessments->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($assessments_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> assessments">
<?php if (!$assessments_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$assessments_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $assessments_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $assessments_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fassessmentslist" id="fassessmentslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="assessments">
<?php if ($assessments->getCurrentMasterTable() == "users" && $assessments->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="users">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($assessments_list->user_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($assessments->getCurrentMasterTable() == "loan_purposes" && $assessments->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="loan_purposes">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($assessments_list->loan_purpose->getSessionValue()) ?>">
<?php } ?>
<?php if ($assessments->getCurrentMasterTable() == "loan_section" && $assessments->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="loan_section">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($assessments_list->loan_section->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_assessments" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($assessments_list->TotalRecords > 0 || $assessments_list->isGridEdit()) { ?>
<table id="tbl_assessmentslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$assessments->RowType = ROWTYPE_HEADER;

// Render list options
$assessments_list->renderListOptions();

// Render list options (header, left)
$assessments_list->ListOptions->render("header", "left");
?>
<?php if ($assessments_list->id->Visible) { // id ?>
	<?php if ($assessments_list->SortUrl($assessments_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $assessments_list->id->headerCellClass() ?>"><div id="elh_assessments_id" class="assessments_id"><div class="ew-table-header-caption"><?php echo $assessments_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $assessments_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->id) ?>', 1);"><div id="elh_assessments_id" class="assessments_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->user_id->Visible) { // user_id ?>
	<?php if ($assessments_list->SortUrl($assessments_list->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $assessments_list->user_id->headerCellClass() ?>"><div id="elh_assessments_user_id" class="assessments_user_id"><div class="ew-table-header-caption"><?php echo $assessments_list->user_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $assessments_list->user_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->user_id) ?>', 1);"><div id="elh_assessments_user_id" class="assessments_user_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->user_id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->user_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->user_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->customer_id->Visible) { // customer_id ?>
	<?php if ($assessments_list->SortUrl($assessments_list->customer_id) == "") { ?>
		<th data-name="customer_id" class="<?php echo $assessments_list->customer_id->headerCellClass() ?>"><div id="elh_assessments_customer_id" class="assessments_customer_id"><div class="ew-table-header-caption"><?php echo $assessments_list->customer_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_id" class="<?php echo $assessments_list->customer_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->customer_id) ?>', 1);"><div id="elh_assessments_customer_id" class="assessments_customer_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->customer_id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->customer_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->customer_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->customer_first_name->Visible) { // customer_first_name ?>
	<?php if ($assessments_list->SortUrl($assessments_list->customer_first_name) == "") { ?>
		<th data-name="customer_first_name" class="<?php echo $assessments_list->customer_first_name->headerCellClass() ?>"><div id="elh_assessments_customer_first_name" class="assessments_customer_first_name"><div class="ew-table-header-caption"><?php echo $assessments_list->customer_first_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_first_name" class="<?php echo $assessments_list->customer_first_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->customer_first_name) ?>', 1);"><div id="elh_assessments_customer_first_name" class="assessments_customer_first_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->customer_first_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->customer_first_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->customer_first_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->customer_age->Visible) { // customer_age ?>
	<?php if ($assessments_list->SortUrl($assessments_list->customer_age) == "") { ?>
		<th data-name="customer_age" class="<?php echo $assessments_list->customer_age->headerCellClass() ?>"><div id="elh_assessments_customer_age" class="assessments_customer_age"><div class="ew-table-header-caption"><?php echo $assessments_list->customer_age->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_age" class="<?php echo $assessments_list->customer_age->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->customer_age) ?>', 1);"><div id="elh_assessments_customer_age" class="assessments_customer_age">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->customer_age->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->customer_age->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->customer_age->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->sex->Visible) { // sex ?>
	<?php if ($assessments_list->SortUrl($assessments_list->sex) == "") { ?>
		<th data-name="sex" class="<?php echo $assessments_list->sex->headerCellClass() ?>"><div id="elh_assessments_sex" class="assessments_sex"><div class="ew-table-header-caption"><?php echo $assessments_list->sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sex" class="<?php echo $assessments_list->sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->sex) ?>', 1);"><div id="elh_assessments_sex" class="assessments_sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->address->Visible) { // address ?>
	<?php if ($assessments_list->SortUrl($assessments_list->address) == "") { ?>
		<th data-name="address" class="<?php echo $assessments_list->address->headerCellClass() ?>"><div id="elh_assessments_address" class="assessments_address"><div class="ew-table-header-caption"><?php echo $assessments_list->address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="address" class="<?php echo $assessments_list->address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->address) ?>', 1);"><div id="elh_assessments_address" class="assessments_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->total_score->Visible) { // total_score ?>
	<?php if ($assessments_list->SortUrl($assessments_list->total_score) == "") { ?>
		<th data-name="total_score" class="<?php echo $assessments_list->total_score->headerCellClass() ?>"><div id="elh_assessments_total_score" class="assessments_total_score"><div class="ew-table-header-caption"><?php echo $assessments_list->total_score->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_score" class="<?php echo $assessments_list->total_score->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->total_score) ?>', 1);"><div id="elh_assessments_total_score" class="assessments_total_score">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->total_score->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->total_score->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->total_score->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->status->Visible) { // status ?>
	<?php if ($assessments_list->SortUrl($assessments_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $assessments_list->status->headerCellClass() ?>"><div id="elh_assessments_status" class="assessments_status"><div class="ew-table-header-caption"><?php echo $assessments_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $assessments_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->status) ?>', 1);"><div id="elh_assessments_status" class="assessments_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->loan_purpose->Visible) { // loan_purpose ?>
	<?php if ($assessments_list->SortUrl($assessments_list->loan_purpose) == "") { ?>
		<th data-name="loan_purpose" class="<?php echo $assessments_list->loan_purpose->headerCellClass() ?>"><div id="elh_assessments_loan_purpose" class="assessments_loan_purpose"><div class="ew-table-header-caption"><?php echo $assessments_list->loan_purpose->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="loan_purpose" class="<?php echo $assessments_list->loan_purpose->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->loan_purpose) ?>', 1);"><div id="elh_assessments_loan_purpose" class="assessments_loan_purpose">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->loan_purpose->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->loan_purpose->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->loan_purpose->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->loan_section->Visible) { // loan_section ?>
	<?php if ($assessments_list->SortUrl($assessments_list->loan_section) == "") { ?>
		<th data-name="loan_section" class="<?php echo $assessments_list->loan_section->headerCellClass() ?>"><div id="elh_assessments_loan_section" class="assessments_loan_section"><div class="ew-table-header-caption"><?php echo $assessments_list->loan_section->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="loan_section" class="<?php echo $assessments_list->loan_section->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->loan_section) ?>', 1);"><div id="elh_assessments_loan_section" class="assessments_loan_section">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->loan_section->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->loan_section->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->loan_section->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->lat->Visible) { // lat ?>
	<?php if ($assessments_list->SortUrl($assessments_list->lat) == "") { ?>
		<th data-name="lat" class="<?php echo $assessments_list->lat->headerCellClass() ?>"><div id="elh_assessments_lat" class="assessments_lat"><div class="ew-table-header-caption"><?php echo $assessments_list->lat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lat" class="<?php echo $assessments_list->lat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->lat) ?>', 1);"><div id="elh_assessments_lat" class="assessments_lat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->lat->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->lat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->lat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->lon->Visible) { // lon ?>
	<?php if ($assessments_list->SortUrl($assessments_list->lon) == "") { ?>
		<th data-name="lon" class="<?php echo $assessments_list->lon->headerCellClass() ?>"><div id="elh_assessments_lon" class="assessments_lon"><div class="ew-table-header-caption"><?php echo $assessments_list->lon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lon" class="<?php echo $assessments_list->lon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->lon) ?>', 1);"><div id="elh_assessments_lon" class="assessments_lon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->lon->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->lon->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->lon->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->created_at->Visible) { // created_at ?>
	<?php if ($assessments_list->SortUrl($assessments_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $assessments_list->created_at->headerCellClass() ?>"><div id="elh_assessments_created_at" class="assessments_created_at"><div class="ew-table-header-caption"><?php echo $assessments_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $assessments_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->created_at) ?>', 1);"><div id="elh_assessments_created_at" class="assessments_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_list->updated_at->Visible) { // updated_at ?>
	<?php if ($assessments_list->SortUrl($assessments_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $assessments_list->updated_at->headerCellClass() ?>"><div id="elh_assessments_updated_at" class="assessments_updated_at"><div class="ew-table-header-caption"><?php echo $assessments_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $assessments_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assessments_list->SortUrl($assessments_list->updated_at) ?>', 1);"><div id="elh_assessments_updated_at" class="assessments_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$assessments_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($assessments_list->ExportAll && $assessments_list->isExport()) {
	$assessments_list->StopRecord = $assessments_list->TotalRecords;
} else {

	// Set the last record to display
	if ($assessments_list->TotalRecords > $assessments_list->StartRecord + $assessments_list->DisplayRecords - 1)
		$assessments_list->StopRecord = $assessments_list->StartRecord + $assessments_list->DisplayRecords - 1;
	else
		$assessments_list->StopRecord = $assessments_list->TotalRecords;
}
$assessments_list->RecordCount = $assessments_list->StartRecord - 1;
if ($assessments_list->Recordset && !$assessments_list->Recordset->EOF) {
	$assessments_list->Recordset->moveFirst();
	$selectLimit = $assessments_list->UseSelectLimit;
	if (!$selectLimit && $assessments_list->StartRecord > 1)
		$assessments_list->Recordset->move($assessments_list->StartRecord - 1);
} elseif (!$assessments->AllowAddDeleteRow && $assessments_list->StopRecord == 0) {
	$assessments_list->StopRecord = $assessments->GridAddRowCount;
}

// Initialize aggregate
$assessments->RowType = ROWTYPE_AGGREGATEINIT;
$assessments->resetAttributes();
$assessments_list->renderRow();
while ($assessments_list->RecordCount < $assessments_list->StopRecord) {
	$assessments_list->RecordCount++;
	if ($assessments_list->RecordCount >= $assessments_list->StartRecord) {
		$assessments_list->RowCount++;

		// Set up key count
		$assessments_list->KeyCount = $assessments_list->RowIndex;

		// Init row class and style
		$assessments->resetAttributes();
		$assessments->CssClass = "";
		if ($assessments_list->isGridAdd()) {
		} else {
			$assessments_list->loadRowValues($assessments_list->Recordset); // Load row values
		}
		$assessments->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$assessments->RowAttrs->merge(["data-rowindex" => $assessments_list->RowCount, "id" => "r" . $assessments_list->RowCount . "_assessments", "data-rowtype" => $assessments->RowType]);

		// Render row
		$assessments_list->renderRow();

		// Render list options
		$assessments_list->renderListOptions();
?>
	<tr <?php echo $assessments->rowAttributes() ?>>
<?php

// Render list options (body, left)
$assessments_list->ListOptions->render("body", "left", $assessments_list->RowCount);
?>
	<?php if ($assessments_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $assessments_list->id->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_id">
<span<?php echo $assessments_list->id->viewAttributes() ?>><?php echo $assessments_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->user_id->Visible) { // user_id ?>
		<td data-name="user_id" <?php echo $assessments_list->user_id->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_user_id">
<span<?php echo $assessments_list->user_id->viewAttributes() ?>><?php echo $assessments_list->user_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->customer_id->Visible) { // customer_id ?>
		<td data-name="customer_id" <?php echo $assessments_list->customer_id->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_customer_id">
<span<?php echo $assessments_list->customer_id->viewAttributes() ?>><?php echo $assessments_list->customer_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->customer_first_name->Visible) { // customer_first_name ?>
		<td data-name="customer_first_name" <?php echo $assessments_list->customer_first_name->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_customer_first_name">
<span<?php echo $assessments_list->customer_first_name->viewAttributes() ?>><?php echo $assessments_list->customer_first_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->customer_age->Visible) { // customer_age ?>
		<td data-name="customer_age" <?php echo $assessments_list->customer_age->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_customer_age">
<span<?php echo $assessments_list->customer_age->viewAttributes() ?>><?php echo $assessments_list->customer_age->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->sex->Visible) { // sex ?>
		<td data-name="sex" <?php echo $assessments_list->sex->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_sex">
<span<?php echo $assessments_list->sex->viewAttributes() ?>><?php echo $assessments_list->sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->address->Visible) { // address ?>
		<td data-name="address" <?php echo $assessments_list->address->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_address">
<span<?php echo $assessments_list->address->viewAttributes() ?>><?php echo $assessments_list->address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->total_score->Visible) { // total_score ?>
		<td data-name="total_score" <?php echo $assessments_list->total_score->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_total_score">
<span<?php echo $assessments_list->total_score->viewAttributes() ?>><?php echo $assessments_list->total_score->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $assessments_list->status->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_status">
<span<?php echo $assessments_list->status->viewAttributes() ?>><?php echo $assessments_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->loan_purpose->Visible) { // loan_purpose ?>
		<td data-name="loan_purpose" <?php echo $assessments_list->loan_purpose->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_loan_purpose">
<span<?php echo $assessments_list->loan_purpose->viewAttributes() ?>><?php echo $assessments_list->loan_purpose->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->loan_section->Visible) { // loan_section ?>
		<td data-name="loan_section" <?php echo $assessments_list->loan_section->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_loan_section">
<span<?php echo $assessments_list->loan_section->viewAttributes() ?>><?php echo $assessments_list->loan_section->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->lat->Visible) { // lat ?>
		<td data-name="lat" <?php echo $assessments_list->lat->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_lat">
<span<?php echo $assessments_list->lat->viewAttributes() ?>><?php echo $assessments_list->lat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->lon->Visible) { // lon ?>
		<td data-name="lon" <?php echo $assessments_list->lon->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_lon">
<span<?php echo $assessments_list->lon->viewAttributes() ?>><?php echo $assessments_list->lon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $assessments_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_created_at">
<span<?php echo $assessments_list->created_at->viewAttributes() ?>><?php echo $assessments_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assessments_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $assessments_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $assessments_list->RowCount ?>_assessments_updated_at">
<span<?php echo $assessments_list->updated_at->viewAttributes() ?>><?php echo $assessments_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$assessments_list->ListOptions->render("body", "right", $assessments_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$assessments_list->isGridAdd())
		$assessments_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$assessments->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($assessments_list->Recordset)
	$assessments_list->Recordset->Close();
?>
<?php if (!$assessments_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$assessments_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $assessments_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $assessments_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($assessments_list->TotalRecords == 0 && !$assessments->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $assessments_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$assessments_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$assessments_list->isExport()) { ?>
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
$assessments_list->terminate();
?>
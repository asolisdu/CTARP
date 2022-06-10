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
$view1_list = new view1_list();

// Run the page
$view1_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$view1_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$view1_list->isExport()) { ?>
<script>
var fview1list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fview1list = currentForm = new ew.Form("fview1list", "list");
	fview1list.formKeyCountName = '<?php echo $view1_list->FormKeyCountName ?>';
	loadjs.done("fview1list");
});
var fview1listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fview1listsrch = currentSearchForm = new ew.Form("fview1listsrch");

	// Validate function for search
	fview1listsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_total_score");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($view1_list->total_score->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fview1listsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fview1listsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	// Filters

	fview1listsrch.filterList = <?php echo $view1_list->getFilterList() ?>;
	loadjs.done("fview1listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$view1_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($view1_list->TotalRecords > 0 && $view1_list->ExportOptions->visible()) { ?>
<?php $view1_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($view1_list->ImportOptions->visible()) { ?>
<?php $view1_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($view1_list->SearchOptions->visible()) { ?>
<?php $view1_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($view1_list->FilterOptions->visible()) { ?>
<?php $view1_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$view1_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$view1_list->isExport() && !$view1->CurrentAction) { ?>
<form name="fview1listsrch" id="fview1listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fview1listsrch-search-panel" class="<?php echo $view1_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="view1">
	<div class="ew-extended-search">
<?php

// Render search row
$view1->RowType = ROWTYPE_SEARCH;
$view1->resetAttributes();
$view1_list->renderRow();
?>
<?php if ($view1_list->_email->Visible) { // email ?>
	<?php
		$view1_list->SearchColumnCount++;
		if (($view1_list->SearchColumnCount - 1) % $view1_list->SearchFieldsPerRow == 0) {
			$view1_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $view1_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc__email" class="ew-cell form-group">
		<label for="x__email" class="ew-search-caption ew-label"><?php echo $view1_list->_email->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z__email" id="z__email" value="LIKE">
</span>
		<span id="el_view1__email" class="ew-search-field">
<input type="text" data-table="view1" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($view1_list->_email->getPlaceHolder()) ?>" value="<?php echo $view1_list->_email->EditValue ?>"<?php echo $view1_list->_email->editAttributes() ?>>
</span>
	</div>
	<?php if ($view1_list->SearchColumnCount % $view1_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->customer_id->Visible) { // customer_id ?>
	<?php
		$view1_list->SearchColumnCount++;
		if (($view1_list->SearchColumnCount - 1) % $view1_list->SearchFieldsPerRow == 0) {
			$view1_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $view1_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_customer_id" class="ew-cell form-group">
		<label for="x_customer_id" class="ew-search-caption ew-label"><?php echo $view1_list->customer_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_customer_id" id="z_customer_id" value="LIKE">
</span>
		<span id="el_view1_customer_id" class="ew-search-field">
<input type="text" data-table="view1" data-field="x_customer_id" name="x_customer_id" id="x_customer_id" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($view1_list->customer_id->getPlaceHolder()) ?>" value="<?php echo $view1_list->customer_id->EditValue ?>"<?php echo $view1_list->customer_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($view1_list->SearchColumnCount % $view1_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->total_score->Visible) { // total_score ?>
	<?php
		$view1_list->SearchColumnCount++;
		if (($view1_list->SearchColumnCount - 1) % $view1_list->SearchFieldsPerRow == 0) {
			$view1_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $view1_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_total_score" class="ew-cell form-group">
		<label for="x_total_score" class="ew-search-caption ew-label"><?php echo $view1_list->total_score->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_total_score" id="z_total_score" value="=">
</span>
		<span id="el_view1_total_score" class="ew-search-field">
<input type="text" data-table="view1" data-field="x_total_score" name="x_total_score" id="x_total_score" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($view1_list->total_score->getPlaceHolder()) ?>" value="<?php echo $view1_list->total_score->EditValue ?>"<?php echo $view1_list->total_score->editAttributes() ?>>
</span>
	</div>
	<?php if ($view1_list->SearchColumnCount % $view1_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->customer_first_name->Visible) { // customer_first_name ?>
	<?php
		$view1_list->SearchColumnCount++;
		if (($view1_list->SearchColumnCount - 1) % $view1_list->SearchFieldsPerRow == 0) {
			$view1_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $view1_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_customer_first_name" class="ew-cell form-group">
		<label for="x_customer_first_name" class="ew-search-caption ew-label"><?php echo $view1_list->customer_first_name->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_customer_first_name" id="z_customer_first_name" value="LIKE">
</span>
		<span id="el_view1_customer_first_name" class="ew-search-field">
<input type="text" data-table="view1" data-field="x_customer_first_name" name="x_customer_first_name" id="x_customer_first_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($view1_list->customer_first_name->getPlaceHolder()) ?>" value="<?php echo $view1_list->customer_first_name->EditValue ?>"<?php echo $view1_list->customer_first_name->editAttributes() ?>>
</span>
	</div>
	<?php if ($view1_list->SearchColumnCount % $view1_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($view1_list->SearchColumnCount % $view1_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $view1_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($view1_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($view1_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $view1_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($view1_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($view1_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($view1_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($view1_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $view1_list->showPageHeader(); ?>
<?php
$view1_list->showMessage();
?>
<?php if ($view1_list->TotalRecords > 0 || $view1->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($view1_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> view1">
<?php if (!$view1_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$view1_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view1_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view1_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fview1list" id="fview1list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="view1">
<div id="gmp_view1" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($view1_list->TotalRecords > 0 || $view1_list->isGridEdit()) { ?>
<table id="tbl_view1list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$view1->RowType = ROWTYPE_HEADER;

// Render list options
$view1_list->renderListOptions();

// Render list options (header, left)
$view1_list->ListOptions->render("header", "left");
?>
<?php if ($view1_list->loan_section_id->Visible) { // loan_section_id ?>
	<?php if ($view1_list->SortUrl($view1_list->loan_section_id) == "") { ?>
		<th data-name="loan_section_id" class="<?php echo $view1_list->loan_section_id->headerCellClass() ?>"><div id="elh_view1_loan_section_id" class="view1_loan_section_id"><div class="ew-table-header-caption"><?php echo $view1_list->loan_section_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="loan_section_id" class="<?php echo $view1_list->loan_section_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->loan_section_id) ?>', 1);"><div id="elh_view1_loan_section_id" class="view1_loan_section_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->loan_section_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($view1_list->loan_section_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->loan_section_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->loan_section_name->Visible) { // loan_section_name ?>
	<?php if ($view1_list->SortUrl($view1_list->loan_section_name) == "") { ?>
		<th data-name="loan_section_name" class="<?php echo $view1_list->loan_section_name->headerCellClass() ?>"><div id="elh_view1_loan_section_name" class="view1_loan_section_name"><div class="ew-table-header-caption"><?php echo $view1_list->loan_section_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="loan_section_name" class="<?php echo $view1_list->loan_section_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->loan_section_name) ?>', 1);"><div id="elh_view1_loan_section_name" class="view1_loan_section_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->loan_section_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->loan_section_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->loan_section_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->user_id->Visible) { // user_id ?>
	<?php if ($view1_list->SortUrl($view1_list->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $view1_list->user_id->headerCellClass() ?>"><div id="elh_view1_user_id" class="view1_user_id"><div class="ew-table-header-caption"><?php echo $view1_list->user_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $view1_list->user_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->user_id) ?>', 1);"><div id="elh_view1_user_id" class="view1_user_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($view1_list->user_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->user_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->_email->Visible) { // email ?>
	<?php if ($view1_list->SortUrl($view1_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $view1_list->_email->headerCellClass() ?>"><div id="elh_view1__email" class="view1__email"><div class="ew-table-header-caption"><?php echo $view1_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $view1_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->_email) ?>', 1);"><div id="elh_view1__email" class="view1__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->loan_purpose_id->Visible) { // loan_purpose_id ?>
	<?php if ($view1_list->SortUrl($view1_list->loan_purpose_id) == "") { ?>
		<th data-name="loan_purpose_id" class="<?php echo $view1_list->loan_purpose_id->headerCellClass() ?>"><div id="elh_view1_loan_purpose_id" class="view1_loan_purpose_id"><div class="ew-table-header-caption"><?php echo $view1_list->loan_purpose_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="loan_purpose_id" class="<?php echo $view1_list->loan_purpose_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->loan_purpose_id) ?>', 1);"><div id="elh_view1_loan_purpose_id" class="view1_loan_purpose_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->loan_purpose_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($view1_list->loan_purpose_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->loan_purpose_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->loan_purpose_name->Visible) { // loan_purpose_name ?>
	<?php if ($view1_list->SortUrl($view1_list->loan_purpose_name) == "") { ?>
		<th data-name="loan_purpose_name" class="<?php echo $view1_list->loan_purpose_name->headerCellClass() ?>"><div id="elh_view1_loan_purpose_name" class="view1_loan_purpose_name"><div class="ew-table-header-caption"><?php echo $view1_list->loan_purpose_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="loan_purpose_name" class="<?php echo $view1_list->loan_purpose_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->loan_purpose_name) ?>', 1);"><div id="elh_view1_loan_purpose_name" class="view1_loan_purpose_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->loan_purpose_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->loan_purpose_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->loan_purpose_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->assessment_id->Visible) { // assessment_id ?>
	<?php if ($view1_list->SortUrl($view1_list->assessment_id) == "") { ?>
		<th data-name="assessment_id" class="<?php echo $view1_list->assessment_id->headerCellClass() ?>"><div id="elh_view1_assessment_id" class="view1_assessment_id"><div class="ew-table-header-caption"><?php echo $view1_list->assessment_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_id" class="<?php echo $view1_list->assessment_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->assessment_id) ?>', 1);"><div id="elh_view1_assessment_id" class="view1_assessment_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->assessment_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($view1_list->assessment_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->assessment_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->customer_id->Visible) { // customer_id ?>
	<?php if ($view1_list->SortUrl($view1_list->customer_id) == "") { ?>
		<th data-name="customer_id" class="<?php echo $view1_list->customer_id->headerCellClass() ?>"><div id="elh_view1_customer_id" class="view1_customer_id"><div class="ew-table-header-caption"><?php echo $view1_list->customer_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_id" class="<?php echo $view1_list->customer_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->customer_id) ?>', 1);"><div id="elh_view1_customer_id" class="view1_customer_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->customer_id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->customer_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->customer_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->total_score->Visible) { // total_score ?>
	<?php if ($view1_list->SortUrl($view1_list->total_score) == "") { ?>
		<th data-name="total_score" class="<?php echo $view1_list->total_score->headerCellClass() ?>"><div id="elh_view1_total_score" class="view1_total_score"><div class="ew-table-header-caption"><?php echo $view1_list->total_score->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_score" class="<?php echo $view1_list->total_score->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->total_score) ?>', 1);"><div id="elh_view1_total_score" class="view1_total_score">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->total_score->caption() ?></span><span class="ew-table-header-sort"><?php if ($view1_list->total_score->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->total_score->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->status->Visible) { // status ?>
	<?php if ($view1_list->SortUrl($view1_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $view1_list->status->headerCellClass() ?>"><div id="elh_view1_status" class="view1_status"><div class="ew-table-header-caption"><?php echo $view1_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $view1_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->status) ?>', 1);"><div id="elh_view1_status" class="view1_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->status->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->customer_first_name->Visible) { // customer_first_name ?>
	<?php if ($view1_list->SortUrl($view1_list->customer_first_name) == "") { ?>
		<th data-name="customer_first_name" class="<?php echo $view1_list->customer_first_name->headerCellClass() ?>"><div id="elh_view1_customer_first_name" class="view1_customer_first_name"><div class="ew-table-header-caption"><?php echo $view1_list->customer_first_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_first_name" class="<?php echo $view1_list->customer_first_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->customer_first_name) ?>', 1);"><div id="elh_view1_customer_first_name" class="view1_customer_first_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->customer_first_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->customer_first_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->customer_first_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->customer_last_name->Visible) { // customer_last_name ?>
	<?php if ($view1_list->SortUrl($view1_list->customer_last_name) == "") { ?>
		<th data-name="customer_last_name" class="<?php echo $view1_list->customer_last_name->headerCellClass() ?>"><div id="elh_view1_customer_last_name" class="view1_customer_last_name"><div class="ew-table-header-caption"><?php echo $view1_list->customer_last_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_last_name" class="<?php echo $view1_list->customer_last_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->customer_last_name) ?>', 1);"><div id="elh_view1_customer_last_name" class="view1_customer_last_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->customer_last_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->customer_last_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->customer_last_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->customer_age->Visible) { // customer_age ?>
	<?php if ($view1_list->SortUrl($view1_list->customer_age) == "") { ?>
		<th data-name="customer_age" class="<?php echo $view1_list->customer_age->headerCellClass() ?>"><div id="elh_view1_customer_age" class="view1_customer_age"><div class="ew-table-header-caption"><?php echo $view1_list->customer_age->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_age" class="<?php echo $view1_list->customer_age->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->customer_age) ?>', 1);"><div id="elh_view1_customer_age" class="view1_customer_age">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->customer_age->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->customer_age->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->customer_age->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->sex->Visible) { // sex ?>
	<?php if ($view1_list->SortUrl($view1_list->sex) == "") { ?>
		<th data-name="sex" class="<?php echo $view1_list->sex->headerCellClass() ?>"><div id="elh_view1_sex" class="view1_sex"><div class="ew-table-header-caption"><?php echo $view1_list->sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sex" class="<?php echo $view1_list->sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->sex) ?>', 1);"><div id="elh_view1_sex" class="view1_sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->address->Visible) { // address ?>
	<?php if ($view1_list->SortUrl($view1_list->address) == "") { ?>
		<th data-name="address" class="<?php echo $view1_list->address->headerCellClass() ?>"><div id="elh_view1_address" class="view1_address"><div class="ew-table-header-caption"><?php echo $view1_list->address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="address" class="<?php echo $view1_list->address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->address) ?>', 1);"><div id="elh_view1_address" class="view1_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->lat->Visible) { // lat ?>
	<?php if ($view1_list->SortUrl($view1_list->lat) == "") { ?>
		<th data-name="lat" class="<?php echo $view1_list->lat->headerCellClass() ?>"><div id="elh_view1_lat" class="view1_lat"><div class="ew-table-header-caption"><?php echo $view1_list->lat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lat" class="<?php echo $view1_list->lat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->lat) ?>', 1);"><div id="elh_view1_lat" class="view1_lat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->lat->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->lat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->lat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->lon->Visible) { // lon ?>
	<?php if ($view1_list->SortUrl($view1_list->lon) == "") { ?>
		<th data-name="lon" class="<?php echo $view1_list->lon->headerCellClass() ?>"><div id="elh_view1_lon" class="view1_lon"><div class="ew-table-header-caption"><?php echo $view1_list->lon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lon" class="<?php echo $view1_list->lon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->lon) ?>', 1);"><div id="elh_view1_lon" class="view1_lon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->lon->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->lon->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->lon->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->created_at->Visible) { // created_at ?>
	<?php if ($view1_list->SortUrl($view1_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $view1_list->created_at->headerCellClass() ?>"><div id="elh_view1_created_at" class="view1_created_at"><div class="ew-table-header-caption"><?php echo $view1_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $view1_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->created_at) ?>', 1);"><div id="elh_view1_created_at" class="view1_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($view1_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->updated_at->Visible) { // updated_at ?>
	<?php if ($view1_list->SortUrl($view1_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $view1_list->updated_at->headerCellClass() ?>"><div id="elh_view1_updated_at" class="view1_updated_at"><div class="ew-table-header-caption"><?php echo $view1_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $view1_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->updated_at) ?>', 1);"><div id="elh_view1_updated_at" class="view1_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($view1_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->user_level->Visible) { // user_level ?>
	<?php if ($view1_list->SortUrl($view1_list->user_level) == "") { ?>
		<th data-name="user_level" class="<?php echo $view1_list->user_level->headerCellClass() ?>"><div id="elh_view1_user_level" class="view1_user_level"><div class="ew-table-header-caption"><?php echo $view1_list->user_level->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_level" class="<?php echo $view1_list->user_level->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->user_level) ?>', 1);"><div id="elh_view1_user_level" class="view1_user_level">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->user_level->caption() ?></span><span class="ew-table-header-sort"><?php if ($view1_list->user_level->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->user_level->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$view1_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($view1_list->ExportAll && $view1_list->isExport()) {
	$view1_list->StopRecord = $view1_list->TotalRecords;
} else {

	// Set the last record to display
	if ($view1_list->TotalRecords > $view1_list->StartRecord + $view1_list->DisplayRecords - 1)
		$view1_list->StopRecord = $view1_list->StartRecord + $view1_list->DisplayRecords - 1;
	else
		$view1_list->StopRecord = $view1_list->TotalRecords;
}
$view1_list->RecordCount = $view1_list->StartRecord - 1;
if ($view1_list->Recordset && !$view1_list->Recordset->EOF) {
	$view1_list->Recordset->moveFirst();
	$selectLimit = $view1_list->UseSelectLimit;
	if (!$selectLimit && $view1_list->StartRecord > 1)
		$view1_list->Recordset->move($view1_list->StartRecord - 1);
} elseif (!$view1->AllowAddDeleteRow && $view1_list->StopRecord == 0) {
	$view1_list->StopRecord = $view1->GridAddRowCount;
}

// Initialize aggregate
$view1->RowType = ROWTYPE_AGGREGATEINIT;
$view1->resetAttributes();
$view1_list->renderRow();
while ($view1_list->RecordCount < $view1_list->StopRecord) {
	$view1_list->RecordCount++;
	if ($view1_list->RecordCount >= $view1_list->StartRecord) {
		$view1_list->RowCount++;

		// Set up key count
		$view1_list->KeyCount = $view1_list->RowIndex;

		// Init row class and style
		$view1->resetAttributes();
		$view1->CssClass = "";
		if ($view1_list->isGridAdd()) {
		} else {
			$view1_list->loadRowValues($view1_list->Recordset); // Load row values
		}
		$view1->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$view1->RowAttrs->merge(["data-rowindex" => $view1_list->RowCount, "id" => "r" . $view1_list->RowCount . "_view1", "data-rowtype" => $view1->RowType]);

		// Render row
		$view1_list->renderRow();

		// Render list options
		$view1_list->renderListOptions();
?>
	<tr <?php echo $view1->rowAttributes() ?>>
<?php

// Render list options (body, left)
$view1_list->ListOptions->render("body", "left", $view1_list->RowCount);
?>
	<?php if ($view1_list->loan_section_id->Visible) { // loan_section_id ?>
		<td data-name="loan_section_id" <?php echo $view1_list->loan_section_id->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_loan_section_id">
<span<?php echo $view1_list->loan_section_id->viewAttributes() ?>><?php echo $view1_list->loan_section_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->loan_section_name->Visible) { // loan_section_name ?>
		<td data-name="loan_section_name" <?php echo $view1_list->loan_section_name->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_loan_section_name">
<span<?php echo $view1_list->loan_section_name->viewAttributes() ?>><?php echo $view1_list->loan_section_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->user_id->Visible) { // user_id ?>
		<td data-name="user_id" <?php echo $view1_list->user_id->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_user_id">
<span<?php echo $view1_list->user_id->viewAttributes() ?>><?php echo $view1_list->user_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $view1_list->_email->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1__email">
<span<?php echo $view1_list->_email->viewAttributes() ?>><?php echo $view1_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->loan_purpose_id->Visible) { // loan_purpose_id ?>
		<td data-name="loan_purpose_id" <?php echo $view1_list->loan_purpose_id->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_loan_purpose_id">
<span<?php echo $view1_list->loan_purpose_id->viewAttributes() ?>><?php echo $view1_list->loan_purpose_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->loan_purpose_name->Visible) { // loan_purpose_name ?>
		<td data-name="loan_purpose_name" <?php echo $view1_list->loan_purpose_name->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_loan_purpose_name">
<span<?php echo $view1_list->loan_purpose_name->viewAttributes() ?>><?php echo $view1_list->loan_purpose_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->assessment_id->Visible) { // assessment_id ?>
		<td data-name="assessment_id" <?php echo $view1_list->assessment_id->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_assessment_id">
<span<?php echo $view1_list->assessment_id->viewAttributes() ?>><?php echo $view1_list->assessment_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->customer_id->Visible) { // customer_id ?>
		<td data-name="customer_id" <?php echo $view1_list->customer_id->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_customer_id">
<span<?php echo $view1_list->customer_id->viewAttributes() ?>><?php echo $view1_list->customer_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->total_score->Visible) { // total_score ?>
		<td data-name="total_score" <?php echo $view1_list->total_score->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_total_score">
<span<?php echo $view1_list->total_score->viewAttributes() ?>><?php echo $view1_list->total_score->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $view1_list->status->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_status">
<span<?php echo $view1_list->status->viewAttributes() ?>><?php echo $view1_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->customer_first_name->Visible) { // customer_first_name ?>
		<td data-name="customer_first_name" <?php echo $view1_list->customer_first_name->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_customer_first_name">
<span<?php echo $view1_list->customer_first_name->viewAttributes() ?>><?php echo $view1_list->customer_first_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->customer_last_name->Visible) { // customer_last_name ?>
		<td data-name="customer_last_name" <?php echo $view1_list->customer_last_name->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_customer_last_name">
<span<?php echo $view1_list->customer_last_name->viewAttributes() ?>><?php echo $view1_list->customer_last_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->customer_age->Visible) { // customer_age ?>
		<td data-name="customer_age" <?php echo $view1_list->customer_age->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_customer_age">
<span<?php echo $view1_list->customer_age->viewAttributes() ?>><?php echo $view1_list->customer_age->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->sex->Visible) { // sex ?>
		<td data-name="sex" <?php echo $view1_list->sex->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_sex">
<span<?php echo $view1_list->sex->viewAttributes() ?>><?php echo $view1_list->sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->address->Visible) { // address ?>
		<td data-name="address" <?php echo $view1_list->address->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_address">
<span<?php echo $view1_list->address->viewAttributes() ?>><?php echo $view1_list->address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->lat->Visible) { // lat ?>
		<td data-name="lat" <?php echo $view1_list->lat->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_lat">
<span<?php echo $view1_list->lat->viewAttributes() ?>><?php echo $view1_list->lat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->lon->Visible) { // lon ?>
		<td data-name="lon" <?php echo $view1_list->lon->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_lon">
<span<?php echo $view1_list->lon->viewAttributes() ?>><?php echo $view1_list->lon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $view1_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_created_at">
<span<?php echo $view1_list->created_at->viewAttributes() ?>><?php echo $view1_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $view1_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_updated_at">
<span<?php echo $view1_list->updated_at->viewAttributes() ?>><?php echo $view1_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->user_level->Visible) { // user_level ?>
		<td data-name="user_level" <?php echo $view1_list->user_level->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_user_level">
<span<?php echo $view1_list->user_level->viewAttributes() ?>><?php echo $view1_list->user_level->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view1_list->ListOptions->render("body", "right", $view1_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$view1_list->isGridAdd())
		$view1_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$view1->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($view1_list->Recordset)
	$view1_list->Recordset->Close();
?>
<?php if (!$view1_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$view1_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view1_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view1_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($view1_list->TotalRecords == 0 && !$view1->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $view1_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$view1_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$view1_list->isExport()) { ?>
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
$view1_list->terminate();
?>
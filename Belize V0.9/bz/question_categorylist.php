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
$question_category_list = new question_category_list();

// Run the page
$question_category_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$question_category_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$question_category_list->isExport()) { ?>
<script>
var fquestion_categorylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fquestion_categorylist = currentForm = new ew.Form("fquestion_categorylist", "list");
	fquestion_categorylist.formKeyCountName = '<?php echo $question_category_list->FormKeyCountName ?>';
	loadjs.done("fquestion_categorylist");
});
var fquestion_categorylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fquestion_categorylistsrch = currentSearchForm = new ew.Form("fquestion_categorylistsrch");

	// Dynamic selection lists
	// Filters

	fquestion_categorylistsrch.filterList = <?php echo $question_category_list->getFilterList() ?>;
	loadjs.done("fquestion_categorylistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$question_category_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($question_category_list->TotalRecords > 0 && $question_category_list->ExportOptions->visible()) { ?>
<?php $question_category_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($question_category_list->ImportOptions->visible()) { ?>
<?php $question_category_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($question_category_list->SearchOptions->visible()) { ?>
<?php $question_category_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($question_category_list->FilterOptions->visible()) { ?>
<?php $question_category_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$question_category_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$question_category_list->isExport() && !$question_category->CurrentAction) { ?>
<form name="fquestion_categorylistsrch" id="fquestion_categorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fquestion_categorylistsrch-search-panel" class="<?php echo $question_category_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="question_category">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $question_category_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($question_category_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($question_category_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $question_category_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($question_category_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($question_category_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($question_category_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($question_category_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $question_category_list->showPageHeader(); ?>
<?php
$question_category_list->showMessage();
?>
<?php if ($question_category_list->TotalRecords > 0 || $question_category->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($question_category_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> question_category">
<?php if (!$question_category_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$question_category_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $question_category_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $question_category_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fquestion_categorylist" id="fquestion_categorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="question_category">
<div id="gmp_question_category" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($question_category_list->TotalRecords > 0 || $question_category_list->isGridEdit()) { ?>
<table id="tbl_question_categorylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$question_category->RowType = ROWTYPE_HEADER;

// Render list options
$question_category_list->renderListOptions();

// Render list options (header, left)
$question_category_list->ListOptions->render("header", "left");
?>
<?php if ($question_category_list->id->Visible) { // id ?>
	<?php if ($question_category_list->SortUrl($question_category_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $question_category_list->id->headerCellClass() ?>"><div id="elh_question_category_id" class="question_category_id"><div class="ew-table-header-caption"><?php echo $question_category_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $question_category_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $question_category_list->SortUrl($question_category_list->id) ?>', 1);"><div id="elh_question_category_id" class="question_category_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $question_category_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($question_category_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($question_category_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($question_category_list->name->Visible) { // name ?>
	<?php if ($question_category_list->SortUrl($question_category_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $question_category_list->name->headerCellClass() ?>"><div id="elh_question_category_name" class="question_category_name"><div class="ew-table-header-caption"><?php echo $question_category_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $question_category_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $question_category_list->SortUrl($question_category_list->name) ?>', 1);"><div id="elh_question_category_name" class="question_category_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $question_category_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($question_category_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($question_category_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($question_category_list->desc->Visible) { // desc ?>
	<?php if ($question_category_list->SortUrl($question_category_list->desc) == "") { ?>
		<th data-name="desc" class="<?php echo $question_category_list->desc->headerCellClass() ?>"><div id="elh_question_category_desc" class="question_category_desc"><div class="ew-table-header-caption"><?php echo $question_category_list->desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="desc" class="<?php echo $question_category_list->desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $question_category_list->SortUrl($question_category_list->desc) ?>', 1);"><div id="elh_question_category_desc" class="question_category_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $question_category_list->desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($question_category_list->desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($question_category_list->desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$question_category_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($question_category_list->ExportAll && $question_category_list->isExport()) {
	$question_category_list->StopRecord = $question_category_list->TotalRecords;
} else {

	// Set the last record to display
	if ($question_category_list->TotalRecords > $question_category_list->StartRecord + $question_category_list->DisplayRecords - 1)
		$question_category_list->StopRecord = $question_category_list->StartRecord + $question_category_list->DisplayRecords - 1;
	else
		$question_category_list->StopRecord = $question_category_list->TotalRecords;
}
$question_category_list->RecordCount = $question_category_list->StartRecord - 1;
if ($question_category_list->Recordset && !$question_category_list->Recordset->EOF) {
	$question_category_list->Recordset->moveFirst();
	$selectLimit = $question_category_list->UseSelectLimit;
	if (!$selectLimit && $question_category_list->StartRecord > 1)
		$question_category_list->Recordset->move($question_category_list->StartRecord - 1);
} elseif (!$question_category->AllowAddDeleteRow && $question_category_list->StopRecord == 0) {
	$question_category_list->StopRecord = $question_category->GridAddRowCount;
}

// Initialize aggregate
$question_category->RowType = ROWTYPE_AGGREGATEINIT;
$question_category->resetAttributes();
$question_category_list->renderRow();
while ($question_category_list->RecordCount < $question_category_list->StopRecord) {
	$question_category_list->RecordCount++;
	if ($question_category_list->RecordCount >= $question_category_list->StartRecord) {
		$question_category_list->RowCount++;

		// Set up key count
		$question_category_list->KeyCount = $question_category_list->RowIndex;

		// Init row class and style
		$question_category->resetAttributes();
		$question_category->CssClass = "";
		if ($question_category_list->isGridAdd()) {
		} else {
			$question_category_list->loadRowValues($question_category_list->Recordset); // Load row values
		}
		$question_category->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$question_category->RowAttrs->merge(["data-rowindex" => $question_category_list->RowCount, "id" => "r" . $question_category_list->RowCount . "_question_category", "data-rowtype" => $question_category->RowType]);

		// Render row
		$question_category_list->renderRow();

		// Render list options
		$question_category_list->renderListOptions();
?>
	<tr <?php echo $question_category->rowAttributes() ?>>
<?php

// Render list options (body, left)
$question_category_list->ListOptions->render("body", "left", $question_category_list->RowCount);
?>
	<?php if ($question_category_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $question_category_list->id->cellAttributes() ?>>
<span id="el<?php echo $question_category_list->RowCount ?>_question_category_id">
<span<?php echo $question_category_list->id->viewAttributes() ?>><?php echo $question_category_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($question_category_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $question_category_list->name->cellAttributes() ?>>
<span id="el<?php echo $question_category_list->RowCount ?>_question_category_name">
<span<?php echo $question_category_list->name->viewAttributes() ?>><?php echo $question_category_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($question_category_list->desc->Visible) { // desc ?>
		<td data-name="desc" <?php echo $question_category_list->desc->cellAttributes() ?>>
<span id="el<?php echo $question_category_list->RowCount ?>_question_category_desc">
<span<?php echo $question_category_list->desc->viewAttributes() ?>><?php echo $question_category_list->desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$question_category_list->ListOptions->render("body", "right", $question_category_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$question_category_list->isGridAdd())
		$question_category_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$question_category->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($question_category_list->Recordset)
	$question_category_list->Recordset->Close();
?>
<?php if (!$question_category_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$question_category_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $question_category_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $question_category_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($question_category_list->TotalRecords == 0 && !$question_category->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $question_category_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$question_category_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$question_category_list->isExport()) { ?>
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
$question_category_list->terminate();
?>
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
$loan_section_list = new loan_section_list();

// Run the page
$loan_section_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$loan_section_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$loan_section_list->isExport()) { ?>
<script>
var floan_sectionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	floan_sectionlist = currentForm = new ew.Form("floan_sectionlist", "list");
	floan_sectionlist.formKeyCountName = '<?php echo $loan_section_list->FormKeyCountName ?>';
	loadjs.done("floan_sectionlist");
});
var floan_sectionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	floan_sectionlistsrch = currentSearchForm = new ew.Form("floan_sectionlistsrch");

	// Dynamic selection lists
	// Filters

	floan_sectionlistsrch.filterList = <?php echo $loan_section_list->getFilterList() ?>;
	loadjs.done("floan_sectionlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$loan_section_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($loan_section_list->TotalRecords > 0 && $loan_section_list->ExportOptions->visible()) { ?>
<?php $loan_section_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($loan_section_list->ImportOptions->visible()) { ?>
<?php $loan_section_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($loan_section_list->SearchOptions->visible()) { ?>
<?php $loan_section_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($loan_section_list->FilterOptions->visible()) { ?>
<?php $loan_section_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$loan_section_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$loan_section_list->isExport() && !$loan_section->CurrentAction) { ?>
<form name="floan_sectionlistsrch" id="floan_sectionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="floan_sectionlistsrch-search-panel" class="<?php echo $loan_section_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="loan_section">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $loan_section_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($loan_section_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($loan_section_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $loan_section_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($loan_section_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($loan_section_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($loan_section_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($loan_section_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $loan_section_list->showPageHeader(); ?>
<?php
$loan_section_list->showMessage();
?>
<?php if ($loan_section_list->TotalRecords > 0 || $loan_section->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($loan_section_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> loan_section">
<?php if (!$loan_section_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$loan_section_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $loan_section_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $loan_section_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="floan_sectionlist" id="floan_sectionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="loan_section">
<div id="gmp_loan_section" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($loan_section_list->TotalRecords > 0 || $loan_section_list->isGridEdit()) { ?>
<table id="tbl_loan_sectionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$loan_section->RowType = ROWTYPE_HEADER;

// Render list options
$loan_section_list->renderListOptions();

// Render list options (header, left)
$loan_section_list->ListOptions->render("header", "left");
?>
<?php if ($loan_section_list->id->Visible) { // id ?>
	<?php if ($loan_section_list->SortUrl($loan_section_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $loan_section_list->id->headerCellClass() ?>"><div id="elh_loan_section_id" class="loan_section_id"><div class="ew-table-header-caption"><?php echo $loan_section_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $loan_section_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $loan_section_list->SortUrl($loan_section_list->id) ?>', 1);"><div id="elh_loan_section_id" class="loan_section_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $loan_section_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($loan_section_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($loan_section_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($loan_section_list->name->Visible) { // name ?>
	<?php if ($loan_section_list->SortUrl($loan_section_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $loan_section_list->name->headerCellClass() ?>"><div id="elh_loan_section_name" class="loan_section_name"><div class="ew-table-header-caption"><?php echo $loan_section_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $loan_section_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $loan_section_list->SortUrl($loan_section_list->name) ?>', 1);"><div id="elh_loan_section_name" class="loan_section_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $loan_section_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($loan_section_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($loan_section_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($loan_section_list->desc->Visible) { // desc ?>
	<?php if ($loan_section_list->SortUrl($loan_section_list->desc) == "") { ?>
		<th data-name="desc" class="<?php echo $loan_section_list->desc->headerCellClass() ?>"><div id="elh_loan_section_desc" class="loan_section_desc"><div class="ew-table-header-caption"><?php echo $loan_section_list->desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="desc" class="<?php echo $loan_section_list->desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $loan_section_list->SortUrl($loan_section_list->desc) ?>', 1);"><div id="elh_loan_section_desc" class="loan_section_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $loan_section_list->desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($loan_section_list->desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($loan_section_list->desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($loan_section_list->created_at->Visible) { // created_at ?>
	<?php if ($loan_section_list->SortUrl($loan_section_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $loan_section_list->created_at->headerCellClass() ?>"><div id="elh_loan_section_created_at" class="loan_section_created_at"><div class="ew-table-header-caption"><?php echo $loan_section_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $loan_section_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $loan_section_list->SortUrl($loan_section_list->created_at) ?>', 1);"><div id="elh_loan_section_created_at" class="loan_section_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $loan_section_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($loan_section_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($loan_section_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($loan_section_list->updated_at->Visible) { // updated_at ?>
	<?php if ($loan_section_list->SortUrl($loan_section_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $loan_section_list->updated_at->headerCellClass() ?>"><div id="elh_loan_section_updated_at" class="loan_section_updated_at"><div class="ew-table-header-caption"><?php echo $loan_section_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $loan_section_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $loan_section_list->SortUrl($loan_section_list->updated_at) ?>', 1);"><div id="elh_loan_section_updated_at" class="loan_section_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $loan_section_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($loan_section_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($loan_section_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$loan_section_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($loan_section_list->ExportAll && $loan_section_list->isExport()) {
	$loan_section_list->StopRecord = $loan_section_list->TotalRecords;
} else {

	// Set the last record to display
	if ($loan_section_list->TotalRecords > $loan_section_list->StartRecord + $loan_section_list->DisplayRecords - 1)
		$loan_section_list->StopRecord = $loan_section_list->StartRecord + $loan_section_list->DisplayRecords - 1;
	else
		$loan_section_list->StopRecord = $loan_section_list->TotalRecords;
}
$loan_section_list->RecordCount = $loan_section_list->StartRecord - 1;
if ($loan_section_list->Recordset && !$loan_section_list->Recordset->EOF) {
	$loan_section_list->Recordset->moveFirst();
	$selectLimit = $loan_section_list->UseSelectLimit;
	if (!$selectLimit && $loan_section_list->StartRecord > 1)
		$loan_section_list->Recordset->move($loan_section_list->StartRecord - 1);
} elseif (!$loan_section->AllowAddDeleteRow && $loan_section_list->StopRecord == 0) {
	$loan_section_list->StopRecord = $loan_section->GridAddRowCount;
}

// Initialize aggregate
$loan_section->RowType = ROWTYPE_AGGREGATEINIT;
$loan_section->resetAttributes();
$loan_section_list->renderRow();
while ($loan_section_list->RecordCount < $loan_section_list->StopRecord) {
	$loan_section_list->RecordCount++;
	if ($loan_section_list->RecordCount >= $loan_section_list->StartRecord) {
		$loan_section_list->RowCount++;

		// Set up key count
		$loan_section_list->KeyCount = $loan_section_list->RowIndex;

		// Init row class and style
		$loan_section->resetAttributes();
		$loan_section->CssClass = "";
		if ($loan_section_list->isGridAdd()) {
		} else {
			$loan_section_list->loadRowValues($loan_section_list->Recordset); // Load row values
		}
		$loan_section->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$loan_section->RowAttrs->merge(["data-rowindex" => $loan_section_list->RowCount, "id" => "r" . $loan_section_list->RowCount . "_loan_section", "data-rowtype" => $loan_section->RowType]);

		// Render row
		$loan_section_list->renderRow();

		// Render list options
		$loan_section_list->renderListOptions();
?>
	<tr <?php echo $loan_section->rowAttributes() ?>>
<?php

// Render list options (body, left)
$loan_section_list->ListOptions->render("body", "left", $loan_section_list->RowCount);
?>
	<?php if ($loan_section_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $loan_section_list->id->cellAttributes() ?>>
<span id="el<?php echo $loan_section_list->RowCount ?>_loan_section_id">
<span<?php echo $loan_section_list->id->viewAttributes() ?>><?php echo $loan_section_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($loan_section_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $loan_section_list->name->cellAttributes() ?>>
<span id="el<?php echo $loan_section_list->RowCount ?>_loan_section_name">
<span<?php echo $loan_section_list->name->viewAttributes() ?>><?php echo $loan_section_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($loan_section_list->desc->Visible) { // desc ?>
		<td data-name="desc" <?php echo $loan_section_list->desc->cellAttributes() ?>>
<span id="el<?php echo $loan_section_list->RowCount ?>_loan_section_desc">
<span<?php echo $loan_section_list->desc->viewAttributes() ?>><?php echo $loan_section_list->desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($loan_section_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $loan_section_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $loan_section_list->RowCount ?>_loan_section_created_at">
<span<?php echo $loan_section_list->created_at->viewAttributes() ?>><?php echo $loan_section_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($loan_section_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $loan_section_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $loan_section_list->RowCount ?>_loan_section_updated_at">
<span<?php echo $loan_section_list->updated_at->viewAttributes() ?>><?php echo $loan_section_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$loan_section_list->ListOptions->render("body", "right", $loan_section_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$loan_section_list->isGridAdd())
		$loan_section_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$loan_section->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($loan_section_list->Recordset)
	$loan_section_list->Recordset->Close();
?>
<?php if (!$loan_section_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$loan_section_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $loan_section_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $loan_section_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($loan_section_list->TotalRecords == 0 && !$loan_section->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $loan_section_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$loan_section_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$loan_section_list->isExport()) { ?>
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
$loan_section_list->terminate();
?>
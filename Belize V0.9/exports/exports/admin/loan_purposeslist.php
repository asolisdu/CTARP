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
$loan_purposes_list = new loan_purposes_list();

// Run the page
$loan_purposes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$loan_purposes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$loan_purposes_list->isExport()) { ?>
<script>
var floan_purposeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	floan_purposeslist = currentForm = new ew.Form("floan_purposeslist", "list");
	floan_purposeslist.formKeyCountName = '<?php echo $loan_purposes_list->FormKeyCountName ?>';
	loadjs.done("floan_purposeslist");
});
var floan_purposeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	floan_purposeslistsrch = currentSearchForm = new ew.Form("floan_purposeslistsrch");

	// Dynamic selection lists
	// Filters

	floan_purposeslistsrch.filterList = <?php echo $loan_purposes_list->getFilterList() ?>;
	loadjs.done("floan_purposeslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$loan_purposes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($loan_purposes_list->TotalRecords > 0 && $loan_purposes_list->ExportOptions->visible()) { ?>
<?php $loan_purposes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($loan_purposes_list->ImportOptions->visible()) { ?>
<?php $loan_purposes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($loan_purposes_list->SearchOptions->visible()) { ?>
<?php $loan_purposes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($loan_purposes_list->FilterOptions->visible()) { ?>
<?php $loan_purposes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$loan_purposes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$loan_purposes_list->isExport() && !$loan_purposes->CurrentAction) { ?>
<form name="floan_purposeslistsrch" id="floan_purposeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="floan_purposeslistsrch-search-panel" class="<?php echo $loan_purposes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="loan_purposes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $loan_purposes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($loan_purposes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($loan_purposes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $loan_purposes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($loan_purposes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($loan_purposes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($loan_purposes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($loan_purposes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $loan_purposes_list->showPageHeader(); ?>
<?php
$loan_purposes_list->showMessage();
?>
<?php if ($loan_purposes_list->TotalRecords > 0 || $loan_purposes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($loan_purposes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> loan_purposes">
<?php if (!$loan_purposes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$loan_purposes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $loan_purposes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $loan_purposes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="floan_purposeslist" id="floan_purposeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="loan_purposes">
<div id="gmp_loan_purposes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($loan_purposes_list->TotalRecords > 0 || $loan_purposes_list->isGridEdit()) { ?>
<table id="tbl_loan_purposeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$loan_purposes->RowType = ROWTYPE_HEADER;

// Render list options
$loan_purposes_list->renderListOptions();

// Render list options (header, left)
$loan_purposes_list->ListOptions->render("header", "left");
?>
<?php if ($loan_purposes_list->id->Visible) { // id ?>
	<?php if ($loan_purposes_list->SortUrl($loan_purposes_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $loan_purposes_list->id->headerCellClass() ?>"><div id="elh_loan_purposes_id" class="loan_purposes_id"><div class="ew-table-header-caption"><?php echo $loan_purposes_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $loan_purposes_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $loan_purposes_list->SortUrl($loan_purposes_list->id) ?>', 1);"><div id="elh_loan_purposes_id" class="loan_purposes_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $loan_purposes_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($loan_purposes_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($loan_purposes_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($loan_purposes_list->name->Visible) { // name ?>
	<?php if ($loan_purposes_list->SortUrl($loan_purposes_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $loan_purposes_list->name->headerCellClass() ?>"><div id="elh_loan_purposes_name" class="loan_purposes_name"><div class="ew-table-header-caption"><?php echo $loan_purposes_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $loan_purposes_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $loan_purposes_list->SortUrl($loan_purposes_list->name) ?>', 1);"><div id="elh_loan_purposes_name" class="loan_purposes_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $loan_purposes_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($loan_purposes_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($loan_purposes_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($loan_purposes_list->desc->Visible) { // desc ?>
	<?php if ($loan_purposes_list->SortUrl($loan_purposes_list->desc) == "") { ?>
		<th data-name="desc" class="<?php echo $loan_purposes_list->desc->headerCellClass() ?>"><div id="elh_loan_purposes_desc" class="loan_purposes_desc"><div class="ew-table-header-caption"><?php echo $loan_purposes_list->desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="desc" class="<?php echo $loan_purposes_list->desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $loan_purposes_list->SortUrl($loan_purposes_list->desc) ?>', 1);"><div id="elh_loan_purposes_desc" class="loan_purposes_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $loan_purposes_list->desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($loan_purposes_list->desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($loan_purposes_list->desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($loan_purposes_list->created_at->Visible) { // created_at ?>
	<?php if ($loan_purposes_list->SortUrl($loan_purposes_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $loan_purposes_list->created_at->headerCellClass() ?>"><div id="elh_loan_purposes_created_at" class="loan_purposes_created_at"><div class="ew-table-header-caption"><?php echo $loan_purposes_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $loan_purposes_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $loan_purposes_list->SortUrl($loan_purposes_list->created_at) ?>', 1);"><div id="elh_loan_purposes_created_at" class="loan_purposes_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $loan_purposes_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($loan_purposes_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($loan_purposes_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($loan_purposes_list->updated_at->Visible) { // updated_at ?>
	<?php if ($loan_purposes_list->SortUrl($loan_purposes_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $loan_purposes_list->updated_at->headerCellClass() ?>"><div id="elh_loan_purposes_updated_at" class="loan_purposes_updated_at"><div class="ew-table-header-caption"><?php echo $loan_purposes_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $loan_purposes_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $loan_purposes_list->SortUrl($loan_purposes_list->updated_at) ?>', 1);"><div id="elh_loan_purposes_updated_at" class="loan_purposes_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $loan_purposes_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($loan_purposes_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($loan_purposes_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$loan_purposes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($loan_purposes_list->ExportAll && $loan_purposes_list->isExport()) {
	$loan_purposes_list->StopRecord = $loan_purposes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($loan_purposes_list->TotalRecords > $loan_purposes_list->StartRecord + $loan_purposes_list->DisplayRecords - 1)
		$loan_purposes_list->StopRecord = $loan_purposes_list->StartRecord + $loan_purposes_list->DisplayRecords - 1;
	else
		$loan_purposes_list->StopRecord = $loan_purposes_list->TotalRecords;
}
$loan_purposes_list->RecordCount = $loan_purposes_list->StartRecord - 1;
if ($loan_purposes_list->Recordset && !$loan_purposes_list->Recordset->EOF) {
	$loan_purposes_list->Recordset->moveFirst();
	$selectLimit = $loan_purposes_list->UseSelectLimit;
	if (!$selectLimit && $loan_purposes_list->StartRecord > 1)
		$loan_purposes_list->Recordset->move($loan_purposes_list->StartRecord - 1);
} elseif (!$loan_purposes->AllowAddDeleteRow && $loan_purposes_list->StopRecord == 0) {
	$loan_purposes_list->StopRecord = $loan_purposes->GridAddRowCount;
}

// Initialize aggregate
$loan_purposes->RowType = ROWTYPE_AGGREGATEINIT;
$loan_purposes->resetAttributes();
$loan_purposes_list->renderRow();
while ($loan_purposes_list->RecordCount < $loan_purposes_list->StopRecord) {
	$loan_purposes_list->RecordCount++;
	if ($loan_purposes_list->RecordCount >= $loan_purposes_list->StartRecord) {
		$loan_purposes_list->RowCount++;

		// Set up key count
		$loan_purposes_list->KeyCount = $loan_purposes_list->RowIndex;

		// Init row class and style
		$loan_purposes->resetAttributes();
		$loan_purposes->CssClass = "";
		if ($loan_purposes_list->isGridAdd()) {
		} else {
			$loan_purposes_list->loadRowValues($loan_purposes_list->Recordset); // Load row values
		}
		$loan_purposes->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$loan_purposes->RowAttrs->merge(["data-rowindex" => $loan_purposes_list->RowCount, "id" => "r" . $loan_purposes_list->RowCount . "_loan_purposes", "data-rowtype" => $loan_purposes->RowType]);

		// Render row
		$loan_purposes_list->renderRow();

		// Render list options
		$loan_purposes_list->renderListOptions();
?>
	<tr <?php echo $loan_purposes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$loan_purposes_list->ListOptions->render("body", "left", $loan_purposes_list->RowCount);
?>
	<?php if ($loan_purposes_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $loan_purposes_list->id->cellAttributes() ?>>
<span id="el<?php echo $loan_purposes_list->RowCount ?>_loan_purposes_id">
<span<?php echo $loan_purposes_list->id->viewAttributes() ?>><?php echo $loan_purposes_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($loan_purposes_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $loan_purposes_list->name->cellAttributes() ?>>
<span id="el<?php echo $loan_purposes_list->RowCount ?>_loan_purposes_name">
<span<?php echo $loan_purposes_list->name->viewAttributes() ?>><?php echo $loan_purposes_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($loan_purposes_list->desc->Visible) { // desc ?>
		<td data-name="desc" <?php echo $loan_purposes_list->desc->cellAttributes() ?>>
<span id="el<?php echo $loan_purposes_list->RowCount ?>_loan_purposes_desc">
<span<?php echo $loan_purposes_list->desc->viewAttributes() ?>><?php echo $loan_purposes_list->desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($loan_purposes_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $loan_purposes_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $loan_purposes_list->RowCount ?>_loan_purposes_created_at">
<span<?php echo $loan_purposes_list->created_at->viewAttributes() ?>><?php echo $loan_purposes_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($loan_purposes_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $loan_purposes_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $loan_purposes_list->RowCount ?>_loan_purposes_updated_at">
<span<?php echo $loan_purposes_list->updated_at->viewAttributes() ?>><?php echo $loan_purposes_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$loan_purposes_list->ListOptions->render("body", "right", $loan_purposes_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$loan_purposes_list->isGridAdd())
		$loan_purposes_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$loan_purposes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($loan_purposes_list->Recordset)
	$loan_purposes_list->Recordset->Close();
?>
<?php if (!$loan_purposes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$loan_purposes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $loan_purposes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $loan_purposes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($loan_purposes_list->TotalRecords == 0 && !$loan_purposes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $loan_purposes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$loan_purposes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$loan_purposes_list->isExport()) { ?>
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
$loan_purposes_list->terminate();
?>
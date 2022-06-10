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
$_user_levels_list = new _user_levels_list();

// Run the page
$_user_levels_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_user_levels_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_user_levels_list->isExport()) { ?>
<script>
var f_user_levelslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	f_user_levelslist = currentForm = new ew.Form("f_user_levelslist", "list");
	f_user_levelslist.formKeyCountName = '<?php echo $_user_levels_list->FormKeyCountName ?>';
	loadjs.done("f_user_levelslist");
});
var f_user_levelslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	f_user_levelslistsrch = currentSearchForm = new ew.Form("f_user_levelslistsrch");

	// Dynamic selection lists
	// Filters

	f_user_levelslistsrch.filterList = <?php echo $_user_levels_list->getFilterList() ?>;
	loadjs.done("f_user_levelslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$_user_levels_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($_user_levels_list->TotalRecords > 0 && $_user_levels_list->ExportOptions->visible()) { ?>
<?php $_user_levels_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($_user_levels_list->ImportOptions->visible()) { ?>
<?php $_user_levels_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($_user_levels_list->SearchOptions->visible()) { ?>
<?php $_user_levels_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($_user_levels_list->FilterOptions->visible()) { ?>
<?php $_user_levels_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$_user_levels_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$_user_levels_list->isExport() && !$_user_levels->CurrentAction) { ?>
<form name="f_user_levelslistsrch" id="f_user_levelslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="f_user_levelslistsrch-search-panel" class="<?php echo $_user_levels_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_user_levels">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $_user_levels_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($_user_levels_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($_user_levels_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $_user_levels_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($_user_levels_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($_user_levels_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($_user_levels_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($_user_levels_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $_user_levels_list->showPageHeader(); ?>
<?php
$_user_levels_list->showMessage();
?>
<?php if ($_user_levels_list->TotalRecords > 0 || $_user_levels->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_user_levels_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _user_levels">
<?php if (!$_user_levels_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$_user_levels_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_user_levels_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_user_levels_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="f_user_levelslist" id="f_user_levelslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_user_levels">
<div id="gmp__user_levels" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($_user_levels_list->TotalRecords > 0 || $_user_levels_list->isGridEdit()) { ?>
<table id="tbl__user_levelslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_user_levels->RowType = ROWTYPE_HEADER;

// Render list options
$_user_levels_list->renderListOptions();

// Render list options (header, left)
$_user_levels_list->ListOptions->render("header", "left");
?>
<?php if ($_user_levels_list->id->Visible) { // id ?>
	<?php if ($_user_levels_list->SortUrl($_user_levels_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $_user_levels_list->id->headerCellClass() ?>"><div id="elh__user_levels_id" class="_user_levels_id"><div class="ew-table-header-caption"><?php echo $_user_levels_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $_user_levels_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_user_levels_list->SortUrl($_user_levels_list->id) ?>', 1);"><div id="elh__user_levels_id" class="_user_levels_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_user_levels_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($_user_levels_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_user_levels_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_user_levels_list->name->Visible) { // name ?>
	<?php if ($_user_levels_list->SortUrl($_user_levels_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $_user_levels_list->name->headerCellClass() ?>"><div id="elh__user_levels_name" class="_user_levels_name"><div class="ew-table-header-caption"><?php echo $_user_levels_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $_user_levels_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_user_levels_list->SortUrl($_user_levels_list->name) ?>', 1);"><div id="elh__user_levels_name" class="_user_levels_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_user_levels_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_user_levels_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_user_levels_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_user_levels_list->desc->Visible) { // desc ?>
	<?php if ($_user_levels_list->SortUrl($_user_levels_list->desc) == "") { ?>
		<th data-name="desc" class="<?php echo $_user_levels_list->desc->headerCellClass() ?>"><div id="elh__user_levels_desc" class="_user_levels_desc"><div class="ew-table-header-caption"><?php echo $_user_levels_list->desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="desc" class="<?php echo $_user_levels_list->desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_user_levels_list->SortUrl($_user_levels_list->desc) ?>', 1);"><div id="elh__user_levels_desc" class="_user_levels_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_user_levels_list->desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_user_levels_list->desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_user_levels_list->desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_user_levels_list->created_at->Visible) { // created_at ?>
	<?php if ($_user_levels_list->SortUrl($_user_levels_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $_user_levels_list->created_at->headerCellClass() ?>"><div id="elh__user_levels_created_at" class="_user_levels_created_at"><div class="ew-table-header-caption"><?php echo $_user_levels_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $_user_levels_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_user_levels_list->SortUrl($_user_levels_list->created_at) ?>', 1);"><div id="elh__user_levels_created_at" class="_user_levels_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_user_levels_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($_user_levels_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_user_levels_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_user_levels_list->updated_at->Visible) { // updated_at ?>
	<?php if ($_user_levels_list->SortUrl($_user_levels_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $_user_levels_list->updated_at->headerCellClass() ?>"><div id="elh__user_levels_updated_at" class="_user_levels_updated_at"><div class="ew-table-header-caption"><?php echo $_user_levels_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $_user_levels_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_user_levels_list->SortUrl($_user_levels_list->updated_at) ?>', 1);"><div id="elh__user_levels_updated_at" class="_user_levels_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_user_levels_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($_user_levels_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_user_levels_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_user_levels_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($_user_levels_list->ExportAll && $_user_levels_list->isExport()) {
	$_user_levels_list->StopRecord = $_user_levels_list->TotalRecords;
} else {

	// Set the last record to display
	if ($_user_levels_list->TotalRecords > $_user_levels_list->StartRecord + $_user_levels_list->DisplayRecords - 1)
		$_user_levels_list->StopRecord = $_user_levels_list->StartRecord + $_user_levels_list->DisplayRecords - 1;
	else
		$_user_levels_list->StopRecord = $_user_levels_list->TotalRecords;
}
$_user_levels_list->RecordCount = $_user_levels_list->StartRecord - 1;
if ($_user_levels_list->Recordset && !$_user_levels_list->Recordset->EOF) {
	$_user_levels_list->Recordset->moveFirst();
	$selectLimit = $_user_levels_list->UseSelectLimit;
	if (!$selectLimit && $_user_levels_list->StartRecord > 1)
		$_user_levels_list->Recordset->move($_user_levels_list->StartRecord - 1);
} elseif (!$_user_levels->AllowAddDeleteRow && $_user_levels_list->StopRecord == 0) {
	$_user_levels_list->StopRecord = $_user_levels->GridAddRowCount;
}

// Initialize aggregate
$_user_levels->RowType = ROWTYPE_AGGREGATEINIT;
$_user_levels->resetAttributes();
$_user_levels_list->renderRow();
while ($_user_levels_list->RecordCount < $_user_levels_list->StopRecord) {
	$_user_levels_list->RecordCount++;
	if ($_user_levels_list->RecordCount >= $_user_levels_list->StartRecord) {
		$_user_levels_list->RowCount++;

		// Set up key count
		$_user_levels_list->KeyCount = $_user_levels_list->RowIndex;

		// Init row class and style
		$_user_levels->resetAttributes();
		$_user_levels->CssClass = "";
		if ($_user_levels_list->isGridAdd()) {
		} else {
			$_user_levels_list->loadRowValues($_user_levels_list->Recordset); // Load row values
		}
		$_user_levels->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$_user_levels->RowAttrs->merge(["data-rowindex" => $_user_levels_list->RowCount, "id" => "r" . $_user_levels_list->RowCount . "__user_levels", "data-rowtype" => $_user_levels->RowType]);

		// Render row
		$_user_levels_list->renderRow();

		// Render list options
		$_user_levels_list->renderListOptions();
?>
	<tr <?php echo $_user_levels->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_user_levels_list->ListOptions->render("body", "left", $_user_levels_list->RowCount);
?>
	<?php if ($_user_levels_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $_user_levels_list->id->cellAttributes() ?>>
<span id="el<?php echo $_user_levels_list->RowCount ?>__user_levels_id">
<span<?php echo $_user_levels_list->id->viewAttributes() ?>><?php echo $_user_levels_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_user_levels_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $_user_levels_list->name->cellAttributes() ?>>
<span id="el<?php echo $_user_levels_list->RowCount ?>__user_levels_name">
<span<?php echo $_user_levels_list->name->viewAttributes() ?>><?php echo $_user_levels_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_user_levels_list->desc->Visible) { // desc ?>
		<td data-name="desc" <?php echo $_user_levels_list->desc->cellAttributes() ?>>
<span id="el<?php echo $_user_levels_list->RowCount ?>__user_levels_desc">
<span<?php echo $_user_levels_list->desc->viewAttributes() ?>><?php echo $_user_levels_list->desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_user_levels_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $_user_levels_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $_user_levels_list->RowCount ?>__user_levels_created_at">
<span<?php echo $_user_levels_list->created_at->viewAttributes() ?>><?php echo $_user_levels_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_user_levels_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $_user_levels_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $_user_levels_list->RowCount ?>__user_levels_updated_at">
<span<?php echo $_user_levels_list->updated_at->viewAttributes() ?>><?php echo $_user_levels_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_user_levels_list->ListOptions->render("body", "right", $_user_levels_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$_user_levels_list->isGridAdd())
		$_user_levels_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$_user_levels->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_user_levels_list->Recordset)
	$_user_levels_list->Recordset->Close();
?>
<?php if (!$_user_levels_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$_user_levels_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_user_levels_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_user_levels_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_user_levels_list->TotalRecords == 0 && !$_user_levels->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_user_levels_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$_user_levels_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_user_levels_list->isExport()) { ?>
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
$_user_levels_list->terminate();
?>
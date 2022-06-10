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
$sections_list = new sections_list();

// Run the page
$sections_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sections_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sections_list->isExport()) { ?>
<script>
var fsectionslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsectionslist = currentForm = new ew.Form("fsectionslist", "list");
	fsectionslist.formKeyCountName = '<?php echo $sections_list->FormKeyCountName ?>';
	loadjs.done("fsectionslist");
});
var fsectionslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsectionslistsrch = currentSearchForm = new ew.Form("fsectionslistsrch");

	// Dynamic selection lists
	// Filters

	fsectionslistsrch.filterList = <?php echo $sections_list->getFilterList() ?>;
	loadjs.done("fsectionslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sections_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sections_list->TotalRecords > 0 && $sections_list->ExportOptions->visible()) { ?>
<?php $sections_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sections_list->ImportOptions->visible()) { ?>
<?php $sections_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($sections_list->SearchOptions->visible()) { ?>
<?php $sections_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($sections_list->FilterOptions->visible()) { ?>
<?php $sections_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sections_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$sections_list->isExport() && !$sections->CurrentAction) { ?>
<form name="fsectionslistsrch" id="fsectionslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsectionslistsrch-search-panel" class="<?php echo $sections_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="sections">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $sections_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($sections_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($sections_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $sections_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($sections_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($sections_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($sections_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($sections_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $sections_list->showPageHeader(); ?>
<?php
$sections_list->showMessage();
?>
<?php if ($sections_list->TotalRecords > 0 || $sections->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($sections_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sections">
<?php if (!$sections_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$sections_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sections_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sections_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsectionslist" id="fsectionslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sections">
<div id="gmp_sections" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($sections_list->TotalRecords > 0 || $sections_list->isGridEdit()) { ?>
<table id="tbl_sectionslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$sections->RowType = ROWTYPE_HEADER;

// Render list options
$sections_list->renderListOptions();

// Render list options (header, left)
$sections_list->ListOptions->render("header", "left");
?>
<?php if ($sections_list->id->Visible) { // id ?>
	<?php if ($sections_list->SortUrl($sections_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $sections_list->id->headerCellClass() ?>"><div id="elh_sections_id" class="sections_id"><div class="ew-table-header-caption"><?php echo $sections_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $sections_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sections_list->SortUrl($sections_list->id) ?>', 1);"><div id="elh_sections_id" class="sections_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sections_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sections_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sections_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sections_list->title->Visible) { // title ?>
	<?php if ($sections_list->SortUrl($sections_list->title) == "") { ?>
		<th data-name="title" class="<?php echo $sections_list->title->headerCellClass() ?>"><div id="elh_sections_title" class="sections_title"><div class="ew-table-header-caption"><?php echo $sections_list->title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="title" class="<?php echo $sections_list->title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sections_list->SortUrl($sections_list->title) ?>', 1);"><div id="elh_sections_title" class="sections_title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sections_list->title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sections_list->title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sections_list->title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sections_list->desc->Visible) { // desc ?>
	<?php if ($sections_list->SortUrl($sections_list->desc) == "") { ?>
		<th data-name="desc" class="<?php echo $sections_list->desc->headerCellClass() ?>"><div id="elh_sections_desc" class="sections_desc"><div class="ew-table-header-caption"><?php echo $sections_list->desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="desc" class="<?php echo $sections_list->desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sections_list->SortUrl($sections_list->desc) ?>', 1);"><div id="elh_sections_desc" class="sections_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sections_list->desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sections_list->desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sections_list->desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sections_list->order->Visible) { // order ?>
	<?php if ($sections_list->SortUrl($sections_list->order) == "") { ?>
		<th data-name="order" class="<?php echo $sections_list->order->headerCellClass() ?>"><div id="elh_sections_order" class="sections_order"><div class="ew-table-header-caption"><?php echo $sections_list->order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order" class="<?php echo $sections_list->order->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sections_list->SortUrl($sections_list->order) ?>', 1);"><div id="elh_sections_order" class="sections_order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sections_list->order->caption() ?></span><span class="ew-table-header-sort"><?php if ($sections_list->order->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sections_list->order->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sections_list->created_at->Visible) { // created_at ?>
	<?php if ($sections_list->SortUrl($sections_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $sections_list->created_at->headerCellClass() ?>"><div id="elh_sections_created_at" class="sections_created_at"><div class="ew-table-header-caption"><?php echo $sections_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $sections_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sections_list->SortUrl($sections_list->created_at) ?>', 1);"><div id="elh_sections_created_at" class="sections_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sections_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($sections_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sections_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sections_list->updated_at->Visible) { // updated_at ?>
	<?php if ($sections_list->SortUrl($sections_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $sections_list->updated_at->headerCellClass() ?>"><div id="elh_sections_updated_at" class="sections_updated_at"><div class="ew-table-header-caption"><?php echo $sections_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $sections_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sections_list->SortUrl($sections_list->updated_at) ?>', 1);"><div id="elh_sections_updated_at" class="sections_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sections_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($sections_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sections_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$sections_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($sections_list->ExportAll && $sections_list->isExport()) {
	$sections_list->StopRecord = $sections_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sections_list->TotalRecords > $sections_list->StartRecord + $sections_list->DisplayRecords - 1)
		$sections_list->StopRecord = $sections_list->StartRecord + $sections_list->DisplayRecords - 1;
	else
		$sections_list->StopRecord = $sections_list->TotalRecords;
}
$sections_list->RecordCount = $sections_list->StartRecord - 1;
if ($sections_list->Recordset && !$sections_list->Recordset->EOF) {
	$sections_list->Recordset->moveFirst();
	$selectLimit = $sections_list->UseSelectLimit;
	if (!$selectLimit && $sections_list->StartRecord > 1)
		$sections_list->Recordset->move($sections_list->StartRecord - 1);
} elseif (!$sections->AllowAddDeleteRow && $sections_list->StopRecord == 0) {
	$sections_list->StopRecord = $sections->GridAddRowCount;
}

// Initialize aggregate
$sections->RowType = ROWTYPE_AGGREGATEINIT;
$sections->resetAttributes();
$sections_list->renderRow();
while ($sections_list->RecordCount < $sections_list->StopRecord) {
	$sections_list->RecordCount++;
	if ($sections_list->RecordCount >= $sections_list->StartRecord) {
		$sections_list->RowCount++;

		// Set up key count
		$sections_list->KeyCount = $sections_list->RowIndex;

		// Init row class and style
		$sections->resetAttributes();
		$sections->CssClass = "";
		if ($sections_list->isGridAdd()) {
		} else {
			$sections_list->loadRowValues($sections_list->Recordset); // Load row values
		}
		$sections->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sections->RowAttrs->merge(["data-rowindex" => $sections_list->RowCount, "id" => "r" . $sections_list->RowCount . "_sections", "data-rowtype" => $sections->RowType]);

		// Render row
		$sections_list->renderRow();

		// Render list options
		$sections_list->renderListOptions();
?>
	<tr <?php echo $sections->rowAttributes() ?>>
<?php

// Render list options (body, left)
$sections_list->ListOptions->render("body", "left", $sections_list->RowCount);
?>
	<?php if ($sections_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $sections_list->id->cellAttributes() ?>>
<span id="el<?php echo $sections_list->RowCount ?>_sections_id">
<span<?php echo $sections_list->id->viewAttributes() ?>><?php echo $sections_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sections_list->title->Visible) { // title ?>
		<td data-name="title" <?php echo $sections_list->title->cellAttributes() ?>>
<span id="el<?php echo $sections_list->RowCount ?>_sections_title">
<span<?php echo $sections_list->title->viewAttributes() ?>><?php echo $sections_list->title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sections_list->desc->Visible) { // desc ?>
		<td data-name="desc" <?php echo $sections_list->desc->cellAttributes() ?>>
<span id="el<?php echo $sections_list->RowCount ?>_sections_desc">
<span<?php echo $sections_list->desc->viewAttributes() ?>><?php echo $sections_list->desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sections_list->order->Visible) { // order ?>
		<td data-name="order" <?php echo $sections_list->order->cellAttributes() ?>>
<span id="el<?php echo $sections_list->RowCount ?>_sections_order">
<span<?php echo $sections_list->order->viewAttributes() ?>><?php echo $sections_list->order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sections_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $sections_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $sections_list->RowCount ?>_sections_created_at">
<span<?php echo $sections_list->created_at->viewAttributes() ?>><?php echo $sections_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sections_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $sections_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $sections_list->RowCount ?>_sections_updated_at">
<span<?php echo $sections_list->updated_at->viewAttributes() ?>><?php echo $sections_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sections_list->ListOptions->render("body", "right", $sections_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$sections_list->isGridAdd())
		$sections_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$sections->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sections_list->Recordset)
	$sections_list->Recordset->Close();
?>
<?php if (!$sections_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$sections_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sections_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sections_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($sections_list->TotalRecords == 0 && !$sections->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sections_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sections_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sections_list->isExport()) { ?>
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
$sections_list->terminate();
?>
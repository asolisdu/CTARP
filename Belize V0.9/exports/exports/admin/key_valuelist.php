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
$key_value_list = new key_value_list();

// Run the page
$key_value_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$key_value_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$key_value_list->isExport()) { ?>
<script>
var fkey_valuelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fkey_valuelist = currentForm = new ew.Form("fkey_valuelist", "list");
	fkey_valuelist.formKeyCountName = '<?php echo $key_value_list->FormKeyCountName ?>';
	loadjs.done("fkey_valuelist");
});
var fkey_valuelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fkey_valuelistsrch = currentSearchForm = new ew.Form("fkey_valuelistsrch");

	// Dynamic selection lists
	// Filters

	fkey_valuelistsrch.filterList = <?php echo $key_value_list->getFilterList() ?>;
	loadjs.done("fkey_valuelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$key_value_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($key_value_list->TotalRecords > 0 && $key_value_list->ExportOptions->visible()) { ?>
<?php $key_value_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($key_value_list->ImportOptions->visible()) { ?>
<?php $key_value_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($key_value_list->SearchOptions->visible()) { ?>
<?php $key_value_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($key_value_list->FilterOptions->visible()) { ?>
<?php $key_value_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$key_value_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$key_value_list->isExport() && !$key_value->CurrentAction) { ?>
<form name="fkey_valuelistsrch" id="fkey_valuelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fkey_valuelistsrch-search-panel" class="<?php echo $key_value_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="key_value">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $key_value_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($key_value_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($key_value_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $key_value_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($key_value_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($key_value_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($key_value_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($key_value_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $key_value_list->showPageHeader(); ?>
<?php
$key_value_list->showMessage();
?>
<?php if ($key_value_list->TotalRecords > 0 || $key_value->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($key_value_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> key_value">
<?php if (!$key_value_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$key_value_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $key_value_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $key_value_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fkey_valuelist" id="fkey_valuelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="key_value">
<div id="gmp_key_value" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($key_value_list->TotalRecords > 0 || $key_value_list->isGridEdit()) { ?>
<table id="tbl_key_valuelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$key_value->RowType = ROWTYPE_HEADER;

// Render list options
$key_value_list->renderListOptions();

// Render list options (header, left)
$key_value_list->ListOptions->render("header", "left");
?>
<?php if ($key_value_list->id->Visible) { // id ?>
	<?php if ($key_value_list->SortUrl($key_value_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $key_value_list->id->headerCellClass() ?>"><div id="elh_key_value_id" class="key_value_id"><div class="ew-table-header-caption"><?php echo $key_value_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $key_value_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $key_value_list->SortUrl($key_value_list->id) ?>', 1);"><div id="elh_key_value_id" class="key_value_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $key_value_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($key_value_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($key_value_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($key_value_list->name->Visible) { // name ?>
	<?php if ($key_value_list->SortUrl($key_value_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $key_value_list->name->headerCellClass() ?>"><div id="elh_key_value_name" class="key_value_name"><div class="ew-table-header-caption"><?php echo $key_value_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $key_value_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $key_value_list->SortUrl($key_value_list->name) ?>', 1);"><div id="elh_key_value_name" class="key_value_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $key_value_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($key_value_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($key_value_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$key_value_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($key_value_list->ExportAll && $key_value_list->isExport()) {
	$key_value_list->StopRecord = $key_value_list->TotalRecords;
} else {

	// Set the last record to display
	if ($key_value_list->TotalRecords > $key_value_list->StartRecord + $key_value_list->DisplayRecords - 1)
		$key_value_list->StopRecord = $key_value_list->StartRecord + $key_value_list->DisplayRecords - 1;
	else
		$key_value_list->StopRecord = $key_value_list->TotalRecords;
}
$key_value_list->RecordCount = $key_value_list->StartRecord - 1;
if ($key_value_list->Recordset && !$key_value_list->Recordset->EOF) {
	$key_value_list->Recordset->moveFirst();
	$selectLimit = $key_value_list->UseSelectLimit;
	if (!$selectLimit && $key_value_list->StartRecord > 1)
		$key_value_list->Recordset->move($key_value_list->StartRecord - 1);
} elseif (!$key_value->AllowAddDeleteRow && $key_value_list->StopRecord == 0) {
	$key_value_list->StopRecord = $key_value->GridAddRowCount;
}

// Initialize aggregate
$key_value->RowType = ROWTYPE_AGGREGATEINIT;
$key_value->resetAttributes();
$key_value_list->renderRow();
while ($key_value_list->RecordCount < $key_value_list->StopRecord) {
	$key_value_list->RecordCount++;
	if ($key_value_list->RecordCount >= $key_value_list->StartRecord) {
		$key_value_list->RowCount++;

		// Set up key count
		$key_value_list->KeyCount = $key_value_list->RowIndex;

		// Init row class and style
		$key_value->resetAttributes();
		$key_value->CssClass = "";
		if ($key_value_list->isGridAdd()) {
		} else {
			$key_value_list->loadRowValues($key_value_list->Recordset); // Load row values
		}
		$key_value->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$key_value->RowAttrs->merge(["data-rowindex" => $key_value_list->RowCount, "id" => "r" . $key_value_list->RowCount . "_key_value", "data-rowtype" => $key_value->RowType]);

		// Render row
		$key_value_list->renderRow();

		// Render list options
		$key_value_list->renderListOptions();
?>
	<tr <?php echo $key_value->rowAttributes() ?>>
<?php

// Render list options (body, left)
$key_value_list->ListOptions->render("body", "left", $key_value_list->RowCount);
?>
	<?php if ($key_value_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $key_value_list->id->cellAttributes() ?>>
<span id="el<?php echo $key_value_list->RowCount ?>_key_value_id">
<span<?php echo $key_value_list->id->viewAttributes() ?>><?php echo $key_value_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($key_value_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $key_value_list->name->cellAttributes() ?>>
<span id="el<?php echo $key_value_list->RowCount ?>_key_value_name">
<span<?php echo $key_value_list->name->viewAttributes() ?>><?php echo $key_value_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$key_value_list->ListOptions->render("body", "right", $key_value_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$key_value_list->isGridAdd())
		$key_value_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$key_value->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($key_value_list->Recordset)
	$key_value_list->Recordset->Close();
?>
<?php if (!$key_value_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$key_value_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $key_value_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $key_value_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($key_value_list->TotalRecords == 0 && !$key_value->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $key_value_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$key_value_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$key_value_list->isExport()) { ?>
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
$key_value_list->terminate();
?>
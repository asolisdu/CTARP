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
$question_types_list = new question_types_list();

// Run the page
$question_types_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$question_types_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$question_types_list->isExport()) { ?>
<script>
var fquestion_typeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fquestion_typeslist = currentForm = new ew.Form("fquestion_typeslist", "list");
	fquestion_typeslist.formKeyCountName = '<?php echo $question_types_list->FormKeyCountName ?>';
	loadjs.done("fquestion_typeslist");
});
var fquestion_typeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fquestion_typeslistsrch = currentSearchForm = new ew.Form("fquestion_typeslistsrch");

	// Dynamic selection lists
	// Filters

	fquestion_typeslistsrch.filterList = <?php echo $question_types_list->getFilterList() ?>;
	loadjs.done("fquestion_typeslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$question_types_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($question_types_list->TotalRecords > 0 && $question_types_list->ExportOptions->visible()) { ?>
<?php $question_types_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($question_types_list->ImportOptions->visible()) { ?>
<?php $question_types_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($question_types_list->SearchOptions->visible()) { ?>
<?php $question_types_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($question_types_list->FilterOptions->visible()) { ?>
<?php $question_types_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$question_types_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$question_types_list->isExport() && !$question_types->CurrentAction) { ?>
<form name="fquestion_typeslistsrch" id="fquestion_typeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fquestion_typeslistsrch-search-panel" class="<?php echo $question_types_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="question_types">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $question_types_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($question_types_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($question_types_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $question_types_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($question_types_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($question_types_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($question_types_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($question_types_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $question_types_list->showPageHeader(); ?>
<?php
$question_types_list->showMessage();
?>
<?php if ($question_types_list->TotalRecords > 0 || $question_types->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($question_types_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> question_types">
<?php if (!$question_types_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$question_types_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $question_types_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $question_types_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fquestion_typeslist" id="fquestion_typeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="question_types">
<div id="gmp_question_types" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($question_types_list->TotalRecords > 0 || $question_types_list->isGridEdit()) { ?>
<table id="tbl_question_typeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$question_types->RowType = ROWTYPE_HEADER;

// Render list options
$question_types_list->renderListOptions();

// Render list options (header, left)
$question_types_list->ListOptions->render("header", "left");
?>
<?php if ($question_types_list->id->Visible) { // id ?>
	<?php if ($question_types_list->SortUrl($question_types_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $question_types_list->id->headerCellClass() ?>"><div id="elh_question_types_id" class="question_types_id"><div class="ew-table-header-caption"><?php echo $question_types_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $question_types_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $question_types_list->SortUrl($question_types_list->id) ?>', 1);"><div id="elh_question_types_id" class="question_types_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $question_types_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($question_types_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($question_types_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($question_types_list->name->Visible) { // name ?>
	<?php if ($question_types_list->SortUrl($question_types_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $question_types_list->name->headerCellClass() ?>"><div id="elh_question_types_name" class="question_types_name"><div class="ew-table-header-caption"><?php echo $question_types_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $question_types_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $question_types_list->SortUrl($question_types_list->name) ?>', 1);"><div id="elh_question_types_name" class="question_types_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $question_types_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($question_types_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($question_types_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($question_types_list->desc->Visible) { // desc ?>
	<?php if ($question_types_list->SortUrl($question_types_list->desc) == "") { ?>
		<th data-name="desc" class="<?php echo $question_types_list->desc->headerCellClass() ?>"><div id="elh_question_types_desc" class="question_types_desc"><div class="ew-table-header-caption"><?php echo $question_types_list->desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="desc" class="<?php echo $question_types_list->desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $question_types_list->SortUrl($question_types_list->desc) ?>', 1);"><div id="elh_question_types_desc" class="question_types_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $question_types_list->desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($question_types_list->desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($question_types_list->desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($question_types_list->active->Visible) { // active ?>
	<?php if ($question_types_list->SortUrl($question_types_list->active) == "") { ?>
		<th data-name="active" class="<?php echo $question_types_list->active->headerCellClass() ?>"><div id="elh_question_types_active" class="question_types_active"><div class="ew-table-header-caption"><?php echo $question_types_list->active->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="active" class="<?php echo $question_types_list->active->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $question_types_list->SortUrl($question_types_list->active) ?>', 1);"><div id="elh_question_types_active" class="question_types_active">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $question_types_list->active->caption() ?></span><span class="ew-table-header-sort"><?php if ($question_types_list->active->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($question_types_list->active->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($question_types_list->created_at->Visible) { // created_at ?>
	<?php if ($question_types_list->SortUrl($question_types_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $question_types_list->created_at->headerCellClass() ?>"><div id="elh_question_types_created_at" class="question_types_created_at"><div class="ew-table-header-caption"><?php echo $question_types_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $question_types_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $question_types_list->SortUrl($question_types_list->created_at) ?>', 1);"><div id="elh_question_types_created_at" class="question_types_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $question_types_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($question_types_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($question_types_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($question_types_list->updated_at->Visible) { // updated_at ?>
	<?php if ($question_types_list->SortUrl($question_types_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $question_types_list->updated_at->headerCellClass() ?>"><div id="elh_question_types_updated_at" class="question_types_updated_at"><div class="ew-table-header-caption"><?php echo $question_types_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $question_types_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $question_types_list->SortUrl($question_types_list->updated_at) ?>', 1);"><div id="elh_question_types_updated_at" class="question_types_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $question_types_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($question_types_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($question_types_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$question_types_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($question_types_list->ExportAll && $question_types_list->isExport()) {
	$question_types_list->StopRecord = $question_types_list->TotalRecords;
} else {

	// Set the last record to display
	if ($question_types_list->TotalRecords > $question_types_list->StartRecord + $question_types_list->DisplayRecords - 1)
		$question_types_list->StopRecord = $question_types_list->StartRecord + $question_types_list->DisplayRecords - 1;
	else
		$question_types_list->StopRecord = $question_types_list->TotalRecords;
}
$question_types_list->RecordCount = $question_types_list->StartRecord - 1;
if ($question_types_list->Recordset && !$question_types_list->Recordset->EOF) {
	$question_types_list->Recordset->moveFirst();
	$selectLimit = $question_types_list->UseSelectLimit;
	if (!$selectLimit && $question_types_list->StartRecord > 1)
		$question_types_list->Recordset->move($question_types_list->StartRecord - 1);
} elseif (!$question_types->AllowAddDeleteRow && $question_types_list->StopRecord == 0) {
	$question_types_list->StopRecord = $question_types->GridAddRowCount;
}

// Initialize aggregate
$question_types->RowType = ROWTYPE_AGGREGATEINIT;
$question_types->resetAttributes();
$question_types_list->renderRow();
while ($question_types_list->RecordCount < $question_types_list->StopRecord) {
	$question_types_list->RecordCount++;
	if ($question_types_list->RecordCount >= $question_types_list->StartRecord) {
		$question_types_list->RowCount++;

		// Set up key count
		$question_types_list->KeyCount = $question_types_list->RowIndex;

		// Init row class and style
		$question_types->resetAttributes();
		$question_types->CssClass = "";
		if ($question_types_list->isGridAdd()) {
		} else {
			$question_types_list->loadRowValues($question_types_list->Recordset); // Load row values
		}
		$question_types->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$question_types->RowAttrs->merge(["data-rowindex" => $question_types_list->RowCount, "id" => "r" . $question_types_list->RowCount . "_question_types", "data-rowtype" => $question_types->RowType]);

		// Render row
		$question_types_list->renderRow();

		// Render list options
		$question_types_list->renderListOptions();
?>
	<tr <?php echo $question_types->rowAttributes() ?>>
<?php

// Render list options (body, left)
$question_types_list->ListOptions->render("body", "left", $question_types_list->RowCount);
?>
	<?php if ($question_types_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $question_types_list->id->cellAttributes() ?>>
<span id="el<?php echo $question_types_list->RowCount ?>_question_types_id">
<span<?php echo $question_types_list->id->viewAttributes() ?>><?php echo $question_types_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($question_types_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $question_types_list->name->cellAttributes() ?>>
<span id="el<?php echo $question_types_list->RowCount ?>_question_types_name">
<span<?php echo $question_types_list->name->viewAttributes() ?>><?php echo $question_types_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($question_types_list->desc->Visible) { // desc ?>
		<td data-name="desc" <?php echo $question_types_list->desc->cellAttributes() ?>>
<span id="el<?php echo $question_types_list->RowCount ?>_question_types_desc">
<span<?php echo $question_types_list->desc->viewAttributes() ?>><?php echo $question_types_list->desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($question_types_list->active->Visible) { // active ?>
		<td data-name="active" <?php echo $question_types_list->active->cellAttributes() ?>>
<span id="el<?php echo $question_types_list->RowCount ?>_question_types_active">
<span<?php echo $question_types_list->active->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_active" class="custom-control-input" value="<?php echo $question_types_list->active->getViewValue() ?>" disabled<?php if (ConvertToBool($question_types_list->active->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_active"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($question_types_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $question_types_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $question_types_list->RowCount ?>_question_types_created_at">
<span<?php echo $question_types_list->created_at->viewAttributes() ?>><?php echo $question_types_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($question_types_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $question_types_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $question_types_list->RowCount ?>_question_types_updated_at">
<span<?php echo $question_types_list->updated_at->viewAttributes() ?>><?php echo $question_types_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$question_types_list->ListOptions->render("body", "right", $question_types_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$question_types_list->isGridAdd())
		$question_types_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$question_types->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($question_types_list->Recordset)
	$question_types_list->Recordset->Close();
?>
<?php if (!$question_types_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$question_types_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $question_types_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $question_types_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($question_types_list->TotalRecords == 0 && !$question_types->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $question_types_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$question_types_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$question_types_list->isExport()) { ?>
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
$question_types_list->terminate();
?>
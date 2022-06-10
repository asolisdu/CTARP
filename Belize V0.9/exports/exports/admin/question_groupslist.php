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
$question_groups_list = new question_groups_list();

// Run the page
$question_groups_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$question_groups_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$question_groups_list->isExport()) { ?>
<script>
var fquestion_groupslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fquestion_groupslist = currentForm = new ew.Form("fquestion_groupslist", "list");
	fquestion_groupslist.formKeyCountName = '<?php echo $question_groups_list->FormKeyCountName ?>';
	loadjs.done("fquestion_groupslist");
});
var fquestion_groupslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fquestion_groupslistsrch = currentSearchForm = new ew.Form("fquestion_groupslistsrch");

	// Dynamic selection lists
	// Filters

	fquestion_groupslistsrch.filterList = <?php echo $question_groups_list->getFilterList() ?>;
	loadjs.done("fquestion_groupslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$question_groups_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($question_groups_list->TotalRecords > 0 && $question_groups_list->ExportOptions->visible()) { ?>
<?php $question_groups_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($question_groups_list->ImportOptions->visible()) { ?>
<?php $question_groups_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($question_groups_list->SearchOptions->visible()) { ?>
<?php $question_groups_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($question_groups_list->FilterOptions->visible()) { ?>
<?php $question_groups_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$question_groups_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$question_groups_list->isExport() && !$question_groups->CurrentAction) { ?>
<form name="fquestion_groupslistsrch" id="fquestion_groupslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fquestion_groupslistsrch-search-panel" class="<?php echo $question_groups_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="question_groups">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $question_groups_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($question_groups_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($question_groups_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $question_groups_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($question_groups_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($question_groups_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($question_groups_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($question_groups_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $question_groups_list->showPageHeader(); ?>
<?php
$question_groups_list->showMessage();
?>
<?php if ($question_groups_list->TotalRecords > 0 || $question_groups->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($question_groups_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> question_groups">
<?php if (!$question_groups_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$question_groups_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $question_groups_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $question_groups_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fquestion_groupslist" id="fquestion_groupslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="question_groups">
<div id="gmp_question_groups" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($question_groups_list->TotalRecords > 0 || $question_groups_list->isGridEdit()) { ?>
<table id="tbl_question_groupslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$question_groups->RowType = ROWTYPE_HEADER;

// Render list options
$question_groups_list->renderListOptions();

// Render list options (header, left)
$question_groups_list->ListOptions->render("header", "left");
?>
<?php if ($question_groups_list->id->Visible) { // id ?>
	<?php if ($question_groups_list->SortUrl($question_groups_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $question_groups_list->id->headerCellClass() ?>"><div id="elh_question_groups_id" class="question_groups_id"><div class="ew-table-header-caption"><?php echo $question_groups_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $question_groups_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $question_groups_list->SortUrl($question_groups_list->id) ?>', 1);"><div id="elh_question_groups_id" class="question_groups_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $question_groups_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($question_groups_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($question_groups_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($question_groups_list->name->Visible) { // name ?>
	<?php if ($question_groups_list->SortUrl($question_groups_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $question_groups_list->name->headerCellClass() ?>"><div id="elh_question_groups_name" class="question_groups_name"><div class="ew-table-header-caption"><?php echo $question_groups_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $question_groups_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $question_groups_list->SortUrl($question_groups_list->name) ?>', 1);"><div id="elh_question_groups_name" class="question_groups_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $question_groups_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($question_groups_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($question_groups_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($question_groups_list->desc->Visible) { // desc ?>
	<?php if ($question_groups_list->SortUrl($question_groups_list->desc) == "") { ?>
		<th data-name="desc" class="<?php echo $question_groups_list->desc->headerCellClass() ?>"><div id="elh_question_groups_desc" class="question_groups_desc"><div class="ew-table-header-caption"><?php echo $question_groups_list->desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="desc" class="<?php echo $question_groups_list->desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $question_groups_list->SortUrl($question_groups_list->desc) ?>', 1);"><div id="elh_question_groups_desc" class="question_groups_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $question_groups_list->desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($question_groups_list->desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($question_groups_list->desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$question_groups_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($question_groups_list->ExportAll && $question_groups_list->isExport()) {
	$question_groups_list->StopRecord = $question_groups_list->TotalRecords;
} else {

	// Set the last record to display
	if ($question_groups_list->TotalRecords > $question_groups_list->StartRecord + $question_groups_list->DisplayRecords - 1)
		$question_groups_list->StopRecord = $question_groups_list->StartRecord + $question_groups_list->DisplayRecords - 1;
	else
		$question_groups_list->StopRecord = $question_groups_list->TotalRecords;
}
$question_groups_list->RecordCount = $question_groups_list->StartRecord - 1;
if ($question_groups_list->Recordset && !$question_groups_list->Recordset->EOF) {
	$question_groups_list->Recordset->moveFirst();
	$selectLimit = $question_groups_list->UseSelectLimit;
	if (!$selectLimit && $question_groups_list->StartRecord > 1)
		$question_groups_list->Recordset->move($question_groups_list->StartRecord - 1);
} elseif (!$question_groups->AllowAddDeleteRow && $question_groups_list->StopRecord == 0) {
	$question_groups_list->StopRecord = $question_groups->GridAddRowCount;
}

// Initialize aggregate
$question_groups->RowType = ROWTYPE_AGGREGATEINIT;
$question_groups->resetAttributes();
$question_groups_list->renderRow();
while ($question_groups_list->RecordCount < $question_groups_list->StopRecord) {
	$question_groups_list->RecordCount++;
	if ($question_groups_list->RecordCount >= $question_groups_list->StartRecord) {
		$question_groups_list->RowCount++;

		// Set up key count
		$question_groups_list->KeyCount = $question_groups_list->RowIndex;

		// Init row class and style
		$question_groups->resetAttributes();
		$question_groups->CssClass = "";
		if ($question_groups_list->isGridAdd()) {
		} else {
			$question_groups_list->loadRowValues($question_groups_list->Recordset); // Load row values
		}
		$question_groups->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$question_groups->RowAttrs->merge(["data-rowindex" => $question_groups_list->RowCount, "id" => "r" . $question_groups_list->RowCount . "_question_groups", "data-rowtype" => $question_groups->RowType]);

		// Render row
		$question_groups_list->renderRow();

		// Render list options
		$question_groups_list->renderListOptions();
?>
	<tr <?php echo $question_groups->rowAttributes() ?>>
<?php

// Render list options (body, left)
$question_groups_list->ListOptions->render("body", "left", $question_groups_list->RowCount);
?>
	<?php if ($question_groups_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $question_groups_list->id->cellAttributes() ?>>
<span id="el<?php echo $question_groups_list->RowCount ?>_question_groups_id">
<span<?php echo $question_groups_list->id->viewAttributes() ?>><?php echo $question_groups_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($question_groups_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $question_groups_list->name->cellAttributes() ?>>
<span id="el<?php echo $question_groups_list->RowCount ?>_question_groups_name">
<span<?php echo $question_groups_list->name->viewAttributes() ?>><?php echo $question_groups_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($question_groups_list->desc->Visible) { // desc ?>
		<td data-name="desc" <?php echo $question_groups_list->desc->cellAttributes() ?>>
<span id="el<?php echo $question_groups_list->RowCount ?>_question_groups_desc">
<span<?php echo $question_groups_list->desc->viewAttributes() ?>><?php echo $question_groups_list->desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$question_groups_list->ListOptions->render("body", "right", $question_groups_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$question_groups_list->isGridAdd())
		$question_groups_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$question_groups->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($question_groups_list->Recordset)
	$question_groups_list->Recordset->Close();
?>
<?php if (!$question_groups_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$question_groups_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $question_groups_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $question_groups_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($question_groups_list->TotalRecords == 0 && !$question_groups->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $question_groups_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$question_groups_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$question_groups_list->isExport()) { ?>
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
$question_groups_list->terminate();
?>
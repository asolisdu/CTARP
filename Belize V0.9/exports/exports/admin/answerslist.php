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
$answers_list = new answers_list();

// Run the page
$answers_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$answers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$answers_list->isExport()) { ?>
<script>
var fanswerslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fanswerslist = currentForm = new ew.Form("fanswerslist", "list");
	fanswerslist.formKeyCountName = '<?php echo $answers_list->FormKeyCountName ?>';
	loadjs.done("fanswerslist");
});
var fanswerslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fanswerslistsrch = currentSearchForm = new ew.Form("fanswerslistsrch");

	// Dynamic selection lists
	// Filters

	fanswerslistsrch.filterList = <?php echo $answers_list->getFilterList() ?>;
	loadjs.done("fanswerslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$answers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($answers_list->TotalRecords > 0 && $answers_list->ExportOptions->visible()) { ?>
<?php $answers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($answers_list->ImportOptions->visible()) { ?>
<?php $answers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($answers_list->SearchOptions->visible()) { ?>
<?php $answers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($answers_list->FilterOptions->visible()) { ?>
<?php $answers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$answers_list->isExport() || Config("EXPORT_MASTER_RECORD") && $answers_list->isExport("print")) { ?>
<?php
if ($answers_list->DbMasterFilter != "" && $answers->getCurrentMasterTable() == "questions") {
	if ($answers_list->MasterRecordExists) {
		include_once "questionsmaster.php";
	}
}
?>
<?php
if ($answers_list->DbMasterFilter != "" && $answers->getCurrentMasterTable() == "assessments") {
	if ($answers_list->MasterRecordExists) {
		include_once "assessmentsmaster.php";
	}
}
?>
<?php } ?>
<?php
$answers_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$answers_list->isExport() && !$answers->CurrentAction) { ?>
<form name="fanswerslistsrch" id="fanswerslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fanswerslistsrch-search-panel" class="<?php echo $answers_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="answers">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $answers_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($answers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($answers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $answers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($answers_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($answers_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($answers_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($answers_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $answers_list->showPageHeader(); ?>
<?php
$answers_list->showMessage();
?>
<?php if ($answers_list->TotalRecords > 0 || $answers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($answers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> answers">
<?php if (!$answers_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$answers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $answers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $answers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fanswerslist" id="fanswerslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="answers">
<?php if ($answers->getCurrentMasterTable() == "questions" && $answers->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="questions">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($answers_list->question_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($answers->getCurrentMasterTable() == "assessments" && $answers->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="assessments">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($answers_list->assessment_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_answers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($answers_list->TotalRecords > 0 || $answers_list->isGridEdit()) { ?>
<table id="tbl_answerslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$answers->RowType = ROWTYPE_HEADER;

// Render list options
$answers_list->renderListOptions();

// Render list options (header, left)
$answers_list->ListOptions->render("header", "left");
?>
<?php if ($answers_list->id->Visible) { // id ?>
	<?php if ($answers_list->SortUrl($answers_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $answers_list->id->headerCellClass() ?>"><div id="elh_answers_id" class="answers_id"><div class="ew-table-header-caption"><?php echo $answers_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $answers_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $answers_list->SortUrl($answers_list->id) ?>', 1);"><div id="elh_answers_id" class="answers_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_list->question_id->Visible) { // question_id ?>
	<?php if ($answers_list->SortUrl($answers_list->question_id) == "") { ?>
		<th data-name="question_id" class="<?php echo $answers_list->question_id->headerCellClass() ?>"><div id="elh_answers_question_id" class="answers_question_id"><div class="ew-table-header-caption"><?php echo $answers_list->question_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_id" class="<?php echo $answers_list->question_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $answers_list->SortUrl($answers_list->question_id) ?>', 1);"><div id="elh_answers_question_id" class="answers_question_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_list->question_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_list->question_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_list->question_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_list->assessment_id->Visible) { // assessment_id ?>
	<?php if ($answers_list->SortUrl($answers_list->assessment_id) == "") { ?>
		<th data-name="assessment_id" class="<?php echo $answers_list->assessment_id->headerCellClass() ?>"><div id="elh_answers_assessment_id" class="answers_assessment_id"><div class="ew-table-header-caption"><?php echo $answers_list->assessment_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_id" class="<?php echo $answers_list->assessment_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $answers_list->SortUrl($answers_list->assessment_id) ?>', 1);"><div id="elh_answers_assessment_id" class="answers_assessment_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_list->assessment_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_list->assessment_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_list->assessment_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_list->section_id->Visible) { // section_id ?>
	<?php if ($answers_list->SortUrl($answers_list->section_id) == "") { ?>
		<th data-name="section_id" class="<?php echo $answers_list->section_id->headerCellClass() ?>"><div id="elh_answers_section_id" class="answers_section_id"><div class="ew-table-header-caption"><?php echo $answers_list->section_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="section_id" class="<?php echo $answers_list->section_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $answers_list->SortUrl($answers_list->section_id) ?>', 1);"><div id="elh_answers_section_id" class="answers_section_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_list->section_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_list->section_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_list->section_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_list->_response->Visible) { // response ?>
	<?php if ($answers_list->SortUrl($answers_list->_response) == "") { ?>
		<th data-name="_response" class="<?php echo $answers_list->_response->headerCellClass() ?>"><div id="elh_answers__response" class="answers__response"><div class="ew-table-header-caption"><?php echo $answers_list->_response->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_response" class="<?php echo $answers_list->_response->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $answers_list->SortUrl($answers_list->_response) ?>', 1);"><div id="elh_answers__response" class="answers__response">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_list->_response->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($answers_list->_response->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_list->_response->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_list->score->Visible) { // score ?>
	<?php if ($answers_list->SortUrl($answers_list->score) == "") { ?>
		<th data-name="score" class="<?php echo $answers_list->score->headerCellClass() ?>"><div id="elh_answers_score" class="answers_score"><div class="ew-table-header-caption"><?php echo $answers_list->score->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="score" class="<?php echo $answers_list->score->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $answers_list->SortUrl($answers_list->score) ?>', 1);"><div id="elh_answers_score" class="answers_score">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_list->score->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_list->score->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_list->score->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_list->created_at->Visible) { // created_at ?>
	<?php if ($answers_list->SortUrl($answers_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $answers_list->created_at->headerCellClass() ?>"><div id="elh_answers_created_at" class="answers_created_at"><div class="ew-table-header-caption"><?php echo $answers_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $answers_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $answers_list->SortUrl($answers_list->created_at) ?>', 1);"><div id="elh_answers_created_at" class="answers_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_list->updated_at->Visible) { // updated_at ?>
	<?php if ($answers_list->SortUrl($answers_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $answers_list->updated_at->headerCellClass() ?>"><div id="elh_answers_updated_at" class="answers_updated_at"><div class="ew-table-header-caption"><?php echo $answers_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $answers_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $answers_list->SortUrl($answers_list->updated_at) ?>', 1);"><div id="elh_answers_updated_at" class="answers_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$answers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($answers_list->ExportAll && $answers_list->isExport()) {
	$answers_list->StopRecord = $answers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($answers_list->TotalRecords > $answers_list->StartRecord + $answers_list->DisplayRecords - 1)
		$answers_list->StopRecord = $answers_list->StartRecord + $answers_list->DisplayRecords - 1;
	else
		$answers_list->StopRecord = $answers_list->TotalRecords;
}
$answers_list->RecordCount = $answers_list->StartRecord - 1;
if ($answers_list->Recordset && !$answers_list->Recordset->EOF) {
	$answers_list->Recordset->moveFirst();
	$selectLimit = $answers_list->UseSelectLimit;
	if (!$selectLimit && $answers_list->StartRecord > 1)
		$answers_list->Recordset->move($answers_list->StartRecord - 1);
} elseif (!$answers->AllowAddDeleteRow && $answers_list->StopRecord == 0) {
	$answers_list->StopRecord = $answers->GridAddRowCount;
}

// Initialize aggregate
$answers->RowType = ROWTYPE_AGGREGATEINIT;
$answers->resetAttributes();
$answers_list->renderRow();
while ($answers_list->RecordCount < $answers_list->StopRecord) {
	$answers_list->RecordCount++;
	if ($answers_list->RecordCount >= $answers_list->StartRecord) {
		$answers_list->RowCount++;

		// Set up key count
		$answers_list->KeyCount = $answers_list->RowIndex;

		// Init row class and style
		$answers->resetAttributes();
		$answers->CssClass = "";
		if ($answers_list->isGridAdd()) {
		} else {
			$answers_list->loadRowValues($answers_list->Recordset); // Load row values
		}
		$answers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$answers->RowAttrs->merge(["data-rowindex" => $answers_list->RowCount, "id" => "r" . $answers_list->RowCount . "_answers", "data-rowtype" => $answers->RowType]);

		// Render row
		$answers_list->renderRow();

		// Render list options
		$answers_list->renderListOptions();
?>
	<tr <?php echo $answers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$answers_list->ListOptions->render("body", "left", $answers_list->RowCount);
?>
	<?php if ($answers_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $answers_list->id->cellAttributes() ?>>
<span id="el<?php echo $answers_list->RowCount ?>_answers_id">
<span<?php echo $answers_list->id->viewAttributes() ?>><?php echo $answers_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($answers_list->question_id->Visible) { // question_id ?>
		<td data-name="question_id" <?php echo $answers_list->question_id->cellAttributes() ?>>
<span id="el<?php echo $answers_list->RowCount ?>_answers_question_id">
<span<?php echo $answers_list->question_id->viewAttributes() ?>><?php echo $answers_list->question_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($answers_list->assessment_id->Visible) { // assessment_id ?>
		<td data-name="assessment_id" <?php echo $answers_list->assessment_id->cellAttributes() ?>>
<span id="el<?php echo $answers_list->RowCount ?>_answers_assessment_id">
<span<?php echo $answers_list->assessment_id->viewAttributes() ?>><?php echo $answers_list->assessment_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($answers_list->section_id->Visible) { // section_id ?>
		<td data-name="section_id" <?php echo $answers_list->section_id->cellAttributes() ?>>
<span id="el<?php echo $answers_list->RowCount ?>_answers_section_id">
<span<?php echo $answers_list->section_id->viewAttributes() ?>><?php echo $answers_list->section_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($answers_list->_response->Visible) { // response ?>
		<td data-name="_response" <?php echo $answers_list->_response->cellAttributes() ?>>
<span id="el<?php echo $answers_list->RowCount ?>_answers__response">
<span<?php echo $answers_list->_response->viewAttributes() ?>><?php echo $answers_list->_response->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($answers_list->score->Visible) { // score ?>
		<td data-name="score" <?php echo $answers_list->score->cellAttributes() ?>>
<span id="el<?php echo $answers_list->RowCount ?>_answers_score">
<span<?php echo $answers_list->score->viewAttributes() ?>><?php echo $answers_list->score->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($answers_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $answers_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $answers_list->RowCount ?>_answers_created_at">
<span<?php echo $answers_list->created_at->viewAttributes() ?>><?php echo $answers_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($answers_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $answers_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $answers_list->RowCount ?>_answers_updated_at">
<span<?php echo $answers_list->updated_at->viewAttributes() ?>><?php echo $answers_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$answers_list->ListOptions->render("body", "right", $answers_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$answers_list->isGridAdd())
		$answers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$answers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($answers_list->Recordset)
	$answers_list->Recordset->Close();
?>
<?php if (!$answers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$answers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $answers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $answers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($answers_list->TotalRecords == 0 && !$answers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $answers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$answers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$answers_list->isExport()) { ?>
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
$answers_list->terminate();
?>
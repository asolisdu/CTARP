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
$results_list = new results_list();

// Run the page
$results_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$results_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$results_list->isExport()) { ?>
<script>
var fresultslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fresultslist = currentForm = new ew.Form("fresultslist", "list");
	fresultslist.formKeyCountName = '<?php echo $results_list->FormKeyCountName ?>';
	loadjs.done("fresultslist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$results_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($results_list->TotalRecords > 0 && $results_list->ExportOptions->visible()) { ?>
<?php $results_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($results_list->ImportOptions->visible()) { ?>
<?php $results_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$results_list->isExport() || Config("EXPORT_MASTER_RECORD") && $results_list->isExport("print")) { ?>
<?php
if ($results_list->DbMasterFilter != "" && $results->getCurrentMasterTable() == "assessments") {
	if ($results_list->MasterRecordExists) {
		include_once "assessmentsmaster.php";
	}
}
?>
<?php } ?>
<?php
$results_list->renderOtherOptions();
?>
<?php $results_list->showPageHeader(); ?>
<?php
$results_list->showMessage();
?>
<?php if ($results_list->TotalRecords > 0 || $results->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($results_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> results">
<?php if (!$results_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$results_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $results_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $results_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fresultslist" id="fresultslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="results">
<?php if ($results->getCurrentMasterTable() == "assessments" && $results->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="assessments">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($results_list->assessment_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_results" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($results_list->TotalRecords > 0 || $results_list->isGridEdit()) { ?>
<table id="tbl_resultslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$results->RowType = ROWTYPE_HEADER;

// Render list options
$results_list->renderListOptions();

// Render list options (header, left)
$results_list->ListOptions->render("header", "left");
?>
<?php if ($results_list->id->Visible) { // id ?>
	<?php if ($results_list->SortUrl($results_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $results_list->id->headerCellClass() ?>"><div id="elh_results_id" class="results_id"><div class="ew-table-header-caption"><?php echo $results_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $results_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $results_list->SortUrl($results_list->id) ?>', 1);"><div id="elh_results_id" class="results_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $results_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($results_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($results_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($results_list->assessment_id->Visible) { // assessment_id ?>
	<?php if ($results_list->SortUrl($results_list->assessment_id) == "") { ?>
		<th data-name="assessment_id" class="<?php echo $results_list->assessment_id->headerCellClass() ?>"><div id="elh_results_assessment_id" class="results_assessment_id"><div class="ew-table-header-caption"><?php echo $results_list->assessment_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_id" class="<?php echo $results_list->assessment_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $results_list->SortUrl($results_list->assessment_id) ?>', 1);"><div id="elh_results_assessment_id" class="results_assessment_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $results_list->assessment_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($results_list->assessment_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($results_list->assessment_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($results_list->created_at->Visible) { // created_at ?>
	<?php if ($results_list->SortUrl($results_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $results_list->created_at->headerCellClass() ?>"><div id="elh_results_created_at" class="results_created_at"><div class="ew-table-header-caption"><?php echo $results_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $results_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $results_list->SortUrl($results_list->created_at) ?>', 1);"><div id="elh_results_created_at" class="results_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $results_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($results_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($results_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($results_list->updated_at->Visible) { // updated_at ?>
	<?php if ($results_list->SortUrl($results_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $results_list->updated_at->headerCellClass() ?>"><div id="elh_results_updated_at" class="results_updated_at"><div class="ew-table-header-caption"><?php echo $results_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $results_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $results_list->SortUrl($results_list->updated_at) ?>', 1);"><div id="elh_results_updated_at" class="results_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $results_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($results_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($results_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$results_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($results_list->ExportAll && $results_list->isExport()) {
	$results_list->StopRecord = $results_list->TotalRecords;
} else {

	// Set the last record to display
	if ($results_list->TotalRecords > $results_list->StartRecord + $results_list->DisplayRecords - 1)
		$results_list->StopRecord = $results_list->StartRecord + $results_list->DisplayRecords - 1;
	else
		$results_list->StopRecord = $results_list->TotalRecords;
}
$results_list->RecordCount = $results_list->StartRecord - 1;
if ($results_list->Recordset && !$results_list->Recordset->EOF) {
	$results_list->Recordset->moveFirst();
	$selectLimit = $results_list->UseSelectLimit;
	if (!$selectLimit && $results_list->StartRecord > 1)
		$results_list->Recordset->move($results_list->StartRecord - 1);
} elseif (!$results->AllowAddDeleteRow && $results_list->StopRecord == 0) {
	$results_list->StopRecord = $results->GridAddRowCount;
}

// Initialize aggregate
$results->RowType = ROWTYPE_AGGREGATEINIT;
$results->resetAttributes();
$results_list->renderRow();
while ($results_list->RecordCount < $results_list->StopRecord) {
	$results_list->RecordCount++;
	if ($results_list->RecordCount >= $results_list->StartRecord) {
		$results_list->RowCount++;

		// Set up key count
		$results_list->KeyCount = $results_list->RowIndex;

		// Init row class and style
		$results->resetAttributes();
		$results->CssClass = "";
		if ($results_list->isGridAdd()) {
		} else {
			$results_list->loadRowValues($results_list->Recordset); // Load row values
		}
		$results->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$results->RowAttrs->merge(["data-rowindex" => $results_list->RowCount, "id" => "r" . $results_list->RowCount . "_results", "data-rowtype" => $results->RowType]);

		// Render row
		$results_list->renderRow();

		// Render list options
		$results_list->renderListOptions();
?>
	<tr <?php echo $results->rowAttributes() ?>>
<?php

// Render list options (body, left)
$results_list->ListOptions->render("body", "left", $results_list->RowCount);
?>
	<?php if ($results_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $results_list->id->cellAttributes() ?>>
<span id="el<?php echo $results_list->RowCount ?>_results_id">
<span<?php echo $results_list->id->viewAttributes() ?>><?php echo $results_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($results_list->assessment_id->Visible) { // assessment_id ?>
		<td data-name="assessment_id" <?php echo $results_list->assessment_id->cellAttributes() ?>>
<span id="el<?php echo $results_list->RowCount ?>_results_assessment_id">
<span<?php echo $results_list->assessment_id->viewAttributes() ?>><?php echo $results_list->assessment_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($results_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $results_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $results_list->RowCount ?>_results_created_at">
<span<?php echo $results_list->created_at->viewAttributes() ?>><?php echo $results_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($results_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $results_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $results_list->RowCount ?>_results_updated_at">
<span<?php echo $results_list->updated_at->viewAttributes() ?>><?php echo $results_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$results_list->ListOptions->render("body", "right", $results_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$results_list->isGridAdd())
		$results_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$results->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($results_list->Recordset)
	$results_list->Recordset->Close();
?>
<?php if (!$results_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$results_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $results_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $results_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($results_list->TotalRecords == 0 && !$results->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $results_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$results_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$results_list->isExport()) { ?>
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
$results_list->terminate();
?>
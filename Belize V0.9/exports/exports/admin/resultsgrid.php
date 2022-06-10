<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($results_grid))
	$results_grid = new results_grid();

// Run the page
$results_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$results_grid->Page_Render();
?>
<?php if (!$results_grid->isExport()) { ?>
<script>
var fresultsgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fresultsgrid = new ew.Form("fresultsgrid", "grid");
	fresultsgrid.formKeyCountName = '<?php echo $results_grid->FormKeyCountName ?>';

	// Validate form
	fresultsgrid.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($results_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $results_grid->id->caption(), $results_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($results_grid->assessment_id->Required) { ?>
				elm = this.getElements("x" + infix + "_assessment_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $results_grid->assessment_id->caption(), $results_grid->assessment_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_assessment_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($results_grid->assessment_id->errorMessage()) ?>");
			<?php if ($results_grid->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $results_grid->created_at->caption(), $results_grid->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($results_grid->created_at->errorMessage()) ?>");
			<?php if ($results_grid->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $results_grid->updated_at->caption(), $results_grid->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($results_grid->updated_at->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fresultsgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "assessment_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "created_at", false)) return false;
		if (ew.valueChanged(fobj, infix, "updated_at", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fresultsgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fresultsgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fresultsgrid.lists["x_assessment_id"] = <?php echo $results_grid->assessment_id->Lookup->toClientList($results_grid) ?>;
	fresultsgrid.lists["x_assessment_id"].options = <?php echo JsonEncode($results_grid->assessment_id->lookupOptions()) ?>;
	fresultsgrid.autoSuggests["x_assessment_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fresultsgrid");
});
</script>
<?php } ?>
<?php
$results_grid->renderOtherOptions();
?>
<?php if ($results_grid->TotalRecords > 0 || $results->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($results_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> results">
<?php if ($results_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $results_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fresultsgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_results" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_resultsgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$results->RowType = ROWTYPE_HEADER;

// Render list options
$results_grid->renderListOptions();

// Render list options (header, left)
$results_grid->ListOptions->render("header", "left");
?>
<?php if ($results_grid->id->Visible) { // id ?>
	<?php if ($results_grid->SortUrl($results_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $results_grid->id->headerCellClass() ?>"><div id="elh_results_id" class="results_id"><div class="ew-table-header-caption"><?php echo $results_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $results_grid->id->headerCellClass() ?>"><div><div id="elh_results_id" class="results_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $results_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($results_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($results_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($results_grid->assessment_id->Visible) { // assessment_id ?>
	<?php if ($results_grid->SortUrl($results_grid->assessment_id) == "") { ?>
		<th data-name="assessment_id" class="<?php echo $results_grid->assessment_id->headerCellClass() ?>"><div id="elh_results_assessment_id" class="results_assessment_id"><div class="ew-table-header-caption"><?php echo $results_grid->assessment_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_id" class="<?php echo $results_grid->assessment_id->headerCellClass() ?>"><div><div id="elh_results_assessment_id" class="results_assessment_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $results_grid->assessment_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($results_grid->assessment_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($results_grid->assessment_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($results_grid->created_at->Visible) { // created_at ?>
	<?php if ($results_grid->SortUrl($results_grid->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $results_grid->created_at->headerCellClass() ?>"><div id="elh_results_created_at" class="results_created_at"><div class="ew-table-header-caption"><?php echo $results_grid->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $results_grid->created_at->headerCellClass() ?>"><div><div id="elh_results_created_at" class="results_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $results_grid->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($results_grid->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($results_grid->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($results_grid->updated_at->Visible) { // updated_at ?>
	<?php if ($results_grid->SortUrl($results_grid->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $results_grid->updated_at->headerCellClass() ?>"><div id="elh_results_updated_at" class="results_updated_at"><div class="ew-table-header-caption"><?php echo $results_grid->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $results_grid->updated_at->headerCellClass() ?>"><div><div id="elh_results_updated_at" class="results_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $results_grid->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($results_grid->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($results_grid->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$results_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$results_grid->StartRecord = 1;
$results_grid->StopRecord = $results_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($results->isConfirm() || $results_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($results_grid->FormKeyCountName) && ($results_grid->isGridAdd() || $results_grid->isGridEdit() || $results->isConfirm())) {
		$results_grid->KeyCount = $CurrentForm->getValue($results_grid->FormKeyCountName);
		$results_grid->StopRecord = $results_grid->StartRecord + $results_grid->KeyCount - 1;
	}
}
$results_grid->RecordCount = $results_grid->StartRecord - 1;
if ($results_grid->Recordset && !$results_grid->Recordset->EOF) {
	$results_grid->Recordset->moveFirst();
	$selectLimit = $results_grid->UseSelectLimit;
	if (!$selectLimit && $results_grid->StartRecord > 1)
		$results_grid->Recordset->move($results_grid->StartRecord - 1);
} elseif (!$results->AllowAddDeleteRow && $results_grid->StopRecord == 0) {
	$results_grid->StopRecord = $results->GridAddRowCount;
}

// Initialize aggregate
$results->RowType = ROWTYPE_AGGREGATEINIT;
$results->resetAttributes();
$results_grid->renderRow();
if ($results_grid->isGridAdd())
	$results_grid->RowIndex = 0;
if ($results_grid->isGridEdit())
	$results_grid->RowIndex = 0;
while ($results_grid->RecordCount < $results_grid->StopRecord) {
	$results_grid->RecordCount++;
	if ($results_grid->RecordCount >= $results_grid->StartRecord) {
		$results_grid->RowCount++;
		if ($results_grid->isGridAdd() || $results_grid->isGridEdit() || $results->isConfirm()) {
			$results_grid->RowIndex++;
			$CurrentForm->Index = $results_grid->RowIndex;
			if ($CurrentForm->hasValue($results_grid->FormActionName) && ($results->isConfirm() || $results_grid->EventCancelled))
				$results_grid->RowAction = strval($CurrentForm->getValue($results_grid->FormActionName));
			elseif ($results_grid->isGridAdd())
				$results_grid->RowAction = "insert";
			else
				$results_grid->RowAction = "";
		}

		// Set up key count
		$results_grid->KeyCount = $results_grid->RowIndex;

		// Init row class and style
		$results->resetAttributes();
		$results->CssClass = "";
		if ($results_grid->isGridAdd()) {
			if ($results->CurrentMode == "copy") {
				$results_grid->loadRowValues($results_grid->Recordset); // Load row values
				$results_grid->setRecordKey($results_grid->RowOldKey, $results_grid->Recordset); // Set old record key
			} else {
				$results_grid->loadRowValues(); // Load default values
				$results_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$results_grid->loadRowValues($results_grid->Recordset); // Load row values
		}
		$results->RowType = ROWTYPE_VIEW; // Render view
		if ($results_grid->isGridAdd()) // Grid add
			$results->RowType = ROWTYPE_ADD; // Render add
		if ($results_grid->isGridAdd() && $results->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$results_grid->restoreCurrentRowFormValues($results_grid->RowIndex); // Restore form values
		if ($results_grid->isGridEdit()) { // Grid edit
			if ($results->EventCancelled)
				$results_grid->restoreCurrentRowFormValues($results_grid->RowIndex); // Restore form values
			if ($results_grid->RowAction == "insert")
				$results->RowType = ROWTYPE_ADD; // Render add
			else
				$results->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($results_grid->isGridEdit() && ($results->RowType == ROWTYPE_EDIT || $results->RowType == ROWTYPE_ADD) && $results->EventCancelled) // Update failed
			$results_grid->restoreCurrentRowFormValues($results_grid->RowIndex); // Restore form values
		if ($results->RowType == ROWTYPE_EDIT) // Edit row
			$results_grid->EditRowCount++;
		if ($results->isConfirm()) // Confirm row
			$results_grid->restoreCurrentRowFormValues($results_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$results->RowAttrs->merge(["data-rowindex" => $results_grid->RowCount, "id" => "r" . $results_grid->RowCount . "_results", "data-rowtype" => $results->RowType]);

		// Render row
		$results_grid->renderRow();

		// Render list options
		$results_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($results_grid->RowAction != "delete" && $results_grid->RowAction != "insertdelete" && !($results_grid->RowAction == "insert" && $results->isConfirm() && $results_grid->emptyRow())) {
?>
	<tr <?php echo $results->rowAttributes() ?>>
<?php

// Render list options (body, left)
$results_grid->ListOptions->render("body", "left", $results_grid->RowCount);
?>
	<?php if ($results_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $results_grid->id->cellAttributes() ?>>
<?php if ($results->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_id" class="form-group"></span>
<input type="hidden" data-table="results" data-field="x_id" name="o<?php echo $results_grid->RowIndex ?>_id" id="o<?php echo $results_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($results_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($results->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_id" class="form-group">
<span<?php echo $results_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($results_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="results" data-field="x_id" name="x<?php echo $results_grid->RowIndex ?>_id" id="x<?php echo $results_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($results_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($results->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_id">
<span<?php echo $results_grid->id->viewAttributes() ?>><?php echo $results_grid->id->getViewValue() ?></span>
</span>
<?php if (!$results->isConfirm()) { ?>
<input type="hidden" data-table="results" data-field="x_id" name="x<?php echo $results_grid->RowIndex ?>_id" id="x<?php echo $results_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($results_grid->id->FormValue) ?>">
<input type="hidden" data-table="results" data-field="x_id" name="o<?php echo $results_grid->RowIndex ?>_id" id="o<?php echo $results_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($results_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="results" data-field="x_id" name="fresultsgrid$x<?php echo $results_grid->RowIndex ?>_id" id="fresultsgrid$x<?php echo $results_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($results_grid->id->FormValue) ?>">
<input type="hidden" data-table="results" data-field="x_id" name="fresultsgrid$o<?php echo $results_grid->RowIndex ?>_id" id="fresultsgrid$o<?php echo $results_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($results_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($results_grid->assessment_id->Visible) { // assessment_id ?>
		<td data-name="assessment_id" <?php echo $results_grid->assessment_id->cellAttributes() ?>>
<?php if ($results->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($results_grid->assessment_id->getSessionValue() != "") { ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_assessment_id" class="form-group">
<span<?php echo $results_grid->assessment_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($results_grid->assessment_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $results_grid->RowIndex ?>_assessment_id" name="x<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_assessment_id" class="form-group">
<?php
$onchange = $results_grid->assessment_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$results_grid->assessment_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $results_grid->RowIndex ?>_assessment_id">
	<input type="text" class="form-control" name="sv_x<?php echo $results_grid->RowIndex ?>_assessment_id" id="sv_x<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo RemoveHtml($results_grid->assessment_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($results_grid->assessment_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($results_grid->assessment_id->getPlaceHolder()) ?>"<?php echo $results_grid->assessment_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="results" data-field="x_assessment_id" data-value-separator="<?php echo $results_grid->assessment_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $results_grid->RowIndex ?>_assessment_id" id="x<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fresultsgrid"], function() {
	fresultsgrid.createAutoSuggest({"id":"x<?php echo $results_grid->RowIndex ?>_assessment_id","forceSelect":false});
});
</script>
<?php echo $results_grid->assessment_id->Lookup->getParamTag($results_grid, "p_x" . $results_grid->RowIndex . "_assessment_id") ?>
</span>
<?php } ?>
<input type="hidden" data-table="results" data-field="x_assessment_id" name="o<?php echo $results_grid->RowIndex ?>_assessment_id" id="o<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->OldValue) ?>">
<?php } ?>
<?php if ($results->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($results_grid->assessment_id->getSessionValue() != "") { ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_assessment_id" class="form-group">
<span<?php echo $results_grid->assessment_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($results_grid->assessment_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $results_grid->RowIndex ?>_assessment_id" name="x<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_assessment_id" class="form-group">
<?php
$onchange = $results_grid->assessment_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$results_grid->assessment_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $results_grid->RowIndex ?>_assessment_id">
	<input type="text" class="form-control" name="sv_x<?php echo $results_grid->RowIndex ?>_assessment_id" id="sv_x<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo RemoveHtml($results_grid->assessment_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($results_grid->assessment_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($results_grid->assessment_id->getPlaceHolder()) ?>"<?php echo $results_grid->assessment_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="results" data-field="x_assessment_id" data-value-separator="<?php echo $results_grid->assessment_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $results_grid->RowIndex ?>_assessment_id" id="x<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fresultsgrid"], function() {
	fresultsgrid.createAutoSuggest({"id":"x<?php echo $results_grid->RowIndex ?>_assessment_id","forceSelect":false});
});
</script>
<?php echo $results_grid->assessment_id->Lookup->getParamTag($results_grid, "p_x" . $results_grid->RowIndex . "_assessment_id") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($results->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_assessment_id">
<span<?php echo $results_grid->assessment_id->viewAttributes() ?>><?php echo $results_grid->assessment_id->getViewValue() ?></span>
</span>
<?php if (!$results->isConfirm()) { ?>
<input type="hidden" data-table="results" data-field="x_assessment_id" name="x<?php echo $results_grid->RowIndex ?>_assessment_id" id="x<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->FormValue) ?>">
<input type="hidden" data-table="results" data-field="x_assessment_id" name="o<?php echo $results_grid->RowIndex ?>_assessment_id" id="o<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="results" data-field="x_assessment_id" name="fresultsgrid$x<?php echo $results_grid->RowIndex ?>_assessment_id" id="fresultsgrid$x<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->FormValue) ?>">
<input type="hidden" data-table="results" data-field="x_assessment_id" name="fresultsgrid$o<?php echo $results_grid->RowIndex ?>_assessment_id" id="fresultsgrid$o<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($results_grid->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $results_grid->created_at->cellAttributes() ?>>
<?php if ($results->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_created_at" class="form-group">
<input type="text" data-table="results" data-field="x_created_at" name="x<?php echo $results_grid->RowIndex ?>_created_at" id="x<?php echo $results_grid->RowIndex ?>_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($results_grid->created_at->getPlaceHolder()) ?>" value="<?php echo $results_grid->created_at->EditValue ?>"<?php echo $results_grid->created_at->editAttributes() ?>>
</span>
<input type="hidden" data-table="results" data-field="x_created_at" name="o<?php echo $results_grid->RowIndex ?>_created_at" id="o<?php echo $results_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($results_grid->created_at->OldValue) ?>">
<?php } ?>
<?php if ($results->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_created_at" class="form-group">
<input type="text" data-table="results" data-field="x_created_at" name="x<?php echo $results_grid->RowIndex ?>_created_at" id="x<?php echo $results_grid->RowIndex ?>_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($results_grid->created_at->getPlaceHolder()) ?>" value="<?php echo $results_grid->created_at->EditValue ?>"<?php echo $results_grid->created_at->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($results->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_created_at">
<span<?php echo $results_grid->created_at->viewAttributes() ?>><?php echo $results_grid->created_at->getViewValue() ?></span>
</span>
<?php if (!$results->isConfirm()) { ?>
<input type="hidden" data-table="results" data-field="x_created_at" name="x<?php echo $results_grid->RowIndex ?>_created_at" id="x<?php echo $results_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($results_grid->created_at->FormValue) ?>">
<input type="hidden" data-table="results" data-field="x_created_at" name="o<?php echo $results_grid->RowIndex ?>_created_at" id="o<?php echo $results_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($results_grid->created_at->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="results" data-field="x_created_at" name="fresultsgrid$x<?php echo $results_grid->RowIndex ?>_created_at" id="fresultsgrid$x<?php echo $results_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($results_grid->created_at->FormValue) ?>">
<input type="hidden" data-table="results" data-field="x_created_at" name="fresultsgrid$o<?php echo $results_grid->RowIndex ?>_created_at" id="fresultsgrid$o<?php echo $results_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($results_grid->created_at->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($results_grid->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $results_grid->updated_at->cellAttributes() ?>>
<?php if ($results->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_updated_at" class="form-group">
<input type="text" data-table="results" data-field="x_updated_at" name="x<?php echo $results_grid->RowIndex ?>_updated_at" id="x<?php echo $results_grid->RowIndex ?>_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($results_grid->updated_at->getPlaceHolder()) ?>" value="<?php echo $results_grid->updated_at->EditValue ?>"<?php echo $results_grid->updated_at->editAttributes() ?>>
</span>
<input type="hidden" data-table="results" data-field="x_updated_at" name="o<?php echo $results_grid->RowIndex ?>_updated_at" id="o<?php echo $results_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($results_grid->updated_at->OldValue) ?>">
<?php } ?>
<?php if ($results->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_updated_at" class="form-group">
<input type="text" data-table="results" data-field="x_updated_at" name="x<?php echo $results_grid->RowIndex ?>_updated_at" id="x<?php echo $results_grid->RowIndex ?>_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($results_grid->updated_at->getPlaceHolder()) ?>" value="<?php echo $results_grid->updated_at->EditValue ?>"<?php echo $results_grid->updated_at->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($results->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $results_grid->RowCount ?>_results_updated_at">
<span<?php echo $results_grid->updated_at->viewAttributes() ?>><?php echo $results_grid->updated_at->getViewValue() ?></span>
</span>
<?php if (!$results->isConfirm()) { ?>
<input type="hidden" data-table="results" data-field="x_updated_at" name="x<?php echo $results_grid->RowIndex ?>_updated_at" id="x<?php echo $results_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($results_grid->updated_at->FormValue) ?>">
<input type="hidden" data-table="results" data-field="x_updated_at" name="o<?php echo $results_grid->RowIndex ?>_updated_at" id="o<?php echo $results_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($results_grid->updated_at->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="results" data-field="x_updated_at" name="fresultsgrid$x<?php echo $results_grid->RowIndex ?>_updated_at" id="fresultsgrid$x<?php echo $results_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($results_grid->updated_at->FormValue) ?>">
<input type="hidden" data-table="results" data-field="x_updated_at" name="fresultsgrid$o<?php echo $results_grid->RowIndex ?>_updated_at" id="fresultsgrid$o<?php echo $results_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($results_grid->updated_at->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$results_grid->ListOptions->render("body", "right", $results_grid->RowCount);
?>
	</tr>
<?php if ($results->RowType == ROWTYPE_ADD || $results->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fresultsgrid", "load"], function() {
	fresultsgrid.updateLists(<?php echo $results_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$results_grid->isGridAdd() || $results->CurrentMode == "copy")
		if (!$results_grid->Recordset->EOF)
			$results_grid->Recordset->moveNext();
}
?>
<?php
	if ($results->CurrentMode == "add" || $results->CurrentMode == "copy" || $results->CurrentMode == "edit") {
		$results_grid->RowIndex = '$rowindex$';
		$results_grid->loadRowValues();

		// Set row properties
		$results->resetAttributes();
		$results->RowAttrs->merge(["data-rowindex" => $results_grid->RowIndex, "id" => "r0_results", "data-rowtype" => ROWTYPE_ADD]);
		$results->RowAttrs->appendClass("ew-template");
		$results->RowType = ROWTYPE_ADD;

		// Render row
		$results_grid->renderRow();

		// Render list options
		$results_grid->renderListOptions();
		$results_grid->StartRowCount = 0;
?>
	<tr <?php echo $results->rowAttributes() ?>>
<?php

// Render list options (body, left)
$results_grid->ListOptions->render("body", "left", $results_grid->RowIndex);
?>
	<?php if ($results_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$results->isConfirm()) { ?>
<span id="el$rowindex$_results_id" class="form-group results_id"></span>
<?php } else { ?>
<span id="el$rowindex$_results_id" class="form-group results_id">
<span<?php echo $results_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($results_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="results" data-field="x_id" name="x<?php echo $results_grid->RowIndex ?>_id" id="x<?php echo $results_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($results_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="results" data-field="x_id" name="o<?php echo $results_grid->RowIndex ?>_id" id="o<?php echo $results_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($results_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($results_grid->assessment_id->Visible) { // assessment_id ?>
		<td data-name="assessment_id">
<?php if (!$results->isConfirm()) { ?>
<?php if ($results_grid->assessment_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_results_assessment_id" class="form-group results_assessment_id">
<span<?php echo $results_grid->assessment_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($results_grid->assessment_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $results_grid->RowIndex ?>_assessment_id" name="x<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_results_assessment_id" class="form-group results_assessment_id">
<?php
$onchange = $results_grid->assessment_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$results_grid->assessment_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $results_grid->RowIndex ?>_assessment_id">
	<input type="text" class="form-control" name="sv_x<?php echo $results_grid->RowIndex ?>_assessment_id" id="sv_x<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo RemoveHtml($results_grid->assessment_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($results_grid->assessment_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($results_grid->assessment_id->getPlaceHolder()) ?>"<?php echo $results_grid->assessment_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="results" data-field="x_assessment_id" data-value-separator="<?php echo $results_grid->assessment_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $results_grid->RowIndex ?>_assessment_id" id="x<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fresultsgrid"], function() {
	fresultsgrid.createAutoSuggest({"id":"x<?php echo $results_grid->RowIndex ?>_assessment_id","forceSelect":false});
});
</script>
<?php echo $results_grid->assessment_id->Lookup->getParamTag($results_grid, "p_x" . $results_grid->RowIndex . "_assessment_id") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_results_assessment_id" class="form-group results_assessment_id">
<span<?php echo $results_grid->assessment_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($results_grid->assessment_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="results" data-field="x_assessment_id" name="x<?php echo $results_grid->RowIndex ?>_assessment_id" id="x<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="results" data-field="x_assessment_id" name="o<?php echo $results_grid->RowIndex ?>_assessment_id" id="o<?php echo $results_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($results_grid->assessment_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($results_grid->created_at->Visible) { // created_at ?>
		<td data-name="created_at">
<?php if (!$results->isConfirm()) { ?>
<span id="el$rowindex$_results_created_at" class="form-group results_created_at">
<input type="text" data-table="results" data-field="x_created_at" name="x<?php echo $results_grid->RowIndex ?>_created_at" id="x<?php echo $results_grid->RowIndex ?>_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($results_grid->created_at->getPlaceHolder()) ?>" value="<?php echo $results_grid->created_at->EditValue ?>"<?php echo $results_grid->created_at->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_results_created_at" class="form-group results_created_at">
<span<?php echo $results_grid->created_at->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($results_grid->created_at->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="results" data-field="x_created_at" name="x<?php echo $results_grid->RowIndex ?>_created_at" id="x<?php echo $results_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($results_grid->created_at->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="results" data-field="x_created_at" name="o<?php echo $results_grid->RowIndex ?>_created_at" id="o<?php echo $results_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($results_grid->created_at->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($results_grid->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at">
<?php if (!$results->isConfirm()) { ?>
<span id="el$rowindex$_results_updated_at" class="form-group results_updated_at">
<input type="text" data-table="results" data-field="x_updated_at" name="x<?php echo $results_grid->RowIndex ?>_updated_at" id="x<?php echo $results_grid->RowIndex ?>_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($results_grid->updated_at->getPlaceHolder()) ?>" value="<?php echo $results_grid->updated_at->EditValue ?>"<?php echo $results_grid->updated_at->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_results_updated_at" class="form-group results_updated_at">
<span<?php echo $results_grid->updated_at->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($results_grid->updated_at->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="results" data-field="x_updated_at" name="x<?php echo $results_grid->RowIndex ?>_updated_at" id="x<?php echo $results_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($results_grid->updated_at->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="results" data-field="x_updated_at" name="o<?php echo $results_grid->RowIndex ?>_updated_at" id="o<?php echo $results_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($results_grid->updated_at->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$results_grid->ListOptions->render("body", "right", $results_grid->RowIndex);
?>
<script>
loadjs.ready(["fresultsgrid", "load"], function() {
	fresultsgrid.updateLists(<?php echo $results_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($results->CurrentMode == "add" || $results->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $results_grid->FormKeyCountName ?>" id="<?php echo $results_grid->FormKeyCountName ?>" value="<?php echo $results_grid->KeyCount ?>">
<?php echo $results_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($results->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $results_grid->FormKeyCountName ?>" id="<?php echo $results_grid->FormKeyCountName ?>" value="<?php echo $results_grid->KeyCount ?>">
<?php echo $results_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($results->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fresultsgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($results_grid->Recordset)
	$results_grid->Recordset->Close();
?>
<?php if ($results_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $results_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($results_grid->TotalRecords == 0 && !$results->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $results_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$results_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$results_grid->terminate();
?>
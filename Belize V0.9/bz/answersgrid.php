<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($answers_grid))
	$answers_grid = new answers_grid();

// Run the page
$answers_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$answers_grid->Page_Render();
?>
<?php if (!$answers_grid->isExport()) { ?>
<script>
var fanswersgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fanswersgrid = new ew.Form("fanswersgrid", "grid");
	fanswersgrid.formKeyCountName = '<?php echo $answers_grid->FormKeyCountName ?>';

	// Validate form
	fanswersgrid.validate = function() {
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
			<?php if ($answers_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_grid->id->caption(), $answers_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($answers_grid->question_id->Required) { ?>
				elm = this.getElements("x" + infix + "_question_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_grid->question_id->caption(), $answers_grid->question_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_question_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($answers_grid->question_id->errorMessage()) ?>");
			<?php if ($answers_grid->assessment_id->Required) { ?>
				elm = this.getElements("x" + infix + "_assessment_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_grid->assessment_id->caption(), $answers_grid->assessment_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_assessment_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($answers_grid->assessment_id->errorMessage()) ?>");
			<?php if ($answers_grid->section_id->Required) { ?>
				elm = this.getElements("x" + infix + "_section_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_grid->section_id->caption(), $answers_grid->section_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_section_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($answers_grid->section_id->errorMessage()) ?>");
			<?php if ($answers_grid->_response->Required) { ?>
				elm = this.getElements("x" + infix + "__response");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_grid->_response->caption(), $answers_grid->_response->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($answers_grid->score->Required) { ?>
				elm = this.getElements("x" + infix + "_score");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_grid->score->caption(), $answers_grid->score->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_score");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($answers_grid->score->errorMessage()) ?>");
			<?php if ($answers_grid->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_grid->created_at->caption(), $answers_grid->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($answers_grid->created_at->errorMessage()) ?>");
			<?php if ($answers_grid->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answers_grid->updated_at->caption(), $answers_grid->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($answers_grid->updated_at->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fanswersgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "question_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "assessment_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "section_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "_response", false)) return false;
		if (ew.valueChanged(fobj, infix, "score", false)) return false;
		if (ew.valueChanged(fobj, infix, "created_at", false)) return false;
		if (ew.valueChanged(fobj, infix, "updated_at", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fanswersgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fanswersgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fanswersgrid.lists["x_question_id"] = <?php echo $answers_grid->question_id->Lookup->toClientList($answers_grid) ?>;
	fanswersgrid.lists["x_question_id"].options = <?php echo JsonEncode($answers_grid->question_id->lookupOptions()) ?>;
	fanswersgrid.autoSuggests["x_question_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fanswersgrid.lists["x_assessment_id"] = <?php echo $answers_grid->assessment_id->Lookup->toClientList($answers_grid) ?>;
	fanswersgrid.lists["x_assessment_id"].options = <?php echo JsonEncode($answers_grid->assessment_id->lookupOptions()) ?>;
	fanswersgrid.autoSuggests["x_assessment_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fanswersgrid.lists["x_section_id"] = <?php echo $answers_grid->section_id->Lookup->toClientList($answers_grid) ?>;
	fanswersgrid.lists["x_section_id"].options = <?php echo JsonEncode($answers_grid->section_id->lookupOptions()) ?>;
	fanswersgrid.autoSuggests["x_section_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fanswersgrid");
});
</script>
<?php } ?>
<?php
$answers_grid->renderOtherOptions();
?>
<?php if ($answers_grid->TotalRecords > 0 || $answers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($answers_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> answers">
<?php if ($answers_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $answers_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fanswersgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_answers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_answersgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$answers->RowType = ROWTYPE_HEADER;

// Render list options
$answers_grid->renderListOptions();

// Render list options (header, left)
$answers_grid->ListOptions->render("header", "left");
?>
<?php if ($answers_grid->id->Visible) { // id ?>
	<?php if ($answers_grid->SortUrl($answers_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $answers_grid->id->headerCellClass() ?>"><div id="elh_answers_id" class="answers_id"><div class="ew-table-header-caption"><?php echo $answers_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $answers_grid->id->headerCellClass() ?>"><div><div id="elh_answers_id" class="answers_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_grid->question_id->Visible) { // question_id ?>
	<?php if ($answers_grid->SortUrl($answers_grid->question_id) == "") { ?>
		<th data-name="question_id" class="<?php echo $answers_grid->question_id->headerCellClass() ?>"><div id="elh_answers_question_id" class="answers_question_id"><div class="ew-table-header-caption"><?php echo $answers_grid->question_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_id" class="<?php echo $answers_grid->question_id->headerCellClass() ?>"><div><div id="elh_answers_question_id" class="answers_question_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_grid->question_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_grid->question_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_grid->question_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_grid->assessment_id->Visible) { // assessment_id ?>
	<?php if ($answers_grid->SortUrl($answers_grid->assessment_id) == "") { ?>
		<th data-name="assessment_id" class="<?php echo $answers_grid->assessment_id->headerCellClass() ?>"><div id="elh_answers_assessment_id" class="answers_assessment_id"><div class="ew-table-header-caption"><?php echo $answers_grid->assessment_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="assessment_id" class="<?php echo $answers_grid->assessment_id->headerCellClass() ?>"><div><div id="elh_answers_assessment_id" class="answers_assessment_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_grid->assessment_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_grid->assessment_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_grid->assessment_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_grid->section_id->Visible) { // section_id ?>
	<?php if ($answers_grid->SortUrl($answers_grid->section_id) == "") { ?>
		<th data-name="section_id" class="<?php echo $answers_grid->section_id->headerCellClass() ?>"><div id="elh_answers_section_id" class="answers_section_id"><div class="ew-table-header-caption"><?php echo $answers_grid->section_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="section_id" class="<?php echo $answers_grid->section_id->headerCellClass() ?>"><div><div id="elh_answers_section_id" class="answers_section_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_grid->section_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_grid->section_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_grid->section_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_grid->_response->Visible) { // response ?>
	<?php if ($answers_grid->SortUrl($answers_grid->_response) == "") { ?>
		<th data-name="_response" class="<?php echo $answers_grid->_response->headerCellClass() ?>"><div id="elh_answers__response" class="answers__response"><div class="ew-table-header-caption"><?php echo $answers_grid->_response->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_response" class="<?php echo $answers_grid->_response->headerCellClass() ?>"><div><div id="elh_answers__response" class="answers__response">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_grid->_response->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_grid->_response->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_grid->_response->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_grid->score->Visible) { // score ?>
	<?php if ($answers_grid->SortUrl($answers_grid->score) == "") { ?>
		<th data-name="score" class="<?php echo $answers_grid->score->headerCellClass() ?>"><div id="elh_answers_score" class="answers_score"><div class="ew-table-header-caption"><?php echo $answers_grid->score->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="score" class="<?php echo $answers_grid->score->headerCellClass() ?>"><div><div id="elh_answers_score" class="answers_score">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_grid->score->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_grid->score->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_grid->score->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_grid->created_at->Visible) { // created_at ?>
	<?php if ($answers_grid->SortUrl($answers_grid->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $answers_grid->created_at->headerCellClass() ?>"><div id="elh_answers_created_at" class="answers_created_at"><div class="ew-table-header-caption"><?php echo $answers_grid->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $answers_grid->created_at->headerCellClass() ?>"><div><div id="elh_answers_created_at" class="answers_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_grid->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_grid->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_grid->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answers_grid->updated_at->Visible) { // updated_at ?>
	<?php if ($answers_grid->SortUrl($answers_grid->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $answers_grid->updated_at->headerCellClass() ?>"><div id="elh_answers_updated_at" class="answers_updated_at"><div class="ew-table-header-caption"><?php echo $answers_grid->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $answers_grid->updated_at->headerCellClass() ?>"><div><div id="elh_answers_updated_at" class="answers_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answers_grid->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($answers_grid->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($answers_grid->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$answers_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$answers_grid->StartRecord = 1;
$answers_grid->StopRecord = $answers_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($answers->isConfirm() || $answers_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($answers_grid->FormKeyCountName) && ($answers_grid->isGridAdd() || $answers_grid->isGridEdit() || $answers->isConfirm())) {
		$answers_grid->KeyCount = $CurrentForm->getValue($answers_grid->FormKeyCountName);
		$answers_grid->StopRecord = $answers_grid->StartRecord + $answers_grid->KeyCount - 1;
	}
}
$answers_grid->RecordCount = $answers_grid->StartRecord - 1;
if ($answers_grid->Recordset && !$answers_grid->Recordset->EOF) {
	$answers_grid->Recordset->moveFirst();
	$selectLimit = $answers_grid->UseSelectLimit;
	if (!$selectLimit && $answers_grid->StartRecord > 1)
		$answers_grid->Recordset->move($answers_grid->StartRecord - 1);
} elseif (!$answers->AllowAddDeleteRow && $answers_grid->StopRecord == 0) {
	$answers_grid->StopRecord = $answers->GridAddRowCount;
}

// Initialize aggregate
$answers->RowType = ROWTYPE_AGGREGATEINIT;
$answers->resetAttributes();
$answers_grid->renderRow();
if ($answers_grid->isGridAdd())
	$answers_grid->RowIndex = 0;
if ($answers_grid->isGridEdit())
	$answers_grid->RowIndex = 0;
while ($answers_grid->RecordCount < $answers_grid->StopRecord) {
	$answers_grid->RecordCount++;
	if ($answers_grid->RecordCount >= $answers_grid->StartRecord) {
		$answers_grid->RowCount++;
		if ($answers_grid->isGridAdd() || $answers_grid->isGridEdit() || $answers->isConfirm()) {
			$answers_grid->RowIndex++;
			$CurrentForm->Index = $answers_grid->RowIndex;
			if ($CurrentForm->hasValue($answers_grid->FormActionName) && ($answers->isConfirm() || $answers_grid->EventCancelled))
				$answers_grid->RowAction = strval($CurrentForm->getValue($answers_grid->FormActionName));
			elseif ($answers_grid->isGridAdd())
				$answers_grid->RowAction = "insert";
			else
				$answers_grid->RowAction = "";
		}

		// Set up key count
		$answers_grid->KeyCount = $answers_grid->RowIndex;

		// Init row class and style
		$answers->resetAttributes();
		$answers->CssClass = "";
		if ($answers_grid->isGridAdd()) {
			if ($answers->CurrentMode == "copy") {
				$answers_grid->loadRowValues($answers_grid->Recordset); // Load row values
				$answers_grid->setRecordKey($answers_grid->RowOldKey, $answers_grid->Recordset); // Set old record key
			} else {
				$answers_grid->loadRowValues(); // Load default values
				$answers_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$answers_grid->loadRowValues($answers_grid->Recordset); // Load row values
		}
		$answers->RowType = ROWTYPE_VIEW; // Render view
		if ($answers_grid->isGridAdd()) // Grid add
			$answers->RowType = ROWTYPE_ADD; // Render add
		if ($answers_grid->isGridAdd() && $answers->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$answers_grid->restoreCurrentRowFormValues($answers_grid->RowIndex); // Restore form values
		if ($answers_grid->isGridEdit()) { // Grid edit
			if ($answers->EventCancelled)
				$answers_grid->restoreCurrentRowFormValues($answers_grid->RowIndex); // Restore form values
			if ($answers_grid->RowAction == "insert")
				$answers->RowType = ROWTYPE_ADD; // Render add
			else
				$answers->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($answers_grid->isGridEdit() && ($answers->RowType == ROWTYPE_EDIT || $answers->RowType == ROWTYPE_ADD) && $answers->EventCancelled) // Update failed
			$answers_grid->restoreCurrentRowFormValues($answers_grid->RowIndex); // Restore form values
		if ($answers->RowType == ROWTYPE_EDIT) // Edit row
			$answers_grid->EditRowCount++;
		if ($answers->isConfirm()) // Confirm row
			$answers_grid->restoreCurrentRowFormValues($answers_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$answers->RowAttrs->merge(["data-rowindex" => $answers_grid->RowCount, "id" => "r" . $answers_grid->RowCount . "_answers", "data-rowtype" => $answers->RowType]);

		// Render row
		$answers_grid->renderRow();

		// Render list options
		$answers_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($answers_grid->RowAction != "delete" && $answers_grid->RowAction != "insertdelete" && !($answers_grid->RowAction == "insert" && $answers->isConfirm() && $answers_grid->emptyRow())) {
?>
	<tr <?php echo $answers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$answers_grid->ListOptions->render("body", "left", $answers_grid->RowCount);
?>
	<?php if ($answers_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $answers_grid->id->cellAttributes() ?>>
<?php if ($answers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_id" class="form-group"></span>
<input type="hidden" data-table="answers" data-field="x_id" name="o<?php echo $answers_grid->RowIndex ?>_id" id="o<?php echo $answers_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($answers_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_id" class="form-group">
<span<?php echo $answers_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="answers" data-field="x_id" name="x<?php echo $answers_grid->RowIndex ?>_id" id="x<?php echo $answers_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($answers_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_id">
<span<?php echo $answers_grid->id->viewAttributes() ?>><?php echo $answers_grid->id->getViewValue() ?></span>
</span>
<?php if (!$answers->isConfirm()) { ?>
<input type="hidden" data-table="answers" data-field="x_id" name="x<?php echo $answers_grid->RowIndex ?>_id" id="x<?php echo $answers_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($answers_grid->id->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_id" name="o<?php echo $answers_grid->RowIndex ?>_id" id="o<?php echo $answers_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($answers_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="answers" data-field="x_id" name="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_id" id="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($answers_grid->id->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_id" name="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_id" id="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($answers_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($answers_grid->question_id->Visible) { // question_id ?>
		<td data-name="question_id" <?php echo $answers_grid->question_id->cellAttributes() ?>>
<?php if ($answers->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($answers_grid->question_id->getSessionValue() != "") { ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_question_id" class="form-group">
<span<?php echo $answers_grid->question_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->question_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $answers_grid->RowIndex ?>_question_id" name="x<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_question_id" class="form-group">
<?php
$onchange = $answers_grid->question_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$answers_grid->question_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $answers_grid->RowIndex ?>_question_id">
	<input type="text" class="form-control" name="sv_x<?php echo $answers_grid->RowIndex ?>_question_id" id="sv_x<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo RemoveHtml($answers_grid->question_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($answers_grid->question_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($answers_grid->question_id->getPlaceHolder()) ?>"<?php echo $answers_grid->question_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_question_id" data-value-separator="<?php echo $answers_grid->question_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $answers_grid->RowIndex ?>_question_id" id="x<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fanswersgrid"], function() {
	fanswersgrid.createAutoSuggest({"id":"x<?php echo $answers_grid->RowIndex ?>_question_id","forceSelect":false});
});
</script>
<?php echo $answers_grid->question_id->Lookup->getParamTag($answers_grid, "p_x" . $answers_grid->RowIndex . "_question_id") ?>
</span>
<?php } ?>
<input type="hidden" data-table="answers" data-field="x_question_id" name="o<?php echo $answers_grid->RowIndex ?>_question_id" id="o<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->OldValue) ?>">
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($answers_grid->question_id->getSessionValue() != "") { ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_question_id" class="form-group">
<span<?php echo $answers_grid->question_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->question_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $answers_grid->RowIndex ?>_question_id" name="x<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_question_id" class="form-group">
<?php
$onchange = $answers_grid->question_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$answers_grid->question_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $answers_grid->RowIndex ?>_question_id">
	<input type="text" class="form-control" name="sv_x<?php echo $answers_grid->RowIndex ?>_question_id" id="sv_x<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo RemoveHtml($answers_grid->question_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($answers_grid->question_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($answers_grid->question_id->getPlaceHolder()) ?>"<?php echo $answers_grid->question_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_question_id" data-value-separator="<?php echo $answers_grid->question_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $answers_grid->RowIndex ?>_question_id" id="x<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fanswersgrid"], function() {
	fanswersgrid.createAutoSuggest({"id":"x<?php echo $answers_grid->RowIndex ?>_question_id","forceSelect":false});
});
</script>
<?php echo $answers_grid->question_id->Lookup->getParamTag($answers_grid, "p_x" . $answers_grid->RowIndex . "_question_id") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_question_id">
<span<?php echo $answers_grid->question_id->viewAttributes() ?>><?php echo $answers_grid->question_id->getViewValue() ?></span>
</span>
<?php if (!$answers->isConfirm()) { ?>
<input type="hidden" data-table="answers" data-field="x_question_id" name="x<?php echo $answers_grid->RowIndex ?>_question_id" id="x<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_question_id" name="o<?php echo $answers_grid->RowIndex ?>_question_id" id="o<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="answers" data-field="x_question_id" name="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_question_id" id="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_question_id" name="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_question_id" id="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($answers_grid->assessment_id->Visible) { // assessment_id ?>
		<td data-name="assessment_id" <?php echo $answers_grid->assessment_id->cellAttributes() ?>>
<?php if ($answers->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($answers_grid->assessment_id->getSessionValue() != "") { ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_assessment_id" class="form-group">
<span<?php echo $answers_grid->assessment_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->assessment_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $answers_grid->RowIndex ?>_assessment_id" name="x<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_assessment_id" class="form-group">
<?php
$onchange = $answers_grid->assessment_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$answers_grid->assessment_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $answers_grid->RowIndex ?>_assessment_id">
	<input type="text" class="form-control" name="sv_x<?php echo $answers_grid->RowIndex ?>_assessment_id" id="sv_x<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo RemoveHtml($answers_grid->assessment_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($answers_grid->assessment_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($answers_grid->assessment_id->getPlaceHolder()) ?>"<?php echo $answers_grid->assessment_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_assessment_id" data-value-separator="<?php echo $answers_grid->assessment_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $answers_grid->RowIndex ?>_assessment_id" id="x<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fanswersgrid"], function() {
	fanswersgrid.createAutoSuggest({"id":"x<?php echo $answers_grid->RowIndex ?>_assessment_id","forceSelect":false});
});
</script>
<?php echo $answers_grid->assessment_id->Lookup->getParamTag($answers_grid, "p_x" . $answers_grid->RowIndex . "_assessment_id") ?>
</span>
<?php } ?>
<input type="hidden" data-table="answers" data-field="x_assessment_id" name="o<?php echo $answers_grid->RowIndex ?>_assessment_id" id="o<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->OldValue) ?>">
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($answers_grid->assessment_id->getSessionValue() != "") { ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_assessment_id" class="form-group">
<span<?php echo $answers_grid->assessment_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->assessment_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $answers_grid->RowIndex ?>_assessment_id" name="x<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_assessment_id" class="form-group">
<?php
$onchange = $answers_grid->assessment_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$answers_grid->assessment_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $answers_grid->RowIndex ?>_assessment_id">
	<input type="text" class="form-control" name="sv_x<?php echo $answers_grid->RowIndex ?>_assessment_id" id="sv_x<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo RemoveHtml($answers_grid->assessment_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($answers_grid->assessment_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($answers_grid->assessment_id->getPlaceHolder()) ?>"<?php echo $answers_grid->assessment_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_assessment_id" data-value-separator="<?php echo $answers_grid->assessment_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $answers_grid->RowIndex ?>_assessment_id" id="x<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fanswersgrid"], function() {
	fanswersgrid.createAutoSuggest({"id":"x<?php echo $answers_grid->RowIndex ?>_assessment_id","forceSelect":false});
});
</script>
<?php echo $answers_grid->assessment_id->Lookup->getParamTag($answers_grid, "p_x" . $answers_grid->RowIndex . "_assessment_id") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_assessment_id">
<span<?php echo $answers_grid->assessment_id->viewAttributes() ?>><?php echo $answers_grid->assessment_id->getViewValue() ?></span>
</span>
<?php if (!$answers->isConfirm()) { ?>
<input type="hidden" data-table="answers" data-field="x_assessment_id" name="x<?php echo $answers_grid->RowIndex ?>_assessment_id" id="x<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_assessment_id" name="o<?php echo $answers_grid->RowIndex ?>_assessment_id" id="o<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="answers" data-field="x_assessment_id" name="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_assessment_id" id="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_assessment_id" name="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_assessment_id" id="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($answers_grid->section_id->Visible) { // section_id ?>
		<td data-name="section_id" <?php echo $answers_grid->section_id->cellAttributes() ?>>
<?php if ($answers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_section_id" class="form-group">
<?php
$onchange = $answers_grid->section_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$answers_grid->section_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $answers_grid->RowIndex ?>_section_id">
	<input type="text" class="form-control" name="sv_x<?php echo $answers_grid->RowIndex ?>_section_id" id="sv_x<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo RemoveHtml($answers_grid->section_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($answers_grid->section_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($answers_grid->section_id->getPlaceHolder()) ?>"<?php echo $answers_grid->section_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_section_id" data-value-separator="<?php echo $answers_grid->section_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $answers_grid->RowIndex ?>_section_id" id="x<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo HtmlEncode($answers_grid->section_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fanswersgrid"], function() {
	fanswersgrid.createAutoSuggest({"id":"x<?php echo $answers_grid->RowIndex ?>_section_id","forceSelect":false});
});
</script>
<?php echo $answers_grid->section_id->Lookup->getParamTag($answers_grid, "p_x" . $answers_grid->RowIndex . "_section_id") ?>
</span>
<input type="hidden" data-table="answers" data-field="x_section_id" name="o<?php echo $answers_grid->RowIndex ?>_section_id" id="o<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo HtmlEncode($answers_grid->section_id->OldValue) ?>">
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_section_id" class="form-group">
<?php
$onchange = $answers_grid->section_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$answers_grid->section_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $answers_grid->RowIndex ?>_section_id">
	<input type="text" class="form-control" name="sv_x<?php echo $answers_grid->RowIndex ?>_section_id" id="sv_x<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo RemoveHtml($answers_grid->section_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($answers_grid->section_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($answers_grid->section_id->getPlaceHolder()) ?>"<?php echo $answers_grid->section_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_section_id" data-value-separator="<?php echo $answers_grid->section_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $answers_grid->RowIndex ?>_section_id" id="x<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo HtmlEncode($answers_grid->section_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fanswersgrid"], function() {
	fanswersgrid.createAutoSuggest({"id":"x<?php echo $answers_grid->RowIndex ?>_section_id","forceSelect":false});
});
</script>
<?php echo $answers_grid->section_id->Lookup->getParamTag($answers_grid, "p_x" . $answers_grid->RowIndex . "_section_id") ?>
</span>
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_section_id">
<span<?php echo $answers_grid->section_id->viewAttributes() ?>><?php echo $answers_grid->section_id->getViewValue() ?></span>
</span>
<?php if (!$answers->isConfirm()) { ?>
<input type="hidden" data-table="answers" data-field="x_section_id" name="x<?php echo $answers_grid->RowIndex ?>_section_id" id="x<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo HtmlEncode($answers_grid->section_id->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_section_id" name="o<?php echo $answers_grid->RowIndex ?>_section_id" id="o<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo HtmlEncode($answers_grid->section_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="answers" data-field="x_section_id" name="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_section_id" id="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo HtmlEncode($answers_grid->section_id->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_section_id" name="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_section_id" id="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo HtmlEncode($answers_grid->section_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($answers_grid->_response->Visible) { // response ?>
		<td data-name="_response" <?php echo $answers_grid->_response->cellAttributes() ?>>
<?php if ($answers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers__response" class="form-group">
<input type="text" data-table="answers" data-field="x__response" name="x<?php echo $answers_grid->RowIndex ?>__response" id="x<?php echo $answers_grid->RowIndex ?>__response" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($answers_grid->_response->getPlaceHolder()) ?>" value="<?php echo $answers_grid->_response->EditValue ?>"<?php echo $answers_grid->_response->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x__response" name="o<?php echo $answers_grid->RowIndex ?>__response" id="o<?php echo $answers_grid->RowIndex ?>__response" value="<?php echo HtmlEncode($answers_grid->_response->OldValue) ?>">
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers__response" class="form-group">
<input type="text" data-table="answers" data-field="x__response" name="x<?php echo $answers_grid->RowIndex ?>__response" id="x<?php echo $answers_grid->RowIndex ?>__response" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($answers_grid->_response->getPlaceHolder()) ?>" value="<?php echo $answers_grid->_response->EditValue ?>"<?php echo $answers_grid->_response->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers__response">
<span<?php echo $answers_grid->_response->viewAttributes() ?>><?php echo $answers_grid->_response->getViewValue() ?></span>
</span>
<?php if (!$answers->isConfirm()) { ?>
<input type="hidden" data-table="answers" data-field="x__response" name="x<?php echo $answers_grid->RowIndex ?>__response" id="x<?php echo $answers_grid->RowIndex ?>__response" value="<?php echo HtmlEncode($answers_grid->_response->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x__response" name="o<?php echo $answers_grid->RowIndex ?>__response" id="o<?php echo $answers_grid->RowIndex ?>__response" value="<?php echo HtmlEncode($answers_grid->_response->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="answers" data-field="x__response" name="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>__response" id="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>__response" value="<?php echo HtmlEncode($answers_grid->_response->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x__response" name="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>__response" id="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>__response" value="<?php echo HtmlEncode($answers_grid->_response->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($answers_grid->score->Visible) { // score ?>
		<td data-name="score" <?php echo $answers_grid->score->cellAttributes() ?>>
<?php if ($answers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_score" class="form-group">
<input type="text" data-table="answers" data-field="x_score" name="x<?php echo $answers_grid->RowIndex ?>_score" id="x<?php echo $answers_grid->RowIndex ?>_score" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($answers_grid->score->getPlaceHolder()) ?>" value="<?php echo $answers_grid->score->EditValue ?>"<?php echo $answers_grid->score->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_score" name="o<?php echo $answers_grid->RowIndex ?>_score" id="o<?php echo $answers_grid->RowIndex ?>_score" value="<?php echo HtmlEncode($answers_grid->score->OldValue) ?>">
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_score" class="form-group">
<input type="text" data-table="answers" data-field="x_score" name="x<?php echo $answers_grid->RowIndex ?>_score" id="x<?php echo $answers_grid->RowIndex ?>_score" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($answers_grid->score->getPlaceHolder()) ?>" value="<?php echo $answers_grid->score->EditValue ?>"<?php echo $answers_grid->score->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_score">
<span<?php echo $answers_grid->score->viewAttributes() ?>><?php echo $answers_grid->score->getViewValue() ?></span>
</span>
<?php if (!$answers->isConfirm()) { ?>
<input type="hidden" data-table="answers" data-field="x_score" name="x<?php echo $answers_grid->RowIndex ?>_score" id="x<?php echo $answers_grid->RowIndex ?>_score" value="<?php echo HtmlEncode($answers_grid->score->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_score" name="o<?php echo $answers_grid->RowIndex ?>_score" id="o<?php echo $answers_grid->RowIndex ?>_score" value="<?php echo HtmlEncode($answers_grid->score->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="answers" data-field="x_score" name="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_score" id="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_score" value="<?php echo HtmlEncode($answers_grid->score->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_score" name="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_score" id="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_score" value="<?php echo HtmlEncode($answers_grid->score->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($answers_grid->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $answers_grid->created_at->cellAttributes() ?>>
<?php if ($answers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_created_at" class="form-group">
<input type="text" data-table="answers" data-field="x_created_at" name="x<?php echo $answers_grid->RowIndex ?>_created_at" id="x<?php echo $answers_grid->RowIndex ?>_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($answers_grid->created_at->getPlaceHolder()) ?>" value="<?php echo $answers_grid->created_at->EditValue ?>"<?php echo $answers_grid->created_at->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_created_at" name="o<?php echo $answers_grid->RowIndex ?>_created_at" id="o<?php echo $answers_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($answers_grid->created_at->OldValue) ?>">
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_created_at" class="form-group">
<input type="text" data-table="answers" data-field="x_created_at" name="x<?php echo $answers_grid->RowIndex ?>_created_at" id="x<?php echo $answers_grid->RowIndex ?>_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($answers_grid->created_at->getPlaceHolder()) ?>" value="<?php echo $answers_grid->created_at->EditValue ?>"<?php echo $answers_grid->created_at->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_created_at">
<span<?php echo $answers_grid->created_at->viewAttributes() ?>><?php echo $answers_grid->created_at->getViewValue() ?></span>
</span>
<?php if (!$answers->isConfirm()) { ?>
<input type="hidden" data-table="answers" data-field="x_created_at" name="x<?php echo $answers_grid->RowIndex ?>_created_at" id="x<?php echo $answers_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($answers_grid->created_at->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_created_at" name="o<?php echo $answers_grid->RowIndex ?>_created_at" id="o<?php echo $answers_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($answers_grid->created_at->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="answers" data-field="x_created_at" name="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_created_at" id="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($answers_grid->created_at->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_created_at" name="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_created_at" id="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($answers_grid->created_at->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($answers_grid->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $answers_grid->updated_at->cellAttributes() ?>>
<?php if ($answers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_updated_at" class="form-group">
<input type="text" data-table="answers" data-field="x_updated_at" name="x<?php echo $answers_grid->RowIndex ?>_updated_at" id="x<?php echo $answers_grid->RowIndex ?>_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($answers_grid->updated_at->getPlaceHolder()) ?>" value="<?php echo $answers_grid->updated_at->EditValue ?>"<?php echo $answers_grid->updated_at->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_updated_at" name="o<?php echo $answers_grid->RowIndex ?>_updated_at" id="o<?php echo $answers_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($answers_grid->updated_at->OldValue) ?>">
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_updated_at" class="form-group">
<input type="text" data-table="answers" data-field="x_updated_at" name="x<?php echo $answers_grid->RowIndex ?>_updated_at" id="x<?php echo $answers_grid->RowIndex ?>_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($answers_grid->updated_at->getPlaceHolder()) ?>" value="<?php echo $answers_grid->updated_at->EditValue ?>"<?php echo $answers_grid->updated_at->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($answers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $answers_grid->RowCount ?>_answers_updated_at">
<span<?php echo $answers_grid->updated_at->viewAttributes() ?>><?php echo $answers_grid->updated_at->getViewValue() ?></span>
</span>
<?php if (!$answers->isConfirm()) { ?>
<input type="hidden" data-table="answers" data-field="x_updated_at" name="x<?php echo $answers_grid->RowIndex ?>_updated_at" id="x<?php echo $answers_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($answers_grid->updated_at->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_updated_at" name="o<?php echo $answers_grid->RowIndex ?>_updated_at" id="o<?php echo $answers_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($answers_grid->updated_at->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="answers" data-field="x_updated_at" name="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_updated_at" id="fanswersgrid$x<?php echo $answers_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($answers_grid->updated_at->FormValue) ?>">
<input type="hidden" data-table="answers" data-field="x_updated_at" name="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_updated_at" id="fanswersgrid$o<?php echo $answers_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($answers_grid->updated_at->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$answers_grid->ListOptions->render("body", "right", $answers_grid->RowCount);
?>
	</tr>
<?php if ($answers->RowType == ROWTYPE_ADD || $answers->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fanswersgrid", "load"], function() {
	fanswersgrid.updateLists(<?php echo $answers_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$answers_grid->isGridAdd() || $answers->CurrentMode == "copy")
		if (!$answers_grid->Recordset->EOF)
			$answers_grid->Recordset->moveNext();
}
?>
<?php
	if ($answers->CurrentMode == "add" || $answers->CurrentMode == "copy" || $answers->CurrentMode == "edit") {
		$answers_grid->RowIndex = '$rowindex$';
		$answers_grid->loadRowValues();

		// Set row properties
		$answers->resetAttributes();
		$answers->RowAttrs->merge(["data-rowindex" => $answers_grid->RowIndex, "id" => "r0_answers", "data-rowtype" => ROWTYPE_ADD]);
		$answers->RowAttrs->appendClass("ew-template");
		$answers->RowType = ROWTYPE_ADD;

		// Render row
		$answers_grid->renderRow();

		// Render list options
		$answers_grid->renderListOptions();
		$answers_grid->StartRowCount = 0;
?>
	<tr <?php echo $answers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$answers_grid->ListOptions->render("body", "left", $answers_grid->RowIndex);
?>
	<?php if ($answers_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$answers->isConfirm()) { ?>
<span id="el$rowindex$_answers_id" class="form-group answers_id"></span>
<?php } else { ?>
<span id="el$rowindex$_answers_id" class="form-group answers_id">
<span<?php echo $answers_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="answers" data-field="x_id" name="x<?php echo $answers_grid->RowIndex ?>_id" id="x<?php echo $answers_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($answers_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="answers" data-field="x_id" name="o<?php echo $answers_grid->RowIndex ?>_id" id="o<?php echo $answers_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($answers_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($answers_grid->question_id->Visible) { // question_id ?>
		<td data-name="question_id">
<?php if (!$answers->isConfirm()) { ?>
<?php if ($answers_grid->question_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_answers_question_id" class="form-group answers_question_id">
<span<?php echo $answers_grid->question_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->question_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $answers_grid->RowIndex ?>_question_id" name="x<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_answers_question_id" class="form-group answers_question_id">
<?php
$onchange = $answers_grid->question_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$answers_grid->question_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $answers_grid->RowIndex ?>_question_id">
	<input type="text" class="form-control" name="sv_x<?php echo $answers_grid->RowIndex ?>_question_id" id="sv_x<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo RemoveHtml($answers_grid->question_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($answers_grid->question_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($answers_grid->question_id->getPlaceHolder()) ?>"<?php echo $answers_grid->question_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_question_id" data-value-separator="<?php echo $answers_grid->question_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $answers_grid->RowIndex ?>_question_id" id="x<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fanswersgrid"], function() {
	fanswersgrid.createAutoSuggest({"id":"x<?php echo $answers_grid->RowIndex ?>_question_id","forceSelect":false});
});
</script>
<?php echo $answers_grid->question_id->Lookup->getParamTag($answers_grid, "p_x" . $answers_grid->RowIndex . "_question_id") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_answers_question_id" class="form-group answers_question_id">
<span<?php echo $answers_grid->question_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->question_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="answers" data-field="x_question_id" name="x<?php echo $answers_grid->RowIndex ?>_question_id" id="x<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="answers" data-field="x_question_id" name="o<?php echo $answers_grid->RowIndex ?>_question_id" id="o<?php echo $answers_grid->RowIndex ?>_question_id" value="<?php echo HtmlEncode($answers_grid->question_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($answers_grid->assessment_id->Visible) { // assessment_id ?>
		<td data-name="assessment_id">
<?php if (!$answers->isConfirm()) { ?>
<?php if ($answers_grid->assessment_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_answers_assessment_id" class="form-group answers_assessment_id">
<span<?php echo $answers_grid->assessment_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->assessment_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $answers_grid->RowIndex ?>_assessment_id" name="x<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_answers_assessment_id" class="form-group answers_assessment_id">
<?php
$onchange = $answers_grid->assessment_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$answers_grid->assessment_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $answers_grid->RowIndex ?>_assessment_id">
	<input type="text" class="form-control" name="sv_x<?php echo $answers_grid->RowIndex ?>_assessment_id" id="sv_x<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo RemoveHtml($answers_grid->assessment_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($answers_grid->assessment_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($answers_grid->assessment_id->getPlaceHolder()) ?>"<?php echo $answers_grid->assessment_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_assessment_id" data-value-separator="<?php echo $answers_grid->assessment_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $answers_grid->RowIndex ?>_assessment_id" id="x<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fanswersgrid"], function() {
	fanswersgrid.createAutoSuggest({"id":"x<?php echo $answers_grid->RowIndex ?>_assessment_id","forceSelect":false});
});
</script>
<?php echo $answers_grid->assessment_id->Lookup->getParamTag($answers_grid, "p_x" . $answers_grid->RowIndex . "_assessment_id") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_answers_assessment_id" class="form-group answers_assessment_id">
<span<?php echo $answers_grid->assessment_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->assessment_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="answers" data-field="x_assessment_id" name="x<?php echo $answers_grid->RowIndex ?>_assessment_id" id="x<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="answers" data-field="x_assessment_id" name="o<?php echo $answers_grid->RowIndex ?>_assessment_id" id="o<?php echo $answers_grid->RowIndex ?>_assessment_id" value="<?php echo HtmlEncode($answers_grid->assessment_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($answers_grid->section_id->Visible) { // section_id ?>
		<td data-name="section_id">
<?php if (!$answers->isConfirm()) { ?>
<span id="el$rowindex$_answers_section_id" class="form-group answers_section_id">
<?php
$onchange = $answers_grid->section_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$answers_grid->section_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $answers_grid->RowIndex ?>_section_id">
	<input type="text" class="form-control" name="sv_x<?php echo $answers_grid->RowIndex ?>_section_id" id="sv_x<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo RemoveHtml($answers_grid->section_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($answers_grid->section_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($answers_grid->section_id->getPlaceHolder()) ?>"<?php echo $answers_grid->section_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="answers" data-field="x_section_id" data-value-separator="<?php echo $answers_grid->section_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $answers_grid->RowIndex ?>_section_id" id="x<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo HtmlEncode($answers_grid->section_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fanswersgrid"], function() {
	fanswersgrid.createAutoSuggest({"id":"x<?php echo $answers_grid->RowIndex ?>_section_id","forceSelect":false});
});
</script>
<?php echo $answers_grid->section_id->Lookup->getParamTag($answers_grid, "p_x" . $answers_grid->RowIndex . "_section_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_answers_section_id" class="form-group answers_section_id">
<span<?php echo $answers_grid->section_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->section_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="answers" data-field="x_section_id" name="x<?php echo $answers_grid->RowIndex ?>_section_id" id="x<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo HtmlEncode($answers_grid->section_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="answers" data-field="x_section_id" name="o<?php echo $answers_grid->RowIndex ?>_section_id" id="o<?php echo $answers_grid->RowIndex ?>_section_id" value="<?php echo HtmlEncode($answers_grid->section_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($answers_grid->_response->Visible) { // response ?>
		<td data-name="_response">
<?php if (!$answers->isConfirm()) { ?>
<span id="el$rowindex$_answers__response" class="form-group answers__response">
<input type="text" data-table="answers" data-field="x__response" name="x<?php echo $answers_grid->RowIndex ?>__response" id="x<?php echo $answers_grid->RowIndex ?>__response" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($answers_grid->_response->getPlaceHolder()) ?>" value="<?php echo $answers_grid->_response->EditValue ?>"<?php echo $answers_grid->_response->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_answers__response" class="form-group answers__response">
<span<?php echo $answers_grid->_response->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->_response->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="answers" data-field="x__response" name="x<?php echo $answers_grid->RowIndex ?>__response" id="x<?php echo $answers_grid->RowIndex ?>__response" value="<?php echo HtmlEncode($answers_grid->_response->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="answers" data-field="x__response" name="o<?php echo $answers_grid->RowIndex ?>__response" id="o<?php echo $answers_grid->RowIndex ?>__response" value="<?php echo HtmlEncode($answers_grid->_response->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($answers_grid->score->Visible) { // score ?>
		<td data-name="score">
<?php if (!$answers->isConfirm()) { ?>
<span id="el$rowindex$_answers_score" class="form-group answers_score">
<input type="text" data-table="answers" data-field="x_score" name="x<?php echo $answers_grid->RowIndex ?>_score" id="x<?php echo $answers_grid->RowIndex ?>_score" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($answers_grid->score->getPlaceHolder()) ?>" value="<?php echo $answers_grid->score->EditValue ?>"<?php echo $answers_grid->score->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_answers_score" class="form-group answers_score">
<span<?php echo $answers_grid->score->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->score->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="answers" data-field="x_score" name="x<?php echo $answers_grid->RowIndex ?>_score" id="x<?php echo $answers_grid->RowIndex ?>_score" value="<?php echo HtmlEncode($answers_grid->score->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="answers" data-field="x_score" name="o<?php echo $answers_grid->RowIndex ?>_score" id="o<?php echo $answers_grid->RowIndex ?>_score" value="<?php echo HtmlEncode($answers_grid->score->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($answers_grid->created_at->Visible) { // created_at ?>
		<td data-name="created_at">
<?php if (!$answers->isConfirm()) { ?>
<span id="el$rowindex$_answers_created_at" class="form-group answers_created_at">
<input type="text" data-table="answers" data-field="x_created_at" name="x<?php echo $answers_grid->RowIndex ?>_created_at" id="x<?php echo $answers_grid->RowIndex ?>_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($answers_grid->created_at->getPlaceHolder()) ?>" value="<?php echo $answers_grid->created_at->EditValue ?>"<?php echo $answers_grid->created_at->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_answers_created_at" class="form-group answers_created_at">
<span<?php echo $answers_grid->created_at->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->created_at->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="answers" data-field="x_created_at" name="x<?php echo $answers_grid->RowIndex ?>_created_at" id="x<?php echo $answers_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($answers_grid->created_at->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="answers" data-field="x_created_at" name="o<?php echo $answers_grid->RowIndex ?>_created_at" id="o<?php echo $answers_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($answers_grid->created_at->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($answers_grid->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at">
<?php if (!$answers->isConfirm()) { ?>
<span id="el$rowindex$_answers_updated_at" class="form-group answers_updated_at">
<input type="text" data-table="answers" data-field="x_updated_at" name="x<?php echo $answers_grid->RowIndex ?>_updated_at" id="x<?php echo $answers_grid->RowIndex ?>_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($answers_grid->updated_at->getPlaceHolder()) ?>" value="<?php echo $answers_grid->updated_at->EditValue ?>"<?php echo $answers_grid->updated_at->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_answers_updated_at" class="form-group answers_updated_at">
<span<?php echo $answers_grid->updated_at->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($answers_grid->updated_at->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="answers" data-field="x_updated_at" name="x<?php echo $answers_grid->RowIndex ?>_updated_at" id="x<?php echo $answers_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($answers_grid->updated_at->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="answers" data-field="x_updated_at" name="o<?php echo $answers_grid->RowIndex ?>_updated_at" id="o<?php echo $answers_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($answers_grid->updated_at->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$answers_grid->ListOptions->render("body", "right", $answers_grid->RowIndex);
?>
<script>
loadjs.ready(["fanswersgrid", "load"], function() {
	fanswersgrid.updateLists(<?php echo $answers_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($answers->CurrentMode == "add" || $answers->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $answers_grid->FormKeyCountName ?>" id="<?php echo $answers_grid->FormKeyCountName ?>" value="<?php echo $answers_grid->KeyCount ?>">
<?php echo $answers_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($answers->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $answers_grid->FormKeyCountName ?>" id="<?php echo $answers_grid->FormKeyCountName ?>" value="<?php echo $answers_grid->KeyCount ?>">
<?php echo $answers_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($answers->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fanswersgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($answers_grid->Recordset)
	$answers_grid->Recordset->Close();
?>
<?php if ($answers_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $answers_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($answers_grid->TotalRecords == 0 && !$answers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $answers_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$answers_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$answers_grid->terminate();
?>
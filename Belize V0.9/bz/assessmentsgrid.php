<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($assessments_grid))
	$assessments_grid = new assessments_grid();

// Run the page
$assessments_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$assessments_grid->Page_Render();
?>
<?php if (!$assessments_grid->isExport()) { ?>
<script>
var fassessmentsgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fassessmentsgrid = new ew.Form("fassessmentsgrid", "grid");
	fassessmentsgrid.formKeyCountName = '<?php echo $assessments_grid->FormKeyCountName ?>';

	// Validate form
	fassessmentsgrid.validate = function() {
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
			<?php if ($assessments_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->id->caption(), $assessments_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($assessments_grid->user_id->Required) { ?>
				elm = this.getElements("x" + infix + "_user_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->user_id->caption(), $assessments_grid->user_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_user_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_grid->user_id->errorMessage()) ?>");
			<?php if ($assessments_grid->customer_id->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->customer_id->caption(), $assessments_grid->customer_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($assessments_grid->customer_first_name->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_first_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->customer_first_name->caption(), $assessments_grid->customer_first_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($assessments_grid->customer_age->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_age");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->customer_age->caption(), $assessments_grid->customer_age->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_customer_age");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_grid->customer_age->errorMessage()) ?>");
			<?php if ($assessments_grid->sex->Required) { ?>
				elm = this.getElements("x" + infix + "_sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->sex->caption(), $assessments_grid->sex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($assessments_grid->address->Required) { ?>
				elm = this.getElements("x" + infix + "_address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->address->caption(), $assessments_grid->address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($assessments_grid->total_score->Required) { ?>
				elm = this.getElements("x" + infix + "_total_score");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->total_score->caption(), $assessments_grid->total_score->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_score");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_grid->total_score->errorMessage()) ?>");
			<?php if ($assessments_grid->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->status->caption(), $assessments_grid->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($assessments_grid->loan_purpose->Required) { ?>
				elm = this.getElements("x" + infix + "_loan_purpose");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->loan_purpose->caption(), $assessments_grid->loan_purpose->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_loan_purpose");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_grid->loan_purpose->errorMessage()) ?>");
			<?php if ($assessments_grid->loan_section->Required) { ?>
				elm = this.getElements("x" + infix + "_loan_section");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->loan_section->caption(), $assessments_grid->loan_section->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_loan_section");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_grid->loan_section->errorMessage()) ?>");
			<?php if ($assessments_grid->lat->Required) { ?>
				elm = this.getElements("x" + infix + "_lat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->lat->caption(), $assessments_grid->lat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lat");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_grid->lat->errorMessage()) ?>");
			<?php if ($assessments_grid->lon->Required) { ?>
				elm = this.getElements("x" + infix + "_lon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->lon->caption(), $assessments_grid->lon->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lon");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_grid->lon->errorMessage()) ?>");
			<?php if ($assessments_grid->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->created_at->caption(), $assessments_grid->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_grid->created_at->errorMessage()) ?>");
			<?php if ($assessments_grid->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_grid->updated_at->caption(), $assessments_grid->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_grid->updated_at->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fassessmentsgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "user_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "customer_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "customer_first_name", false)) return false;
		if (ew.valueChanged(fobj, infix, "customer_age", false)) return false;
		if (ew.valueChanged(fobj, infix, "sex", false)) return false;
		if (ew.valueChanged(fobj, infix, "address", false)) return false;
		if (ew.valueChanged(fobj, infix, "total_score", false)) return false;
		if (ew.valueChanged(fobj, infix, "status", false)) return false;
		if (ew.valueChanged(fobj, infix, "loan_purpose", false)) return false;
		if (ew.valueChanged(fobj, infix, "loan_section", false)) return false;
		if (ew.valueChanged(fobj, infix, "lat", false)) return false;
		if (ew.valueChanged(fobj, infix, "lon", false)) return false;
		if (ew.valueChanged(fobj, infix, "created_at", false)) return false;
		if (ew.valueChanged(fobj, infix, "updated_at", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fassessmentsgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fassessmentsgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fassessmentsgrid.lists["x_user_id"] = <?php echo $assessments_grid->user_id->Lookup->toClientList($assessments_grid) ?>;
	fassessmentsgrid.lists["x_user_id"].options = <?php echo JsonEncode($assessments_grid->user_id->lookupOptions()) ?>;
	fassessmentsgrid.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fassessmentsgrid.lists["x_status"] = <?php echo $assessments_grid->status->Lookup->toClientList($assessments_grid) ?>;
	fassessmentsgrid.lists["x_status"].options = <?php echo JsonEncode($assessments_grid->status->options(FALSE, TRUE)) ?>;
	fassessmentsgrid.lists["x_loan_purpose"] = <?php echo $assessments_grid->loan_purpose->Lookup->toClientList($assessments_grid) ?>;
	fassessmentsgrid.lists["x_loan_purpose"].options = <?php echo JsonEncode($assessments_grid->loan_purpose->lookupOptions()) ?>;
	fassessmentsgrid.autoSuggests["x_loan_purpose"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fassessmentsgrid.lists["x_loan_section"] = <?php echo $assessments_grid->loan_section->Lookup->toClientList($assessments_grid) ?>;
	fassessmentsgrid.lists["x_loan_section"].options = <?php echo JsonEncode($assessments_grid->loan_section->lookupOptions()) ?>;
	fassessmentsgrid.autoSuggests["x_loan_section"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fassessmentsgrid");
});
</script>
<?php } ?>
<?php
$assessments_grid->renderOtherOptions();
?>
<?php if ($assessments_grid->TotalRecords > 0 || $assessments->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($assessments_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> assessments">
<?php if ($assessments_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $assessments_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fassessmentsgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_assessments" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_assessmentsgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$assessments->RowType = ROWTYPE_HEADER;

// Render list options
$assessments_grid->renderListOptions();

// Render list options (header, left)
$assessments_grid->ListOptions->render("header", "left");
?>
<?php if ($assessments_grid->id->Visible) { // id ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $assessments_grid->id->headerCellClass() ?>"><div id="elh_assessments_id" class="assessments_id"><div class="ew-table-header-caption"><?php echo $assessments_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $assessments_grid->id->headerCellClass() ?>"><div><div id="elh_assessments_id" class="assessments_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->user_id->Visible) { // user_id ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $assessments_grid->user_id->headerCellClass() ?>"><div id="elh_assessments_user_id" class="assessments_user_id"><div class="ew-table-header-caption"><?php echo $assessments_grid->user_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $assessments_grid->user_id->headerCellClass() ?>"><div><div id="elh_assessments_user_id" class="assessments_user_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->user_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->user_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->customer_id->Visible) { // customer_id ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->customer_id) == "") { ?>
		<th data-name="customer_id" class="<?php echo $assessments_grid->customer_id->headerCellClass() ?>"><div id="elh_assessments_customer_id" class="assessments_customer_id"><div class="ew-table-header-caption"><?php echo $assessments_grid->customer_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_id" class="<?php echo $assessments_grid->customer_id->headerCellClass() ?>"><div><div id="elh_assessments_customer_id" class="assessments_customer_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->customer_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->customer_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->customer_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->customer_first_name->Visible) { // customer_first_name ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->customer_first_name) == "") { ?>
		<th data-name="customer_first_name" class="<?php echo $assessments_grid->customer_first_name->headerCellClass() ?>"><div id="elh_assessments_customer_first_name" class="assessments_customer_first_name"><div class="ew-table-header-caption"><?php echo $assessments_grid->customer_first_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_first_name" class="<?php echo $assessments_grid->customer_first_name->headerCellClass() ?>"><div><div id="elh_assessments_customer_first_name" class="assessments_customer_first_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->customer_first_name->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->customer_first_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->customer_first_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->customer_age->Visible) { // customer_age ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->customer_age) == "") { ?>
		<th data-name="customer_age" class="<?php echo $assessments_grid->customer_age->headerCellClass() ?>"><div id="elh_assessments_customer_age" class="assessments_customer_age"><div class="ew-table-header-caption"><?php echo $assessments_grid->customer_age->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_age" class="<?php echo $assessments_grid->customer_age->headerCellClass() ?>"><div><div id="elh_assessments_customer_age" class="assessments_customer_age">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->customer_age->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->customer_age->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->customer_age->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->sex->Visible) { // sex ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->sex) == "") { ?>
		<th data-name="sex" class="<?php echo $assessments_grid->sex->headerCellClass() ?>"><div id="elh_assessments_sex" class="assessments_sex"><div class="ew-table-header-caption"><?php echo $assessments_grid->sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sex" class="<?php echo $assessments_grid->sex->headerCellClass() ?>"><div><div id="elh_assessments_sex" class="assessments_sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->sex->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->address->Visible) { // address ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->address) == "") { ?>
		<th data-name="address" class="<?php echo $assessments_grid->address->headerCellClass() ?>"><div id="elh_assessments_address" class="assessments_address"><div class="ew-table-header-caption"><?php echo $assessments_grid->address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="address" class="<?php echo $assessments_grid->address->headerCellClass() ?>"><div><div id="elh_assessments_address" class="assessments_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->address->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->total_score->Visible) { // total_score ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->total_score) == "") { ?>
		<th data-name="total_score" class="<?php echo $assessments_grid->total_score->headerCellClass() ?>"><div id="elh_assessments_total_score" class="assessments_total_score"><div class="ew-table-header-caption"><?php echo $assessments_grid->total_score->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_score" class="<?php echo $assessments_grid->total_score->headerCellClass() ?>"><div><div id="elh_assessments_total_score" class="assessments_total_score">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->total_score->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->total_score->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->total_score->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->status->Visible) { // status ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->status) == "") { ?>
		<th data-name="status" class="<?php echo $assessments_grid->status->headerCellClass() ?>"><div id="elh_assessments_status" class="assessments_status"><div class="ew-table-header-caption"><?php echo $assessments_grid->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $assessments_grid->status->headerCellClass() ?>"><div><div id="elh_assessments_status" class="assessments_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->loan_purpose->Visible) { // loan_purpose ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->loan_purpose) == "") { ?>
		<th data-name="loan_purpose" class="<?php echo $assessments_grid->loan_purpose->headerCellClass() ?>"><div id="elh_assessments_loan_purpose" class="assessments_loan_purpose"><div class="ew-table-header-caption"><?php echo $assessments_grid->loan_purpose->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="loan_purpose" class="<?php echo $assessments_grid->loan_purpose->headerCellClass() ?>"><div><div id="elh_assessments_loan_purpose" class="assessments_loan_purpose">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->loan_purpose->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->loan_purpose->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->loan_purpose->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->loan_section->Visible) { // loan_section ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->loan_section) == "") { ?>
		<th data-name="loan_section" class="<?php echo $assessments_grid->loan_section->headerCellClass() ?>"><div id="elh_assessments_loan_section" class="assessments_loan_section"><div class="ew-table-header-caption"><?php echo $assessments_grid->loan_section->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="loan_section" class="<?php echo $assessments_grid->loan_section->headerCellClass() ?>"><div><div id="elh_assessments_loan_section" class="assessments_loan_section">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->loan_section->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->loan_section->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->loan_section->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->lat->Visible) { // lat ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->lat) == "") { ?>
		<th data-name="lat" class="<?php echo $assessments_grid->lat->headerCellClass() ?>"><div id="elh_assessments_lat" class="assessments_lat"><div class="ew-table-header-caption"><?php echo $assessments_grid->lat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lat" class="<?php echo $assessments_grid->lat->headerCellClass() ?>"><div><div id="elh_assessments_lat" class="assessments_lat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->lat->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->lat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->lat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->lon->Visible) { // lon ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->lon) == "") { ?>
		<th data-name="lon" class="<?php echo $assessments_grid->lon->headerCellClass() ?>"><div id="elh_assessments_lon" class="assessments_lon"><div class="ew-table-header-caption"><?php echo $assessments_grid->lon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lon" class="<?php echo $assessments_grid->lon->headerCellClass() ?>"><div><div id="elh_assessments_lon" class="assessments_lon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->lon->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->lon->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->lon->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->created_at->Visible) { // created_at ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $assessments_grid->created_at->headerCellClass() ?>"><div id="elh_assessments_created_at" class="assessments_created_at"><div class="ew-table-header-caption"><?php echo $assessments_grid->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $assessments_grid->created_at->headerCellClass() ?>"><div><div id="elh_assessments_created_at" class="assessments_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assessments_grid->updated_at->Visible) { // updated_at ?>
	<?php if ($assessments_grid->SortUrl($assessments_grid->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $assessments_grid->updated_at->headerCellClass() ?>"><div id="elh_assessments_updated_at" class="assessments_updated_at"><div class="ew-table-header-caption"><?php echo $assessments_grid->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $assessments_grid->updated_at->headerCellClass() ?>"><div><div id="elh_assessments_updated_at" class="assessments_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assessments_grid->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($assessments_grid->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assessments_grid->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$assessments_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$assessments_grid->StartRecord = 1;
$assessments_grid->StopRecord = $assessments_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($assessments->isConfirm() || $assessments_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($assessments_grid->FormKeyCountName) && ($assessments_grid->isGridAdd() || $assessments_grid->isGridEdit() || $assessments->isConfirm())) {
		$assessments_grid->KeyCount = $CurrentForm->getValue($assessments_grid->FormKeyCountName);
		$assessments_grid->StopRecord = $assessments_grid->StartRecord + $assessments_grid->KeyCount - 1;
	}
}
$assessments_grid->RecordCount = $assessments_grid->StartRecord - 1;
if ($assessments_grid->Recordset && !$assessments_grid->Recordset->EOF) {
	$assessments_grid->Recordset->moveFirst();
	$selectLimit = $assessments_grid->UseSelectLimit;
	if (!$selectLimit && $assessments_grid->StartRecord > 1)
		$assessments_grid->Recordset->move($assessments_grid->StartRecord - 1);
} elseif (!$assessments->AllowAddDeleteRow && $assessments_grid->StopRecord == 0) {
	$assessments_grid->StopRecord = $assessments->GridAddRowCount;
}

// Initialize aggregate
$assessments->RowType = ROWTYPE_AGGREGATEINIT;
$assessments->resetAttributes();
$assessments_grid->renderRow();
if ($assessments_grid->isGridAdd())
	$assessments_grid->RowIndex = 0;
if ($assessments_grid->isGridEdit())
	$assessments_grid->RowIndex = 0;
while ($assessments_grid->RecordCount < $assessments_grid->StopRecord) {
	$assessments_grid->RecordCount++;
	if ($assessments_grid->RecordCount >= $assessments_grid->StartRecord) {
		$assessments_grid->RowCount++;
		if ($assessments_grid->isGridAdd() || $assessments_grid->isGridEdit() || $assessments->isConfirm()) {
			$assessments_grid->RowIndex++;
			$CurrentForm->Index = $assessments_grid->RowIndex;
			if ($CurrentForm->hasValue($assessments_grid->FormActionName) && ($assessments->isConfirm() || $assessments_grid->EventCancelled))
				$assessments_grid->RowAction = strval($CurrentForm->getValue($assessments_grid->FormActionName));
			elseif ($assessments_grid->isGridAdd())
				$assessments_grid->RowAction = "insert";
			else
				$assessments_grid->RowAction = "";
		}

		// Set up key count
		$assessments_grid->KeyCount = $assessments_grid->RowIndex;

		// Init row class and style
		$assessments->resetAttributes();
		$assessments->CssClass = "";
		if ($assessments_grid->isGridAdd()) {
			if ($assessments->CurrentMode == "copy") {
				$assessments_grid->loadRowValues($assessments_grid->Recordset); // Load row values
				$assessments_grid->setRecordKey($assessments_grid->RowOldKey, $assessments_grid->Recordset); // Set old record key
			} else {
				$assessments_grid->loadRowValues(); // Load default values
				$assessments_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$assessments_grid->loadRowValues($assessments_grid->Recordset); // Load row values
		}
		$assessments->RowType = ROWTYPE_VIEW; // Render view
		if ($assessments_grid->isGridAdd()) // Grid add
			$assessments->RowType = ROWTYPE_ADD; // Render add
		if ($assessments_grid->isGridAdd() && $assessments->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$assessments_grid->restoreCurrentRowFormValues($assessments_grid->RowIndex); // Restore form values
		if ($assessments_grid->isGridEdit()) { // Grid edit
			if ($assessments->EventCancelled)
				$assessments_grid->restoreCurrentRowFormValues($assessments_grid->RowIndex); // Restore form values
			if ($assessments_grid->RowAction == "insert")
				$assessments->RowType = ROWTYPE_ADD; // Render add
			else
				$assessments->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($assessments_grid->isGridEdit() && ($assessments->RowType == ROWTYPE_EDIT || $assessments->RowType == ROWTYPE_ADD) && $assessments->EventCancelled) // Update failed
			$assessments_grid->restoreCurrentRowFormValues($assessments_grid->RowIndex); // Restore form values
		if ($assessments->RowType == ROWTYPE_EDIT) // Edit row
			$assessments_grid->EditRowCount++;
		if ($assessments->isConfirm()) // Confirm row
			$assessments_grid->restoreCurrentRowFormValues($assessments_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$assessments->RowAttrs->merge(["data-rowindex" => $assessments_grid->RowCount, "id" => "r" . $assessments_grid->RowCount . "_assessments", "data-rowtype" => $assessments->RowType]);

		// Render row
		$assessments_grid->renderRow();

		// Render list options
		$assessments_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($assessments_grid->RowAction != "delete" && $assessments_grid->RowAction != "insertdelete" && !($assessments_grid->RowAction == "insert" && $assessments->isConfirm() && $assessments_grid->emptyRow())) {
?>
	<tr <?php echo $assessments->rowAttributes() ?>>
<?php

// Render list options (body, left)
$assessments_grid->ListOptions->render("body", "left", $assessments_grid->RowCount);
?>
	<?php if ($assessments_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $assessments_grid->id->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_id" class="form-group"></span>
<input type="hidden" data-table="assessments" data-field="x_id" name="o<?php echo $assessments_grid->RowIndex ?>_id" id="o<?php echo $assessments_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($assessments_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_id" class="form-group">
<span<?php echo $assessments_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_id" name="x<?php echo $assessments_grid->RowIndex ?>_id" id="x<?php echo $assessments_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($assessments_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_id">
<span<?php echo $assessments_grid->id->viewAttributes() ?>><?php echo $assessments_grid->id->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_id" name="x<?php echo $assessments_grid->RowIndex ?>_id" id="x<?php echo $assessments_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($assessments_grid->id->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_id" name="o<?php echo $assessments_grid->RowIndex ?>_id" id="o<?php echo $assessments_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($assessments_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_id" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_id" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($assessments_grid->id->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_id" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_id" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($assessments_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->user_id->Visible) { // user_id ?>
		<td data-name="user_id" <?php echo $assessments_grid->user_id->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($assessments_grid->user_id->getSessionValue() != "") { ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_user_id" class="form-group">
<span<?php echo $assessments_grid->user_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->user_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $assessments_grid->RowIndex ?>_user_id" name="x<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_user_id" class="form-group">
<?php
$onchange = $assessments_grid->user_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_grid->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $assessments_grid->RowIndex ?>_user_id">
	<input type="text" class="form-control" name="sv_x<?php echo $assessments_grid->RowIndex ?>_user_id" id="sv_x<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo RemoveHtml($assessments_grid->user_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($assessments_grid->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_grid->user_id->getPlaceHolder()) ?>"<?php echo $assessments_grid->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_user_id" data-value-separator="<?php echo $assessments_grid->user_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $assessments_grid->RowIndex ?>_user_id" id="x<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentsgrid"], function() {
	fassessmentsgrid.createAutoSuggest({"id":"x<?php echo $assessments_grid->RowIndex ?>_user_id","forceSelect":false});
});
</script>
<?php echo $assessments_grid->user_id->Lookup->getParamTag($assessments_grid, "p_x" . $assessments_grid->RowIndex . "_user_id") ?>
</span>
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_user_id" name="o<?php echo $assessments_grid->RowIndex ?>_user_id" id="o<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($assessments_grid->user_id->getSessionValue() != "") { ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_user_id" class="form-group">
<span<?php echo $assessments_grid->user_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->user_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $assessments_grid->RowIndex ?>_user_id" name="x<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_user_id" class="form-group">
<?php
$onchange = $assessments_grid->user_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_grid->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $assessments_grid->RowIndex ?>_user_id">
	<input type="text" class="form-control" name="sv_x<?php echo $assessments_grid->RowIndex ?>_user_id" id="sv_x<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo RemoveHtml($assessments_grid->user_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($assessments_grid->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_grid->user_id->getPlaceHolder()) ?>"<?php echo $assessments_grid->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_user_id" data-value-separator="<?php echo $assessments_grid->user_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $assessments_grid->RowIndex ?>_user_id" id="x<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentsgrid"], function() {
	fassessmentsgrid.createAutoSuggest({"id":"x<?php echo $assessments_grid->RowIndex ?>_user_id","forceSelect":false});
});
</script>
<?php echo $assessments_grid->user_id->Lookup->getParamTag($assessments_grid, "p_x" . $assessments_grid->RowIndex . "_user_id") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_user_id">
<span<?php echo $assessments_grid->user_id->viewAttributes() ?>><?php echo $assessments_grid->user_id->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_user_id" name="x<?php echo $assessments_grid->RowIndex ?>_user_id" id="x<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_user_id" name="o<?php echo $assessments_grid->RowIndex ?>_user_id" id="o<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_user_id" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_user_id" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_user_id" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_user_id" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->customer_id->Visible) { // customer_id ?>
		<td data-name="customer_id" <?php echo $assessments_grid->customer_id->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_customer_id" class="form-group">
<input type="text" data-table="assessments" data-field="x_customer_id" name="x<?php echo $assessments_grid->RowIndex ?>_customer_id" id="x<?php echo $assessments_grid->RowIndex ?>_customer_id" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_grid->customer_id->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->customer_id->EditValue ?>"<?php echo $assessments_grid->customer_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_customer_id" name="o<?php echo $assessments_grid->RowIndex ?>_customer_id" id="o<?php echo $assessments_grid->RowIndex ?>_customer_id" value="<?php echo HtmlEncode($assessments_grid->customer_id->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_customer_id" class="form-group">
<input type="text" data-table="assessments" data-field="x_customer_id" name="x<?php echo $assessments_grid->RowIndex ?>_customer_id" id="x<?php echo $assessments_grid->RowIndex ?>_customer_id" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_grid->customer_id->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->customer_id->EditValue ?>"<?php echo $assessments_grid->customer_id->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_customer_id">
<span<?php echo $assessments_grid->customer_id->viewAttributes() ?>><?php echo $assessments_grid->customer_id->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_customer_id" name="x<?php echo $assessments_grid->RowIndex ?>_customer_id" id="x<?php echo $assessments_grid->RowIndex ?>_customer_id" value="<?php echo HtmlEncode($assessments_grid->customer_id->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_customer_id" name="o<?php echo $assessments_grid->RowIndex ?>_customer_id" id="o<?php echo $assessments_grid->RowIndex ?>_customer_id" value="<?php echo HtmlEncode($assessments_grid->customer_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_customer_id" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_customer_id" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_customer_id" value="<?php echo HtmlEncode($assessments_grid->customer_id->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_customer_id" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_customer_id" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_customer_id" value="<?php echo HtmlEncode($assessments_grid->customer_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->customer_first_name->Visible) { // customer_first_name ?>
		<td data-name="customer_first_name" <?php echo $assessments_grid->customer_first_name->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_customer_first_name" class="form-group">
<input type="text" data-table="assessments" data-field="x_customer_first_name" name="x<?php echo $assessments_grid->RowIndex ?>_customer_first_name" id="x<?php echo $assessments_grid->RowIndex ?>_customer_first_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_grid->customer_first_name->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->customer_first_name->EditValue ?>"<?php echo $assessments_grid->customer_first_name->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_customer_first_name" name="o<?php echo $assessments_grid->RowIndex ?>_customer_first_name" id="o<?php echo $assessments_grid->RowIndex ?>_customer_first_name" value="<?php echo HtmlEncode($assessments_grid->customer_first_name->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_customer_first_name" class="form-group">
<input type="text" data-table="assessments" data-field="x_customer_first_name" name="x<?php echo $assessments_grid->RowIndex ?>_customer_first_name" id="x<?php echo $assessments_grid->RowIndex ?>_customer_first_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_grid->customer_first_name->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->customer_first_name->EditValue ?>"<?php echo $assessments_grid->customer_first_name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_customer_first_name">
<span<?php echo $assessments_grid->customer_first_name->viewAttributes() ?>><?php echo $assessments_grid->customer_first_name->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_customer_first_name" name="x<?php echo $assessments_grid->RowIndex ?>_customer_first_name" id="x<?php echo $assessments_grid->RowIndex ?>_customer_first_name" value="<?php echo HtmlEncode($assessments_grid->customer_first_name->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_customer_first_name" name="o<?php echo $assessments_grid->RowIndex ?>_customer_first_name" id="o<?php echo $assessments_grid->RowIndex ?>_customer_first_name" value="<?php echo HtmlEncode($assessments_grid->customer_first_name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_customer_first_name" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_customer_first_name" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_customer_first_name" value="<?php echo HtmlEncode($assessments_grid->customer_first_name->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_customer_first_name" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_customer_first_name" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_customer_first_name" value="<?php echo HtmlEncode($assessments_grid->customer_first_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->customer_age->Visible) { // customer_age ?>
		<td data-name="customer_age" <?php echo $assessments_grid->customer_age->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_customer_age" class="form-group">
<input type="text" data-table="assessments" data-field="x_customer_age" name="x<?php echo $assessments_grid->RowIndex ?>_customer_age" id="x<?php echo $assessments_grid->RowIndex ?>_customer_age" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($assessments_grid->customer_age->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->customer_age->EditValue ?>"<?php echo $assessments_grid->customer_age->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_customer_age" name="o<?php echo $assessments_grid->RowIndex ?>_customer_age" id="o<?php echo $assessments_grid->RowIndex ?>_customer_age" value="<?php echo HtmlEncode($assessments_grid->customer_age->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_customer_age" class="form-group">
<input type="text" data-table="assessments" data-field="x_customer_age" name="x<?php echo $assessments_grid->RowIndex ?>_customer_age" id="x<?php echo $assessments_grid->RowIndex ?>_customer_age" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($assessments_grid->customer_age->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->customer_age->EditValue ?>"<?php echo $assessments_grid->customer_age->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_customer_age">
<span<?php echo $assessments_grid->customer_age->viewAttributes() ?>><?php echo $assessments_grid->customer_age->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_customer_age" name="x<?php echo $assessments_grid->RowIndex ?>_customer_age" id="x<?php echo $assessments_grid->RowIndex ?>_customer_age" value="<?php echo HtmlEncode($assessments_grid->customer_age->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_customer_age" name="o<?php echo $assessments_grid->RowIndex ?>_customer_age" id="o<?php echo $assessments_grid->RowIndex ?>_customer_age" value="<?php echo HtmlEncode($assessments_grid->customer_age->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_customer_age" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_customer_age" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_customer_age" value="<?php echo HtmlEncode($assessments_grid->customer_age->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_customer_age" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_customer_age" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_customer_age" value="<?php echo HtmlEncode($assessments_grid->customer_age->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->sex->Visible) { // sex ?>
		<td data-name="sex" <?php echo $assessments_grid->sex->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_sex" class="form-group">
<input type="text" data-table="assessments" data-field="x_sex" name="x<?php echo $assessments_grid->RowIndex ?>_sex" id="x<?php echo $assessments_grid->RowIndex ?>_sex" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($assessments_grid->sex->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->sex->EditValue ?>"<?php echo $assessments_grid->sex->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_sex" name="o<?php echo $assessments_grid->RowIndex ?>_sex" id="o<?php echo $assessments_grid->RowIndex ?>_sex" value="<?php echo HtmlEncode($assessments_grid->sex->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_sex" class="form-group">
<input type="text" data-table="assessments" data-field="x_sex" name="x<?php echo $assessments_grid->RowIndex ?>_sex" id="x<?php echo $assessments_grid->RowIndex ?>_sex" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($assessments_grid->sex->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->sex->EditValue ?>"<?php echo $assessments_grid->sex->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_sex">
<span<?php echo $assessments_grid->sex->viewAttributes() ?>><?php echo $assessments_grid->sex->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_sex" name="x<?php echo $assessments_grid->RowIndex ?>_sex" id="x<?php echo $assessments_grid->RowIndex ?>_sex" value="<?php echo HtmlEncode($assessments_grid->sex->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_sex" name="o<?php echo $assessments_grid->RowIndex ?>_sex" id="o<?php echo $assessments_grid->RowIndex ?>_sex" value="<?php echo HtmlEncode($assessments_grid->sex->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_sex" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_sex" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_sex" value="<?php echo HtmlEncode($assessments_grid->sex->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_sex" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_sex" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_sex" value="<?php echo HtmlEncode($assessments_grid->sex->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->address->Visible) { // address ?>
		<td data-name="address" <?php echo $assessments_grid->address->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_address" class="form-group">
<input type="text" data-table="assessments" data-field="x_address" name="x<?php echo $assessments_grid->RowIndex ?>_address" id="x<?php echo $assessments_grid->RowIndex ?>_address" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_grid->address->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->address->EditValue ?>"<?php echo $assessments_grid->address->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_address" name="o<?php echo $assessments_grid->RowIndex ?>_address" id="o<?php echo $assessments_grid->RowIndex ?>_address" value="<?php echo HtmlEncode($assessments_grid->address->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_address" class="form-group">
<input type="text" data-table="assessments" data-field="x_address" name="x<?php echo $assessments_grid->RowIndex ?>_address" id="x<?php echo $assessments_grid->RowIndex ?>_address" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_grid->address->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->address->EditValue ?>"<?php echo $assessments_grid->address->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_address">
<span<?php echo $assessments_grid->address->viewAttributes() ?>><?php echo $assessments_grid->address->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_address" name="x<?php echo $assessments_grid->RowIndex ?>_address" id="x<?php echo $assessments_grid->RowIndex ?>_address" value="<?php echo HtmlEncode($assessments_grid->address->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_address" name="o<?php echo $assessments_grid->RowIndex ?>_address" id="o<?php echo $assessments_grid->RowIndex ?>_address" value="<?php echo HtmlEncode($assessments_grid->address->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_address" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_address" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_address" value="<?php echo HtmlEncode($assessments_grid->address->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_address" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_address" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_address" value="<?php echo HtmlEncode($assessments_grid->address->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->total_score->Visible) { // total_score ?>
		<td data-name="total_score" <?php echo $assessments_grid->total_score->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_total_score" class="form-group">
<input type="text" data-table="assessments" data-field="x_total_score" name="x<?php echo $assessments_grid->RowIndex ?>_total_score" id="x<?php echo $assessments_grid->RowIndex ?>_total_score" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->total_score->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->total_score->EditValue ?>"<?php echo $assessments_grid->total_score->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_total_score" name="o<?php echo $assessments_grid->RowIndex ?>_total_score" id="o<?php echo $assessments_grid->RowIndex ?>_total_score" value="<?php echo HtmlEncode($assessments_grid->total_score->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_total_score" class="form-group">
<input type="text" data-table="assessments" data-field="x_total_score" name="x<?php echo $assessments_grid->RowIndex ?>_total_score" id="x<?php echo $assessments_grid->RowIndex ?>_total_score" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->total_score->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->total_score->EditValue ?>"<?php echo $assessments_grid->total_score->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_total_score">
<span<?php echo $assessments_grid->total_score->viewAttributes() ?>><?php echo $assessments_grid->total_score->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_total_score" name="x<?php echo $assessments_grid->RowIndex ?>_total_score" id="x<?php echo $assessments_grid->RowIndex ?>_total_score" value="<?php echo HtmlEncode($assessments_grid->total_score->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_total_score" name="o<?php echo $assessments_grid->RowIndex ?>_total_score" id="o<?php echo $assessments_grid->RowIndex ?>_total_score" value="<?php echo HtmlEncode($assessments_grid->total_score->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_total_score" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_total_score" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_total_score" value="<?php echo HtmlEncode($assessments_grid->total_score->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_total_score" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_total_score" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_total_score" value="<?php echo HtmlEncode($assessments_grid->total_score->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->status->Visible) { // status ?>
		<td data-name="status" <?php echo $assessments_grid->status->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_status" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="assessments" data-field="x_status" data-value-separator="<?php echo $assessments_grid->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $assessments_grid->RowIndex ?>_status" name="x<?php echo $assessments_grid->RowIndex ?>_status"<?php echo $assessments_grid->status->editAttributes() ?>>
			<?php echo $assessments_grid->status->selectOptionListHtml("x{$assessments_grid->RowIndex}_status") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="assessments" data-field="x_status" name="o<?php echo $assessments_grid->RowIndex ?>_status" id="o<?php echo $assessments_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($assessments_grid->status->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_status" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="assessments" data-field="x_status" data-value-separator="<?php echo $assessments_grid->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $assessments_grid->RowIndex ?>_status" name="x<?php echo $assessments_grid->RowIndex ?>_status"<?php echo $assessments_grid->status->editAttributes() ?>>
			<?php echo $assessments_grid->status->selectOptionListHtml("x{$assessments_grid->RowIndex}_status") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_status">
<span<?php echo $assessments_grid->status->viewAttributes() ?>><?php echo $assessments_grid->status->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_status" name="x<?php echo $assessments_grid->RowIndex ?>_status" id="x<?php echo $assessments_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($assessments_grid->status->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_status" name="o<?php echo $assessments_grid->RowIndex ?>_status" id="o<?php echo $assessments_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($assessments_grid->status->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_status" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_status" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($assessments_grid->status->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_status" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_status" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($assessments_grid->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->loan_purpose->Visible) { // loan_purpose ?>
		<td data-name="loan_purpose" <?php echo $assessments_grid->loan_purpose->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($assessments_grid->loan_purpose->getSessionValue() != "") { ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_loan_purpose" class="form-group">
<span<?php echo $assessments_grid->loan_purpose->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->loan_purpose->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" name="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_loan_purpose" class="form-group">
<?php
$onchange = $assessments_grid->loan_purpose->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_grid->loan_purpose->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $assessments_grid->RowIndex ?>_loan_purpose">
	<input type="text" class="form-control" name="sv_x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="sv_x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo RemoveHtml($assessments_grid->loan_purpose->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->loan_purpose->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_grid->loan_purpose->getPlaceHolder()) ?>"<?php echo $assessments_grid->loan_purpose->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_loan_purpose" data-value-separator="<?php echo $assessments_grid->loan_purpose->displayValueSeparatorAttribute() ?>" name="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentsgrid"], function() {
	fassessmentsgrid.createAutoSuggest({"id":"x<?php echo $assessments_grid->RowIndex ?>_loan_purpose","forceSelect":false});
});
</script>
<?php echo $assessments_grid->loan_purpose->Lookup->getParamTag($assessments_grid, "p_x" . $assessments_grid->RowIndex . "_loan_purpose") ?>
</span>
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_loan_purpose" name="o<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="o<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($assessments_grid->loan_purpose->getSessionValue() != "") { ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_loan_purpose" class="form-group">
<span<?php echo $assessments_grid->loan_purpose->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->loan_purpose->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" name="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_loan_purpose" class="form-group">
<?php
$onchange = $assessments_grid->loan_purpose->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_grid->loan_purpose->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $assessments_grid->RowIndex ?>_loan_purpose">
	<input type="text" class="form-control" name="sv_x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="sv_x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo RemoveHtml($assessments_grid->loan_purpose->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->loan_purpose->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_grid->loan_purpose->getPlaceHolder()) ?>"<?php echo $assessments_grid->loan_purpose->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_loan_purpose" data-value-separator="<?php echo $assessments_grid->loan_purpose->displayValueSeparatorAttribute() ?>" name="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentsgrid"], function() {
	fassessmentsgrid.createAutoSuggest({"id":"x<?php echo $assessments_grid->RowIndex ?>_loan_purpose","forceSelect":false});
});
</script>
<?php echo $assessments_grid->loan_purpose->Lookup->getParamTag($assessments_grid, "p_x" . $assessments_grid->RowIndex . "_loan_purpose") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_loan_purpose">
<span<?php echo $assessments_grid->loan_purpose->viewAttributes() ?>><?php echo $assessments_grid->loan_purpose->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_loan_purpose" name="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_loan_purpose" name="o<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="o<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_loan_purpose" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_loan_purpose" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->loan_section->Visible) { // loan_section ?>
		<td data-name="loan_section" <?php echo $assessments_grid->loan_section->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($assessments_grid->loan_section->getSessionValue() != "") { ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_loan_section" class="form-group">
<span<?php echo $assessments_grid->loan_section->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->loan_section->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $assessments_grid->RowIndex ?>_loan_section" name="x<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_loan_section" class="form-group">
<?php
$onchange = $assessments_grid->loan_section->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_grid->loan_section->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $assessments_grid->RowIndex ?>_loan_section">
	<input type="text" class="form-control" name="sv_x<?php echo $assessments_grid->RowIndex ?>_loan_section" id="sv_x<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo RemoveHtml($assessments_grid->loan_section->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->loan_section->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_grid->loan_section->getPlaceHolder()) ?>"<?php echo $assessments_grid->loan_section->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_loan_section" data-value-separator="<?php echo $assessments_grid->loan_section->displayValueSeparatorAttribute() ?>" name="x<?php echo $assessments_grid->RowIndex ?>_loan_section" id="x<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentsgrid"], function() {
	fassessmentsgrid.createAutoSuggest({"id":"x<?php echo $assessments_grid->RowIndex ?>_loan_section","forceSelect":false});
});
</script>
<?php echo $assessments_grid->loan_section->Lookup->getParamTag($assessments_grid, "p_x" . $assessments_grid->RowIndex . "_loan_section") ?>
</span>
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_loan_section" name="o<?php echo $assessments_grid->RowIndex ?>_loan_section" id="o<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($assessments_grid->loan_section->getSessionValue() != "") { ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_loan_section" class="form-group">
<span<?php echo $assessments_grid->loan_section->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->loan_section->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $assessments_grid->RowIndex ?>_loan_section" name="x<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_loan_section" class="form-group">
<?php
$onchange = $assessments_grid->loan_section->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_grid->loan_section->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $assessments_grid->RowIndex ?>_loan_section">
	<input type="text" class="form-control" name="sv_x<?php echo $assessments_grid->RowIndex ?>_loan_section" id="sv_x<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo RemoveHtml($assessments_grid->loan_section->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->loan_section->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_grid->loan_section->getPlaceHolder()) ?>"<?php echo $assessments_grid->loan_section->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_loan_section" data-value-separator="<?php echo $assessments_grid->loan_section->displayValueSeparatorAttribute() ?>" name="x<?php echo $assessments_grid->RowIndex ?>_loan_section" id="x<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentsgrid"], function() {
	fassessmentsgrid.createAutoSuggest({"id":"x<?php echo $assessments_grid->RowIndex ?>_loan_section","forceSelect":false});
});
</script>
<?php echo $assessments_grid->loan_section->Lookup->getParamTag($assessments_grid, "p_x" . $assessments_grid->RowIndex . "_loan_section") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_loan_section">
<span<?php echo $assessments_grid->loan_section->viewAttributes() ?>><?php echo $assessments_grid->loan_section->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_loan_section" name="x<?php echo $assessments_grid->RowIndex ?>_loan_section" id="x<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_loan_section" name="o<?php echo $assessments_grid->RowIndex ?>_loan_section" id="o<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_loan_section" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_loan_section" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_loan_section" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_loan_section" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->lat->Visible) { // lat ?>
		<td data-name="lat" <?php echo $assessments_grid->lat->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_lat" class="form-group">
<input type="text" data-table="assessments" data-field="x_lat" name="x<?php echo $assessments_grid->RowIndex ?>_lat" id="x<?php echo $assessments_grid->RowIndex ?>_lat" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->lat->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->lat->EditValue ?>"<?php echo $assessments_grid->lat->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_lat" name="o<?php echo $assessments_grid->RowIndex ?>_lat" id="o<?php echo $assessments_grid->RowIndex ?>_lat" value="<?php echo HtmlEncode($assessments_grid->lat->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_lat" class="form-group">
<input type="text" data-table="assessments" data-field="x_lat" name="x<?php echo $assessments_grid->RowIndex ?>_lat" id="x<?php echo $assessments_grid->RowIndex ?>_lat" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->lat->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->lat->EditValue ?>"<?php echo $assessments_grid->lat->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_lat">
<span<?php echo $assessments_grid->lat->viewAttributes() ?>><?php echo $assessments_grid->lat->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_lat" name="x<?php echo $assessments_grid->RowIndex ?>_lat" id="x<?php echo $assessments_grid->RowIndex ?>_lat" value="<?php echo HtmlEncode($assessments_grid->lat->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_lat" name="o<?php echo $assessments_grid->RowIndex ?>_lat" id="o<?php echo $assessments_grid->RowIndex ?>_lat" value="<?php echo HtmlEncode($assessments_grid->lat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_lat" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_lat" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_lat" value="<?php echo HtmlEncode($assessments_grid->lat->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_lat" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_lat" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_lat" value="<?php echo HtmlEncode($assessments_grid->lat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->lon->Visible) { // lon ?>
		<td data-name="lon" <?php echo $assessments_grid->lon->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_lon" class="form-group">
<input type="text" data-table="assessments" data-field="x_lon" name="x<?php echo $assessments_grid->RowIndex ?>_lon" id="x<?php echo $assessments_grid->RowIndex ?>_lon" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->lon->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->lon->EditValue ?>"<?php echo $assessments_grid->lon->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_lon" name="o<?php echo $assessments_grid->RowIndex ?>_lon" id="o<?php echo $assessments_grid->RowIndex ?>_lon" value="<?php echo HtmlEncode($assessments_grid->lon->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_lon" class="form-group">
<input type="text" data-table="assessments" data-field="x_lon" name="x<?php echo $assessments_grid->RowIndex ?>_lon" id="x<?php echo $assessments_grid->RowIndex ?>_lon" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->lon->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->lon->EditValue ?>"<?php echo $assessments_grid->lon->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_lon">
<span<?php echo $assessments_grid->lon->viewAttributes() ?>><?php echo $assessments_grid->lon->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_lon" name="x<?php echo $assessments_grid->RowIndex ?>_lon" id="x<?php echo $assessments_grid->RowIndex ?>_lon" value="<?php echo HtmlEncode($assessments_grid->lon->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_lon" name="o<?php echo $assessments_grid->RowIndex ?>_lon" id="o<?php echo $assessments_grid->RowIndex ?>_lon" value="<?php echo HtmlEncode($assessments_grid->lon->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_lon" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_lon" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_lon" value="<?php echo HtmlEncode($assessments_grid->lon->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_lon" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_lon" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_lon" value="<?php echo HtmlEncode($assessments_grid->lon->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $assessments_grid->created_at->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_created_at" class="form-group">
<input type="text" data-table="assessments" data-field="x_created_at" name="x<?php echo $assessments_grid->RowIndex ?>_created_at" id="x<?php echo $assessments_grid->RowIndex ?>_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($assessments_grid->created_at->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->created_at->EditValue ?>"<?php echo $assessments_grid->created_at->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_created_at" name="o<?php echo $assessments_grid->RowIndex ?>_created_at" id="o<?php echo $assessments_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($assessments_grid->created_at->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_created_at" class="form-group">
<input type="text" data-table="assessments" data-field="x_created_at" name="x<?php echo $assessments_grid->RowIndex ?>_created_at" id="x<?php echo $assessments_grid->RowIndex ?>_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($assessments_grid->created_at->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->created_at->EditValue ?>"<?php echo $assessments_grid->created_at->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_created_at">
<span<?php echo $assessments_grid->created_at->viewAttributes() ?>><?php echo $assessments_grid->created_at->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_created_at" name="x<?php echo $assessments_grid->RowIndex ?>_created_at" id="x<?php echo $assessments_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($assessments_grid->created_at->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_created_at" name="o<?php echo $assessments_grid->RowIndex ?>_created_at" id="o<?php echo $assessments_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($assessments_grid->created_at->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_created_at" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_created_at" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($assessments_grid->created_at->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_created_at" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_created_at" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($assessments_grid->created_at->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($assessments_grid->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $assessments_grid->updated_at->cellAttributes() ?>>
<?php if ($assessments->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_updated_at" class="form-group">
<input type="text" data-table="assessments" data-field="x_updated_at" name="x<?php echo $assessments_grid->RowIndex ?>_updated_at" id="x<?php echo $assessments_grid->RowIndex ?>_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($assessments_grid->updated_at->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->updated_at->EditValue ?>"<?php echo $assessments_grid->updated_at->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_updated_at" name="o<?php echo $assessments_grid->RowIndex ?>_updated_at" id="o<?php echo $assessments_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($assessments_grid->updated_at->OldValue) ?>">
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_updated_at" class="form-group">
<input type="text" data-table="assessments" data-field="x_updated_at" name="x<?php echo $assessments_grid->RowIndex ?>_updated_at" id="x<?php echo $assessments_grid->RowIndex ?>_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($assessments_grid->updated_at->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->updated_at->EditValue ?>"<?php echo $assessments_grid->updated_at->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($assessments->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $assessments_grid->RowCount ?>_assessments_updated_at">
<span<?php echo $assessments_grid->updated_at->viewAttributes() ?>><?php echo $assessments_grid->updated_at->getViewValue() ?></span>
</span>
<?php if (!$assessments->isConfirm()) { ?>
<input type="hidden" data-table="assessments" data-field="x_updated_at" name="x<?php echo $assessments_grid->RowIndex ?>_updated_at" id="x<?php echo $assessments_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($assessments_grid->updated_at->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_updated_at" name="o<?php echo $assessments_grid->RowIndex ?>_updated_at" id="o<?php echo $assessments_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($assessments_grid->updated_at->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="assessments" data-field="x_updated_at" name="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_updated_at" id="fassessmentsgrid$x<?php echo $assessments_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($assessments_grid->updated_at->FormValue) ?>">
<input type="hidden" data-table="assessments" data-field="x_updated_at" name="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_updated_at" id="fassessmentsgrid$o<?php echo $assessments_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($assessments_grid->updated_at->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$assessments_grid->ListOptions->render("body", "right", $assessments_grid->RowCount);
?>
	</tr>
<?php if ($assessments->RowType == ROWTYPE_ADD || $assessments->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fassessmentsgrid", "load"], function() {
	fassessmentsgrid.updateLists(<?php echo $assessments_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$assessments_grid->isGridAdd() || $assessments->CurrentMode == "copy")
		if (!$assessments_grid->Recordset->EOF)
			$assessments_grid->Recordset->moveNext();
}
?>
<?php
	if ($assessments->CurrentMode == "add" || $assessments->CurrentMode == "copy" || $assessments->CurrentMode == "edit") {
		$assessments_grid->RowIndex = '$rowindex$';
		$assessments_grid->loadRowValues();

		// Set row properties
		$assessments->resetAttributes();
		$assessments->RowAttrs->merge(["data-rowindex" => $assessments_grid->RowIndex, "id" => "r0_assessments", "data-rowtype" => ROWTYPE_ADD]);
		$assessments->RowAttrs->appendClass("ew-template");
		$assessments->RowType = ROWTYPE_ADD;

		// Render row
		$assessments_grid->renderRow();

		// Render list options
		$assessments_grid->renderListOptions();
		$assessments_grid->StartRowCount = 0;
?>
	<tr <?php echo $assessments->rowAttributes() ?>>
<?php

// Render list options (body, left)
$assessments_grid->ListOptions->render("body", "left", $assessments_grid->RowIndex);
?>
	<?php if ($assessments_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$assessments->isConfirm()) { ?>
<span id="el$rowindex$_assessments_id" class="form-group assessments_id"></span>
<?php } else { ?>
<span id="el$rowindex$_assessments_id" class="form-group assessments_id">
<span<?php echo $assessments_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_id" name="x<?php echo $assessments_grid->RowIndex ?>_id" id="x<?php echo $assessments_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($assessments_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_id" name="o<?php echo $assessments_grid->RowIndex ?>_id" id="o<?php echo $assessments_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($assessments_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<?php if (!$assessments->isConfirm()) { ?>
<?php if ($assessments_grid->user_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_assessments_user_id" class="form-group assessments_user_id">
<span<?php echo $assessments_grid->user_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->user_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $assessments_grid->RowIndex ?>_user_id" name="x<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_assessments_user_id" class="form-group assessments_user_id">
<?php
$onchange = $assessments_grid->user_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_grid->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $assessments_grid->RowIndex ?>_user_id">
	<input type="text" class="form-control" name="sv_x<?php echo $assessments_grid->RowIndex ?>_user_id" id="sv_x<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo RemoveHtml($assessments_grid->user_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($assessments_grid->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_grid->user_id->getPlaceHolder()) ?>"<?php echo $assessments_grid->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_user_id" data-value-separator="<?php echo $assessments_grid->user_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $assessments_grid->RowIndex ?>_user_id" id="x<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentsgrid"], function() {
	fassessmentsgrid.createAutoSuggest({"id":"x<?php echo $assessments_grid->RowIndex ?>_user_id","forceSelect":false});
});
</script>
<?php echo $assessments_grid->user_id->Lookup->getParamTag($assessments_grid, "p_x" . $assessments_grid->RowIndex . "_user_id") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_assessments_user_id" class="form-group assessments_user_id">
<span<?php echo $assessments_grid->user_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->user_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_user_id" name="x<?php echo $assessments_grid->RowIndex ?>_user_id" id="x<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_user_id" name="o<?php echo $assessments_grid->RowIndex ?>_user_id" id="o<?php echo $assessments_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($assessments_grid->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->customer_id->Visible) { // customer_id ?>
		<td data-name="customer_id">
<?php if (!$assessments->isConfirm()) { ?>
<span id="el$rowindex$_assessments_customer_id" class="form-group assessments_customer_id">
<input type="text" data-table="assessments" data-field="x_customer_id" name="x<?php echo $assessments_grid->RowIndex ?>_customer_id" id="x<?php echo $assessments_grid->RowIndex ?>_customer_id" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_grid->customer_id->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->customer_id->EditValue ?>"<?php echo $assessments_grid->customer_id->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_assessments_customer_id" class="form-group assessments_customer_id">
<span<?php echo $assessments_grid->customer_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->customer_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_customer_id" name="x<?php echo $assessments_grid->RowIndex ?>_customer_id" id="x<?php echo $assessments_grid->RowIndex ?>_customer_id" value="<?php echo HtmlEncode($assessments_grid->customer_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_customer_id" name="o<?php echo $assessments_grid->RowIndex ?>_customer_id" id="o<?php echo $assessments_grid->RowIndex ?>_customer_id" value="<?php echo HtmlEncode($assessments_grid->customer_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->customer_first_name->Visible) { // customer_first_name ?>
		<td data-name="customer_first_name">
<?php if (!$assessments->isConfirm()) { ?>
<span id="el$rowindex$_assessments_customer_first_name" class="form-group assessments_customer_first_name">
<input type="text" data-table="assessments" data-field="x_customer_first_name" name="x<?php echo $assessments_grid->RowIndex ?>_customer_first_name" id="x<?php echo $assessments_grid->RowIndex ?>_customer_first_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_grid->customer_first_name->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->customer_first_name->EditValue ?>"<?php echo $assessments_grid->customer_first_name->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_assessments_customer_first_name" class="form-group assessments_customer_first_name">
<span<?php echo $assessments_grid->customer_first_name->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->customer_first_name->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_customer_first_name" name="x<?php echo $assessments_grid->RowIndex ?>_customer_first_name" id="x<?php echo $assessments_grid->RowIndex ?>_customer_first_name" value="<?php echo HtmlEncode($assessments_grid->customer_first_name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_customer_first_name" name="o<?php echo $assessments_grid->RowIndex ?>_customer_first_name" id="o<?php echo $assessments_grid->RowIndex ?>_customer_first_name" value="<?php echo HtmlEncode($assessments_grid->customer_first_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->customer_age->Visible) { // customer_age ?>
		<td data-name="customer_age">
<?php if (!$assessments->isConfirm()) { ?>
<span id="el$rowindex$_assessments_customer_age" class="form-group assessments_customer_age">
<input type="text" data-table="assessments" data-field="x_customer_age" name="x<?php echo $assessments_grid->RowIndex ?>_customer_age" id="x<?php echo $assessments_grid->RowIndex ?>_customer_age" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($assessments_grid->customer_age->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->customer_age->EditValue ?>"<?php echo $assessments_grid->customer_age->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_assessments_customer_age" class="form-group assessments_customer_age">
<span<?php echo $assessments_grid->customer_age->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->customer_age->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_customer_age" name="x<?php echo $assessments_grid->RowIndex ?>_customer_age" id="x<?php echo $assessments_grid->RowIndex ?>_customer_age" value="<?php echo HtmlEncode($assessments_grid->customer_age->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_customer_age" name="o<?php echo $assessments_grid->RowIndex ?>_customer_age" id="o<?php echo $assessments_grid->RowIndex ?>_customer_age" value="<?php echo HtmlEncode($assessments_grid->customer_age->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->sex->Visible) { // sex ?>
		<td data-name="sex">
<?php if (!$assessments->isConfirm()) { ?>
<span id="el$rowindex$_assessments_sex" class="form-group assessments_sex">
<input type="text" data-table="assessments" data-field="x_sex" name="x<?php echo $assessments_grid->RowIndex ?>_sex" id="x<?php echo $assessments_grid->RowIndex ?>_sex" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($assessments_grid->sex->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->sex->EditValue ?>"<?php echo $assessments_grid->sex->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_assessments_sex" class="form-group assessments_sex">
<span<?php echo $assessments_grid->sex->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->sex->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_sex" name="x<?php echo $assessments_grid->RowIndex ?>_sex" id="x<?php echo $assessments_grid->RowIndex ?>_sex" value="<?php echo HtmlEncode($assessments_grid->sex->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_sex" name="o<?php echo $assessments_grid->RowIndex ?>_sex" id="o<?php echo $assessments_grid->RowIndex ?>_sex" value="<?php echo HtmlEncode($assessments_grid->sex->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->address->Visible) { // address ?>
		<td data-name="address">
<?php if (!$assessments->isConfirm()) { ?>
<span id="el$rowindex$_assessments_address" class="form-group assessments_address">
<input type="text" data-table="assessments" data-field="x_address" name="x<?php echo $assessments_grid->RowIndex ?>_address" id="x<?php echo $assessments_grid->RowIndex ?>_address" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_grid->address->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->address->EditValue ?>"<?php echo $assessments_grid->address->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_assessments_address" class="form-group assessments_address">
<span<?php echo $assessments_grid->address->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->address->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_address" name="x<?php echo $assessments_grid->RowIndex ?>_address" id="x<?php echo $assessments_grid->RowIndex ?>_address" value="<?php echo HtmlEncode($assessments_grid->address->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_address" name="o<?php echo $assessments_grid->RowIndex ?>_address" id="o<?php echo $assessments_grid->RowIndex ?>_address" value="<?php echo HtmlEncode($assessments_grid->address->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->total_score->Visible) { // total_score ?>
		<td data-name="total_score">
<?php if (!$assessments->isConfirm()) { ?>
<span id="el$rowindex$_assessments_total_score" class="form-group assessments_total_score">
<input type="text" data-table="assessments" data-field="x_total_score" name="x<?php echo $assessments_grid->RowIndex ?>_total_score" id="x<?php echo $assessments_grid->RowIndex ?>_total_score" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->total_score->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->total_score->EditValue ?>"<?php echo $assessments_grid->total_score->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_assessments_total_score" class="form-group assessments_total_score">
<span<?php echo $assessments_grid->total_score->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->total_score->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_total_score" name="x<?php echo $assessments_grid->RowIndex ?>_total_score" id="x<?php echo $assessments_grid->RowIndex ?>_total_score" value="<?php echo HtmlEncode($assessments_grid->total_score->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_total_score" name="o<?php echo $assessments_grid->RowIndex ?>_total_score" id="o<?php echo $assessments_grid->RowIndex ?>_total_score" value="<?php echo HtmlEncode($assessments_grid->total_score->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->status->Visible) { // status ?>
		<td data-name="status">
<?php if (!$assessments->isConfirm()) { ?>
<span id="el$rowindex$_assessments_status" class="form-group assessments_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="assessments" data-field="x_status" data-value-separator="<?php echo $assessments_grid->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $assessments_grid->RowIndex ?>_status" name="x<?php echo $assessments_grid->RowIndex ?>_status"<?php echo $assessments_grid->status->editAttributes() ?>>
			<?php echo $assessments_grid->status->selectOptionListHtml("x{$assessments_grid->RowIndex}_status") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_assessments_status" class="form-group assessments_status">
<span<?php echo $assessments_grid->status->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->status->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_status" name="x<?php echo $assessments_grid->RowIndex ?>_status" id="x<?php echo $assessments_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($assessments_grid->status->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_status" name="o<?php echo $assessments_grid->RowIndex ?>_status" id="o<?php echo $assessments_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($assessments_grid->status->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->loan_purpose->Visible) { // loan_purpose ?>
		<td data-name="loan_purpose">
<?php if (!$assessments->isConfirm()) { ?>
<?php if ($assessments_grid->loan_purpose->getSessionValue() != "") { ?>
<span id="el$rowindex$_assessments_loan_purpose" class="form-group assessments_loan_purpose">
<span<?php echo $assessments_grid->loan_purpose->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->loan_purpose->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" name="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_assessments_loan_purpose" class="form-group assessments_loan_purpose">
<?php
$onchange = $assessments_grid->loan_purpose->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_grid->loan_purpose->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $assessments_grid->RowIndex ?>_loan_purpose">
	<input type="text" class="form-control" name="sv_x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="sv_x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo RemoveHtml($assessments_grid->loan_purpose->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->loan_purpose->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_grid->loan_purpose->getPlaceHolder()) ?>"<?php echo $assessments_grid->loan_purpose->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_loan_purpose" data-value-separator="<?php echo $assessments_grid->loan_purpose->displayValueSeparatorAttribute() ?>" name="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentsgrid"], function() {
	fassessmentsgrid.createAutoSuggest({"id":"x<?php echo $assessments_grid->RowIndex ?>_loan_purpose","forceSelect":false});
});
</script>
<?php echo $assessments_grid->loan_purpose->Lookup->getParamTag($assessments_grid, "p_x" . $assessments_grid->RowIndex . "_loan_purpose") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_assessments_loan_purpose" class="form-group assessments_loan_purpose">
<span<?php echo $assessments_grid->loan_purpose->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->loan_purpose->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_loan_purpose" name="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="x<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_loan_purpose" name="o<?php echo $assessments_grid->RowIndex ?>_loan_purpose" id="o<?php echo $assessments_grid->RowIndex ?>_loan_purpose" value="<?php echo HtmlEncode($assessments_grid->loan_purpose->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->loan_section->Visible) { // loan_section ?>
		<td data-name="loan_section">
<?php if (!$assessments->isConfirm()) { ?>
<?php if ($assessments_grid->loan_section->getSessionValue() != "") { ?>
<span id="el$rowindex$_assessments_loan_section" class="form-group assessments_loan_section">
<span<?php echo $assessments_grid->loan_section->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->loan_section->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $assessments_grid->RowIndex ?>_loan_section" name="x<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_assessments_loan_section" class="form-group assessments_loan_section">
<?php
$onchange = $assessments_grid->loan_section->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_grid->loan_section->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $assessments_grid->RowIndex ?>_loan_section">
	<input type="text" class="form-control" name="sv_x<?php echo $assessments_grid->RowIndex ?>_loan_section" id="sv_x<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo RemoveHtml($assessments_grid->loan_section->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->loan_section->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_grid->loan_section->getPlaceHolder()) ?>"<?php echo $assessments_grid->loan_section->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_loan_section" data-value-separator="<?php echo $assessments_grid->loan_section->displayValueSeparatorAttribute() ?>" name="x<?php echo $assessments_grid->RowIndex ?>_loan_section" id="x<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentsgrid"], function() {
	fassessmentsgrid.createAutoSuggest({"id":"x<?php echo $assessments_grid->RowIndex ?>_loan_section","forceSelect":false});
});
</script>
<?php echo $assessments_grid->loan_section->Lookup->getParamTag($assessments_grid, "p_x" . $assessments_grid->RowIndex . "_loan_section") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_assessments_loan_section" class="form-group assessments_loan_section">
<span<?php echo $assessments_grid->loan_section->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->loan_section->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_loan_section" name="x<?php echo $assessments_grid->RowIndex ?>_loan_section" id="x<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_loan_section" name="o<?php echo $assessments_grid->RowIndex ?>_loan_section" id="o<?php echo $assessments_grid->RowIndex ?>_loan_section" value="<?php echo HtmlEncode($assessments_grid->loan_section->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->lat->Visible) { // lat ?>
		<td data-name="lat">
<?php if (!$assessments->isConfirm()) { ?>
<span id="el$rowindex$_assessments_lat" class="form-group assessments_lat">
<input type="text" data-table="assessments" data-field="x_lat" name="x<?php echo $assessments_grid->RowIndex ?>_lat" id="x<?php echo $assessments_grid->RowIndex ?>_lat" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->lat->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->lat->EditValue ?>"<?php echo $assessments_grid->lat->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_assessments_lat" class="form-group assessments_lat">
<span<?php echo $assessments_grid->lat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->lat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_lat" name="x<?php echo $assessments_grid->RowIndex ?>_lat" id="x<?php echo $assessments_grid->RowIndex ?>_lat" value="<?php echo HtmlEncode($assessments_grid->lat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_lat" name="o<?php echo $assessments_grid->RowIndex ?>_lat" id="o<?php echo $assessments_grid->RowIndex ?>_lat" value="<?php echo HtmlEncode($assessments_grid->lat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->lon->Visible) { // lon ?>
		<td data-name="lon">
<?php if (!$assessments->isConfirm()) { ?>
<span id="el$rowindex$_assessments_lon" class="form-group assessments_lon">
<input type="text" data-table="assessments" data-field="x_lon" name="x<?php echo $assessments_grid->RowIndex ?>_lon" id="x<?php echo $assessments_grid->RowIndex ?>_lon" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_grid->lon->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->lon->EditValue ?>"<?php echo $assessments_grid->lon->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_assessments_lon" class="form-group assessments_lon">
<span<?php echo $assessments_grid->lon->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->lon->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_lon" name="x<?php echo $assessments_grid->RowIndex ?>_lon" id="x<?php echo $assessments_grid->RowIndex ?>_lon" value="<?php echo HtmlEncode($assessments_grid->lon->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_lon" name="o<?php echo $assessments_grid->RowIndex ?>_lon" id="o<?php echo $assessments_grid->RowIndex ?>_lon" value="<?php echo HtmlEncode($assessments_grid->lon->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->created_at->Visible) { // created_at ?>
		<td data-name="created_at">
<?php if (!$assessments->isConfirm()) { ?>
<span id="el$rowindex$_assessments_created_at" class="form-group assessments_created_at">
<input type="text" data-table="assessments" data-field="x_created_at" name="x<?php echo $assessments_grid->RowIndex ?>_created_at" id="x<?php echo $assessments_grid->RowIndex ?>_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($assessments_grid->created_at->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->created_at->EditValue ?>"<?php echo $assessments_grid->created_at->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_assessments_created_at" class="form-group assessments_created_at">
<span<?php echo $assessments_grid->created_at->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->created_at->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_created_at" name="x<?php echo $assessments_grid->RowIndex ?>_created_at" id="x<?php echo $assessments_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($assessments_grid->created_at->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_created_at" name="o<?php echo $assessments_grid->RowIndex ?>_created_at" id="o<?php echo $assessments_grid->RowIndex ?>_created_at" value="<?php echo HtmlEncode($assessments_grid->created_at->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($assessments_grid->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at">
<?php if (!$assessments->isConfirm()) { ?>
<span id="el$rowindex$_assessments_updated_at" class="form-group assessments_updated_at">
<input type="text" data-table="assessments" data-field="x_updated_at" name="x<?php echo $assessments_grid->RowIndex ?>_updated_at" id="x<?php echo $assessments_grid->RowIndex ?>_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($assessments_grid->updated_at->getPlaceHolder()) ?>" value="<?php echo $assessments_grid->updated_at->EditValue ?>"<?php echo $assessments_grid->updated_at->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_assessments_updated_at" class="form-group assessments_updated_at">
<span<?php echo $assessments_grid->updated_at->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_grid->updated_at->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="assessments" data-field="x_updated_at" name="x<?php echo $assessments_grid->RowIndex ?>_updated_at" id="x<?php echo $assessments_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($assessments_grid->updated_at->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="assessments" data-field="x_updated_at" name="o<?php echo $assessments_grid->RowIndex ?>_updated_at" id="o<?php echo $assessments_grid->RowIndex ?>_updated_at" value="<?php echo HtmlEncode($assessments_grid->updated_at->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$assessments_grid->ListOptions->render("body", "right", $assessments_grid->RowIndex);
?>
<script>
loadjs.ready(["fassessmentsgrid", "load"], function() {
	fassessmentsgrid.updateLists(<?php echo $assessments_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($assessments->CurrentMode == "add" || $assessments->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $assessments_grid->FormKeyCountName ?>" id="<?php echo $assessments_grid->FormKeyCountName ?>" value="<?php echo $assessments_grid->KeyCount ?>">
<?php echo $assessments_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($assessments->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $assessments_grid->FormKeyCountName ?>" id="<?php echo $assessments_grid->FormKeyCountName ?>" value="<?php echo $assessments_grid->KeyCount ?>">
<?php echo $assessments_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($assessments->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fassessmentsgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($assessments_grid->Recordset)
	$assessments_grid->Recordset->Close();
?>
<?php if ($assessments_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $assessments_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($assessments_grid->TotalRecords == 0 && !$assessments->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $assessments_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$assessments_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$assessments_grid->terminate();
?>
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
$questions_list = new questions_list();

// Run the page
$questions_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$questions_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$questions_list->isExport()) { ?>
<script>
var fquestionslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fquestionslist = currentForm = new ew.Form("fquestionslist", "list");
	fquestionslist.formKeyCountName = '<?php echo $questions_list->FormKeyCountName ?>';
	loadjs.done("fquestionslist");
});
var fquestionslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fquestionslistsrch = currentSearchForm = new ew.Form("fquestionslistsrch");

	// Dynamic selection lists
	// Filters

	fquestionslistsrch.filterList = <?php echo $questions_list->getFilterList() ?>;
	loadjs.done("fquestionslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$questions_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($questions_list->TotalRecords > 0 && $questions_list->ExportOptions->visible()) { ?>
<?php $questions_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($questions_list->ImportOptions->visible()) { ?>
<?php $questions_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($questions_list->SearchOptions->visible()) { ?>
<?php $questions_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($questions_list->FilterOptions->visible()) { ?>
<?php $questions_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$questions_list->isExport() || Config("EXPORT_MASTER_RECORD") && $questions_list->isExport("print")) { ?>
<?php
if ($questions_list->DbMasterFilter != "" && $questions->getCurrentMasterTable() == "question_types") {
	if ($questions_list->MasterRecordExists) {
		include_once "question_typesmaster.php";
	}
}
?>
<?php
if ($questions_list->DbMasterFilter != "" && $questions->getCurrentMasterTable() == "sections") {
	if ($questions_list->MasterRecordExists) {
		include_once "sectionsmaster.php";
	}
}
?>
<?php
if ($questions_list->DbMasterFilter != "" && $questions->getCurrentMasterTable() == "question_groups") {
	if ($questions_list->MasterRecordExists) {
		include_once "question_groupsmaster.php";
	}
}
?>
<?php
if ($questions_list->DbMasterFilter != "" && $questions->getCurrentMasterTable() == "question_category") {
	if ($questions_list->MasterRecordExists) {
		include_once "question_categorymaster.php";
	}
}
?>
<?php } ?>
<?php
$questions_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$questions_list->isExport() && !$questions->CurrentAction) { ?>
<form name="fquestionslistsrch" id="fquestionslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fquestionslistsrch-search-panel" class="<?php echo $questions_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="questions">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $questions_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($questions_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($questions_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $questions_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($questions_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($questions_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($questions_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($questions_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $questions_list->showPageHeader(); ?>
<?php
$questions_list->showMessage();
?>
<?php if ($questions_list->TotalRecords > 0 || $questions->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($questions_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> questions">
<?php if (!$questions_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$questions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $questions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $questions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fquestionslist" id="fquestionslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="questions">
<?php if ($questions->getCurrentMasterTable() == "question_types" && $questions->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="question_types">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($questions_list->type->getSessionValue()) ?>">
<?php } ?>
<?php if ($questions->getCurrentMasterTable() == "sections" && $questions->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="sections">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($questions_list->section->getSessionValue()) ?>">
<?php } ?>
<?php if ($questions->getCurrentMasterTable() == "question_groups" && $questions->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="question_groups">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($questions_list->group->getSessionValue()) ?>">
<?php } ?>
<?php if ($questions->getCurrentMasterTable() == "question_category" && $questions->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="question_category">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($questions_list->category->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_questions" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($questions_list->TotalRecords > 0 || $questions_list->isGridEdit()) { ?>
<table id="tbl_questionslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$questions->RowType = ROWTYPE_HEADER;

// Render list options
$questions_list->renderListOptions();

// Render list options (header, left)
$questions_list->ListOptions->render("header", "left");
?>
<?php if ($questions_list->id->Visible) { // id ?>
	<?php if ($questions_list->SortUrl($questions_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $questions_list->id->headerCellClass() ?>"><div id="elh_questions_id" class="questions_id"><div class="ew-table-header-caption"><?php echo $questions_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $questions_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->id) ?>', 1);"><div id="elh_questions_id" class="questions_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->title->Visible) { // title ?>
	<?php if ($questions_list->SortUrl($questions_list->title) == "") { ?>
		<th data-name="title" class="<?php echo $questions_list->title->headerCellClass() ?>"><div id="elh_questions_title" class="questions_title"><div class="ew-table-header-caption"><?php echo $questions_list->title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="title" class="<?php echo $questions_list->title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->title) ?>', 1);"><div id="elh_questions_title" class="questions_title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_list->title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->placeholder->Visible) { // placeholder ?>
	<?php if ($questions_list->SortUrl($questions_list->placeholder) == "") { ?>
		<th data-name="placeholder" class="<?php echo $questions_list->placeholder->headerCellClass() ?>"><div id="elh_questions_placeholder" class="questions_placeholder"><div class="ew-table-header-caption"><?php echo $questions_list->placeholder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="placeholder" class="<?php echo $questions_list->placeholder->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->placeholder) ?>', 1);"><div id="elh_questions_placeholder" class="questions_placeholder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->placeholder->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_list->placeholder->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->placeholder->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->questions->Visible) { // questions ?>
	<?php if ($questions_list->SortUrl($questions_list->questions) == "") { ?>
		<th data-name="questions" class="<?php echo $questions_list->questions->headerCellClass() ?>"><div id="elh_questions_questions" class="questions_questions"><div class="ew-table-header-caption"><?php echo $questions_list->questions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="questions" class="<?php echo $questions_list->questions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->questions) ?>', 1);"><div id="elh_questions_questions" class="questions_questions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->questions->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_list->questions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->questions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->scores->Visible) { // scores ?>
	<?php if ($questions_list->SortUrl($questions_list->scores) == "") { ?>
		<th data-name="scores" class="<?php echo $questions_list->scores->headerCellClass() ?>"><div id="elh_questions_scores" class="questions_scores"><div class="ew-table-header-caption"><?php echo $questions_list->scores->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="scores" class="<?php echo $questions_list->scores->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->scores) ?>', 1);"><div id="elh_questions_scores" class="questions_scores">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->scores->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($questions_list->scores->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->scores->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->type->Visible) { // type ?>
	<?php if ($questions_list->SortUrl($questions_list->type) == "") { ?>
		<th data-name="type" class="<?php echo $questions_list->type->headerCellClass() ?>"><div id="elh_questions_type" class="questions_type"><div class="ew-table-header-caption"><?php echo $questions_list->type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type" class="<?php echo $questions_list->type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->type) ?>', 1);"><div id="elh_questions_type" class="questions_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->type->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->section->Visible) { // section ?>
	<?php if ($questions_list->SortUrl($questions_list->section) == "") { ?>
		<th data-name="section" class="<?php echo $questions_list->section->headerCellClass() ?>"><div id="elh_questions_section" class="questions_section"><div class="ew-table-header-caption"><?php echo $questions_list->section->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="section" class="<?php echo $questions_list->section->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->section) ?>', 1);"><div id="elh_questions_section" class="questions_section">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->section->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->section->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->section->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->active->Visible) { // active ?>
	<?php if ($questions_list->SortUrl($questions_list->active) == "") { ?>
		<th data-name="active" class="<?php echo $questions_list->active->headerCellClass() ?>"><div id="elh_questions_active" class="questions_active"><div class="ew-table-header-caption"><?php echo $questions_list->active->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="active" class="<?php echo $questions_list->active->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->active) ?>', 1);"><div id="elh_questions_active" class="questions_active">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->active->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->active->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->active->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->created_at->Visible) { // created_at ?>
	<?php if ($questions_list->SortUrl($questions_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $questions_list->created_at->headerCellClass() ?>"><div id="elh_questions_created_at" class="questions_created_at"><div class="ew-table-header-caption"><?php echo $questions_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $questions_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->created_at) ?>', 1);"><div id="elh_questions_created_at" class="questions_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->updated_at->Visible) { // updated_at ?>
	<?php if ($questions_list->SortUrl($questions_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $questions_list->updated_at->headerCellClass() ?>"><div id="elh_questions_updated_at" class="questions_updated_at"><div class="ew-table-header-caption"><?php echo $questions_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $questions_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->updated_at) ?>', 1);"><div id="elh_questions_updated_at" class="questions_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->has_recommendations->Visible) { // has_recommendations ?>
	<?php if ($questions_list->SortUrl($questions_list->has_recommendations) == "") { ?>
		<th data-name="has_recommendations" class="<?php echo $questions_list->has_recommendations->headerCellClass() ?>"><div id="elh_questions_has_recommendations" class="questions_has_recommendations"><div class="ew-table-header-caption"><?php echo $questions_list->has_recommendations->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="has_recommendations" class="<?php echo $questions_list->has_recommendations->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->has_recommendations) ?>', 1);"><div id="elh_questions_has_recommendations" class="questions_has_recommendations">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->has_recommendations->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->has_recommendations->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->has_recommendations->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->group->Visible) { // group ?>
	<?php if ($questions_list->SortUrl($questions_list->group) == "") { ?>
		<th data-name="group" class="<?php echo $questions_list->group->headerCellClass() ?>"><div id="elh_questions_group" class="questions_group"><div class="ew-table-header-caption"><?php echo $questions_list->group->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="group" class="<?php echo $questions_list->group->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->group) ?>', 1);"><div id="elh_questions_group" class="questions_group">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->group->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->group->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->group->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->category->Visible) { // category ?>
	<?php if ($questions_list->SortUrl($questions_list->category) == "") { ?>
		<th data-name="category" class="<?php echo $questions_list->category->headerCellClass() ?>"><div id="elh_questions_category" class="questions_category"><div class="ew-table-header-caption"><?php echo $questions_list->category->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="category" class="<?php echo $questions_list->category->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->category) ?>', 1);"><div id="elh_questions_category" class="questions_category">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->category->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->category->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->category->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->order->Visible) { // order ?>
	<?php if ($questions_list->SortUrl($questions_list->order) == "") { ?>
		<th data-name="order" class="<?php echo $questions_list->order->headerCellClass() ?>"><div id="elh_questions_order" class="questions_order"><div class="ew-table-header-caption"><?php echo $questions_list->order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order" class="<?php echo $questions_list->order->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->order) ?>', 1);"><div id="elh_questions_order" class="questions_order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->order->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->order->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->order->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->recommendation_score->Visible) { // recommendation_score ?>
	<?php if ($questions_list->SortUrl($questions_list->recommendation_score) == "") { ?>
		<th data-name="recommendation_score" class="<?php echo $questions_list->recommendation_score->headerCellClass() ?>"><div id="elh_questions_recommendation_score" class="questions_recommendation_score"><div class="ew-table-header-caption"><?php echo $questions_list->recommendation_score->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="recommendation_score" class="<?php echo $questions_list->recommendation_score->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->recommendation_score) ?>', 1);"><div id="elh_questions_recommendation_score" class="questions_recommendation_score">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->recommendation_score->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->recommendation_score->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->recommendation_score->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->related->Visible) { // related ?>
	<?php if ($questions_list->SortUrl($questions_list->related) == "") { ?>
		<th data-name="related" class="<?php echo $questions_list->related->headerCellClass() ?>"><div id="elh_questions_related" class="questions_related"><div class="ew-table-header-caption"><?php echo $questions_list->related->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="related" class="<?php echo $questions_list->related->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->related) ?>', 1);"><div id="elh_questions_related" class="questions_related">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->related->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->related->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->related->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($questions_list->trigger_related_val->Visible) { // trigger_related_val ?>
	<?php if ($questions_list->SortUrl($questions_list->trigger_related_val) == "") { ?>
		<th data-name="trigger_related_val" class="<?php echo $questions_list->trigger_related_val->headerCellClass() ?>"><div id="elh_questions_trigger_related_val" class="questions_trigger_related_val"><div class="ew-table-header-caption"><?php echo $questions_list->trigger_related_val->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="trigger_related_val" class="<?php echo $questions_list->trigger_related_val->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $questions_list->SortUrl($questions_list->trigger_related_val) ?>', 1);"><div id="elh_questions_trigger_related_val" class="questions_trigger_related_val">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $questions_list->trigger_related_val->caption() ?></span><span class="ew-table-header-sort"><?php if ($questions_list->trigger_related_val->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($questions_list->trigger_related_val->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$questions_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($questions_list->ExportAll && $questions_list->isExport()) {
	$questions_list->StopRecord = $questions_list->TotalRecords;
} else {

	// Set the last record to display
	if ($questions_list->TotalRecords > $questions_list->StartRecord + $questions_list->DisplayRecords - 1)
		$questions_list->StopRecord = $questions_list->StartRecord + $questions_list->DisplayRecords - 1;
	else
		$questions_list->StopRecord = $questions_list->TotalRecords;
}
$questions_list->RecordCount = $questions_list->StartRecord - 1;
if ($questions_list->Recordset && !$questions_list->Recordset->EOF) {
	$questions_list->Recordset->moveFirst();
	$selectLimit = $questions_list->UseSelectLimit;
	if (!$selectLimit && $questions_list->StartRecord > 1)
		$questions_list->Recordset->move($questions_list->StartRecord - 1);
} elseif (!$questions->AllowAddDeleteRow && $questions_list->StopRecord == 0) {
	$questions_list->StopRecord = $questions->GridAddRowCount;
}

// Initialize aggregate
$questions->RowType = ROWTYPE_AGGREGATEINIT;
$questions->resetAttributes();
$questions_list->renderRow();
while ($questions_list->RecordCount < $questions_list->StopRecord) {
	$questions_list->RecordCount++;
	if ($questions_list->RecordCount >= $questions_list->StartRecord) {
		$questions_list->RowCount++;

		// Set up key count
		$questions_list->KeyCount = $questions_list->RowIndex;

		// Init row class and style
		$questions->resetAttributes();
		$questions->CssClass = "";
		if ($questions_list->isGridAdd()) {
		} else {
			$questions_list->loadRowValues($questions_list->Recordset); // Load row values
		}
		$questions->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$questions->RowAttrs->merge(["data-rowindex" => $questions_list->RowCount, "id" => "r" . $questions_list->RowCount . "_questions", "data-rowtype" => $questions->RowType]);

		// Render row
		$questions_list->renderRow();

		// Render list options
		$questions_list->renderListOptions();
?>
	<tr <?php echo $questions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$questions_list->ListOptions->render("body", "left", $questions_list->RowCount);
?>
	<?php if ($questions_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $questions_list->id->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_id">
<span<?php echo $questions_list->id->viewAttributes() ?>><?php echo $questions_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->title->Visible) { // title ?>
		<td data-name="title" <?php echo $questions_list->title->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_title">
<span<?php echo $questions_list->title->viewAttributes() ?>><?php echo $questions_list->title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->placeholder->Visible) { // placeholder ?>
		<td data-name="placeholder" <?php echo $questions_list->placeholder->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_placeholder">
<span<?php echo $questions_list->placeholder->viewAttributes() ?>><?php echo $questions_list->placeholder->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->questions->Visible) { // questions ?>
		<td data-name="questions" <?php echo $questions_list->questions->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_questions">
<span<?php echo $questions_list->questions->viewAttributes() ?>><?php echo $questions_list->questions->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->scores->Visible) { // scores ?>
		<td data-name="scores" <?php echo $questions_list->scores->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_scores">
<span<?php echo $questions_list->scores->viewAttributes() ?>><?php echo $questions_list->scores->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->type->Visible) { // type ?>
		<td data-name="type" <?php echo $questions_list->type->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_type">
<span<?php echo $questions_list->type->viewAttributes() ?>><?php echo $questions_list->type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->section->Visible) { // section ?>
		<td data-name="section" <?php echo $questions_list->section->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_section">
<span<?php echo $questions_list->section->viewAttributes() ?>><?php echo $questions_list->section->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->active->Visible) { // active ?>
		<td data-name="active" <?php echo $questions_list->active->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_active">
<span<?php echo $questions_list->active->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_active" class="custom-control-input" value="<?php echo $questions_list->active->getViewValue() ?>" disabled<?php if (ConvertToBool($questions_list->active->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_active"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $questions_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_created_at">
<span<?php echo $questions_list->created_at->viewAttributes() ?>><?php echo $questions_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $questions_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_updated_at">
<span<?php echo $questions_list->updated_at->viewAttributes() ?>><?php echo $questions_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->has_recommendations->Visible) { // has_recommendations ?>
		<td data-name="has_recommendations" <?php echo $questions_list->has_recommendations->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_has_recommendations">
<span<?php echo $questions_list->has_recommendations->viewAttributes() ?>><?php echo $questions_list->has_recommendations->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->group->Visible) { // group ?>
		<td data-name="group" <?php echo $questions_list->group->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_group">
<span<?php echo $questions_list->group->viewAttributes() ?>><?php echo $questions_list->group->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->category->Visible) { // category ?>
		<td data-name="category" <?php echo $questions_list->category->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_category">
<span<?php echo $questions_list->category->viewAttributes() ?>><?php echo $questions_list->category->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->order->Visible) { // order ?>
		<td data-name="order" <?php echo $questions_list->order->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_order">
<span<?php echo $questions_list->order->viewAttributes() ?>><?php echo $questions_list->order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->recommendation_score->Visible) { // recommendation_score ?>
		<td data-name="recommendation_score" <?php echo $questions_list->recommendation_score->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_recommendation_score">
<span<?php echo $questions_list->recommendation_score->viewAttributes() ?>><?php echo $questions_list->recommendation_score->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->related->Visible) { // related ?>
		<td data-name="related" <?php echo $questions_list->related->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_related">
<span<?php echo $questions_list->related->viewAttributes() ?>><?php echo $questions_list->related->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($questions_list->trigger_related_val->Visible) { // trigger_related_val ?>
		<td data-name="trigger_related_val" <?php echo $questions_list->trigger_related_val->cellAttributes() ?>>
<span id="el<?php echo $questions_list->RowCount ?>_questions_trigger_related_val">
<span<?php echo $questions_list->trigger_related_val->viewAttributes() ?>><?php echo $questions_list->trigger_related_val->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$questions_list->ListOptions->render("body", "right", $questions_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$questions_list->isGridAdd())
		$questions_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$questions->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($questions_list->Recordset)
	$questions_list->Recordset->Close();
?>
<?php if (!$questions_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$questions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $questions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $questions_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($questions_list->TotalRecords == 0 && !$questions->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $questions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$questions_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$questions_list->isExport()) { ?>
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
$questions_list->terminate();
?>
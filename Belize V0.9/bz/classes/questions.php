<?php namespace PHPMaker2020\IDB_EcoMicro_BZ; ?>
<?php

/**
 * Table class for questions
 */
class questions extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $id;
	public $title;
	public $placeholder;
	public $questions;
	public $scores;
	public $type;
	public $section;
	public $active;
	public $created_at;
	public $updated_at;
	public $has_recommendations;
	public $group;
	public $category;
	public $order;
	public $recommendation_by_score;
	public $recommendation_score;
	public $related;
	public $trigger_related_val;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'questions';
		$this->TableName = 'questions';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`questions`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('questions', 'questions', 'x_id', 'id', '`id`', '`id`', 19, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->IsForeignKey = TRUE; // Foreign key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// title
		$this->title = new DbField('questions', 'questions', 'x_title', 'title', '`title`', '`title`', 200, 255, -1, FALSE, '`title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->title->Sortable = TRUE; // Allow sort
		$this->fields['title'] = &$this->title;

		// placeholder
		$this->placeholder = new DbField('questions', 'questions', 'x_placeholder', 'placeholder', '`placeholder`', '`placeholder`', 201, 512, -1, FALSE, '`placeholder`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->placeholder->Sortable = TRUE; // Allow sort
		$this->fields['placeholder'] = &$this->placeholder;

		// questions
		$this->questions = new DbField('questions', 'questions', 'x_questions', 'questions', '`questions`', '`questions`', 201, 1028, -1, FALSE, '`questions`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->questions->Sortable = TRUE; // Allow sort
		$this->fields['questions'] = &$this->questions;

		// scores
		$this->scores = new DbField('questions', 'questions', 'x_scores', 'scores', '`scores`', '`scores`', 200, 255, -1, FALSE, '`scores`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->scores->Sortable = TRUE; // Allow sort
		$this->fields['scores'] = &$this->scores;

		// type
		$this->type = new DbField('questions', 'questions', 'x_type', 'type', '`type`', '`type`', 19, 11, -1, FALSE, '`type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->type->IsForeignKey = TRUE; // Foreign key field
		$this->type->Required = TRUE; // Required field
		$this->type->Sortable = TRUE; // Allow sort
		$this->type->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->type->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->type->Lookup = new Lookup('type', 'question_types', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['type'] = &$this->type;

		// section
		$this->section = new DbField('questions', 'questions', 'x_section', 'section', '`section`', '`section`', 19, 11, -1, FALSE, '`section`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->section->IsForeignKey = TRUE; // Foreign key field
		$this->section->Sortable = TRUE; // Allow sort
		$this->section->Lookup = new Lookup('section', 'sections', FALSE, 'id', ["id","title","",""], [], [], [], [], [], [], '', '');
		$this->section->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['section'] = &$this->section;

		// active
		$this->active = new DbField('questions', 'questions', 'x_active', 'active', '`active`', '`active`', 16, 1, -1, FALSE, '`active`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->active->Sortable = TRUE; // Allow sort
		$this->active->DataType = DATATYPE_BOOLEAN;
		$this->active->Lookup = new Lookup('active', 'questions', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->active->OptionCount = 2;
		$this->active->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['active'] = &$this->active;

		// created_at
		$this->created_at = new DbField('questions', 'questions', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// updated_at
		$this->updated_at = new DbField('questions', 'questions', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_at->Sortable = TRUE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;

		// has_recommendations
		$this->has_recommendations = new DbField('questions', 'questions', 'x_has_recommendations', 'has_recommendations', '`has_recommendations`', '`has_recommendations`', 3, 11, -1, FALSE, '`has_recommendations`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->has_recommendations->Sortable = TRUE; // Allow sort
		$this->has_recommendations->Lookup = new Lookup('has_recommendations', 'questions', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->has_recommendations->OptionCount = 2;
		$this->has_recommendations->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['has_recommendations'] = &$this->has_recommendations;

		// group
		$this->group = new DbField('questions', 'questions', 'x_group', 'group', '`group`', '`group`', 19, 10, -1, FALSE, '`group`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->group->IsForeignKey = TRUE; // Foreign key field
		$this->group->Sortable = TRUE; // Allow sort
		$this->group->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->group->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->group->Lookup = new Lookup('group', 'question_groups', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->group->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['group'] = &$this->group;

		// category
		$this->category = new DbField('questions', 'questions', 'x_category', 'category', '`category`', '`category`', 19, 10, -1, FALSE, '`category`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->category->IsForeignKey = TRUE; // Foreign key field
		$this->category->Sortable = TRUE; // Allow sort
		$this->category->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->category->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->category->Lookup = new Lookup('category', 'question_category', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->category->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['category'] = &$this->category;

		// order
		$this->order = new DbField('questions', 'questions', 'x_order', 'order', '`order`', '`order`', 3, 11, -1, FALSE, '`order`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->order->Sortable = TRUE; // Allow sort
		$this->order->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['order'] = &$this->order;

		// recommendation_by_score
		$this->recommendation_by_score = new DbField('questions', 'questions', 'x_recommendation_by_score', 'recommendation_by_score', '`recommendation_by_score`', '`recommendation_by_score`', 201, 1028, -1, FALSE, '`recommendation_by_score`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->recommendation_by_score->Sortable = TRUE; // Allow sort
		$this->fields['recommendation_by_score'] = &$this->recommendation_by_score;

		// recommendation_score
		$this->recommendation_score = new DbField('questions', 'questions', 'x_recommendation_score', 'recommendation_score', '`recommendation_score`', '`recommendation_score`', 131, 5, -1, FALSE, '`recommendation_score`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->recommendation_score->Sortable = TRUE; // Allow sort
		$this->recommendation_score->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['recommendation_score'] = &$this->recommendation_score;

		// related
		$this->related = new DbField('questions', 'questions', 'x_related', 'related', '`related`', '`related`', 3, 11, -1, FALSE, '`related`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->related->Sortable = TRUE; // Allow sort
		$this->related->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['related'] = &$this->related;

		// trigger_related_val
		$this->trigger_related_val = new DbField('questions', 'questions', 'x_trigger_related_val', 'trigger_related_val', '`trigger_related_val`', '`trigger_related_val`', 200, 128, -1, FALSE, '`trigger_related_val`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->trigger_related_val->Sortable = TRUE; // Allow sort
		$this->fields['trigger_related_val'] = &$this->trigger_related_val;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "question_types") {
			if ($this->type->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->type->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "sections") {
			if ($this->section->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->section->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "question_groups") {
			if ($this->group->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->group->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "question_category") {
			if ($this->category->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->category->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "question_types") {
			if ($this->type->getSessionValue() != "")
				$detailFilter .= "`type`=" . QuotedValue($this->type->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "sections") {
			if ($this->section->getSessionValue() != "")
				$detailFilter .= "`section`=" . QuotedValue($this->section->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "question_groups") {
			if ($this->group->getSessionValue() != "")
				$detailFilter .= "`group`=" . QuotedValue($this->group->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "question_category") {
			if ($this->category->getSessionValue() != "")
				$detailFilter .= "`category`=" . QuotedValue($this->category->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_question_types()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_question_types()
	{
		return "`type`=@type@";
	}

	// Master filter
	public function sqlMasterFilter_sections()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_sections()
	{
		return "`section`=@section@";
	}

	// Master filter
	public function sqlMasterFilter_question_groups()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_question_groups()
	{
		return "`group`=@group@";
	}

	// Master filter
	public function sqlMasterFilter_question_category()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_question_category()
	{
		return "`category`=@category@";
	}

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "answers") {
			$detailUrl = $GLOBALS["answers"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "questionslist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`questions`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`section` ASC";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->title->DbValue = $row['title'];
		$this->placeholder->DbValue = $row['placeholder'];
		$this->questions->DbValue = $row['questions'];
		$this->scores->DbValue = $row['scores'];
		$this->type->DbValue = $row['type'];
		$this->section->DbValue = $row['section'];
		$this->active->DbValue = $row['active'];
		$this->created_at->DbValue = $row['created_at'];
		$this->updated_at->DbValue = $row['updated_at'];
		$this->has_recommendations->DbValue = $row['has_recommendations'];
		$this->group->DbValue = $row['group'];
		$this->category->DbValue = $row['category'];
		$this->order->DbValue = $row['order'];
		$this->recommendation_by_score->DbValue = $row['recommendation_by_score'];
		$this->recommendation_score->DbValue = $row['recommendation_score'];
		$this->related->DbValue = $row['related'];
		$this->trigger_related_val->DbValue = $row['trigger_related_val'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id', $row) ? $row['id'] : NULL;
		else
			$val = $this->id->OldValue !== NULL ? $this->id->OldValue : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "questionslist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "questionsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "questionsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "questionsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "questionslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("questionsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("questionsview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "questionsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "questionsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("questionsedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("questionsedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("questionsadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("questionsadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("questionsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "question_types" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->type->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "sections" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->section->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "question_groups" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->group->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "question_category" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->category->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->id->CurrentValue = $key;
			else
				$this->id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id->setDbValue($rs->fields('id'));
		$this->title->setDbValue($rs->fields('title'));
		$this->placeholder->setDbValue($rs->fields('placeholder'));
		$this->questions->setDbValue($rs->fields('questions'));
		$this->scores->setDbValue($rs->fields('scores'));
		$this->type->setDbValue($rs->fields('type'));
		$this->section->setDbValue($rs->fields('section'));
		$this->active->setDbValue($rs->fields('active'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
		$this->has_recommendations->setDbValue($rs->fields('has_recommendations'));
		$this->group->setDbValue($rs->fields('group'));
		$this->category->setDbValue($rs->fields('category'));
		$this->order->setDbValue($rs->fields('order'));
		$this->recommendation_by_score->setDbValue($rs->fields('recommendation_by_score'));
		$this->recommendation_score->setDbValue($rs->fields('recommendation_score'));
		$this->related->setDbValue($rs->fields('related'));
		$this->trigger_related_val->setDbValue($rs->fields('trigger_related_val'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// title
		// placeholder
		// questions
		// scores
		// type
		// section
		// active
		// created_at
		// updated_at
		// has_recommendations
		// group
		// category
		// order
		// recommendation_by_score
		// recommendation_score
		// related
		// trigger_related_val
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewValue = FormatNumber($this->id->ViewValue, 0, -2, -2, -2);
		$this->id->ViewCustomAttributes = "";

		// title
		$this->title->ViewValue = $this->title->CurrentValue;
		$this->title->ViewCustomAttributes = "";

		// placeholder
		$this->placeholder->ViewValue = $this->placeholder->CurrentValue;
		$this->placeholder->ViewCustomAttributes = "";

		// questions
		$this->questions->ViewValue = $this->questions->CurrentValue;
		$this->questions->ViewCustomAttributes = "";

		// scores
		$this->scores->ViewValue = $this->scores->CurrentValue;
		$this->scores->ViewCustomAttributes = "";

		// type
		$curVal = strval($this->type->CurrentValue);
		if ($curVal != "") {
			$this->type->ViewValue = $this->type->lookupCacheOption($curVal);
			if ($this->type->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->type->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->type->ViewValue = $this->type->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->type->ViewValue = $this->type->CurrentValue;
				}
			}
		} else {
			$this->type->ViewValue = NULL;
		}
		$this->type->ViewCustomAttributes = "";

		// section
		$this->section->ViewValue = $this->section->CurrentValue;
		$curVal = strval($this->section->CurrentValue);
		if ($curVal != "") {
			$this->section->ViewValue = $this->section->lookupCacheOption($curVal);
			if ($this->section->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->section->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
					$arwrk[2] = $rswrk->fields('df2');
					$this->section->ViewValue = $this->section->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->section->ViewValue = $this->section->CurrentValue;
				}
			}
		} else {
			$this->section->ViewValue = NULL;
		}
		$this->section->ViewCustomAttributes = "";

		// active
		if (ConvertToBool($this->active->CurrentValue)) {
			$this->active->ViewValue = $this->active->tagCaption(1) != "" ? $this->active->tagCaption(1) : "Yes";
		} else {
			$this->active->ViewValue = $this->active->tagCaption(2) != "" ? $this->active->tagCaption(2) : "No";
		}
		$this->active->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// updated_at
		$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
		$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
		$this->updated_at->ViewCustomAttributes = "";

		// has_recommendations
		if (strval($this->has_recommendations->CurrentValue) != "") {
			$this->has_recommendations->ViewValue = new OptionValues();
			$arwrk = explode(",", strval($this->has_recommendations->CurrentValue));
			$cnt = count($arwrk);
			for ($ari = 0; $ari < $cnt; $ari++)
				$this->has_recommendations->ViewValue->add($this->has_recommendations->optionCaption(trim($arwrk[$ari])));
		} else {
			$this->has_recommendations->ViewValue = NULL;
		}
		$this->has_recommendations->ViewCustomAttributes = "";

		// group
		$curVal = strval($this->group->CurrentValue);
		if ($curVal != "") {
			$this->group->ViewValue = $this->group->lookupCacheOption($curVal);
			if ($this->group->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->group->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->group->ViewValue = $this->group->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->group->ViewValue = $this->group->CurrentValue;
				}
			}
		} else {
			$this->group->ViewValue = NULL;
		}
		$this->group->ViewCustomAttributes = "";

		// category
		$curVal = strval($this->category->CurrentValue);
		if ($curVal != "") {
			$this->category->ViewValue = $this->category->lookupCacheOption($curVal);
			if ($this->category->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->category->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->category->ViewValue = $this->category->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->category->ViewValue = $this->category->CurrentValue;
				}
			}
		} else {
			$this->category->ViewValue = NULL;
		}
		$this->category->ViewCustomAttributes = "";

		// order
		$this->order->ViewValue = $this->order->CurrentValue;
		$this->order->ViewValue = FormatNumber($this->order->ViewValue, 0, -2, -2, -2);
		$this->order->ViewCustomAttributes = "";

		// recommendation_by_score
		$this->recommendation_by_score->ViewValue = $this->recommendation_by_score->CurrentValue;
		$this->recommendation_by_score->ViewCustomAttributes = "";

		// recommendation_score
		$this->recommendation_score->ViewValue = $this->recommendation_score->CurrentValue;
		$this->recommendation_score->ViewValue = FormatNumber($this->recommendation_score->ViewValue, 2, -2, -2, -2);
		$this->recommendation_score->ViewCustomAttributes = "";

		// related
		$this->related->ViewValue = $this->related->CurrentValue;
		$this->related->ViewValue = FormatNumber($this->related->ViewValue, 0, -2, -2, -2);
		$this->related->ViewCustomAttributes = "";

		// trigger_related_val
		$this->trigger_related_val->ViewValue = $this->trigger_related_val->CurrentValue;
		$this->trigger_related_val->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// title
		$this->title->LinkCustomAttributes = "";
		$this->title->HrefValue = "";
		$this->title->TooltipValue = "";

		// placeholder
		$this->placeholder->LinkCustomAttributes = "";
		$this->placeholder->HrefValue = "";
		$this->placeholder->TooltipValue = "";

		// questions
		$this->questions->LinkCustomAttributes = "";
		$this->questions->HrefValue = "";
		$this->questions->TooltipValue = "";

		// scores
		$this->scores->LinkCustomAttributes = "";
		$this->scores->HrefValue = "";
		$this->scores->TooltipValue = "";

		// type
		$this->type->LinkCustomAttributes = "";
		$this->type->HrefValue = "";
		$this->type->TooltipValue = "";

		// section
		$this->section->LinkCustomAttributes = "";
		$this->section->HrefValue = "";
		$this->section->TooltipValue = "";

		// active
		$this->active->LinkCustomAttributes = "";
		$this->active->HrefValue = "";
		$this->active->TooltipValue = "";

		// created_at
		$this->created_at->LinkCustomAttributes = "";
		$this->created_at->HrefValue = "";
		$this->created_at->TooltipValue = "";

		// updated_at
		$this->updated_at->LinkCustomAttributes = "";
		$this->updated_at->HrefValue = "";
		$this->updated_at->TooltipValue = "";

		// has_recommendations
		$this->has_recommendations->LinkCustomAttributes = "";
		$this->has_recommendations->HrefValue = "";
		$this->has_recommendations->TooltipValue = "";

		// group
		$this->group->LinkCustomAttributes = "";
		$this->group->HrefValue = "";
		$this->group->TooltipValue = "";

		// category
		$this->category->LinkCustomAttributes = "";
		$this->category->HrefValue = "";
		$this->category->TooltipValue = "";

		// order
		$this->order->LinkCustomAttributes = "";
		$this->order->HrefValue = "";
		$this->order->TooltipValue = "";

		// recommendation_by_score
		$this->recommendation_by_score->LinkCustomAttributes = "";
		$this->recommendation_by_score->HrefValue = "";
		$this->recommendation_by_score->TooltipValue = "";

		// recommendation_score
		$this->recommendation_score->LinkCustomAttributes = "";
		$this->recommendation_score->HrefValue = "";
		$this->recommendation_score->TooltipValue = "";

		// related
		$this->related->LinkCustomAttributes = "";
		$this->related->HrefValue = "";
		$this->related->TooltipValue = "";

		// trigger_related_val
		$this->trigger_related_val->LinkCustomAttributes = "";
		$this->trigger_related_val->HrefValue = "";
		$this->trigger_related_val->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->EditValue = FormatNumber($this->id->EditValue, 0, -2, -2, -2);
		$this->id->ViewCustomAttributes = "";

		// title
		$this->title->EditAttrs["class"] = "form-control";
		$this->title->EditCustomAttributes = "";
		if (!$this->title->Raw)
			$this->title->CurrentValue = HtmlDecode($this->title->CurrentValue);
		$this->title->EditValue = $this->title->CurrentValue;
		$this->title->PlaceHolder = RemoveHtml($this->title->caption());

		// placeholder
		$this->placeholder->EditAttrs["class"] = "form-control";
		$this->placeholder->EditCustomAttributes = "";
		$this->placeholder->EditValue = $this->placeholder->CurrentValue;
		$this->placeholder->PlaceHolder = RemoveHtml($this->placeholder->caption());

		// questions
		$this->questions->EditAttrs["class"] = "form-control";
		$this->questions->EditCustomAttributes = "";
		$this->questions->EditValue = $this->questions->CurrentValue;
		$this->questions->PlaceHolder = RemoveHtml($this->questions->caption());

		// scores
		$this->scores->EditAttrs["class"] = "form-control";
		$this->scores->EditCustomAttributes = "";
		$this->scores->EditValue = $this->scores->CurrentValue;
		$this->scores->PlaceHolder = RemoveHtml($this->scores->caption());

		// type
		$this->type->EditCustomAttributes = "";
		if ($this->type->getSessionValue() != "") {
			$this->type->CurrentValue = $this->type->getSessionValue();
			$curVal = strval($this->type->CurrentValue);
			if ($curVal != "") {
				$this->type->ViewValue = $this->type->lookupCacheOption($curVal);
				if ($this->type->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->type->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->type->ViewValue = $this->type->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->type->ViewValue = $this->type->CurrentValue;
					}
				}
			} else {
				$this->type->ViewValue = NULL;
			}
			$this->type->ViewCustomAttributes = "";
		} else {
		}

		// section
		$this->section->EditAttrs["class"] = "form-control";
		$this->section->EditCustomAttributes = "";
		if ($this->section->getSessionValue() != "") {
			$this->section->CurrentValue = $this->section->getSessionValue();
			$this->section->ViewValue = $this->section->CurrentValue;
			$curVal = strval($this->section->CurrentValue);
			if ($curVal != "") {
				$this->section->ViewValue = $this->section->lookupCacheOption($curVal);
				if ($this->section->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->section->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
						$arwrk[2] = $rswrk->fields('df2');
						$this->section->ViewValue = $this->section->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->section->ViewValue = $this->section->CurrentValue;
					}
				}
			} else {
				$this->section->ViewValue = NULL;
			}
			$this->section->ViewCustomAttributes = "";
		} else {
			$this->section->EditValue = $this->section->CurrentValue;
			$this->section->PlaceHolder = RemoveHtml($this->section->caption());
		}

		// active
		$this->active->EditCustomAttributes = "";
		$this->active->EditValue = $this->active->options(FALSE);

		// created_at
		$this->created_at->EditAttrs["class"] = "form-control";
		$this->created_at->EditCustomAttributes = "";
		$this->created_at->EditValue = FormatDateTime($this->created_at->CurrentValue, 8);
		$this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

		// updated_at
		$this->updated_at->EditAttrs["class"] = "form-control";
		$this->updated_at->EditCustomAttributes = "";
		$this->updated_at->EditValue = FormatDateTime($this->updated_at->CurrentValue, 8);
		$this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

		// has_recommendations
		$this->has_recommendations->EditCustomAttributes = "";
		$this->has_recommendations->EditValue = $this->has_recommendations->options(FALSE);

		// group
		$this->group->EditAttrs["class"] = "form-control";
		$this->group->EditCustomAttributes = "";
		if ($this->group->getSessionValue() != "") {
			$this->group->CurrentValue = $this->group->getSessionValue();
			$curVal = strval($this->group->CurrentValue);
			if ($curVal != "") {
				$this->group->ViewValue = $this->group->lookupCacheOption($curVal);
				if ($this->group->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->group->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->group->ViewValue = $this->group->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->group->ViewValue = $this->group->CurrentValue;
					}
				}
			} else {
				$this->group->ViewValue = NULL;
			}
			$this->group->ViewCustomAttributes = "";
		} else {
		}

		// category
		$this->category->EditAttrs["class"] = "form-control";
		$this->category->EditCustomAttributes = "";
		if ($this->category->getSessionValue() != "") {
			$this->category->CurrentValue = $this->category->getSessionValue();
			$curVal = strval($this->category->CurrentValue);
			if ($curVal != "") {
				$this->category->ViewValue = $this->category->lookupCacheOption($curVal);
				if ($this->category->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->category->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->category->ViewValue = $this->category->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->category->ViewValue = $this->category->CurrentValue;
					}
				}
			} else {
				$this->category->ViewValue = NULL;
			}
			$this->category->ViewCustomAttributes = "";
		} else {
		}

		// order
		$this->order->EditAttrs["class"] = "form-control";
		$this->order->EditCustomAttributes = "";
		$this->order->EditValue = $this->order->CurrentValue;
		$this->order->PlaceHolder = RemoveHtml($this->order->caption());

		// recommendation_by_score
		$this->recommendation_by_score->EditAttrs["class"] = "form-control";
		$this->recommendation_by_score->EditCustomAttributes = "";
		$this->recommendation_by_score->EditValue = $this->recommendation_by_score->CurrentValue;
		$this->recommendation_by_score->PlaceHolder = RemoveHtml($this->recommendation_by_score->caption());

		// recommendation_score
		$this->recommendation_score->EditAttrs["class"] = "form-control";
		$this->recommendation_score->EditCustomAttributes = "";
		$this->recommendation_score->EditValue = $this->recommendation_score->CurrentValue;
		$this->recommendation_score->PlaceHolder = RemoveHtml($this->recommendation_score->caption());
		if (strval($this->recommendation_score->EditValue) != "" && is_numeric($this->recommendation_score->EditValue))
			$this->recommendation_score->EditValue = FormatNumber($this->recommendation_score->EditValue, -2, -2, -2, -2);
		

		// related
		$this->related->EditAttrs["class"] = "form-control";
		$this->related->EditCustomAttributes = "";
		$this->related->EditValue = $this->related->CurrentValue;
		$this->related->PlaceHolder = RemoveHtml($this->related->caption());

		// trigger_related_val
		$this->trigger_related_val->EditAttrs["class"] = "form-control";
		$this->trigger_related_val->EditCustomAttributes = "";
		if (!$this->trigger_related_val->Raw)
			$this->trigger_related_val->CurrentValue = HtmlDecode($this->trigger_related_val->CurrentValue);
		$this->trigger_related_val->EditValue = $this->trigger_related_val->CurrentValue;
		$this->trigger_related_val->PlaceHolder = RemoveHtml($this->trigger_related_val->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->title);
					$doc->exportCaption($this->placeholder);
					$doc->exportCaption($this->questions);
					$doc->exportCaption($this->scores);
					$doc->exportCaption($this->type);
					$doc->exportCaption($this->section);
					$doc->exportCaption($this->active);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->updated_at);
					$doc->exportCaption($this->has_recommendations);
					$doc->exportCaption($this->group);
					$doc->exportCaption($this->category);
					$doc->exportCaption($this->order);
					$doc->exportCaption($this->recommendation_by_score);
					$doc->exportCaption($this->recommendation_score);
					$doc->exportCaption($this->related);
					$doc->exportCaption($this->trigger_related_val);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->title);
					$doc->exportCaption($this->scores);
					$doc->exportCaption($this->type);
					$doc->exportCaption($this->section);
					$doc->exportCaption($this->active);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->updated_at);
					$doc->exportCaption($this->has_recommendations);
					$doc->exportCaption($this->group);
					$doc->exportCaption($this->category);
					$doc->exportCaption($this->order);
					$doc->exportCaption($this->recommendation_score);
					$doc->exportCaption($this->related);
					$doc->exportCaption($this->trigger_related_val);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->id);
						$doc->exportField($this->title);
						$doc->exportField($this->placeholder);
						$doc->exportField($this->questions);
						$doc->exportField($this->scores);
						$doc->exportField($this->type);
						$doc->exportField($this->section);
						$doc->exportField($this->active);
						$doc->exportField($this->created_at);
						$doc->exportField($this->updated_at);
						$doc->exportField($this->has_recommendations);
						$doc->exportField($this->group);
						$doc->exportField($this->category);
						$doc->exportField($this->order);
						$doc->exportField($this->recommendation_by_score);
						$doc->exportField($this->recommendation_score);
						$doc->exportField($this->related);
						$doc->exportField($this->trigger_related_val);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->title);
						$doc->exportField($this->scores);
						$doc->exportField($this->type);
						$doc->exportField($this->section);
						$doc->exportField($this->active);
						$doc->exportField($this->created_at);
						$doc->exportField($this->updated_at);
						$doc->exportField($this->has_recommendations);
						$doc->exportField($this->group);
						$doc->exportField($this->category);
						$doc->exportField($this->order);
						$doc->exportField($this->recommendation_score);
						$doc->exportField($this->related);
						$doc->exportField($this->trigger_related_val);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
<?php namespace PHPMaker2020\IDB_EcoMicro_BZ; ?>
<?php

/**
 * Table class for answers
 */
class answers extends DbTable
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
	public $question_id;
	public $assessment_id;
	public $section_id;
	public $_response;
	public $score;
	public $recommendations;
	public $created_at;
	public $updated_at;
	public $weight;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'answers';
		$this->TableName = 'answers';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`answers`";
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
		$this->id = new DbField('answers', 'answers', 'x_id', 'id', '`id`', '`id`', 19, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// question_id
		$this->question_id = new DbField('answers', 'answers', 'x_question_id', 'question_id', '`question_id`', '`question_id`', 19, 11, -1, FALSE, '`question_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->question_id->IsForeignKey = TRUE; // Foreign key field
		$this->question_id->Sortable = TRUE; // Allow sort
		$this->question_id->Lookup = new Lookup('question_id', 'questions', FALSE, 'id', ["id","title","",""], [], [], [], [], [], [], '', '');
		$this->question_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['question_id'] = &$this->question_id;

		// assessment_id
		$this->assessment_id = new DbField('answers', 'answers', 'x_assessment_id', 'assessment_id', '`assessment_id`', '`assessment_id`', 19, 11, -1, FALSE, '`assessment_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_id->IsForeignKey = TRUE; // Foreign key field
		$this->assessment_id->Nullable = FALSE; // NOT NULL field
		$this->assessment_id->Required = TRUE; // Required field
		$this->assessment_id->Sortable = TRUE; // Allow sort
		$this->assessment_id->Lookup = new Lookup('assessment_id', 'assessments', FALSE, 'id', ["id","","",""], [], [], [], [], [], [], '', '');
		$this->assessment_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['assessment_id'] = &$this->assessment_id;

		// section_id
		$this->section_id = new DbField('answers', 'answers', 'x_section_id', 'section_id', '`section_id`', '`section_id`', 19, 11, -1, FALSE, '`section_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->section_id->Nullable = FALSE; // NOT NULL field
		$this->section_id->Required = TRUE; // Required field
		$this->section_id->Sortable = TRUE; // Allow sort
		$this->section_id->Lookup = new Lookup('section_id', 'sections', FALSE, 'id', ["title","","",""], [], [], [], [], [], [], '', '');
		$this->section_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['section_id'] = &$this->section_id;

		// response
		$this->_response = new DbField('answers', 'answers', 'x__response', 'response', '`response`', '`response`', 200, 255, -1, FALSE, '`response`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_response->Sortable = TRUE; // Allow sort
		$this->fields['response'] = &$this->_response;

		// score
		$this->score = new DbField('answers', 'answers', 'x_score', 'score', '`score`', '`score`', 131, 5, -1, FALSE, '`score`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->score->Sortable = TRUE; // Allow sort
		$this->score->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['score'] = &$this->score;

		// recommendations
		$this->recommendations = new DbField('answers', 'answers', 'x_recommendations', 'recommendations', '`recommendations`', '`recommendations`', 201, 65535, -1, FALSE, '`recommendations`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->recommendations->Sortable = TRUE; // Allow sort
		$this->fields['recommendations'] = &$this->recommendations;

		// created_at
		$this->created_at = new DbField('answers', 'answers', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// updated_at
		$this->updated_at = new DbField('answers', 'answers', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_at->Sortable = TRUE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;

		// weight
		$this->weight = new DbField('answers', 'answers', 'x_weight', 'weight', '`weight`', '`weight`', 131, 5, -1, FALSE, '`weight`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->weight->Sortable = TRUE; // Allow sort
		$this->weight->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['weight'] = &$this->weight;
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
		if ($this->getCurrentMasterTable() == "questions") {
			if ($this->question_id->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->question_id->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "assessments") {
			if ($this->assessment_id->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->assessment_id->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "questions") {
			if ($this->question_id->getSessionValue() != "")
				$detailFilter .= "`question_id`=" . QuotedValue($this->question_id->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "assessments") {
			if ($this->assessment_id->getSessionValue() != "")
				$detailFilter .= "`assessment_id`=" . QuotedValue($this->assessment_id->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_questions()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_questions()
	{
		return "`question_id`=@question_id@";
	}

	// Master filter
	public function sqlMasterFilter_assessments()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_assessments()
	{
		return "`assessment_id`=@assessment_id@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`answers`";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
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
		global $Security;

		// Add User ID filter
		if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
			if ($this->getCurrentMasterTable() == "questions" || $this->getCurrentMasterTable() == "")
				$filter = $this->addDetailUserIDFilter($filter, "questions"); // Add detail User ID filter
			if ($this->getCurrentMasterTable() == "assessments" || $this->getCurrentMasterTable() == "")
				$filter = $this->addDetailUserIDFilter($filter, "assessments"); // Add detail User ID filter
		}
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
		$this->question_id->DbValue = $row['question_id'];
		$this->assessment_id->DbValue = $row['assessment_id'];
		$this->section_id->DbValue = $row['section_id'];
		$this->_response->DbValue = $row['response'];
		$this->score->DbValue = $row['score'];
		$this->recommendations->DbValue = $row['recommendations'];
		$this->created_at->DbValue = $row['created_at'];
		$this->updated_at->DbValue = $row['updated_at'];
		$this->weight->DbValue = $row['weight'];
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
			return "answerslist.php";
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
		if ($pageName == "answersview.php")
			return $Language->phrase("View");
		elseif ($pageName == "answersedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "answersadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "answerslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("answersview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("answersview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "answersadd.php?" . $this->getUrlParm($parm);
		else
			$url = "answersadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("answersedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("answersadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("answersdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "questions" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->question_id->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "assessments" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->assessment_id->CurrentValue);
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
		$this->question_id->setDbValue($rs->fields('question_id'));
		$this->assessment_id->setDbValue($rs->fields('assessment_id'));
		$this->section_id->setDbValue($rs->fields('section_id'));
		$this->_response->setDbValue($rs->fields('response'));
		$this->score->setDbValue($rs->fields('score'));
		$this->recommendations->setDbValue($rs->fields('recommendations'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
		$this->weight->setDbValue($rs->fields('weight'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// question_id
		// assessment_id
		// section_id
		// response
		// score
		// recommendations
		// created_at
		// updated_at
		// weight
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewValue = FormatNumber($this->id->ViewValue, 0, -2, -2, -2);
		$this->id->ViewCustomAttributes = "";

		// question_id
		$this->question_id->ViewValue = $this->question_id->CurrentValue;
		$curVal = strval($this->question_id->CurrentValue);
		if ($curVal != "") {
			$this->question_id->ViewValue = $this->question_id->lookupCacheOption($curVal);
			if ($this->question_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->question_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
					$arwrk[2] = $rswrk->fields('df2');
					$this->question_id->ViewValue = $this->question_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->question_id->ViewValue = $this->question_id->CurrentValue;
				}
			}
		} else {
			$this->question_id->ViewValue = NULL;
		}
		$this->question_id->ViewCustomAttributes = "";

		// assessment_id
		$this->assessment_id->ViewValue = $this->assessment_id->CurrentValue;
		$curVal = strval($this->assessment_id->CurrentValue);
		if ($curVal != "") {
			$this->assessment_id->ViewValue = $this->assessment_id->lookupCacheOption($curVal);
			if ($this->assessment_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->assessment_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
					$this->assessment_id->ViewValue = $this->assessment_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->assessment_id->ViewValue = $this->assessment_id->CurrentValue;
				}
			}
		} else {
			$this->assessment_id->ViewValue = NULL;
		}
		$this->assessment_id->ViewCustomAttributes = "";

		// section_id
		$this->section_id->ViewValue = $this->section_id->CurrentValue;
		$curVal = strval($this->section_id->CurrentValue);
		if ($curVal != "") {
			$this->section_id->ViewValue = $this->section_id->lookupCacheOption($curVal);
			if ($this->section_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->section_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->section_id->ViewValue = $this->section_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->section_id->ViewValue = $this->section_id->CurrentValue;
				}
			}
		} else {
			$this->section_id->ViewValue = NULL;
		}
		$this->section_id->ViewCustomAttributes = "";

		// response
		$this->_response->ViewValue = $this->_response->CurrentValue;
		$this->_response->ViewCustomAttributes = "";

		// score
		$this->score->ViewValue = $this->score->CurrentValue;
		$this->score->ViewValue = FormatNumber($this->score->ViewValue, 2, -2, -2, -2);
		$this->score->ViewCustomAttributes = "";

		// recommendations
		$this->recommendations->ViewValue = $this->recommendations->CurrentValue;
		$this->recommendations->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// updated_at
		$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
		$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
		$this->updated_at->ViewCustomAttributes = "";

		// weight
		$this->weight->ViewValue = $this->weight->CurrentValue;
		$this->weight->ViewValue = FormatNumber($this->weight->ViewValue, 2, -2, -2, -2);
		$this->weight->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// question_id
		$this->question_id->LinkCustomAttributes = "";
		$this->question_id->HrefValue = "";
		$this->question_id->TooltipValue = "";

		// assessment_id
		$this->assessment_id->LinkCustomAttributes = "";
		$this->assessment_id->HrefValue = "";
		$this->assessment_id->TooltipValue = "";

		// section_id
		$this->section_id->LinkCustomAttributes = "";
		$this->section_id->HrefValue = "";
		$this->section_id->TooltipValue = "";

		// response
		$this->_response->LinkCustomAttributes = "";
		$this->_response->HrefValue = "";
		$this->_response->TooltipValue = "";

		// score
		$this->score->LinkCustomAttributes = "";
		$this->score->HrefValue = "";
		$this->score->TooltipValue = "";

		// recommendations
		$this->recommendations->LinkCustomAttributes = "";
		$this->recommendations->HrefValue = "";
		$this->recommendations->TooltipValue = "";

		// created_at
		$this->created_at->LinkCustomAttributes = "";
		$this->created_at->HrefValue = "";
		$this->created_at->TooltipValue = "";

		// updated_at
		$this->updated_at->LinkCustomAttributes = "";
		$this->updated_at->HrefValue = "";
		$this->updated_at->TooltipValue = "";

		// weight
		$this->weight->LinkCustomAttributes = "";
		$this->weight->HrefValue = "";
		$this->weight->TooltipValue = "";

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

		// question_id
		$this->question_id->EditAttrs["class"] = "form-control";
		$this->question_id->EditCustomAttributes = "";
		if ($this->question_id->getSessionValue() != "") {
			$this->question_id->CurrentValue = $this->question_id->getSessionValue();
			$this->question_id->ViewValue = $this->question_id->CurrentValue;
			$curVal = strval($this->question_id->CurrentValue);
			if ($curVal != "") {
				$this->question_id->ViewValue = $this->question_id->lookupCacheOption($curVal);
				if ($this->question_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->question_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
						$arwrk[2] = $rswrk->fields('df2');
						$this->question_id->ViewValue = $this->question_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->question_id->ViewValue = $this->question_id->CurrentValue;
					}
				}
			} else {
				$this->question_id->ViewValue = NULL;
			}
			$this->question_id->ViewCustomAttributes = "";
		} else {
			$this->question_id->EditValue = $this->question_id->CurrentValue;
			$this->question_id->PlaceHolder = RemoveHtml($this->question_id->caption());
		}

		// assessment_id
		$this->assessment_id->EditAttrs["class"] = "form-control";
		$this->assessment_id->EditCustomAttributes = "";
		if ($this->assessment_id->getSessionValue() != "") {
			$this->assessment_id->CurrentValue = $this->assessment_id->getSessionValue();
			$this->assessment_id->ViewValue = $this->assessment_id->CurrentValue;
			$curVal = strval($this->assessment_id->CurrentValue);
			if ($curVal != "") {
				$this->assessment_id->ViewValue = $this->assessment_id->lookupCacheOption($curVal);
				if ($this->assessment_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->assessment_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
						$this->assessment_id->ViewValue = $this->assessment_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->assessment_id->ViewValue = $this->assessment_id->CurrentValue;
					}
				}
			} else {
				$this->assessment_id->ViewValue = NULL;
			}
			$this->assessment_id->ViewCustomAttributes = "";
		} else {
			$this->assessment_id->EditValue = $this->assessment_id->CurrentValue;
			$this->assessment_id->PlaceHolder = RemoveHtml($this->assessment_id->caption());
		}

		// section_id
		$this->section_id->EditAttrs["class"] = "form-control";
		$this->section_id->EditCustomAttributes = "";
		$this->section_id->EditValue = $this->section_id->CurrentValue;
		$this->section_id->PlaceHolder = RemoveHtml($this->section_id->caption());

		// response
		$this->_response->EditAttrs["class"] = "form-control";
		$this->_response->EditCustomAttributes = "";
		if (!$this->_response->Raw)
			$this->_response->CurrentValue = HtmlDecode($this->_response->CurrentValue);
		$this->_response->EditValue = $this->_response->CurrentValue;
		$this->_response->PlaceHolder = RemoveHtml($this->_response->caption());

		// score
		$this->score->EditAttrs["class"] = "form-control";
		$this->score->EditCustomAttributes = "";
		$this->score->EditValue = $this->score->CurrentValue;
		$this->score->PlaceHolder = RemoveHtml($this->score->caption());
		if (strval($this->score->EditValue) != "" && is_numeric($this->score->EditValue))
			$this->score->EditValue = FormatNumber($this->score->EditValue, -2, -2, -2, -2);
		

		// recommendations
		$this->recommendations->EditAttrs["class"] = "form-control";
		$this->recommendations->EditCustomAttributes = "";
		$this->recommendations->EditValue = $this->recommendations->CurrentValue;
		$this->recommendations->PlaceHolder = RemoveHtml($this->recommendations->caption());

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

		// weight
		$this->weight->EditAttrs["class"] = "form-control";
		$this->weight->EditCustomAttributes = "";
		$this->weight->EditValue = $this->weight->CurrentValue;
		$this->weight->PlaceHolder = RemoveHtml($this->weight->caption());
		if (strval($this->weight->EditValue) != "" && is_numeric($this->weight->EditValue))
			$this->weight->EditValue = FormatNumber($this->weight->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->question_id);
					$doc->exportCaption($this->assessment_id);
					$doc->exportCaption($this->section_id);
					$doc->exportCaption($this->_response);
					$doc->exportCaption($this->score);
					$doc->exportCaption($this->recommendations);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->updated_at);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->question_id);
					$doc->exportCaption($this->assessment_id);
					$doc->exportCaption($this->section_id);
					$doc->exportCaption($this->_response);
					$doc->exportCaption($this->score);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->updated_at);
					$doc->exportCaption($this->weight);
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
						$doc->exportField($this->question_id);
						$doc->exportField($this->assessment_id);
						$doc->exportField($this->section_id);
						$doc->exportField($this->_response);
						$doc->exportField($this->score);
						$doc->exportField($this->recommendations);
						$doc->exportField($this->created_at);
						$doc->exportField($this->updated_at);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->question_id);
						$doc->exportField($this->assessment_id);
						$doc->exportField($this->section_id);
						$doc->exportField($this->_response);
						$doc->exportField($this->score);
						$doc->exportField($this->created_at);
						$doc->exportField($this->updated_at);
						$doc->exportField($this->weight);
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

	// Add master User ID filter
	public function addMasterUserIDFilter($filter, $currentMasterTable)
	{
		$filterWrk = $filter;
		if ($currentMasterTable == "assessments") {
			$filterWrk = $GLOBALS["assessments"]->addUserIDFilter($filterWrk);
		}
		return $filterWrk;
	}

	// Add detail User ID filter
	public function addDetailUserIDFilter($filter, $currentMasterTable)
	{
		$filterWrk = $filter;
		if ($currentMasterTable == "assessments") {
			$mastertable = $GLOBALS["assessments"];
			if (!$mastertable->userIDAllow()) {
				$subqueryWrk = $mastertable->getUserIDSubquery($this->assessment_id, $mastertable->id);
				AddFilter($filterWrk, $subqueryWrk);
			}
		}
		return $filterWrk;
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
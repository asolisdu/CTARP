<?php namespace PHPMaker2020\IDB_EcoMicro_BZ; ?>
<?php

/**
 * Table class for assessments
 */
class assessments extends DbTable
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
	public $user_id;
	public $customer_id;
	public $customer_first_name;
	public $customer_age;
	public $sex;
	public $address;
	public $total_score;
	public $status;
	public $loan_purpose;
	public $loan_section;
	public $customer_last_name;
	public $lat;
	public $lon;
	public $created_at;
	public $updated_at;
	public $personal_id;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'assessments';
		$this->TableName = 'assessments';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`assessments`";
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
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('assessments', 'assessments', 'x_id', 'id', '`id`', '`id`', 19, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->IsForeignKey = TRUE; // Foreign key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// user_id
		$this->user_id = new DbField('assessments', 'assessments', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 19, 11, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_id->IsForeignKey = TRUE; // Foreign key field
		$this->user_id->Nullable = FALSE; // NOT NULL field
		$this->user_id->Required = TRUE; // Required field
		$this->user_id->Sortable = TRUE; // Allow sort
		$this->user_id->Lookup = new Lookup('user_id', 'users', FALSE, 'id', ["id","first_names","last_names",""], [], [], [], [], [], [], '', '');
		$this->user_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['user_id'] = &$this->user_id;

		// customer_id
		$this->customer_id = new DbField('assessments', 'assessments', 'x_customer_id', 'customer_id', '`customer_id`', '`customer_id`', 200, 255, -1, FALSE, '`customer_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_id->Sortable = TRUE; // Allow sort
		$this->fields['customer_id'] = &$this->customer_id;

		// customer_first_name
		$this->customer_first_name = new DbField('assessments', 'assessments', 'x_customer_first_name', 'customer_first_name', '`customer_first_name`', '`customer_first_name`', 200, 255, -1, FALSE, '`customer_first_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_first_name->Sortable = TRUE; // Allow sort
		$this->fields['customer_first_name'] = &$this->customer_first_name;

		// customer_age
		$this->customer_age = new DbField('assessments', 'assessments', 'x_customer_age', 'customer_age', '`customer_age`', '`customer_age`', 3, 11, -1, FALSE, '`customer_age`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_age->Sortable = TRUE; // Allow sort
		$this->customer_age->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['customer_age'] = &$this->customer_age;

		// sex
		$this->sex = new DbField('assessments', 'assessments', 'x_sex', 'sex', '`sex`', '`sex`', 200, 1, -1, FALSE, '`sex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sex->Sortable = TRUE; // Allow sort
		$this->fields['sex'] = &$this->sex;

		// address
		$this->address = new DbField('assessments', 'assessments', 'x_address', 'address', '`address`', '`address`', 200, 255, -1, FALSE, '`address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address->Sortable = TRUE; // Allow sort
		$this->fields['address'] = &$this->address;

		// total_score
		$this->total_score = new DbField('assessments', 'assessments', 'x_total_score', 'total_score', '`total_score`', '`total_score`', 131, 10, -1, FALSE, '`total_score`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_score->Sortable = TRUE; // Allow sort
		$this->total_score->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total_score'] = &$this->total_score;

		// status
		$this->status = new DbField('assessments', 'assessments', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->status->Lookup = new Lookup('status', 'assessments', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->status->OptionCount = 3;
		$this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;

		// loan_purpose
		$this->loan_purpose = new DbField('assessments', 'assessments', 'x_loan_purpose', 'loan_purpose', '`loan_purpose`', '`loan_purpose`', 19, 10, -1, FALSE, '`loan_purpose`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->loan_purpose->IsForeignKey = TRUE; // Foreign key field
		$this->loan_purpose->Sortable = TRUE; // Allow sort
		$this->loan_purpose->Lookup = new Lookup('loan_purpose', 'loan_purposes', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->loan_purpose->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['loan_purpose'] = &$this->loan_purpose;

		// loan_section
		$this->loan_section = new DbField('assessments', 'assessments', 'x_loan_section', 'loan_section', '`loan_section`', '`loan_section`', 19, 10, -1, FALSE, '`loan_section`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->loan_section->IsForeignKey = TRUE; // Foreign key field
		$this->loan_section->Sortable = TRUE; // Allow sort
		$this->loan_section->Lookup = new Lookup('loan_section', 'loan_section', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->loan_section->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['loan_section'] = &$this->loan_section;

		// customer_last_name
		$this->customer_last_name = new DbField('assessments', 'assessments', 'x_customer_last_name', 'customer_last_name', '`customer_last_name`', '`customer_last_name`', 200, 255, -1, FALSE, '`customer_last_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_last_name->Sortable = TRUE; // Allow sort
		$this->fields['customer_last_name'] = &$this->customer_last_name;

		// lat
		$this->lat = new DbField('assessments', 'assessments', 'x_lat', 'lat', '`lat`', '`lat`', 131, 10, -1, FALSE, '`lat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lat->Sortable = TRUE; // Allow sort
		$this->lat->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['lat'] = &$this->lat;

		// lon
		$this->lon = new DbField('assessments', 'assessments', 'x_lon', 'lon', '`lon`', '`lon`', 131, 10, -1, FALSE, '`lon`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lon->Sortable = TRUE; // Allow sort
		$this->lon->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['lon'] = &$this->lon;

		// created_at
		$this->created_at = new DbField('assessments', 'assessments', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// updated_at
		$this->updated_at = new DbField('assessments', 'assessments', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_at->Sortable = TRUE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;

		// personal_id
		$this->personal_id = new DbField('assessments', 'assessments', 'x_personal_id', 'personal_id', '`personal_id`', '`personal_id`', 200, 255, -1, FALSE, '`personal_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->personal_id->Sortable = TRUE; // Allow sort
		$this->fields['personal_id'] = &$this->personal_id;
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
		if ($this->getCurrentMasterTable() == "users") {
			if ($this->user_id->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->user_id->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "loan_purposes") {
			if ($this->loan_purpose->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->loan_purpose->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "loan_section") {
			if ($this->loan_section->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->loan_section->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "users") {
			if ($this->user_id->getSessionValue() != "")
				$detailFilter .= "`user_id`=" . QuotedValue($this->user_id->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "loan_purposes") {
			if ($this->loan_purpose->getSessionValue() != "")
				$detailFilter .= "`loan_purpose`=" . QuotedValue($this->loan_purpose->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "loan_section") {
			if ($this->loan_section->getSessionValue() != "")
				$detailFilter .= "`loan_section`=" . QuotedValue($this->loan_section->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_users()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_users()
	{
		return "`user_id`=@user_id@";
	}

	// Master filter
	public function sqlMasterFilter_loan_purposes()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_loan_purposes()
	{
		return "`loan_purpose`=@loan_purpose@";
	}

	// Master filter
	public function sqlMasterFilter_loan_section()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_loan_section()
	{
		return "`loan_section`=@loan_section@";
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
		if ($this->getCurrentDetailTable() == "results") {
			$detailUrl = $GLOBALS["results"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "answers") {
			$detailUrl = $GLOBALS["answers"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "assessmentslist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`assessments`";
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
			if ($this->getCurrentMasterTable() == "users" || $this->getCurrentMasterTable() == "")
				$filter = $this->addDetailUserIDFilter($filter, "users"); // Add detail User ID filter
			if ($this->getCurrentMasterTable() == "loan_purposes" || $this->getCurrentMasterTable() == "")
				$filter = $this->addDetailUserIDFilter($filter, "loan_purposes"); // Add detail User ID filter
			if ($this->getCurrentMasterTable() == "loan_section" || $this->getCurrentMasterTable() == "")
				$filter = $this->addDetailUserIDFilter($filter, "loan_section"); // Add detail User ID filter
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

		// Cascade Update detail table 'results'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['id']) && $rsold['id'] != $rs['id'])) { // Update detail field 'assessment_id'
			$cascadeUpdate = TRUE;
			$rscascade['assessment_id'] = $rs['id'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["results"]))
				$GLOBALS["results"] = new results();
			$rswrk = $GLOBALS["results"]->loadRs("`assessment_id` = " . QuotedValue($rsold['id'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'id';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["results"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["results"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["results"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
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

		// Cascade delete detail table 'results'
		if (!isset($GLOBALS["results"]))
			$GLOBALS["results"] = new results();
		$rscascade = $GLOBALS["results"]->loadRs("`assessment_id` = " . QuotedValue($rs['id'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["results"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["results"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["results"]->Row_Deleted($dtlrow);
		}
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
		$this->user_id->DbValue = $row['user_id'];
		$this->customer_id->DbValue = $row['customer_id'];
		$this->customer_first_name->DbValue = $row['customer_first_name'];
		$this->customer_age->DbValue = $row['customer_age'];
		$this->sex->DbValue = $row['sex'];
		$this->address->DbValue = $row['address'];
		$this->total_score->DbValue = $row['total_score'];
		$this->status->DbValue = $row['status'];
		$this->loan_purpose->DbValue = $row['loan_purpose'];
		$this->loan_section->DbValue = $row['loan_section'];
		$this->customer_last_name->DbValue = $row['customer_last_name'];
		$this->lat->DbValue = $row['lat'];
		$this->lon->DbValue = $row['lon'];
		$this->created_at->DbValue = $row['created_at'];
		$this->updated_at->DbValue = $row['updated_at'];
		$this->personal_id->DbValue = $row['personal_id'];
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
			return "assessmentslist.php";
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
		if ($pageName == "assessmentsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "assessmentsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "assessmentsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "assessmentslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("assessmentsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("assessmentsview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "assessmentsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "assessmentsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("assessmentsedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("assessmentsedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("assessmentsadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("assessmentsadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("assessmentsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "users" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->user_id->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "loan_purposes" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->loan_purpose->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "loan_section" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->loan_section->CurrentValue);
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
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->customer_id->setDbValue($rs->fields('customer_id'));
		$this->customer_first_name->setDbValue($rs->fields('customer_first_name'));
		$this->customer_age->setDbValue($rs->fields('customer_age'));
		$this->sex->setDbValue($rs->fields('sex'));
		$this->address->setDbValue($rs->fields('address'));
		$this->total_score->setDbValue($rs->fields('total_score'));
		$this->status->setDbValue($rs->fields('status'));
		$this->loan_purpose->setDbValue($rs->fields('loan_purpose'));
		$this->loan_section->setDbValue($rs->fields('loan_section'));
		$this->customer_last_name->setDbValue($rs->fields('customer_last_name'));
		$this->lat->setDbValue($rs->fields('lat'));
		$this->lon->setDbValue($rs->fields('lon'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
		$this->personal_id->setDbValue($rs->fields('personal_id'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// user_id
		// customer_id
		// customer_first_name
		// customer_age
		// sex
		// address
		// total_score
		// status
		// loan_purpose
		// loan_section
		// customer_last_name
		// lat
		// lon
		// created_at
		// updated_at
		// personal_id

		$this->personal_id->CellCssStyle = "white-space: nowrap;";

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewValue = FormatNumber($this->id->ViewValue, 0, -2, -2, -2);
		$this->id->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$curVal = strval($this->user_id->CurrentValue);
		if ($curVal != "") {
			$this->user_id->ViewValue = $this->user_id->lookupCacheOption($curVal);
			if ($this->user_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->user_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = $rswrk->fields('df3');
					$this->user_id->ViewValue = $this->user_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->user_id->ViewValue = $this->user_id->CurrentValue;
				}
			}
		} else {
			$this->user_id->ViewValue = NULL;
		}
		$this->user_id->ViewCustomAttributes = "";

		// customer_id
		$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
		$this->customer_id->ViewCustomAttributes = "";

		// customer_first_name
		$this->customer_first_name->ViewValue = $this->customer_first_name->CurrentValue;
		$this->customer_first_name->ViewCustomAttributes = "";

		// customer_age
		$this->customer_age->ViewValue = $this->customer_age->CurrentValue;
		$this->customer_age->ViewValue = FormatNumber($this->customer_age->ViewValue, 0, -2, -2, -2);
		$this->customer_age->ViewCustomAttributes = "";

		// sex
		$this->sex->ViewValue = $this->sex->CurrentValue;
		$this->sex->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// total_score
		$this->total_score->ViewValue = $this->total_score->CurrentValue;
		$this->total_score->ViewValue = FormatNumber($this->total_score->ViewValue, 2, -2, -2, -2);
		$this->total_score->ViewCustomAttributes = "";

		// status
		if (strval($this->status->CurrentValue) != "") {
			$this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->ViewCustomAttributes = "";

		// loan_purpose
		$this->loan_purpose->ViewValue = $this->loan_purpose->CurrentValue;
		$curVal = strval($this->loan_purpose->CurrentValue);
		if ($curVal != "") {
			$this->loan_purpose->ViewValue = $this->loan_purpose->lookupCacheOption($curVal);
			if ($this->loan_purpose->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->loan_purpose->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->loan_purpose->ViewValue = $this->loan_purpose->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->loan_purpose->ViewValue = $this->loan_purpose->CurrentValue;
				}
			}
		} else {
			$this->loan_purpose->ViewValue = NULL;
		}
		$this->loan_purpose->ViewCustomAttributes = "";

		// loan_section
		$this->loan_section->ViewValue = $this->loan_section->CurrentValue;
		$curVal = strval($this->loan_section->CurrentValue);
		if ($curVal != "") {
			$this->loan_section->ViewValue = $this->loan_section->lookupCacheOption($curVal);
			if ($this->loan_section->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->loan_section->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->loan_section->ViewValue = $this->loan_section->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->loan_section->ViewValue = $this->loan_section->CurrentValue;
				}
			}
		} else {
			$this->loan_section->ViewValue = NULL;
		}
		$this->loan_section->ViewCustomAttributes = "";

		// customer_last_name
		$this->customer_last_name->ViewValue = $this->customer_last_name->CurrentValue;
		$this->customer_last_name->ViewCustomAttributes = "";

		// lat
		$this->lat->ViewValue = $this->lat->CurrentValue;
		$this->lat->ViewValue = FormatNumber($this->lat->ViewValue, 2, -2, -2, -2);
		$this->lat->ViewCustomAttributes = "";

		// lon
		$this->lon->ViewValue = $this->lon->CurrentValue;
		$this->lon->ViewValue = FormatNumber($this->lon->ViewValue, 2, -2, -2, -2);
		$this->lon->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// updated_at
		$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
		$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
		$this->updated_at->ViewCustomAttributes = "";

		// personal_id
		$this->personal_id->ViewValue = $this->personal_id->CurrentValue;
		$this->personal_id->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// user_id
		$this->user_id->LinkCustomAttributes = "";
		$this->user_id->HrefValue = "";
		$this->user_id->TooltipValue = "";

		// customer_id
		$this->customer_id->LinkCustomAttributes = "";
		$this->customer_id->HrefValue = "";
		$this->customer_id->TooltipValue = "";

		// customer_first_name
		$this->customer_first_name->LinkCustomAttributes = "";
		$this->customer_first_name->HrefValue = "";
		$this->customer_first_name->TooltipValue = "";

		// customer_age
		$this->customer_age->LinkCustomAttributes = "";
		$this->customer_age->HrefValue = "";
		$this->customer_age->TooltipValue = "";

		// sex
		$this->sex->LinkCustomAttributes = "";
		$this->sex->HrefValue = "";
		$this->sex->TooltipValue = "";

		// address
		$this->address->LinkCustomAttributes = "";
		$this->address->HrefValue = "";
		$this->address->TooltipValue = "";

		// total_score
		$this->total_score->LinkCustomAttributes = "";
		$this->total_score->HrefValue = "";
		$this->total_score->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// loan_purpose
		$this->loan_purpose->LinkCustomAttributes = "";
		$this->loan_purpose->HrefValue = "";
		$this->loan_purpose->TooltipValue = "";

		// loan_section
		$this->loan_section->LinkCustomAttributes = "";
		$this->loan_section->HrefValue = "";
		$this->loan_section->TooltipValue = "";

		// customer_last_name
		$this->customer_last_name->LinkCustomAttributes = "";
		$this->customer_last_name->HrefValue = "";
		$this->customer_last_name->TooltipValue = "";

		// lat
		$this->lat->LinkCustomAttributes = "";
		$this->lat->HrefValue = "";
		$this->lat->TooltipValue = "";

		// lon
		$this->lon->LinkCustomAttributes = "";
		$this->lon->HrefValue = "";
		$this->lon->TooltipValue = "";

		// created_at
		$this->created_at->LinkCustomAttributes = "";
		$this->created_at->HrefValue = "";
		$this->created_at->TooltipValue = "";

		// updated_at
		$this->updated_at->LinkCustomAttributes = "";
		$this->updated_at->HrefValue = "";
		$this->updated_at->TooltipValue = "";

		// personal_id
		$this->personal_id->LinkCustomAttributes = "";
		$this->personal_id->HrefValue = "";
		$this->personal_id->TooltipValue = "";

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

		// user_id
		$this->user_id->EditAttrs["class"] = "form-control";
		$this->user_id->EditCustomAttributes = "";
		if ($this->user_id->getSessionValue() != "") {
			$this->user_id->CurrentValue = $this->user_id->getSessionValue();
			$this->user_id->ViewValue = $this->user_id->CurrentValue;
			$curVal = strval($this->user_id->CurrentValue);
			if ($curVal != "") {
				$this->user_id->ViewValue = $this->user_id->lookupCacheOption($curVal);
				if ($this->user_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->user_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->user_id->ViewValue = $this->user_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->user_id->ViewValue = $this->user_id->CurrentValue;
					}
				}
			} else {
				$this->user_id->ViewValue = NULL;
			}
			$this->user_id->ViewCustomAttributes = "";
		} else {
			$this->user_id->EditValue = $this->user_id->CurrentValue;
			$this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());
		}

		// customer_id
		$this->customer_id->EditAttrs["class"] = "form-control";
		$this->customer_id->EditCustomAttributes = "";
		if (!$this->customer_id->Raw)
			$this->customer_id->CurrentValue = HtmlDecode($this->customer_id->CurrentValue);
		$this->customer_id->EditValue = $this->customer_id->CurrentValue;
		$this->customer_id->PlaceHolder = RemoveHtml($this->customer_id->caption());

		// customer_first_name
		$this->customer_first_name->EditAttrs["class"] = "form-control";
		$this->customer_first_name->EditCustomAttributes = "";
		if (!$this->customer_first_name->Raw)
			$this->customer_first_name->CurrentValue = HtmlDecode($this->customer_first_name->CurrentValue);
		$this->customer_first_name->EditValue = $this->customer_first_name->CurrentValue;
		$this->customer_first_name->PlaceHolder = RemoveHtml($this->customer_first_name->caption());

		// customer_age
		$this->customer_age->EditAttrs["class"] = "form-control";
		$this->customer_age->EditCustomAttributes = "";
		$this->customer_age->EditValue = $this->customer_age->CurrentValue;
		$this->customer_age->PlaceHolder = RemoveHtml($this->customer_age->caption());

		// sex
		$this->sex->EditAttrs["class"] = "form-control";
		$this->sex->EditCustomAttributes = "";
		if (!$this->sex->Raw)
			$this->sex->CurrentValue = HtmlDecode($this->sex->CurrentValue);
		$this->sex->EditValue = $this->sex->CurrentValue;
		$this->sex->PlaceHolder = RemoveHtml($this->sex->caption());

		// address
		$this->address->EditAttrs["class"] = "form-control";
		$this->address->EditCustomAttributes = "";
		if (!$this->address->Raw)
			$this->address->CurrentValue = HtmlDecode($this->address->CurrentValue);
		$this->address->EditValue = $this->address->CurrentValue;
		$this->address->PlaceHolder = RemoveHtml($this->address->caption());

		// total_score
		$this->total_score->EditAttrs["class"] = "form-control";
		$this->total_score->EditCustomAttributes = "";
		$this->total_score->EditValue = $this->total_score->CurrentValue;
		$this->total_score->PlaceHolder = RemoveHtml($this->total_score->caption());
		if (strval($this->total_score->EditValue) != "" && is_numeric($this->total_score->EditValue))
			$this->total_score->EditValue = FormatNumber($this->total_score->EditValue, -2, -2, -2, -2);
		

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";
		$this->status->EditValue = $this->status->options(TRUE);

		// loan_purpose
		$this->loan_purpose->EditAttrs["class"] = "form-control";
		$this->loan_purpose->EditCustomAttributes = "";
		if ($this->loan_purpose->getSessionValue() != "") {
			$this->loan_purpose->CurrentValue = $this->loan_purpose->getSessionValue();
			$this->loan_purpose->ViewValue = $this->loan_purpose->CurrentValue;
			$curVal = strval($this->loan_purpose->CurrentValue);
			if ($curVal != "") {
				$this->loan_purpose->ViewValue = $this->loan_purpose->lookupCacheOption($curVal);
				if ($this->loan_purpose->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->loan_purpose->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->loan_purpose->ViewValue = $this->loan_purpose->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->loan_purpose->ViewValue = $this->loan_purpose->CurrentValue;
					}
				}
			} else {
				$this->loan_purpose->ViewValue = NULL;
			}
			$this->loan_purpose->ViewCustomAttributes = "";
		} else {
			$this->loan_purpose->EditValue = $this->loan_purpose->CurrentValue;
			$this->loan_purpose->PlaceHolder = RemoveHtml($this->loan_purpose->caption());
		}

		// loan_section
		$this->loan_section->EditAttrs["class"] = "form-control";
		$this->loan_section->EditCustomAttributes = "";
		if ($this->loan_section->getSessionValue() != "") {
			$this->loan_section->CurrentValue = $this->loan_section->getSessionValue();
			$this->loan_section->ViewValue = $this->loan_section->CurrentValue;
			$curVal = strval($this->loan_section->CurrentValue);
			if ($curVal != "") {
				$this->loan_section->ViewValue = $this->loan_section->lookupCacheOption($curVal);
				if ($this->loan_section->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->loan_section->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->loan_section->ViewValue = $this->loan_section->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->loan_section->ViewValue = $this->loan_section->CurrentValue;
					}
				}
			} else {
				$this->loan_section->ViewValue = NULL;
			}
			$this->loan_section->ViewCustomAttributes = "";
		} else {
			$this->loan_section->EditValue = $this->loan_section->CurrentValue;
			$this->loan_section->PlaceHolder = RemoveHtml($this->loan_section->caption());
		}

		// customer_last_name
		$this->customer_last_name->EditAttrs["class"] = "form-control";
		$this->customer_last_name->EditCustomAttributes = "";
		if (!$this->customer_last_name->Raw)
			$this->customer_last_name->CurrentValue = HtmlDecode($this->customer_last_name->CurrentValue);
		$this->customer_last_name->EditValue = $this->customer_last_name->CurrentValue;
		$this->customer_last_name->PlaceHolder = RemoveHtml($this->customer_last_name->caption());

		// lat
		$this->lat->EditAttrs["class"] = "form-control";
		$this->lat->EditCustomAttributes = "";
		$this->lat->EditValue = $this->lat->CurrentValue;
		$this->lat->PlaceHolder = RemoveHtml($this->lat->caption());
		if (strval($this->lat->EditValue) != "" && is_numeric($this->lat->EditValue))
			$this->lat->EditValue = FormatNumber($this->lat->EditValue, -2, -2, -2, -2);
		

		// lon
		$this->lon->EditAttrs["class"] = "form-control";
		$this->lon->EditCustomAttributes = "";
		$this->lon->EditValue = $this->lon->CurrentValue;
		$this->lon->PlaceHolder = RemoveHtml($this->lon->caption());
		if (strval($this->lon->EditValue) != "" && is_numeric($this->lon->EditValue))
			$this->lon->EditValue = FormatNumber($this->lon->EditValue, -2, -2, -2, -2);
		

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

		// personal_id
		$this->personal_id->EditAttrs["class"] = "form-control";
		$this->personal_id->EditCustomAttributes = "";
		if (!$this->personal_id->Raw)
			$this->personal_id->CurrentValue = HtmlDecode($this->personal_id->CurrentValue);
		$this->personal_id->EditValue = $this->personal_id->CurrentValue;
		$this->personal_id->PlaceHolder = RemoveHtml($this->personal_id->caption());

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
					$doc->exportCaption($this->user_id);
					$doc->exportCaption($this->customer_id);
					$doc->exportCaption($this->customer_first_name);
					$doc->exportCaption($this->customer_age);
					$doc->exportCaption($this->sex);
					$doc->exportCaption($this->address);
					$doc->exportCaption($this->total_score);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->loan_purpose);
					$doc->exportCaption($this->loan_section);
					$doc->exportCaption($this->lat);
					$doc->exportCaption($this->lon);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->updated_at);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->user_id);
					$doc->exportCaption($this->customer_id);
					$doc->exportCaption($this->customer_first_name);
					$doc->exportCaption($this->customer_age);
					$doc->exportCaption($this->sex);
					$doc->exportCaption($this->address);
					$doc->exportCaption($this->total_score);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->loan_purpose);
					$doc->exportCaption($this->loan_section);
					$doc->exportCaption($this->customer_last_name);
					$doc->exportCaption($this->lat);
					$doc->exportCaption($this->lon);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->updated_at);
					$doc->exportCaption($this->personal_id);
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
						$doc->exportField($this->user_id);
						$doc->exportField($this->customer_id);
						$doc->exportField($this->customer_first_name);
						$doc->exportField($this->customer_age);
						$doc->exportField($this->sex);
						$doc->exportField($this->address);
						$doc->exportField($this->total_score);
						$doc->exportField($this->status);
						$doc->exportField($this->loan_purpose);
						$doc->exportField($this->loan_section);
						$doc->exportField($this->lat);
						$doc->exportField($this->lon);
						$doc->exportField($this->created_at);
						$doc->exportField($this->updated_at);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->user_id);
						$doc->exportField($this->customer_id);
						$doc->exportField($this->customer_first_name);
						$doc->exportField($this->customer_age);
						$doc->exportField($this->sex);
						$doc->exportField($this->address);
						$doc->exportField($this->total_score);
						$doc->exportField($this->status);
						$doc->exportField($this->loan_purpose);
						$doc->exportField($this->loan_section);
						$doc->exportField($this->customer_last_name);
						$doc->exportField($this->lat);
						$doc->exportField($this->lon);
						$doc->exportField($this->created_at);
						$doc->exportField($this->updated_at);
						$doc->exportField($this->personal_id);
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
		if ($currentMasterTable == "users") {
			$filterWrk = $GLOBALS["users"]->addUserIDFilter($filterWrk);
		}
		return $filterWrk;
	}

	// Add detail User ID filter
	public function addDetailUserIDFilter($filter, $currentMasterTable)
	{
		$filterWrk = $filter;
		if ($currentMasterTable == "users") {
			$mastertable = $GLOBALS["users"];
			if (!$mastertable->userIDAllow()) {
				$subqueryWrk = $mastertable->getUserIDSubquery($this->user_id, $mastertable->id);
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
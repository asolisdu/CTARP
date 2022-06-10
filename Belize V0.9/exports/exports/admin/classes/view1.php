<?php namespace PHPMaker2020\IDB_EcoMicro_BZ; ?>
<?php

/**
 * Table class for view1
 */
class view1 extends DbTable
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
	public $loan_section_id;
	public $loan_section_name;
	public $user_id;
	public $_email;
	public $loan_purpose_id;
	public $loan_purpose_name;
	public $assessment_id;
	public $customer_id;
	public $total_score;
	public $status;
	public $customer_first_name;
	public $customer_last_name;
	public $customer_age;
	public $sex;
	public $address;
	public $lat;
	public $lon;
	public $created_at;
	public $updated_at;
	public $user_level;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'view1';
		$this->TableName = 'view1';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`view1`";
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

		// loan_section_id
		$this->loan_section_id = new DbField('view1', 'view1', 'x_loan_section_id', 'loan_section_id', '`loan_section_id`', '`loan_section_id`', 19, 10, -1, FALSE, '`loan_section_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->loan_section_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->loan_section_id->IsPrimaryKey = TRUE; // Primary key field
		$this->loan_section_id->Sortable = TRUE; // Allow sort
		$this->loan_section_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['loan_section_id'] = &$this->loan_section_id;

		// loan_section_name
		$this->loan_section_name = new DbField('view1', 'view1', 'x_loan_section_name', 'loan_section_name', '`loan_section_name`', '`loan_section_name`', 200, 255, -1, FALSE, '`loan_section_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->loan_section_name->Sortable = TRUE; // Allow sort
		$this->fields['loan_section_name'] = &$this->loan_section_name;

		// user_id
		$this->user_id = new DbField('view1', 'view1', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 19, 11, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->user_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->user_id->IsPrimaryKey = TRUE; // Primary key field
		$this->user_id->Sortable = TRUE; // Allow sort
		$this->user_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['user_id'] = &$this->user_id;

		// email
		$this->_email = new DbField('view1', 'view1', 'x__email', 'email', '`email`', '`email`', 200, 255, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Sortable = TRUE; // Allow sort
		$this->fields['email'] = &$this->_email;

		// loan_purpose_id
		$this->loan_purpose_id = new DbField('view1', 'view1', 'x_loan_purpose_id', 'loan_purpose_id', '`loan_purpose_id`', '`loan_purpose_id`', 19, 10, -1, FALSE, '`loan_purpose_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->loan_purpose_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->loan_purpose_id->IsPrimaryKey = TRUE; // Primary key field
		$this->loan_purpose_id->Sortable = TRUE; // Allow sort
		$this->loan_purpose_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['loan_purpose_id'] = &$this->loan_purpose_id;

		// loan_purpose_name
		$this->loan_purpose_name = new DbField('view1', 'view1', 'x_loan_purpose_name', 'loan_purpose_name', '`loan_purpose_name`', '`loan_purpose_name`', 200, 255, -1, FALSE, '`loan_purpose_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->loan_purpose_name->Sortable = TRUE; // Allow sort
		$this->fields['loan_purpose_name'] = &$this->loan_purpose_name;

		// assessment_id
		$this->assessment_id = new DbField('view1', 'view1', 'x_assessment_id', 'assessment_id', '`assessment_id`', '`assessment_id`', 19, 11, -1, FALSE, '`assessment_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->assessment_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->assessment_id->IsPrimaryKey = TRUE; // Primary key field
		$this->assessment_id->Sortable = TRUE; // Allow sort
		$this->assessment_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['assessment_id'] = &$this->assessment_id;

		// customer_id
		$this->customer_id = new DbField('view1', 'view1', 'x_customer_id', 'customer_id', '`customer_id`', '`customer_id`', 200, 255, -1, FALSE, '`customer_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_id->Sortable = TRUE; // Allow sort
		$this->fields['customer_id'] = &$this->customer_id;

		// total_score
		$this->total_score = new DbField('view1', 'view1', 'x_total_score', 'total_score', '`total_score`', '`total_score`', 131, 10, -1, FALSE, '`total_score`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_score->Sortable = TRUE; // Allow sort
		$this->total_score->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total_score'] = &$this->total_score;

		// status
		$this->status = new DbField('view1', 'view1', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;

		// customer_first_name
		$this->customer_first_name = new DbField('view1', 'view1', 'x_customer_first_name', 'customer_first_name', '`customer_first_name`', '`customer_first_name`', 200, 255, -1, FALSE, '`customer_first_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_first_name->Sortable = TRUE; // Allow sort
		$this->fields['customer_first_name'] = &$this->customer_first_name;

		// customer_last_name
		$this->customer_last_name = new DbField('view1', 'view1', 'x_customer_last_name', 'customer_last_name', '`customer_last_name`', '`customer_last_name`', 200, 255, -1, FALSE, '`customer_last_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_last_name->Sortable = TRUE; // Allow sort
		$this->fields['customer_last_name'] = &$this->customer_last_name;

		// customer_age
		$this->customer_age = new DbField('view1', 'view1', 'x_customer_age', 'customer_age', '`customer_age`', '`customer_age`', 3, 11, -1, FALSE, '`customer_age`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_age->Sortable = TRUE; // Allow sort
		$this->customer_age->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['customer_age'] = &$this->customer_age;

		// sex
		$this->sex = new DbField('view1', 'view1', 'x_sex', 'sex', '`sex`', '`sex`', 200, 1, -1, FALSE, '`sex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sex->Sortable = TRUE; // Allow sort
		$this->fields['sex'] = &$this->sex;

		// address
		$this->address = new DbField('view1', 'view1', 'x_address', 'address', '`address`', '`address`', 200, 255, -1, FALSE, '`address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address->Sortable = TRUE; // Allow sort
		$this->fields['address'] = &$this->address;

		// lat
		$this->lat = new DbField('view1', 'view1', 'x_lat', 'lat', '`lat`', '`lat`', 131, 10, -1, FALSE, '`lat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lat->Sortable = TRUE; // Allow sort
		$this->lat->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['lat'] = &$this->lat;

		// lon
		$this->lon = new DbField('view1', 'view1', 'x_lon', 'lon', '`lon`', '`lon`', 131, 10, -1, FALSE, '`lon`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lon->Sortable = TRUE; // Allow sort
		$this->lon->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['lon'] = &$this->lon;

		// created_at
		$this->created_at = new DbField('view1', 'view1', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// updated_at
		$this->updated_at = new DbField('view1', 'view1', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_at->Sortable = TRUE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;

		// user_level
		$this->user_level = new DbField('view1', 'view1', 'x_user_level', 'user_level', '`user_level`', '`user_level`', 3, 11, -1, FALSE, '`user_level`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->user_level->Sortable = TRUE; // Allow sort
		$this->user_level->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->user_level->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->user_level->Lookup = new Lookup('user_level', 'view1', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->user_level->OptionCount = 3;
		$this->user_level->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['user_level'] = &$this->user_level;
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

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`view1`";
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
			$this->loan_section_id->setDbValue($conn->insert_ID());
			$rs['loan_section_id'] = $this->loan_section_id->DbValue;

			// Get insert id if necessary
			$this->user_id->setDbValue($conn->insert_ID());
			$rs['user_id'] = $this->user_id->DbValue;

			// Get insert id if necessary
			$this->loan_purpose_id->setDbValue($conn->insert_ID());
			$rs['loan_purpose_id'] = $this->loan_purpose_id->DbValue;

			// Get insert id if necessary
			$this->assessment_id->setDbValue($conn->insert_ID());
			$rs['assessment_id'] = $this->assessment_id->DbValue;
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
			if (array_key_exists('loan_section_id', $rs))
				AddFilter($where, QuotedName('loan_section_id', $this->Dbid) . '=' . QuotedValue($rs['loan_section_id'], $this->loan_section_id->DataType, $this->Dbid));
			if (array_key_exists('user_id', $rs))
				AddFilter($where, QuotedName('user_id', $this->Dbid) . '=' . QuotedValue($rs['user_id'], $this->user_id->DataType, $this->Dbid));
			if (array_key_exists('loan_purpose_id', $rs))
				AddFilter($where, QuotedName('loan_purpose_id', $this->Dbid) . '=' . QuotedValue($rs['loan_purpose_id'], $this->loan_purpose_id->DataType, $this->Dbid));
			if (array_key_exists('assessment_id', $rs))
				AddFilter($where, QuotedName('assessment_id', $this->Dbid) . '=' . QuotedValue($rs['assessment_id'], $this->assessment_id->DataType, $this->Dbid));
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
		$this->loan_section_id->DbValue = $row['loan_section_id'];
		$this->loan_section_name->DbValue = $row['loan_section_name'];
		$this->user_id->DbValue = $row['user_id'];
		$this->_email->DbValue = $row['email'];
		$this->loan_purpose_id->DbValue = $row['loan_purpose_id'];
		$this->loan_purpose_name->DbValue = $row['loan_purpose_name'];
		$this->assessment_id->DbValue = $row['assessment_id'];
		$this->customer_id->DbValue = $row['customer_id'];
		$this->total_score->DbValue = $row['total_score'];
		$this->status->DbValue = $row['status'];
		$this->customer_first_name->DbValue = $row['customer_first_name'];
		$this->customer_last_name->DbValue = $row['customer_last_name'];
		$this->customer_age->DbValue = $row['customer_age'];
		$this->sex->DbValue = $row['sex'];
		$this->address->DbValue = $row['address'];
		$this->lat->DbValue = $row['lat'];
		$this->lon->DbValue = $row['lon'];
		$this->created_at->DbValue = $row['created_at'];
		$this->updated_at->DbValue = $row['updated_at'];
		$this->user_level->DbValue = $row['user_level'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`loan_section_id` = @loan_section_id@ AND `user_id` = @user_id@ AND `loan_purpose_id` = @loan_purpose_id@ AND `assessment_id` = @assessment_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('loan_section_id', $row) ? $row['loan_section_id'] : NULL;
		else
			$val = $this->loan_section_id->OldValue !== NULL ? $this->loan_section_id->OldValue : $this->loan_section_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@loan_section_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('user_id', $row) ? $row['user_id'] : NULL;
		else
			$val = $this->user_id->OldValue !== NULL ? $this->user_id->OldValue : $this->user_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@user_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('loan_purpose_id', $row) ? $row['loan_purpose_id'] : NULL;
		else
			$val = $this->loan_purpose_id->OldValue !== NULL ? $this->loan_purpose_id->OldValue : $this->loan_purpose_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@loan_purpose_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('assessment_id', $row) ? $row['assessment_id'] : NULL;
		else
			$val = $this->assessment_id->OldValue !== NULL ? $this->assessment_id->OldValue : $this->assessment_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@assessment_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "view1list.php";
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
		if ($pageName == "view1view.php")
			return $Language->phrase("View");
		elseif ($pageName == "view1edit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "view1add.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "view1list.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("view1view.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("view1view.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "view1add.php?" . $this->getUrlParm($parm);
		else
			$url = "view1add.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("view1edit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("view1add.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("view1delete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "loan_section_id:" . JsonEncode($this->loan_section_id->CurrentValue, "number");
		$json .= ",user_id:" . JsonEncode($this->user_id->CurrentValue, "number");
		$json .= ",loan_purpose_id:" . JsonEncode($this->loan_purpose_id->CurrentValue, "number");
		$json .= ",assessment_id:" . JsonEncode($this->assessment_id->CurrentValue, "number");
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
		if ($this->loan_section_id->CurrentValue != NULL) {
			$url .= "loan_section_id=" . urlencode($this->loan_section_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->user_id->CurrentValue != NULL) {
			$url .= "&user_id=" . urlencode($this->user_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->loan_purpose_id->CurrentValue != NULL) {
			$url .= "&loan_purpose_id=" . urlencode($this->loan_purpose_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->assessment_id->CurrentValue != NULL) {
			$url .= "&assessment_id=" . urlencode($this->assessment_id->CurrentValue);
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
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
		} else {
			if (Param("loan_section_id") !== NULL)
				$arKey[] = Param("loan_section_id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("user_id") !== NULL)
				$arKey[] = Param("user_id");
			elseif (IsApi() && Key(1) !== NULL)
				$arKey[] = Key(1);
			elseif (IsApi() && Route(3) !== NULL)
				$arKey[] = Route(3);
			else
				$arKeys = NULL; // Do not setup
			if (Param("loan_purpose_id") !== NULL)
				$arKey[] = Param("loan_purpose_id");
			elseif (IsApi() && Key(2) !== NULL)
				$arKey[] = Key(2);
			elseif (IsApi() && Route(4) !== NULL)
				$arKey[] = Route(4);
			else
				$arKeys = NULL; // Do not setup
			if (Param("assessment_id") !== NULL)
				$arKey[] = Param("assessment_id");
			elseif (IsApi() && Key(3) !== NULL)
				$arKey[] = Key(3);
			elseif (IsApi() && Route(5) !== NULL)
				$arKey[] = Route(5);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) != 4)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // loan_section_id
					continue;
				if (!is_numeric($key[1])) // user_id
					continue;
				if (!is_numeric($key[2])) // loan_purpose_id
					continue;
				if (!is_numeric($key[3])) // assessment_id
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
				$this->loan_section_id->CurrentValue = $key[0];
			else
				$this->loan_section_id->OldValue = $key[0];
			if ($setCurrent)
				$this->user_id->CurrentValue = $key[1];
			else
				$this->user_id->OldValue = $key[1];
			if ($setCurrent)
				$this->loan_purpose_id->CurrentValue = $key[2];
			else
				$this->loan_purpose_id->OldValue = $key[2];
			if ($setCurrent)
				$this->assessment_id->CurrentValue = $key[3];
			else
				$this->assessment_id->OldValue = $key[3];
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
		$this->loan_section_id->setDbValue($rs->fields('loan_section_id'));
		$this->loan_section_name->setDbValue($rs->fields('loan_section_name'));
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->loan_purpose_id->setDbValue($rs->fields('loan_purpose_id'));
		$this->loan_purpose_name->setDbValue($rs->fields('loan_purpose_name'));
		$this->assessment_id->setDbValue($rs->fields('assessment_id'));
		$this->customer_id->setDbValue($rs->fields('customer_id'));
		$this->total_score->setDbValue($rs->fields('total_score'));
		$this->status->setDbValue($rs->fields('status'));
		$this->customer_first_name->setDbValue($rs->fields('customer_first_name'));
		$this->customer_last_name->setDbValue($rs->fields('customer_last_name'));
		$this->customer_age->setDbValue($rs->fields('customer_age'));
		$this->sex->setDbValue($rs->fields('sex'));
		$this->address->setDbValue($rs->fields('address'));
		$this->lat->setDbValue($rs->fields('lat'));
		$this->lon->setDbValue($rs->fields('lon'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
		$this->user_level->setDbValue($rs->fields('user_level'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// loan_section_id
		// loan_section_name
		// user_id
		// email
		// loan_purpose_id
		// loan_purpose_name
		// assessment_id
		// customer_id
		// total_score
		// status
		// customer_first_name
		// customer_last_name
		// customer_age
		// sex
		// address
		// lat
		// lon
		// created_at
		// updated_at
		// user_level
		// loan_section_id

		$this->loan_section_id->ViewValue = $this->loan_section_id->CurrentValue;
		$this->loan_section_id->ViewCustomAttributes = "";

		// loan_section_name
		$this->loan_section_name->ViewValue = $this->loan_section_name->CurrentValue;
		$this->loan_section_name->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewValue = FormatNumber($this->user_id->ViewValue, 0, -2, -2, -2);
		$this->user_id->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// loan_purpose_id
		$this->loan_purpose_id->ViewValue = $this->loan_purpose_id->CurrentValue;
		$this->loan_purpose_id->ViewCustomAttributes = "";

		// loan_purpose_name
		$this->loan_purpose_name->ViewValue = $this->loan_purpose_name->CurrentValue;
		$this->loan_purpose_name->ViewCustomAttributes = "";

		// assessment_id
		$this->assessment_id->ViewValue = $this->assessment_id->CurrentValue;
		$this->assessment_id->ViewValue = FormatNumber($this->assessment_id->ViewValue, 0, -2, -2, -2);
		$this->assessment_id->ViewCustomAttributes = "";

		// customer_id
		$this->customer_id->ViewValue = $this->customer_id->CurrentValue;
		$this->customer_id->ViewCustomAttributes = "";

		// total_score
		$this->total_score->ViewValue = $this->total_score->CurrentValue;
		$this->total_score->ViewValue = FormatNumber($this->total_score->ViewValue, 2, -2, -2, -2);
		$this->total_score->ViewCustomAttributes = "";

		// status
		$this->status->ViewValue = $this->status->CurrentValue;
		$this->status->ViewValue = FormatNumber($this->status->ViewValue, 0, -2, -2, -2);
		$this->status->ViewCustomAttributes = "";

		// customer_first_name
		$this->customer_first_name->ViewValue = $this->customer_first_name->CurrentValue;
		$this->customer_first_name->ViewCustomAttributes = "";

		// customer_last_name
		$this->customer_last_name->ViewValue = $this->customer_last_name->CurrentValue;
		$this->customer_last_name->ViewCustomAttributes = "";

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

		// user_level
		if (strval($this->user_level->CurrentValue) != "") {
			$this->user_level->ViewValue = $this->user_level->optionCaption($this->user_level->CurrentValue);
		} else {
			$this->user_level->ViewValue = NULL;
		}
		$this->user_level->ViewCustomAttributes = "";

		// loan_section_id
		$this->loan_section_id->LinkCustomAttributes = "";
		$this->loan_section_id->HrefValue = "";
		$this->loan_section_id->TooltipValue = "";

		// loan_section_name
		$this->loan_section_name->LinkCustomAttributes = "";
		$this->loan_section_name->HrefValue = "";
		$this->loan_section_name->TooltipValue = "";

		// user_id
		$this->user_id->LinkCustomAttributes = "";
		$this->user_id->HrefValue = "";
		$this->user_id->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// loan_purpose_id
		$this->loan_purpose_id->LinkCustomAttributes = "";
		$this->loan_purpose_id->HrefValue = "";
		$this->loan_purpose_id->TooltipValue = "";

		// loan_purpose_name
		$this->loan_purpose_name->LinkCustomAttributes = "";
		$this->loan_purpose_name->HrefValue = "";
		$this->loan_purpose_name->TooltipValue = "";

		// assessment_id
		$this->assessment_id->LinkCustomAttributes = "";
		$this->assessment_id->HrefValue = "";
		$this->assessment_id->TooltipValue = "";

		// customer_id
		$this->customer_id->LinkCustomAttributes = "";
		$this->customer_id->HrefValue = "";
		$this->customer_id->TooltipValue = "";

		// total_score
		$this->total_score->LinkCustomAttributes = "";
		$this->total_score->HrefValue = "";
		$this->total_score->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// customer_first_name
		$this->customer_first_name->LinkCustomAttributes = "";
		$this->customer_first_name->HrefValue = "";
		$this->customer_first_name->TooltipValue = "";

		// customer_last_name
		$this->customer_last_name->LinkCustomAttributes = "";
		$this->customer_last_name->HrefValue = "";
		$this->customer_last_name->TooltipValue = "";

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

		// user_level
		$this->user_level->LinkCustomAttributes = "";
		$this->user_level->HrefValue = "";
		$this->user_level->TooltipValue = "";

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

		// loan_section_id
		$this->loan_section_id->EditAttrs["class"] = "form-control";
		$this->loan_section_id->EditCustomAttributes = "";
		$this->loan_section_id->EditValue = $this->loan_section_id->CurrentValue;
		$this->loan_section_id->ViewCustomAttributes = "";

		// loan_section_name
		$this->loan_section_name->EditAttrs["class"] = "form-control";
		$this->loan_section_name->EditCustomAttributes = "";
		if (!$this->loan_section_name->Raw)
			$this->loan_section_name->CurrentValue = HtmlDecode($this->loan_section_name->CurrentValue);
		$this->loan_section_name->EditValue = $this->loan_section_name->CurrentValue;
		$this->loan_section_name->PlaceHolder = RemoveHtml($this->loan_section_name->caption());

		// user_id
		$this->user_id->EditAttrs["class"] = "form-control";
		$this->user_id->EditCustomAttributes = "";
		$this->user_id->EditValue = $this->user_id->CurrentValue;
		$this->user_id->EditValue = FormatNumber($this->user_id->EditValue, 0, -2, -2, -2);
		$this->user_id->ViewCustomAttributes = "";

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		if (!$this->_email->Raw)
			$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

		// loan_purpose_id
		$this->loan_purpose_id->EditAttrs["class"] = "form-control";
		$this->loan_purpose_id->EditCustomAttributes = "";
		$this->loan_purpose_id->EditValue = $this->loan_purpose_id->CurrentValue;
		$this->loan_purpose_id->ViewCustomAttributes = "";

		// loan_purpose_name
		$this->loan_purpose_name->EditAttrs["class"] = "form-control";
		$this->loan_purpose_name->EditCustomAttributes = "";
		if (!$this->loan_purpose_name->Raw)
			$this->loan_purpose_name->CurrentValue = HtmlDecode($this->loan_purpose_name->CurrentValue);
		$this->loan_purpose_name->EditValue = $this->loan_purpose_name->CurrentValue;
		$this->loan_purpose_name->PlaceHolder = RemoveHtml($this->loan_purpose_name->caption());

		// assessment_id
		$this->assessment_id->EditAttrs["class"] = "form-control";
		$this->assessment_id->EditCustomAttributes = "";
		$this->assessment_id->EditValue = $this->assessment_id->CurrentValue;
		$this->assessment_id->EditValue = FormatNumber($this->assessment_id->EditValue, 0, -2, -2, -2);
		$this->assessment_id->ViewCustomAttributes = "";

		// customer_id
		$this->customer_id->EditAttrs["class"] = "form-control";
		$this->customer_id->EditCustomAttributes = "";
		if (!$this->customer_id->Raw)
			$this->customer_id->CurrentValue = HtmlDecode($this->customer_id->CurrentValue);
		$this->customer_id->EditValue = $this->customer_id->CurrentValue;
		$this->customer_id->PlaceHolder = RemoveHtml($this->customer_id->caption());

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
		$this->status->EditValue = $this->status->CurrentValue;
		$this->status->PlaceHolder = RemoveHtml($this->status->caption());

		// customer_first_name
		$this->customer_first_name->EditAttrs["class"] = "form-control";
		$this->customer_first_name->EditCustomAttributes = "";
		if (!$this->customer_first_name->Raw)
			$this->customer_first_name->CurrentValue = HtmlDecode($this->customer_first_name->CurrentValue);
		$this->customer_first_name->EditValue = $this->customer_first_name->CurrentValue;
		$this->customer_first_name->PlaceHolder = RemoveHtml($this->customer_first_name->caption());

		// customer_last_name
		$this->customer_last_name->EditAttrs["class"] = "form-control";
		$this->customer_last_name->EditCustomAttributes = "";
		if (!$this->customer_last_name->Raw)
			$this->customer_last_name->CurrentValue = HtmlDecode($this->customer_last_name->CurrentValue);
		$this->customer_last_name->EditValue = $this->customer_last_name->CurrentValue;
		$this->customer_last_name->PlaceHolder = RemoveHtml($this->customer_last_name->caption());

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

		// user_level
		$this->user_level->EditAttrs["class"] = "form-control";
		$this->user_level->EditCustomAttributes = "";
		$this->user_level->EditValue = $this->user_level->options(TRUE);

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
					$doc->exportCaption($this->loan_section_id);
					$doc->exportCaption($this->loan_section_name);
					$doc->exportCaption($this->user_id);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->loan_purpose_id);
					$doc->exportCaption($this->loan_purpose_name);
					$doc->exportCaption($this->assessment_id);
					$doc->exportCaption($this->customer_id);
					$doc->exportCaption($this->total_score);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->customer_first_name);
					$doc->exportCaption($this->customer_last_name);
					$doc->exportCaption($this->customer_age);
					$doc->exportCaption($this->sex);
					$doc->exportCaption($this->address);
					$doc->exportCaption($this->lat);
					$doc->exportCaption($this->lon);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->updated_at);
					$doc->exportCaption($this->user_level);
				} else {
					$doc->exportCaption($this->loan_section_id);
					$doc->exportCaption($this->loan_section_name);
					$doc->exportCaption($this->user_id);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->loan_purpose_id);
					$doc->exportCaption($this->loan_purpose_name);
					$doc->exportCaption($this->assessment_id);
					$doc->exportCaption($this->customer_id);
					$doc->exportCaption($this->total_score);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->customer_first_name);
					$doc->exportCaption($this->customer_last_name);
					$doc->exportCaption($this->customer_age);
					$doc->exportCaption($this->sex);
					$doc->exportCaption($this->address);
					$doc->exportCaption($this->lat);
					$doc->exportCaption($this->lon);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->updated_at);
					$doc->exportCaption($this->user_level);
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
						$doc->exportField($this->loan_section_id);
						$doc->exportField($this->loan_section_name);
						$doc->exportField($this->user_id);
						$doc->exportField($this->_email);
						$doc->exportField($this->loan_purpose_id);
						$doc->exportField($this->loan_purpose_name);
						$doc->exportField($this->assessment_id);
						$doc->exportField($this->customer_id);
						$doc->exportField($this->total_score);
						$doc->exportField($this->status);
						$doc->exportField($this->customer_first_name);
						$doc->exportField($this->customer_last_name);
						$doc->exportField($this->customer_age);
						$doc->exportField($this->sex);
						$doc->exportField($this->address);
						$doc->exportField($this->lat);
						$doc->exportField($this->lon);
						$doc->exportField($this->created_at);
						$doc->exportField($this->updated_at);
						$doc->exportField($this->user_level);
					} else {
						$doc->exportField($this->loan_section_id);
						$doc->exportField($this->loan_section_name);
						$doc->exportField($this->user_id);
						$doc->exportField($this->_email);
						$doc->exportField($this->loan_purpose_id);
						$doc->exportField($this->loan_purpose_name);
						$doc->exportField($this->assessment_id);
						$doc->exportField($this->customer_id);
						$doc->exportField($this->total_score);
						$doc->exportField($this->status);
						$doc->exportField($this->customer_first_name);
						$doc->exportField($this->customer_last_name);
						$doc->exportField($this->customer_age);
						$doc->exportField($this->sex);
						$doc->exportField($this->address);
						$doc->exportField($this->lat);
						$doc->exportField($this->lon);
						$doc->exportField($this->created_at);
						$doc->exportField($this->updated_at);
						$doc->exportField($this->user_level);
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
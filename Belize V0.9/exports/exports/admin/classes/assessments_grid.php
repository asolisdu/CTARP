<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

/**
 * Page class
 */
class assessments_grid extends assessments
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{98C27E89-2937-4D47-9B89-35CA334C4E82}";

	// Table name
	public $TableName = 'assessments';

	// Page object name
	public $PageObjName = "assessments_grid";

	// Grid form hidden field names
	public $FormName = "fassessmentsgrid";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$this->FormActionName .= "_" . $this->FormName;
		$this->FormKeyName .= "_" . $this->FormName;
		$this->FormOldKeyName .= "_" . $this->FormName;
		$this->FormBlankRowName .= "_" . $this->FormName;
		$this->FormKeyCountName .= "_" . $this->FormName;
		$GLOBALS["Grid"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (assessments)
		if (!isset($GLOBALS["assessments"]) || get_class($GLOBALS["assessments"]) == PROJECT_NAMESPACE . "assessments") {
			$GLOBALS["assessments"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["assessments"];

		}
		$this->AddUrl = "assessmentsadd.php";

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'assessments');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (users)
		$UserTable = $UserTable ?: new users();

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Export
		global $assessments;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($assessments);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}

//		$GLOBALS["Table"] = &$GLOBALS["MasterTable"];
		unset($GLOBALS["Grid"]);
		if ($url === "")
			return;
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
		$Security->UserID_Loading();
		$Security->loadUserID();
		$Security->UserID_Loaded();
	}

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $ShowOtherOptions = FALSE;
	public $DisplayRecords = 100;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,100,-1"; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $results_Count;
	public $answers_Count;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate(GetUrl("assessmentslist.php"));
					return;
				}
			}
		}

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->id->setVisibility();
		$this->user_id->setVisibility();
		$this->customer_id->setVisibility();
		$this->customer_first_name->setVisibility();
		$this->customer_age->setVisibility();
		$this->sex->setVisibility();
		$this->address->setVisibility();
		$this->total_score->setVisibility();
		$this->status->setVisibility();
		$this->loan_purpose->setVisibility();
		$this->loan_section->setVisibility();
		$this->customer_last_name->Visible = FALSE;
		$this->lat->setVisibility();
		$this->lon->setVisibility();
		$this->created_at->setVisibility();
		$this->updated_at->setVisibility();
		$this->personal_id->Visible = FALSE;
		$this->hideFieldsForAddEdit();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up master detail parameters
		$this->setupMasterParms();

		// Setup other options
		$this->setupOtherOptions();

		// Set up lookup cache
		$this->setupLookupOptions($this->user_id);
		$this->setupLookupOptions($this->loan_purpose);
		$this->setupLookupOptions($this->loan_section);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions["griddelete"];
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->setupSortOrder();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 100; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter

		// Add master User ID filter
		if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
			if ($this->getCurrentMasterTable() == "users")
				$this->DbMasterFilter = $this->addMasterUserIDFilter($this->DbMasterFilter, "users"); // Add master User ID filter
			if ($this->getCurrentMasterTable() == "loan_purposes")
				$this->DbMasterFilter = $this->addMasterUserIDFilter($this->DbMasterFilter, "loan_purposes"); // Add master User ID filter
			if ($this->getCurrentMasterTable() == "loan_section")
				$this->DbMasterFilter = $this->addMasterUserIDFilter($this->DbMasterFilter, "loan_section"); // Add master User ID filter
		}
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "users") {
			global $users;
			$rsmaster = $users->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("userslist.php"); // Return to master page
			} else {
				$users->loadListRowValues($rsmaster);
				$users->RowType = ROWTYPE_MASTER; // Master row
				$users->renderListRow();
				$rsmaster->close();
			}
		}

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "loan_purposes") {
			global $loan_purposes;
			$rsmaster = $loan_purposes->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("loan_purposeslist.php"); // Return to master page
			} else {
				$loan_purposes->loadListRowValues($rsmaster);
				$loan_purposes->RowType = ROWTYPE_MASTER; // Master row
				$loan_purposes->renderListRow();
				$rsmaster->close();
			}
		}

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "loan_section") {
			global $loan_section;
			$rsmaster = $loan_section->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("loan_sectionlist.php"); // Return to master page
			} else {
				$loan_section->loadListRowValues($rsmaster);
				$loan_section->RowType = ROWTYPE_MASTER; // Master row
				$loan_section->renderListRow();
				$rsmaster->close();
			}
		}

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			if ($this->CurrentMode == "copy") {
				$selectLimit = $this->UseSelectLimit;
				if ($selectLimit) {
					$this->TotalRecords = $this->listRecordCount();
					$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
				} else {
					if ($this->Recordset = $this->loadRecordset())
						$this->TotalRecords = $this->Recordset->RecordCount();
				}
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->TotalRecords;
			} else {
				$this->CurrentFilter = "0=1";
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->GridAddRowCount;
			}
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->TotalRecords; // Display all records
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
		}

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 100; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->total_score->FormValue = ""; // Clear form value
		$this->lat->FormValue = ""; // Clear form value
		$this->lon->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}
		if ($this->AuditTrailOnEdit)
			$this->writeAuditTrailDummy($Language->phrase("BatchUpdateBegin")); // Batch update begin
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction != "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey != "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key != "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateSuccess")); // Batch update success
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 1) {
			$this->id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->id->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = $this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		if ($this->AuditTrailOnAdd)
			$this->writeAuditTrailDummy($Language->phrase("BatchInsertBegin")); // Batch insert begin
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "" && $rowaction != "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
				$this->loadOldRecord(); // Load old record
			}
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->id->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter != "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->clearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($gridInsert) {

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertSuccess")); // Batch insert success
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_user_id") && $CurrentForm->hasValue("o_user_id") && $this->user_id->CurrentValue != $this->user_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_customer_id") && $CurrentForm->hasValue("o_customer_id") && $this->customer_id->CurrentValue != $this->customer_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_customer_first_name") && $CurrentForm->hasValue("o_customer_first_name") && $this->customer_first_name->CurrentValue != $this->customer_first_name->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_customer_age") && $CurrentForm->hasValue("o_customer_age") && $this->customer_age->CurrentValue != $this->customer_age->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_sex") && $CurrentForm->hasValue("o_sex") && $this->sex->CurrentValue != $this->sex->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_address") && $CurrentForm->hasValue("o_address") && $this->address->CurrentValue != $this->address->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_total_score") && $CurrentForm->hasValue("o_total_score") && $this->total_score->CurrentValue != $this->total_score->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_status") && $CurrentForm->hasValue("o_status") && $this->status->CurrentValue != $this->status->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_loan_purpose") && $CurrentForm->hasValue("o_loan_purpose") && $this->loan_purpose->CurrentValue != $this->loan_purpose->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_loan_section") && $CurrentForm->hasValue("o_loan_section") && $this->loan_section->CurrentValue != $this->loan_section->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_lat") && $CurrentForm->hasValue("o_lat") && $this->lat->CurrentValue != $this->lat->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_lon") && $CurrentForm->hasValue("o_lon") && $this->lon->CurrentValue != $this->lon->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_created_at") && $CurrentForm->hasValue("o_created_at") && $this->created_at->CurrentValue != $this->created_at->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_updated_at") && $CurrentForm->hasValue("o_updated_at") && $this->updated_at->CurrentValue != $this->updated_at->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = [];

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->user_id->setSessionValue("");
				$this->loan_purpose->setSessionValue("");
				$this->loan_section->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canAdd();
		$item->OnLeft = TRUE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = TRUE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode != "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($CurrentForm->hasValue($this->FormOldKeyName))
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
			if ($this->RowOldKey != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);

				// Reload hidden key for delete
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . HtmlEncode($rowkey) . "\">";
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = $options["griddelete"];
				if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}
		if ($this->CurrentMode == "view") { // View mode

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView() && $this->showOptionLink('view')) {
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"assessments\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->ViewUrl) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit() && $this->showOptionLink('edit')) {
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-table=\"assessments\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SaveBtn',url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = $this->ListOptions["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if ($Security->canAdd() && $this->showOptionLink('add')) {
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-table=\"assessments\" data-caption=\"" . $copycaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->CopyUrl) . "'});\">" . $Language->phrase("CopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = $this->ListOptions["delete"];
		if ($Security->canDelete() && $this->showOptionLink('delete'))
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . " onclick=\"return ew.confirmDelete(this);\"" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->id->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	public function setRecordKey(&$key, $rs)
	{
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('id');
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$option = $this->OtherOptions["addedit"];
		$option->UseDropDownButton = FALSE;
		$option->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$option->UseButtonGroup = TRUE;

		//$option->ButtonClass = ""; // Class for button group
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Add
		if ($this->CurrentMode == "view") { // Check view mode
			$item = &$option->add("add");
			$addcaption = HtmlTitle($Language->phrase("AddLink"));
			$this->AddUrl = $this->getAddUrl();
			if (IsMobile())
				$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
			else
				$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-table=\"assessments\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("AddLink") . "</a>";
			$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		}
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
			if ($this->AllowAddDeleteRow) {
				$option = $options["addedit"];
				$option->UseDropDownButton = FALSE;
				$item = &$option->add("addblankrow");
				$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
				$item->Visible = $Security->canAdd();
				$this->ShowOtherOptions = $item->Visible;
			}
		}
		if ($this->CurrentMode == "view") { // Check view mode
			$option = $options["addedit"];
			$item = $option["add"];
			$this->ShowOtherOptions = $item && $item->Visible;
		}
	}

	// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{
	}

	// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->user_id->CurrentValue = CurrentUserID();
		$this->user_id->OldValue = $this->user_id->CurrentValue;
		$this->customer_id->CurrentValue = NULL;
		$this->customer_id->OldValue = $this->customer_id->CurrentValue;
		$this->customer_first_name->CurrentValue = NULL;
		$this->customer_first_name->OldValue = $this->customer_first_name->CurrentValue;
		$this->customer_age->CurrentValue = NULL;
		$this->customer_age->OldValue = $this->customer_age->CurrentValue;
		$this->sex->CurrentValue = NULL;
		$this->sex->OldValue = $this->sex->CurrentValue;
		$this->address->CurrentValue = NULL;
		$this->address->OldValue = $this->address->CurrentValue;
		$this->total_score->CurrentValue = NULL;
		$this->total_score->OldValue = $this->total_score->CurrentValue;
		$this->status->CurrentValue = 0;
		$this->status->OldValue = $this->status->CurrentValue;
		$this->loan_purpose->CurrentValue = NULL;
		$this->loan_purpose->OldValue = $this->loan_purpose->CurrentValue;
		$this->loan_section->CurrentValue = NULL;
		$this->loan_section->OldValue = $this->loan_section->CurrentValue;
		$this->customer_last_name->CurrentValue = NULL;
		$this->customer_last_name->OldValue = $this->customer_last_name->CurrentValue;
		$this->lat->CurrentValue = NULL;
		$this->lat->OldValue = $this->lat->CurrentValue;
		$this->lon->CurrentValue = NULL;
		$this->lon->OldValue = $this->lon->CurrentValue;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->updated_at->CurrentValue = NULL;
		$this->updated_at->OldValue = $this->updated_at->CurrentValue;
		$this->personal_id->CurrentValue = NULL;
		$this->personal_id->OldValue = $this->personal_id->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->id->setFormValue($val);

		// Check field name 'user_id' first before field var 'x_user_id'
		$val = $CurrentForm->hasValue("user_id") ? $CurrentForm->getValue("user_id") : $CurrentForm->getValue("x_user_id");
		if (!$this->user_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->user_id->Visible = FALSE; // Disable update for API request
			else
				$this->user_id->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_user_id"))
			$this->user_id->setOldValue($CurrentForm->getValue("o_user_id"));

		// Check field name 'customer_id' first before field var 'x_customer_id'
		$val = $CurrentForm->hasValue("customer_id") ? $CurrentForm->getValue("customer_id") : $CurrentForm->getValue("x_customer_id");
		if (!$this->customer_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->customer_id->Visible = FALSE; // Disable update for API request
			else
				$this->customer_id->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_customer_id"))
			$this->customer_id->setOldValue($CurrentForm->getValue("o_customer_id"));

		// Check field name 'customer_first_name' first before field var 'x_customer_first_name'
		$val = $CurrentForm->hasValue("customer_first_name") ? $CurrentForm->getValue("customer_first_name") : $CurrentForm->getValue("x_customer_first_name");
		if (!$this->customer_first_name->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->customer_first_name->Visible = FALSE; // Disable update for API request
			else
				$this->customer_first_name->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_customer_first_name"))
			$this->customer_first_name->setOldValue($CurrentForm->getValue("o_customer_first_name"));

		// Check field name 'customer_age' first before field var 'x_customer_age'
		$val = $CurrentForm->hasValue("customer_age") ? $CurrentForm->getValue("customer_age") : $CurrentForm->getValue("x_customer_age");
		if (!$this->customer_age->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->customer_age->Visible = FALSE; // Disable update for API request
			else
				$this->customer_age->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_customer_age"))
			$this->customer_age->setOldValue($CurrentForm->getValue("o_customer_age"));

		// Check field name 'sex' first before field var 'x_sex'
		$val = $CurrentForm->hasValue("sex") ? $CurrentForm->getValue("sex") : $CurrentForm->getValue("x_sex");
		if (!$this->sex->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->sex->Visible = FALSE; // Disable update for API request
			else
				$this->sex->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_sex"))
			$this->sex->setOldValue($CurrentForm->getValue("o_sex"));

		// Check field name 'address' first before field var 'x_address'
		$val = $CurrentForm->hasValue("address") ? $CurrentForm->getValue("address") : $CurrentForm->getValue("x_address");
		if (!$this->address->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->address->Visible = FALSE; // Disable update for API request
			else
				$this->address->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_address"))
			$this->address->setOldValue($CurrentForm->getValue("o_address"));

		// Check field name 'total_score' first before field var 'x_total_score'
		$val = $CurrentForm->hasValue("total_score") ? $CurrentForm->getValue("total_score") : $CurrentForm->getValue("x_total_score");
		if (!$this->total_score->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->total_score->Visible = FALSE; // Disable update for API request
			else
				$this->total_score->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_total_score"))
			$this->total_score->setOldValue($CurrentForm->getValue("o_total_score"));

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_status"))
			$this->status->setOldValue($CurrentForm->getValue("o_status"));

		// Check field name 'loan_purpose' first before field var 'x_loan_purpose'
		$val = $CurrentForm->hasValue("loan_purpose") ? $CurrentForm->getValue("loan_purpose") : $CurrentForm->getValue("x_loan_purpose");
		if (!$this->loan_purpose->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->loan_purpose->Visible = FALSE; // Disable update for API request
			else
				$this->loan_purpose->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_loan_purpose"))
			$this->loan_purpose->setOldValue($CurrentForm->getValue("o_loan_purpose"));

		// Check field name 'loan_section' first before field var 'x_loan_section'
		$val = $CurrentForm->hasValue("loan_section") ? $CurrentForm->getValue("loan_section") : $CurrentForm->getValue("x_loan_section");
		if (!$this->loan_section->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->loan_section->Visible = FALSE; // Disable update for API request
			else
				$this->loan_section->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_loan_section"))
			$this->loan_section->setOldValue($CurrentForm->getValue("o_loan_section"));

		// Check field name 'lat' first before field var 'x_lat'
		$val = $CurrentForm->hasValue("lat") ? $CurrentForm->getValue("lat") : $CurrentForm->getValue("x_lat");
		if (!$this->lat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->lat->Visible = FALSE; // Disable update for API request
			else
				$this->lat->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_lat"))
			$this->lat->setOldValue($CurrentForm->getValue("o_lat"));

		// Check field name 'lon' first before field var 'x_lon'
		$val = $CurrentForm->hasValue("lon") ? $CurrentForm->getValue("lon") : $CurrentForm->getValue("x_lon");
		if (!$this->lon->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->lon->Visible = FALSE; // Disable update for API request
			else
				$this->lon->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_lon"))
			$this->lon->setOldValue($CurrentForm->getValue("o_lon"));

		// Check field name 'created_at' first before field var 'x_created_at'
		$val = $CurrentForm->hasValue("created_at") ? $CurrentForm->getValue("created_at") : $CurrentForm->getValue("x_created_at");
		if (!$this->created_at->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->created_at->Visible = FALSE; // Disable update for API request
			else
				$this->created_at->setFormValue($val);
			$this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_created_at"))
			$this->created_at->setOldValue($CurrentForm->getValue("o_created_at"));

		// Check field name 'updated_at' first before field var 'x_updated_at'
		$val = $CurrentForm->hasValue("updated_at") ? $CurrentForm->getValue("updated_at") : $CurrentForm->getValue("x_updated_at");
		if (!$this->updated_at->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->updated_at->Visible = FALSE; // Disable update for API request
			else
				$this->updated_at->setFormValue($val);
			$this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_updated_at"))
			$this->updated_at->setOldValue($CurrentForm->getValue("o_updated_at"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->id->CurrentValue = $this->id->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->customer_id->CurrentValue = $this->customer_id->FormValue;
		$this->customer_first_name->CurrentValue = $this->customer_first_name->FormValue;
		$this->customer_age->CurrentValue = $this->customer_age->FormValue;
		$this->sex->CurrentValue = $this->sex->FormValue;
		$this->address->CurrentValue = $this->address->FormValue;
		$this->total_score->CurrentValue = $this->total_score->FormValue;
		$this->status->CurrentValue = $this->status->FormValue;
		$this->loan_purpose->CurrentValue = $this->loan_purpose->FormValue;
		$this->loan_section->CurrentValue = $this->loan_section->FormValue;
		$this->lat->CurrentValue = $this->lat->FormValue;
		$this->lon->CurrentValue = $this->lon->FormValue;
		$this->created_at->CurrentValue = $this->created_at->FormValue;
		$this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, 0);
		$this->updated_at->CurrentValue = $this->updated_at->FormValue;
		$this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, 0);
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->user_id->setDbValue($row['user_id']);
		$this->customer_id->setDbValue($row['customer_id']);
		$this->customer_first_name->setDbValue($row['customer_first_name']);
		$this->customer_age->setDbValue($row['customer_age']);
		$this->sex->setDbValue($row['sex']);
		$this->address->setDbValue($row['address']);
		$this->total_score->setDbValue($row['total_score']);
		$this->status->setDbValue($row['status']);
		$this->loan_purpose->setDbValue($row['loan_purpose']);
		$this->loan_section->setDbValue($row['loan_section']);
		$this->customer_last_name->setDbValue($row['customer_last_name']);
		$this->lat->setDbValue($row['lat']);
		$this->lon->setDbValue($row['lon']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->personal_id->setDbValue($row['personal_id']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['user_id'] = $this->user_id->CurrentValue;
		$row['customer_id'] = $this->customer_id->CurrentValue;
		$row['customer_first_name'] = $this->customer_first_name->CurrentValue;
		$row['customer_age'] = $this->customer_age->CurrentValue;
		$row['sex'] = $this->sex->CurrentValue;
		$row['address'] = $this->address->CurrentValue;
		$row['total_score'] = $this->total_score->CurrentValue;
		$row['status'] = $this->status->CurrentValue;
		$row['loan_purpose'] = $this->loan_purpose->CurrentValue;
		$row['loan_section'] = $this->loan_section->CurrentValue;
		$row['customer_last_name'] = $this->customer_last_name->CurrentValue;
		$row['lat'] = $this->lat->CurrentValue;
		$row['lon'] = $this->lon->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		$row['updated_at'] = $this->updated_at->CurrentValue;
		$row['personal_id'] = $this->personal_id->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$keys = [$this->RowOldKey];
		$cnt = count($keys);
		if ($cnt >= 1) {
			if (strval($keys[0]) != "")
				$this->id->OldValue = strval($keys[0]); // id
			else
				$validKey = FALSE;
		} else {
			$validKey = FALSE;
		}

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Convert decimal values if posted back
		if ($this->total_score->FormValue == $this->total_score->CurrentValue && is_numeric(ConvertToFloatString($this->total_score->CurrentValue)))
			$this->total_score->CurrentValue = ConvertToFloatString($this->total_score->CurrentValue);

		// Convert decimal values if posted back
		if ($this->lat->FormValue == $this->lat->CurrentValue && is_numeric(ConvertToFloatString($this->lat->CurrentValue)))
			$this->lat->CurrentValue = ConvertToFloatString($this->lat->CurrentValue);

		// Convert decimal values if posted back
		if ($this->lon->FormValue == $this->lon->CurrentValue && is_numeric(ConvertToFloatString($this->lon->CurrentValue)))
			$this->lon->CurrentValue = ConvertToFloatString($this->lon->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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
		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id
			// user_id

			$this->user_id->EditAttrs["class"] = "form-control";
			$this->user_id->EditCustomAttributes = "";
			if ($this->user_id->getSessionValue() != "") {
				$this->user_id->CurrentValue = $this->user_id->getSessionValue();
				$this->user_id->OldValue = $this->user_id->CurrentValue;
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
			} elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("grid")) { // Non system admin
				$this->user_id->CurrentValue = CurrentUserID();
				$this->user_id->EditValue = $this->user_id->CurrentValue;
				$curVal = strval($this->user_id->CurrentValue);
				if ($curVal != "") {
					$this->user_id->EditValue = $this->user_id->lookupCacheOption($curVal);
					if ($this->user_id->EditValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->user_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
							$arwrk[2] = $rswrk->fields('df2');
							$arwrk[3] = $rswrk->fields('df3');
							$this->user_id->EditValue = $this->user_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->user_id->EditValue = $this->user_id->CurrentValue;
						}
					}
				} else {
					$this->user_id->EditValue = NULL;
				}
				$this->user_id->ViewCustomAttributes = "";
			} else {
				$this->user_id->EditValue = HtmlEncode($this->user_id->CurrentValue);
				$curVal = strval($this->user_id->CurrentValue);
				if ($curVal != "") {
					$this->user_id->EditValue = $this->user_id->lookupCacheOption($curVal);
					if ($this->user_id->EditValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->user_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode(FormatNumber($rswrk->fields('df'), 0, -2, -2, -2));
							$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
							$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
							$this->user_id->EditValue = $this->user_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->user_id->EditValue = HtmlEncode($this->user_id->CurrentValue);
						}
					}
				} else {
					$this->user_id->EditValue = NULL;
				}
				$this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());
			}

			// customer_id
			$this->customer_id->EditAttrs["class"] = "form-control";
			$this->customer_id->EditCustomAttributes = "";
			if (!$this->customer_id->Raw)
				$this->customer_id->CurrentValue = HtmlDecode($this->customer_id->CurrentValue);
			$this->customer_id->EditValue = HtmlEncode($this->customer_id->CurrentValue);
			$this->customer_id->PlaceHolder = RemoveHtml($this->customer_id->caption());

			// customer_first_name
			$this->customer_first_name->EditAttrs["class"] = "form-control";
			$this->customer_first_name->EditCustomAttributes = "";
			if (!$this->customer_first_name->Raw)
				$this->customer_first_name->CurrentValue = HtmlDecode($this->customer_first_name->CurrentValue);
			$this->customer_first_name->EditValue = HtmlEncode($this->customer_first_name->CurrentValue);
			$this->customer_first_name->PlaceHolder = RemoveHtml($this->customer_first_name->caption());

			// customer_age
			$this->customer_age->EditAttrs["class"] = "form-control";
			$this->customer_age->EditCustomAttributes = "";
			$this->customer_age->EditValue = HtmlEncode($this->customer_age->CurrentValue);
			$this->customer_age->PlaceHolder = RemoveHtml($this->customer_age->caption());

			// sex
			$this->sex->EditAttrs["class"] = "form-control";
			$this->sex->EditCustomAttributes = "";
			if (!$this->sex->Raw)
				$this->sex->CurrentValue = HtmlDecode($this->sex->CurrentValue);
			$this->sex->EditValue = HtmlEncode($this->sex->CurrentValue);
			$this->sex->PlaceHolder = RemoveHtml($this->sex->caption());

			// address
			$this->address->EditAttrs["class"] = "form-control";
			$this->address->EditCustomAttributes = "";
			if (!$this->address->Raw)
				$this->address->CurrentValue = HtmlDecode($this->address->CurrentValue);
			$this->address->EditValue = HtmlEncode($this->address->CurrentValue);
			$this->address->PlaceHolder = RemoveHtml($this->address->caption());

			// total_score
			$this->total_score->EditAttrs["class"] = "form-control";
			$this->total_score->EditCustomAttributes = "";
			$this->total_score->EditValue = HtmlEncode($this->total_score->CurrentValue);
			$this->total_score->PlaceHolder = RemoveHtml($this->total_score->caption());
			if (strval($this->total_score->EditValue) != "" && is_numeric($this->total_score->EditValue)) {
				$this->total_score->EditValue = FormatNumber($this->total_score->EditValue, -2, -2, -2, -2);
				$this->total_score->OldValue = $this->total_score->EditValue;
			}
			

			// status
			$this->status->EditAttrs["class"] = "form-control";
			$this->status->EditCustomAttributes = "";
			$this->status->EditValue = $this->status->options(TRUE);

			// loan_purpose
			$this->loan_purpose->EditAttrs["class"] = "form-control";
			$this->loan_purpose->EditCustomAttributes = "";
			if ($this->loan_purpose->getSessionValue() != "") {
				$this->loan_purpose->CurrentValue = $this->loan_purpose->getSessionValue();
				$this->loan_purpose->OldValue = $this->loan_purpose->CurrentValue;
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
				$this->loan_purpose->EditValue = HtmlEncode($this->loan_purpose->CurrentValue);
				$curVal = strval($this->loan_purpose->CurrentValue);
				if ($curVal != "") {
					$this->loan_purpose->EditValue = $this->loan_purpose->lookupCacheOption($curVal);
					if ($this->loan_purpose->EditValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->loan_purpose->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->loan_purpose->EditValue = $this->loan_purpose->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->loan_purpose->EditValue = HtmlEncode($this->loan_purpose->CurrentValue);
						}
					}
				} else {
					$this->loan_purpose->EditValue = NULL;
				}
				$this->loan_purpose->PlaceHolder = RemoveHtml($this->loan_purpose->caption());
			}

			// loan_section
			$this->loan_section->EditAttrs["class"] = "form-control";
			$this->loan_section->EditCustomAttributes = "";
			if ($this->loan_section->getSessionValue() != "") {
				$this->loan_section->CurrentValue = $this->loan_section->getSessionValue();
				$this->loan_section->OldValue = $this->loan_section->CurrentValue;
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
				$this->loan_section->EditValue = HtmlEncode($this->loan_section->CurrentValue);
				$curVal = strval($this->loan_section->CurrentValue);
				if ($curVal != "") {
					$this->loan_section->EditValue = $this->loan_section->lookupCacheOption($curVal);
					if ($this->loan_section->EditValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->loan_section->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->loan_section->EditValue = $this->loan_section->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->loan_section->EditValue = HtmlEncode($this->loan_section->CurrentValue);
						}
					}
				} else {
					$this->loan_section->EditValue = NULL;
				}
				$this->loan_section->PlaceHolder = RemoveHtml($this->loan_section->caption());
			}

			// lat
			$this->lat->EditAttrs["class"] = "form-control";
			$this->lat->EditCustomAttributes = "";
			$this->lat->EditValue = HtmlEncode($this->lat->CurrentValue);
			$this->lat->PlaceHolder = RemoveHtml($this->lat->caption());
			if (strval($this->lat->EditValue) != "" && is_numeric($this->lat->EditValue)) {
				$this->lat->EditValue = FormatNumber($this->lat->EditValue, -2, -2, -2, -2);
				$this->lat->OldValue = $this->lat->EditValue;
			}
			

			// lon
			$this->lon->EditAttrs["class"] = "form-control";
			$this->lon->EditCustomAttributes = "";
			$this->lon->EditValue = HtmlEncode($this->lon->CurrentValue);
			$this->lon->PlaceHolder = RemoveHtml($this->lon->caption());
			if (strval($this->lon->EditValue) != "" && is_numeric($this->lon->EditValue)) {
				$this->lon->EditValue = FormatNumber($this->lon->EditValue, -2, -2, -2, -2);
				$this->lon->OldValue = $this->lon->EditValue;
			}
			

			// created_at
			$this->created_at->EditAttrs["class"] = "form-control";
			$this->created_at->EditCustomAttributes = "";
			$this->created_at->EditValue = HtmlEncode(FormatDateTime($this->created_at->CurrentValue, 8));
			$this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

			// updated_at
			$this->updated_at->EditAttrs["class"] = "form-control";
			$this->updated_at->EditCustomAttributes = "";
			$this->updated_at->EditValue = HtmlEncode(FormatDateTime($this->updated_at->CurrentValue, 8));
			$this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

			// Add refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// customer_id
			$this->customer_id->LinkCustomAttributes = "";
			$this->customer_id->HrefValue = "";

			// customer_first_name
			$this->customer_first_name->LinkCustomAttributes = "";
			$this->customer_first_name->HrefValue = "";

			// customer_age
			$this->customer_age->LinkCustomAttributes = "";
			$this->customer_age->HrefValue = "";

			// sex
			$this->sex->LinkCustomAttributes = "";
			$this->sex->HrefValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";

			// total_score
			$this->total_score->LinkCustomAttributes = "";
			$this->total_score->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

			// loan_purpose
			$this->loan_purpose->LinkCustomAttributes = "";
			$this->loan_purpose->HrefValue = "";

			// loan_section
			$this->loan_section->LinkCustomAttributes = "";
			$this->loan_section->HrefValue = "";

			// lat
			$this->lat->LinkCustomAttributes = "";
			$this->lat->HrefValue = "";

			// lon
			$this->lon->LinkCustomAttributes = "";
			$this->lon->HrefValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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
				$this->user_id->OldValue = $this->user_id->CurrentValue;
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
			} elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("grid")) { // Non system admin
				$this->user_id->CurrentValue = CurrentUserID();
				$this->user_id->EditValue = $this->user_id->CurrentValue;
				$curVal = strval($this->user_id->CurrentValue);
				if ($curVal != "") {
					$this->user_id->EditValue = $this->user_id->lookupCacheOption($curVal);
					if ($this->user_id->EditValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->user_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
							$arwrk[2] = $rswrk->fields('df2');
							$arwrk[3] = $rswrk->fields('df3');
							$this->user_id->EditValue = $this->user_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->user_id->EditValue = $this->user_id->CurrentValue;
						}
					}
				} else {
					$this->user_id->EditValue = NULL;
				}
				$this->user_id->ViewCustomAttributes = "";
			} else {
				$this->user_id->EditValue = HtmlEncode($this->user_id->CurrentValue);
				$curVal = strval($this->user_id->CurrentValue);
				if ($curVal != "") {
					$this->user_id->EditValue = $this->user_id->lookupCacheOption($curVal);
					if ($this->user_id->EditValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->user_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode(FormatNumber($rswrk->fields('df'), 0, -2, -2, -2));
							$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
							$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
							$this->user_id->EditValue = $this->user_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->user_id->EditValue = HtmlEncode($this->user_id->CurrentValue);
						}
					}
				} else {
					$this->user_id->EditValue = NULL;
				}
				$this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());
			}

			// customer_id
			$this->customer_id->EditAttrs["class"] = "form-control";
			$this->customer_id->EditCustomAttributes = "";
			if (!$this->customer_id->Raw)
				$this->customer_id->CurrentValue = HtmlDecode($this->customer_id->CurrentValue);
			$this->customer_id->EditValue = HtmlEncode($this->customer_id->CurrentValue);
			$this->customer_id->PlaceHolder = RemoveHtml($this->customer_id->caption());

			// customer_first_name
			$this->customer_first_name->EditAttrs["class"] = "form-control";
			$this->customer_first_name->EditCustomAttributes = "";
			if (!$this->customer_first_name->Raw)
				$this->customer_first_name->CurrentValue = HtmlDecode($this->customer_first_name->CurrentValue);
			$this->customer_first_name->EditValue = HtmlEncode($this->customer_first_name->CurrentValue);
			$this->customer_first_name->PlaceHolder = RemoveHtml($this->customer_first_name->caption());

			// customer_age
			$this->customer_age->EditAttrs["class"] = "form-control";
			$this->customer_age->EditCustomAttributes = "";
			$this->customer_age->EditValue = HtmlEncode($this->customer_age->CurrentValue);
			$this->customer_age->PlaceHolder = RemoveHtml($this->customer_age->caption());

			// sex
			$this->sex->EditAttrs["class"] = "form-control";
			$this->sex->EditCustomAttributes = "";
			if (!$this->sex->Raw)
				$this->sex->CurrentValue = HtmlDecode($this->sex->CurrentValue);
			$this->sex->EditValue = HtmlEncode($this->sex->CurrentValue);
			$this->sex->PlaceHolder = RemoveHtml($this->sex->caption());

			// address
			$this->address->EditAttrs["class"] = "form-control";
			$this->address->EditCustomAttributes = "";
			if (!$this->address->Raw)
				$this->address->CurrentValue = HtmlDecode($this->address->CurrentValue);
			$this->address->EditValue = HtmlEncode($this->address->CurrentValue);
			$this->address->PlaceHolder = RemoveHtml($this->address->caption());

			// total_score
			$this->total_score->EditAttrs["class"] = "form-control";
			$this->total_score->EditCustomAttributes = "";
			$this->total_score->EditValue = HtmlEncode($this->total_score->CurrentValue);
			$this->total_score->PlaceHolder = RemoveHtml($this->total_score->caption());
			if (strval($this->total_score->EditValue) != "" && is_numeric($this->total_score->EditValue)) {
				$this->total_score->EditValue = FormatNumber($this->total_score->EditValue, -2, -2, -2, -2);
				$this->total_score->OldValue = $this->total_score->EditValue;
			}
			

			// status
			$this->status->EditAttrs["class"] = "form-control";
			$this->status->EditCustomAttributes = "";
			$this->status->EditValue = $this->status->options(TRUE);

			// loan_purpose
			$this->loan_purpose->EditAttrs["class"] = "form-control";
			$this->loan_purpose->EditCustomAttributes = "";
			if ($this->loan_purpose->getSessionValue() != "") {
				$this->loan_purpose->CurrentValue = $this->loan_purpose->getSessionValue();
				$this->loan_purpose->OldValue = $this->loan_purpose->CurrentValue;
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
				$this->loan_purpose->EditValue = HtmlEncode($this->loan_purpose->CurrentValue);
				$curVal = strval($this->loan_purpose->CurrentValue);
				if ($curVal != "") {
					$this->loan_purpose->EditValue = $this->loan_purpose->lookupCacheOption($curVal);
					if ($this->loan_purpose->EditValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->loan_purpose->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->loan_purpose->EditValue = $this->loan_purpose->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->loan_purpose->EditValue = HtmlEncode($this->loan_purpose->CurrentValue);
						}
					}
				} else {
					$this->loan_purpose->EditValue = NULL;
				}
				$this->loan_purpose->PlaceHolder = RemoveHtml($this->loan_purpose->caption());
			}

			// loan_section
			$this->loan_section->EditAttrs["class"] = "form-control";
			$this->loan_section->EditCustomAttributes = "";
			if ($this->loan_section->getSessionValue() != "") {
				$this->loan_section->CurrentValue = $this->loan_section->getSessionValue();
				$this->loan_section->OldValue = $this->loan_section->CurrentValue;
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
				$this->loan_section->EditValue = HtmlEncode($this->loan_section->CurrentValue);
				$curVal = strval($this->loan_section->CurrentValue);
				if ($curVal != "") {
					$this->loan_section->EditValue = $this->loan_section->lookupCacheOption($curVal);
					if ($this->loan_section->EditValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->loan_section->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->loan_section->EditValue = $this->loan_section->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->loan_section->EditValue = HtmlEncode($this->loan_section->CurrentValue);
						}
					}
				} else {
					$this->loan_section->EditValue = NULL;
				}
				$this->loan_section->PlaceHolder = RemoveHtml($this->loan_section->caption());
			}

			// lat
			$this->lat->EditAttrs["class"] = "form-control";
			$this->lat->EditCustomAttributes = "";
			$this->lat->EditValue = HtmlEncode($this->lat->CurrentValue);
			$this->lat->PlaceHolder = RemoveHtml($this->lat->caption());
			if (strval($this->lat->EditValue) != "" && is_numeric($this->lat->EditValue)) {
				$this->lat->EditValue = FormatNumber($this->lat->EditValue, -2, -2, -2, -2);
				$this->lat->OldValue = $this->lat->EditValue;
			}
			

			// lon
			$this->lon->EditAttrs["class"] = "form-control";
			$this->lon->EditCustomAttributes = "";
			$this->lon->EditValue = HtmlEncode($this->lon->CurrentValue);
			$this->lon->PlaceHolder = RemoveHtml($this->lon->caption());
			if (strval($this->lon->EditValue) != "" && is_numeric($this->lon->EditValue)) {
				$this->lon->EditValue = FormatNumber($this->lon->EditValue, -2, -2, -2, -2);
				$this->lon->OldValue = $this->lon->EditValue;
			}
			

			// created_at
			$this->created_at->EditAttrs["class"] = "form-control";
			$this->created_at->EditCustomAttributes = "";
			$this->created_at->EditValue = HtmlEncode(FormatDateTime($this->created_at->CurrentValue, 8));
			$this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

			// updated_at
			$this->updated_at->EditAttrs["class"] = "form-control";
			$this->updated_at->EditCustomAttributes = "";
			$this->updated_at->EditValue = HtmlEncode(FormatDateTime($this->updated_at->CurrentValue, 8));
			$this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// customer_id
			$this->customer_id->LinkCustomAttributes = "";
			$this->customer_id->HrefValue = "";

			// customer_first_name
			$this->customer_first_name->LinkCustomAttributes = "";
			$this->customer_first_name->HrefValue = "";

			// customer_age
			$this->customer_age->LinkCustomAttributes = "";
			$this->customer_age->HrefValue = "";

			// sex
			$this->sex->LinkCustomAttributes = "";
			$this->sex->HrefValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";

			// total_score
			$this->total_score->LinkCustomAttributes = "";
			$this->total_score->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

			// loan_purpose
			$this->loan_purpose->LinkCustomAttributes = "";
			$this->loan_purpose->HrefValue = "";

			// loan_section
			$this->loan_section->LinkCustomAttributes = "";
			$this->loan_section->HrefValue = "";

			// lat
			$this->lat->LinkCustomAttributes = "";
			$this->lat->HrefValue = "";

			// lon
			$this->lon->LinkCustomAttributes = "";
			$this->lon->HrefValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->id->Required) {
			if (!$this->id->IsDetailKey && $this->id->FormValue != NULL && $this->id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
			}
		}
		if ($this->user_id->Required) {
			if (!$this->user_id->IsDetailKey && $this->user_id->FormValue != NULL && $this->user_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_id->caption(), $this->user_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->user_id->FormValue)) {
			AddMessage($FormError, $this->user_id->errorMessage());
		}
		if ($this->customer_id->Required) {
			if (!$this->customer_id->IsDetailKey && $this->customer_id->FormValue != NULL && $this->customer_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_id->caption(), $this->customer_id->RequiredErrorMessage));
			}
		}
		if ($this->customer_first_name->Required) {
			if (!$this->customer_first_name->IsDetailKey && $this->customer_first_name->FormValue != NULL && $this->customer_first_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_first_name->caption(), $this->customer_first_name->RequiredErrorMessage));
			}
		}
		if ($this->customer_age->Required) {
			if (!$this->customer_age->IsDetailKey && $this->customer_age->FormValue != NULL && $this->customer_age->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_age->caption(), $this->customer_age->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->customer_age->FormValue)) {
			AddMessage($FormError, $this->customer_age->errorMessage());
		}
		if ($this->sex->Required) {
			if (!$this->sex->IsDetailKey && $this->sex->FormValue != NULL && $this->sex->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sex->caption(), $this->sex->RequiredErrorMessage));
			}
		}
		if ($this->address->Required) {
			if (!$this->address->IsDetailKey && $this->address->FormValue != NULL && $this->address->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->address->caption(), $this->address->RequiredErrorMessage));
			}
		}
		if ($this->total_score->Required) {
			if (!$this->total_score->IsDetailKey && $this->total_score->FormValue != NULL && $this->total_score->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total_score->caption(), $this->total_score->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->total_score->FormValue)) {
			AddMessage($FormError, $this->total_score->errorMessage());
		}
		if ($this->status->Required) {
			if (!$this->status->IsDetailKey && $this->status->FormValue != NULL && $this->status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
			}
		}
		if ($this->loan_purpose->Required) {
			if (!$this->loan_purpose->IsDetailKey && $this->loan_purpose->FormValue != NULL && $this->loan_purpose->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->loan_purpose->caption(), $this->loan_purpose->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->loan_purpose->FormValue)) {
			AddMessage($FormError, $this->loan_purpose->errorMessage());
		}
		if ($this->loan_section->Required) {
			if (!$this->loan_section->IsDetailKey && $this->loan_section->FormValue != NULL && $this->loan_section->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->loan_section->caption(), $this->loan_section->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->loan_section->FormValue)) {
			AddMessage($FormError, $this->loan_section->errorMessage());
		}
		if ($this->lat->Required) {
			if (!$this->lat->IsDetailKey && $this->lat->FormValue != NULL && $this->lat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->lat->caption(), $this->lat->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->lat->FormValue)) {
			AddMessage($FormError, $this->lat->errorMessage());
		}
		if ($this->lon->Required) {
			if (!$this->lon->IsDetailKey && $this->lon->FormValue != NULL && $this->lon->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->lon->caption(), $this->lon->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->lon->FormValue)) {
			AddMessage($FormError, $this->lon->errorMessage());
		}
		if ($this->created_at->Required) {
			if (!$this->created_at->IsDetailKey && $this->created_at->FormValue != NULL && $this->created_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->created_at->FormValue)) {
			AddMessage($FormError, $this->created_at->errorMessage());
		}
		if ($this->updated_at->Required) {
			if (!$this->updated_at->IsDetailKey && $this->updated_at->FormValue != NULL && $this->updated_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->updated_at->FormValue)) {
			AddMessage($FormError, $this->updated_at->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		if ($this->AuditTrailOnDelete)
			$this->writeAuditTrailDummy($Language->phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['id'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// user_id
			$this->user_id->setDbValueDef($rsnew, $this->user_id->CurrentValue, 0, $this->user_id->ReadOnly);

			// customer_id
			$this->customer_id->setDbValueDef($rsnew, $this->customer_id->CurrentValue, NULL, $this->customer_id->ReadOnly);

			// customer_first_name
			$this->customer_first_name->setDbValueDef($rsnew, $this->customer_first_name->CurrentValue, NULL, $this->customer_first_name->ReadOnly);

			// customer_age
			$this->customer_age->setDbValueDef($rsnew, $this->customer_age->CurrentValue, NULL, $this->customer_age->ReadOnly);

			// sex
			$this->sex->setDbValueDef($rsnew, $this->sex->CurrentValue, NULL, $this->sex->ReadOnly);

			// address
			$this->address->setDbValueDef($rsnew, $this->address->CurrentValue, NULL, $this->address->ReadOnly);

			// total_score
			$this->total_score->setDbValueDef($rsnew, $this->total_score->CurrentValue, NULL, $this->total_score->ReadOnly);

			// status
			$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, NULL, $this->status->ReadOnly);

			// loan_purpose
			$this->loan_purpose->setDbValueDef($rsnew, $this->loan_purpose->CurrentValue, NULL, $this->loan_purpose->ReadOnly);

			// loan_section
			$this->loan_section->setDbValueDef($rsnew, $this->loan_section->CurrentValue, NULL, $this->loan_section->ReadOnly);

			// lat
			$this->lat->setDbValueDef($rsnew, $this->lat->CurrentValue, NULL, $this->lat->ReadOnly);

			// lon
			$this->lon->setDbValueDef($rsnew, $this->lon->CurrentValue, NULL, $this->lon->ReadOnly);

			// created_at
			$this->created_at->setDbValueDef($rsnew, UnFormatDateTime($this->created_at->CurrentValue, 0), NULL, $this->created_at->ReadOnly);

			// updated_at
			$this->updated_at->setDbValueDef($rsnew, UnFormatDateTime($this->updated_at->CurrentValue, 0), NULL, $this->updated_at->ReadOnly);

			// Check referential integrity for master table 'users'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_users();
			$keyValue = isset($rsnew['user_id']) ? $rsnew['user_id'] : $rsold['user_id'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["users"]))
					$GLOBALS["users"] = new users();
				$rsmaster = $GLOBALS["users"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "users", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Check referential integrity for master table 'loan_purposes'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_loan_purposes();
			$keyValue = isset($rsnew['loan_purpose']) ? $rsnew['loan_purpose'] : $rsold['loan_purpose'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["loan_purposes"]))
					$GLOBALS["loan_purposes"] = new loan_purposes();
				$rsmaster = $GLOBALS["loan_purposes"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "loan_purposes", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Check referential integrity for master table 'loan_section'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_loan_section();
			$keyValue = isset($rsnew['loan_section']) ? $rsnew['loan_section'] : $rsold['loan_section'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["loan_section"]))
					$GLOBALS["loan_section"] = new loan_section();
				$rsmaster = $GLOBALS["loan_section"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "loan_section", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Check if valid User ID
		$validUser = FALSE;
		if ($Security->currentUserID() != "" && !EmptyValue($this->user_id->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validUser = $Security->isValidUserID($this->user_id->CurrentValue);
			if (!$validUser) {
				$userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
				$userIdMsg = str_replace("%u", $this->user_id->CurrentValue, $userIdMsg);
				$this->setFailureMessage($userIdMsg);
				return FALSE;
			}
		}

		// Check if valid key values for master user
		if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
			$masterFilter = $this->sqlMasterFilter_users();
			if (strval($this->user_id->CurrentValue) != "") {
				$masterFilter = str_replace("@id@", AdjustSql($this->user_id->CurrentValue, "DB"), $masterFilter);
			} else {
				$masterFilter = "";
			}
			if ($masterFilter != "") {
				$rsmaster = $GLOBALS["users"]->loadRs($masterFilter);
				$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
				$validMasterKey = TRUE;
				if ($this->MasterRecordExists) {
					$validMasterKey = $Security->isValidUserID($rsmaster->fields['id']);
				} elseif ($this->getCurrentMasterTable() == "users") {
					$validMasterKey = FALSE;
				}
				if (!$validMasterKey) {
					$masterUserIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedMasterUserID"));
					$masterUserIdMsg = str_replace("%f", $sMasterFilter, $masterUserIdMsg);
					$this->setFailureMessage($masterUserIdMsg);
					return FALSE;
				}
				if ($rsmaster)
					$rsmaster->close();
			}
		}

		// Set up foreign key field value from Session
			if ($this->getCurrentMasterTable() == "users") {
				$this->user_id->CurrentValue = $this->user_id->getSessionValue();
			}
			if ($this->getCurrentMasterTable() == "loan_purposes") {
				$this->loan_purpose->CurrentValue = $this->loan_purpose->getSessionValue();
			}
			if ($this->getCurrentMasterTable() == "loan_section") {
				$this->loan_section->CurrentValue = $this->loan_section->getSessionValue();
			}

		// Check referential integrity for master table 'assessments'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_users();
		if (strval($this->user_id->CurrentValue) != "") {
			$masterFilter = str_replace("@id@", AdjustSql($this->user_id->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["users"]))
				$GLOBALS["users"] = new users();
			$rsmaster = $GLOBALS["users"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "users", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}

		// Check referential integrity for master table 'assessments'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_loan_purposes();
		if (strval($this->loan_purpose->CurrentValue) != "") {
			$masterFilter = str_replace("@id@", AdjustSql($this->loan_purpose->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["loan_purposes"]))
				$GLOBALS["loan_purposes"] = new loan_purposes();
			$rsmaster = $GLOBALS["loan_purposes"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "loan_purposes", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}

		// Check referential integrity for master table 'assessments'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_loan_section();
		if (strval($this->loan_section->CurrentValue) != "") {
			$masterFilter = str_replace("@id@", AdjustSql($this->loan_section->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["loan_section"]))
				$GLOBALS["loan_section"] = new loan_section();
			$rsmaster = $GLOBALS["loan_section"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "loan_section", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// user_id
		$this->user_id->setDbValueDef($rsnew, $this->user_id->CurrentValue, 0, FALSE);

		// customer_id
		$this->customer_id->setDbValueDef($rsnew, $this->customer_id->CurrentValue, NULL, FALSE);

		// customer_first_name
		$this->customer_first_name->setDbValueDef($rsnew, $this->customer_first_name->CurrentValue, NULL, FALSE);

		// customer_age
		$this->customer_age->setDbValueDef($rsnew, $this->customer_age->CurrentValue, NULL, FALSE);

		// sex
		$this->sex->setDbValueDef($rsnew, $this->sex->CurrentValue, NULL, FALSE);

		// address
		$this->address->setDbValueDef($rsnew, $this->address->CurrentValue, NULL, FALSE);

		// total_score
		$this->total_score->setDbValueDef($rsnew, $this->total_score->CurrentValue, NULL, FALSE);

		// status
		$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, NULL, strval($this->status->CurrentValue) == "");

		// loan_purpose
		$this->loan_purpose->setDbValueDef($rsnew, $this->loan_purpose->CurrentValue, NULL, FALSE);

		// loan_section
		$this->loan_section->setDbValueDef($rsnew, $this->loan_section->CurrentValue, NULL, FALSE);

		// lat
		$this->lat->setDbValueDef($rsnew, $this->lat->CurrentValue, NULL, FALSE);

		// lon
		$this->lon->setDbValueDef($rsnew, $this->lon->CurrentValue, NULL, FALSE);

		// created_at
		$this->created_at->setDbValueDef($rsnew, UnFormatDateTime($this->created_at->CurrentValue, 0), NULL, FALSE);

		// updated_at
		$this->updated_at->setDbValueDef($rsnew, UnFormatDateTime($this->updated_at->CurrentValue, 0), NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Show link optionally based on User ID
	protected function showOptionLink($id = "")
	{
		global $Security;
		if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id))
			return $Security->isValidUserID($this->user_id->CurrentValue);
		return TRUE;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{

		// Hide foreign keys
		$masterTblVar = $this->getCurrentMasterTable();
		if ($masterTblVar == "users") {
			$this->user_id->Visible = FALSE;
			if ($GLOBALS["users"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		if ($masterTblVar == "loan_purposes") {
			$this->loan_purpose->Visible = FALSE;
			if ($GLOBALS["loan_purposes"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		if ($masterTblVar == "loan_section") {
			$this->loan_section->Visible = FALSE;
			if ($GLOBALS["loan_section"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_user_id":
					break;
				case "x_status":
					break;
				case "x_loan_purpose":
					break;
				case "x_loan_section":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_user_id":
							$row[1] = FormatNumber($row[1], 0, -2, -2, -2);
							$row['df'] = $row[1];
							break;
						case "x_loan_purpose":
							break;
						case "x_loan_section":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

	}
} // End class
?>
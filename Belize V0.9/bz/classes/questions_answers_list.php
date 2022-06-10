<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

/**
 * Page class
 */
class questions_answers_list extends questions_answers
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{98C27E89-2937-4D47-9B89-35CA334C4E82}";

	// Table name
	public $TableName = 'questions-answers';

	// Page object name
	public $PageObjName = "questions_answers_list";

	// Grid form hidden field names
	public $FormName = "fquestions_answerslist";
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

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

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
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (questions_answers)
		if (!isset($GLOBALS["questions_answers"]) || get_class($GLOBALS["questions_answers"]) == PROJECT_NAMESPACE . "questions_answers") {
			$GLOBALS["questions_answers"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["questions_answers"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "questions_answersadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "questions_answersdelete.php";
		$this->MultiUpdateUrl = "questions_answersupdate.php";

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'questions-answers');

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

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions("div");
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fquestions_answerslistsrch";

		// List actions
		$this->ListActions = new ListActions();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $questions_answers;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($questions_answers);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

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
						if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0)
							$val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
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
			$key .= @$ar['question_id'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['answer_id'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['loan_purpose_id'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['loan_sector_id'];
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
			$this->question_id->Visible = FALSE;
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->answer_id->Visible = FALSE;
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->loan_purpose_id->Visible = FALSE;
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->loan_sector_id->Visible = FALSE;
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
	public $DisplayRecords = 200;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,200,-1"; // Page sizes (comma separated)
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
			if (!$Security->canList()) {
				SetStatus(401); // Unauthorized
				return;
			}
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
			}
		}

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom != "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (Config("USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (Config("USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup export options
		$this->setupExportOptions();
		$this->question_id->setVisibility();
		$this->question_title->setVisibility();
		$this->question_placeholder->setVisibility();
		$this->question_questions->setVisibility();
		$this->question_scores->setVisibility();
		$this->question_active->setVisibility();
		$this->question_section_id->setVisibility();
		$this->question_type->setVisibility();
		$this->question_has_recommendations->setVisibility();
		$this->question_group_id->setVisibility();
		$this->question_category_id->setVisibility();
		$this->question_order->setVisibility();
		$this->answer_id->setVisibility();
		$this->answer_response->setVisibility();
		$this->answer_score->setVisibility();
		$this->assessment_id->setVisibility();
		$this->answer_weight->setVisibility();
		$this->answer_section_id->setVisibility();
		$this->answer_recommendations->Visible = FALSE;
		$this->question_type_name->setVisibility();
		$this->question_group_name->setVisibility();
		$this->question_category_name->setVisibility();
		$this->assessment_customer_id->setVisibility();
		$this->assessment_customer_first_name->setVisibility();
		$this->assessment_status->setVisibility();
		$this->assessment_total_score->setVisibility();
		$this->assessment_customer_last_name->setVisibility();
		$this->assessment_user_id->setVisibility();
		$this->assessment_user_first_name->setVisibility();
		$this->assessment_user_last_name->setVisibility();
		$this->assessment_user_email->setVisibility();
		$this->assessment_personal_id->setVisibility();
		$this->assessment_customer_age->setVisibility();
		$this->assessment_sex->setVisibility();
		$this->assessment_address->setVisibility();
		$this->assessment_lat->setVisibility();
		$this->assessment_lon->setVisibility();
		$this->assessment_loan_purpose->setVisibility();
		$this->assessment_loan_section->setVisibility();
		$this->created_at->setVisibility();
		$this->updated_at->setVisibility();
		$this->loan_purpose_id->setVisibility();
		$this->loan_sector_id->setVisibility();
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

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		$this->setupLookupOptions($this->question_section_id);
		$this->setupLookupOptions($this->question_type);
		$this->setupLookupOptions($this->question_group_id);
		$this->setupLookupOptions($this->question_category_id);
		$this->setupLookupOptions($this->assessment_id);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

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

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->loadSearchValues(); // Get search values

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();
			if (!$this->validateSearch())
				$this->setFailureMessage($SearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();

			// Get search criteria for advanced search
			if ($SearchError == "")
				$srchAdvanced = $this->advancedSearchWhere();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 200; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();

			// Load advanced search from default
			if ($this->loadAdvancedSearchDefault()) {
				$srchAdvanced = $this->advancedSearchWhere();
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->Command != "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
			$this->exportData();
			$this->terminate();
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->GridAddRowCount;
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
			if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecords = $this->TotalRecords;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRecord();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecords == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

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
					$this->DisplayRecords = 200; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
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
		if (count($arKeyFlds) >= 4) {
			$this->question_id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->question_id->OldValue))
				return FALSE;
			$this->answer_id->setOldValue($arKeyFlds[1]);
			if (!is_numeric($this->answer_id->OldValue))
				return FALSE;
			$this->loan_purpose_id->setOldValue($arKeyFlds[2]);
			if (!is_numeric($this->loan_purpose_id->OldValue))
				return FALSE;
			$this->loan_sector_id->setOldValue($arKeyFlds[3]);
			if (!is_numeric($this->loan_sector_id->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->question_id->AdvancedSearch->toJson(), ","); // Field question_id
		$filterList = Concat($filterList, $this->question_title->AdvancedSearch->toJson(), ","); // Field question_title
		$filterList = Concat($filterList, $this->question_placeholder->AdvancedSearch->toJson(), ","); // Field question_placeholder
		$filterList = Concat($filterList, $this->question_questions->AdvancedSearch->toJson(), ","); // Field question_questions
		$filterList = Concat($filterList, $this->question_scores->AdvancedSearch->toJson(), ","); // Field question_scores
		$filterList = Concat($filterList, $this->question_active->AdvancedSearch->toJson(), ","); // Field question_active
		$filterList = Concat($filterList, $this->question_section_id->AdvancedSearch->toJson(), ","); // Field question_section_id
		$filterList = Concat($filterList, $this->question_type->AdvancedSearch->toJson(), ","); // Field question_type
		$filterList = Concat($filterList, $this->question_has_recommendations->AdvancedSearch->toJson(), ","); // Field question_has_recommendations
		$filterList = Concat($filterList, $this->question_group_id->AdvancedSearch->toJson(), ","); // Field question_group_id
		$filterList = Concat($filterList, $this->question_category_id->AdvancedSearch->toJson(), ","); // Field question_category_id
		$filterList = Concat($filterList, $this->question_order->AdvancedSearch->toJson(), ","); // Field question_order
		$filterList = Concat($filterList, $this->answer_id->AdvancedSearch->toJson(), ","); // Field answer_id
		$filterList = Concat($filterList, $this->answer_response->AdvancedSearch->toJson(), ","); // Field answer_response
		$filterList = Concat($filterList, $this->answer_score->AdvancedSearch->toJson(), ","); // Field answer_score
		$filterList = Concat($filterList, $this->assessment_id->AdvancedSearch->toJson(), ","); // Field assessment_id
		$filterList = Concat($filterList, $this->answer_weight->AdvancedSearch->toJson(), ","); // Field answer_weight
		$filterList = Concat($filterList, $this->answer_section_id->AdvancedSearch->toJson(), ","); // Field answer_section_id
		$filterList = Concat($filterList, $this->answer_recommendations->AdvancedSearch->toJson(), ","); // Field answer_recommendations
		$filterList = Concat($filterList, $this->question_type_name->AdvancedSearch->toJson(), ","); // Field question_type_name
		$filterList = Concat($filterList, $this->question_group_name->AdvancedSearch->toJson(), ","); // Field question_group_name
		$filterList = Concat($filterList, $this->question_category_name->AdvancedSearch->toJson(), ","); // Field question_category_name
		$filterList = Concat($filterList, $this->assessment_customer_id->AdvancedSearch->toJson(), ","); // Field assessment_customer_id
		$filterList = Concat($filterList, $this->assessment_customer_first_name->AdvancedSearch->toJson(), ","); // Field assessment_customer_first_name
		$filterList = Concat($filterList, $this->assessment_status->AdvancedSearch->toJson(), ","); // Field assessment_status
		$filterList = Concat($filterList, $this->assessment_total_score->AdvancedSearch->toJson(), ","); // Field assessment_total_score
		$filterList = Concat($filterList, $this->assessment_customer_last_name->AdvancedSearch->toJson(), ","); // Field assessment_customer_last_name
		$filterList = Concat($filterList, $this->assessment_user_id->AdvancedSearch->toJson(), ","); // Field assessment_user_id
		$filterList = Concat($filterList, $this->assessment_user_first_name->AdvancedSearch->toJson(), ","); // Field assessment_user_first_name
		$filterList = Concat($filterList, $this->assessment_user_last_name->AdvancedSearch->toJson(), ","); // Field assessment_user_last_name
		$filterList = Concat($filterList, $this->assessment_user_email->AdvancedSearch->toJson(), ","); // Field assessment_user_email
		$filterList = Concat($filterList, $this->assessment_personal_id->AdvancedSearch->toJson(), ","); // Field assessment_personal_id
		$filterList = Concat($filterList, $this->assessment_customer_age->AdvancedSearch->toJson(), ","); // Field assessment_customer_age
		$filterList = Concat($filterList, $this->assessment_sex->AdvancedSearch->toJson(), ","); // Field assessment_sex
		$filterList = Concat($filterList, $this->assessment_address->AdvancedSearch->toJson(), ","); // Field assessment_address
		$filterList = Concat($filterList, $this->assessment_lat->AdvancedSearch->toJson(), ","); // Field assessment_lat
		$filterList = Concat($filterList, $this->assessment_lon->AdvancedSearch->toJson(), ","); // Field assessment_lon
		$filterList = Concat($filterList, $this->assessment_loan_purpose->AdvancedSearch->toJson(), ","); // Field assessment_loan_purpose
		$filterList = Concat($filterList, $this->assessment_loan_section->AdvancedSearch->toJson(), ","); // Field assessment_loan_section
		$filterList = Concat($filterList, $this->created_at->AdvancedSearch->toJson(), ","); // Field created_at
		$filterList = Concat($filterList, $this->updated_at->AdvancedSearch->toJson(), ","); // Field updated_at
		$filterList = Concat($filterList, $this->loan_purpose_id->AdvancedSearch->toJson(), ","); // Field loan_purpose_id
		$filterList = Concat($filterList, $this->loan_sector_id->AdvancedSearch->toJson(), ","); // Field loan_sector_id
		if ($this->BasicSearch->Keyword != "") {
			$wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fquestions_answerslistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field question_id
		$this->question_id->AdvancedSearch->SearchValue = @$filter["x_question_id"];
		$this->question_id->AdvancedSearch->SearchOperator = @$filter["z_question_id"];
		$this->question_id->AdvancedSearch->SearchCondition = @$filter["v_question_id"];
		$this->question_id->AdvancedSearch->SearchValue2 = @$filter["y_question_id"];
		$this->question_id->AdvancedSearch->SearchOperator2 = @$filter["w_question_id"];
		$this->question_id->AdvancedSearch->save();

		// Field question_title
		$this->question_title->AdvancedSearch->SearchValue = @$filter["x_question_title"];
		$this->question_title->AdvancedSearch->SearchOperator = @$filter["z_question_title"];
		$this->question_title->AdvancedSearch->SearchCondition = @$filter["v_question_title"];
		$this->question_title->AdvancedSearch->SearchValue2 = @$filter["y_question_title"];
		$this->question_title->AdvancedSearch->SearchOperator2 = @$filter["w_question_title"];
		$this->question_title->AdvancedSearch->save();

		// Field question_placeholder
		$this->question_placeholder->AdvancedSearch->SearchValue = @$filter["x_question_placeholder"];
		$this->question_placeholder->AdvancedSearch->SearchOperator = @$filter["z_question_placeholder"];
		$this->question_placeholder->AdvancedSearch->SearchCondition = @$filter["v_question_placeholder"];
		$this->question_placeholder->AdvancedSearch->SearchValue2 = @$filter["y_question_placeholder"];
		$this->question_placeholder->AdvancedSearch->SearchOperator2 = @$filter["w_question_placeholder"];
		$this->question_placeholder->AdvancedSearch->save();

		// Field question_questions
		$this->question_questions->AdvancedSearch->SearchValue = @$filter["x_question_questions"];
		$this->question_questions->AdvancedSearch->SearchOperator = @$filter["z_question_questions"];
		$this->question_questions->AdvancedSearch->SearchCondition = @$filter["v_question_questions"];
		$this->question_questions->AdvancedSearch->SearchValue2 = @$filter["y_question_questions"];
		$this->question_questions->AdvancedSearch->SearchOperator2 = @$filter["w_question_questions"];
		$this->question_questions->AdvancedSearch->save();

		// Field question_scores
		$this->question_scores->AdvancedSearch->SearchValue = @$filter["x_question_scores"];
		$this->question_scores->AdvancedSearch->SearchOperator = @$filter["z_question_scores"];
		$this->question_scores->AdvancedSearch->SearchCondition = @$filter["v_question_scores"];
		$this->question_scores->AdvancedSearch->SearchValue2 = @$filter["y_question_scores"];
		$this->question_scores->AdvancedSearch->SearchOperator2 = @$filter["w_question_scores"];
		$this->question_scores->AdvancedSearch->save();

		// Field question_active
		$this->question_active->AdvancedSearch->SearchValue = @$filter["x_question_active"];
		$this->question_active->AdvancedSearch->SearchOperator = @$filter["z_question_active"];
		$this->question_active->AdvancedSearch->SearchCondition = @$filter["v_question_active"];
		$this->question_active->AdvancedSearch->SearchValue2 = @$filter["y_question_active"];
		$this->question_active->AdvancedSearch->SearchOperator2 = @$filter["w_question_active"];
		$this->question_active->AdvancedSearch->save();

		// Field question_section_id
		$this->question_section_id->AdvancedSearch->SearchValue = @$filter["x_question_section_id"];
		$this->question_section_id->AdvancedSearch->SearchOperator = @$filter["z_question_section_id"];
		$this->question_section_id->AdvancedSearch->SearchCondition = @$filter["v_question_section_id"];
		$this->question_section_id->AdvancedSearch->SearchValue2 = @$filter["y_question_section_id"];
		$this->question_section_id->AdvancedSearch->SearchOperator2 = @$filter["w_question_section_id"];
		$this->question_section_id->AdvancedSearch->save();

		// Field question_type
		$this->question_type->AdvancedSearch->SearchValue = @$filter["x_question_type"];
		$this->question_type->AdvancedSearch->SearchOperator = @$filter["z_question_type"];
		$this->question_type->AdvancedSearch->SearchCondition = @$filter["v_question_type"];
		$this->question_type->AdvancedSearch->SearchValue2 = @$filter["y_question_type"];
		$this->question_type->AdvancedSearch->SearchOperator2 = @$filter["w_question_type"];
		$this->question_type->AdvancedSearch->save();

		// Field question_has_recommendations
		$this->question_has_recommendations->AdvancedSearch->SearchValue = @$filter["x_question_has_recommendations"];
		$this->question_has_recommendations->AdvancedSearch->SearchOperator = @$filter["z_question_has_recommendations"];
		$this->question_has_recommendations->AdvancedSearch->SearchCondition = @$filter["v_question_has_recommendations"];
		$this->question_has_recommendations->AdvancedSearch->SearchValue2 = @$filter["y_question_has_recommendations"];
		$this->question_has_recommendations->AdvancedSearch->SearchOperator2 = @$filter["w_question_has_recommendations"];
		$this->question_has_recommendations->AdvancedSearch->save();

		// Field question_group_id
		$this->question_group_id->AdvancedSearch->SearchValue = @$filter["x_question_group_id"];
		$this->question_group_id->AdvancedSearch->SearchOperator = @$filter["z_question_group_id"];
		$this->question_group_id->AdvancedSearch->SearchCondition = @$filter["v_question_group_id"];
		$this->question_group_id->AdvancedSearch->SearchValue2 = @$filter["y_question_group_id"];
		$this->question_group_id->AdvancedSearch->SearchOperator2 = @$filter["w_question_group_id"];
		$this->question_group_id->AdvancedSearch->save();

		// Field question_category_id
		$this->question_category_id->AdvancedSearch->SearchValue = @$filter["x_question_category_id"];
		$this->question_category_id->AdvancedSearch->SearchOperator = @$filter["z_question_category_id"];
		$this->question_category_id->AdvancedSearch->SearchCondition = @$filter["v_question_category_id"];
		$this->question_category_id->AdvancedSearch->SearchValue2 = @$filter["y_question_category_id"];
		$this->question_category_id->AdvancedSearch->SearchOperator2 = @$filter["w_question_category_id"];
		$this->question_category_id->AdvancedSearch->save();

		// Field question_order
		$this->question_order->AdvancedSearch->SearchValue = @$filter["x_question_order"];
		$this->question_order->AdvancedSearch->SearchOperator = @$filter["z_question_order"];
		$this->question_order->AdvancedSearch->SearchCondition = @$filter["v_question_order"];
		$this->question_order->AdvancedSearch->SearchValue2 = @$filter["y_question_order"];
		$this->question_order->AdvancedSearch->SearchOperator2 = @$filter["w_question_order"];
		$this->question_order->AdvancedSearch->save();

		// Field answer_id
		$this->answer_id->AdvancedSearch->SearchValue = @$filter["x_answer_id"];
		$this->answer_id->AdvancedSearch->SearchOperator = @$filter["z_answer_id"];
		$this->answer_id->AdvancedSearch->SearchCondition = @$filter["v_answer_id"];
		$this->answer_id->AdvancedSearch->SearchValue2 = @$filter["y_answer_id"];
		$this->answer_id->AdvancedSearch->SearchOperator2 = @$filter["w_answer_id"];
		$this->answer_id->AdvancedSearch->save();

		// Field answer_response
		$this->answer_response->AdvancedSearch->SearchValue = @$filter["x_answer_response"];
		$this->answer_response->AdvancedSearch->SearchOperator = @$filter["z_answer_response"];
		$this->answer_response->AdvancedSearch->SearchCondition = @$filter["v_answer_response"];
		$this->answer_response->AdvancedSearch->SearchValue2 = @$filter["y_answer_response"];
		$this->answer_response->AdvancedSearch->SearchOperator2 = @$filter["w_answer_response"];
		$this->answer_response->AdvancedSearch->save();

		// Field answer_score
		$this->answer_score->AdvancedSearch->SearchValue = @$filter["x_answer_score"];
		$this->answer_score->AdvancedSearch->SearchOperator = @$filter["z_answer_score"];
		$this->answer_score->AdvancedSearch->SearchCondition = @$filter["v_answer_score"];
		$this->answer_score->AdvancedSearch->SearchValue2 = @$filter["y_answer_score"];
		$this->answer_score->AdvancedSearch->SearchOperator2 = @$filter["w_answer_score"];
		$this->answer_score->AdvancedSearch->save();

		// Field assessment_id
		$this->assessment_id->AdvancedSearch->SearchValue = @$filter["x_assessment_id"];
		$this->assessment_id->AdvancedSearch->SearchOperator = @$filter["z_assessment_id"];
		$this->assessment_id->AdvancedSearch->SearchCondition = @$filter["v_assessment_id"];
		$this->assessment_id->AdvancedSearch->SearchValue2 = @$filter["y_assessment_id"];
		$this->assessment_id->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_id"];
		$this->assessment_id->AdvancedSearch->save();

		// Field answer_weight
		$this->answer_weight->AdvancedSearch->SearchValue = @$filter["x_answer_weight"];
		$this->answer_weight->AdvancedSearch->SearchOperator = @$filter["z_answer_weight"];
		$this->answer_weight->AdvancedSearch->SearchCondition = @$filter["v_answer_weight"];
		$this->answer_weight->AdvancedSearch->SearchValue2 = @$filter["y_answer_weight"];
		$this->answer_weight->AdvancedSearch->SearchOperator2 = @$filter["w_answer_weight"];
		$this->answer_weight->AdvancedSearch->save();

		// Field answer_section_id
		$this->answer_section_id->AdvancedSearch->SearchValue = @$filter["x_answer_section_id"];
		$this->answer_section_id->AdvancedSearch->SearchOperator = @$filter["z_answer_section_id"];
		$this->answer_section_id->AdvancedSearch->SearchCondition = @$filter["v_answer_section_id"];
		$this->answer_section_id->AdvancedSearch->SearchValue2 = @$filter["y_answer_section_id"];
		$this->answer_section_id->AdvancedSearch->SearchOperator2 = @$filter["w_answer_section_id"];
		$this->answer_section_id->AdvancedSearch->save();

		// Field answer_recommendations
		$this->answer_recommendations->AdvancedSearch->SearchValue = @$filter["x_answer_recommendations"];
		$this->answer_recommendations->AdvancedSearch->SearchOperator = @$filter["z_answer_recommendations"];
		$this->answer_recommendations->AdvancedSearch->SearchCondition = @$filter["v_answer_recommendations"];
		$this->answer_recommendations->AdvancedSearch->SearchValue2 = @$filter["y_answer_recommendations"];
		$this->answer_recommendations->AdvancedSearch->SearchOperator2 = @$filter["w_answer_recommendations"];
		$this->answer_recommendations->AdvancedSearch->save();

		// Field question_type_name
		$this->question_type_name->AdvancedSearch->SearchValue = @$filter["x_question_type_name"];
		$this->question_type_name->AdvancedSearch->SearchOperator = @$filter["z_question_type_name"];
		$this->question_type_name->AdvancedSearch->SearchCondition = @$filter["v_question_type_name"];
		$this->question_type_name->AdvancedSearch->SearchValue2 = @$filter["y_question_type_name"];
		$this->question_type_name->AdvancedSearch->SearchOperator2 = @$filter["w_question_type_name"];
		$this->question_type_name->AdvancedSearch->save();

		// Field question_group_name
		$this->question_group_name->AdvancedSearch->SearchValue = @$filter["x_question_group_name"];
		$this->question_group_name->AdvancedSearch->SearchOperator = @$filter["z_question_group_name"];
		$this->question_group_name->AdvancedSearch->SearchCondition = @$filter["v_question_group_name"];
		$this->question_group_name->AdvancedSearch->SearchValue2 = @$filter["y_question_group_name"];
		$this->question_group_name->AdvancedSearch->SearchOperator2 = @$filter["w_question_group_name"];
		$this->question_group_name->AdvancedSearch->save();

		// Field question_category_name
		$this->question_category_name->AdvancedSearch->SearchValue = @$filter["x_question_category_name"];
		$this->question_category_name->AdvancedSearch->SearchOperator = @$filter["z_question_category_name"];
		$this->question_category_name->AdvancedSearch->SearchCondition = @$filter["v_question_category_name"];
		$this->question_category_name->AdvancedSearch->SearchValue2 = @$filter["y_question_category_name"];
		$this->question_category_name->AdvancedSearch->SearchOperator2 = @$filter["w_question_category_name"];
		$this->question_category_name->AdvancedSearch->save();

		// Field assessment_customer_id
		$this->assessment_customer_id->AdvancedSearch->SearchValue = @$filter["x_assessment_customer_id"];
		$this->assessment_customer_id->AdvancedSearch->SearchOperator = @$filter["z_assessment_customer_id"];
		$this->assessment_customer_id->AdvancedSearch->SearchCondition = @$filter["v_assessment_customer_id"];
		$this->assessment_customer_id->AdvancedSearch->SearchValue2 = @$filter["y_assessment_customer_id"];
		$this->assessment_customer_id->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_customer_id"];
		$this->assessment_customer_id->AdvancedSearch->save();

		// Field assessment_customer_first_name
		$this->assessment_customer_first_name->AdvancedSearch->SearchValue = @$filter["x_assessment_customer_first_name"];
		$this->assessment_customer_first_name->AdvancedSearch->SearchOperator = @$filter["z_assessment_customer_first_name"];
		$this->assessment_customer_first_name->AdvancedSearch->SearchCondition = @$filter["v_assessment_customer_first_name"];
		$this->assessment_customer_first_name->AdvancedSearch->SearchValue2 = @$filter["y_assessment_customer_first_name"];
		$this->assessment_customer_first_name->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_customer_first_name"];
		$this->assessment_customer_first_name->AdvancedSearch->save();

		// Field assessment_status
		$this->assessment_status->AdvancedSearch->SearchValue = @$filter["x_assessment_status"];
		$this->assessment_status->AdvancedSearch->SearchOperator = @$filter["z_assessment_status"];
		$this->assessment_status->AdvancedSearch->SearchCondition = @$filter["v_assessment_status"];
		$this->assessment_status->AdvancedSearch->SearchValue2 = @$filter["y_assessment_status"];
		$this->assessment_status->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_status"];
		$this->assessment_status->AdvancedSearch->save();

		// Field assessment_total_score
		$this->assessment_total_score->AdvancedSearch->SearchValue = @$filter["x_assessment_total_score"];
		$this->assessment_total_score->AdvancedSearch->SearchOperator = @$filter["z_assessment_total_score"];
		$this->assessment_total_score->AdvancedSearch->SearchCondition = @$filter["v_assessment_total_score"];
		$this->assessment_total_score->AdvancedSearch->SearchValue2 = @$filter["y_assessment_total_score"];
		$this->assessment_total_score->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_total_score"];
		$this->assessment_total_score->AdvancedSearch->save();

		// Field assessment_customer_last_name
		$this->assessment_customer_last_name->AdvancedSearch->SearchValue = @$filter["x_assessment_customer_last_name"];
		$this->assessment_customer_last_name->AdvancedSearch->SearchOperator = @$filter["z_assessment_customer_last_name"];
		$this->assessment_customer_last_name->AdvancedSearch->SearchCondition = @$filter["v_assessment_customer_last_name"];
		$this->assessment_customer_last_name->AdvancedSearch->SearchValue2 = @$filter["y_assessment_customer_last_name"];
		$this->assessment_customer_last_name->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_customer_last_name"];
		$this->assessment_customer_last_name->AdvancedSearch->save();

		// Field assessment_user_id
		$this->assessment_user_id->AdvancedSearch->SearchValue = @$filter["x_assessment_user_id"];
		$this->assessment_user_id->AdvancedSearch->SearchOperator = @$filter["z_assessment_user_id"];
		$this->assessment_user_id->AdvancedSearch->SearchCondition = @$filter["v_assessment_user_id"];
		$this->assessment_user_id->AdvancedSearch->SearchValue2 = @$filter["y_assessment_user_id"];
		$this->assessment_user_id->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_user_id"];
		$this->assessment_user_id->AdvancedSearch->save();

		// Field assessment_user_first_name
		$this->assessment_user_first_name->AdvancedSearch->SearchValue = @$filter["x_assessment_user_first_name"];
		$this->assessment_user_first_name->AdvancedSearch->SearchOperator = @$filter["z_assessment_user_first_name"];
		$this->assessment_user_first_name->AdvancedSearch->SearchCondition = @$filter["v_assessment_user_first_name"];
		$this->assessment_user_first_name->AdvancedSearch->SearchValue2 = @$filter["y_assessment_user_first_name"];
		$this->assessment_user_first_name->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_user_first_name"];
		$this->assessment_user_first_name->AdvancedSearch->save();

		// Field assessment_user_last_name
		$this->assessment_user_last_name->AdvancedSearch->SearchValue = @$filter["x_assessment_user_last_name"];
		$this->assessment_user_last_name->AdvancedSearch->SearchOperator = @$filter["z_assessment_user_last_name"];
		$this->assessment_user_last_name->AdvancedSearch->SearchCondition = @$filter["v_assessment_user_last_name"];
		$this->assessment_user_last_name->AdvancedSearch->SearchValue2 = @$filter["y_assessment_user_last_name"];
		$this->assessment_user_last_name->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_user_last_name"];
		$this->assessment_user_last_name->AdvancedSearch->save();

		// Field assessment_user_email
		$this->assessment_user_email->AdvancedSearch->SearchValue = @$filter["x_assessment_user_email"];
		$this->assessment_user_email->AdvancedSearch->SearchOperator = @$filter["z_assessment_user_email"];
		$this->assessment_user_email->AdvancedSearch->SearchCondition = @$filter["v_assessment_user_email"];
		$this->assessment_user_email->AdvancedSearch->SearchValue2 = @$filter["y_assessment_user_email"];
		$this->assessment_user_email->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_user_email"];
		$this->assessment_user_email->AdvancedSearch->save();

		// Field assessment_personal_id
		$this->assessment_personal_id->AdvancedSearch->SearchValue = @$filter["x_assessment_personal_id"];
		$this->assessment_personal_id->AdvancedSearch->SearchOperator = @$filter["z_assessment_personal_id"];
		$this->assessment_personal_id->AdvancedSearch->SearchCondition = @$filter["v_assessment_personal_id"];
		$this->assessment_personal_id->AdvancedSearch->SearchValue2 = @$filter["y_assessment_personal_id"];
		$this->assessment_personal_id->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_personal_id"];
		$this->assessment_personal_id->AdvancedSearch->save();

		// Field assessment_customer_age
		$this->assessment_customer_age->AdvancedSearch->SearchValue = @$filter["x_assessment_customer_age"];
		$this->assessment_customer_age->AdvancedSearch->SearchOperator = @$filter["z_assessment_customer_age"];
		$this->assessment_customer_age->AdvancedSearch->SearchCondition = @$filter["v_assessment_customer_age"];
		$this->assessment_customer_age->AdvancedSearch->SearchValue2 = @$filter["y_assessment_customer_age"];
		$this->assessment_customer_age->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_customer_age"];
		$this->assessment_customer_age->AdvancedSearch->save();

		// Field assessment_sex
		$this->assessment_sex->AdvancedSearch->SearchValue = @$filter["x_assessment_sex"];
		$this->assessment_sex->AdvancedSearch->SearchOperator = @$filter["z_assessment_sex"];
		$this->assessment_sex->AdvancedSearch->SearchCondition = @$filter["v_assessment_sex"];
		$this->assessment_sex->AdvancedSearch->SearchValue2 = @$filter["y_assessment_sex"];
		$this->assessment_sex->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_sex"];
		$this->assessment_sex->AdvancedSearch->save();

		// Field assessment_address
		$this->assessment_address->AdvancedSearch->SearchValue = @$filter["x_assessment_address"];
		$this->assessment_address->AdvancedSearch->SearchOperator = @$filter["z_assessment_address"];
		$this->assessment_address->AdvancedSearch->SearchCondition = @$filter["v_assessment_address"];
		$this->assessment_address->AdvancedSearch->SearchValue2 = @$filter["y_assessment_address"];
		$this->assessment_address->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_address"];
		$this->assessment_address->AdvancedSearch->save();

		// Field assessment_lat
		$this->assessment_lat->AdvancedSearch->SearchValue = @$filter["x_assessment_lat"];
		$this->assessment_lat->AdvancedSearch->SearchOperator = @$filter["z_assessment_lat"];
		$this->assessment_lat->AdvancedSearch->SearchCondition = @$filter["v_assessment_lat"];
		$this->assessment_lat->AdvancedSearch->SearchValue2 = @$filter["y_assessment_lat"];
		$this->assessment_lat->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_lat"];
		$this->assessment_lat->AdvancedSearch->save();

		// Field assessment_lon
		$this->assessment_lon->AdvancedSearch->SearchValue = @$filter["x_assessment_lon"];
		$this->assessment_lon->AdvancedSearch->SearchOperator = @$filter["z_assessment_lon"];
		$this->assessment_lon->AdvancedSearch->SearchCondition = @$filter["v_assessment_lon"];
		$this->assessment_lon->AdvancedSearch->SearchValue2 = @$filter["y_assessment_lon"];
		$this->assessment_lon->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_lon"];
		$this->assessment_lon->AdvancedSearch->save();

		// Field assessment_loan_purpose
		$this->assessment_loan_purpose->AdvancedSearch->SearchValue = @$filter["x_assessment_loan_purpose"];
		$this->assessment_loan_purpose->AdvancedSearch->SearchOperator = @$filter["z_assessment_loan_purpose"];
		$this->assessment_loan_purpose->AdvancedSearch->SearchCondition = @$filter["v_assessment_loan_purpose"];
		$this->assessment_loan_purpose->AdvancedSearch->SearchValue2 = @$filter["y_assessment_loan_purpose"];
		$this->assessment_loan_purpose->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_loan_purpose"];
		$this->assessment_loan_purpose->AdvancedSearch->save();

		// Field assessment_loan_section
		$this->assessment_loan_section->AdvancedSearch->SearchValue = @$filter["x_assessment_loan_section"];
		$this->assessment_loan_section->AdvancedSearch->SearchOperator = @$filter["z_assessment_loan_section"];
		$this->assessment_loan_section->AdvancedSearch->SearchCondition = @$filter["v_assessment_loan_section"];
		$this->assessment_loan_section->AdvancedSearch->SearchValue2 = @$filter["y_assessment_loan_section"];
		$this->assessment_loan_section->AdvancedSearch->SearchOperator2 = @$filter["w_assessment_loan_section"];
		$this->assessment_loan_section->AdvancedSearch->save();

		// Field created_at
		$this->created_at->AdvancedSearch->SearchValue = @$filter["x_created_at"];
		$this->created_at->AdvancedSearch->SearchOperator = @$filter["z_created_at"];
		$this->created_at->AdvancedSearch->SearchCondition = @$filter["v_created_at"];
		$this->created_at->AdvancedSearch->SearchValue2 = @$filter["y_created_at"];
		$this->created_at->AdvancedSearch->SearchOperator2 = @$filter["w_created_at"];
		$this->created_at->AdvancedSearch->save();

		// Field updated_at
		$this->updated_at->AdvancedSearch->SearchValue = @$filter["x_updated_at"];
		$this->updated_at->AdvancedSearch->SearchOperator = @$filter["z_updated_at"];
		$this->updated_at->AdvancedSearch->SearchCondition = @$filter["v_updated_at"];
		$this->updated_at->AdvancedSearch->SearchValue2 = @$filter["y_updated_at"];
		$this->updated_at->AdvancedSearch->SearchOperator2 = @$filter["w_updated_at"];
		$this->updated_at->AdvancedSearch->save();

		// Field loan_purpose_id
		$this->loan_purpose_id->AdvancedSearch->SearchValue = @$filter["x_loan_purpose_id"];
		$this->loan_purpose_id->AdvancedSearch->SearchOperator = @$filter["z_loan_purpose_id"];
		$this->loan_purpose_id->AdvancedSearch->SearchCondition = @$filter["v_loan_purpose_id"];
		$this->loan_purpose_id->AdvancedSearch->SearchValue2 = @$filter["y_loan_purpose_id"];
		$this->loan_purpose_id->AdvancedSearch->SearchOperator2 = @$filter["w_loan_purpose_id"];
		$this->loan_purpose_id->AdvancedSearch->save();

		// Field loan_sector_id
		$this->loan_sector_id->AdvancedSearch->SearchValue = @$filter["x_loan_sector_id"];
		$this->loan_sector_id->AdvancedSearch->SearchOperator = @$filter["z_loan_sector_id"];
		$this->loan_sector_id->AdvancedSearch->SearchCondition = @$filter["v_loan_sector_id"];
		$this->loan_sector_id->AdvancedSearch->SearchValue2 = @$filter["y_loan_sector_id"];
		$this->loan_sector_id->AdvancedSearch->SearchOperator2 = @$filter["w_loan_sector_id"];
		$this->loan_sector_id->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->question_id, $default, FALSE); // question_id
		$this->buildSearchSql($where, $this->question_title, $default, FALSE); // question_title
		$this->buildSearchSql($where, $this->question_placeholder, $default, FALSE); // question_placeholder
		$this->buildSearchSql($where, $this->question_questions, $default, FALSE); // question_questions
		$this->buildSearchSql($where, $this->question_scores, $default, FALSE); // question_scores
		$this->buildSearchSql($where, $this->question_active, $default, FALSE); // question_active
		$this->buildSearchSql($where, $this->question_section_id, $default, FALSE); // question_section_id
		$this->buildSearchSql($where, $this->question_type, $default, FALSE); // question_type
		$this->buildSearchSql($where, $this->question_has_recommendations, $default, FALSE); // question_has_recommendations
		$this->buildSearchSql($where, $this->question_group_id, $default, FALSE); // question_group_id
		$this->buildSearchSql($where, $this->question_category_id, $default, FALSE); // question_category_id
		$this->buildSearchSql($where, $this->question_order, $default, FALSE); // question_order
		$this->buildSearchSql($where, $this->answer_id, $default, FALSE); // answer_id
		$this->buildSearchSql($where, $this->answer_response, $default, FALSE); // answer_response
		$this->buildSearchSql($where, $this->answer_score, $default, FALSE); // answer_score
		$this->buildSearchSql($where, $this->assessment_id, $default, FALSE); // assessment_id
		$this->buildSearchSql($where, $this->answer_weight, $default, FALSE); // answer_weight
		$this->buildSearchSql($where, $this->answer_section_id, $default, FALSE); // answer_section_id
		$this->buildSearchSql($where, $this->answer_recommendations, $default, FALSE); // answer_recommendations
		$this->buildSearchSql($where, $this->question_type_name, $default, FALSE); // question_type_name
		$this->buildSearchSql($where, $this->question_group_name, $default, FALSE); // question_group_name
		$this->buildSearchSql($where, $this->question_category_name, $default, FALSE); // question_category_name
		$this->buildSearchSql($where, $this->assessment_customer_id, $default, FALSE); // assessment_customer_id
		$this->buildSearchSql($where, $this->assessment_customer_first_name, $default, FALSE); // assessment_customer_first_name
		$this->buildSearchSql($where, $this->assessment_status, $default, FALSE); // assessment_status
		$this->buildSearchSql($where, $this->assessment_total_score, $default, FALSE); // assessment_total_score
		$this->buildSearchSql($where, $this->assessment_customer_last_name, $default, FALSE); // assessment_customer_last_name
		$this->buildSearchSql($where, $this->assessment_user_id, $default, FALSE); // assessment_user_id
		$this->buildSearchSql($where, $this->assessment_user_first_name, $default, FALSE); // assessment_user_first_name
		$this->buildSearchSql($where, $this->assessment_user_last_name, $default, FALSE); // assessment_user_last_name
		$this->buildSearchSql($where, $this->assessment_user_email, $default, FALSE); // assessment_user_email
		$this->buildSearchSql($where, $this->assessment_personal_id, $default, FALSE); // assessment_personal_id
		$this->buildSearchSql($where, $this->assessment_customer_age, $default, FALSE); // assessment_customer_age
		$this->buildSearchSql($where, $this->assessment_sex, $default, FALSE); // assessment_sex
		$this->buildSearchSql($where, $this->assessment_address, $default, FALSE); // assessment_address
		$this->buildSearchSql($where, $this->assessment_lat, $default, FALSE); // assessment_lat
		$this->buildSearchSql($where, $this->assessment_lon, $default, FALSE); // assessment_lon
		$this->buildSearchSql($where, $this->assessment_loan_purpose, $default, FALSE); // assessment_loan_purpose
		$this->buildSearchSql($where, $this->assessment_loan_section, $default, FALSE); // assessment_loan_section
		$this->buildSearchSql($where, $this->created_at, $default, FALSE); // created_at
		$this->buildSearchSql($where, $this->updated_at, $default, FALSE); // updated_at
		$this->buildSearchSql($where, $this->loan_purpose_id, $default, FALSE); // loan_purpose_id
		$this->buildSearchSql($where, $this->loan_sector_id, $default, FALSE); // loan_sector_id

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->question_id->AdvancedSearch->save(); // question_id
			$this->question_title->AdvancedSearch->save(); // question_title
			$this->question_placeholder->AdvancedSearch->save(); // question_placeholder
			$this->question_questions->AdvancedSearch->save(); // question_questions
			$this->question_scores->AdvancedSearch->save(); // question_scores
			$this->question_active->AdvancedSearch->save(); // question_active
			$this->question_section_id->AdvancedSearch->save(); // question_section_id
			$this->question_type->AdvancedSearch->save(); // question_type
			$this->question_has_recommendations->AdvancedSearch->save(); // question_has_recommendations
			$this->question_group_id->AdvancedSearch->save(); // question_group_id
			$this->question_category_id->AdvancedSearch->save(); // question_category_id
			$this->question_order->AdvancedSearch->save(); // question_order
			$this->answer_id->AdvancedSearch->save(); // answer_id
			$this->answer_response->AdvancedSearch->save(); // answer_response
			$this->answer_score->AdvancedSearch->save(); // answer_score
			$this->assessment_id->AdvancedSearch->save(); // assessment_id
			$this->answer_weight->AdvancedSearch->save(); // answer_weight
			$this->answer_section_id->AdvancedSearch->save(); // answer_section_id
			$this->answer_recommendations->AdvancedSearch->save(); // answer_recommendations
			$this->question_type_name->AdvancedSearch->save(); // question_type_name
			$this->question_group_name->AdvancedSearch->save(); // question_group_name
			$this->question_category_name->AdvancedSearch->save(); // question_category_name
			$this->assessment_customer_id->AdvancedSearch->save(); // assessment_customer_id
			$this->assessment_customer_first_name->AdvancedSearch->save(); // assessment_customer_first_name
			$this->assessment_status->AdvancedSearch->save(); // assessment_status
			$this->assessment_total_score->AdvancedSearch->save(); // assessment_total_score
			$this->assessment_customer_last_name->AdvancedSearch->save(); // assessment_customer_last_name
			$this->assessment_user_id->AdvancedSearch->save(); // assessment_user_id
			$this->assessment_user_first_name->AdvancedSearch->save(); // assessment_user_first_name
			$this->assessment_user_last_name->AdvancedSearch->save(); // assessment_user_last_name
			$this->assessment_user_email->AdvancedSearch->save(); // assessment_user_email
			$this->assessment_personal_id->AdvancedSearch->save(); // assessment_personal_id
			$this->assessment_customer_age->AdvancedSearch->save(); // assessment_customer_age
			$this->assessment_sex->AdvancedSearch->save(); // assessment_sex
			$this->assessment_address->AdvancedSearch->save(); // assessment_address
			$this->assessment_lat->AdvancedSearch->save(); // assessment_lat
			$this->assessment_lon->AdvancedSearch->save(); // assessment_lon
			$this->assessment_loan_purpose->AdvancedSearch->save(); // assessment_loan_purpose
			$this->assessment_loan_section->AdvancedSearch->save(); // assessment_loan_section
			$this->created_at->AdvancedSearch->save(); // created_at
			$this->updated_at->AdvancedSearch->save(); // updated_at
			$this->loan_purpose_id->AdvancedSearch->save(); // loan_purpose_id
			$this->loan_sector_id->AdvancedSearch->save(); // loan_sector_id
		}
		return $where;
	}

	// Build search SQL
	protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
	{
		$fldParm = $fld->Param;
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
		$fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
		$fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
		$fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
		$wrk = "";
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		if ($fldOpr == "")
			$fldOpr = "=";
		$fldOpr2 = strtoupper(trim($fldOpr2));
		if ($fldOpr2 == "")
			$fldOpr2 = "=";
		if (Config("SEARCH_MULTI_VALUE_OPTION") == 1 || !IsMultiSearchOperator($fldOpr))
			$multiValue = FALSE;
		if ($multiValue) {
			$wrk1 = ($fldVal != "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
			$wrk2 = ($fldVal2 != "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
			$wrk = $wrk1; // Build final SQL
			if ($wrk2 != "")
				$wrk = ($wrk != "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
		} else {
			$fldVal = $this->convertSearchValue($fld, $fldVal);
			$fldVal2 = $this->convertSearchValue($fld, $fldVal2);
			$wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
		}
		AddFilter($where, $wrk);
	}

	// Convert search value
	protected function convertSearchValue(&$fld, $fldVal)
	{
		if ($fldVal == Config("NULL_VALUE") || $fldVal == Config("NOT_NULL_VALUE"))
			return $fldVal;
		$value = $fldVal;
		if ($fld->isBoolean()) {
			if ($fldVal != "")
				$value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
		} elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
			if ($fldVal != "")
				$value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
		}
		return $value;
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->question_title, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->question_placeholder, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->question_questions, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->question_scores, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->answer_response, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->assessment_id, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->answer_recommendations, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->question_type_name, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->question_group_name, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->question_category_name, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->assessment_customer_id, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->assessment_customer_first_name, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->assessment_customer_last_name, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->assessment_user_first_name, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->assessment_user_last_name, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->assessment_user_email, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->assessment_personal_id, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->assessment_sex, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->assessment_address, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->assessment_loan_purpose, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->assessment_loan_section, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = []; // Array for SQL parts
		$arCond = []; // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
				$keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = [$keyword];
			}
			foreach ($ar as $keyword) {
				if ($keyword != "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == Config("NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == Config("NOT_NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk != "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] != "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql != "") {
			if ($where != "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		if (!$Security->canSearch())
			return "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword != "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword != "") {
						if ($searchStr != "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, ["", "reset", "resetall"]))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		if ($this->question_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_title->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_placeholder->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_questions->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_scores->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_active->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_section_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_type->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_has_recommendations->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_group_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_category_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_order->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->answer_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->answer_response->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->answer_score->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->answer_weight->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->answer_section_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->answer_recommendations->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_type_name->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_group_name->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->question_category_name->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_customer_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_customer_first_name->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_status->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_total_score->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_customer_last_name->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_user_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_user_first_name->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_user_last_name->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_user_email->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_personal_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_customer_age->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_sex->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_address->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_lat->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_lon->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_loan_purpose->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->assessment_loan_section->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->created_at->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->updated_at->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->loan_purpose_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->loan_sector_id->AdvancedSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->question_id->AdvancedSearch->unsetSession();
		$this->question_title->AdvancedSearch->unsetSession();
		$this->question_placeholder->AdvancedSearch->unsetSession();
		$this->question_questions->AdvancedSearch->unsetSession();
		$this->question_scores->AdvancedSearch->unsetSession();
		$this->question_active->AdvancedSearch->unsetSession();
		$this->question_section_id->AdvancedSearch->unsetSession();
		$this->question_type->AdvancedSearch->unsetSession();
		$this->question_has_recommendations->AdvancedSearch->unsetSession();
		$this->question_group_id->AdvancedSearch->unsetSession();
		$this->question_category_id->AdvancedSearch->unsetSession();
		$this->question_order->AdvancedSearch->unsetSession();
		$this->answer_id->AdvancedSearch->unsetSession();
		$this->answer_response->AdvancedSearch->unsetSession();
		$this->answer_score->AdvancedSearch->unsetSession();
		$this->assessment_id->AdvancedSearch->unsetSession();
		$this->answer_weight->AdvancedSearch->unsetSession();
		$this->answer_section_id->AdvancedSearch->unsetSession();
		$this->answer_recommendations->AdvancedSearch->unsetSession();
		$this->question_type_name->AdvancedSearch->unsetSession();
		$this->question_group_name->AdvancedSearch->unsetSession();
		$this->question_category_name->AdvancedSearch->unsetSession();
		$this->assessment_customer_id->AdvancedSearch->unsetSession();
		$this->assessment_customer_first_name->AdvancedSearch->unsetSession();
		$this->assessment_status->AdvancedSearch->unsetSession();
		$this->assessment_total_score->AdvancedSearch->unsetSession();
		$this->assessment_customer_last_name->AdvancedSearch->unsetSession();
		$this->assessment_user_id->AdvancedSearch->unsetSession();
		$this->assessment_user_first_name->AdvancedSearch->unsetSession();
		$this->assessment_user_last_name->AdvancedSearch->unsetSession();
		$this->assessment_user_email->AdvancedSearch->unsetSession();
		$this->assessment_personal_id->AdvancedSearch->unsetSession();
		$this->assessment_customer_age->AdvancedSearch->unsetSession();
		$this->assessment_sex->AdvancedSearch->unsetSession();
		$this->assessment_address->AdvancedSearch->unsetSession();
		$this->assessment_lat->AdvancedSearch->unsetSession();
		$this->assessment_lon->AdvancedSearch->unsetSession();
		$this->assessment_loan_purpose->AdvancedSearch->unsetSession();
		$this->assessment_loan_section->AdvancedSearch->unsetSession();
		$this->created_at->AdvancedSearch->unsetSession();
		$this->updated_at->AdvancedSearch->unsetSession();
		$this->loan_purpose_id->AdvancedSearch->unsetSession();
		$this->loan_sector_id->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->question_id->AdvancedSearch->load();
		$this->question_title->AdvancedSearch->load();
		$this->question_placeholder->AdvancedSearch->load();
		$this->question_questions->AdvancedSearch->load();
		$this->question_scores->AdvancedSearch->load();
		$this->question_active->AdvancedSearch->load();
		$this->question_section_id->AdvancedSearch->load();
		$this->question_type->AdvancedSearch->load();
		$this->question_has_recommendations->AdvancedSearch->load();
		$this->question_group_id->AdvancedSearch->load();
		$this->question_category_id->AdvancedSearch->load();
		$this->question_order->AdvancedSearch->load();
		$this->answer_id->AdvancedSearch->load();
		$this->answer_response->AdvancedSearch->load();
		$this->answer_score->AdvancedSearch->load();
		$this->assessment_id->AdvancedSearch->load();
		$this->answer_weight->AdvancedSearch->load();
		$this->answer_section_id->AdvancedSearch->load();
		$this->answer_recommendations->AdvancedSearch->load();
		$this->question_type_name->AdvancedSearch->load();
		$this->question_group_name->AdvancedSearch->load();
		$this->question_category_name->AdvancedSearch->load();
		$this->assessment_customer_id->AdvancedSearch->load();
		$this->assessment_customer_first_name->AdvancedSearch->load();
		$this->assessment_status->AdvancedSearch->load();
		$this->assessment_total_score->AdvancedSearch->load();
		$this->assessment_customer_last_name->AdvancedSearch->load();
		$this->assessment_user_id->AdvancedSearch->load();
		$this->assessment_user_first_name->AdvancedSearch->load();
		$this->assessment_user_last_name->AdvancedSearch->load();
		$this->assessment_user_email->AdvancedSearch->load();
		$this->assessment_personal_id->AdvancedSearch->load();
		$this->assessment_customer_age->AdvancedSearch->load();
		$this->assessment_sex->AdvancedSearch->load();
		$this->assessment_address->AdvancedSearch->load();
		$this->assessment_lat->AdvancedSearch->load();
		$this->assessment_lon->AdvancedSearch->load();
		$this->assessment_loan_purpose->AdvancedSearch->load();
		$this->assessment_loan_section->AdvancedSearch->load();
		$this->created_at->AdvancedSearch->load();
		$this->updated_at->AdvancedSearch->load();
		$this->loan_purpose_id->AdvancedSearch->load();
		$this->loan_sector_id->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->question_id); // question_id
			$this->updateSort($this->question_title); // question_title
			$this->updateSort($this->question_placeholder); // question_placeholder
			$this->updateSort($this->question_questions); // question_questions
			$this->updateSort($this->question_scores); // question_scores
			$this->updateSort($this->question_active); // question_active
			$this->updateSort($this->question_section_id); // question_section_id
			$this->updateSort($this->question_type); // question_type
			$this->updateSort($this->question_has_recommendations); // question_has_recommendations
			$this->updateSort($this->question_group_id); // question_group_id
			$this->updateSort($this->question_category_id); // question_category_id
			$this->updateSort($this->question_order); // question_order
			$this->updateSort($this->answer_id); // answer_id
			$this->updateSort($this->answer_response); // answer_response
			$this->updateSort($this->answer_score); // answer_score
			$this->updateSort($this->assessment_id); // assessment_id
			$this->updateSort($this->answer_weight); // answer_weight
			$this->updateSort($this->answer_section_id); // answer_section_id
			$this->updateSort($this->question_type_name); // question_type_name
			$this->updateSort($this->question_group_name); // question_group_name
			$this->updateSort($this->question_category_name); // question_category_name
			$this->updateSort($this->assessment_customer_id); // assessment_customer_id
			$this->updateSort($this->assessment_customer_first_name); // assessment_customer_first_name
			$this->updateSort($this->assessment_status); // assessment_status
			$this->updateSort($this->assessment_total_score); // assessment_total_score
			$this->updateSort($this->assessment_customer_last_name); // assessment_customer_last_name
			$this->updateSort($this->assessment_user_id); // assessment_user_id
			$this->updateSort($this->assessment_user_first_name); // assessment_user_first_name
			$this->updateSort($this->assessment_user_last_name); // assessment_user_last_name
			$this->updateSort($this->assessment_user_email); // assessment_user_email
			$this->updateSort($this->assessment_personal_id); // assessment_personal_id
			$this->updateSort($this->assessment_customer_age); // assessment_customer_age
			$this->updateSort($this->assessment_sex); // assessment_sex
			$this->updateSort($this->assessment_address); // assessment_address
			$this->updateSort($this->assessment_lat); // assessment_lat
			$this->updateSort($this->assessment_lon); // assessment_lon
			$this->updateSort($this->assessment_loan_purpose); // assessment_loan_purpose
			$this->updateSort($this->assessment_loan_section); // assessment_loan_section
			$this->updateSort($this->created_at); // created_at
			$this->updateSort($this->updated_at); // updated_at
			$this->updateSort($this->loan_purpose_id); // loan_purpose_id
			$this->updateSort($this->loan_sector_id); // loan_sector_id
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

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->question_id->setSort("");
				$this->question_title->setSort("");
				$this->question_placeholder->setSort("");
				$this->question_questions->setSort("");
				$this->question_scores->setSort("");
				$this->question_active->setSort("");
				$this->question_section_id->setSort("");
				$this->question_type->setSort("");
				$this->question_has_recommendations->setSort("");
				$this->question_group_id->setSort("");
				$this->question_category_id->setSort("");
				$this->question_order->setSort("");
				$this->answer_id->setSort("");
				$this->answer_response->setSort("");
				$this->answer_score->setSort("");
				$this->assessment_id->setSort("");
				$this->answer_weight->setSort("");
				$this->answer_section_id->setSort("");
				$this->question_type_name->setSort("");
				$this->question_group_name->setSort("");
				$this->question_category_name->setSort("");
				$this->assessment_customer_id->setSort("");
				$this->assessment_customer_first_name->setSort("");
				$this->assessment_status->setSort("");
				$this->assessment_total_score->setSort("");
				$this->assessment_customer_last_name->setSort("");
				$this->assessment_user_id->setSort("");
				$this->assessment_user_first_name->setSort("");
				$this->assessment_user_last_name->setSort("");
				$this->assessment_user_email->setSort("");
				$this->assessment_personal_id->setSort("");
				$this->assessment_customer_age->setSort("");
				$this->assessment_sex->setSort("");
				$this->assessment_address->setSort("");
				$this->assessment_lat->setSort("");
				$this->assessment_lon->setSort("");
				$this->assessment_loan_purpose->setSort("");
				$this->assessment_loan_section->setSort("");
				$this->created_at->setSort("");
				$this->updated_at->setSort("");
				$this->loan_purpose_id->setSort("");
				$this->loan_sector_id->setSort("");
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

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
		$item->moveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = TRUE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
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

		// Set up list action buttons
		$opt = $this->ListOptions["listactions"];
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = [];
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->question_id->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->answer_id->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->loan_purpose_id->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->loan_sector_id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Set up options default
		foreach ($options as $option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fquestions_answerslistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fquestions_answerslistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fquestions_answerslist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecords <= 0) {
				$option = $options["addedit"];
				$item = $option["gridedit"];
				if ($item)
					$item->Visible = FALSE;
				$option = $options["action"];
				$option->hideAllOptions();
			}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter != "" && $userAction != "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions[$userAction]->Caption;
				if (!$this->ListActions[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = "";
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage != "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() != "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() != "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{
	}

	// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;

		// question_id
		if (!$this->isAddOrEdit() && $this->question_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_id->AdvancedSearch->SearchValue != "" || $this->question_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// question_title
		if (!$this->isAddOrEdit() && $this->question_title->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_title->AdvancedSearch->SearchValue != "" || $this->question_title->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// question_placeholder
		if (!$this->isAddOrEdit() && $this->question_placeholder->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_placeholder->AdvancedSearch->SearchValue != "" || $this->question_placeholder->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// question_questions
		if (!$this->isAddOrEdit() && $this->question_questions->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_questions->AdvancedSearch->SearchValue != "" || $this->question_questions->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// question_scores
		if (!$this->isAddOrEdit() && $this->question_scores->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_scores->AdvancedSearch->SearchValue != "" || $this->question_scores->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// question_active
		if (!$this->isAddOrEdit() && $this->question_active->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_active->AdvancedSearch->SearchValue != "" || $this->question_active->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->question_active->AdvancedSearch->SearchValue))
			$this->question_active->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->question_active->AdvancedSearch->SearchValue);
		if (is_array($this->question_active->AdvancedSearch->SearchValue2))
			$this->question_active->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->question_active->AdvancedSearch->SearchValue2);

		// question_section_id
		if (!$this->isAddOrEdit() && $this->question_section_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_section_id->AdvancedSearch->SearchValue != "" || $this->question_section_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// question_type
		if (!$this->isAddOrEdit() && $this->question_type->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_type->AdvancedSearch->SearchValue != "" || $this->question_type->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// question_has_recommendations
		if (!$this->isAddOrEdit() && $this->question_has_recommendations->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_has_recommendations->AdvancedSearch->SearchValue != "" || $this->question_has_recommendations->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->question_has_recommendations->AdvancedSearch->SearchValue))
			$this->question_has_recommendations->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->question_has_recommendations->AdvancedSearch->SearchValue);
		if (is_array($this->question_has_recommendations->AdvancedSearch->SearchValue2))
			$this->question_has_recommendations->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->question_has_recommendations->AdvancedSearch->SearchValue2);

		// question_group_id
		if (!$this->isAddOrEdit() && $this->question_group_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_group_id->AdvancedSearch->SearchValue != "" || $this->question_group_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// question_category_id
		if (!$this->isAddOrEdit() && $this->question_category_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_category_id->AdvancedSearch->SearchValue != "" || $this->question_category_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// question_order
		if (!$this->isAddOrEdit() && $this->question_order->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_order->AdvancedSearch->SearchValue != "" || $this->question_order->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// answer_id
		if (!$this->isAddOrEdit() && $this->answer_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->answer_id->AdvancedSearch->SearchValue != "" || $this->answer_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// answer_response
		if (!$this->isAddOrEdit() && $this->answer_response->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->answer_response->AdvancedSearch->SearchValue != "" || $this->answer_response->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// answer_score
		if (!$this->isAddOrEdit() && $this->answer_score->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->answer_score->AdvancedSearch->SearchValue != "" || $this->answer_score->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_id
		if (!$this->isAddOrEdit() && $this->assessment_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_id->AdvancedSearch->SearchValue != "" || $this->assessment_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// answer_weight
		if (!$this->isAddOrEdit() && $this->answer_weight->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->answer_weight->AdvancedSearch->SearchValue != "" || $this->answer_weight->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// answer_section_id
		if (!$this->isAddOrEdit() && $this->answer_section_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->answer_section_id->AdvancedSearch->SearchValue != "" || $this->answer_section_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// answer_recommendations
		if (!$this->isAddOrEdit() && $this->answer_recommendations->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->answer_recommendations->AdvancedSearch->SearchValue != "" || $this->answer_recommendations->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// question_type_name
		if (!$this->isAddOrEdit() && $this->question_type_name->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_type_name->AdvancedSearch->SearchValue != "" || $this->question_type_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// question_group_name
		if (!$this->isAddOrEdit() && $this->question_group_name->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_group_name->AdvancedSearch->SearchValue != "" || $this->question_group_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// question_category_name
		if (!$this->isAddOrEdit() && $this->question_category_name->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->question_category_name->AdvancedSearch->SearchValue != "" || $this->question_category_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_customer_id
		if (!$this->isAddOrEdit() && $this->assessment_customer_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_customer_id->AdvancedSearch->SearchValue != "" || $this->assessment_customer_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_customer_first_name
		if (!$this->isAddOrEdit() && $this->assessment_customer_first_name->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_customer_first_name->AdvancedSearch->SearchValue != "" || $this->assessment_customer_first_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_status
		if (!$this->isAddOrEdit() && $this->assessment_status->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_status->AdvancedSearch->SearchValue != "" || $this->assessment_status->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_total_score
		if (!$this->isAddOrEdit() && $this->assessment_total_score->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_total_score->AdvancedSearch->SearchValue != "" || $this->assessment_total_score->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_customer_last_name
		if (!$this->isAddOrEdit() && $this->assessment_customer_last_name->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_customer_last_name->AdvancedSearch->SearchValue != "" || $this->assessment_customer_last_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_user_id
		if (!$this->isAddOrEdit() && $this->assessment_user_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_user_id->AdvancedSearch->SearchValue != "" || $this->assessment_user_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_user_first_name
		if (!$this->isAddOrEdit() && $this->assessment_user_first_name->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_user_first_name->AdvancedSearch->SearchValue != "" || $this->assessment_user_first_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_user_last_name
		if (!$this->isAddOrEdit() && $this->assessment_user_last_name->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_user_last_name->AdvancedSearch->SearchValue != "" || $this->assessment_user_last_name->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_user_email
		if (!$this->isAddOrEdit() && $this->assessment_user_email->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_user_email->AdvancedSearch->SearchValue != "" || $this->assessment_user_email->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_personal_id
		if (!$this->isAddOrEdit() && $this->assessment_personal_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_personal_id->AdvancedSearch->SearchValue != "" || $this->assessment_personal_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_customer_age
		if (!$this->isAddOrEdit() && $this->assessment_customer_age->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_customer_age->AdvancedSearch->SearchValue != "" || $this->assessment_customer_age->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_sex
		if (!$this->isAddOrEdit() && $this->assessment_sex->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_sex->AdvancedSearch->SearchValue != "" || $this->assessment_sex->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_address
		if (!$this->isAddOrEdit() && $this->assessment_address->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_address->AdvancedSearch->SearchValue != "" || $this->assessment_address->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_lat
		if (!$this->isAddOrEdit() && $this->assessment_lat->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_lat->AdvancedSearch->SearchValue != "" || $this->assessment_lat->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_lon
		if (!$this->isAddOrEdit() && $this->assessment_lon->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_lon->AdvancedSearch->SearchValue != "" || $this->assessment_lon->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_loan_purpose
		if (!$this->isAddOrEdit() && $this->assessment_loan_purpose->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_loan_purpose->AdvancedSearch->SearchValue != "" || $this->assessment_loan_purpose->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// assessment_loan_section
		if (!$this->isAddOrEdit() && $this->assessment_loan_section->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->assessment_loan_section->AdvancedSearch->SearchValue != "" || $this->assessment_loan_section->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// created_at
		if (!$this->isAddOrEdit() && $this->created_at->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->created_at->AdvancedSearch->SearchValue != "" || $this->created_at->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// updated_at
		if (!$this->isAddOrEdit() && $this->updated_at->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->updated_at->AdvancedSearch->SearchValue != "" || $this->updated_at->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// loan_purpose_id
		if (!$this->isAddOrEdit() && $this->loan_purpose_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->loan_purpose_id->AdvancedSearch->SearchValue != "" || $this->loan_purpose_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// loan_sector_id
		if (!$this->isAddOrEdit() && $this->loan_sector_id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->loan_sector_id->AdvancedSearch->SearchValue != "" || $this->loan_sector_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
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
		$this->question_id->setDbValue($row['question_id']);
		$this->question_title->setDbValue($row['question_title']);
		$this->question_placeholder->setDbValue($row['question_placeholder']);
		$this->question_questions->setDbValue($row['question_questions']);
		$this->question_scores->setDbValue($row['question_scores']);
		$this->question_active->setDbValue($row['question_active']);
		$this->question_section_id->setDbValue($row['question_section_id']);
		$this->question_type->setDbValue($row['question_type']);
		$this->question_has_recommendations->setDbValue($row['question_has_recommendations']);
		$this->question_group_id->setDbValue($row['question_group_id']);
		$this->question_category_id->setDbValue($row['question_category_id']);
		$this->question_order->setDbValue($row['question_order']);
		$this->answer_id->setDbValue($row['answer_id']);
		$this->answer_response->setDbValue($row['answer_response']);
		$this->answer_score->setDbValue($row['answer_score']);
		$this->assessment_id->setDbValue($row['assessment_id']);
		$this->answer_weight->setDbValue($row['answer_weight']);
		$this->answer_section_id->setDbValue($row['answer_section_id']);
		$this->answer_recommendations->setDbValue($row['answer_recommendations']);
		$this->question_type_name->setDbValue($row['question_type_name']);
		$this->question_group_name->setDbValue($row['question_group_name']);
		$this->question_category_name->setDbValue($row['question_category_name']);
		$this->assessment_customer_id->setDbValue($row['assessment_customer_id']);
		$this->assessment_customer_first_name->setDbValue($row['assessment_customer_first_name']);
		$this->assessment_status->setDbValue($row['assessment_status']);
		$this->assessment_total_score->setDbValue($row['assessment_total_score']);
		$this->assessment_customer_last_name->setDbValue($row['assessment_customer_last_name']);
		$this->assessment_user_id->setDbValue($row['assessment_user_id']);
		$this->assessment_user_first_name->setDbValue($row['assessment_user_first_name']);
		$this->assessment_user_last_name->setDbValue($row['assessment_user_last_name']);
		$this->assessment_user_email->setDbValue($row['assessment_user_email']);
		$this->assessment_personal_id->setDbValue($row['assessment_personal_id']);
		$this->assessment_customer_age->setDbValue($row['assessment_customer_age']);
		$this->assessment_sex->setDbValue($row['assessment_sex']);
		$this->assessment_address->setDbValue($row['assessment_address']);
		$this->assessment_lat->setDbValue($row['assessment_lat']);
		$this->assessment_lon->setDbValue($row['assessment_lon']);
		$this->assessment_loan_purpose->setDbValue($row['assessment_loan_purpose']);
		$this->assessment_loan_section->setDbValue($row['assessment_loan_section']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->loan_purpose_id->setDbValue($row['loan_purpose_id']);
		$this->loan_sector_id->setDbValue($row['loan_sector_id']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['question_id'] = NULL;
		$row['question_title'] = NULL;
		$row['question_placeholder'] = NULL;
		$row['question_questions'] = NULL;
		$row['question_scores'] = NULL;
		$row['question_active'] = NULL;
		$row['question_section_id'] = NULL;
		$row['question_type'] = NULL;
		$row['question_has_recommendations'] = NULL;
		$row['question_group_id'] = NULL;
		$row['question_category_id'] = NULL;
		$row['question_order'] = NULL;
		$row['answer_id'] = NULL;
		$row['answer_response'] = NULL;
		$row['answer_score'] = NULL;
		$row['assessment_id'] = NULL;
		$row['answer_weight'] = NULL;
		$row['answer_section_id'] = NULL;
		$row['answer_recommendations'] = NULL;
		$row['question_type_name'] = NULL;
		$row['question_group_name'] = NULL;
		$row['question_category_name'] = NULL;
		$row['assessment_customer_id'] = NULL;
		$row['assessment_customer_first_name'] = NULL;
		$row['assessment_status'] = NULL;
		$row['assessment_total_score'] = NULL;
		$row['assessment_customer_last_name'] = NULL;
		$row['assessment_user_id'] = NULL;
		$row['assessment_user_first_name'] = NULL;
		$row['assessment_user_last_name'] = NULL;
		$row['assessment_user_email'] = NULL;
		$row['assessment_personal_id'] = NULL;
		$row['assessment_customer_age'] = NULL;
		$row['assessment_sex'] = NULL;
		$row['assessment_address'] = NULL;
		$row['assessment_lat'] = NULL;
		$row['assessment_lon'] = NULL;
		$row['assessment_loan_purpose'] = NULL;
		$row['assessment_loan_section'] = NULL;
		$row['created_at'] = NULL;
		$row['updated_at'] = NULL;
		$row['loan_purpose_id'] = NULL;
		$row['loan_sector_id'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("question_id")) != "")
			$this->question_id->OldValue = $this->getKey("question_id"); // question_id
		else
			$validKey = FALSE;
		if (strval($this->getKey("answer_id")) != "")
			$this->answer_id->OldValue = $this->getKey("answer_id"); // answer_id
		else
			$validKey = FALSE;
		if (strval($this->getKey("loan_purpose_id")) != "")
			$this->loan_purpose_id->OldValue = $this->getKey("loan_purpose_id"); // loan_purpose_id
		else
			$validKey = FALSE;
		if (strval($this->getKey("loan_sector_id")) != "")
			$this->loan_sector_id->OldValue = $this->getKey("loan_sector_id"); // loan_sector_id
		else
			$validKey = FALSE;

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
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Convert decimal values if posted back
		if ($this->answer_score->FormValue == $this->answer_score->CurrentValue && is_numeric(ConvertToFloatString($this->answer_score->CurrentValue)))
			$this->answer_score->CurrentValue = ConvertToFloatString($this->answer_score->CurrentValue);

		// Convert decimal values if posted back
		if ($this->answer_weight->FormValue == $this->answer_weight->CurrentValue && is_numeric(ConvertToFloatString($this->answer_weight->CurrentValue)))
			$this->answer_weight->CurrentValue = ConvertToFloatString($this->answer_weight->CurrentValue);

		// Convert decimal values if posted back
		if ($this->assessment_total_score->FormValue == $this->assessment_total_score->CurrentValue && is_numeric(ConvertToFloatString($this->assessment_total_score->CurrentValue)))
			$this->assessment_total_score->CurrentValue = ConvertToFloatString($this->assessment_total_score->CurrentValue);

		// Convert decimal values if posted back
		if ($this->assessment_lat->FormValue == $this->assessment_lat->CurrentValue && is_numeric(ConvertToFloatString($this->assessment_lat->CurrentValue)))
			$this->assessment_lat->CurrentValue = ConvertToFloatString($this->assessment_lat->CurrentValue);

		// Convert decimal values if posted back
		if ($this->assessment_lon->FormValue == $this->assessment_lon->CurrentValue && is_numeric(ConvertToFloatString($this->assessment_lon->CurrentValue)))
			$this->assessment_lon->CurrentValue = ConvertToFloatString($this->assessment_lon->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// question_id
		// question_title
		// question_placeholder
		// question_questions
		// question_scores
		// question_active
		// question_section_id
		// question_type
		// question_has_recommendations
		// question_group_id
		// question_category_id
		// question_order
		// answer_id
		// answer_response
		// answer_score
		// assessment_id
		// answer_weight
		// answer_section_id
		// answer_recommendations
		// question_type_name
		// question_group_name
		// question_category_name
		// assessment_customer_id
		// assessment_customer_first_name
		// assessment_status
		// assessment_total_score
		// assessment_customer_last_name
		// assessment_user_id
		// assessment_user_first_name
		// assessment_user_last_name
		// assessment_user_email
		// assessment_personal_id
		// assessment_customer_age
		// assessment_sex
		// assessment_address
		// assessment_lat
		// assessment_lon
		// assessment_loan_purpose
		// assessment_loan_section
		// created_at
		// updated_at
		// loan_purpose_id
		// loan_sector_id

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// question_id
			$this->question_id->ViewValue = $this->question_id->CurrentValue;
			$this->question_id->ViewValue = FormatNumber($this->question_id->ViewValue, 0, -2, -2, -2);
			$this->question_id->ViewCustomAttributes = "";

			// question_title
			$this->question_title->ViewValue = $this->question_title->CurrentValue;
			$this->question_title->ViewCustomAttributes = "";

			// question_placeholder
			$this->question_placeholder->ViewValue = $this->question_placeholder->CurrentValue;
			$this->question_placeholder->ViewCustomAttributes = "";

			// question_questions
			$this->question_questions->ViewValue = $this->question_questions->CurrentValue;
			$this->question_questions->ViewCustomAttributes = "";

			// question_scores
			$this->question_scores->ViewValue = $this->question_scores->CurrentValue;
			$this->question_scores->ViewCustomAttributes = "";

			// question_active
			if (ConvertToBool($this->question_active->CurrentValue)) {
				$this->question_active->ViewValue = $this->question_active->tagCaption(1) != "" ? $this->question_active->tagCaption(1) : "Yes";
			} else {
				$this->question_active->ViewValue = $this->question_active->tagCaption(2) != "" ? $this->question_active->tagCaption(2) : "No";
			}
			$this->question_active->ViewCustomAttributes = "";

			// question_section_id
			$this->question_section_id->ViewValue = $this->question_section_id->CurrentValue;
			$curVal = strval($this->question_section_id->CurrentValue);
			if ($curVal != "") {
				$this->question_section_id->ViewValue = $this->question_section_id->lookupCacheOption($curVal);
				if ($this->question_section_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->question_section_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
						$arwrk[2] = $rswrk->fields('df2');
						$this->question_section_id->ViewValue = $this->question_section_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->question_section_id->ViewValue = $this->question_section_id->CurrentValue;
					}
				}
			} else {
				$this->question_section_id->ViewValue = NULL;
			}
			$this->question_section_id->ViewCustomAttributes = "";

			// question_type
			$curVal = strval($this->question_type->CurrentValue);
			if ($curVal != "") {
				$this->question_type->ViewValue = $this->question_type->lookupCacheOption($curVal);
				if ($this->question_type->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->question_type->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->question_type->ViewValue = $this->question_type->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->question_type->ViewValue = $this->question_type->CurrentValue;
					}
				}
			} else {
				$this->question_type->ViewValue = NULL;
			}
			$this->question_type->ViewCustomAttributes = "";

			// question_has_recommendations
			if (strval($this->question_has_recommendations->CurrentValue) != "") {
				$this->question_has_recommendations->ViewValue = new OptionValues();
				$arwrk = explode(",", strval($this->question_has_recommendations->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->question_has_recommendations->ViewValue->add($this->question_has_recommendations->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->question_has_recommendations->ViewValue = NULL;
			}
			$this->question_has_recommendations->ViewCustomAttributes = "";

			// question_group_id
			$curVal = strval($this->question_group_id->CurrentValue);
			if ($curVal != "") {
				$this->question_group_id->ViewValue = $this->question_group_id->lookupCacheOption($curVal);
				if ($this->question_group_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->question_group_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->question_group_id->ViewValue = $this->question_group_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->question_group_id->ViewValue = $this->question_group_id->CurrentValue;
					}
				}
			} else {
				$this->question_group_id->ViewValue = NULL;
			}
			$this->question_group_id->ViewCustomAttributes = "";

			// question_category_id
			$curVal = strval($this->question_category_id->CurrentValue);
			if ($curVal != "") {
				$this->question_category_id->ViewValue = $this->question_category_id->lookupCacheOption($curVal);
				if ($this->question_category_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->question_category_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->question_category_id->ViewValue = $this->question_category_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->question_category_id->ViewValue = $this->question_category_id->CurrentValue;
					}
				}
			} else {
				$this->question_category_id->ViewValue = NULL;
			}
			$this->question_category_id->ViewCustomAttributes = "";

			// question_order
			$this->question_order->ViewValue = $this->question_order->CurrentValue;
			$this->question_order->ViewValue = FormatNumber($this->question_order->ViewValue, 0, -2, -2, -2);
			$this->question_order->ViewCustomAttributes = "";

			// answer_id
			$this->answer_id->ViewValue = $this->answer_id->CurrentValue;
			$this->answer_id->ViewValue = FormatNumber($this->answer_id->ViewValue, 0, -2, -2, -2);
			$this->answer_id->ViewCustomAttributes = "";

			// answer_response
			$this->answer_response->ViewValue = $this->answer_response->CurrentValue;
			$this->answer_response->ViewCustomAttributes = "";

			// answer_score
			$this->answer_score->ViewValue = $this->answer_score->CurrentValue;
			$this->answer_score->ViewValue = FormatNumber($this->answer_score->ViewValue, 2, -2, -2, -2);
			$this->answer_score->ViewCustomAttributes = "";

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

			// answer_weight
			$this->answer_weight->ViewValue = $this->answer_weight->CurrentValue;
			$this->answer_weight->ViewValue = FormatNumber($this->answer_weight->ViewValue, 2, -2, -2, -2);
			$this->answer_weight->ViewCustomAttributes = "";

			// answer_section_id
			$this->answer_section_id->ViewValue = $this->answer_section_id->CurrentValue;
			$this->answer_section_id->ViewValue = FormatNumber($this->answer_section_id->ViewValue, 0, -2, -2, -2);
			$this->answer_section_id->ViewCustomAttributes = "";

			// question_type_name
			$this->question_type_name->ViewValue = $this->question_type_name->CurrentValue;
			$this->question_type_name->ViewCustomAttributes = "";

			// question_group_name
			$this->question_group_name->ViewValue = $this->question_group_name->CurrentValue;
			$this->question_group_name->ViewCustomAttributes = "";

			// question_category_name
			$this->question_category_name->ViewValue = $this->question_category_name->CurrentValue;
			$this->question_category_name->ViewCustomAttributes = "";

			// assessment_customer_id
			$this->assessment_customer_id->ViewValue = $this->assessment_customer_id->CurrentValue;
			$this->assessment_customer_id->ViewCustomAttributes = "";

			// assessment_customer_first_name
			$this->assessment_customer_first_name->ViewValue = $this->assessment_customer_first_name->CurrentValue;
			$this->assessment_customer_first_name->ViewCustomAttributes = "";

			// assessment_status
			$this->assessment_status->ViewValue = $this->assessment_status->CurrentValue;
			$this->assessment_status->ViewValue = FormatNumber($this->assessment_status->ViewValue, 0, -2, -2, -2);
			$this->assessment_status->ViewCustomAttributes = "";

			// assessment_total_score
			$this->assessment_total_score->ViewValue = $this->assessment_total_score->CurrentValue;
			$this->assessment_total_score->ViewValue = FormatNumber($this->assessment_total_score->ViewValue, 2, -2, -2, -2);
			$this->assessment_total_score->ViewCustomAttributes = "";

			// assessment_customer_last_name
			$this->assessment_customer_last_name->ViewValue = $this->assessment_customer_last_name->CurrentValue;
			$this->assessment_customer_last_name->ViewCustomAttributes = "";

			// assessment_user_id
			$this->assessment_user_id->ViewValue = $this->assessment_user_id->CurrentValue;
			$this->assessment_user_id->ViewValue = FormatNumber($this->assessment_user_id->ViewValue, 0, -2, -2, -2);
			$this->assessment_user_id->ViewCustomAttributes = "";

			// assessment_user_first_name
			$this->assessment_user_first_name->ViewValue = $this->assessment_user_first_name->CurrentValue;
			$this->assessment_user_first_name->ViewCustomAttributes = "";

			// assessment_user_last_name
			$this->assessment_user_last_name->ViewValue = $this->assessment_user_last_name->CurrentValue;
			$this->assessment_user_last_name->ViewCustomAttributes = "";

			// assessment_user_email
			$this->assessment_user_email->ViewValue = $this->assessment_user_email->CurrentValue;
			$this->assessment_user_email->ViewCustomAttributes = "";

			// assessment_personal_id
			$this->assessment_personal_id->ViewValue = $this->assessment_personal_id->CurrentValue;
			$this->assessment_personal_id->ViewCustomAttributes = "";

			// assessment_customer_age
			$this->assessment_customer_age->ViewValue = $this->assessment_customer_age->CurrentValue;
			$this->assessment_customer_age->ViewValue = FormatNumber($this->assessment_customer_age->ViewValue, 0, -2, -2, -2);
			$this->assessment_customer_age->ViewCustomAttributes = "";

			// assessment_sex
			$this->assessment_sex->ViewValue = $this->assessment_sex->CurrentValue;
			$this->assessment_sex->ViewCustomAttributes = "";

			// assessment_address
			$this->assessment_address->ViewValue = $this->assessment_address->CurrentValue;
			$this->assessment_address->ViewCustomAttributes = "";

			// assessment_lat
			$this->assessment_lat->ViewValue = $this->assessment_lat->CurrentValue;
			$this->assessment_lat->ViewValue = FormatNumber($this->assessment_lat->ViewValue, 2, -2, -2, -2);
			$this->assessment_lat->ViewCustomAttributes = "";

			// assessment_lon
			$this->assessment_lon->ViewValue = $this->assessment_lon->CurrentValue;
			$this->assessment_lon->ViewValue = FormatNumber($this->assessment_lon->ViewValue, 2, -2, -2, -2);
			$this->assessment_lon->ViewCustomAttributes = "";

			// assessment_loan_purpose
			$this->assessment_loan_purpose->ViewValue = $this->assessment_loan_purpose->CurrentValue;
			$this->assessment_loan_purpose->ViewCustomAttributes = "";

			// assessment_loan_section
			$this->assessment_loan_section->ViewValue = $this->assessment_loan_section->CurrentValue;
			$this->assessment_loan_section->ViewCustomAttributes = "";

			// created_at
			$this->created_at->ViewValue = $this->created_at->CurrentValue;
			$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
			$this->created_at->ViewCustomAttributes = "";

			// updated_at
			$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
			$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
			$this->updated_at->ViewCustomAttributes = "";

			// loan_purpose_id
			$this->loan_purpose_id->ViewValue = $this->loan_purpose_id->CurrentValue;
			$this->loan_purpose_id->ViewCustomAttributes = "";

			// loan_sector_id
			$this->loan_sector_id->ViewValue = $this->loan_sector_id->CurrentValue;
			$this->loan_sector_id->ViewCustomAttributes = "";

			// question_id
			$this->question_id->LinkCustomAttributes = "";
			$this->question_id->HrefValue = "";
			$this->question_id->TooltipValue = "";

			// question_title
			$this->question_title->LinkCustomAttributes = "";
			$this->question_title->HrefValue = "";
			$this->question_title->TooltipValue = "";

			// question_placeholder
			$this->question_placeholder->LinkCustomAttributes = "";
			$this->question_placeholder->HrefValue = "";
			$this->question_placeholder->TooltipValue = "";

			// question_questions
			$this->question_questions->LinkCustomAttributes = "";
			$this->question_questions->HrefValue = "";
			$this->question_questions->TooltipValue = "";

			// question_scores
			$this->question_scores->LinkCustomAttributes = "";
			$this->question_scores->HrefValue = "";
			$this->question_scores->TooltipValue = "";

			// question_active
			$this->question_active->LinkCustomAttributes = "";
			$this->question_active->HrefValue = "";
			$this->question_active->TooltipValue = "";

			// question_section_id
			$this->question_section_id->LinkCustomAttributes = "";
			$this->question_section_id->HrefValue = "";
			$this->question_section_id->TooltipValue = "";

			// question_type
			$this->question_type->LinkCustomAttributes = "";
			$this->question_type->HrefValue = "";
			$this->question_type->TooltipValue = "";

			// question_has_recommendations
			$this->question_has_recommendations->LinkCustomAttributes = "";
			$this->question_has_recommendations->HrefValue = "";
			$this->question_has_recommendations->TooltipValue = "";

			// question_group_id
			$this->question_group_id->LinkCustomAttributes = "";
			$this->question_group_id->HrefValue = "";
			$this->question_group_id->TooltipValue = "";

			// question_category_id
			$this->question_category_id->LinkCustomAttributes = "";
			$this->question_category_id->HrefValue = "";
			$this->question_category_id->TooltipValue = "";

			// question_order
			$this->question_order->LinkCustomAttributes = "";
			$this->question_order->HrefValue = "";
			$this->question_order->TooltipValue = "";

			// answer_id
			$this->answer_id->LinkCustomAttributes = "";
			$this->answer_id->HrefValue = "";
			$this->answer_id->TooltipValue = "";

			// answer_response
			$this->answer_response->LinkCustomAttributes = "";
			$this->answer_response->HrefValue = "";
			$this->answer_response->TooltipValue = "";

			// answer_score
			$this->answer_score->LinkCustomAttributes = "";
			$this->answer_score->HrefValue = "";
			$this->answer_score->TooltipValue = "";

			// assessment_id
			$this->assessment_id->LinkCustomAttributes = "";
			$this->assessment_id->HrefValue = "";
			$this->assessment_id->TooltipValue = "";

			// answer_weight
			$this->answer_weight->LinkCustomAttributes = "";
			$this->answer_weight->HrefValue = "";
			$this->answer_weight->TooltipValue = "";

			// answer_section_id
			$this->answer_section_id->LinkCustomAttributes = "";
			$this->answer_section_id->HrefValue = "";
			$this->answer_section_id->TooltipValue = "";

			// question_type_name
			$this->question_type_name->LinkCustomAttributes = "";
			$this->question_type_name->HrefValue = "";
			$this->question_type_name->TooltipValue = "";

			// question_group_name
			$this->question_group_name->LinkCustomAttributes = "";
			$this->question_group_name->HrefValue = "";
			$this->question_group_name->TooltipValue = "";

			// question_category_name
			$this->question_category_name->LinkCustomAttributes = "";
			$this->question_category_name->HrefValue = "";
			$this->question_category_name->TooltipValue = "";

			// assessment_customer_id
			$this->assessment_customer_id->LinkCustomAttributes = "";
			$this->assessment_customer_id->HrefValue = "";
			$this->assessment_customer_id->TooltipValue = "";

			// assessment_customer_first_name
			$this->assessment_customer_first_name->LinkCustomAttributes = "";
			$this->assessment_customer_first_name->HrefValue = "";
			$this->assessment_customer_first_name->TooltipValue = "";

			// assessment_status
			$this->assessment_status->LinkCustomAttributes = "";
			$this->assessment_status->HrefValue = "";
			$this->assessment_status->TooltipValue = "";

			// assessment_total_score
			$this->assessment_total_score->LinkCustomAttributes = "";
			$this->assessment_total_score->HrefValue = "";
			$this->assessment_total_score->TooltipValue = "";

			// assessment_customer_last_name
			$this->assessment_customer_last_name->LinkCustomAttributes = "";
			$this->assessment_customer_last_name->HrefValue = "";
			$this->assessment_customer_last_name->TooltipValue = "";

			// assessment_user_id
			$this->assessment_user_id->LinkCustomAttributes = "";
			$this->assessment_user_id->HrefValue = "";
			$this->assessment_user_id->TooltipValue = "";

			// assessment_user_first_name
			$this->assessment_user_first_name->LinkCustomAttributes = "";
			$this->assessment_user_first_name->HrefValue = "";
			$this->assessment_user_first_name->TooltipValue = "";

			// assessment_user_last_name
			$this->assessment_user_last_name->LinkCustomAttributes = "";
			$this->assessment_user_last_name->HrefValue = "";
			$this->assessment_user_last_name->TooltipValue = "";

			// assessment_user_email
			$this->assessment_user_email->LinkCustomAttributes = "";
			$this->assessment_user_email->HrefValue = "";
			$this->assessment_user_email->TooltipValue = "";

			// assessment_personal_id
			$this->assessment_personal_id->LinkCustomAttributes = "";
			$this->assessment_personal_id->HrefValue = "";
			$this->assessment_personal_id->TooltipValue = "";

			// assessment_customer_age
			$this->assessment_customer_age->LinkCustomAttributes = "";
			$this->assessment_customer_age->HrefValue = "";
			$this->assessment_customer_age->TooltipValue = "";

			// assessment_sex
			$this->assessment_sex->LinkCustomAttributes = "";
			$this->assessment_sex->HrefValue = "";
			$this->assessment_sex->TooltipValue = "";

			// assessment_address
			$this->assessment_address->LinkCustomAttributes = "";
			$this->assessment_address->HrefValue = "";
			$this->assessment_address->TooltipValue = "";

			// assessment_lat
			$this->assessment_lat->LinkCustomAttributes = "";
			$this->assessment_lat->HrefValue = "";
			$this->assessment_lat->TooltipValue = "";

			// assessment_lon
			$this->assessment_lon->LinkCustomAttributes = "";
			$this->assessment_lon->HrefValue = "";
			$this->assessment_lon->TooltipValue = "";

			// assessment_loan_purpose
			$this->assessment_loan_purpose->LinkCustomAttributes = "";
			$this->assessment_loan_purpose->HrefValue = "";
			$this->assessment_loan_purpose->TooltipValue = "";

			// assessment_loan_section
			$this->assessment_loan_section->LinkCustomAttributes = "";
			$this->assessment_loan_section->HrefValue = "";
			$this->assessment_loan_section->TooltipValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
			$this->updated_at->TooltipValue = "";

			// loan_purpose_id
			$this->loan_purpose_id->LinkCustomAttributes = "";
			$this->loan_purpose_id->HrefValue = "";
			$this->loan_purpose_id->TooltipValue = "";

			// loan_sector_id
			$this->loan_sector_id->LinkCustomAttributes = "";
			$this->loan_sector_id->HrefValue = "";
			$this->loan_sector_id->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// question_id
			$this->question_id->EditAttrs["class"] = "form-control";
			$this->question_id->EditCustomAttributes = "";
			$this->question_id->EditValue = HtmlEncode($this->question_id->AdvancedSearch->SearchValue);
			$this->question_id->PlaceHolder = RemoveHtml($this->question_id->caption());

			// question_title
			$this->question_title->EditAttrs["class"] = "form-control";
			$this->question_title->EditCustomAttributes = "";
			if (!$this->question_title->Raw)
				$this->question_title->AdvancedSearch->SearchValue = HtmlDecode($this->question_title->AdvancedSearch->SearchValue);
			$this->question_title->EditValue = HtmlEncode($this->question_title->AdvancedSearch->SearchValue);
			$this->question_title->PlaceHolder = RemoveHtml($this->question_title->caption());

			// question_placeholder
			$this->question_placeholder->EditAttrs["class"] = "form-control";
			$this->question_placeholder->EditCustomAttributes = "";
			$this->question_placeholder->EditValue = HtmlEncode($this->question_placeholder->AdvancedSearch->SearchValue);
			$this->question_placeholder->PlaceHolder = RemoveHtml($this->question_placeholder->caption());

			// question_questions
			$this->question_questions->EditAttrs["class"] = "form-control";
			$this->question_questions->EditCustomAttributes = "";
			$this->question_questions->EditValue = HtmlEncode($this->question_questions->AdvancedSearch->SearchValue);
			$this->question_questions->PlaceHolder = RemoveHtml($this->question_questions->caption());

			// question_scores
			$this->question_scores->EditAttrs["class"] = "form-control";
			$this->question_scores->EditCustomAttributes = "";
			if (!$this->question_scores->Raw)
				$this->question_scores->AdvancedSearch->SearchValue = HtmlDecode($this->question_scores->AdvancedSearch->SearchValue);
			$this->question_scores->EditValue = HtmlEncode($this->question_scores->AdvancedSearch->SearchValue);
			$this->question_scores->PlaceHolder = RemoveHtml($this->question_scores->caption());

			// question_active
			$this->question_active->EditCustomAttributes = "";
			$this->question_active->EditValue = $this->question_active->options(FALSE);

			// question_section_id
			$this->question_section_id->EditAttrs["class"] = "form-control";
			$this->question_section_id->EditCustomAttributes = "";
			$this->question_section_id->EditValue = HtmlEncode($this->question_section_id->AdvancedSearch->SearchValue);
			$curVal = strval($this->question_section_id->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->question_section_id->EditValue = $this->question_section_id->lookupCacheOption($curVal);
				if ($this->question_section_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->question_section_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode(FormatNumber($rswrk->fields('df'), 0, -2, -2, -2));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->question_section_id->EditValue = $this->question_section_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->question_section_id->EditValue = HtmlEncode($this->question_section_id->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->question_section_id->EditValue = NULL;
			}
			$this->question_section_id->PlaceHolder = RemoveHtml($this->question_section_id->caption());

			// question_type
			$this->question_type->EditCustomAttributes = "";

			// question_has_recommendations
			$this->question_has_recommendations->EditCustomAttributes = "";
			$this->question_has_recommendations->EditValue = $this->question_has_recommendations->options(FALSE);

			// question_group_id
			$this->question_group_id->EditAttrs["class"] = "form-control";
			$this->question_group_id->EditCustomAttributes = "";

			// question_category_id
			$this->question_category_id->EditAttrs["class"] = "form-control";
			$this->question_category_id->EditCustomAttributes = "";

			// question_order
			$this->question_order->EditAttrs["class"] = "form-control";
			$this->question_order->EditCustomAttributes = "";
			$this->question_order->EditValue = HtmlEncode($this->question_order->AdvancedSearch->SearchValue);
			$this->question_order->PlaceHolder = RemoveHtml($this->question_order->caption());

			// answer_id
			$this->answer_id->EditAttrs["class"] = "form-control";
			$this->answer_id->EditCustomAttributes = "";
			$this->answer_id->EditValue = HtmlEncode($this->answer_id->AdvancedSearch->SearchValue);
			$this->answer_id->PlaceHolder = RemoveHtml($this->answer_id->caption());

			// answer_response
			$this->answer_response->EditAttrs["class"] = "form-control";
			$this->answer_response->EditCustomAttributes = "";
			if (!$this->answer_response->Raw)
				$this->answer_response->AdvancedSearch->SearchValue = HtmlDecode($this->answer_response->AdvancedSearch->SearchValue);
			$this->answer_response->EditValue = HtmlEncode($this->answer_response->AdvancedSearch->SearchValue);
			$this->answer_response->PlaceHolder = RemoveHtml($this->answer_response->caption());

			// answer_score
			$this->answer_score->EditAttrs["class"] = "form-control";
			$this->answer_score->EditCustomAttributes = "";
			$this->answer_score->EditValue = HtmlEncode($this->answer_score->AdvancedSearch->SearchValue);
			$this->answer_score->PlaceHolder = RemoveHtml($this->answer_score->caption());

			// assessment_id
			$this->assessment_id->EditAttrs["class"] = "form-control";
			$this->assessment_id->EditCustomAttributes = "";
			$this->assessment_id->EditValue = HtmlEncode($this->assessment_id->AdvancedSearch->SearchValue);
			$curVal = strval($this->assessment_id->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->assessment_id->EditValue = $this->assessment_id->lookupCacheOption($curVal);
				if ($this->assessment_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->assessment_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode(FormatNumber($rswrk->fields('df'), 0, -2, -2, -2));
						$this->assessment_id->EditValue = $this->assessment_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->assessment_id->EditValue = HtmlEncode($this->assessment_id->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->assessment_id->EditValue = NULL;
			}
			$this->assessment_id->PlaceHolder = RemoveHtml($this->assessment_id->caption());

			// answer_weight
			$this->answer_weight->EditAttrs["class"] = "form-control";
			$this->answer_weight->EditCustomAttributes = "";
			$this->answer_weight->EditValue = HtmlEncode($this->answer_weight->AdvancedSearch->SearchValue);
			$this->answer_weight->PlaceHolder = RemoveHtml($this->answer_weight->caption());

			// answer_section_id
			$this->answer_section_id->EditAttrs["class"] = "form-control";
			$this->answer_section_id->EditCustomAttributes = "";
			$this->answer_section_id->EditValue = HtmlEncode($this->answer_section_id->AdvancedSearch->SearchValue);
			$this->answer_section_id->PlaceHolder = RemoveHtml($this->answer_section_id->caption());

			// question_type_name
			$this->question_type_name->EditAttrs["class"] = "form-control";
			$this->question_type_name->EditCustomAttributes = "";
			if (!$this->question_type_name->Raw)
				$this->question_type_name->AdvancedSearch->SearchValue = HtmlDecode($this->question_type_name->AdvancedSearch->SearchValue);
			$this->question_type_name->EditValue = HtmlEncode($this->question_type_name->AdvancedSearch->SearchValue);
			$this->question_type_name->PlaceHolder = RemoveHtml($this->question_type_name->caption());

			// question_group_name
			$this->question_group_name->EditAttrs["class"] = "form-control";
			$this->question_group_name->EditCustomAttributes = "";
			if (!$this->question_group_name->Raw)
				$this->question_group_name->AdvancedSearch->SearchValue = HtmlDecode($this->question_group_name->AdvancedSearch->SearchValue);
			$this->question_group_name->EditValue = HtmlEncode($this->question_group_name->AdvancedSearch->SearchValue);
			$this->question_group_name->PlaceHolder = RemoveHtml($this->question_group_name->caption());

			// question_category_name
			$this->question_category_name->EditAttrs["class"] = "form-control";
			$this->question_category_name->EditCustomAttributes = "";
			if (!$this->question_category_name->Raw)
				$this->question_category_name->AdvancedSearch->SearchValue = HtmlDecode($this->question_category_name->AdvancedSearch->SearchValue);
			$this->question_category_name->EditValue = HtmlEncode($this->question_category_name->AdvancedSearch->SearchValue);
			$this->question_category_name->PlaceHolder = RemoveHtml($this->question_category_name->caption());

			// assessment_customer_id
			$this->assessment_customer_id->EditAttrs["class"] = "form-control";
			$this->assessment_customer_id->EditCustomAttributes = "";
			if (!$this->assessment_customer_id->Raw)
				$this->assessment_customer_id->AdvancedSearch->SearchValue = HtmlDecode($this->assessment_customer_id->AdvancedSearch->SearchValue);
			$this->assessment_customer_id->EditValue = HtmlEncode($this->assessment_customer_id->AdvancedSearch->SearchValue);
			$this->assessment_customer_id->PlaceHolder = RemoveHtml($this->assessment_customer_id->caption());

			// assessment_customer_first_name
			$this->assessment_customer_first_name->EditAttrs["class"] = "form-control";
			$this->assessment_customer_first_name->EditCustomAttributes = "";
			if (!$this->assessment_customer_first_name->Raw)
				$this->assessment_customer_first_name->AdvancedSearch->SearchValue = HtmlDecode($this->assessment_customer_first_name->AdvancedSearch->SearchValue);
			$this->assessment_customer_first_name->EditValue = HtmlEncode($this->assessment_customer_first_name->AdvancedSearch->SearchValue);
			$this->assessment_customer_first_name->PlaceHolder = RemoveHtml($this->assessment_customer_first_name->caption());

			// assessment_status
			$this->assessment_status->EditAttrs["class"] = "form-control";
			$this->assessment_status->EditCustomAttributes = "";
			$this->assessment_status->EditValue = HtmlEncode($this->assessment_status->AdvancedSearch->SearchValue);
			$this->assessment_status->PlaceHolder = RemoveHtml($this->assessment_status->caption());

			// assessment_total_score
			$this->assessment_total_score->EditAttrs["class"] = "form-control";
			$this->assessment_total_score->EditCustomAttributes = "";
			$this->assessment_total_score->EditValue = HtmlEncode($this->assessment_total_score->AdvancedSearch->SearchValue);
			$this->assessment_total_score->PlaceHolder = RemoveHtml($this->assessment_total_score->caption());

			// assessment_customer_last_name
			$this->assessment_customer_last_name->EditAttrs["class"] = "form-control";
			$this->assessment_customer_last_name->EditCustomAttributes = "";
			if (!$this->assessment_customer_last_name->Raw)
				$this->assessment_customer_last_name->AdvancedSearch->SearchValue = HtmlDecode($this->assessment_customer_last_name->AdvancedSearch->SearchValue);
			$this->assessment_customer_last_name->EditValue = HtmlEncode($this->assessment_customer_last_name->AdvancedSearch->SearchValue);
			$this->assessment_customer_last_name->PlaceHolder = RemoveHtml($this->assessment_customer_last_name->caption());

			// assessment_user_id
			$this->assessment_user_id->EditAttrs["class"] = "form-control";
			$this->assessment_user_id->EditCustomAttributes = "";
			$this->assessment_user_id->EditValue = HtmlEncode($this->assessment_user_id->AdvancedSearch->SearchValue);
			$this->assessment_user_id->PlaceHolder = RemoveHtml($this->assessment_user_id->caption());

			// assessment_user_first_name
			$this->assessment_user_first_name->EditAttrs["class"] = "form-control";
			$this->assessment_user_first_name->EditCustomAttributes = "";
			if (!$this->assessment_user_first_name->Raw)
				$this->assessment_user_first_name->AdvancedSearch->SearchValue = HtmlDecode($this->assessment_user_first_name->AdvancedSearch->SearchValue);
			$this->assessment_user_first_name->EditValue = HtmlEncode($this->assessment_user_first_name->AdvancedSearch->SearchValue);
			$this->assessment_user_first_name->PlaceHolder = RemoveHtml($this->assessment_user_first_name->caption());

			// assessment_user_last_name
			$this->assessment_user_last_name->EditAttrs["class"] = "form-control";
			$this->assessment_user_last_name->EditCustomAttributes = "";
			if (!$this->assessment_user_last_name->Raw)
				$this->assessment_user_last_name->AdvancedSearch->SearchValue = HtmlDecode($this->assessment_user_last_name->AdvancedSearch->SearchValue);
			$this->assessment_user_last_name->EditValue = HtmlEncode($this->assessment_user_last_name->AdvancedSearch->SearchValue);
			$this->assessment_user_last_name->PlaceHolder = RemoveHtml($this->assessment_user_last_name->caption());

			// assessment_user_email
			$this->assessment_user_email->EditAttrs["class"] = "form-control";
			$this->assessment_user_email->EditCustomAttributes = "";
			if (!$this->assessment_user_email->Raw)
				$this->assessment_user_email->AdvancedSearch->SearchValue = HtmlDecode($this->assessment_user_email->AdvancedSearch->SearchValue);
			$this->assessment_user_email->EditValue = HtmlEncode($this->assessment_user_email->AdvancedSearch->SearchValue);
			$this->assessment_user_email->PlaceHolder = RemoveHtml($this->assessment_user_email->caption());

			// assessment_personal_id
			$this->assessment_personal_id->EditAttrs["class"] = "form-control";
			$this->assessment_personal_id->EditCustomAttributes = "";
			if (!$this->assessment_personal_id->Raw)
				$this->assessment_personal_id->AdvancedSearch->SearchValue = HtmlDecode($this->assessment_personal_id->AdvancedSearch->SearchValue);
			$this->assessment_personal_id->EditValue = HtmlEncode($this->assessment_personal_id->AdvancedSearch->SearchValue);
			$this->assessment_personal_id->PlaceHolder = RemoveHtml($this->assessment_personal_id->caption());

			// assessment_customer_age
			$this->assessment_customer_age->EditAttrs["class"] = "form-control";
			$this->assessment_customer_age->EditCustomAttributes = "";
			$this->assessment_customer_age->EditValue = HtmlEncode($this->assessment_customer_age->AdvancedSearch->SearchValue);
			$this->assessment_customer_age->PlaceHolder = RemoveHtml($this->assessment_customer_age->caption());

			// assessment_sex
			$this->assessment_sex->EditAttrs["class"] = "form-control";
			$this->assessment_sex->EditCustomAttributes = "";
			if (!$this->assessment_sex->Raw)
				$this->assessment_sex->AdvancedSearch->SearchValue = HtmlDecode($this->assessment_sex->AdvancedSearch->SearchValue);
			$this->assessment_sex->EditValue = HtmlEncode($this->assessment_sex->AdvancedSearch->SearchValue);
			$this->assessment_sex->PlaceHolder = RemoveHtml($this->assessment_sex->caption());

			// assessment_address
			$this->assessment_address->EditAttrs["class"] = "form-control";
			$this->assessment_address->EditCustomAttributes = "";
			if (!$this->assessment_address->Raw)
				$this->assessment_address->AdvancedSearch->SearchValue = HtmlDecode($this->assessment_address->AdvancedSearch->SearchValue);
			$this->assessment_address->EditValue = HtmlEncode($this->assessment_address->AdvancedSearch->SearchValue);
			$this->assessment_address->PlaceHolder = RemoveHtml($this->assessment_address->caption());

			// assessment_lat
			$this->assessment_lat->EditAttrs["class"] = "form-control";
			$this->assessment_lat->EditCustomAttributes = "";
			$this->assessment_lat->EditValue = HtmlEncode($this->assessment_lat->AdvancedSearch->SearchValue);
			$this->assessment_lat->PlaceHolder = RemoveHtml($this->assessment_lat->caption());

			// assessment_lon
			$this->assessment_lon->EditAttrs["class"] = "form-control";
			$this->assessment_lon->EditCustomAttributes = "";
			$this->assessment_lon->EditValue = HtmlEncode($this->assessment_lon->AdvancedSearch->SearchValue);
			$this->assessment_lon->PlaceHolder = RemoveHtml($this->assessment_lon->caption());

			// assessment_loan_purpose
			$this->assessment_loan_purpose->EditAttrs["class"] = "form-control";
			$this->assessment_loan_purpose->EditCustomAttributes = "";
			if (!$this->assessment_loan_purpose->Raw)
				$this->assessment_loan_purpose->AdvancedSearch->SearchValue = HtmlDecode($this->assessment_loan_purpose->AdvancedSearch->SearchValue);
			$this->assessment_loan_purpose->EditValue = HtmlEncode($this->assessment_loan_purpose->AdvancedSearch->SearchValue);
			$this->assessment_loan_purpose->PlaceHolder = RemoveHtml($this->assessment_loan_purpose->caption());

			// assessment_loan_section
			$this->assessment_loan_section->EditAttrs["class"] = "form-control";
			$this->assessment_loan_section->EditCustomAttributes = "";
			if (!$this->assessment_loan_section->Raw)
				$this->assessment_loan_section->AdvancedSearch->SearchValue = HtmlDecode($this->assessment_loan_section->AdvancedSearch->SearchValue);
			$this->assessment_loan_section->EditValue = HtmlEncode($this->assessment_loan_section->AdvancedSearch->SearchValue);
			$this->assessment_loan_section->PlaceHolder = RemoveHtml($this->assessment_loan_section->caption());

			// created_at
			$this->created_at->EditAttrs["class"] = "form-control";
			$this->created_at->EditCustomAttributes = "";
			$this->created_at->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->created_at->AdvancedSearch->SearchValue, 0), 8));
			$this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

			// updated_at
			$this->updated_at->EditAttrs["class"] = "form-control";
			$this->updated_at->EditCustomAttributes = "";
			$this->updated_at->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->updated_at->AdvancedSearch->SearchValue, 0), 8));
			$this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

			// loan_purpose_id
			$this->loan_purpose_id->EditAttrs["class"] = "form-control";
			$this->loan_purpose_id->EditCustomAttributes = "";
			$this->loan_purpose_id->EditValue = HtmlEncode($this->loan_purpose_id->AdvancedSearch->SearchValue);
			$this->loan_purpose_id->PlaceHolder = RemoveHtml($this->loan_purpose_id->caption());

			// loan_sector_id
			$this->loan_sector_id->EditAttrs["class"] = "form-control";
			$this->loan_sector_id->EditCustomAttributes = "";
			$this->loan_sector_id->EditValue = HtmlEncode($this->loan_sector_id->AdvancedSearch->SearchValue);
			$this->loan_sector_id->PlaceHolder = RemoveHtml($this->loan_sector_id->caption());
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return TRUE;
		if (!CheckInteger($this->question_section_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->question_section_id->errorMessage());
		}
		if (!CheckInteger($this->assessment_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->assessment_id->errorMessage());
		}

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->question_id->AdvancedSearch->load();
		$this->question_title->AdvancedSearch->load();
		$this->question_placeholder->AdvancedSearch->load();
		$this->question_questions->AdvancedSearch->load();
		$this->question_scores->AdvancedSearch->load();
		$this->question_active->AdvancedSearch->load();
		$this->question_section_id->AdvancedSearch->load();
		$this->question_type->AdvancedSearch->load();
		$this->question_has_recommendations->AdvancedSearch->load();
		$this->question_group_id->AdvancedSearch->load();
		$this->question_category_id->AdvancedSearch->load();
		$this->question_order->AdvancedSearch->load();
		$this->answer_id->AdvancedSearch->load();
		$this->answer_response->AdvancedSearch->load();
		$this->answer_score->AdvancedSearch->load();
		$this->assessment_id->AdvancedSearch->load();
		$this->answer_weight->AdvancedSearch->load();
		$this->answer_section_id->AdvancedSearch->load();
		$this->answer_recommendations->AdvancedSearch->load();
		$this->question_type_name->AdvancedSearch->load();
		$this->question_group_name->AdvancedSearch->load();
		$this->question_category_name->AdvancedSearch->load();
		$this->assessment_customer_id->AdvancedSearch->load();
		$this->assessment_customer_first_name->AdvancedSearch->load();
		$this->assessment_status->AdvancedSearch->load();
		$this->assessment_total_score->AdvancedSearch->load();
		$this->assessment_customer_last_name->AdvancedSearch->load();
		$this->assessment_user_id->AdvancedSearch->load();
		$this->assessment_user_first_name->AdvancedSearch->load();
		$this->assessment_user_last_name->AdvancedSearch->load();
		$this->assessment_user_email->AdvancedSearch->load();
		$this->assessment_personal_id->AdvancedSearch->load();
		$this->assessment_customer_age->AdvancedSearch->load();
		$this->assessment_sex->AdvancedSearch->load();
		$this->assessment_address->AdvancedSearch->load();
		$this->assessment_lat->AdvancedSearch->load();
		$this->assessment_lon->AdvancedSearch->load();
		$this->assessment_loan_purpose->AdvancedSearch->load();
		$this->assessment_loan_section->AdvancedSearch->load();
		$this->created_at->AdvancedSearch->load();
		$this->updated_at->AdvancedSearch->load();
		$this->loan_purpose_id->AdvancedSearch->load();
		$this->loan_sector_id->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fquestions_answerslist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fquestions_answerslist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fquestions_answerslist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "email")) {
			$url = $custom ? ",url:'" . $this->pageUrl() . "export=email&amp;custom=1'" : "";
			return '<button id="emf_questions_answers" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_questions_answers\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fquestions_answerslist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = FALSE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = FALSE;

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = $this->getExportTag("html");
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = $this->getExportTag("xml");
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = $this->getExportTag("csv");
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email");
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = TRUE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fquestions_answerslistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"questions_answerssrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");
		$selectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecords = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecords = $rs->RecordCount();
		}
		$this->StartRecord = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
			$this->DisplayRecords = $this->TotalRecords;
			$this->StopRecord = $this->TotalRecords;
		} else { // Export one page only
			$this->setupStartRecord(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecords <= 0) {
				$this->StopRecord = $this->TotalRecords;
			} else {
				$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
			}
		}
		if ($selectLimit)
			$rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
		$this->ExportDoc = GetExportDocument($this, "h");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRecord = 1;
			$this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!Config("DEBUG") && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (Config("DEBUG") && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {

			// Export-to-email disabled
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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
				case "x_question_active":
					break;
				case "x_question_section_id":
					break;
				case "x_question_type":
					break;
				case "x_question_has_recommendations":
					break;
				case "x_question_group_id":
					break;
				case "x_question_category_id":
					break;
				case "x_assessment_id":
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
						case "x_question_section_id":
							$row[1] = FormatNumber($row[1], 0, -2, -2, -2);
							$row['df'] = $row[1];
							break;
						case "x_question_type":
							break;
						case "x_question_group_id":
							break;
						case "x_question_category_id":
							break;
						case "x_assessment_id":
							$row[1] = FormatNumber($row[1], 0, -2, -2, -2);
							$row['df'] = $row[1];
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

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
} // End class
?>
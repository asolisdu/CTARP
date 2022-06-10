<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

/**
 * Page class
 */
class answers_add extends answers
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{98C27E89-2937-4D47-9B89-35CA334C4E82}";

	// Table name
	public $TableName = 'answers';

	// Page object name
	public $PageObjName = "answers_add";

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

		// Table object (answers)
		if (!isset($GLOBALS["answers"]) || get_class($GLOBALS["answers"]) == PROJECT_NAMESPACE . "answers") {
			$GLOBALS["answers"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["answers"];
		}

		// Table object (assessments)
		if (!isset($GLOBALS['assessments']))
			$GLOBALS['assessments'] = new assessments();

		// Table object (questions)
		if (!isset($GLOBALS['questions']))
			$GLOBALS['questions'] = new questions();

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'answers');

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
		global $answers;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($answers);
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "answersview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canAdd()) {
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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("answerslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->question_id->setVisibility();
		$this->assessment_id->setVisibility();
		$this->section_id->setVisibility();
		$this->_response->setVisibility();
		$this->score->setVisibility();
		$this->recommendations->setVisibility();
		$this->created_at->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->weight->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

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

		// Set up lookup cache
		$this->setupLookupOptions($this->question_id);
		$this->setupLookupOptions($this->assessment_id);
		$this->setupLookupOptions($this->section_id);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("answerslist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Set up master/detail parameters
		// NOTE: must be after loadOldRecord to prevent master key values overwritten

		$this->setupMasterParms();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("answerslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "answerslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "answersview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
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
		$this->question_id->CurrentValue = NULL;
		$this->question_id->OldValue = $this->question_id->CurrentValue;
		$this->assessment_id->CurrentValue = NULL;
		$this->assessment_id->OldValue = $this->assessment_id->CurrentValue;
		$this->section_id->CurrentValue = NULL;
		$this->section_id->OldValue = $this->section_id->CurrentValue;
		$this->_response->CurrentValue = NULL;
		$this->_response->OldValue = $this->_response->CurrentValue;
		$this->score->CurrentValue = NULL;
		$this->score->OldValue = $this->score->CurrentValue;
		$this->recommendations->CurrentValue = NULL;
		$this->recommendations->OldValue = $this->recommendations->CurrentValue;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->updated_at->CurrentValue = NULL;
		$this->updated_at->OldValue = $this->updated_at->CurrentValue;
		$this->weight->CurrentValue = NULL;
		$this->weight->OldValue = $this->weight->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'question_id' first before field var 'x_question_id'
		$val = $CurrentForm->hasValue("question_id") ? $CurrentForm->getValue("question_id") : $CurrentForm->getValue("x_question_id");
		if (!$this->question_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->question_id->Visible = FALSE; // Disable update for API request
			else
				$this->question_id->setFormValue($val);
		}

		// Check field name 'assessment_id' first before field var 'x_assessment_id'
		$val = $CurrentForm->hasValue("assessment_id") ? $CurrentForm->getValue("assessment_id") : $CurrentForm->getValue("x_assessment_id");
		if (!$this->assessment_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->assessment_id->Visible = FALSE; // Disable update for API request
			else
				$this->assessment_id->setFormValue($val);
		}

		// Check field name 'section_id' first before field var 'x_section_id'
		$val = $CurrentForm->hasValue("section_id") ? $CurrentForm->getValue("section_id") : $CurrentForm->getValue("x_section_id");
		if (!$this->section_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->section_id->Visible = FALSE; // Disable update for API request
			else
				$this->section_id->setFormValue($val);
		}

		// Check field name 'response' first before field var 'x__response'
		$val = $CurrentForm->hasValue("response") ? $CurrentForm->getValue("response") : $CurrentForm->getValue("x__response");
		if (!$this->_response->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->_response->Visible = FALSE; // Disable update for API request
			else
				$this->_response->setFormValue($val);
		}

		// Check field name 'score' first before field var 'x_score'
		$val = $CurrentForm->hasValue("score") ? $CurrentForm->getValue("score") : $CurrentForm->getValue("x_score");
		if (!$this->score->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->score->Visible = FALSE; // Disable update for API request
			else
				$this->score->setFormValue($val);
		}

		// Check field name 'recommendations' first before field var 'x_recommendations'
		$val = $CurrentForm->hasValue("recommendations") ? $CurrentForm->getValue("recommendations") : $CurrentForm->getValue("x_recommendations");
		if (!$this->recommendations->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->recommendations->Visible = FALSE; // Disable update for API request
			else
				$this->recommendations->setFormValue($val);
		}

		// Check field name 'weight' first before field var 'x_weight'
		$val = $CurrentForm->hasValue("weight") ? $CurrentForm->getValue("weight") : $CurrentForm->getValue("x_weight");
		if (!$this->weight->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->weight->Visible = FALSE; // Disable update for API request
			else
				$this->weight->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->question_id->CurrentValue = $this->question_id->FormValue;
		$this->assessment_id->CurrentValue = $this->assessment_id->FormValue;
		$this->section_id->CurrentValue = $this->section_id->FormValue;
		$this->_response->CurrentValue = $this->_response->FormValue;
		$this->score->CurrentValue = $this->score->FormValue;
		$this->recommendations->CurrentValue = $this->recommendations->FormValue;
		$this->weight->CurrentValue = $this->weight->FormValue;
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
		$this->question_id->setDbValue($row['question_id']);
		$this->assessment_id->setDbValue($row['assessment_id']);
		$this->section_id->setDbValue($row['section_id']);
		$this->_response->setDbValue($row['response']);
		$this->score->setDbValue($row['score']);
		$this->recommendations->setDbValue($row['recommendations']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->weight->setDbValue($row['weight']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['question_id'] = $this->question_id->CurrentValue;
		$row['assessment_id'] = $this->assessment_id->CurrentValue;
		$row['section_id'] = $this->section_id->CurrentValue;
		$row['response'] = $this->_response->CurrentValue;
		$row['score'] = $this->score->CurrentValue;
		$row['recommendations'] = $this->recommendations->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		$row['updated_at'] = $this->updated_at->CurrentValue;
		$row['weight'] = $this->weight->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
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
		// Convert decimal values if posted back

		if ($this->score->FormValue == $this->score->CurrentValue && is_numeric(ConvertToFloatString($this->score->CurrentValue)))
			$this->score->CurrentValue = ConvertToFloatString($this->score->CurrentValue);

		// Convert decimal values if posted back
		if ($this->weight->FormValue == $this->weight->CurrentValue && is_numeric(ConvertToFloatString($this->weight->CurrentValue)))
			$this->weight->CurrentValue = ConvertToFloatString($this->weight->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// weight
			$this->weight->LinkCustomAttributes = "";
			$this->weight->HrefValue = "";
			$this->weight->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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
				$this->question_id->EditValue = HtmlEncode($this->question_id->CurrentValue);
				$curVal = strval($this->question_id->CurrentValue);
				if ($curVal != "") {
					$this->question_id->EditValue = $this->question_id->lookupCacheOption($curVal);
					if ($this->question_id->EditValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->question_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode(FormatNumber($rswrk->fields('df'), 0, -2, -2, -2));
							$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
							$this->question_id->EditValue = $this->question_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->question_id->EditValue = HtmlEncode($this->question_id->CurrentValue);
						}
					}
				} else {
					$this->question_id->EditValue = NULL;
				}
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
				$this->assessment_id->EditValue = HtmlEncode($this->assessment_id->CurrentValue);
				$curVal = strval($this->assessment_id->CurrentValue);
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
							$this->assessment_id->EditValue = HtmlEncode($this->assessment_id->CurrentValue);
						}
					}
				} else {
					$this->assessment_id->EditValue = NULL;
				}
				$this->assessment_id->PlaceHolder = RemoveHtml($this->assessment_id->caption());
			}

			// section_id
			$this->section_id->EditAttrs["class"] = "form-control";
			$this->section_id->EditCustomAttributes = "";
			$this->section_id->EditValue = HtmlEncode($this->section_id->CurrentValue);
			$curVal = strval($this->section_id->CurrentValue);
			if ($curVal != "") {
				$this->section_id->EditValue = $this->section_id->lookupCacheOption($curVal);
				if ($this->section_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->section_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->section_id->EditValue = $this->section_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->section_id->EditValue = HtmlEncode($this->section_id->CurrentValue);
					}
				}
			} else {
				$this->section_id->EditValue = NULL;
			}
			$this->section_id->PlaceHolder = RemoveHtml($this->section_id->caption());

			// response
			$this->_response->EditAttrs["class"] = "form-control";
			$this->_response->EditCustomAttributes = "";
			if (!$this->_response->Raw)
				$this->_response->CurrentValue = HtmlDecode($this->_response->CurrentValue);
			$this->_response->EditValue = HtmlEncode($this->_response->CurrentValue);
			$this->_response->PlaceHolder = RemoveHtml($this->_response->caption());

			// score
			$this->score->EditAttrs["class"] = "form-control";
			$this->score->EditCustomAttributes = "";
			$this->score->EditValue = HtmlEncode($this->score->CurrentValue);
			$this->score->PlaceHolder = RemoveHtml($this->score->caption());
			if (strval($this->score->EditValue) != "" && is_numeric($this->score->EditValue))
				$this->score->EditValue = FormatNumber($this->score->EditValue, -2, -2, -2, -2);
			

			// recommendations
			$this->recommendations->EditAttrs["class"] = "form-control";
			$this->recommendations->EditCustomAttributes = "";
			$this->recommendations->EditValue = HtmlEncode($this->recommendations->CurrentValue);
			$this->recommendations->PlaceHolder = RemoveHtml($this->recommendations->caption());

			// weight
			$this->weight->EditAttrs["class"] = "form-control";
			$this->weight->EditCustomAttributes = "";
			$this->weight->EditValue = HtmlEncode($this->weight->CurrentValue);
			$this->weight->PlaceHolder = RemoveHtml($this->weight->caption());
			if (strval($this->weight->EditValue) != "" && is_numeric($this->weight->EditValue))
				$this->weight->EditValue = FormatNumber($this->weight->EditValue, -2, -2, -2, -2);
			

			// Add refer script
			// question_id

			$this->question_id->LinkCustomAttributes = "";
			$this->question_id->HrefValue = "";

			// assessment_id
			$this->assessment_id->LinkCustomAttributes = "";
			$this->assessment_id->HrefValue = "";

			// section_id
			$this->section_id->LinkCustomAttributes = "";
			$this->section_id->HrefValue = "";

			// response
			$this->_response->LinkCustomAttributes = "";
			$this->_response->HrefValue = "";

			// score
			$this->score->LinkCustomAttributes = "";
			$this->score->HrefValue = "";

			// recommendations
			$this->recommendations->LinkCustomAttributes = "";
			$this->recommendations->HrefValue = "";

			// weight
			$this->weight->LinkCustomAttributes = "";
			$this->weight->HrefValue = "";
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

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->question_id->Required) {
			if (!$this->question_id->IsDetailKey && $this->question_id->FormValue != NULL && $this->question_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->question_id->caption(), $this->question_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->question_id->FormValue)) {
			AddMessage($FormError, $this->question_id->errorMessage());
		}
		if ($this->assessment_id->Required) {
			if (!$this->assessment_id->IsDetailKey && $this->assessment_id->FormValue != NULL && $this->assessment_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->assessment_id->caption(), $this->assessment_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->assessment_id->FormValue)) {
			AddMessage($FormError, $this->assessment_id->errorMessage());
		}
		if ($this->section_id->Required) {
			if (!$this->section_id->IsDetailKey && $this->section_id->FormValue != NULL && $this->section_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->section_id->caption(), $this->section_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->section_id->FormValue)) {
			AddMessage($FormError, $this->section_id->errorMessage());
		}
		if ($this->_response->Required) {
			if (!$this->_response->IsDetailKey && $this->_response->FormValue != NULL && $this->_response->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_response->caption(), $this->_response->RequiredErrorMessage));
			}
		}
		if ($this->score->Required) {
			if (!$this->score->IsDetailKey && $this->score->FormValue != NULL && $this->score->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->score->caption(), $this->score->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->score->FormValue)) {
			AddMessage($FormError, $this->score->errorMessage());
		}
		if ($this->recommendations->Required) {
			if (!$this->recommendations->IsDetailKey && $this->recommendations->FormValue != NULL && $this->recommendations->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->recommendations->caption(), $this->recommendations->RequiredErrorMessage));
			}
		}
		if ($this->weight->Required) {
			if (!$this->weight->IsDetailKey && $this->weight->FormValue != NULL && $this->weight->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->weight->caption(), $this->weight->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->weight->FormValue)) {
			AddMessage($FormError, $this->weight->errorMessage());
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// question_id
		$this->question_id->setDbValueDef($rsnew, $this->question_id->CurrentValue, NULL, FALSE);

		// assessment_id
		$this->assessment_id->setDbValueDef($rsnew, $this->assessment_id->CurrentValue, 0, FALSE);

		// section_id
		$this->section_id->setDbValueDef($rsnew, $this->section_id->CurrentValue, 0, FALSE);

		// response
		$this->_response->setDbValueDef($rsnew, $this->_response->CurrentValue, NULL, FALSE);

		// score
		$this->score->setDbValueDef($rsnew, $this->score->CurrentValue, NULL, FALSE);

		// recommendations
		$this->recommendations->setDbValueDef($rsnew, $this->recommendations->CurrentValue, NULL, FALSE);

		// weight
		$this->weight->setDbValueDef($rsnew, $this->weight->CurrentValue, NULL, FALSE);

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

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "questions") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("question_id"))) !== NULL) {
					$GLOBALS["questions"]->id->setQueryStringValue($parm);
					$this->question_id->setQueryStringValue($GLOBALS["questions"]->id->QueryStringValue);
					$this->question_id->setSessionValue($this->question_id->QueryStringValue);
					if (!is_numeric($GLOBALS["questions"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "assessments") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("assessment_id"))) !== NULL) {
					$GLOBALS["assessments"]->id->setQueryStringValue($parm);
					$this->assessment_id->setQueryStringValue($GLOBALS["assessments"]->id->QueryStringValue);
					$this->assessment_id->setSessionValue($this->assessment_id->QueryStringValue);
					if (!is_numeric($GLOBALS["assessments"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "questions") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("question_id"))) !== NULL) {
					$GLOBALS["questions"]->id->setFormValue($parm);
					$this->question_id->setFormValue($GLOBALS["questions"]->id->FormValue);
					$this->question_id->setSessionValue($this->question_id->FormValue);
					if (!is_numeric($GLOBALS["questions"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "assessments") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("assessment_id"))) !== NULL) {
					$GLOBALS["assessments"]->id->setFormValue($parm);
					$this->assessment_id->setFormValue($GLOBALS["assessments"]->id->FormValue);
					$this->assessment_id->setSessionValue($this->assessment_id->FormValue);
					if (!is_numeric($GLOBALS["assessments"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "questions") {
				if ($this->question_id->CurrentValue == "")
					$this->question_id->setSessionValue("");
			}
			if ($masterTblVar != "assessments") {
				if ($this->assessment_id->CurrentValue == "")
					$this->assessment_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("answerslist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
				case "x_question_id":
					break;
				case "x_assessment_id":
					break;
				case "x_section_id":
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
						case "x_question_id":
							$row[1] = FormatNumber($row[1], 0, -2, -2, -2);
							$row['df'] = $row[1];
							break;
						case "x_assessment_id":
							$row[1] = FormatNumber($row[1], 0, -2, -2, -2);
							$row['df'] = $row[1];
							break;
						case "x_section_id":
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
} // End class
?>
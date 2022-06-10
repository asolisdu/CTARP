<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

/**
 * Page class
 */
class assessments_add extends assessments
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{98C27E89-2937-4D47-9B89-35CA334C4E82}";

	// Table name
	public $TableName = 'assessments';

	// Page object name
	public $PageObjName = "assessments_add";

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

		// Table object (assessments)
		if (!isset($GLOBALS["assessments"]) || get_class($GLOBALS["assessments"]) == PROJECT_NAMESPACE . "assessments") {
			$GLOBALS["assessments"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["assessments"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Table object (loan_purposes)
		if (!isset($GLOBALS['loan_purposes']))
			$GLOBALS['loan_purposes'] = new loan_purposes();

		// Table object (loan_section)
		if (!isset($GLOBALS['loan_section']))
			$GLOBALS['loan_section'] = new loan_section();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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
					if ($pageName == "assessmentsview.php")
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
					$this->terminate(GetUrl("assessmentslist.php"));
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
		$this->customer_last_name->setVisibility();
		$this->lat->setVisibility();
		$this->lon->setVisibility();
		$this->created_at->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->personal_id->setVisibility();
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
		$this->setupLookupOptions($this->user_id);
		$this->setupLookupOptions($this->loan_purpose);
		$this->setupLookupOptions($this->loan_section);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("assessmentslist.php");
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

		// Set up detail parameters
		$this->setupDetailParms();

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
					$this->terminate("assessmentslist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() != "") // Master/detail add
						$returnUrl = $this->getDetailUrl();
					else
						$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "assessmentslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "assessmentsview.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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
		$this->user_id->CurrentValue = NULL;
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

		// Check field name 'user_id' first before field var 'x_user_id'
		$val = $CurrentForm->hasValue("user_id") ? $CurrentForm->getValue("user_id") : $CurrentForm->getValue("x_user_id");
		if (!$this->user_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->user_id->Visible = FALSE; // Disable update for API request
			else
				$this->user_id->setFormValue($val);
		}

		// Check field name 'customer_id' first before field var 'x_customer_id'
		$val = $CurrentForm->hasValue("customer_id") ? $CurrentForm->getValue("customer_id") : $CurrentForm->getValue("x_customer_id");
		if (!$this->customer_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->customer_id->Visible = FALSE; // Disable update for API request
			else
				$this->customer_id->setFormValue($val);
		}

		// Check field name 'customer_first_name' first before field var 'x_customer_first_name'
		$val = $CurrentForm->hasValue("customer_first_name") ? $CurrentForm->getValue("customer_first_name") : $CurrentForm->getValue("x_customer_first_name");
		if (!$this->customer_first_name->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->customer_first_name->Visible = FALSE; // Disable update for API request
			else
				$this->customer_first_name->setFormValue($val);
		}

		// Check field name 'customer_age' first before field var 'x_customer_age'
		$val = $CurrentForm->hasValue("customer_age") ? $CurrentForm->getValue("customer_age") : $CurrentForm->getValue("x_customer_age");
		if (!$this->customer_age->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->customer_age->Visible = FALSE; // Disable update for API request
			else
				$this->customer_age->setFormValue($val);
		}

		// Check field name 'sex' first before field var 'x_sex'
		$val = $CurrentForm->hasValue("sex") ? $CurrentForm->getValue("sex") : $CurrentForm->getValue("x_sex");
		if (!$this->sex->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->sex->Visible = FALSE; // Disable update for API request
			else
				$this->sex->setFormValue($val);
		}

		// Check field name 'address' first before field var 'x_address'
		$val = $CurrentForm->hasValue("address") ? $CurrentForm->getValue("address") : $CurrentForm->getValue("x_address");
		if (!$this->address->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->address->Visible = FALSE; // Disable update for API request
			else
				$this->address->setFormValue($val);
		}

		// Check field name 'total_score' first before field var 'x_total_score'
		$val = $CurrentForm->hasValue("total_score") ? $CurrentForm->getValue("total_score") : $CurrentForm->getValue("x_total_score");
		if (!$this->total_score->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->total_score->Visible = FALSE; // Disable update for API request
			else
				$this->total_score->setFormValue($val);
		}

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
		}

		// Check field name 'loan_purpose' first before field var 'x_loan_purpose'
		$val = $CurrentForm->hasValue("loan_purpose") ? $CurrentForm->getValue("loan_purpose") : $CurrentForm->getValue("x_loan_purpose");
		if (!$this->loan_purpose->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->loan_purpose->Visible = FALSE; // Disable update for API request
			else
				$this->loan_purpose->setFormValue($val);
		}

		// Check field name 'loan_section' first before field var 'x_loan_section'
		$val = $CurrentForm->hasValue("loan_section") ? $CurrentForm->getValue("loan_section") : $CurrentForm->getValue("x_loan_section");
		if (!$this->loan_section->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->loan_section->Visible = FALSE; // Disable update for API request
			else
				$this->loan_section->setFormValue($val);
		}

		// Check field name 'customer_last_name' first before field var 'x_customer_last_name'
		$val = $CurrentForm->hasValue("customer_last_name") ? $CurrentForm->getValue("customer_last_name") : $CurrentForm->getValue("x_customer_last_name");
		if (!$this->customer_last_name->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->customer_last_name->Visible = FALSE; // Disable update for API request
			else
				$this->customer_last_name->setFormValue($val);
		}

		// Check field name 'lat' first before field var 'x_lat'
		$val = $CurrentForm->hasValue("lat") ? $CurrentForm->getValue("lat") : $CurrentForm->getValue("x_lat");
		if (!$this->lat->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->lat->Visible = FALSE; // Disable update for API request
			else
				$this->lat->setFormValue($val);
		}

		// Check field name 'lon' first before field var 'x_lon'
		$val = $CurrentForm->hasValue("lon") ? $CurrentForm->getValue("lon") : $CurrentForm->getValue("x_lon");
		if (!$this->lon->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->lon->Visible = FALSE; // Disable update for API request
			else
				$this->lon->setFormValue($val);
		}

		// Check field name 'personal_id' first before field var 'x_personal_id'
		$val = $CurrentForm->hasValue("personal_id") ? $CurrentForm->getValue("personal_id") : $CurrentForm->getValue("x_personal_id");
		if (!$this->personal_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->personal_id->Visible = FALSE; // Disable update for API request
			else
				$this->personal_id->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
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
		$this->customer_last_name->CurrentValue = $this->customer_last_name->FormValue;
		$this->lat->CurrentValue = $this->lat->FormValue;
		$this->lon->CurrentValue = $this->lon->FormValue;
		$this->personal_id->CurrentValue = $this->personal_id->FormValue;
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

			// personal_id
			$this->personal_id->LinkCustomAttributes = "";
			$this->personal_id->HrefValue = "";
			$this->personal_id->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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

			// customer_last_name
			$this->customer_last_name->EditAttrs["class"] = "form-control";
			$this->customer_last_name->EditCustomAttributes = "";
			if (!$this->customer_last_name->Raw)
				$this->customer_last_name->CurrentValue = HtmlDecode($this->customer_last_name->CurrentValue);
			$this->customer_last_name->EditValue = HtmlEncode($this->customer_last_name->CurrentValue);
			$this->customer_last_name->PlaceHolder = RemoveHtml($this->customer_last_name->caption());

			// lat
			$this->lat->EditAttrs["class"] = "form-control";
			$this->lat->EditCustomAttributes = "";
			$this->lat->EditValue = HtmlEncode($this->lat->CurrentValue);
			$this->lat->PlaceHolder = RemoveHtml($this->lat->caption());
			if (strval($this->lat->EditValue) != "" && is_numeric($this->lat->EditValue))
				$this->lat->EditValue = FormatNumber($this->lat->EditValue, -2, -2, -2, -2);
			

			// lon
			$this->lon->EditAttrs["class"] = "form-control";
			$this->lon->EditCustomAttributes = "";
			$this->lon->EditValue = HtmlEncode($this->lon->CurrentValue);
			$this->lon->PlaceHolder = RemoveHtml($this->lon->caption());
			if (strval($this->lon->EditValue) != "" && is_numeric($this->lon->EditValue))
				$this->lon->EditValue = FormatNumber($this->lon->EditValue, -2, -2, -2, -2);
			

			// personal_id
			$this->personal_id->EditAttrs["class"] = "form-control";
			$this->personal_id->EditCustomAttributes = "";
			if (!$this->personal_id->Raw)
				$this->personal_id->CurrentValue = HtmlDecode($this->personal_id->CurrentValue);
			$this->personal_id->EditValue = HtmlEncode($this->personal_id->CurrentValue);
			$this->personal_id->PlaceHolder = RemoveHtml($this->personal_id->caption());

			// Add refer script
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

			// customer_last_name
			$this->customer_last_name->LinkCustomAttributes = "";
			$this->customer_last_name->HrefValue = "";

			// lat
			$this->lat->LinkCustomAttributes = "";
			$this->lat->HrefValue = "";

			// lon
			$this->lon->LinkCustomAttributes = "";
			$this->lon->HrefValue = "";

			// personal_id
			$this->personal_id->LinkCustomAttributes = "";
			$this->personal_id->HrefValue = "";
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
		if ($this->customer_last_name->Required) {
			if (!$this->customer_last_name->IsDetailKey && $this->customer_last_name->FormValue != NULL && $this->customer_last_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_last_name->caption(), $this->customer_last_name->RequiredErrorMessage));
			}
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
		if ($this->personal_id->Required) {
			if (!$this->personal_id->IsDetailKey && $this->personal_id->FormValue != NULL && $this->personal_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->personal_id->caption(), $this->personal_id->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("results", $detailTblVar) && $GLOBALS["results"]->DetailAdd) {
			if (!isset($GLOBALS["results_grid"]))
				$GLOBALS["results_grid"] = new results_grid(); // Get detail page object
			$GLOBALS["results_grid"]->validateGridForm();
		}
		if (in_array("answers", $detailTblVar) && $GLOBALS["answers"]->DetailAdd) {
			if (!isset($GLOBALS["answers_grid"]))
				$GLOBALS["answers_grid"] = new answers_grid(); // Get detail page object
			$GLOBALS["answers_grid"]->validateGridForm();
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

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

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

		// customer_last_name
		$this->customer_last_name->setDbValueDef($rsnew, $this->customer_last_name->CurrentValue, NULL, FALSE);

		// lat
		$this->lat->setDbValueDef($rsnew, $this->lat->CurrentValue, NULL, FALSE);

		// lon
		$this->lon->setDbValueDef($rsnew, $this->lon->CurrentValue, NULL, FALSE);

		// personal_id
		$this->personal_id->setDbValueDef($rsnew, $this->personal_id->CurrentValue, NULL, FALSE);

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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("results", $detailTblVar) && $GLOBALS["results"]->DetailAdd) {
				$GLOBALS["results"]->assessment_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["results_grid"]))
					$GLOBALS["results_grid"] = new results_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "results"); // Load user level of detail table
				$addRow = $GLOBALS["results_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["results"]->assessment_id->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("answers", $detailTblVar) && $GLOBALS["answers"]->DetailAdd) {
				$GLOBALS["answers"]->assessment_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["answers_grid"]))
					$GLOBALS["answers_grid"] = new answers_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "answers"); // Load user level of detail table
				$addRow = $GLOBALS["answers_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["answers"]->assessment_id->setSessionValue(""); // Clear master key if insert failed
				}
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() != "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
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
			if ($masterTblVar == "users") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("user_id"))) !== NULL) {
					$GLOBALS["users"]->id->setQueryStringValue($parm);
					$this->user_id->setQueryStringValue($GLOBALS["users"]->id->QueryStringValue);
					$this->user_id->setSessionValue($this->user_id->QueryStringValue);
					if (!is_numeric($GLOBALS["users"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "loan_purposes") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("loan_purpose"))) !== NULL) {
					$GLOBALS["loan_purposes"]->id->setQueryStringValue($parm);
					$this->loan_purpose->setQueryStringValue($GLOBALS["loan_purposes"]->id->QueryStringValue);
					$this->loan_purpose->setSessionValue($this->loan_purpose->QueryStringValue);
					if (!is_numeric($GLOBALS["loan_purposes"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "loan_section") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("loan_section"))) !== NULL) {
					$GLOBALS["loan_section"]->id->setQueryStringValue($parm);
					$this->loan_section->setQueryStringValue($GLOBALS["loan_section"]->id->QueryStringValue);
					$this->loan_section->setSessionValue($this->loan_section->QueryStringValue);
					if (!is_numeric($GLOBALS["loan_section"]->id->QueryStringValue))
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
			if ($masterTblVar == "users") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("user_id"))) !== NULL) {
					$GLOBALS["users"]->id->setFormValue($parm);
					$this->user_id->setFormValue($GLOBALS["users"]->id->FormValue);
					$this->user_id->setSessionValue($this->user_id->FormValue);
					if (!is_numeric($GLOBALS["users"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "loan_purposes") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("loan_purpose"))) !== NULL) {
					$GLOBALS["loan_purposes"]->id->setFormValue($parm);
					$this->loan_purpose->setFormValue($GLOBALS["loan_purposes"]->id->FormValue);
					$this->loan_purpose->setSessionValue($this->loan_purpose->FormValue);
					if (!is_numeric($GLOBALS["loan_purposes"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "loan_section") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("loan_section"))) !== NULL) {
					$GLOBALS["loan_section"]->id->setFormValue($parm);
					$this->loan_section->setFormValue($GLOBALS["loan_section"]->id->FormValue);
					$this->loan_section->setSessionValue($this->loan_section->FormValue);
					if (!is_numeric($GLOBALS["loan_section"]->id->FormValue))
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
			if ($masterTblVar != "users") {
				if ($this->user_id->CurrentValue == "")
					$this->user_id->setSessionValue("");
			}
			if ($masterTblVar != "loan_purposes") {
				if ($this->loan_purpose->CurrentValue == "")
					$this->loan_purpose->setSessionValue("");
			}
			if ($masterTblVar != "loan_section") {
				if ($this->loan_section->CurrentValue == "")
					$this->loan_section->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("results", $detailTblVar)) {
				if (!isset($GLOBALS["results_grid"]))
					$GLOBALS["results_grid"] = new results_grid();
				if ($GLOBALS["results_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["results_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["results_grid"]->CurrentMode = "add";
					$GLOBALS["results_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["results_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["results_grid"]->setStartRecordNumber(1);
					$GLOBALS["results_grid"]->assessment_id->IsDetailKey = TRUE;
					$GLOBALS["results_grid"]->assessment_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["results_grid"]->assessment_id->setSessionValue($GLOBALS["results_grid"]->assessment_id->CurrentValue);
				}
			}
			if (in_array("answers", $detailTblVar)) {
				if (!isset($GLOBALS["answers_grid"]))
					$GLOBALS["answers_grid"] = new answers_grid();
				if ($GLOBALS["answers_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["answers_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["answers_grid"]->CurrentMode = "add";
					$GLOBALS["answers_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["answers_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["answers_grid"]->setStartRecordNumber(1);
					$GLOBALS["answers_grid"]->assessment_id->IsDetailKey = TRUE;
					$GLOBALS["answers_grid"]->assessment_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["answers_grid"]->assessment_id->setSessionValue($GLOBALS["answers_grid"]->assessment_id->CurrentValue);
					$GLOBALS["answers_grid"]->question_id->setSessionValue(""); // Clear session key
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("assessmentslist.php"), "", $this->TableVar, TRUE);
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
} // End class
?>
<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

/**
 * Page class
 */
class questions_edit extends questions
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{98C27E89-2937-4D47-9B89-35CA334C4E82}";

	// Table name
	public $TableName = 'questions';

	// Page object name
	public $PageObjName = "questions_edit";

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
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (questions)
		if (!isset($GLOBALS["questions"]) || get_class($GLOBALS["questions"]) == PROJECT_NAMESPACE . "questions") {
			$GLOBALS["questions"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["questions"];
		}

		// Table object (question_types)
		if (!isset($GLOBALS['question_types']))
			$GLOBALS['question_types'] = new question_types();

		// Table object (sections)
		if (!isset($GLOBALS['sections']))
			$GLOBALS['sections'] = new sections();

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Table object (question_category)
		if (!isset($GLOBALS['question_category']))
			$GLOBALS['question_category'] = new question_category();

		// Table object (question_groups)
		if (!isset($GLOBALS['question_groups']))
			$GLOBALS['question_groups'] = new question_groups();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'questions');

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
		global $questions;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($questions);
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
					if ($pageName == "questionsview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

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
			if (!$Security->canEdit()) {
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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("questionslist.php"));
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
		$this->title->setVisibility();
		$this->placeholder->setVisibility();
		$this->questions->setVisibility();
		$this->scores->setVisibility();
		$this->type->setVisibility();
		$this->section->setVisibility();
		$this->active->setVisibility();
		$this->created_at->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->has_recommendations->setVisibility();
		$this->group->setVisibility();
		$this->category->setVisibility();
		$this->order->setVisibility();
		$this->recommendation_by_score->setVisibility();
		$this->recommendation_score->setVisibility();
		$this->related->setVisibility();
		$this->trigger_related_val->setVisibility();
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
		$this->setupLookupOptions($this->type);
		$this->setupLookupOptions($this->section);
		$this->setupLookupOptions($this->group);
		$this->setupLookupOptions($this->category);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("questionslist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->id->setOldValue($this->id->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->id->setQueryStringValue(Key(0));
				$this->id->setOldValue($this->id->QueryStringValue);
			} elseif (Post("id") !== NULL) {
				$this->id->setFormValue(Post("id"));
				$this->id->setOldValue($this->id->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->id->setQueryStringValue(Route(2));
				$this->id->setOldValue($this->id->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_id")) {
					$this->id->setFormValue($CurrentForm->getValue("x_id"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("id") !== NULL) {
					$this->id->setQueryStringValue(Get("id"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->id->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->id->CurrentValue = NULL;
				}
			}

			// Set up master detail parameters
			$this->setupMasterParms();

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("questionslist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "questionslist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'title' first before field var 'x_title'
		$val = $CurrentForm->hasValue("title") ? $CurrentForm->getValue("title") : $CurrentForm->getValue("x_title");
		if (!$this->title->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->title->Visible = FALSE; // Disable update for API request
			else
				$this->title->setFormValue($val);
		}

		// Check field name 'placeholder' first before field var 'x_placeholder'
		$val = $CurrentForm->hasValue("placeholder") ? $CurrentForm->getValue("placeholder") : $CurrentForm->getValue("x_placeholder");
		if (!$this->placeholder->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->placeholder->Visible = FALSE; // Disable update for API request
			else
				$this->placeholder->setFormValue($val);
		}

		// Check field name 'questions' first before field var 'x_questions'
		$val = $CurrentForm->hasValue("questions") ? $CurrentForm->getValue("questions") : $CurrentForm->getValue("x_questions");
		if (!$this->questions->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->questions->Visible = FALSE; // Disable update for API request
			else
				$this->questions->setFormValue($val);
		}

		// Check field name 'scores' first before field var 'x_scores'
		$val = $CurrentForm->hasValue("scores") ? $CurrentForm->getValue("scores") : $CurrentForm->getValue("x_scores");
		if (!$this->scores->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->scores->Visible = FALSE; // Disable update for API request
			else
				$this->scores->setFormValue($val);
		}

		// Check field name 'type' first before field var 'x_type'
		$val = $CurrentForm->hasValue("type") ? $CurrentForm->getValue("type") : $CurrentForm->getValue("x_type");
		if (!$this->type->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->type->Visible = FALSE; // Disable update for API request
			else
				$this->type->setFormValue($val);
		}

		// Check field name 'section' first before field var 'x_section'
		$val = $CurrentForm->hasValue("section") ? $CurrentForm->getValue("section") : $CurrentForm->getValue("x_section");
		if (!$this->section->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->section->Visible = FALSE; // Disable update for API request
			else
				$this->section->setFormValue($val);
		}

		// Check field name 'active' first before field var 'x_active'
		$val = $CurrentForm->hasValue("active") ? $CurrentForm->getValue("active") : $CurrentForm->getValue("x_active");
		if (!$this->active->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->active->Visible = FALSE; // Disable update for API request
			else
				$this->active->setFormValue($val);
		}

		// Check field name 'has_recommendations' first before field var 'x_has_recommendations'
		$val = $CurrentForm->hasValue("has_recommendations") ? $CurrentForm->getValue("has_recommendations") : $CurrentForm->getValue("x_has_recommendations");
		if (!$this->has_recommendations->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->has_recommendations->Visible = FALSE; // Disable update for API request
			else
				$this->has_recommendations->setFormValue($val);
		}

		// Check field name 'group' first before field var 'x_group'
		$val = $CurrentForm->hasValue("group") ? $CurrentForm->getValue("group") : $CurrentForm->getValue("x_group");
		if (!$this->group->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->group->Visible = FALSE; // Disable update for API request
			else
				$this->group->setFormValue($val);
		}

		// Check field name 'category' first before field var 'x_category'
		$val = $CurrentForm->hasValue("category") ? $CurrentForm->getValue("category") : $CurrentForm->getValue("x_category");
		if (!$this->category->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->category->Visible = FALSE; // Disable update for API request
			else
				$this->category->setFormValue($val);
		}

		// Check field name 'order' first before field var 'x_order'
		$val = $CurrentForm->hasValue("order") ? $CurrentForm->getValue("order") : $CurrentForm->getValue("x_order");
		if (!$this->order->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->order->Visible = FALSE; // Disable update for API request
			else
				$this->order->setFormValue($val);
		}

		// Check field name 'recommendation_by_score' first before field var 'x_recommendation_by_score'
		$val = $CurrentForm->hasValue("recommendation_by_score") ? $CurrentForm->getValue("recommendation_by_score") : $CurrentForm->getValue("x_recommendation_by_score");
		if (!$this->recommendation_by_score->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->recommendation_by_score->Visible = FALSE; // Disable update for API request
			else
				$this->recommendation_by_score->setFormValue($val);
		}

		// Check field name 'recommendation_score' first before field var 'x_recommendation_score'
		$val = $CurrentForm->hasValue("recommendation_score") ? $CurrentForm->getValue("recommendation_score") : $CurrentForm->getValue("x_recommendation_score");
		if (!$this->recommendation_score->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->recommendation_score->Visible = FALSE; // Disable update for API request
			else
				$this->recommendation_score->setFormValue($val);
		}

		// Check field name 'related' first before field var 'x_related'
		$val = $CurrentForm->hasValue("related") ? $CurrentForm->getValue("related") : $CurrentForm->getValue("x_related");
		if (!$this->related->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->related->Visible = FALSE; // Disable update for API request
			else
				$this->related->setFormValue($val);
		}

		// Check field name 'trigger_related_val' first before field var 'x_trigger_related_val'
		$val = $CurrentForm->hasValue("trigger_related_val") ? $CurrentForm->getValue("trigger_related_val") : $CurrentForm->getValue("x_trigger_related_val");
		if (!$this->trigger_related_val->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->trigger_related_val->Visible = FALSE; // Disable update for API request
			else
				$this->trigger_related_val->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->title->CurrentValue = $this->title->FormValue;
		$this->placeholder->CurrentValue = $this->placeholder->FormValue;
		$this->questions->CurrentValue = $this->questions->FormValue;
		$this->scores->CurrentValue = $this->scores->FormValue;
		$this->type->CurrentValue = $this->type->FormValue;
		$this->section->CurrentValue = $this->section->FormValue;
		$this->active->CurrentValue = $this->active->FormValue;
		$this->has_recommendations->CurrentValue = $this->has_recommendations->FormValue;
		$this->group->CurrentValue = $this->group->FormValue;
		$this->category->CurrentValue = $this->category->FormValue;
		$this->order->CurrentValue = $this->order->FormValue;
		$this->recommendation_by_score->CurrentValue = $this->recommendation_by_score->FormValue;
		$this->recommendation_score->CurrentValue = $this->recommendation_score->FormValue;
		$this->related->CurrentValue = $this->related->FormValue;
		$this->trigger_related_val->CurrentValue = $this->trigger_related_val->FormValue;
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
		$this->title->setDbValue($row['title']);
		$this->placeholder->setDbValue($row['placeholder']);
		$this->questions->setDbValue($row['questions']);
		$this->scores->setDbValue($row['scores']);
		$this->type->setDbValue($row['type']);
		$this->section->setDbValue($row['section']);
		$this->active->setDbValue($row['active']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->has_recommendations->setDbValue($row['has_recommendations']);
		$this->group->setDbValue($row['group']);
		$this->category->setDbValue($row['category']);
		$this->order->setDbValue($row['order']);
		$this->recommendation_by_score->setDbValue($row['recommendation_by_score']);
		$this->recommendation_score->setDbValue($row['recommendation_score']);
		$this->related->setDbValue($row['related']);
		$this->trigger_related_val->setDbValue($row['trigger_related_val']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['title'] = NULL;
		$row['placeholder'] = NULL;
		$row['questions'] = NULL;
		$row['scores'] = NULL;
		$row['type'] = NULL;
		$row['section'] = NULL;
		$row['active'] = NULL;
		$row['created_at'] = NULL;
		$row['updated_at'] = NULL;
		$row['has_recommendations'] = NULL;
		$row['group'] = NULL;
		$row['category'] = NULL;
		$row['order'] = NULL;
		$row['recommendation_by_score'] = NULL;
		$row['recommendation_score'] = NULL;
		$row['related'] = NULL;
		$row['trigger_related_val'] = NULL;
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

		if ($this->recommendation_score->FormValue == $this->recommendation_score->CurrentValue && is_numeric(ConvertToFloatString($this->recommendation_score->CurrentValue)))
			$this->recommendation_score->CurrentValue = ConvertToFloatString($this->recommendation_score->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// title
			$this->title->EditAttrs["class"] = "form-control";
			$this->title->EditCustomAttributes = "";
			if (!$this->title->Raw)
				$this->title->CurrentValue = HtmlDecode($this->title->CurrentValue);
			$this->title->EditValue = HtmlEncode($this->title->CurrentValue);
			$this->title->PlaceHolder = RemoveHtml($this->title->caption());

			// placeholder
			$this->placeholder->EditAttrs["class"] = "form-control";
			$this->placeholder->EditCustomAttributes = "";
			$this->placeholder->EditValue = HtmlEncode($this->placeholder->CurrentValue);
			$this->placeholder->PlaceHolder = RemoveHtml($this->placeholder->caption());

			// questions
			$this->questions->EditAttrs["class"] = "form-control";
			$this->questions->EditCustomAttributes = "";
			$this->questions->EditValue = HtmlEncode($this->questions->CurrentValue);
			$this->questions->PlaceHolder = RemoveHtml($this->questions->caption());

			// scores
			$this->scores->EditAttrs["class"] = "form-control";
			$this->scores->EditCustomAttributes = "";
			$this->scores->EditValue = HtmlEncode($this->scores->CurrentValue);
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
				$curVal = trim(strval($this->type->CurrentValue));
				if ($curVal != "")
					$this->type->ViewValue = $this->type->lookupCacheOption($curVal);
				else
					$this->type->ViewValue = $this->type->Lookup !== NULL && is_array($this->type->Lookup->Options) ? $curVal : NULL;
				if ($this->type->ViewValue !== NULL) { // Load from cache
					$this->type->EditValue = array_values($this->type->Lookup->Options);
					if ($this->type->ViewValue == "")
						$this->type->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`id`" . SearchString("=", $this->type->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->type->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->type->ViewValue = $this->type->displayValue($arwrk);
					} else {
						$this->type->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->type->EditValue = $arwrk;
				}
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
				$this->section->EditValue = HtmlEncode($this->section->CurrentValue);
				$curVal = strval($this->section->CurrentValue);
				if ($curVal != "") {
					$this->section->EditValue = $this->section->lookupCacheOption($curVal);
					if ($this->section->EditValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->section->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode(FormatNumber($rswrk->fields('df'), 0, -2, -2, -2));
							$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
							$this->section->EditValue = $this->section->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->section->EditValue = HtmlEncode($this->section->CurrentValue);
						}
					}
				} else {
					$this->section->EditValue = NULL;
				}
				$this->section->PlaceHolder = RemoveHtml($this->section->caption());
			}

			// active
			$this->active->EditCustomAttributes = "";
			$this->active->EditValue = $this->active->options(FALSE);

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
				$curVal = trim(strval($this->group->CurrentValue));
				if ($curVal != "")
					$this->group->ViewValue = $this->group->lookupCacheOption($curVal);
				else
					$this->group->ViewValue = $this->group->Lookup !== NULL && is_array($this->group->Lookup->Options) ? $curVal : NULL;
				if ($this->group->ViewValue !== NULL) { // Load from cache
					$this->group->EditValue = array_values($this->group->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`id`" . SearchString("=", $this->group->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->group->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->group->EditValue = $arwrk;
				}
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
				$curVal = trim(strval($this->category->CurrentValue));
				if ($curVal != "")
					$this->category->ViewValue = $this->category->lookupCacheOption($curVal);
				else
					$this->category->ViewValue = $this->category->Lookup !== NULL && is_array($this->category->Lookup->Options) ? $curVal : NULL;
				if ($this->category->ViewValue !== NULL) { // Load from cache
					$this->category->EditValue = array_values($this->category->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`id`" . SearchString("=", $this->category->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->category->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->category->EditValue = $arwrk;
				}
			}

			// order
			$this->order->EditAttrs["class"] = "form-control";
			$this->order->EditCustomAttributes = "";
			$this->order->EditValue = HtmlEncode($this->order->CurrentValue);
			$this->order->PlaceHolder = RemoveHtml($this->order->caption());

			// recommendation_by_score
			$this->recommendation_by_score->EditAttrs["class"] = "form-control";
			$this->recommendation_by_score->EditCustomAttributes = "";
			$this->recommendation_by_score->EditValue = HtmlEncode($this->recommendation_by_score->CurrentValue);
			$this->recommendation_by_score->PlaceHolder = RemoveHtml($this->recommendation_by_score->caption());

			// recommendation_score
			$this->recommendation_score->EditAttrs["class"] = "form-control";
			$this->recommendation_score->EditCustomAttributes = "";
			$this->recommendation_score->EditValue = HtmlEncode($this->recommendation_score->CurrentValue);
			$this->recommendation_score->PlaceHolder = RemoveHtml($this->recommendation_score->caption());
			if (strval($this->recommendation_score->EditValue) != "" && is_numeric($this->recommendation_score->EditValue))
				$this->recommendation_score->EditValue = FormatNumber($this->recommendation_score->EditValue, -2, -2, -2, -2);
			

			// related
			$this->related->EditAttrs["class"] = "form-control";
			$this->related->EditCustomAttributes = "";
			$this->related->EditValue = HtmlEncode($this->related->CurrentValue);
			$this->related->PlaceHolder = RemoveHtml($this->related->caption());

			// trigger_related_val
			$this->trigger_related_val->EditAttrs["class"] = "form-control";
			$this->trigger_related_val->EditCustomAttributes = "";
			if (!$this->trigger_related_val->Raw)
				$this->trigger_related_val->CurrentValue = HtmlDecode($this->trigger_related_val->CurrentValue);
			$this->trigger_related_val->EditValue = HtmlEncode($this->trigger_related_val->CurrentValue);
			$this->trigger_related_val->PlaceHolder = RemoveHtml($this->trigger_related_val->caption());

			// Edit refer script
			// title

			$this->title->LinkCustomAttributes = "";
			$this->title->HrefValue = "";

			// placeholder
			$this->placeholder->LinkCustomAttributes = "";
			$this->placeholder->HrefValue = "";

			// questions
			$this->questions->LinkCustomAttributes = "";
			$this->questions->HrefValue = "";

			// scores
			$this->scores->LinkCustomAttributes = "";
			$this->scores->HrefValue = "";

			// type
			$this->type->LinkCustomAttributes = "";
			$this->type->HrefValue = "";

			// section
			$this->section->LinkCustomAttributes = "";
			$this->section->HrefValue = "";

			// active
			$this->active->LinkCustomAttributes = "";
			$this->active->HrefValue = "";

			// has_recommendations
			$this->has_recommendations->LinkCustomAttributes = "";
			$this->has_recommendations->HrefValue = "";

			// group
			$this->group->LinkCustomAttributes = "";
			$this->group->HrefValue = "";

			// category
			$this->category->LinkCustomAttributes = "";
			$this->category->HrefValue = "";

			// order
			$this->order->LinkCustomAttributes = "";
			$this->order->HrefValue = "";

			// recommendation_by_score
			$this->recommendation_by_score->LinkCustomAttributes = "";
			$this->recommendation_by_score->HrefValue = "";

			// recommendation_score
			$this->recommendation_score->LinkCustomAttributes = "";
			$this->recommendation_score->HrefValue = "";

			// related
			$this->related->LinkCustomAttributes = "";
			$this->related->HrefValue = "";

			// trigger_related_val
			$this->trigger_related_val->LinkCustomAttributes = "";
			$this->trigger_related_val->HrefValue = "";
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
		if ($this->title->Required) {
			if (!$this->title->IsDetailKey && $this->title->FormValue != NULL && $this->title->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->title->caption(), $this->title->RequiredErrorMessage));
			}
		}
		if ($this->placeholder->Required) {
			if (!$this->placeholder->IsDetailKey && $this->placeholder->FormValue != NULL && $this->placeholder->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->placeholder->caption(), $this->placeholder->RequiredErrorMessage));
			}
		}
		if ($this->questions->Required) {
			if (!$this->questions->IsDetailKey && $this->questions->FormValue != NULL && $this->questions->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->questions->caption(), $this->questions->RequiredErrorMessage));
			}
		}
		if ($this->scores->Required) {
			if (!$this->scores->IsDetailKey && $this->scores->FormValue != NULL && $this->scores->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->scores->caption(), $this->scores->RequiredErrorMessage));
			}
		}
		if ($this->type->Required) {
			if (!$this->type->IsDetailKey && $this->type->FormValue != NULL && $this->type->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->type->caption(), $this->type->RequiredErrorMessage));
			}
		}
		if ($this->section->Required) {
			if (!$this->section->IsDetailKey && $this->section->FormValue != NULL && $this->section->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->section->caption(), $this->section->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->section->FormValue)) {
			AddMessage($FormError, $this->section->errorMessage());
		}
		if ($this->active->Required) {
			if ($this->active->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->active->caption(), $this->active->RequiredErrorMessage));
			}
		}
		if ($this->has_recommendations->Required) {
			if ($this->has_recommendations->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->has_recommendations->caption(), $this->has_recommendations->RequiredErrorMessage));
			}
		}
		if ($this->group->Required) {
			if (!$this->group->IsDetailKey && $this->group->FormValue != NULL && $this->group->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->group->caption(), $this->group->RequiredErrorMessage));
			}
		}
		if ($this->category->Required) {
			if (!$this->category->IsDetailKey && $this->category->FormValue != NULL && $this->category->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->category->caption(), $this->category->RequiredErrorMessage));
			}
		}
		if ($this->order->Required) {
			if (!$this->order->IsDetailKey && $this->order->FormValue != NULL && $this->order->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->order->caption(), $this->order->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->order->FormValue)) {
			AddMessage($FormError, $this->order->errorMessage());
		}
		if ($this->recommendation_by_score->Required) {
			if (!$this->recommendation_by_score->IsDetailKey && $this->recommendation_by_score->FormValue != NULL && $this->recommendation_by_score->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->recommendation_by_score->caption(), $this->recommendation_by_score->RequiredErrorMessage));
			}
		}
		if ($this->recommendation_score->Required) {
			if (!$this->recommendation_score->IsDetailKey && $this->recommendation_score->FormValue != NULL && $this->recommendation_score->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->recommendation_score->caption(), $this->recommendation_score->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->recommendation_score->FormValue)) {
			AddMessage($FormError, $this->recommendation_score->errorMessage());
		}
		if ($this->related->Required) {
			if (!$this->related->IsDetailKey && $this->related->FormValue != NULL && $this->related->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->related->caption(), $this->related->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->related->FormValue)) {
			AddMessage($FormError, $this->related->errorMessage());
		}
		if ($this->trigger_related_val->Required) {
			if (!$this->trigger_related_val->IsDetailKey && $this->trigger_related_val->FormValue != NULL && $this->trigger_related_val->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->trigger_related_val->caption(), $this->trigger_related_val->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("answers", $detailTblVar) && $GLOBALS["answers"]->DetailEdit) {
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

			// Begin transaction
			if ($this->getCurrentDetailTable() != "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// title
			$this->title->setDbValueDef($rsnew, $this->title->CurrentValue, NULL, $this->title->ReadOnly);

			// placeholder
			$this->placeholder->setDbValueDef($rsnew, $this->placeholder->CurrentValue, NULL, $this->placeholder->ReadOnly);

			// questions
			$this->questions->setDbValueDef($rsnew, $this->questions->CurrentValue, NULL, $this->questions->ReadOnly);

			// scores
			$this->scores->setDbValueDef($rsnew, $this->scores->CurrentValue, NULL, $this->scores->ReadOnly);

			// type
			$this->type->setDbValueDef($rsnew, $this->type->CurrentValue, NULL, $this->type->ReadOnly);

			// section
			$this->section->setDbValueDef($rsnew, $this->section->CurrentValue, NULL, $this->section->ReadOnly);

			// active
			$tmpBool = $this->active->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->active->setDbValueDef($rsnew, $tmpBool, NULL, $this->active->ReadOnly);

			// has_recommendations
			$this->has_recommendations->setDbValueDef($rsnew, $this->has_recommendations->CurrentValue, NULL, $this->has_recommendations->ReadOnly);

			// group
			$this->group->setDbValueDef($rsnew, $this->group->CurrentValue, NULL, $this->group->ReadOnly);

			// category
			$this->category->setDbValueDef($rsnew, $this->category->CurrentValue, NULL, $this->category->ReadOnly);

			// order
			$this->order->setDbValueDef($rsnew, $this->order->CurrentValue, NULL, $this->order->ReadOnly);

			// recommendation_by_score
			$this->recommendation_by_score->setDbValueDef($rsnew, $this->recommendation_by_score->CurrentValue, NULL, $this->recommendation_by_score->ReadOnly);

			// recommendation_score
			$this->recommendation_score->setDbValueDef($rsnew, $this->recommendation_score->CurrentValue, NULL, $this->recommendation_score->ReadOnly);

			// related
			$this->related->setDbValueDef($rsnew, $this->related->CurrentValue, NULL, $this->related->ReadOnly);

			// trigger_related_val
			$this->trigger_related_val->setDbValueDef($rsnew, $this->trigger_related_val->CurrentValue, NULL, $this->trigger_related_val->ReadOnly);

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

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("answers", $detailTblVar) && $GLOBALS["answers"]->DetailEdit) {
						if (!isset($GLOBALS["answers_grid"]))
							$GLOBALS["answers_grid"] = new answers_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "answers"); // Load user level of detail table
						$editRow = $GLOBALS["answers_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() != "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
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
			if ($masterTblVar == "question_types") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("type"))) !== NULL) {
					$GLOBALS["question_types"]->id->setQueryStringValue($parm);
					$this->type->setQueryStringValue($GLOBALS["question_types"]->id->QueryStringValue);
					$this->type->setSessionValue($this->type->QueryStringValue);
					if (!is_numeric($GLOBALS["question_types"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "sections") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("section"))) !== NULL) {
					$GLOBALS["sections"]->id->setQueryStringValue($parm);
					$this->section->setQueryStringValue($GLOBALS["sections"]->id->QueryStringValue);
					$this->section->setSessionValue($this->section->QueryStringValue);
					if (!is_numeric($GLOBALS["sections"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "question_groups") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("group"))) !== NULL) {
					$GLOBALS["question_groups"]->id->setQueryStringValue($parm);
					$this->group->setQueryStringValue($GLOBALS["question_groups"]->id->QueryStringValue);
					$this->group->setSessionValue($this->group->QueryStringValue);
					if (!is_numeric($GLOBALS["question_groups"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "question_category") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("category"))) !== NULL) {
					$GLOBALS["question_category"]->id->setQueryStringValue($parm);
					$this->category->setQueryStringValue($GLOBALS["question_category"]->id->QueryStringValue);
					$this->category->setSessionValue($this->category->QueryStringValue);
					if (!is_numeric($GLOBALS["question_category"]->id->QueryStringValue))
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
			if ($masterTblVar == "question_types") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("type"))) !== NULL) {
					$GLOBALS["question_types"]->id->setFormValue($parm);
					$this->type->setFormValue($GLOBALS["question_types"]->id->FormValue);
					$this->type->setSessionValue($this->type->FormValue);
					if (!is_numeric($GLOBALS["question_types"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "sections") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("section"))) !== NULL) {
					$GLOBALS["sections"]->id->setFormValue($parm);
					$this->section->setFormValue($GLOBALS["sections"]->id->FormValue);
					$this->section->setSessionValue($this->section->FormValue);
					if (!is_numeric($GLOBALS["sections"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "question_groups") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("group"))) !== NULL) {
					$GLOBALS["question_groups"]->id->setFormValue($parm);
					$this->group->setFormValue($GLOBALS["question_groups"]->id->FormValue);
					$this->group->setSessionValue($this->group->FormValue);
					if (!is_numeric($GLOBALS["question_groups"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "question_category") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("category"))) !== NULL) {
					$GLOBALS["question_category"]->id->setFormValue($parm);
					$this->category->setFormValue($GLOBALS["question_category"]->id->FormValue);
					$this->category->setSessionValue($this->category->FormValue);
					if (!is_numeric($GLOBALS["question_category"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "question_types") {
				if ($this->type->CurrentValue == "")
					$this->type->setSessionValue("");
			}
			if ($masterTblVar != "sections") {
				if ($this->section->CurrentValue == "")
					$this->section->setSessionValue("");
			}
			if ($masterTblVar != "question_groups") {
				if ($this->group->CurrentValue == "")
					$this->group->setSessionValue("");
			}
			if ($masterTblVar != "question_category") {
				if ($this->category->CurrentValue == "")
					$this->category->setSessionValue("");
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
			if (in_array("answers", $detailTblVar)) {
				if (!isset($GLOBALS["answers_grid"]))
					$GLOBALS["answers_grid"] = new answers_grid();
				if ($GLOBALS["answers_grid"]->DetailEdit) {
					$GLOBALS["answers_grid"]->CurrentMode = "edit";
					$GLOBALS["answers_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["answers_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["answers_grid"]->setStartRecordNumber(1);
					$GLOBALS["answers_grid"]->question_id->IsDetailKey = TRUE;
					$GLOBALS["answers_grid"]->question_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["answers_grid"]->question_id->setSessionValue($GLOBALS["answers_grid"]->question_id->CurrentValue);
					$GLOBALS["answers_grid"]->assessment_id->setSessionValue(""); // Clear session key
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("questionslist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
				case "x_type":
					break;
				case "x_section":
					break;
				case "x_active":
					break;
				case "x_has_recommendations":
					break;
				case "x_group":
					break;
				case "x_category":
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
						case "x_type":
							break;
						case "x_section":
							$row[1] = FormatNumber($row[1], 0, -2, -2, -2);
							$row['df'] = $row[1];
							break;
						case "x_group":
							break;
						case "x_category":
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
} // End class
?>
<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

/**
 * Page class
 */
class questions_answers_search extends questions_answers
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{98C27E89-2937-4D47-9B89-35CA334C4E82}";

	// Table name
	public $TableName = 'questions-answers';

	// Page object name
	public $PageObjName = "questions_answers_search";

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

		// Table object (assessments)
		if (!isset($GLOBALS['assessments']))
			$GLOBALS['assessments'] = new assessments();

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "questions_answersview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

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
			if (!$Security->canSearch()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("questions_answerslist.php"));
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
		$this->answer_recommendations->setVisibility();
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
		$this->setupLookupOptions($this->question_section_id);
		$this->setupLookupOptions($this->question_type);
		$this->setupLookupOptions($this->question_group_id);
		$this->setupLookupOptions($this->question_category_id);
		$this->setupLookupOptions($this->assessment_id);

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr != "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "questions_answerslist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->question_id); // question_id
		$this->buildSearchUrl($srchUrl, $this->question_title); // question_title
		$this->buildSearchUrl($srchUrl, $this->question_placeholder); // question_placeholder
		$this->buildSearchUrl($srchUrl, $this->question_questions); // question_questions
		$this->buildSearchUrl($srchUrl, $this->question_scores); // question_scores
		$this->buildSearchUrl($srchUrl, $this->question_active, TRUE); // question_active
		$this->buildSearchUrl($srchUrl, $this->question_section_id); // question_section_id
		$this->buildSearchUrl($srchUrl, $this->question_type); // question_type
		$this->buildSearchUrl($srchUrl, $this->question_has_recommendations); // question_has_recommendations
		$this->buildSearchUrl($srchUrl, $this->question_group_id); // question_group_id
		$this->buildSearchUrl($srchUrl, $this->question_category_id); // question_category_id
		$this->buildSearchUrl($srchUrl, $this->question_order); // question_order
		$this->buildSearchUrl($srchUrl, $this->answer_id); // answer_id
		$this->buildSearchUrl($srchUrl, $this->answer_response); // answer_response
		$this->buildSearchUrl($srchUrl, $this->answer_score); // answer_score
		$this->buildSearchUrl($srchUrl, $this->assessment_id); // assessment_id
		$this->buildSearchUrl($srchUrl, $this->answer_weight); // answer_weight
		$this->buildSearchUrl($srchUrl, $this->answer_section_id); // answer_section_id
		$this->buildSearchUrl($srchUrl, $this->answer_recommendations); // answer_recommendations
		$this->buildSearchUrl($srchUrl, $this->question_type_name); // question_type_name
		$this->buildSearchUrl($srchUrl, $this->question_group_name); // question_group_name
		$this->buildSearchUrl($srchUrl, $this->question_category_name); // question_category_name
		$this->buildSearchUrl($srchUrl, $this->assessment_customer_id); // assessment_customer_id
		$this->buildSearchUrl($srchUrl, $this->assessment_customer_first_name); // assessment_customer_first_name
		$this->buildSearchUrl($srchUrl, $this->assessment_status); // assessment_status
		$this->buildSearchUrl($srchUrl, $this->assessment_total_score); // assessment_total_score
		$this->buildSearchUrl($srchUrl, $this->assessment_customer_last_name); // assessment_customer_last_name
		$this->buildSearchUrl($srchUrl, $this->assessment_user_id); // assessment_user_id
		$this->buildSearchUrl($srchUrl, $this->assessment_user_first_name); // assessment_user_first_name
		$this->buildSearchUrl($srchUrl, $this->assessment_user_last_name); // assessment_user_last_name
		$this->buildSearchUrl($srchUrl, $this->assessment_user_email); // assessment_user_email
		$this->buildSearchUrl($srchUrl, $this->assessment_personal_id); // assessment_personal_id
		$this->buildSearchUrl($srchUrl, $this->assessment_customer_age); // assessment_customer_age
		$this->buildSearchUrl($srchUrl, $this->assessment_sex); // assessment_sex
		$this->buildSearchUrl($srchUrl, $this->assessment_address); // assessment_address
		$this->buildSearchUrl($srchUrl, $this->assessment_lat); // assessment_lat
		$this->buildSearchUrl($srchUrl, $this->assessment_lon); // assessment_lon
		$this->buildSearchUrl($srchUrl, $this->assessment_loan_purpose); // assessment_loan_purpose
		$this->buildSearchUrl($srchUrl, $this->assessment_loan_section); // assessment_loan_section
		$this->buildSearchUrl($srchUrl, $this->created_at); // created_at
		$this->buildSearchUrl($srchUrl, $this->updated_at); // updated_at
		$this->buildSearchUrl($srchUrl, $this->loan_purpose_id); // loan_purpose_id
		$this->buildSearchUrl($srchUrl, $this->loan_sector_id); // loan_sector_id
		if ($srchUrl != "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk != "") {
			if ($url != "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;
		if ($this->question_id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->question_title->AdvancedSearch->post())
			$got = TRUE;
		if ($this->question_placeholder->AdvancedSearch->post())
			$got = TRUE;
		if ($this->question_questions->AdvancedSearch->post())
			$got = TRUE;
		if ($this->question_scores->AdvancedSearch->post())
			$got = TRUE;
		if ($this->question_active->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->question_active->AdvancedSearch->SearchValue))
			$this->question_active->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->question_active->AdvancedSearch->SearchValue);
		if (is_array($this->question_active->AdvancedSearch->SearchValue2))
			$this->question_active->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->question_active->AdvancedSearch->SearchValue2);
		if ($this->question_section_id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->question_type->AdvancedSearch->post())
			$got = TRUE;
		if ($this->question_has_recommendations->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->question_has_recommendations->AdvancedSearch->SearchValue))
			$this->question_has_recommendations->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->question_has_recommendations->AdvancedSearch->SearchValue);
		if (is_array($this->question_has_recommendations->AdvancedSearch->SearchValue2))
			$this->question_has_recommendations->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->question_has_recommendations->AdvancedSearch->SearchValue2);
		if ($this->question_group_id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->question_category_id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->question_order->AdvancedSearch->post())
			$got = TRUE;
		if ($this->answer_id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->answer_response->AdvancedSearch->post())
			$got = TRUE;
		if ($this->answer_score->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->answer_weight->AdvancedSearch->post())
			$got = TRUE;
		if ($this->answer_section_id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->answer_recommendations->AdvancedSearch->post())
			$got = TRUE;
		if ($this->question_type_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->question_group_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->question_category_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_customer_id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_customer_first_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_status->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_total_score->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_customer_last_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_user_id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_user_first_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_user_last_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_user_email->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_personal_id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_customer_age->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_sex->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_address->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_lat->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_lon->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_loan_purpose->AdvancedSearch->post())
			$got = TRUE;
		if ($this->assessment_loan_section->AdvancedSearch->post())
			$got = TRUE;
		if ($this->created_at->AdvancedSearch->post())
			$got = TRUE;
		if ($this->updated_at->AdvancedSearch->post())
			$got = TRUE;
		if ($this->loan_purpose_id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->loan_sector_id->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
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

			// answer_recommendations
			$this->answer_recommendations->ViewValue = $this->answer_recommendations->CurrentValue;
			$this->answer_recommendations->ViewCustomAttributes = "";

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

			// answer_recommendations
			$this->answer_recommendations->LinkCustomAttributes = "";
			$this->answer_recommendations->HrefValue = "";
			$this->answer_recommendations->TooltipValue = "";

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
			$curVal = trim(strval($this->question_type->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->question_type->AdvancedSearch->ViewValue = $this->question_type->lookupCacheOption($curVal);
			else
				$this->question_type->AdvancedSearch->ViewValue = $this->question_type->Lookup !== NULL && is_array($this->question_type->Lookup->Options) ? $curVal : NULL;
			if ($this->question_type->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->question_type->EditValue = array_values($this->question_type->Lookup->Options);
				if ($this->question_type->AdvancedSearch->ViewValue == "")
					$this->question_type->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->question_type->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->question_type->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->question_type->AdvancedSearch->ViewValue = $this->question_type->displayValue($arwrk);
				} else {
					$this->question_type->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->question_type->EditValue = $arwrk;
			}

			// question_has_recommendations
			$this->question_has_recommendations->EditCustomAttributes = "";
			$this->question_has_recommendations->EditValue = $this->question_has_recommendations->options(FALSE);

			// question_group_id
			$this->question_group_id->EditAttrs["class"] = "form-control";
			$this->question_group_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->question_group_id->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->question_group_id->AdvancedSearch->ViewValue = $this->question_group_id->lookupCacheOption($curVal);
			else
				$this->question_group_id->AdvancedSearch->ViewValue = $this->question_group_id->Lookup !== NULL && is_array($this->question_group_id->Lookup->Options) ? $curVal : NULL;
			if ($this->question_group_id->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->question_group_id->EditValue = array_values($this->question_group_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->question_group_id->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->question_group_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->question_group_id->EditValue = $arwrk;
			}

			// question_category_id
			$this->question_category_id->EditAttrs["class"] = "form-control";
			$this->question_category_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->question_category_id->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->question_category_id->AdvancedSearch->ViewValue = $this->question_category_id->lookupCacheOption($curVal);
			else
				$this->question_category_id->AdvancedSearch->ViewValue = $this->question_category_id->Lookup !== NULL && is_array($this->question_category_id->Lookup->Options) ? $curVal : NULL;
			if ($this->question_category_id->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->question_category_id->EditValue = array_values($this->question_category_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->question_category_id->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->question_category_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->question_category_id->EditValue = $arwrk;
			}

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

			// answer_recommendations
			$this->answer_recommendations->EditAttrs["class"] = "form-control";
			$this->answer_recommendations->EditCustomAttributes = "";
			$this->answer_recommendations->EditValue = HtmlEncode($this->answer_recommendations->AdvancedSearch->SearchValue);
			$this->answer_recommendations->PlaceHolder = RemoveHtml($this->answer_recommendations->caption());

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
		if (!CheckInteger($this->question_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->question_id->errorMessage());
		}
		if (!CheckInteger($this->question_section_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->question_section_id->errorMessage());
		}
		if (!CheckInteger($this->question_order->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->question_order->errorMessage());
		}
		if (!CheckInteger($this->answer_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->answer_id->errorMessage());
		}
		if (!CheckNumber($this->answer_score->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->answer_score->errorMessage());
		}
		if (!CheckInteger($this->assessment_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->assessment_id->errorMessage());
		}
		if (!CheckNumber($this->answer_weight->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->answer_weight->errorMessage());
		}
		if (!CheckInteger($this->answer_section_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->answer_section_id->errorMessage());
		}
		if (!CheckInteger($this->assessment_status->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->assessment_status->errorMessage());
		}
		if (!CheckNumber($this->assessment_total_score->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->assessment_total_score->errorMessage());
		}
		if (!CheckInteger($this->assessment_user_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->assessment_user_id->errorMessage());
		}
		if (!CheckInteger($this->assessment_customer_age->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->assessment_customer_age->errorMessage());
		}
		if (!CheckNumber($this->assessment_lat->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->assessment_lat->errorMessage());
		}
		if (!CheckNumber($this->assessment_lon->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->assessment_lon->errorMessage());
		}
		if (!CheckDate($this->created_at->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->created_at->errorMessage());
		}
		if (!CheckDate($this->updated_at->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->updated_at->errorMessage());
		}
		if (!CheckInteger($this->loan_purpose_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->loan_purpose_id->errorMessage());
		}
		if (!CheckInteger($this->loan_sector_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->loan_sector_id->errorMessage());
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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("questions_answerslist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
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
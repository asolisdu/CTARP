<?php namespace PHPMaker2020\IDB_EcoMicro_BZ; ?>
<?php

/**
 * Table class for questions-answers
 */
class questions_answers extends DbTable
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
	public $question_id;
	public $question_title;
	public $question_placeholder;
	public $question_questions;
	public $question_scores;
	public $question_active;
	public $question_section_id;
	public $question_type;
	public $question_has_recommendations;
	public $question_group_id;
	public $question_category_id;
	public $question_order;
	public $answer_id;
	public $answer_response;
	public $answer_score;
	public $assessment_id;
	public $answer_weight;
	public $answer_section_id;
	public $answer_recommendations;
	public $question_type_name;
	public $question_group_name;
	public $question_category_name;
	public $assessment_customer_id;
	public $assessment_customer_first_name;
	public $assessment_status;
	public $assessment_total_score;
	public $assessment_customer_last_name;
	public $assessment_user_id;
	public $assessment_user_first_name;
	public $assessment_user_last_name;
	public $assessment_user_email;
	public $assessment_personal_id;
	public $assessment_customer_age;
	public $assessment_sex;
	public $assessment_address;
	public $assessment_lat;
	public $assessment_lon;
	public $assessment_loan_purpose;
	public $assessment_loan_section;
	public $created_at;
	public $updated_at;
	public $loan_purpose_id;
	public $loan_sector_id;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'questions_answers';
		$this->TableName = 'questions-answers';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`questions-answers`";
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

		// question_id
		$this->question_id = new DbField('questions_answers', 'questions-answers', 'x_question_id', 'question_id', '`question_id`', '`question_id`', 19, 11, -1, FALSE, '`question_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->question_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->question_id->IsPrimaryKey = TRUE; // Primary key field
		$this->question_id->Sortable = TRUE; // Allow sort
		$this->question_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['question_id'] = &$this->question_id;

		// question_title
		$this->question_title = new DbField('questions_answers', 'questions-answers', 'x_question_title', 'question_title', '`question_title`', '`question_title`', 200, 255, -1, FALSE, '`question_title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->question_title->Sortable = TRUE; // Allow sort
		$this->fields['question_title'] = &$this->question_title;

		// question_placeholder
		$this->question_placeholder = new DbField('questions_answers', 'questions-answers', 'x_question_placeholder', 'question_placeholder', '`question_placeholder`', '`question_placeholder`', 201, 512, -1, FALSE, '`question_placeholder`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->question_placeholder->Sortable = TRUE; // Allow sort
		$this->fields['question_placeholder'] = &$this->question_placeholder;

		// question_questions
		$this->question_questions = new DbField('questions_answers', 'questions-answers', 'x_question_questions', 'question_questions', '`question_questions`', '`question_questions`', 201, 1028, -1, FALSE, '`question_questions`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->question_questions->Sortable = TRUE; // Allow sort
		$this->fields['question_questions'] = &$this->question_questions;

		// question_scores
		$this->question_scores = new DbField('questions_answers', 'questions-answers', 'x_question_scores', 'question_scores', '`question_scores`', '`question_scores`', 200, 255, -1, FALSE, '`question_scores`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->question_scores->Sortable = TRUE; // Allow sort
		$this->fields['question_scores'] = &$this->question_scores;

		// question_active
		$this->question_active = new DbField('questions_answers', 'questions-answers', 'x_question_active', 'question_active', '`question_active`', '`question_active`', 16, 1, -1, FALSE, '`question_active`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->question_active->Sortable = TRUE; // Allow sort
		$this->question_active->DataType = DATATYPE_BOOLEAN;
		$this->question_active->Lookup = new Lookup('question_active', 'questions_answers', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->question_active->OptionCount = 2;
		$this->question_active->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['question_active'] = &$this->question_active;

		// question_section_id
		$this->question_section_id = new DbField('questions_answers', 'questions-answers', 'x_question_section_id', 'question_section_id', '`question_section_id`', '`question_section_id`', 19, 11, -1, FALSE, '`question_section_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->question_section_id->Sortable = TRUE; // Allow sort
		$this->question_section_id->Lookup = new Lookup('question_section_id', 'sections', FALSE, 'id', ["id","title","",""], [], [], [], [], [], [], '', '');
		$this->question_section_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['question_section_id'] = &$this->question_section_id;

		// question_type
		$this->question_type = new DbField('questions_answers', 'questions-answers', 'x_question_type', 'question_type', '`question_type`', '`question_type`', 19, 11, -1, FALSE, '`question_type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->question_type->Required = TRUE; // Required field
		$this->question_type->Sortable = TRUE; // Allow sort
		$this->question_type->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->question_type->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->question_type->Lookup = new Lookup('question_type', 'question_types', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->question_type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['question_type'] = &$this->question_type;

		// question_has_recommendations
		$this->question_has_recommendations = new DbField('questions_answers', 'questions-answers', 'x_question_has_recommendations', 'question_has_recommendations', '`question_has_recommendations`', '`question_has_recommendations`', 3, 11, -1, FALSE, '`question_has_recommendations`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->question_has_recommendations->Sortable = TRUE; // Allow sort
		$this->question_has_recommendations->Lookup = new Lookup('question_has_recommendations', 'questions_answers', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->question_has_recommendations->OptionCount = 2;
		$this->question_has_recommendations->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['question_has_recommendations'] = &$this->question_has_recommendations;

		// question_group_id
		$this->question_group_id = new DbField('questions_answers', 'questions-answers', 'x_question_group_id', 'question_group_id', '`question_group_id`', '`question_group_id`', 19, 10, -1, FALSE, '`question_group_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->question_group_id->Sortable = TRUE; // Allow sort
		$this->question_group_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->question_group_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->question_group_id->Lookup = new Lookup('question_group_id', 'question_groups', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->question_group_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['question_group_id'] = &$this->question_group_id;

		// question_category_id
		$this->question_category_id = new DbField('questions_answers', 'questions-answers', 'x_question_category_id', 'question_category_id', '`question_category_id`', '`question_category_id`', 19, 10, -1, FALSE, '`question_category_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->question_category_id->Sortable = TRUE; // Allow sort
		$this->question_category_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->question_category_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->question_category_id->Lookup = new Lookup('question_category_id', 'question_category', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->question_category_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['question_category_id'] = &$this->question_category_id;

		// question_order
		$this->question_order = new DbField('questions_answers', 'questions-answers', 'x_question_order', 'question_order', '`question_order`', '`question_order`', 3, 11, -1, FALSE, '`question_order`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->question_order->Sortable = TRUE; // Allow sort
		$this->question_order->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['question_order'] = &$this->question_order;

		// answer_id
		$this->answer_id = new DbField('questions_answers', 'questions-answers', 'x_answer_id', 'answer_id', '`answer_id`', '`answer_id`', 19, 11, -1, FALSE, '`answer_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->answer_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->answer_id->IsPrimaryKey = TRUE; // Primary key field
		$this->answer_id->Sortable = TRUE; // Allow sort
		$this->answer_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['answer_id'] = &$this->answer_id;

		// answer_response
		$this->answer_response = new DbField('questions_answers', 'questions-answers', 'x_answer_response', 'answer_response', '`answer_response`', '`answer_response`', 200, 255, -1, FALSE, '`answer_response`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->answer_response->Sortable = TRUE; // Allow sort
		$this->fields['answer_response'] = &$this->answer_response;

		// answer_score
		$this->answer_score = new DbField('questions_answers', 'questions-answers', 'x_answer_score', 'answer_score', '`answer_score`', '`answer_score`', 131, 5, -1, FALSE, '`answer_score`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->answer_score->Sortable = TRUE; // Allow sort
		$this->answer_score->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['answer_score'] = &$this->answer_score;

		// assessment_id
		$this->assessment_id = new DbField('questions_answers', 'questions-answers', 'x_assessment_id', 'assessment_id', '`assessment_id`', '`assessment_id`', 19, 11, -1, FALSE, '`assessment_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_id->Nullable = FALSE; // NOT NULL field
		$this->assessment_id->Required = TRUE; // Required field
		$this->assessment_id->Sortable = TRUE; // Allow sort
		$this->assessment_id->Lookup = new Lookup('assessment_id', 'assessments', FALSE, 'id', ["id","","",""], [], [], [], [], [], [], '', '');
		$this->assessment_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['assessment_id'] = &$this->assessment_id;

		// answer_weight
		$this->answer_weight = new DbField('questions_answers', 'questions-answers', 'x_answer_weight', 'answer_weight', '`answer_weight`', '`answer_weight`', 131, 5, -1, FALSE, '`answer_weight`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->answer_weight->Sortable = TRUE; // Allow sort
		$this->answer_weight->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['answer_weight'] = &$this->answer_weight;

		// answer_section_id
		$this->answer_section_id = new DbField('questions_answers', 'questions-answers', 'x_answer_section_id', 'answer_section_id', '`answer_section_id`', '`answer_section_id`', 19, 11, -1, FALSE, '`answer_section_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->answer_section_id->Nullable = FALSE; // NOT NULL field
		$this->answer_section_id->Required = TRUE; // Required field
		$this->answer_section_id->Sortable = TRUE; // Allow sort
		$this->answer_section_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['answer_section_id'] = &$this->answer_section_id;

		// answer_recommendations
		$this->answer_recommendations = new DbField('questions_answers', 'questions-answers', 'x_answer_recommendations', 'answer_recommendations', '`answer_recommendations`', '`answer_recommendations`', 201, 65535, -1, FALSE, '`answer_recommendations`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->answer_recommendations->Sortable = TRUE; // Allow sort
		$this->fields['answer_recommendations'] = &$this->answer_recommendations;

		// question_type_name
		$this->question_type_name = new DbField('questions_answers', 'questions-answers', 'x_question_type_name', 'question_type_name', '`question_type_name`', '`question_type_name`', 200, 255, -1, FALSE, '`question_type_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->question_type_name->Sortable = TRUE; // Allow sort
		$this->fields['question_type_name'] = &$this->question_type_name;

		// question_group_name
		$this->question_group_name = new DbField('questions_answers', 'questions-answers', 'x_question_group_name', 'question_group_name', '`question_group_name`', '`question_group_name`', 200, 255, -1, FALSE, '`question_group_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->question_group_name->Nullable = FALSE; // NOT NULL field
		$this->question_group_name->Required = TRUE; // Required field
		$this->question_group_name->Sortable = TRUE; // Allow sort
		$this->fields['question_group_name'] = &$this->question_group_name;

		// question_category_name
		$this->question_category_name = new DbField('questions_answers', 'questions-answers', 'x_question_category_name', 'question_category_name', '`question_category_name`', '`question_category_name`', 200, 255, -1, FALSE, '`question_category_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->question_category_name->Nullable = FALSE; // NOT NULL field
		$this->question_category_name->Required = TRUE; // Required field
		$this->question_category_name->Sortable = TRUE; // Allow sort
		$this->fields['question_category_name'] = &$this->question_category_name;

		// assessment_customer_id
		$this->assessment_customer_id = new DbField('questions_answers', 'questions-answers', 'x_assessment_customer_id', 'assessment_customer_id', '`assessment_customer_id`', '`assessment_customer_id`', 200, 255, -1, FALSE, '`assessment_customer_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_customer_id->Sortable = TRUE; // Allow sort
		$this->fields['assessment_customer_id'] = &$this->assessment_customer_id;

		// assessment_customer_first_name
		$this->assessment_customer_first_name = new DbField('questions_answers', 'questions-answers', 'x_assessment_customer_first_name', 'assessment_customer_first_name', '`assessment_customer_first_name`', '`assessment_customer_first_name`', 200, 255, -1, FALSE, '`assessment_customer_first_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_customer_first_name->Sortable = TRUE; // Allow sort
		$this->fields['assessment_customer_first_name'] = &$this->assessment_customer_first_name;

		// assessment_status
		$this->assessment_status = new DbField('questions_answers', 'questions-answers', 'x_assessment_status', 'assessment_status', '`assessment_status`', '`assessment_status`', 3, 11, -1, FALSE, '`assessment_status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_status->Sortable = TRUE; // Allow sort
		$this->assessment_status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['assessment_status'] = &$this->assessment_status;

		// assessment_total_score
		$this->assessment_total_score = new DbField('questions_answers', 'questions-answers', 'x_assessment_total_score', 'assessment_total_score', '`assessment_total_score`', '`assessment_total_score`', 131, 10, -1, FALSE, '`assessment_total_score`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_total_score->Sortable = TRUE; // Allow sort
		$this->assessment_total_score->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['assessment_total_score'] = &$this->assessment_total_score;

		// assessment_customer_last_name
		$this->assessment_customer_last_name = new DbField('questions_answers', 'questions-answers', 'x_assessment_customer_last_name', 'assessment_customer_last_name', '`assessment_customer_last_name`', '`assessment_customer_last_name`', 200, 255, -1, FALSE, '`assessment_customer_last_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_customer_last_name->Sortable = TRUE; // Allow sort
		$this->fields['assessment_customer_last_name'] = &$this->assessment_customer_last_name;

		// assessment_user_id
		$this->assessment_user_id = new DbField('questions_answers', 'questions-answers', 'x_assessment_user_id', 'assessment_user_id', '`assessment_user_id`', '`assessment_user_id`', 19, 11, -1, FALSE, '`assessment_user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_user_id->Nullable = FALSE; // NOT NULL field
		$this->assessment_user_id->Required = TRUE; // Required field
		$this->assessment_user_id->Sortable = TRUE; // Allow sort
		$this->assessment_user_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['assessment_user_id'] = &$this->assessment_user_id;

		// assessment_user_first_name
		$this->assessment_user_first_name = new DbField('questions_answers', 'questions-answers', 'x_assessment_user_first_name', 'assessment_user_first_name', '`assessment_user_first_name`', '`assessment_user_first_name`', 200, 255, -1, FALSE, '`assessment_user_first_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_user_first_name->Sortable = TRUE; // Allow sort
		$this->fields['assessment_user_first_name'] = &$this->assessment_user_first_name;

		// assessment_user_last_name
		$this->assessment_user_last_name = new DbField('questions_answers', 'questions-answers', 'x_assessment_user_last_name', 'assessment_user_last_name', '`assessment_user_last_name`', '`assessment_user_last_name`', 200, 255, -1, FALSE, '`assessment_user_last_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_user_last_name->Sortable = TRUE; // Allow sort
		$this->fields['assessment_user_last_name'] = &$this->assessment_user_last_name;

		// assessment_user_email
		$this->assessment_user_email = new DbField('questions_answers', 'questions-answers', 'x_assessment_user_email', 'assessment_user_email', '`assessment_user_email`', '`assessment_user_email`', 200, 255, -1, FALSE, '`assessment_user_email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_user_email->Sortable = TRUE; // Allow sort
		$this->fields['assessment_user_email'] = &$this->assessment_user_email;

		// assessment_personal_id
		$this->assessment_personal_id = new DbField('questions_answers', 'questions-answers', 'x_assessment_personal_id', 'assessment_personal_id', '`assessment_personal_id`', '`assessment_personal_id`', 200, 255, -1, FALSE, '`assessment_personal_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_personal_id->Sortable = TRUE; // Allow sort
		$this->fields['assessment_personal_id'] = &$this->assessment_personal_id;

		// assessment_customer_age
		$this->assessment_customer_age = new DbField('questions_answers', 'questions-answers', 'x_assessment_customer_age', 'assessment_customer_age', '`assessment_customer_age`', '`assessment_customer_age`', 3, 11, -1, FALSE, '`assessment_customer_age`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_customer_age->Sortable = TRUE; // Allow sort
		$this->assessment_customer_age->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['assessment_customer_age'] = &$this->assessment_customer_age;

		// assessment_sex
		$this->assessment_sex = new DbField('questions_answers', 'questions-answers', 'x_assessment_sex', 'assessment_sex', '`assessment_sex`', '`assessment_sex`', 200, 1, -1, FALSE, '`assessment_sex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_sex->Sortable = TRUE; // Allow sort
		$this->fields['assessment_sex'] = &$this->assessment_sex;

		// assessment_address
		$this->assessment_address = new DbField('questions_answers', 'questions-answers', 'x_assessment_address', 'assessment_address', '`assessment_address`', '`assessment_address`', 200, 255, -1, FALSE, '`assessment_address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_address->Sortable = TRUE; // Allow sort
		$this->fields['assessment_address'] = &$this->assessment_address;

		// assessment_lat
		$this->assessment_lat = new DbField('questions_answers', 'questions-answers', 'x_assessment_lat', 'assessment_lat', '`assessment_lat`', '`assessment_lat`', 131, 10, -1, FALSE, '`assessment_lat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_lat->Sortable = TRUE; // Allow sort
		$this->assessment_lat->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['assessment_lat'] = &$this->assessment_lat;

		// assessment_lon
		$this->assessment_lon = new DbField('questions_answers', 'questions-answers', 'x_assessment_lon', 'assessment_lon', '`assessment_lon`', '`assessment_lon`', 131, 10, -1, FALSE, '`assessment_lon`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_lon->Sortable = TRUE; // Allow sort
		$this->assessment_lon->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['assessment_lon'] = &$this->assessment_lon;

		// assessment_loan_purpose
		$this->assessment_loan_purpose = new DbField('questions_answers', 'questions-answers', 'x_assessment_loan_purpose', 'assessment_loan_purpose', '`assessment_loan_purpose`', '`assessment_loan_purpose`', 200, 255, -1, FALSE, '`assessment_loan_purpose`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_loan_purpose->Sortable = TRUE; // Allow sort
		$this->fields['assessment_loan_purpose'] = &$this->assessment_loan_purpose;

		// assessment_loan_section
		$this->assessment_loan_section = new DbField('questions_answers', 'questions-answers', 'x_assessment_loan_section', 'assessment_loan_section', '`assessment_loan_section`', '`assessment_loan_section`', 200, 255, -1, FALSE, '`assessment_loan_section`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->assessment_loan_section->Sortable = TRUE; // Allow sort
		$this->fields['assessment_loan_section'] = &$this->assessment_loan_section;

		// created_at
		$this->created_at = new DbField('questions_answers', 'questions-answers', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = TRUE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// updated_at
		$this->updated_at = new DbField('questions_answers', 'questions-answers', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_at->Sortable = TRUE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;

		// loan_purpose_id
		$this->loan_purpose_id = new DbField('questions_answers', 'questions-answers', 'x_loan_purpose_id', 'loan_purpose_id', '`loan_purpose_id`', '`loan_purpose_id`', 19, 10, -1, FALSE, '`loan_purpose_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->loan_purpose_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->loan_purpose_id->IsPrimaryKey = TRUE; // Primary key field
		$this->loan_purpose_id->Sortable = TRUE; // Allow sort
		$this->loan_purpose_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['loan_purpose_id'] = &$this->loan_purpose_id;

		// loan_sector_id
		$this->loan_sector_id = new DbField('questions_answers', 'questions-answers', 'x_loan_sector_id', 'loan_sector_id', '`loan_sector_id`', '`loan_sector_id`', 19, 10, -1, FALSE, '`loan_sector_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->loan_sector_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->loan_sector_id->IsPrimaryKey = TRUE; // Primary key field
		$this->loan_sector_id->Sortable = TRUE; // Allow sort
		$this->loan_sector_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['loan_sector_id'] = &$this->loan_sector_id;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`questions-answers`";
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
			$this->question_id->setDbValue($conn->insert_ID());
			$rs['question_id'] = $this->question_id->DbValue;

			// Get insert id if necessary
			$this->answer_id->setDbValue($conn->insert_ID());
			$rs['answer_id'] = $this->answer_id->DbValue;

			// Get insert id if necessary
			$this->loan_purpose_id->setDbValue($conn->insert_ID());
			$rs['loan_purpose_id'] = $this->loan_purpose_id->DbValue;

			// Get insert id if necessary
			$this->loan_sector_id->setDbValue($conn->insert_ID());
			$rs['loan_sector_id'] = $this->loan_sector_id->DbValue;
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
			if (array_key_exists('question_id', $rs))
				AddFilter($where, QuotedName('question_id', $this->Dbid) . '=' . QuotedValue($rs['question_id'], $this->question_id->DataType, $this->Dbid));
			if (array_key_exists('answer_id', $rs))
				AddFilter($where, QuotedName('answer_id', $this->Dbid) . '=' . QuotedValue($rs['answer_id'], $this->answer_id->DataType, $this->Dbid));
			if (array_key_exists('loan_purpose_id', $rs))
				AddFilter($where, QuotedName('loan_purpose_id', $this->Dbid) . '=' . QuotedValue($rs['loan_purpose_id'], $this->loan_purpose_id->DataType, $this->Dbid));
			if (array_key_exists('loan_sector_id', $rs))
				AddFilter($where, QuotedName('loan_sector_id', $this->Dbid) . '=' . QuotedValue($rs['loan_sector_id'], $this->loan_sector_id->DataType, $this->Dbid));
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
		$this->question_id->DbValue = $row['question_id'];
		$this->question_title->DbValue = $row['question_title'];
		$this->question_placeholder->DbValue = $row['question_placeholder'];
		$this->question_questions->DbValue = $row['question_questions'];
		$this->question_scores->DbValue = $row['question_scores'];
		$this->question_active->DbValue = $row['question_active'];
		$this->question_section_id->DbValue = $row['question_section_id'];
		$this->question_type->DbValue = $row['question_type'];
		$this->question_has_recommendations->DbValue = $row['question_has_recommendations'];
		$this->question_group_id->DbValue = $row['question_group_id'];
		$this->question_category_id->DbValue = $row['question_category_id'];
		$this->question_order->DbValue = $row['question_order'];
		$this->answer_id->DbValue = $row['answer_id'];
		$this->answer_response->DbValue = $row['answer_response'];
		$this->answer_score->DbValue = $row['answer_score'];
		$this->assessment_id->DbValue = $row['assessment_id'];
		$this->answer_weight->DbValue = $row['answer_weight'];
		$this->answer_section_id->DbValue = $row['answer_section_id'];
		$this->answer_recommendations->DbValue = $row['answer_recommendations'];
		$this->question_type_name->DbValue = $row['question_type_name'];
		$this->question_group_name->DbValue = $row['question_group_name'];
		$this->question_category_name->DbValue = $row['question_category_name'];
		$this->assessment_customer_id->DbValue = $row['assessment_customer_id'];
		$this->assessment_customer_first_name->DbValue = $row['assessment_customer_first_name'];
		$this->assessment_status->DbValue = $row['assessment_status'];
		$this->assessment_total_score->DbValue = $row['assessment_total_score'];
		$this->assessment_customer_last_name->DbValue = $row['assessment_customer_last_name'];
		$this->assessment_user_id->DbValue = $row['assessment_user_id'];
		$this->assessment_user_first_name->DbValue = $row['assessment_user_first_name'];
		$this->assessment_user_last_name->DbValue = $row['assessment_user_last_name'];
		$this->assessment_user_email->DbValue = $row['assessment_user_email'];
		$this->assessment_personal_id->DbValue = $row['assessment_personal_id'];
		$this->assessment_customer_age->DbValue = $row['assessment_customer_age'];
		$this->assessment_sex->DbValue = $row['assessment_sex'];
		$this->assessment_address->DbValue = $row['assessment_address'];
		$this->assessment_lat->DbValue = $row['assessment_lat'];
		$this->assessment_lon->DbValue = $row['assessment_lon'];
		$this->assessment_loan_purpose->DbValue = $row['assessment_loan_purpose'];
		$this->assessment_loan_section->DbValue = $row['assessment_loan_section'];
		$this->created_at->DbValue = $row['created_at'];
		$this->updated_at->DbValue = $row['updated_at'];
		$this->loan_purpose_id->DbValue = $row['loan_purpose_id'];
		$this->loan_sector_id->DbValue = $row['loan_sector_id'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`question_id` = @question_id@ AND `answer_id` = @answer_id@ AND `loan_purpose_id` = @loan_purpose_id@ AND `loan_sector_id` = @loan_sector_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('question_id', $row) ? $row['question_id'] : NULL;
		else
			$val = $this->question_id->OldValue !== NULL ? $this->question_id->OldValue : $this->question_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@question_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('answer_id', $row) ? $row['answer_id'] : NULL;
		else
			$val = $this->answer_id->OldValue !== NULL ? $this->answer_id->OldValue : $this->answer_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@answer_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			$val = array_key_exists('loan_sector_id', $row) ? $row['loan_sector_id'] : NULL;
		else
			$val = $this->loan_sector_id->OldValue !== NULL ? $this->loan_sector_id->OldValue : $this->loan_sector_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@loan_sector_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "questions_answerslist.php";
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
		if ($pageName == "questions_answersview.php")
			return $Language->phrase("View");
		elseif ($pageName == "questions_answersedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "questions_answersadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "questions_answerslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("questions_answersview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("questions_answersview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "questions_answersadd.php?" . $this->getUrlParm($parm);
		else
			$url = "questions_answersadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("questions_answersedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("questions_answersadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("questions_answersdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "question_id:" . JsonEncode($this->question_id->CurrentValue, "number");
		$json .= ",answer_id:" . JsonEncode($this->answer_id->CurrentValue, "number");
		$json .= ",loan_purpose_id:" . JsonEncode($this->loan_purpose_id->CurrentValue, "number");
		$json .= ",loan_sector_id:" . JsonEncode($this->loan_sector_id->CurrentValue, "number");
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
		if ($this->question_id->CurrentValue != NULL) {
			$url .= "question_id=" . urlencode($this->question_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->answer_id->CurrentValue != NULL) {
			$url .= "&answer_id=" . urlencode($this->answer_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->loan_purpose_id->CurrentValue != NULL) {
			$url .= "&loan_purpose_id=" . urlencode($this->loan_purpose_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->loan_sector_id->CurrentValue != NULL) {
			$url .= "&loan_sector_id=" . urlencode($this->loan_sector_id->CurrentValue);
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
			if (Param("question_id") !== NULL)
				$arKey[] = Param("question_id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("answer_id") !== NULL)
				$arKey[] = Param("answer_id");
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
			if (Param("loan_sector_id") !== NULL)
				$arKey[] = Param("loan_sector_id");
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
				if (!is_numeric($key[0])) // question_id
					continue;
				if (!is_numeric($key[1])) // answer_id
					continue;
				if (!is_numeric($key[2])) // loan_purpose_id
					continue;
				if (!is_numeric($key[3])) // loan_sector_id
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
				$this->question_id->CurrentValue = $key[0];
			else
				$this->question_id->OldValue = $key[0];
			if ($setCurrent)
				$this->answer_id->CurrentValue = $key[1];
			else
				$this->answer_id->OldValue = $key[1];
			if ($setCurrent)
				$this->loan_purpose_id->CurrentValue = $key[2];
			else
				$this->loan_purpose_id->OldValue = $key[2];
			if ($setCurrent)
				$this->loan_sector_id->CurrentValue = $key[3];
			else
				$this->loan_sector_id->OldValue = $key[3];
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
		$this->question_id->setDbValue($rs->fields('question_id'));
		$this->question_title->setDbValue($rs->fields('question_title'));
		$this->question_placeholder->setDbValue($rs->fields('question_placeholder'));
		$this->question_questions->setDbValue($rs->fields('question_questions'));
		$this->question_scores->setDbValue($rs->fields('question_scores'));
		$this->question_active->setDbValue($rs->fields('question_active'));
		$this->question_section_id->setDbValue($rs->fields('question_section_id'));
		$this->question_type->setDbValue($rs->fields('question_type'));
		$this->question_has_recommendations->setDbValue($rs->fields('question_has_recommendations'));
		$this->question_group_id->setDbValue($rs->fields('question_group_id'));
		$this->question_category_id->setDbValue($rs->fields('question_category_id'));
		$this->question_order->setDbValue($rs->fields('question_order'));
		$this->answer_id->setDbValue($rs->fields('answer_id'));
		$this->answer_response->setDbValue($rs->fields('answer_response'));
		$this->answer_score->setDbValue($rs->fields('answer_score'));
		$this->assessment_id->setDbValue($rs->fields('assessment_id'));
		$this->answer_weight->setDbValue($rs->fields('answer_weight'));
		$this->answer_section_id->setDbValue($rs->fields('answer_section_id'));
		$this->answer_recommendations->setDbValue($rs->fields('answer_recommendations'));
		$this->question_type_name->setDbValue($rs->fields('question_type_name'));
		$this->question_group_name->setDbValue($rs->fields('question_group_name'));
		$this->question_category_name->setDbValue($rs->fields('question_category_name'));
		$this->assessment_customer_id->setDbValue($rs->fields('assessment_customer_id'));
		$this->assessment_customer_first_name->setDbValue($rs->fields('assessment_customer_first_name'));
		$this->assessment_status->setDbValue($rs->fields('assessment_status'));
		$this->assessment_total_score->setDbValue($rs->fields('assessment_total_score'));
		$this->assessment_customer_last_name->setDbValue($rs->fields('assessment_customer_last_name'));
		$this->assessment_user_id->setDbValue($rs->fields('assessment_user_id'));
		$this->assessment_user_first_name->setDbValue($rs->fields('assessment_user_first_name'));
		$this->assessment_user_last_name->setDbValue($rs->fields('assessment_user_last_name'));
		$this->assessment_user_email->setDbValue($rs->fields('assessment_user_email'));
		$this->assessment_personal_id->setDbValue($rs->fields('assessment_personal_id'));
		$this->assessment_customer_age->setDbValue($rs->fields('assessment_customer_age'));
		$this->assessment_sex->setDbValue($rs->fields('assessment_sex'));
		$this->assessment_address->setDbValue($rs->fields('assessment_address'));
		$this->assessment_lat->setDbValue($rs->fields('assessment_lat'));
		$this->assessment_lon->setDbValue($rs->fields('assessment_lon'));
		$this->assessment_loan_purpose->setDbValue($rs->fields('assessment_loan_purpose'));
		$this->assessment_loan_section->setDbValue($rs->fields('assessment_loan_section'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
		$this->loan_purpose_id->setDbValue($rs->fields('loan_purpose_id'));
		$this->loan_sector_id->setDbValue($rs->fields('loan_sector_id'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
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

		// question_id
		$this->question_id->EditAttrs["class"] = "form-control";
		$this->question_id->EditCustomAttributes = "";
		$this->question_id->EditValue = $this->question_id->CurrentValue;
		$this->question_id->EditValue = FormatNumber($this->question_id->EditValue, 0, -2, -2, -2);
		$this->question_id->ViewCustomAttributes = "";

		// question_title
		$this->question_title->EditAttrs["class"] = "form-control";
		$this->question_title->EditCustomAttributes = "";
		if (!$this->question_title->Raw)
			$this->question_title->CurrentValue = HtmlDecode($this->question_title->CurrentValue);
		$this->question_title->EditValue = $this->question_title->CurrentValue;
		$this->question_title->PlaceHolder = RemoveHtml($this->question_title->caption());

		// question_placeholder
		$this->question_placeholder->EditAttrs["class"] = "form-control";
		$this->question_placeholder->EditCustomAttributes = "";
		$this->question_placeholder->EditValue = $this->question_placeholder->CurrentValue;
		$this->question_placeholder->PlaceHolder = RemoveHtml($this->question_placeholder->caption());

		// question_questions
		$this->question_questions->EditAttrs["class"] = "form-control";
		$this->question_questions->EditCustomAttributes = "";
		$this->question_questions->EditValue = $this->question_questions->CurrentValue;
		$this->question_questions->PlaceHolder = RemoveHtml($this->question_questions->caption());

		// question_scores
		$this->question_scores->EditAttrs["class"] = "form-control";
		$this->question_scores->EditCustomAttributes = "";
		if (!$this->question_scores->Raw)
			$this->question_scores->CurrentValue = HtmlDecode($this->question_scores->CurrentValue);
		$this->question_scores->EditValue = $this->question_scores->CurrentValue;
		$this->question_scores->PlaceHolder = RemoveHtml($this->question_scores->caption());

		// question_active
		$this->question_active->EditCustomAttributes = "";
		$this->question_active->EditValue = $this->question_active->options(FALSE);

		// question_section_id
		$this->question_section_id->EditAttrs["class"] = "form-control";
		$this->question_section_id->EditCustomAttributes = "";
		$this->question_section_id->EditValue = $this->question_section_id->CurrentValue;
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
		$this->question_order->EditValue = $this->question_order->CurrentValue;
		$this->question_order->PlaceHolder = RemoveHtml($this->question_order->caption());

		// answer_id
		$this->answer_id->EditAttrs["class"] = "form-control";
		$this->answer_id->EditCustomAttributes = "";
		$this->answer_id->EditValue = $this->answer_id->CurrentValue;
		$this->answer_id->EditValue = FormatNumber($this->answer_id->EditValue, 0, -2, -2, -2);
		$this->answer_id->ViewCustomAttributes = "";

		// answer_response
		$this->answer_response->EditAttrs["class"] = "form-control";
		$this->answer_response->EditCustomAttributes = "";
		if (!$this->answer_response->Raw)
			$this->answer_response->CurrentValue = HtmlDecode($this->answer_response->CurrentValue);
		$this->answer_response->EditValue = $this->answer_response->CurrentValue;
		$this->answer_response->PlaceHolder = RemoveHtml($this->answer_response->caption());

		// answer_score
		$this->answer_score->EditAttrs["class"] = "form-control";
		$this->answer_score->EditCustomAttributes = "";
		$this->answer_score->EditValue = $this->answer_score->CurrentValue;
		$this->answer_score->PlaceHolder = RemoveHtml($this->answer_score->caption());
		if (strval($this->answer_score->EditValue) != "" && is_numeric($this->answer_score->EditValue))
			$this->answer_score->EditValue = FormatNumber($this->answer_score->EditValue, -2, -2, -2, -2);
		

		// assessment_id
		$this->assessment_id->EditAttrs["class"] = "form-control";
		$this->assessment_id->EditCustomAttributes = "";
		$this->assessment_id->EditValue = $this->assessment_id->CurrentValue;
		$this->assessment_id->PlaceHolder = RemoveHtml($this->assessment_id->caption());

		// answer_weight
		$this->answer_weight->EditAttrs["class"] = "form-control";
		$this->answer_weight->EditCustomAttributes = "";
		$this->answer_weight->EditValue = $this->answer_weight->CurrentValue;
		$this->answer_weight->PlaceHolder = RemoveHtml($this->answer_weight->caption());
		if (strval($this->answer_weight->EditValue) != "" && is_numeric($this->answer_weight->EditValue))
			$this->answer_weight->EditValue = FormatNumber($this->answer_weight->EditValue, -2, -2, -2, -2);
		

		// answer_section_id
		$this->answer_section_id->EditAttrs["class"] = "form-control";
		$this->answer_section_id->EditCustomAttributes = "";
		$this->answer_section_id->EditValue = $this->answer_section_id->CurrentValue;
		$this->answer_section_id->PlaceHolder = RemoveHtml($this->answer_section_id->caption());

		// answer_recommendations
		$this->answer_recommendations->EditAttrs["class"] = "form-control";
		$this->answer_recommendations->EditCustomAttributes = "";
		$this->answer_recommendations->EditValue = $this->answer_recommendations->CurrentValue;
		$this->answer_recommendations->PlaceHolder = RemoveHtml($this->answer_recommendations->caption());

		// question_type_name
		$this->question_type_name->EditAttrs["class"] = "form-control";
		$this->question_type_name->EditCustomAttributes = "";
		if (!$this->question_type_name->Raw)
			$this->question_type_name->CurrentValue = HtmlDecode($this->question_type_name->CurrentValue);
		$this->question_type_name->EditValue = $this->question_type_name->CurrentValue;
		$this->question_type_name->PlaceHolder = RemoveHtml($this->question_type_name->caption());

		// question_group_name
		$this->question_group_name->EditAttrs["class"] = "form-control";
		$this->question_group_name->EditCustomAttributes = "";
		if (!$this->question_group_name->Raw)
			$this->question_group_name->CurrentValue = HtmlDecode($this->question_group_name->CurrentValue);
		$this->question_group_name->EditValue = $this->question_group_name->CurrentValue;
		$this->question_group_name->PlaceHolder = RemoveHtml($this->question_group_name->caption());

		// question_category_name
		$this->question_category_name->EditAttrs["class"] = "form-control";
		$this->question_category_name->EditCustomAttributes = "";
		if (!$this->question_category_name->Raw)
			$this->question_category_name->CurrentValue = HtmlDecode($this->question_category_name->CurrentValue);
		$this->question_category_name->EditValue = $this->question_category_name->CurrentValue;
		$this->question_category_name->PlaceHolder = RemoveHtml($this->question_category_name->caption());

		// assessment_customer_id
		$this->assessment_customer_id->EditAttrs["class"] = "form-control";
		$this->assessment_customer_id->EditCustomAttributes = "";
		if (!$this->assessment_customer_id->Raw)
			$this->assessment_customer_id->CurrentValue = HtmlDecode($this->assessment_customer_id->CurrentValue);
		$this->assessment_customer_id->EditValue = $this->assessment_customer_id->CurrentValue;
		$this->assessment_customer_id->PlaceHolder = RemoveHtml($this->assessment_customer_id->caption());

		// assessment_customer_first_name
		$this->assessment_customer_first_name->EditAttrs["class"] = "form-control";
		$this->assessment_customer_first_name->EditCustomAttributes = "";
		if (!$this->assessment_customer_first_name->Raw)
			$this->assessment_customer_first_name->CurrentValue = HtmlDecode($this->assessment_customer_first_name->CurrentValue);
		$this->assessment_customer_first_name->EditValue = $this->assessment_customer_first_name->CurrentValue;
		$this->assessment_customer_first_name->PlaceHolder = RemoveHtml($this->assessment_customer_first_name->caption());

		// assessment_status
		$this->assessment_status->EditAttrs["class"] = "form-control";
		$this->assessment_status->EditCustomAttributes = "";
		$this->assessment_status->EditValue = $this->assessment_status->CurrentValue;
		$this->assessment_status->PlaceHolder = RemoveHtml($this->assessment_status->caption());

		// assessment_total_score
		$this->assessment_total_score->EditAttrs["class"] = "form-control";
		$this->assessment_total_score->EditCustomAttributes = "";
		$this->assessment_total_score->EditValue = $this->assessment_total_score->CurrentValue;
		$this->assessment_total_score->PlaceHolder = RemoveHtml($this->assessment_total_score->caption());
		if (strval($this->assessment_total_score->EditValue) != "" && is_numeric($this->assessment_total_score->EditValue))
			$this->assessment_total_score->EditValue = FormatNumber($this->assessment_total_score->EditValue, -2, -2, -2, -2);
		

		// assessment_customer_last_name
		$this->assessment_customer_last_name->EditAttrs["class"] = "form-control";
		$this->assessment_customer_last_name->EditCustomAttributes = "";
		if (!$this->assessment_customer_last_name->Raw)
			$this->assessment_customer_last_name->CurrentValue = HtmlDecode($this->assessment_customer_last_name->CurrentValue);
		$this->assessment_customer_last_name->EditValue = $this->assessment_customer_last_name->CurrentValue;
		$this->assessment_customer_last_name->PlaceHolder = RemoveHtml($this->assessment_customer_last_name->caption());

		// assessment_user_id
		$this->assessment_user_id->EditAttrs["class"] = "form-control";
		$this->assessment_user_id->EditCustomAttributes = "";
		$this->assessment_user_id->EditValue = $this->assessment_user_id->CurrentValue;
		$this->assessment_user_id->PlaceHolder = RemoveHtml($this->assessment_user_id->caption());

		// assessment_user_first_name
		$this->assessment_user_first_name->EditAttrs["class"] = "form-control";
		$this->assessment_user_first_name->EditCustomAttributes = "";
		if (!$this->assessment_user_first_name->Raw)
			$this->assessment_user_first_name->CurrentValue = HtmlDecode($this->assessment_user_first_name->CurrentValue);
		$this->assessment_user_first_name->EditValue = $this->assessment_user_first_name->CurrentValue;
		$this->assessment_user_first_name->PlaceHolder = RemoveHtml($this->assessment_user_first_name->caption());

		// assessment_user_last_name
		$this->assessment_user_last_name->EditAttrs["class"] = "form-control";
		$this->assessment_user_last_name->EditCustomAttributes = "";
		if (!$this->assessment_user_last_name->Raw)
			$this->assessment_user_last_name->CurrentValue = HtmlDecode($this->assessment_user_last_name->CurrentValue);
		$this->assessment_user_last_name->EditValue = $this->assessment_user_last_name->CurrentValue;
		$this->assessment_user_last_name->PlaceHolder = RemoveHtml($this->assessment_user_last_name->caption());

		// assessment_user_email
		$this->assessment_user_email->EditAttrs["class"] = "form-control";
		$this->assessment_user_email->EditCustomAttributes = "";
		if (!$this->assessment_user_email->Raw)
			$this->assessment_user_email->CurrentValue = HtmlDecode($this->assessment_user_email->CurrentValue);
		$this->assessment_user_email->EditValue = $this->assessment_user_email->CurrentValue;
		$this->assessment_user_email->PlaceHolder = RemoveHtml($this->assessment_user_email->caption());

		// assessment_personal_id
		$this->assessment_personal_id->EditAttrs["class"] = "form-control";
		$this->assessment_personal_id->EditCustomAttributes = "";
		if (!$this->assessment_personal_id->Raw)
			$this->assessment_personal_id->CurrentValue = HtmlDecode($this->assessment_personal_id->CurrentValue);
		$this->assessment_personal_id->EditValue = $this->assessment_personal_id->CurrentValue;
		$this->assessment_personal_id->PlaceHolder = RemoveHtml($this->assessment_personal_id->caption());

		// assessment_customer_age
		$this->assessment_customer_age->EditAttrs["class"] = "form-control";
		$this->assessment_customer_age->EditCustomAttributes = "";
		$this->assessment_customer_age->EditValue = $this->assessment_customer_age->CurrentValue;
		$this->assessment_customer_age->PlaceHolder = RemoveHtml($this->assessment_customer_age->caption());

		// assessment_sex
		$this->assessment_sex->EditAttrs["class"] = "form-control";
		$this->assessment_sex->EditCustomAttributes = "";
		if (!$this->assessment_sex->Raw)
			$this->assessment_sex->CurrentValue = HtmlDecode($this->assessment_sex->CurrentValue);
		$this->assessment_sex->EditValue = $this->assessment_sex->CurrentValue;
		$this->assessment_sex->PlaceHolder = RemoveHtml($this->assessment_sex->caption());

		// assessment_address
		$this->assessment_address->EditAttrs["class"] = "form-control";
		$this->assessment_address->EditCustomAttributes = "";
		if (!$this->assessment_address->Raw)
			$this->assessment_address->CurrentValue = HtmlDecode($this->assessment_address->CurrentValue);
		$this->assessment_address->EditValue = $this->assessment_address->CurrentValue;
		$this->assessment_address->PlaceHolder = RemoveHtml($this->assessment_address->caption());

		// assessment_lat
		$this->assessment_lat->EditAttrs["class"] = "form-control";
		$this->assessment_lat->EditCustomAttributes = "";
		$this->assessment_lat->EditValue = $this->assessment_lat->CurrentValue;
		$this->assessment_lat->PlaceHolder = RemoveHtml($this->assessment_lat->caption());
		if (strval($this->assessment_lat->EditValue) != "" && is_numeric($this->assessment_lat->EditValue))
			$this->assessment_lat->EditValue = FormatNumber($this->assessment_lat->EditValue, -2, -2, -2, -2);
		

		// assessment_lon
		$this->assessment_lon->EditAttrs["class"] = "form-control";
		$this->assessment_lon->EditCustomAttributes = "";
		$this->assessment_lon->EditValue = $this->assessment_lon->CurrentValue;
		$this->assessment_lon->PlaceHolder = RemoveHtml($this->assessment_lon->caption());
		if (strval($this->assessment_lon->EditValue) != "" && is_numeric($this->assessment_lon->EditValue))
			$this->assessment_lon->EditValue = FormatNumber($this->assessment_lon->EditValue, -2, -2, -2, -2);
		

		// assessment_loan_purpose
		$this->assessment_loan_purpose->EditAttrs["class"] = "form-control";
		$this->assessment_loan_purpose->EditCustomAttributes = "";
		if (!$this->assessment_loan_purpose->Raw)
			$this->assessment_loan_purpose->CurrentValue = HtmlDecode($this->assessment_loan_purpose->CurrentValue);
		$this->assessment_loan_purpose->EditValue = $this->assessment_loan_purpose->CurrentValue;
		$this->assessment_loan_purpose->PlaceHolder = RemoveHtml($this->assessment_loan_purpose->caption());

		// assessment_loan_section
		$this->assessment_loan_section->EditAttrs["class"] = "form-control";
		$this->assessment_loan_section->EditCustomAttributes = "";
		if (!$this->assessment_loan_section->Raw)
			$this->assessment_loan_section->CurrentValue = HtmlDecode($this->assessment_loan_section->CurrentValue);
		$this->assessment_loan_section->EditValue = $this->assessment_loan_section->CurrentValue;
		$this->assessment_loan_section->PlaceHolder = RemoveHtml($this->assessment_loan_section->caption());

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

		// loan_purpose_id
		$this->loan_purpose_id->EditAttrs["class"] = "form-control";
		$this->loan_purpose_id->EditCustomAttributes = "";
		$this->loan_purpose_id->EditValue = $this->loan_purpose_id->CurrentValue;
		$this->loan_purpose_id->ViewCustomAttributes = "";

		// loan_sector_id
		$this->loan_sector_id->EditAttrs["class"] = "form-control";
		$this->loan_sector_id->EditCustomAttributes = "";
		$this->loan_sector_id->EditValue = $this->loan_sector_id->CurrentValue;
		$this->loan_sector_id->ViewCustomAttributes = "";

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
					$doc->exportCaption($this->question_id);
					$doc->exportCaption($this->question_title);
					$doc->exportCaption($this->question_placeholder);
					$doc->exportCaption($this->question_questions);
					$doc->exportCaption($this->question_scores);
					$doc->exportCaption($this->question_active);
					$doc->exportCaption($this->question_section_id);
					$doc->exportCaption($this->question_type);
					$doc->exportCaption($this->question_has_recommendations);
					$doc->exportCaption($this->question_group_id);
					$doc->exportCaption($this->question_category_id);
					$doc->exportCaption($this->question_order);
					$doc->exportCaption($this->answer_id);
					$doc->exportCaption($this->answer_response);
					$doc->exportCaption($this->answer_score);
					$doc->exportCaption($this->assessment_id);
					$doc->exportCaption($this->answer_weight);
					$doc->exportCaption($this->answer_section_id);
					$doc->exportCaption($this->answer_recommendations);
					$doc->exportCaption($this->question_type_name);
					$doc->exportCaption($this->question_group_name);
					$doc->exportCaption($this->question_category_name);
					$doc->exportCaption($this->assessment_customer_id);
					$doc->exportCaption($this->assessment_customer_first_name);
					$doc->exportCaption($this->assessment_status);
					$doc->exportCaption($this->assessment_total_score);
					$doc->exportCaption($this->assessment_customer_last_name);
					$doc->exportCaption($this->assessment_user_id);
					$doc->exportCaption($this->assessment_user_first_name);
					$doc->exportCaption($this->assessment_user_last_name);
					$doc->exportCaption($this->assessment_user_email);
					$doc->exportCaption($this->assessment_personal_id);
					$doc->exportCaption($this->assessment_customer_age);
					$doc->exportCaption($this->assessment_sex);
					$doc->exportCaption($this->assessment_address);
					$doc->exportCaption($this->assessment_lat);
					$doc->exportCaption($this->assessment_lon);
					$doc->exportCaption($this->assessment_loan_purpose);
					$doc->exportCaption($this->assessment_loan_section);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->updated_at);
					$doc->exportCaption($this->loan_purpose_id);
					$doc->exportCaption($this->loan_sector_id);
				} else {
					$doc->exportCaption($this->question_id);
					$doc->exportCaption($this->question_title);
					$doc->exportCaption($this->question_scores);
					$doc->exportCaption($this->question_active);
					$doc->exportCaption($this->question_section_id);
					$doc->exportCaption($this->question_type);
					$doc->exportCaption($this->question_has_recommendations);
					$doc->exportCaption($this->question_group_id);
					$doc->exportCaption($this->question_category_id);
					$doc->exportCaption($this->question_order);
					$doc->exportCaption($this->answer_id);
					$doc->exportCaption($this->answer_response);
					$doc->exportCaption($this->answer_score);
					$doc->exportCaption($this->assessment_id);
					$doc->exportCaption($this->answer_weight);
					$doc->exportCaption($this->answer_section_id);
					$doc->exportCaption($this->question_type_name);
					$doc->exportCaption($this->question_group_name);
					$doc->exportCaption($this->question_category_name);
					$doc->exportCaption($this->assessment_customer_id);
					$doc->exportCaption($this->assessment_customer_first_name);
					$doc->exportCaption($this->assessment_status);
					$doc->exportCaption($this->assessment_total_score);
					$doc->exportCaption($this->assessment_customer_last_name);
					$doc->exportCaption($this->assessment_user_id);
					$doc->exportCaption($this->assessment_user_first_name);
					$doc->exportCaption($this->assessment_user_last_name);
					$doc->exportCaption($this->assessment_user_email);
					$doc->exportCaption($this->assessment_personal_id);
					$doc->exportCaption($this->assessment_customer_age);
					$doc->exportCaption($this->assessment_sex);
					$doc->exportCaption($this->assessment_address);
					$doc->exportCaption($this->assessment_lat);
					$doc->exportCaption($this->assessment_lon);
					$doc->exportCaption($this->assessment_loan_purpose);
					$doc->exportCaption($this->assessment_loan_section);
					$doc->exportCaption($this->created_at);
					$doc->exportCaption($this->updated_at);
					$doc->exportCaption($this->loan_purpose_id);
					$doc->exportCaption($this->loan_sector_id);
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
						$doc->exportField($this->question_id);
						$doc->exportField($this->question_title);
						$doc->exportField($this->question_placeholder);
						$doc->exportField($this->question_questions);
						$doc->exportField($this->question_scores);
						$doc->exportField($this->question_active);
						$doc->exportField($this->question_section_id);
						$doc->exportField($this->question_type);
						$doc->exportField($this->question_has_recommendations);
						$doc->exportField($this->question_group_id);
						$doc->exportField($this->question_category_id);
						$doc->exportField($this->question_order);
						$doc->exportField($this->answer_id);
						$doc->exportField($this->answer_response);
						$doc->exportField($this->answer_score);
						$doc->exportField($this->assessment_id);
						$doc->exportField($this->answer_weight);
						$doc->exportField($this->answer_section_id);
						$doc->exportField($this->answer_recommendations);
						$doc->exportField($this->question_type_name);
						$doc->exportField($this->question_group_name);
						$doc->exportField($this->question_category_name);
						$doc->exportField($this->assessment_customer_id);
						$doc->exportField($this->assessment_customer_first_name);
						$doc->exportField($this->assessment_status);
						$doc->exportField($this->assessment_total_score);
						$doc->exportField($this->assessment_customer_last_name);
						$doc->exportField($this->assessment_user_id);
						$doc->exportField($this->assessment_user_first_name);
						$doc->exportField($this->assessment_user_last_name);
						$doc->exportField($this->assessment_user_email);
						$doc->exportField($this->assessment_personal_id);
						$doc->exportField($this->assessment_customer_age);
						$doc->exportField($this->assessment_sex);
						$doc->exportField($this->assessment_address);
						$doc->exportField($this->assessment_lat);
						$doc->exportField($this->assessment_lon);
						$doc->exportField($this->assessment_loan_purpose);
						$doc->exportField($this->assessment_loan_section);
						$doc->exportField($this->created_at);
						$doc->exportField($this->updated_at);
						$doc->exportField($this->loan_purpose_id);
						$doc->exportField($this->loan_sector_id);
					} else {
						$doc->exportField($this->question_id);
						$doc->exportField($this->question_title);
						$doc->exportField($this->question_scores);
						$doc->exportField($this->question_active);
						$doc->exportField($this->question_section_id);
						$doc->exportField($this->question_type);
						$doc->exportField($this->question_has_recommendations);
						$doc->exportField($this->question_group_id);
						$doc->exportField($this->question_category_id);
						$doc->exportField($this->question_order);
						$doc->exportField($this->answer_id);
						$doc->exportField($this->answer_response);
						$doc->exportField($this->answer_score);
						$doc->exportField($this->assessment_id);
						$doc->exportField($this->answer_weight);
						$doc->exportField($this->answer_section_id);
						$doc->exportField($this->question_type_name);
						$doc->exportField($this->question_group_name);
						$doc->exportField($this->question_category_name);
						$doc->exportField($this->assessment_customer_id);
						$doc->exportField($this->assessment_customer_first_name);
						$doc->exportField($this->assessment_status);
						$doc->exportField($this->assessment_total_score);
						$doc->exportField($this->assessment_customer_last_name);
						$doc->exportField($this->assessment_user_id);
						$doc->exportField($this->assessment_user_first_name);
						$doc->exportField($this->assessment_user_last_name);
						$doc->exportField($this->assessment_user_email);
						$doc->exportField($this->assessment_personal_id);
						$doc->exportField($this->assessment_customer_age);
						$doc->exportField($this->assessment_sex);
						$doc->exportField($this->assessment_address);
						$doc->exportField($this->assessment_lat);
						$doc->exportField($this->assessment_lon);
						$doc->exportField($this->assessment_loan_purpose);
						$doc->exportField($this->assessment_loan_section);
						$doc->exportField($this->created_at);
						$doc->exportField($this->updated_at);
						$doc->exportField($this->loan_purpose_id);
						$doc->exportField($this->loan_sector_id);
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
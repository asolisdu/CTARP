<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(2, "mi_assessments", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "assessmentslist.php?cmd=resetall", -1, "", AllowListMenu('{98C27E89-2937-4D47-9B89-35CA334C4E82}assessments'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mci_Form_Management", $MenuLanguage->MenuPhrase("10", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_sections", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "sectionslist.php", 10, "", AllowListMenu('{98C27E89-2937-4D47-9B89-35CA334C4E82}sections'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_question_types", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "question_typeslist.php", 10, "", AllowListMenu('{98C27E89-2937-4D47-9B89-35CA334C4E82}question_types'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(13, "mi_question_category", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "question_categorylist.php", 10, "", AllowListMenu('{98C27E89-2937-4D47-9B89-35CA334C4E82}question_category'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(14, "mi_question_groups", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "question_groupslist.php", 10, "", AllowListMenu('{98C27E89-2937-4D47-9B89-35CA334C4E82}question_groups'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(20, "mci_Loan_Management", $MenuLanguage->MenuPhrase("20", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_loan_purposes", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "loan_purposeslist.php", 20, "", AllowListMenu('{98C27E89-2937-4D47-9B89-35CA334C4E82}loan_purposes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(12, "mi_loan_section", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "loan_sectionlist.php", 20, "", AllowListMenu('{98C27E89-2937-4D47-9B89-35CA334C4E82}loan_section'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mci_Users_Administration", $MenuLanguage->MenuPhrase("9", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_users", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "userslist.php", 9, "", AllowListMenu('{98C27E89-2937-4D47-9B89-35CA334C4E82}users'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(24, "mi_userlevels", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "userlevelslist.php", 9, "", AllowListMenu('{98C27E89-2937-4D47-9B89-35CA334C4E82}userlevels'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(43, "mci_Security", $MenuLanguage->MenuPhrase("43", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(23, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("23", "MenuText"), $MenuRelativePath . "userlevelpermissionslist.php", 43, "", AllowListMenu('{98C27E89-2937-4D47-9B89-35CA334C4E82}userlevelpermissions'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(45, "mi_audittrail", $MenuLanguage->MenuPhrase("45", "MenuText"), $MenuRelativePath . "audittraillist.php", 43, "", AllowListMenu('{98C27E89-2937-4D47-9B89-35CA334C4E82}audittrail'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>
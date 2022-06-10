<?php
namespace PHPMaker2020\IDB_EcoMicro_BZ;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$assessments_add = new assessments_add();

// Run the page
$assessments_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$assessments_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fassessmentsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fassessmentsadd = currentForm = new ew.Form("fassessmentsadd", "add");

	// Validate form
	fassessmentsadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($assessments_add->user_id->Required) { ?>
				elm = this.getElements("x" + infix + "_user_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->user_id->caption(), $assessments_add->user_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_user_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_add->user_id->errorMessage()) ?>");
			<?php if ($assessments_add->customer_id->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->customer_id->caption(), $assessments_add->customer_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($assessments_add->customer_first_name->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_first_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->customer_first_name->caption(), $assessments_add->customer_first_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($assessments_add->customer_age->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_age");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->customer_age->caption(), $assessments_add->customer_age->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_customer_age");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_add->customer_age->errorMessage()) ?>");
			<?php if ($assessments_add->sex->Required) { ?>
				elm = this.getElements("x" + infix + "_sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->sex->caption(), $assessments_add->sex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($assessments_add->address->Required) { ?>
				elm = this.getElements("x" + infix + "_address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->address->caption(), $assessments_add->address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($assessments_add->total_score->Required) { ?>
				elm = this.getElements("x" + infix + "_total_score");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->total_score->caption(), $assessments_add->total_score->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_score");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_add->total_score->errorMessage()) ?>");
			<?php if ($assessments_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->status->caption(), $assessments_add->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($assessments_add->loan_purpose->Required) { ?>
				elm = this.getElements("x" + infix + "_loan_purpose");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->loan_purpose->caption(), $assessments_add->loan_purpose->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_loan_purpose");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_add->loan_purpose->errorMessage()) ?>");
			<?php if ($assessments_add->loan_section->Required) { ?>
				elm = this.getElements("x" + infix + "_loan_section");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->loan_section->caption(), $assessments_add->loan_section->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_loan_section");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_add->loan_section->errorMessage()) ?>");
			<?php if ($assessments_add->customer_last_name->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_last_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->customer_last_name->caption(), $assessments_add->customer_last_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($assessments_add->lat->Required) { ?>
				elm = this.getElements("x" + infix + "_lat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->lat->caption(), $assessments_add->lat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lat");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_add->lat->errorMessage()) ?>");
			<?php if ($assessments_add->lon->Required) { ?>
				elm = this.getElements("x" + infix + "_lon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->lon->caption(), $assessments_add->lon->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lon");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($assessments_add->lon->errorMessage()) ?>");
			<?php if ($assessments_add->personal_id->Required) { ?>
				elm = this.getElements("x" + infix + "_personal_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $assessments_add->personal_id->caption(), $assessments_add->personal_id->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fassessmentsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fassessmentsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fassessmentsadd.lists["x_user_id"] = <?php echo $assessments_add->user_id->Lookup->toClientList($assessments_add) ?>;
	fassessmentsadd.lists["x_user_id"].options = <?php echo JsonEncode($assessments_add->user_id->lookupOptions()) ?>;
	fassessmentsadd.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fassessmentsadd.lists["x_status"] = <?php echo $assessments_add->status->Lookup->toClientList($assessments_add) ?>;
	fassessmentsadd.lists["x_status"].options = <?php echo JsonEncode($assessments_add->status->options(FALSE, TRUE)) ?>;
	fassessmentsadd.lists["x_loan_purpose"] = <?php echo $assessments_add->loan_purpose->Lookup->toClientList($assessments_add) ?>;
	fassessmentsadd.lists["x_loan_purpose"].options = <?php echo JsonEncode($assessments_add->loan_purpose->lookupOptions()) ?>;
	fassessmentsadd.autoSuggests["x_loan_purpose"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fassessmentsadd.lists["x_loan_section"] = <?php echo $assessments_add->loan_section->Lookup->toClientList($assessments_add) ?>;
	fassessmentsadd.lists["x_loan_section"].options = <?php echo JsonEncode($assessments_add->loan_section->lookupOptions()) ?>;
	fassessmentsadd.autoSuggests["x_loan_section"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fassessmentsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $assessments_add->showPageHeader(); ?>
<?php
$assessments_add->showMessage();
?>
<form name="fassessmentsadd" id="fassessmentsadd" class="<?php echo $assessments_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="assessments">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$assessments_add->IsModal ?>">
<?php if ($assessments->getCurrentMasterTable() == "users") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="users">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($assessments_add->user_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($assessments->getCurrentMasterTable() == "loan_purposes") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="loan_purposes">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($assessments_add->loan_purpose->getSessionValue()) ?>">
<?php } ?>
<?php if ($assessments->getCurrentMasterTable() == "loan_section") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="loan_section">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($assessments_add->loan_section->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($assessments_add->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label id="elh_assessments_user_id" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->user_id->caption() ?><?php echo $assessments_add->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->user_id->cellAttributes() ?>>
<?php if ($assessments_add->user_id->getSessionValue() != "") { ?>
<span id="el_assessments_user_id">
<span<?php echo $assessments_add->user_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_add->user_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_user_id" name="x_user_id" value="<?php echo HtmlEncode($assessments_add->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_assessments_user_id">
<?php
$onchange = $assessments_add->user_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_add->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_user_id">
	<input type="text" class="form-control" name="sv_x_user_id" id="sv_x_user_id" value="<?php echo RemoveHtml($assessments_add->user_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($assessments_add->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_add->user_id->getPlaceHolder()) ?>"<?php echo $assessments_add->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_user_id" data-value-separator="<?php echo $assessments_add->user_id->displayValueSeparatorAttribute() ?>" name="x_user_id" id="x_user_id" value="<?php echo HtmlEncode($assessments_add->user_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentsadd"], function() {
	fassessmentsadd.createAutoSuggest({"id":"x_user_id","forceSelect":false});
});
</script>
<?php echo $assessments_add->user_id->Lookup->getParamTag($assessments_add, "p_x_user_id") ?>
</span>
<?php } ?>
<?php echo $assessments_add->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->customer_id->Visible) { // customer_id ?>
	<div id="r_customer_id" class="form-group row">
		<label id="elh_assessments_customer_id" for="x_customer_id" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->customer_id->caption() ?><?php echo $assessments_add->customer_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->customer_id->cellAttributes() ?>>
<span id="el_assessments_customer_id">
<input type="text" data-table="assessments" data-field="x_customer_id" name="x_customer_id" id="x_customer_id" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_add->customer_id->getPlaceHolder()) ?>" value="<?php echo $assessments_add->customer_id->EditValue ?>"<?php echo $assessments_add->customer_id->editAttributes() ?>>
</span>
<?php echo $assessments_add->customer_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->customer_first_name->Visible) { // customer_first_name ?>
	<div id="r_customer_first_name" class="form-group row">
		<label id="elh_assessments_customer_first_name" for="x_customer_first_name" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->customer_first_name->caption() ?><?php echo $assessments_add->customer_first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->customer_first_name->cellAttributes() ?>>
<span id="el_assessments_customer_first_name">
<input type="text" data-table="assessments" data-field="x_customer_first_name" name="x_customer_first_name" id="x_customer_first_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_add->customer_first_name->getPlaceHolder()) ?>" value="<?php echo $assessments_add->customer_first_name->EditValue ?>"<?php echo $assessments_add->customer_first_name->editAttributes() ?>>
</span>
<?php echo $assessments_add->customer_first_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->customer_age->Visible) { // customer_age ?>
	<div id="r_customer_age" class="form-group row">
		<label id="elh_assessments_customer_age" for="x_customer_age" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->customer_age->caption() ?><?php echo $assessments_add->customer_age->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->customer_age->cellAttributes() ?>>
<span id="el_assessments_customer_age">
<input type="text" data-table="assessments" data-field="x_customer_age" name="x_customer_age" id="x_customer_age" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($assessments_add->customer_age->getPlaceHolder()) ?>" value="<?php echo $assessments_add->customer_age->EditValue ?>"<?php echo $assessments_add->customer_age->editAttributes() ?>>
</span>
<?php echo $assessments_add->customer_age->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->sex->Visible) { // sex ?>
	<div id="r_sex" class="form-group row">
		<label id="elh_assessments_sex" for="x_sex" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->sex->caption() ?><?php echo $assessments_add->sex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->sex->cellAttributes() ?>>
<span id="el_assessments_sex">
<input type="text" data-table="assessments" data-field="x_sex" name="x_sex" id="x_sex" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($assessments_add->sex->getPlaceHolder()) ?>" value="<?php echo $assessments_add->sex->EditValue ?>"<?php echo $assessments_add->sex->editAttributes() ?>>
</span>
<?php echo $assessments_add->sex->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->address->Visible) { // address ?>
	<div id="r_address" class="form-group row">
		<label id="elh_assessments_address" for="x_address" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->address->caption() ?><?php echo $assessments_add->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->address->cellAttributes() ?>>
<span id="el_assessments_address">
<input type="text" data-table="assessments" data-field="x_address" name="x_address" id="x_address" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_add->address->getPlaceHolder()) ?>" value="<?php echo $assessments_add->address->EditValue ?>"<?php echo $assessments_add->address->editAttributes() ?>>
</span>
<?php echo $assessments_add->address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->total_score->Visible) { // total_score ?>
	<div id="r_total_score" class="form-group row">
		<label id="elh_assessments_total_score" for="x_total_score" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->total_score->caption() ?><?php echo $assessments_add->total_score->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->total_score->cellAttributes() ?>>
<span id="el_assessments_total_score">
<input type="text" data-table="assessments" data-field="x_total_score" name="x_total_score" id="x_total_score" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_add->total_score->getPlaceHolder()) ?>" value="<?php echo $assessments_add->total_score->EditValue ?>"<?php echo $assessments_add->total_score->editAttributes() ?>>
</span>
<?php echo $assessments_add->total_score->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_assessments_status" for="x_status" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->status->caption() ?><?php echo $assessments_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->status->cellAttributes() ?>>
<span id="el_assessments_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="assessments" data-field="x_status" data-value-separator="<?php echo $assessments_add->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $assessments_add->status->editAttributes() ?>>
			<?php echo $assessments_add->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
</span>
<?php echo $assessments_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->loan_purpose->Visible) { // loan_purpose ?>
	<div id="r_loan_purpose" class="form-group row">
		<label id="elh_assessments_loan_purpose" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->loan_purpose->caption() ?><?php echo $assessments_add->loan_purpose->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->loan_purpose->cellAttributes() ?>>
<?php if ($assessments_add->loan_purpose->getSessionValue() != "") { ?>
<span id="el_assessments_loan_purpose">
<span<?php echo $assessments_add->loan_purpose->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_add->loan_purpose->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_loan_purpose" name="x_loan_purpose" value="<?php echo HtmlEncode($assessments_add->loan_purpose->CurrentValue) ?>">
<?php } else { ?>
<span id="el_assessments_loan_purpose">
<?php
$onchange = $assessments_add->loan_purpose->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_add->loan_purpose->EditAttrs["onchange"] = "";
?>
<span id="as_x_loan_purpose">
	<input type="text" class="form-control" name="sv_x_loan_purpose" id="sv_x_loan_purpose" value="<?php echo RemoveHtml($assessments_add->loan_purpose->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_add->loan_purpose->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_add->loan_purpose->getPlaceHolder()) ?>"<?php echo $assessments_add->loan_purpose->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_loan_purpose" data-value-separator="<?php echo $assessments_add->loan_purpose->displayValueSeparatorAttribute() ?>" name="x_loan_purpose" id="x_loan_purpose" value="<?php echo HtmlEncode($assessments_add->loan_purpose->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentsadd"], function() {
	fassessmentsadd.createAutoSuggest({"id":"x_loan_purpose","forceSelect":false});
});
</script>
<?php echo $assessments_add->loan_purpose->Lookup->getParamTag($assessments_add, "p_x_loan_purpose") ?>
</span>
<?php } ?>
<?php echo $assessments_add->loan_purpose->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->loan_section->Visible) { // loan_section ?>
	<div id="r_loan_section" class="form-group row">
		<label id="elh_assessments_loan_section" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->loan_section->caption() ?><?php echo $assessments_add->loan_section->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->loan_section->cellAttributes() ?>>
<?php if ($assessments_add->loan_section->getSessionValue() != "") { ?>
<span id="el_assessments_loan_section">
<span<?php echo $assessments_add->loan_section->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($assessments_add->loan_section->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_loan_section" name="x_loan_section" value="<?php echo HtmlEncode($assessments_add->loan_section->CurrentValue) ?>">
<?php } else { ?>
<span id="el_assessments_loan_section">
<?php
$onchange = $assessments_add->loan_section->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$assessments_add->loan_section->EditAttrs["onchange"] = "";
?>
<span id="as_x_loan_section">
	<input type="text" class="form-control" name="sv_x_loan_section" id="sv_x_loan_section" value="<?php echo RemoveHtml($assessments_add->loan_section->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_add->loan_section->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($assessments_add->loan_section->getPlaceHolder()) ?>"<?php echo $assessments_add->loan_section->editAttributes() ?>>
</span>
<input type="hidden" data-table="assessments" data-field="x_loan_section" data-value-separator="<?php echo $assessments_add->loan_section->displayValueSeparatorAttribute() ?>" name="x_loan_section" id="x_loan_section" value="<?php echo HtmlEncode($assessments_add->loan_section->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassessmentsadd"], function() {
	fassessmentsadd.createAutoSuggest({"id":"x_loan_section","forceSelect":false});
});
</script>
<?php echo $assessments_add->loan_section->Lookup->getParamTag($assessments_add, "p_x_loan_section") ?>
</span>
<?php } ?>
<?php echo $assessments_add->loan_section->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->customer_last_name->Visible) { // customer_last_name ?>
	<div id="r_customer_last_name" class="form-group row">
		<label id="elh_assessments_customer_last_name" for="x_customer_last_name" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->customer_last_name->caption() ?><?php echo $assessments_add->customer_last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->customer_last_name->cellAttributes() ?>>
<span id="el_assessments_customer_last_name">
<input type="text" data-table="assessments" data-field="x_customer_last_name" name="x_customer_last_name" id="x_customer_last_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_add->customer_last_name->getPlaceHolder()) ?>" value="<?php echo $assessments_add->customer_last_name->EditValue ?>"<?php echo $assessments_add->customer_last_name->editAttributes() ?>>
</span>
<?php echo $assessments_add->customer_last_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->lat->Visible) { // lat ?>
	<div id="r_lat" class="form-group row">
		<label id="elh_assessments_lat" for="x_lat" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->lat->caption() ?><?php echo $assessments_add->lat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->lat->cellAttributes() ?>>
<span id="el_assessments_lat">
<input type="text" data-table="assessments" data-field="x_lat" name="x_lat" id="x_lat" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_add->lat->getPlaceHolder()) ?>" value="<?php echo $assessments_add->lat->EditValue ?>"<?php echo $assessments_add->lat->editAttributes() ?>>
</span>
<?php echo $assessments_add->lat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->lon->Visible) { // lon ?>
	<div id="r_lon" class="form-group row">
		<label id="elh_assessments_lon" for="x_lon" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->lon->caption() ?><?php echo $assessments_add->lon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->lon->cellAttributes() ?>>
<span id="el_assessments_lon">
<input type="text" data-table="assessments" data-field="x_lon" name="x_lon" id="x_lon" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($assessments_add->lon->getPlaceHolder()) ?>" value="<?php echo $assessments_add->lon->EditValue ?>"<?php echo $assessments_add->lon->editAttributes() ?>>
</span>
<?php echo $assessments_add->lon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($assessments_add->personal_id->Visible) { // personal_id ?>
	<div id="r_personal_id" class="form-group row">
		<label id="elh_assessments_personal_id" for="x_personal_id" class="<?php echo $assessments_add->LeftColumnClass ?>"><?php echo $assessments_add->personal_id->caption() ?><?php echo $assessments_add->personal_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $assessments_add->RightColumnClass ?>"><div <?php echo $assessments_add->personal_id->cellAttributes() ?>>
<span id="el_assessments_personal_id">
<input type="text" data-table="assessments" data-field="x_personal_id" name="x_personal_id" id="x_personal_id" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($assessments_add->personal_id->getPlaceHolder()) ?>" value="<?php echo $assessments_add->personal_id->EditValue ?>"<?php echo $assessments_add->personal_id->editAttributes() ?>>
</span>
<?php echo $assessments_add->personal_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("results", explode(",", $assessments->getCurrentDetailTable())) && $results->DetailAdd) {
?>
<?php if ($assessments->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("results", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "resultsgrid.php" ?>
<?php } ?>
<?php
	if (in_array("answers", explode(",", $assessments->getCurrentDetailTable())) && $answers->DetailAdd) {
?>
<?php if ($assessments->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("answers", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "answersgrid.php" ?>
<?php } ?>
<?php if (!$assessments_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $assessments_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $assessments_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$assessments_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$assessments_add->terminate();
?>
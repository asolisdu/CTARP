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
$users_search = new users_search();

// Run the page
$users_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuserssearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($users_search->IsModal) { ?>
	fuserssearch = currentAdvancedSearchForm = new ew.Form("fuserssearch", "search");
	<?php } else { ?>
	fuserssearch = currentForm = new ew.Form("fuserssearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fuserssearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($users_search->id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_created_at");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($users_search->created_at->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_updated_at");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($users_search->updated_at->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fuserssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fuserssearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fuserssearch.lists["x_user_level"] = <?php echo $users_search->user_level->Lookup->toClientList($users_search) ?>;
	fuserssearch.lists["x_user_level"].options = <?php echo JsonEncode($users_search->user_level->lookupOptions()) ?>;
	loadjs.done("fuserssearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_search->showPageHeader(); ?>
<?php
$users_search->showMessage();
?>
<form name="fuserssearch" id="fuserssearch" class="<?php echo $users_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$users_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($users_search->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_id"><?php echo $users_search->id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div <?php echo $users_search->id->cellAttributes() ?>>
			<span id="el_users_id" class="ew-search-field">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$users->userIDAllow("search")) { // Non system admin ?>
<span<?php echo $users_search->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($users_search->id->EditValue)) ?>"></span>
<input type="hidden" data-table="users" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($users_search->id->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<input type="text" data-table="users" data-field="x_id" name="x_id" id="x_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($users_search->id->getPlaceHolder()) ?>" value="<?php echo $users_search->id->EditValue ?>"<?php echo $users_search->id->editAttributes() ?>>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users_search->first_names->Visible) { // first_names ?>
	<div id="r_first_names" class="form-group row">
		<label for="x_first_names" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_first_names"><?php echo $users_search->first_names->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_first_names" id="z_first_names" value="LIKE">
</span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div <?php echo $users_search->first_names->cellAttributes() ?>>
			<span id="el_users_first_names" class="ew-search-field">
<input type="text" data-table="users" data-field="x_first_names" name="x_first_names" id="x_first_names" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($users_search->first_names->getPlaceHolder()) ?>" value="<?php echo $users_search->first_names->EditValue ?>"<?php echo $users_search->first_names->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users_search->last_names->Visible) { // last_names ?>
	<div id="r_last_names" class="form-group row">
		<label for="x_last_names" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_last_names"><?php echo $users_search->last_names->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_last_names" id="z_last_names" value="LIKE">
</span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div <?php echo $users_search->last_names->cellAttributes() ?>>
			<span id="el_users_last_names" class="ew-search-field">
<input type="text" data-table="users" data-field="x_last_names" name="x_last_names" id="x_last_names" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($users_search->last_names->getPlaceHolder()) ?>" value="<?php echo $users_search->last_names->EditValue ?>"<?php echo $users_search->last_names->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users_search->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label for="x__email" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users__email"><?php echo $users_search->_email->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z__email" id="z__email" value="LIKE">
</span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div <?php echo $users_search->_email->cellAttributes() ?>>
			<span id="el_users__email" class="ew-search-field">
<input type="text" data-table="users" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($users_search->_email->getPlaceHolder()) ?>" value="<?php echo $users_search->_email->EditValue ?>"<?php echo $users_search->_email->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users_search->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label for="x_password" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_password"><?php echo $users_search->password->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_password" id="z_password" value="LIKE">
</span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div <?php echo $users_search->password->cellAttributes() ?>>
			<span id="el_users_password" class="ew-search-field">
<input type="text" data-table="users" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($users_search->password->getPlaceHolder()) ?>" value="<?php echo $users_search->password->EditValue ?>"<?php echo $users_search->password->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users_search->user_level->Visible) { // user_level ?>
	<div id="r_user_level" class="form-group row">
		<label for="x_user_level" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_user_level"><?php echo $users_search->user_level->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_user_level" id="z_user_level" value="=">
</span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div <?php echo $users_search->user_level->cellAttributes() ?>>
			<span id="el_users_user_level" class="ew-search-field">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($users_search->user_level->EditValue)) ?>">
<?php } else { ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="users" data-field="x_user_level" data-value-separator="<?php echo $users_search->user_level->displayValueSeparatorAttribute() ?>" id="x_user_level" name="x_user_level"<?php echo $users_search->user_level->editAttributes() ?>>
			<?php echo $users_search->user_level->selectOptionListHtml("x_user_level") ?>
		</select>
</div>
<?php echo $users_search->user_level->Lookup->getParamTag($users_search, "p_x_user_level") ?>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users_search->created_at->Visible) { // created_at ?>
	<div id="r_created_at" class="form-group row">
		<label for="x_created_at" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_created_at"><?php echo $users_search->created_at->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_created_at" id="z_created_at" value="=">
</span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div <?php echo $users_search->created_at->cellAttributes() ?>>
			<span id="el_users_created_at" class="ew-search-field">
<input type="text" data-table="users" data-field="x_created_at" name="x_created_at" id="x_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($users_search->created_at->getPlaceHolder()) ?>" value="<?php echo $users_search->created_at->EditValue ?>"<?php echo $users_search->created_at->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users_search->updated_at->Visible) { // updated_at ?>
	<div id="r_updated_at" class="form-group row">
		<label for="x_updated_at" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_updated_at"><?php echo $users_search->updated_at->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_updated_at" id="z_updated_at" value="=">
</span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div <?php echo $users_search->updated_at->cellAttributes() ?>>
			<span id="el_users_updated_at" class="ew-search-field">
<input type="text" data-table="users" data-field="x_updated_at" name="x_updated_at" id="x_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($users_search->updated_at->getPlaceHolder()) ?>" value="<?php echo $users_search->updated_at->EditValue ?>"<?php echo $users_search->updated_at->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$users_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$users_search->showPageFooter();
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
$users_search->terminate();
?>
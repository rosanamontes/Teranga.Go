<?php
/**
* Plugin init file
* 
* 	Plugin: profiles_go from previous version of @package profile_manager of Coldtrick IT Solutions 2009
*	Author: Rosana Montes Soldado 
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
* 	Project colaborator: Antonio Moles 
*	
*   Project Derivative:
*	TFG: Desarrollo de un sistema de gestión de paquetería para Teranga Go
*   Advisor: Rosana Montes
*   Student: Ricardo Luzón Fernández
* 
*/

require_once(dirname(__FILE__) . "/lib/functions.php");
require_once(dirname(__FILE__) . "/lib/run_once.php");
require_once(dirname(__FILE__) . "/lib/hooks.php");
require_once(dirname(__FILE__) . "/lib/events.php");

define("CUSTOM_PROFILE_FIELDS_CATEGORY_SUBTYPE", "custom_profile_field_category");
define("CUSTOM_PROFILE_FIELDS_PROFILE_TYPE_SUBTYPE", "custom_profile_type");
define("CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE", "custom_profile_field");
define("CUSTOM_PROFILE_FIELDS_TRIP_SUBTYPE", "custom_trip_field");

define("CUSTOM_PROFILE_FIELDS_PROFILE_TYPE_CATEGORY_RELATIONSHIP", "custom_profile_type_category_relationship");

/**
 * initialization of plugin
 *
 * @return void
 */
function profiles_go_init() {
	// register libraries
	elgg_register_js("jquery.ui.multiselect", "mod/profiles_go/vendors/jquery_ui_multiselect/jquery.multiselect.js");
	
	// Extend CSS
	elgg_extend_view("css/admin", "css/profiles_go/global");
	elgg_extend_view("css/admin", "css/profiles_go/admin");
	elgg_extend_view("css/admin", "css/profiles_go/multiselect");
	elgg_extend_view("css/elgg", "css/profiles_go/multiselect");
	elgg_extend_view("css/elgg", "css/profiles_go/global");
	elgg_extend_view("css/elgg", "css/profiles_go/site");
	
	elgg_extend_view("js/elgg", "js/profiles_go/site");
	elgg_extend_view("js/admin", "js/profiles_go/admin");
	
	// Register Page handler
	elgg_register_page_handler("profiles_go", "profiles_go_page_handler");
	
	// admin user add, registered here to overrule default action
	elgg_register_action("useradd", dirname(__FILE__) . "/actions/useradd.php", "admin");
	
	// Register all custom field types
	profiles_go_register_custom_field_types();
	
	// add profile_completeness widget
	if (elgg_get_plugin_setting("enable_profile_completeness_widget", "profiles_go") == "yes") {
		elgg_register_widget_type("profile_completeness", elgg_echo("widgets:profile_completeness:title"), elgg_echo("widgets:profile_completeness:description"), array("profile", "dashboard"));
	}
	
	elgg_register_widget_type("register", elgg_echo("widgets:register:title"), elgg_echo("widgets:register:description"), array("index"));
	
	// free_text on register form
	elgg_extend_view("register/extend_side", "profiles_go/register/free_text");
	
	// where to put extra profile fields
	elgg_extend_view("register/extend_side", "profiles_go/register/fields");
	elgg_extend_view("register/extend", "profiles_go/register/fields");
	
	// login history
	elgg_extend_view('core/settings/statistics', 'profiles_go/account/login_history');
	
	// hook for extending menus
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'profiles_go_register_entity_menu', 600);
	
	// extend public pages
	elgg_register_plugin_hook_handler('public_pages', 'walled_garden', 'profiles_go_public_pages');
	
	elgg_register_plugin_hook_handler('permissions_check:annotate', 'site', 'profiles_go_permissions_check_annotate');
	
	// enable username change
	elgg_extend_view("forms/account/settings", "profiles_go/account/username", 50); // positioned at the beginning of the options

	// register hook for saving the new username
	elgg_register_plugin_hook_handler('usersettings:save', 'user', 'profiles_go_username_change_hook');
	
	// site join event handler
	elgg_register_event_handler("create", "member_of_site", "profiles_go_create_member_of_site");
	
	// always cleanup
	elgg_register_event_handler("delete", "member_of_site", "profiles_go_delete_member_of_site");
	
	// Run once function to configure this plugin
	run_function_once('profiles_go_run_once', 1287964800); // 2010-10-25
	run_function_once('profiles_go_fix_access_default');
	
	// register ajax views
	elgg_register_ajax_view("forms/profiles_go/type");
	elgg_register_ajax_view("forms/profiles_go/category");
	elgg_register_ajax_view("forms/profiles_go/trip_field");
	elgg_register_ajax_view("forms/profiles_go/profile_field");
}

/**
 * Function to handle the nice urls for Profile Manager pages
 *
 * @param array $page pages
 *
 * @return void|boolean
 */
function profiles_go_page_handler($page) {
	switch ($page[0]) {
		case "validate_username":
			if (elgg_is_logged_in()) {
				$new_username = get_input("username");
				$valid = false;
				if (!empty($new_username)) {
					$valid = profiles_go_validate_username($new_username);
				}
				$result = array("valid" => $valid);
				echo json_encode($result);
				
				return true;
			}
			break;
		case "user_summary_control":
			include(dirname(__FILE__) . "/pages/user_summary_control/preview.php");
			return true;
	}
}

/**
 * Function to add menu items to the pages
 *
 * @return void
 */
function profiles_go_pagesetup() 
{
	if (!elgg_in_context('admin') || !elgg_is_admin_logged_in()) {
		return;
	}
		
	elgg_load_js('lightbox');
	elgg_load_css('lightbox');
	
	elgg_register_admin_menu_item('administer', 'export', 'users');
	elgg_register_admin_menu_item('administer', 'inactive', 'users');
	//modificación para teranga go!
	if (elgg_is_active_plugin('mytrips')) {
		elgg_register_admin_menu_item('configure', 'trip_fields', 'appearance');
	}
	
	if (elgg_get_plugin_setting('user_summary_control', 'profiles_go') == 'yes') {
		elgg_register_admin_menu_item('configure', 'user_summary_control', 'appearance');
	}
}

// Initialization functions
elgg_register_event_handler('init', 'system', 'profiles_go_init');
elgg_register_event_handler('pagesetup', 'system', 'profiles_go_pagesetup');

elgg_register_event_handler('create', 'user', 'profiles_go_create_user_event');
elgg_register_event_handler('profileupdate','user', 'profiles_go_profileupdate_user_event');

elgg_register_plugin_hook_handler('profile:fields', 'profile', 'profiles_go_profile_override');
elgg_register_plugin_hook_handler('profile:fields', 'group', 'profiles_go_trip_override');

elgg_register_plugin_hook_handler('action', 'register', 'profiles_go_action_register_hook');
elgg_register_plugin_hook_handler('action', 'mytrips/edit', 'profiles_go_action_mytrips_edit_hook');

elgg_register_plugin_hook_handler('categorized_profile_fields', 'profiles_go', 'profiles_go_categorized_profile_fields_hook', 1000);

// actions
elgg_register_action("profiles_go/new", dirname(__FILE__) . "/actions/new.php", "admin");
elgg_register_action("profiles_go/reset", dirname(__FILE__) . "/actions/reset.php", "admin");
elgg_register_action("profiles_go/reorder", dirname(__FILE__) . "/actions/reorder.php", "admin");
elgg_register_action("profiles_go/delete", dirname(__FILE__) . "/actions/delete.php", "admin");
elgg_register_action("profiles_go/toggleOption", dirname(__FILE__) . "/actions/toggleOption.php", "admin");
elgg_register_action("profiles_go/changeCategory", dirname(__FILE__) . "/actions/changeCategory.php", "admin");
elgg_register_action("profiles_go/importFromCustom", dirname(__FILE__) . "/actions/importFromCustom.php", "admin");
elgg_register_action("profiles_go/importFromDefault", dirname(__FILE__) . "/actions/importFromDefault.php", "admin");
elgg_register_action("profiles_go/export", dirname(__FILE__) . "/actions/export.php", "admin");
elgg_register_action("profiles_go/configuration/backup", dirname(__FILE__) . "/actions/configuration/backup.php", "admin");
elgg_register_action("profiles_go/configuration/restore", dirname(__FILE__) . "/actions/configuration/restore.php", "admin");

elgg_register_action("profiles_go/categories/add", dirname(__FILE__) . "/actions/categories/add.php", "admin");
elgg_register_action("profiles_go/categories/reorder", dirname(__FILE__) . "/actions/categories/reorder.php", "admin");
elgg_register_action("profiles_go/categories/delete", dirname(__FILE__) . "/actions/categories/delete.php", "admin");

elgg_register_action("profiles_go/profile_types/add", dirname(__FILE__) . "/actions/profile_types/add.php", "admin");
elgg_register_action("profiles_go/profile_types/delete", dirname(__FILE__) . "/actions/profile_types/delete.php", "admin");

elgg_register_action("profiles_go/user_summary_control/save", dirname(__FILE__) . "/actions/user_summary_control/save.php", "admin");

elgg_register_action("profiles_go/users/export_inactive", dirname(__FILE__) . "/actions/users/export_inactive.php", "admin");

elgg_register_action("profiles_go/register/validate", dirname(__FILE__) . "/actions/register/validate.php", "public");
	
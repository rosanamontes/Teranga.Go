<?php

/**
 * English strings
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


$english = array(
				
	// entity names
	'item:object:custom_profile_field' => 'Custom Profile Field',
	'item:object:custom_profile_field_category' => 'Custom Profile Field Category',
	'item:object:custom_profile_type' => 'Custom Profile Type',
	'item:object:custom_trip_field' => 'Custom Group Field',

	'profile:custom_profile_type' => 'Custom Profile Type',
	
	// admin menu
	'admin:appearance:trip_fields' => "Edit Group Fields",
	'admin:appearance:export_fields' => "Export Profile Data",
	'admin:appearance:user_summary_control' => "User Summary Control",

	'admin:trips' => "Groups",
	'admin:trips:export' => "Export trips",
	
	'admin:users:export' => "Export users",
	'admin:users:inactive' => "List inactive users",

	// plugin settings
	'profiles_go:settings:registration' => 'Registration',
	'profiles_go:settings:edit_profile' => 'Edit Profile',
	'profiles_go:settings:view_profile' => 'View Profile',
	'profiles_go:settings:trip' => "Edit Group Profile",

	'profiles_go:settings:generate_username_from_email' => 'Generate username from email',
	'profiles_go:settings:profile_icon_on_register' => 'Add mandatory profile icon input field on register form',
	'profiles_go:settings:profile_icon_on_register:option:optional' => 'Optional',
	'profiles_go:settings:show_account_hints' => 'Show hints for default account registration questions',
	'profiles_go:settings:simple_access_control' => 'Show just one access control dropdown on edit profile form',
	'profiles_go:settings:default_profile_type' => "Default profile type on registration form",
	'profiles_go:settings:hide_profile_type_default' => "Hide the 'Default' profile type on registration form",

	'profiles_go:settings:hide_non_editables' => 'Hide the non editable fields from the Edit Profile form',

	'profiles_go:settings:edit_profile_mode' => "How to show the 'edit profile' screen",
	'profiles_go:settings:edit_profile_mode:list' => "List",
	'profiles_go:settings:edit_profile_mode:tabbed' => "Tabbed",

	'profiles_go:settings:show_profile_type_on_profile' => "Show the users profile type on the profile",

	'profiles_go:settings:display_categories' => 'Select how the different categories are displayed on the profile',
	'profiles_go:settings:display_categories:option:plain' => 'Plain',
	'profiles_go:settings:display_categories:option:accordion' => 'Accordion',

	'profiles_go:settings:display_system_category' => 'Show an extra category on the profile with systemdata (only for admins)',

	'profiles_go:settings:profile_type_selection' => 'Who can change the profile type?',
	'profiles_go:settings:profile_type_selection:option:user' => 'User',
	'profiles_go:settings:profile_type_selection:option:admin' => 'Admin only',

	'profiles_go:settings:user_summary_control' => 'Let Profile Manager control the user summary / listing view',
	
	'profiles_go:settings:enable_profile_completeness_widget' => "Enable the profile completeness widget",
	'profiles_go:settings:enable_username_change' => "Allow users to change their username in settings",
	'profiles_go:settings:enable_username_change:option:admin' => "Admin only",
	'profiles_go:settings:enable_site_join_river_event' => "Add a river event when people join this site",
	
	'profiles_go:settings:registration:terms' => "To show an 'Accept terms' field on the registration page, please fill in the URL to the terms below",
	'profiles_go:settings:registration:extra_fields' => "Where to show extra profile fields",
	'profiles_go:settings:registration:extra_fields:extend' => "Below default registration form",
	'profiles_go:settings:registration:extra_fields:beside' => "Beside registration form",
	'profiles_go:settings:registration:free_text' => "Enter extra text to show on the registration page",
	
	
	'profiles_go:settings:trip:trip_limit_name' => "Maximum number of times a trip name can be edited",
	'profiles_go:settings:trip:trip_limit_description' => "Maximum number of times a trip description can be edited",
	'profiles_go:settings:trip:limit:unlimited' => "Unlimited",
	'profiles_go:settings:trip:limit:info' => "These limits do not apply to site administrators",
	
	// Field Configuration
	'profiles_go:admin:metadata_name' => 'Name',
	'profiles_go:admin:metadata_label' => 'Label',
	'profiles_go:admin:metadata_hint' => 'Hint',
	'profiles_go:admin:metadata_placeholder' => 'Placeholder',
	'profiles_go:admin:metadata_label_translated' => 'Label (Translated)',
	'profiles_go:admin:metadata_label_untranslated' => 'Label (Untranslated)',
	'profiles_go:admin:metadata_options' => 'Options (comma separated)',
	'profiles_go:admin:field_type' => "Field Type",
	'profiles_go:admin:options:dropdown' => 'Dropdown',
	'profiles_go:admin:options:go_radio' => 'Radio for Teranga',
	'profiles_go:admin:options:multiselect' => 'MultiSelect',
	'profiles_go:admin:options:file' => 'File',
	'profiles_go:admin:options:pm_rating' => 'Rating',
	'profiles_go:admin:options:pm_twitter' => 'Twitter',
	'profiles_go:admin:options:pm_facebook' => 'Facebook',
	'profiles_go:admin:options:pm_linkedin' => 'LinkedIn',
	'profiles_go:admin:options:go_range' => 'Range for Teranga-HFLTS',
	
	'profiles_go:admin:additional_options' => 'Additional options',
	'profiles_go:admin:show_on_register' => 'Show on register form',
	'profiles_go:admin:mandatory' => 'Mandatory',
	'profiles_go:admin:user_editable' => 'User can edit this field',
	'profiles_go:admin:output_as_tags' => 'Show on profile as tags',
	'profiles_go:admin:admin_only' => 'Admin only field',
	'profiles_go:admin:count_for_completeness' => 'Count this field in profile completeness widget',
	'profiles_go:admin:blank_available' => 'Field has a blank option',
	'profiles_go:admin:option_unavailable' => 'Option unavailable',

	// field options additionals description
	'profiles_go:admin:show_on_register:description' => "If you want this field to be on the register form.",
	'profiles_go:admin:mandatory:description' => "If you want this field to be mandatory (only applies to the register form).",
	'profiles_go:admin:user_editable:description' => "If set to 'No' users can't edit this field (handy when data is managed in an external system).",
	'profiles_go:admin:output_as_tags:description' => "Data output will be handle as tags (only applies on user profile).",
	'profiles_go:admin:admin_only:description' => "Select 'Yes' if field is only available for admins.",
	'profiles_go:admin:blank_available:description' => "Select 'Yes' if a blank option should be added to the field options",

	// profile fields
	'profiles_go:profile_fields:list:title' => "Profile Fields",

	'profiles_go:profile_fields:no_fields' => "Currently no fields are configured using the Profile Manager plugin. Add your own or import with one of the actions below.",
	
	'profiles_go:profile_fields:add' => "Add a new profile field",
	'profiles_go:profile_fields:edit' => "Edit a profile field",
	'profiles_go:profile_fields:add:description' => "Here you can edit the fields a user can edit on his/her profile",

	// trip fields
	'profiles_go:trip_fields:list:title' => "Group Profile Fields",

	'profiles_go:trip_fields:add:description' => "Here you can edit the fields that show on a trip profile page",
	'profiles_go:trip_fields:add' => "Add a new trip profile field",
	'profiles_go:trip_fields:edit' => "Edit a trip profile field",

	// Custom fields categories
	'profiles_go:categories:add' => "Add a new category",
	'profiles_go:categories:edit' => "Edit a category",
	'profiles_go:categories:list:title' => "Categories",
	'profiles_go:categories:list:default' => "Default",
	'profiles_go:categories:list:system' => "System (admin only)",
	'profiles_go:categories:list:view_all' => "View all fields",
	'profiles_go:categories:list:no_categories' => "No categories defined",
	'profiles_go:categories:delete:confirm' => "Are you sure you wish to delete this category?",
	
	// Custom Profile Types
	'profiles_go:profile_types:add' => "Add a new profile type",
	'profiles_go:profile_types:edit' => "Edit a profile type",
	'profiles_go:profile_types:list:title' => "Profile Types",
	'profiles_go:profile_types:list:no_types' => "No profile types defined",
	'profiles_go:profile_types:delete:confirm' => "Are you sure you wish to delete this profile type?",
	'profiles_go:user_details:profile_type' => "Profile Type",
	
	// User Summary Control
	'profiles_go:user_summary_control:config' => "Configuration",
	'profiles_go:user_summary_control:info' => "Add fields to the different containers and see in the preview the result of the configuration. If you are satisfied you can 'Save' the configuration.",
	
	'profiles_go:user_summary_control:container:title' => "Title",
	'profiles_go:user_summary_control:container:entity_menu' => "Entity Menu",
	'profiles_go:user_summary_control:container:subtitle' => "Subtitle",
	'profiles_go:user_summary_control:container:content' => "Content",
	
	'profiles_go:user_summary_control:options:spacers' => "Spacers",
	'profiles_go:user_summary_control:options:spacers:new_line' => "New line",
	'profiles_go:user_summary_control:options:spacers:space' => "Space",
	'profiles_go:user_summary_control:options:spacers:dash' => "-",
	
	// profile manager inactive users
	'profiles_go:admin:users:inactive:last_login' => "Last login before",
	'profiles_go:admin:users:inactive:list' => "Inactive users",

	// admin actions
	'profiles_go:actions:title' => 'Actions',

	// Reset
	'profiles_go:actions:reset:description' => 'Removes all custom profile fields',
	'profiles_go:actions:reset:confirm' => 'Are you sure you wish to reset all profile fields?',
	'profiles_go:actions:reset:error:unknown' => 'Unknown error occurred while resetting all profile fields',
	'profiles_go:actions:reset:error:wrong_type' => 'Wrong profile field type (trip or profile)',
	'profiles_go:actions:reset:success' => 'Reset succesful',

	// import from custom
	'profiles_go:actions:import:from_custom' => 'Import custom fields',
	'profiles_go:actions:import:from_custom:description' => 'Imports previous defined (with default Elgg functionality) profile fields',
	'profiles_go:actions:import:from_custom:confirm' => 'Are you sure you wish to import custom fields?',
	'profiles_go:actions:import:from_custom:no_fields' => 'No custom fields available for import',
	'profiles_go:actions:import:from_custom:new_fields' => 'Succesfully imported <b>%s</b> new fields',

	// import from default
	'profiles_go:actions:import:from_default' => 'Import default fields',
	'profiles_go:actions:import:from_default:description' => "Imports Elgg's default fields",
	'profiles_go:actions:import:from_default:confirm' => 'Are you sure you wish to import default fields?',
	'profiles_go:actions:import:from_default:no_fields' => 'No default fields available for import',
	'profiles_go:actions:import:from_default:new_fields' => 'Succesfully imported <b>%s</b> new fields',
	'profiles_go:actions:import:from_default:error:wrong_type' => 'Wrong profile field type (trip or profile)',

	// Export
	'profiles_go:actions:export:description' => "Export profile data to a csv file",
	'profiles_go:export:title' => "Export Profile Data",
	'profiles_go:export:description:custom_profile_field' => "This function will export all <b>user</b> metadata based on selected fields.",
	'profiles_go:export:description:custom_trip_field' => "This function will export all <b>trip</b> metadata based on selected fields.",
	'profiles_go:export:list:title' => "Select the fields which you want to be exported",
	'profiles_go:export:list:include_trip_membership' => "Include trip membership",
	'profiles_go:export:nofields' => "No custom profile fields available for export",

	// Group Edit
	'profiles_go:trip:edit:limit' => "You can edit this field %s more time(s)",
	
	// Configuration Backup and Restore
	'profiles_go:actions:configuration:backup' => "Backup",
	'profiles_go:actions:configuration:backup:description' => "Backup the configuration of these fields (categories and types are not backed up)",
	'profiles_go:actions:configuration:restore' => "Restore",
	'profiles_go:actions:configuration:restore:description' => "Restore a previously backed up configuration file (<b>you will loose relations between fields and categories</b>)",
	
	'profiles_go:actions:configuration:restore:upload' => "Restore",

	'profiles_go:actions:restore:success' => "Restore successful",
	'profiles_go:actions:restore:error:deleting' => "Error while restoring: couldn't delete current fields",
	'profiles_go:actions:restore:error:fieldtype' => "Error while restoring: fieldtypes do not match",
	'profiles_go:actions:restore:error:corrupt' => "Error while restoring: backup file seems to be corrupt or information is missing",
	'profiles_go:actions:restore:error:json' => "Error while restoring: invalid json file",
	'profiles_go:actions:restore:error:nofile' => "Error while restoring: no file uploaded",

	// new
	'profiles_go:actions:new:success' => 'Succesfully added new custom profile field',
	'profiles_go:actions:new:error:metadata_name_missing' => 'No metadata name provided',
	'profiles_go:actions:new:error:metadata_name_invalid' => 'Metadata name is an invalid name',
	'profiles_go:actions:new:error:metadata_options' => 'You need to enter options when using this type',
	'profiles_go:actions:new:error:unknown' => 'Unknown error occurred when saving a new custom profile field',
	'profiles_go:action:new:error:type' => 'Wrong profile field type (trip or profile)',
	
	// edit
	'profiles_go:actions:edit:error:unknown' => 'Error fetching profile field data',

	//delete
	'profiles_go:actions:delete:confirm' => 'Are you sure you wish to delete this field?',
	'profiles_go:actions:delete:error:unknown' => 'Unknown error occurred while deleting',

	// toggle option
	'profiles_go:actions:toggle_option:error:unknown' => 'Unknown error occurred while changing the option',

	// category to field
	'profiles_go:actions:change_category:error:unknown' => "An unknown error occured while changing the category",

	// add category
	'profiles_go:action:category:add:error:name' => "No name or an invalid name provided for the category",
	'profiles_go:action:category:add:error:object' => "Error while creating the category object",
	'profiles_go:action:category:add:error:save' => "Error while saving the category object",
	'profiles_go:action:category:add:succes' => "The category was created succesfully",

	// delete category
	'profiles_go:action:category:delete:error:guid' => "No GUID provided",
	'profiles_go:action:category:delete:error:type' => "The provided GUID is not a custom profile field category",
	'profiles_go:action:category:delete:error:delete' => "An error occured while deleting the category",
	'profiles_go:action:category:delete:succes' => "The category was deleted succesfully",

	// add profile type
	'profiles_go:action:profile_types:add:error:name' => "No name or an invalid name provided for the Custom Profile Type",
	'profiles_go:action:profile_types:add:error:object' => "Error while creating the Custom Profile Type",
	'profiles_go:action:profile_types:add:error:save' => "Error while saving the Custom Profile Type",
	'profiles_go:action:profile_types:add:succes' => "The Custom profile Type was created succesfully",
	
	// delete profile type
	'profiles_go:action:profile_types:delete:error:guid' => "No GUID provided",
	'profiles_go:action:profile_types:delete:error:type' => "The provided GUID is not an Custom Profile Type",
	'profiles_go:action:profile_types:delete:error:delete' => "An unknown error occured while deleting the Custom Profile Type",
	'profiles_go:action:profile_types:delete:succes' => "The Custom Profile Type was deleted succesfully",
	
	// change username action
	'profiles_go:action:username:change:succes' => "Successfully changed your username",

	// Tooltips
	'profiles_go:tooltips:profile_field' => "
		<b>Profile Field</b><br />
		Here you can add a new profile field.<br /><br />
		If you leave the label empty, you can internationalize the profile field label (<i>profile:[name]</i>).<br /><br />
		Use the hint field to supply on input forms (register and profile/trip edit) a hoverable icon with a field description.
		If you leave the hint empty, you can internationalize the hint (<i>profile:hint:[name]</i>).<br /><br />
		Options are only mandatory for fieldtypes <i>Dropdown, Radio and MultiSelect</i>.
	",
	'profiles_go:tooltips:profile_field_additional' => "
		<b>Show on register</b><br />
		If you want this field to be on the register form.<br /><br />
		
		<b>Mandatory</b><br />
		If you want this field to be mandatory (only applies to the register form).<br /><br />
		
		<b>User editable</b><br />
		If set to 'No' users can't edit this field (handy when data is managed in an external system).<br /><br />
		
		<b>Show as tags</b><br />
		Data output will be handle as tags (only applies on user profile).<br /><br />
		
		<b>Admin only field</b><br />
		Select 'Yes' if field is only available for admins.
	",
	'profiles_go:tooltips:category' => "
		<b>Category</b><br />
		Here you can add a new profile category.<br /><br />
		If you leave the label empty, you can internationalize the category label (<i>profile:categories:[name]</i>).<br /><br />
		
		If Profile Types are defined you can choose on which profile type this category applies. If no profile is specified, the category applies to all profile types (even undefined).
	",
	'profiles_go:tooltips:category_list' => "
		<b>Categories</b><br />
		Shows a list of all configured categories.<br /><br />
		
		<i>Default</i> is the category that applies to all profiles.<br /><br />
		
		Add fields to these categories by dropping them on the categories.<br /><br />
		
		Click the category label to filter the visible fields. Clicking view all fields shows all fields.<br /><br />
		
		You can also change the order of the categories by dragging them (<i>Default can't be dragged</i>. <br /><br />
		
		Click the edit icon to edit the category.
	",
	'profiles_go:tooltips:profile_type' => "
		<b>Profile Type</b><br />
		Here you can add a new profile type.<br /><br />
		If you leave the label empty, you can internationalize the profile type label (<i>profile:types:[name]</i>).<br /><br />
		Enter a description which users can see when selecting this profile type or leave it empty to internationalize (<i>profile:types:[name]:description</i>).<br /><br />
		
		If Categories are defined you can choose which categories apply to this profile type.
	",
	'profiles_go:tooltips:profile_type_list' => "
		<b>Profile Types</b><br />
		Shows a list of all configured profile types.<br /><br />
		Click the edit icon to edit the profile type.
	",
	'profiles_go:tooltips:actions' => "
		<b>Actions</b><br />
		Various actions related to these profile fields.
	",
	
	// custom input/output views
	'profiles_go:pm_twitter:input:placeholder' => "Enter your Twitter username here",
	'profiles_go:pm_twitter:output:follow' => "Follow @%s",
	'profiles_go:pm_facebook:input:placeholder' => "Enter your Facebook profile url here",
	'profiles_go:pm_linkedin:input:placeholder' => "Enter your LinkedIn profile url here",

	// widgets
	'widgets:profile_completeness:title' => 'Profile Completeness',
	'widgets:profile_completeness:description' => 'Show the profile completeness',
	'widgets:profile_completeness:view:tips' => 'Tip! Update your %s to improve the Profile Completeness.',
	'widgets:profile_completeness:view:complete' => 'Congratulations! Your profile is 100% complete!',
	
	'widgets:register:title' => "Register",
	'widgets:register:description' => "Show a register box",
	'widgets:register:loggedout' => "You need to be logged out to use this widget",

	'profiles_go:input:multi_select:empty_text' => 'Please select ...',

	// Edit profile => profile type selector
	'profiles_go:profile:edit:custom_profile_type:label' => "Select your profile type",
	'profiles_go:profile:edit:custom_profile_type:description' => "Description of selected profile type",
	'profiles_go:profile:edit:custom_profile_type:default' => "Default",

	// non_editable
	'profiles_go:non_editable:info' => 'This field can not be edited',
	
	// register form mandatory notice
	'profiles_go:register:mandatory' => "Items marked with a * are mandatory",

	// register account field hints
	'profiles_go:register:hints:name' => "Enter the name which will be shown on your profile",
	'profiles_go:register:hints:username' => "You can use your username to login",
	'profiles_go:register:hints:email' => "This emailadres will be used to send you mails. Other users can not see this emailadres",
	'profiles_go:register:hints:password' => "You will need a password to login to the site",
	'profiles_go:register:hints:passwordagain' => "Enter the same password again for validation",
	
	// register profile icon
	'profiles_go:register:profile_icon' => 'This site requires you to upload a profile icon',
	
	// register accept terms
	'profiles_go:registration:accept_terms' => "I have read and accept the %sTerms of Service%s",

	// simple access control
	'profiles_go:simple_access_control' => 'Select who can view your profile information',

	// register pre check
	'profiles_go:register_pre_check:missing' => 'The next field must be filled: %s',
	'profiles_go:register_pre_check:terms' => 'You need to accept the terms to complete the registration',
	'profiles_go:register_pre_check:profile_icon:error' => 'Error uploading your profile icon (probably related to the file size)',
	'profiles_go:register_pre_check:profile_icon:nosupportedimage' => "Can't handle the profile icon. Maybe the uploaded profile icon is not the right type (jpg, gif, png)?",

	// Admin add user form
	'profiles_go:admin:adduser:notify' => "Notify user",
	'profiles_go:admin:adduser:use_default_access' => "Extra metadata created based on site default access level",
	'profiles_go:admin:adduser:extra_metadata' => "Add extra profile data",
	
	// change username form
	'profiles_go:account:username:button' => "Click to change your username",
	'profiles_go:account:username:info' => "Change your username. An icon will tell you if the username entered is valid and available.",
	
	// river events
	'river:join:site:default' => '%s joined the site',

	// login history
	'profiles_go:account:login_history' => "Login History",
	'profiles_go:account:login_history:date' => "Date",
	'profiles_go:account:login_history:ip' => "IP Address",
	

);

add_translation("en", $english);
	
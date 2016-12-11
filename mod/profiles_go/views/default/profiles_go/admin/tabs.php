<?php
/*
* Tab view - Uses @package mytrips
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

$settings_selected = elgg_extract("settings_selected", $vars, false);
$profile_fields_selected = elgg_extract("profile_fields_selected", $vars, false);
$user_summary_control_selected = elgg_extract("user_summary_control_selected", $vars, false);
$trip_fields_selected = elgg_extract("trip_fields_selected", $vars, false);

$tabs = array (array("text" => elgg_echo("admin:appearance:profile_fields"), "href" => "admin/appearance/profile_fields", "selected" => $profile_fields_selected));

if (elgg_get_plugin_setting("user_summary_control", "profiles_go") == "yes") {
	$tabs[] = array("text" => elgg_echo("admin:appearance:user_summary_control"), "href" => "admin/appearance/user_summary_control", "selected" => $user_summary_control_selected);
}
//para teranga go!
if (elgg_is_active_plugin("mytrips")) {
	$tabs[] = array("text" => elgg_echo("admin:appearance:trip_fields"), "href" => "admin/appearance/trip_fields", "selected" => $trip_fields_selected);
}
		
$tabs[] = array("text" => elgg_echo("settings"), "href" => "admin/plugin_settings/profiles_go", "selected" => $settings_selected);

echo elgg_view("navigation/tabs", array("tabs" => $tabs));

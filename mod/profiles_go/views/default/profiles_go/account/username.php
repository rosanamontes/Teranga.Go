<?php
/*
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

$enable_username_change = elgg_get_plugin_setting("enable_username_change", "profiles_go");
if ($enable_username_change == "yes" || ($enable_username_change == "admin" && elgg_is_admin_logged_in())) {
	
	$user = elgg_get_page_owner_entity();
	
	$body = elgg_view("input/button", array("href" => "#profiles_go_username", "rel" => "toggle", "value" => elgg_echo("profiles_go:account:username:button"), "class" => "elgg-button-action profile-manager-account-change-username"));
	$body .= "<div id='profiles_go_username' class='hidden'>";
	$body .= elgg_view_icon("profile-manager-loading") . elgg_view_icon("profile-manager-valid") . elgg_view_icon("profile-manager-invalid");
	$body .= elgg_view("input/text", array("name" => "username", "value" => $user->username, "rel" => $user->username));
	$body .= "<div class='elgg-subtext'>" . elgg_echo("profiles_go:account:username:info") . "</div>";
	$body .= "</div>";
	
	echo elgg_view_module("info" , elgg_echo("username"), $body);
}

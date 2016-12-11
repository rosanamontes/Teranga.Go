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


$user = elgg_get_page_owner_entity();

$log = get_system_log($user->guid, "login", "", 'user', '', 20);

if ($log) {
	$body = "<table class='elgg-table'>";
	$body .= "<thead><tr>";
	$body .= "<th>" . elgg_echo('profiles_go:account:login_history:date') . "</th><th>" . elgg_echo('profiles_go:account:login_history:ip') . "</th>";
	$body .= "</tr></thead>";
	$body .= "<tbody>";
					
	foreach ($log as $entry) {
		if ($entry->ip_address) {
			$ip_address = $entry->ip_address;
		} else {
			$ip_address = elgg_echo('unknown');
		}
		
		$time = date(elgg_echo("friendlytime:date_format"), $entry->time_created);
		
		$body .= "<tr><td>" . $time . "</td><td>" . $ip_address . "</td></tr>";
	}
	
	$body .= "</tbody></table>";

	echo elgg_view_module("info", elgg_echo('profiles_go:account:login_history'), $body);
}

<?php

/*
* Export inactive users
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

set_time_limit(0);

$last_login = sanitise_int(get_input("last_login"), false);

if (!empty($last_login)) {
	$dbprefix = elgg_get_config("dbprefix");
	
	$options = array(
		"type" => "user",
		"limit" => false,
		"relationship" => "member_of_site",
		"relationship_guid" => elgg_get_site_entity()->getGUID(),
		"inverse_relationship" => true,
		"site_guids" => false,
		"joins" => array("JOIN " . $dbprefix . "users_entity ue ON e.guid = ue.guid"),
		"wheres" => array("ue.last_login <= " . $last_login),
		"order_by" => "ue.last_login"
	);
	
	$users = elgg_get_entities_from_relationship($options);
	if ($users) {
		$fields = array("username", "name", "email", "last_login", "banned");
		
		// We'll be outputting a CSV
		// It will be called export_inactive.csv
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=export_inactive.csv");
		header("Content-Transfer-Encoding: binary");
		
		ob_start();
		
		$df = fopen("php://output", 'w');
		
		$headers = array();
		foreach ($fields as $field) {
			$headers[] = $field;
		}
		fputcsv($df, $headers, ";");

		foreach ($users as $user) {
			$row = array();
			foreach ($fields as $field) {
				$row[] = $user->$field;
			}
			fputcsv($df, $row, ";");
		}
		
		fclose($df);
		
		echo ob_get_clean();

		exit();
	} else {
		system_message(elgg_echo("InvalidParameterException:NoDataFound"));
		forward(REFERER);
	}
} else {
	register_error(elgg_echo("InvalidParameterException:NoDataFound"));
	forward(REFERER);
}

<?php
/**
* export profile data action
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




global $DB_QUERY_CACHE;
$DB_QUERY_CACHE = false; // no need for cache. Will only cause OOM issues

set_time_limit(0);
	
$filename = 'export.csv';
	
$fieldtype = get_input("fieldtype");
$fields = get_input("export");
	
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename={$filename}");
header("Content-Transfer-Encoding: binary");

ob_start();

$df = fopen("php://output", 'w');
	
if (!empty($fieldtype) && !empty($fields)) {
	if ($fieldtype == CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE || $fieldtype == CUSTOM_PROFILE_FIELDS_TRIP_SUBTYPE) {
		$include_mytrips = false;
		
		$options = array(
			"limit" => false
		);
		
		if ($fieldtype == CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE) {
			$type = "user";
			$options["relationship"] = "member_of_site";
			$options["relationship_guid"] = elgg_get_site_entity()->getGUID();
			$options["inverse_relationship"] = true;
			$options["site_guids"] = false;
			
			if (get_input("include_trip_membership")) {
				$include_mytrips = true;
			}
		} else {
			$type = "trip";
		}
			
		$options["type"] = $type;
		
		$headers = array();
		foreach ($fields as $field) {
			$headers[] = $field;
		}
		if ($include_mytrips) {
			$headers[] = "trip membership";
		}
		fputcsv($df, $headers, ";");
		
		$trip_options = array (
				"selects" => array("ge.name"),
				"type" => "trip",
				"relationship" => "member",
				"joins" => array("JOIN " . elgg_get_config("dbprefix") . "mytrips_entity ge ON e.guid = ge.guid"),
				"inverse_relationship" => false,
				"callback" => "profiles_go_export_trip_name"
			);
		
		$entities = new ElggBatch('elgg_get_entities_from_relationship', $options);
		if (!empty($entities)) {
			foreach ($entities as $entity) {
				$row = array();
				foreach ($fields as $field) {
					$field_data = $entity->$field;
					if (is_array($field_data)) {
						$field_data = implode(",", $field_data);
					}
					$row[] = $field_data;
				}
				if ($include_mytrips) {
					$trip_options["relationship_guid"] = $entity->guid;
					$mytrips = elgg_get_entities_from_relationship($trip_options);
					
					$mytrips_text = implode(",", $mytrips);
					
					$row[] = "$mytrips_text";
				}
				fputcsv($df, $row, ";");
			}
		}
	}
		
	fclose($df);

	echo ob_get_clean();
	exit;
}

exit();

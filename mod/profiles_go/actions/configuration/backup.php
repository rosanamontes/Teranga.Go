<?php
/**
* Backup of profile fields config
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

// We'll be outputting a txt
header("Content-Type: text/plain");
	
// It will be called custom_profile_fields.backup.json.txt
header('Content-Disposition: attachment; filename="profile_fields_backup.txt"');

$fieldtype = get_input("fieldtype" , CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE);

$options = array(
		"type" => "object",
		"subtype" => $fieldtype,
		"limit" => false,
		"owner_guid" => elgg_get_site_entity()->getGUID()
	);

$entities = elgg_get_entities($options);

$info = array("fieldtype" => $fieldtype);

$fields = array();
foreach ($entities as $entity) {
	$fields[] = array(
		"metadata_name" => $entity->metadata_name,
		"metadata_label" => $entity->metadata_label,
		"metadata_hint" => $entity->metadata_hint,
		"metadata_type" => $entity->metadata_type,
		"metadata_options" => $entity->metadata_options,
		"show_on_register" => $entity->show_on_register,
		"mandatory" => $entity->mandatory,
		"user_editable" => $entity->user_editable,
		"output_as_tags" => $entity->output_as_tags,
		"admin_only" => $entity->admin_only,
		"blank_available" => $entity->blank_available,
		"order" => $entity->order,
		"count_for_completeness" => $entity->count_for_completeness
	);
}
	
$md5 = md5(print_r($fields, true));
$info["md5"] = $md5;

if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
	// JSON_PRETTY_PRINT available
	$json = json_encode(
		array(
			"info" => $info,
			"fields" => $fields
		),
		JSON_PRETTY_PRINT
	);
} else {
	$json = json_encode(
		array(
			"info" => $info,
			"fields" => $fields
		)
	);
}

echo $json;
exit();

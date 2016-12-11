<?php
/**
* Toggle metadata view
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

$entity = $vars['entity'];
$metadata_type = $entity->metadata_type;
$metadata_name = $vars['metadata_name'];

$types = array();
$type_options = array();

if ($entity->getSubType() == CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE) {
	$types = profiles_go_get_custom_field_types("custom_profile_field_types");
} elseif ($entity->getSubType() == CUSTOM_PROFILE_FIELDS_TRIP_SUBTYPE) {
	$types = profiles_go_get_custom_field_types("custom_trip_field_types");
}
	
if (!empty($metadata_type) && !empty($types) && array_key_exists($metadata_type, $types)) {
	$type_options = $types[$metadata_type]->options;
}

$id = $metadata_name . "_" . $entity->guid;
	
$class = "";
$onclick = "";

// if no option is available in the register, this metadata field can't be toggled
if (!empty($type_options) && array_key_exists($metadata_name, $type_options) && $type_options[$metadata_name]) {
	if ($entity->$metadata_name != "yes") {
		$class = " field_config_metadata_option_disabled";
	} else {
		$class = " field_config_metadata_option_enabled";
	}
	$title = elgg_echo('profiles_go:admin:' . $metadata_name);
	$onclick = "onclick='elgg.profiles_go.toggle_option(\"" . $metadata_name . "\", " . $entity->guid . "); return false;'";
} else {
	$title = elgg_echo('profiles_go:admin:option_unavailable');
}
echo "<span title='" . $title . "' class='field_config_metadata_option" . $class . "' id='" . $id . "' " . $onclick . "></span>";

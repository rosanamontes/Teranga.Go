<?php
/**
* Action to toggle profile field metadata
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




$allowed = array("mandatory", "show_on_register", "user_editable", "output_as_tags", "admin_only", "count_for_completeness");

$guid = get_input("guid");
$field = get_input("field");

if (!empty($guid) && in_array($field, $allowed)) {
	$entity = get_entity($guid);
	if ($entity->getSubtype() == CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE || $entity->getSubtype() == CUSTOM_PROFILE_FIELDS_TRIP_SUBTYPE) {
		if ($entity->$field == "yes") {
			$entity->$field = "no";
		} else {
			$entity->$field = "yes";
		}
		// need to save to trigger a memcache update
		$entity->save();
		echo "true";
	}
}

exit();

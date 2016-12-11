<?php
/**
* jQuery call to remove a custom_profile_field or custom_trip_field
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





$guid = get_input("guid");

if (!empty($guid)) {
	$entity = get_entity($guid);
	$site_guid = $entity->site_guid;
	
	if (!empty($entity) && ($entity->getSubtype() == CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE || $entity->getSubtype() == CUSTOM_PROFILE_FIELDS_TRIP_SUBTYPE)) {
		if ($entity->delete()) {
			echo "true";
			
			// clear cache
			elgg_get_system_cache()->delete("profiles_go_profile_fields_" . $site_guid);
			elgg_get_system_cache()->delete("profiles_go_trip_fields_" . $site_guid);
		}
	}
}

exit();

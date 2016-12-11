<?php
/**
* jQuery Profile Field change category
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
$category_guid = get_input("category_guid");

if (!empty($guid)) {
	$entity = get_entity($guid);
	if ($entity->getSubtype() == CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE || $entity->getSubtype() == CUSTOM_PROFILE_FIELDS_TRIP_SUBTYPE) {
		if (!empty($category_guid)) {
			$entity->category_guid = $category_guid;
		} else {
			unset($entity->category_guid);
		}
		echo "true";
		
		// trigger memcache update
		$entity->save();
	}
}

exit();

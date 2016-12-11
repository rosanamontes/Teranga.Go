<?php
/**
* Profile Type Delete action
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
	
	if ($entity->getSubtype() == CUSTOM_PROFILE_FIELDS_PROFILE_TYPE_SUBTYPE) {
		if ($entity->delete()) {
			$meta_name = "custom_profile_type";
			// remove corresponding profile type metadata from userobjects
			
			$options = array(
					"type" => "user",
					"limit" => false,
					"metadata_name_value_pairs" => array("name" => $meta_name, "value" => $guid)
				);
			
			if ($entities = elgg_get_entities_from_metadata($options)) {
				foreach ($entities as $entity) {
					// unset currently deleted profile type for user
					unset($entity->$meta_name);
				}
			}
			
			system_message(elgg_echo("profiles_go:action:profile_types:delete:succes"));
		} else {
			register_error(elgg_echo("profiles_go:action:profile_types:delete:error:delete"));
		}
	} else {
		register_error(elgg_echo("profiles_go:action:profile_types:delete:error:type"));
	}
} else {
	register_error(elgg_echo("profiles_go:action:profile_types:delete:error:guid"));
}

forward(REFERER);

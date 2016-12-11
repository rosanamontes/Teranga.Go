<?php

/**
* Category delete action
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
	
	if ($entity instanceof ProfileManagerCustomFieldCategory) {
		$options = array(
			"type" => "object",
			"subtype" => CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE,
			"limit" => false,
			"owner_guid" => elgg_get_site_entity()->getGUID(),
			"metadata_name_value_pairs" => array("name" => "category_guid", "value" => $guid)
		);
		
		// remove reference to this category on related profile fields
		$fields = elgg_get_entities_from_metadata($options);
		if ($fields) {
			foreach ($fields as $field) {
				unset($field->category_guid);
			}
		}
		
		if ($entity->delete()) {
			system_message(elgg_echo("profiles_go:action:category:delete:succes"));
		} else {
			register_error(elgg_echo("profiles_go:action:category:delete:error:delete"));
		}
	} else {
		register_error(elgg_echo("profiles_go:action:category:delete:error:type"));
	}
} else {
	register_error(elgg_echo("profiles_go:action:category:delete:error:guid"));
}

forward(REFERER);

<?php
/**
* Action to reset profile fields
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




$type = get_input("type", "profile");
$error = false;

if ($type == "profile" || $type == "trip") {
	$site_guid = elgg_get_site_entity()->getGUID();
	
	$options = array(
		"type" => "object",
		"subtype" => "custom_" . $type . "_field",
		"limit" => false,
		"owner_guid" => $site_guid
	);
	
	if ($entities = elgg_get_entities($options)) {
		foreach ($entities as $entity) {
			if (!$entity->delete()) {
				$error = true;
			}
		}
	}
	
	elgg_get_system_cache()->delete("profiles_go_" . $type . "_fields_" . $site_guid);
	
	if (!$error) {
		system_message(elgg_echo("profiles_go:actions:reset:success"));
	} else {
		register_error(elgg_echo("profiles_go:actions:reset:error:unknown"));
	}
} else {
	register_error(elgg_echo("profiles_go:actions:reset:error:wrong_type"));
}

forward(REFERER);

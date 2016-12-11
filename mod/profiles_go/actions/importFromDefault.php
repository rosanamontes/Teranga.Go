<?php
/**
* Action to import from default
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


$site_guid = elgg_get_site_entity()->getGUID();

$type = get_input("type", "profile");

if ($type == "profile" || $type == "trip") {
	$added = 0;
	$defaults = array();
	
	$options = array(
			"type" => "object",
			"subtype" => "custom_" . $type . "_field",
			"count" => true,
			"owner_guid" => $site_guid
		);
	
	$max_fields = elgg_get_entities($options) + 1;

	if ($type == "profile") {
		// Profile defaults
		$defaults = array (
				'description' => 'longtext',
				'briefdescription' => 'text',
				'location' => 'location',
				'interests' => 'tags',
				'skills' => 'tags',
				'contactemail' => 'email',
				'phone' => 'text',
				'mobile' => 'text',
				'website' => 'url',
				'twitter' => 'text'
			);
	} elseif ($type == "trip") {
		// Group defaults
		$defaults = array(
			'description' => 'longtext',
			'briefdescription' => 'text',
			'interests' => 'tags'
		);
	}
	
	foreach ($defaults as $metadata_name => $metadata_type) {
		$options["metadata_name_value_pairs"] = array("name" => "metadata_name", "value" => $metadata_name);
		
		$count = elgg_get_entities_from_metadata($options);
		
		if ($count == 0) {
			$field = new ElggObject(); // not using classes so we can handle both profile and trip in one function
					
			$field->owner_guid = $site_guid;
			$field->container_guid = $site_guid;
			$field->access_id = ACCESS_PUBLIC;
			$field->subtype = "custom_" . $type . "_field";
			$field->save();
			
			$field->metadata_name = $metadata_name;
			$field->metadata_type = $metadata_type;
			
			if ($type == "profile") {
				$field->show_on_register = "no";
				$field->mandatory = "no";
				$field->user_editable = "yes";
			}
			$field->order = $max_fields;
			
			$field->save();
			
			$max_fields++;
			$added++;
		}
	}
	
	if ($added == 0) {
		register_error(elgg_echo("profiles_go:actions:import:from_default:no_fields"));
	} else {
		elgg_get_system_cache()->delete("profiles_go_" . $type . "_fields_" . $site_guid);
		system_message(elgg_echo("profiles_go:actions:import:from_default:new_fields", array($added)));
	}
} else {
	register_error(elgg_echo("profiles_go:actions:import:from_default:error:wrong_type"));
}

forward(REFERER);

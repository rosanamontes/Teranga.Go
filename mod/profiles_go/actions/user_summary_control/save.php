<?php

/*
* Save config
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

$config_positions = array("title", "entity_menu", "subtitle", "content");

$new_config = array();

foreach ($config_positions as $position) {
	$position_input = get_input("config_" . $position, false);
	if (!empty($position_input)) {
		foreach ($position_input as $field) {
			if (!empty($field)) {
				$new_config[$position][] = $field;
			}
		}
	}
}

if (!empty($new_config)) {
	$config = json_encode($new_config);
	$result = elgg_set_plugin_setting("user_summary_config", $config, "profiles_go");
} else {
	$result = elgg_unset_plugin_setting("user_summary_config", "profiles_go");
}

if ($result) {
	system_message(elgg_echo("admin:configuration:success"));
} else {
	register_error(elgg_echo("admin:configuration:fail"));
}

forward(REFERER);

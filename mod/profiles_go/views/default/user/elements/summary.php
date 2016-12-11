<?php
/**
 * User summary
 *
 * @uses $vars['entity']    ElggEntity
 * @uses $vars['title']     Title link (optional) false = no title, '' = default
 * @uses $vars['metadata']  HTML for entity metadata and actions (optional)
 * @uses $vars['subtitle']  HTML for the subtitle (optional)
 * @uses $vars['tags']      HTML for the tags (optional)
 * @uses $vars['content']   HTML for the entity content (optional)
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


if ((elgg_get_plugin_setting("user_summary_control", "profiles_go") == "yes") && !$vars["entity"]->isBanned() && !elgg_in_context("admin")) 
{
	
	$current_config = elgg_get_plugin_setting("user_summary_config", "profiles_go");
	if (!empty($current_config)) {
		$current_config = json_decode($current_config, true);
	}
	
	$profile_fields = elgg_get_config("profile_fields");
	
	if (!empty($current_config) && is_array($current_config) && !empty($profile_fields)) {
		$config_positions = array("title", "subtitle", "content"); // entity_menu is handled in a hook
		
		foreach ($config_positions as $position) {
			if ($position !== "title") {
				$vars[$position] = "";
			}

			if (array_key_exists($position, $current_config)) {
				$fields = $current_config[$position];
				$spacer_allowed = true;
				$spacer_result = "";

				foreach ($fields as $field) {
					$field_result = "";
					
					switch ($field) {
						case "spacer_dash":
							if ($spacer_allowed) {
								$spacer_result = " - ";
							}
							$spacer_allowed = false;
							break;
						case "spacer_space":
							if ($spacer_allowed) {
								$spacer_result = " ";
							}
							$spacer_allowed = false;
							break;
						case "spacer_teranga_car":
							if ($spacer_allowed) 
								$spacer_result = elgg_echo('profiles_go:user_summary_control:options:spacers:teranga_car');
							$spacer_allowed = false;//siempre a la izquierda de un valor
							break;
						case "spacer_teranga_asientos":
							if ($spacer_allowed) 
								$spacer_result = elgg_echo('profiles_go:user_summary_control:options:spacers:teranga_asientos');
							$spacer_allowed = false;//siempre a la izquierda de un valor
							break;
						case "spacer_new_line":
							$spacer_allowed = true;
							$field_result = "<br />";
							break;
						default:
							$value = $vars["entity"]->$field;
							if (!empty($value)) {
								if (array_key_exists($field, $profile_fields)) {
									$spacer_allowed = true;
									$field_result = elgg_view("output/" . $profile_fields[$field], array("value" => $value));
								}
							}
							break;
					}
					
					if (!empty($field_result)) {
						$vars[$position] .= $spacer_result . $field_result;
					}

				}
			}
		}
	}
}

echo elgg_view('object/elements/summary', $vars);

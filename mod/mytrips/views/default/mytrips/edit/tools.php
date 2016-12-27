<?php

/**
 * edit form - This view contains the group tool options provided by the different plugins
 *
* 	Plugin: mytripsTeranga
*	Author: Rosana Montes Soldado from previous version of @package ElggGroups
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
*/

$tools = elgg_get_config("group_tool_options");

if ($tools) 
{
	usort($tools, create_function('$a, $b', 'return strcmp($a->label, $b->label);'));
	
	foreach ($tools as $group_option) 
	{
		$group_option_toggle_name = $group_option->name . "_enable";
		$value = elgg_extract($group_option_toggle_name, $vars);

		//Teranga trip by default is like that
		if ($group_option->name == 'trip_companions' || $group_option->name == 'forum')
			$value = 'yes';
		else
			$value = 'no';
		
		if (elgg_is_admin_logged_in())
			echo elgg_format_element('div', null, elgg_view('input/checkbox', array(
				'name' => $group_option_toggle_name,
				'value' => 'yes',
				'default' => 'no',
				'checked' => ($value === 'yes') ? true : false,
				'label' => $group_option->label,
			)));
		else
		{
			echo elgg_view('input/hidden', array(
				'name' => $group_option_toggle_name,
				'value' => $value,
			));
		} 

	}
}
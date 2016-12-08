<?php

/**
 * trip edit form
 *
 * This view contains the trip tool options provided by the different plugins
*
* 	Plugin: myTripsTeranga from previous version of @package ElggGroup
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

$tools = elgg_get_config("trip_tool_options");

if ($tools) 
{
	usort($tools, create_function('$a, $b', 'return strcmp($a->label, $b->label);'));
	
	foreach ($tools as $trip_option) 
	{
		$trip_option_toggle_name = $trip_option->name . "_enable";
		$value = elgg_extract($trip_option_toggle_name, $vars);

		//Teranga trip by default is like that
		if ($trip_option->name == 'trip_companions' || $trip_option->name == 'forum')
			$value = 'yes';
		else
			$value = 'no';
		
		if (elgg_is_admin_logged_in())
			echo elgg_format_element('div', null, elgg_view('input/checkbox', array(
				'name' => $trip_option_toggle_name,
				'value' => 'yes',
				'default' => 'no',
				'checked' => ($value === 'yes') ? true : false,
				'label' => $trip_option->label,
			)));
		else
		{
			echo elgg_view('input/hidden', array(
				'name' => $trip_option_toggle_name,
				'value' => $value,
			));
		} 

	}
}
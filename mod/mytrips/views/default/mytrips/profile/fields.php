<?php
/**
 * trip profile fields
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

$trip = $vars['entity'];

$profile_fields = elgg_get_config('trip');
system_message("check profile/fields.php with " . $profile_fields . " or " . elgg_get_config('group'));


if (is_array($profile_fields) && count($profile_fields) > 0) 
{
	$even_odd = 'odd';
	foreach ($profile_fields as $key => $valtype) {
		// do not show the name
		if ($key == 'name') {
			continue;
		}

		$value = $trip->$key;
		system_message("#19 profile fields key " . $value);
		if (is_null($value)) 
		{
			continue;
		}

		$options = array('value' => $trip->$key);
		if ($valtype == 'tags') {
			$options['tag_names'] = $key;
		}

		echo "<div class=\"{$even_odd}\">";
		echo "<b>";
		echo elgg_echo("mytrips:$key");
		echo ": </b>";
		echo elgg_view("output/$valtype", $options);
		echo "</div>";

		$even_odd = ($even_odd == 'even') ? 'odd' : 'even';
	}
}

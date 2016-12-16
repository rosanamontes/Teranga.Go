<?php
/**
 * trip activity widget
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
 

$num = (int) $vars['entity']->num_display;
$guid = (int) $vars['entity']->trip_guid;

$content = '';

if ($guid) {
	// backward compatibility when we couldn't set widget title (pre 1.9)
	if (!$vars['entity']->title) {
		$title = get_entity($guid)->name;
		$content = "<h3>$title</h3>";
	}

	$db_prefix = elgg_get_config('dbprefix');
	$activity = elgg_list_river(array(
		'limit' => $num,
		'pagination' => false,
		'joins' => array("JOIN {$db_prefix}entities e1 ON e1.guid = rv.object_guid"),
		'wheres' => array("(e1.container_guid = $guid)"),
	));
	if (!$activity) {
		$activity = '<p>' . elgg_echo('mytrips:widget:trip_activity:content:noactivity') . '</p>';
	}
	
	$content .= $activity;
} else {
	// no trip selected yet
	$content = '<p>' . elgg_echo('mytrips:widget:trip_activity:content:noselect') . '</p>';
}

echo $content;

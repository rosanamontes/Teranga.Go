<?php
/**
 * myTrips latest activity
 *
 * @todo add people joining trip to activity
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

if ($vars['entity']->activity_enable == 'no') {
	return true;
}

$trip = $vars['entity'];
if (!$trip) {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "myTrips/activity/$trip->guid",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

elgg_push_context('widgets');
$db_prefix = elgg_get_config('dbprefix');
$content = elgg_list_river(array(
	'limit' => 4,
	'pagination' => false,
	'joins' => array(
		"JOIN {$db_prefix}entities e1 ON e1.guid = rv.object_guid",
		"LEFT JOIN {$db_prefix}entities e2 ON e2.guid = rv.target_guid",
	),
	'wheres' => array(
		"(e1.container_guid = $trip->guid OR e2.container_guid = $trip->guid)",
	),
));
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('myTrips:activity:none') . '</p>';
}

echo elgg_view('myTrips/profile/module', array(
	'title' => elgg_echo('myTrips:activity'),
	'content' => $content,
	'all_link' => $all_link,
));

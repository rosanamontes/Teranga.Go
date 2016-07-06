<?php

/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: filter to get users with something in common
*/

if (!elgg_is_logged_in()) {
	return;
}

$user = $vars['entity'];
$logged_in_user = elgg_get_logged_in_user_entity();

$title = elgg_echo('trip_companions:mutual:groups');

elgg_push_context('widgets');

$dbprefix = elgg_get_config('dbprefix');
$content = elgg_list_entities(array(
	'type' => 'group',
	'joins' => array(
		"JOIN {$dbprefix}groups_entity g ON e.guid = g.guid",
		"JOIN {$dbprefix}entity_relationships r ON r.guid_two = e.guid AND r.relationship = 'member'",
		"JOIN {$dbprefix}entity_relationships r2 ON r2.guid_two = e.guid AND r2.relationship = 'member'"
	),
	'wheres' => array(
		"r.guid_one = {$user->guid}",
		"r2.guid_one = {$logged_in_user->guid}"
	),
	'order' => "g.name ASC",
	'limit' => 25,
	'pagination' => false,
	'full_view' => false,
	'no_results' => elgg_echo('trip_companions:mutual:groups:not:found')
));

echo elgg_view_module('info', $title, $content, array(
	'class' => 'trip-companions-lightbox'
));

elgg_pop_context();

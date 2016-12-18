<?php
/**
 * Latest forum posts
 *
 * @uses $vars['entity']
 *
* 	Plugin: mytripsTeranga from previous version of @package ElggGroup
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

if ($vars['entity']->forum_enable == 'no') {
	return true;
}

$trip = $vars['entity'];

$all_link = elgg_view('output/url', array(
	'href' => "discussion/owner/$trip->guid",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'tripforumtopic',
	'container_guid' => $trip->getGUID(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
	'no_results' => elgg_echo('discussion:none'),
);
$content = elgg_list_entities($options);
elgg_pop_context();

$new_link = elgg_view('output/url', array(
	'href' => "discussion/add/" . $trip->getGUID(),
	'text' => elgg_echo('mytrips:addtopic'),
	'is_trusted' => true,
));

echo elgg_view('mytrips/profile/module', array(
	'title' => elgg_echo('discussion:trip'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));
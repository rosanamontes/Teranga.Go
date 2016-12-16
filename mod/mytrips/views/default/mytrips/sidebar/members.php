<?php
/**
 * trip members sidebar
 *
 * @uses $vars['entity'] trip entity
 * @uses $vars['limit']  The max number of members to display
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

$limit = elgg_extract('limit', $vars, 14);

$all_link = elgg_view('output/url', array(
	'href' => 'myTrips/members/' . $vars['entity']->guid,
	'text' => elgg_echo('mytrips:members:more'),
	'is_trusted' => true,
));

/* Cambia ASI DE trip */
/*$user=elgg_get_logged_in_user_entity();
$db_prefix = elgg_get_config('dbprefix');*/

$body = elgg_list_entities_from_relationship(array(
	'relationship' => 'member',
	'relationship_guid' => $vars['entity']->guid,
	'inverse_relationship' => true,
	'type' => 'user',
	'limit' => $limit,
	'pagination' => false,
	/*'joins' => array("JOIN {$db_prefix}users_entity u ON e.guid=u.guid"),
	'wheres'=>array("u.guid!=".$user->guid),*/
	'list_type' => 'gallery',
	'gallery_class' => 'elgg-gallery-users',
));

/*elgg_log("CREANDO members->","NOTICE");
elgg_dump($vars['entity']);*/

$body .= "<div class='center mts'>$all_link</div>";

echo elgg_view_module('aside', elgg_echo('mytrips:members'), $body);

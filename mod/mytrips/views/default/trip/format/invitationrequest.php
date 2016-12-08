<?php

/**
 * trip view for an invitation request
 *
 * @uses $vars['entity'] trip entity
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
 
$user = elgg_get_page_owner_entity();
if (!$user instanceof \ElggUser || !$user->canEdit()) {
	return;
}

$trip = elgg_extract('entity', $vars);

if (!elgg_instanceof($trip, 'trip')) 
{
	return true;
}

$icon = elgg_view_entity_icon($trip, 'small');
$menu = elgg_view_menu('invitationrequest', array(
	'entity' => $trip,
	'user' => $user,
	'order_by' => 'priority',
	'class' => 'elgg-menu-hz float-alt',
));

$summary = elgg_view('trip/elements/summary', array(
	'entity' => $trip,
	'subtitle' => $trip->briefdescription,
	'metadata' => $menu,
));

echo elgg_view_image_block($icon, $summary);

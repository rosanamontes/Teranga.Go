<?php

/**
 * Group view for an invitation request
 *
 * @uses $vars['entity'] Group entity
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
 
$user = elgg_get_page_owner_entity();
if (!$user instanceof \ElggUser || !$user->canEdit()) {
	return;
}

$group = elgg_extract('entity', $vars);

if (!$group instanceof \ElggGroup) {
	return true;
}

$icon = elgg_view_entity_icon($group, 'small');
$menu = elgg_view_menu('invitationrequest', array(
	'entity' => $group,
	'user' => $user,
	'order_by' => 'priority',
	'class' => 'elgg-menu-hz float-alt',
));

$summary = elgg_view('group/elements/summary', array(
	'entity' => $group,
	'subtitle' => $group->briefdescription,
	'metadata' => $menu,
));

echo elgg_view_image_block($icon, $summary);

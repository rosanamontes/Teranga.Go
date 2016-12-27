<?php	
/**
 * Feature a group
 *
* 	Plugin: mytrips Teranga from previous version of @package ElggGroup
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

$group_guid = get_input('group_guid');
$action = get_input('action_type');

$group = get_entity($group_guid);

if (!elgg_instanceof($group, 'group')) {
	register_error(elgg_echo('mytrips:featured_error'));
	forward(REFERER);
}

//get the action, is it to feature or unfeature
if ($action == "feature") {
	$group->featured_group = "yes";
	system_message(elgg_echo('mytrips:featuredon', array($group->name)));
} else {
	$group->featured_group = "no";
	system_message(elgg_echo('mytrips:unfeatured', array($group->name)));
}

forward(REFERER);

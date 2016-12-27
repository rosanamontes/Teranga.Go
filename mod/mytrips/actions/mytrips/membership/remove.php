<?php
/**
 * Remove a user from a group
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

$user_guid = get_input('user_guid');
$group_guid = get_input('group_guid');

$user = get_user($user_guid);
$group = get_entity($group_guid);

elgg_set_page_owner_guid($group->guid);

if ($user && ($group instanceof ElggGroup) && $group->canEdit()) {
	// Don't allow removing group owner
	if ($group->getOwnerGUID() != $user->getGUID()) {
		if ($group->leave($user)) {
			system_message(elgg_echo("mytrips:removed", array($user->name)));
		} else {
			register_error(elgg_echo("mytrips:cantremove"));
		}
	} else {
		register_error(elgg_echo("mytrips:cantremove"));
	}
} else {
	register_error(elgg_echo("mytrips:cantremove"));
}

forward(REFERER);

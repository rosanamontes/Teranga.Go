<?php
/**
 * Delete a request to join a closed group.
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

$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$group_guid = get_input('group_guid');

$user = get_user($user_guid);
$group = get_entity($group_guid);

if (!$user && !elgg_instanceof($group, 'group')) {
	forward(REFERER);
}

// If join request made
if (check_entity_relationship($user->guid, 'membership_request', $group->guid)) {
	remove_entity_relationship($user->guid, 'membership_request', $group->guid);
	system_message(elgg_echo("mytrips:joinrequestkilled"));
}

forward(REFERER);

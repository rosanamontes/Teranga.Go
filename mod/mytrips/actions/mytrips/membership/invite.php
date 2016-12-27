<?php
/**
 * Invite users to join a group
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

$logged_in_user = elgg_get_logged_in_user_entity();

$user_guids = get_input('user_guid');
if (!is_array($user_guids)) {
	$user_guids = array($user_guids);
}
$group_guid = get_input('group_guid');
$group = get_entity($group_guid);

if (count($user_guids) > 0 && elgg_instanceof($group, 'group') && $group->canEdit()) {
	foreach ($user_guids as $guid) {
		$user = get_user($guid);
		if (!$user) {
			continue;
		}

		if (check_entity_relationship($group->guid, 'invited', $user->guid)) {
			register_error(elgg_echo("mytrips:useralreadyinvited"));
			continue;
		}

		if (check_entity_relationship($user->guid, 'member', $group->guid)) {
			// @todo add error message
			continue;
		}

		// Create relationship
		add_entity_relationship($group->guid, 'invited', $user->guid);

		$url = elgg_normalize_url("mytrips/invitations/$user->username");

		$subject = elgg_echo('mytrips:invite:subject', array(
			$user->name,
			$group->name
		), $user->language);

		$body = elgg_echo('mytrips:invite:body', array(
			$user->name,
			$logged_in_user->name,
			$group->name,
			$url,
		), $user->language);
		
		$params = [
			'action' => 'invite',
			'object' => $group,
		];

		// Send notification
		$result = notify_user($user->getGUID(), $group->owner_guid, $subject, $body, $params);

		if ($result) {
			system_message(elgg_echo("mytrips:userinvited"));
		} else {
			register_error(elgg_echo("mytrips:usernotinvited"));
		}
	}
}

forward(REFERER);

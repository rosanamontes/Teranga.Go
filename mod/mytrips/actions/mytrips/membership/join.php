<?php
/**
 * Join a group
 *
 * Three states:
 * open group so user joins
 * closed group so request sent to group owner
 * closed group with invite so user joins
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

global $CONFIG;

$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$group_guid = get_input('group_guid');

$user = get_user($user_guid);

// access bypass for getting invisible group
$ia = elgg_set_ignore_access(true);
$group = get_entity($group_guid);
elgg_set_ignore_access($ia);

if ($user && ($group instanceof ElggGroup)) {

	// join or request
	$join = false;
	if ($group->isPublicMembership() || $group->canEdit($user->guid)) {
		// anyone can join public mytrips and admins can join any group
		$join = true;
	} else {
		if (check_entity_relationship($group->guid, 'invited', $user->guid)) {
			// user has invite to closed group
			$join = true;
		}
	}

	if ($join) {
		if (mytrips_join_group($group, $user)) {
			system_message(elgg_echo("mytrips:joined"));
			
			//copio en variable local
			$follower=$group->follower;
			
			//añado al usuario
			array_push($follower,$user_guid);
			
			//vuelvo a copiar el array
			$group->follower=$follower;
			
			
			
			forward($group->getURL());
		} else {
			register_error(elgg_echo("mytrips:cantjoin"));
		}
	} else {
		add_entity_relationship($user->guid, 'membership_request', $group->guid);

		$owner = $group->getOwnerEntity();

		$url = "{$CONFIG->url}mytrips/requests/$group->guid";

		$subject = elgg_echo('mytrips:request:subject', array(
			$user->name,
			$group->name,
		), $owner->language);

		$body = elgg_echo('mytrips:request:body', array(
			$group->getOwnerEntity()->name,
			$user->name,
			$group->name,
			$user->getURL(),
			$url,
		), $owner->language);

		$params = [
			'action' => 'membership_request',
			'object' => $group,
		];
		
		// Notify group owner
		if (notify_user($owner->guid, $user->getGUID(), $subject, $body, $params)) {
			system_message(elgg_echo("mytrips:joinrequestmade"));
		} else {
			register_error(elgg_echo("mytrips:joinrequestnotmade"));
		}
	}
} else {
	register_error(elgg_echo("mytrips:cantjoin"));
}

forward(REFERER);

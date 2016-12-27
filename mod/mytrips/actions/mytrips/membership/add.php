<?php
/**
 * Add users to a group
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

$user_guid = get_input('user_guid');
if (!is_array($user_guid)) {
	$user_guid = array($user_guid);
}
$group_guid = get_input('group_guid');
$group = get_entity($group_guid);
/* @var ElggGroup $group */

$errors = array();
if (sizeof($user_guid)) {
	foreach ($user_guid as $u_guid) {
		$user = get_user($u_guid);

		if ($user && elgg_instanceof($group, 'group') && $group->canEdit()) {
			if (!$group->isMember($user)) {
				if (mytrips_join_group($group, $user)) {

					$subject = elgg_echo('mytrips:welcome:subject', array($group->name), $user->language);

					$body = elgg_echo('mytrips:welcome:body', array(
						$user->name,
						$group->name,
						$group->getURL(),
					), $user->language);
					
					$params = [
						'action' => 'add_membership',
						'object' => $group,
					];

					// Send welcome notification to user
					notify_user($user->getGUID(), $group->owner_guid, $subject, $body, $params);
					
					system_message(elgg_echo('mytrips:addedtogroup'));
					
					//copio en variable local
					$follower=$group->follower;
					
					//añado al usuario
					array_push($follower,$user->getGUID());
					
					//vuelvo a copiar el array
					$group->follower=$follower;
					
					
				}
				else {
					$errors[] = elgg_echo('mytrips:error:addedtogroup', array($user->name));
				}
			}
			else {
				$errors[] = elgg_echo('mytrips:add:alreadymember', array($user->name));

				// if an invitation is still pending clear it up, we don't need it
				remove_entity_relationship($group->guid, 'invited', $user->guid);
			}
		}
	}
}

if ($errors) {
	foreach ($errors as $error) {
		register_error($error);
	}
}

forward(REFERER);

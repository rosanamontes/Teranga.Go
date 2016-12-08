<?php
/**
 * Add users to a trip
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
* 
*/

$logged_in_user = elgg_get_logged_in_user_entity();

$user_guid = get_input('user_guid');
if (!is_array($user_guid)) {
	$user_guid = array($user_guid);
}

$trip_guid = get_input('trip_guid');
$trip = get_entity($trip_guid); //entity trip

$errors = array();
if (sizeof($user_guid)) 
{
	foreach ($user_guid as $u_guid) 
	{
		$user = get_user($u_guid);
		if ($user && elgg_instanceof($trip, 'trip') && $trip->canEdit()) 
		{
			if (!$trip->isMember($user)) 
			{
				if (myTrips_join_trip($trip, $user)) //start.php function
				{
					$subject = elgg_echo('myTrips:welcome:subject', array($trip->name), $user->language);

					$body = elgg_echo('myTrips:welcome:body', array(
						$user->name,
						$trip->name,
						$trip->getURL(),
					), $user->language);
					
					$params = [
						'action' => 'add_membership',
						'object' => $trip,
					];

					// Send welcome notification to user
					notify_user($user->getGUID(), $trip->owner_guid, $subject, $body, $params);
					
					system_message(elgg_echo('myTrips:addedtotrip'));
					
					//copio en variable local
					$follower=$trip->follower;
					
					//añado al usuario
					array_push($follower,$user->getGUID());
					
					//vuelvo a copiar el array
					$trip->follower=$follower;	
				}
				else {
					$errors[] = elgg_echo('myTrips:error:addedtotrip', array($user->name));
				}
			}
			else {
				$errors[] = elgg_echo('myTrips:add:alreadymember', array($user->name));

				// if an invitation is still pending clear it up, we don't need it
				remove_entity_relationship($trip->guid, 'invited', $user->guid);
			}
		}
	}
}

if ($errors) 
{
	foreach ($errors as $error) {
		register_error($error);
	}
}

forward(REFERER);

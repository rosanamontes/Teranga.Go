<?php
/**
 * Join a trip
 *
 * Three states: (1)  open trip so user joins  (2) closed trip so request sent to trip owner (3) closed trip with invite so user joins
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

global $CONFIG;

$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$trip_guid = get_input('trip_guid');

$user = get_user($user_guid);

// access bypass for getting invisible trip
$ia = elgg_set_ignore_access(true);
$trip = get_entity($trip_guid);
elgg_set_ignore_access($ia);


if ($user && elgg_instanceof($trip, 'trip'))
{

	// join or request
	$join = false;
	if ($trip->isPublicMembership() || $trip->canEdit($user->guid)) {
		// anyone can join public myTrips and admins can join any trip
		$join = true;
	} else {
		if (check_entity_relationship($trip->guid, 'invited', $user->guid)) {
			// user has invite to closed trip
			$join = true;
		}
	}

	if ($join) {
		if (myTrips_join_trip($trip, $user)) {
			system_message(elgg_echo("myTrips:joined"));
			
			//copio en variable local
			$follower=$trip->follower;
			
			//añado al usuario
			array_push($follower,$user_guid);
			
			//vuelvo a copiar el array
			$trip->follower=$follower;
			
			
			
			forward($trip->getURL());
		} else {
			register_error(elgg_echo("myTrips:cantjoin"));
		}
	} else {
		add_entity_relationship($user->guid, 'membership_request', $trip->guid);

		$owner = $trip->getOwnerEntity();

		$url = "{$CONFIG->url}myTrips/requests/$trip->guid";

		$subject = elgg_echo('myTrips:request:subject', array(
			$user->name,
			$trip->name,
		), $owner->language);

		$body = elgg_echo('myTrips:request:body', array(
			$trip->getOwnerEntity()->name,
			$user->name,
			$trip->name,
			$user->getURL(),
			$url,
		), $owner->language);

		$params = [
			'action' => 'membership_request',
			'object' => $trip,
		];
		
		// Notify trip owner
		if (notify_user($owner->guid, $user->getGUID(), $subject, $body, $params)) {
			system_message(elgg_echo("myTrips:joinrequestmade"));
		} else {
			register_error(elgg_echo("myTrips:joinrequestnotmade"));
		}
	}
} else {
	register_error(elgg_echo("myTrips:cantjoin"));
}

forward(REFERER);

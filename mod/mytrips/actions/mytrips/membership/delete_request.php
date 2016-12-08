<?php
/**
 * Delete a request to join a closed trip.
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

$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$trip_guid = get_input('trip_guid');

$user = get_user($user_guid);
$trip = get_entity($trip_guid);

if (!$user && !elgg_instanceof($trip, 'trip')) {
	forward(REFERER);
}

// If join request made
if (check_entity_relationship($user->guid, 'membership_request', $trip->guid)) {
	remove_entity_relationship($user->guid, 'membership_request', $trip->guid);
	system_message(elgg_echo("myTrips:joinrequestkilled"));
}

forward(REFERER);

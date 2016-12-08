<?php
/**
 * Delete an invitation to join a trip.
 *
* 	Plugin: myTripsTeranga
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

$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$trip_guid = get_input('trip_guid');

$user = get_user($user_guid);

// invisible myTrips require overriding access to delete invite
$old_access = elgg_set_ignore_access(true);
$trip = get_entity($trip_guid);
elgg_set_ignore_access($old_access);

if (!$user && !elgg_instanceof($trip, 'trip')) 
{
	forward(REFERER);
}

// If join request made
if (check_entity_relationship($trip->guid, 'invited', $user->guid)) {
	remove_entity_relationship($trip->guid, 'invited', $user->guid);
	system_message(elgg_echo("myTrips:invitekilled"));
}

forward(REFERER);

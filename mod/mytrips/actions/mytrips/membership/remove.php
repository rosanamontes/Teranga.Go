<?php
/**
 * Remove a user from a trip
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

$user_guid = get_input('user_guid');
$trip_guid = get_input('trip_guid');

$user = get_user($user_guid);
$trip = get_entity($trip_guid);

elgg_set_page_owner_guid($trip->guid);

if ($user && elgg_instanceof($trip, 'trip') && $trip->canEdit()) 
{
	// Don't allow removing trip owner
	if ($trip->getOwnerGUID() != $user->getGUID()) {
		if ($trip->leave($user)) {
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

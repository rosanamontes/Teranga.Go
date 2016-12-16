<?php
/**
 * Leave a trip action.
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

$user = NULL;
if (!$user_guid) {
	$user = elgg_get_logged_in_user_entity();
} else {
	$user = get_user($user_guid);
}

$trip = get_entity($trip_guid);

elgg_set_page_owner_guid($trip->guid);

if ($user && elgg_instanceof($trip, 'trip')) 
{
	if ($trip->getOwnerGUID() != elgg_get_logged_in_user_guid()) {
		if ($trip->leave($user)) {
			
			//copio en variable local
			$follower=$trip->follower;
			
			//busco posición del user a borrar
			$clave=array_search($user->guid,$follower);
			
			//lo borro
			unset($follower[$clave]);
			//vuelvo a asignar
			$trip->follower=$follower;
			system_message(elgg_echo("mytrips:left"));
		} else {
			register_error(elgg_echo("mytrips:cantleave"));
		}
	} else {
		register_error(elgg_echo("mytrips:cantleave"));
	}
} else {
	register_error(elgg_echo("mytrips:cantleave"));
}

forward(REFERER);

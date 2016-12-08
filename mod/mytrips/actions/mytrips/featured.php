<?php	
/**
 * Feature a trip
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

$trip_guid = get_input('trip_guid');
$action = get_input('action_type');

$trip = get_entity($trip_guid);

if (!elgg_instanceof($trip, 'trip')) {
	register_error(elgg_echo('myTrips:featured_error'));
	forward(REFERER);
}

//get the action, is it to feature or unfeature
if ($action == "feature") {
	$trip->featured_trip = "yes";
	system_message(elgg_echo('myTrips:featuredon', array($trip->name)));
} else {
	$trip->featured_trip = "no";
	system_message(elgg_echo('myTrips:unfeatured', array($trip->name)));
}

forward(REFERER);

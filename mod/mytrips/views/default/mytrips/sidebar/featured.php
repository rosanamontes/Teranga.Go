<?php
/**
 * Featured myTrips
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

$featured_myTrips = elgg_get_entities_from_metadata(array(
	'metadata_name' => 'featured_trip',
	'metadata_value' => 'yes',
	'type' => 'trip',
));

if ($featured_myTrips) {

	elgg_push_context('widgets');
	$body = '';
	foreach ($featured_myTrips as $trip) {
		$body .= elgg_view_entity($trip, array('full_view' => false));
	}
	elgg_pop_context();

	echo elgg_view_module('aside', elgg_echo("myTrips:featured"), $body);
}

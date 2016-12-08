<?php
/**
 * Layout of the myTrips profile page
 *
 * @uses $vars['entity']
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

$trip = elgg_extract('entity', $vars); //trip entity

echo elgg_view('myTrips/profile/summary', $vars);

if (elgg_trip_gatekeeper(false)) 
{
	if (!$trip->isPublicMembership() && !$trip->isMember()) 
	{
		echo elgg_view('myTrips/profile/closed_membership');
	}

	echo elgg_view('myTrips/profile/widgets', $vars);
} 
else 
{
	if ($trip->isPublicMembership()) {
		echo elgg_view('myTrips/profile/membersonly_open');
	} else {
		echo elgg_view('myTrips/profile/membersonly_closed');
	}
}

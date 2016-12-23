<?php
/**
 * Layout of the mytrips profile page
 *
 * @uses $vars['entity']
 *
* 	Plugin: mytripsTeranga from previous version of @package ElggGroup
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

echo elgg_view('mytrips/profile/summary', $vars);

if (elgg_group_gatekeeper(false)) 
{
	if (!$trip->isPublicMembership() && !$trip->isMember()) 
	{
		echo elgg_view('mytrips/profile/closed_membership');
	}

	echo elgg_view('mytrips/profile/widgets', $vars);
} 
else 
{
	if ($trip->isPublicMembership()) {
		echo elgg_view('mytrips/profile/membersonly_open');
	} else {
		echo elgg_view('mytrips/profile/membersonly_closed');
	}
}

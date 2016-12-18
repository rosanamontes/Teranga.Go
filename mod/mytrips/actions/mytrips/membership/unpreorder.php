<?php
/**
 * cancel a preorder in trip action.
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
/*elgg_log("CREANDO mytrips/actions/mytrips/membership/preorder->","NOTICE");
elgg_dump($trip);*/


system_message(elgg_echo("mytrips:unPreOrderCorrect")); 

//eliminar de preorder
	//copio en variable local
	$preorder=$trip->preorder;

	//busco posición del user a borrar
	$clave=array_search($user->guid,$preorder);

	//lo borro
	unset($preorder[$clave]);
	//vuelvo a asignar
	$trip->preorder=$preorder;

//añadir en follower
	//copio en variable local
	$follower=$trip->follower;
	
	//añado al usuario
	array_push($follower,$user->guid);
	
	//vuelvo a copiar el array
	$trip->follower=$follower;
	
	$summaryPreOrderUserGuid=$trip->summaryPreOrderUserGuid;
	$clave=array_search($user->guid,$summaryPreOrderUserGuid);
	
	$summaryPreOrderTrayecto=$trip->summaryPreOrderTrayecto;
	$summaryPreOrderBultos=$trip->summaryPreOrderBultos;
	$summaryPreOrderConfirmed=$trip->summaryPreOrderConfirmed;
	
	unset($summaryPreOrderUserGuid[$clave]);
	unset($summaryPreOrderTrayecto[$clave]);
	unset($summaryPreOrderBultos[$clave]);
	unset($summaryPreOrderConfirmed[$clave]);
	
	$trip->summaryPreOrderUserGuid=$summaryPreOrderUserGuid;
	$trip->summaryPreOrderTrayecto=$summaryPreOrderTrayecto;
	$trip->summaryPreOrderBultos=$summaryPreOrderBultos;
	$trip->summaryPreOrderConfirmed=$summaryPreOrderConfirmed;
	
/*
if ($user && elgg_instanceof($trip, 'trip')) 
{
	if ($trip->getOwnerGUID() != elgg_get_logged_in_user_guid()) 
	{
		if ($trip->leave($user)) {
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

forward(REFERER);*/

<?php
/**
 * user cancel the request to...
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

system_message(elgg_echo("mytrips:unPreOrderCorrect")); 

//eliminar de confirmed
	//copio en variable local
	$confirmed=$trip->confirmed;

	//busco posición del user a borrar
	$clave=array_search($user->guid,$confirmed);

	//lo borro
	if ($clave) unset($confirmed[$clave]);
	//vuelvo a asignar
	$trip->confirmed=$confirmed;

//añadir en follower

	//copio en variable local
	$follower=$trip->follower;
	
	//añado al usuario
	$clave1=array_search($user->guid,$follower);
	if(!$clave1)
	{
		array_push($follower,$user->guid);
	}
	
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
	
	//Rosana
	$linktotrip = "<a href=\"".$trip->getURL()."\">".$trip->name."</a>"; 
	$trayecto = elgg_echo($trip->trayecto, array(), $user->language);//El mensaje se traduce segun el receiver.

	$linktoforum = "<a href='". elgg_get_site_url() ."discussion/owner/".$trip->guid."'>".
		elgg_echo('mytrips:forum',array(),$user->language)."</a>"; 

	$subject = elgg_echo('mytrips:manageOrders:desconfirmadoOk:subjet', array($trip->name),$user->language);
	$owner=$trip->getOwnerGUID();
	$owner=get_entity($owner);
	
	$body = elgg_echo('mytrips:manageOrders:desconfirmadoOk:message',array($owner->name,$linktotrip,$trayecto,$trip->aportacionViajero,$linktoforum),$user->language);

	//no tengo claro quien es el sender en esta llamada
	//Antonio                       MANDAR A:        DE PARTE DE:
	messages_send($subject, $body, $userguid, 0,$trip->owner_guid);

/*
$result = messages_send(elgg_echo('mytrips:manageOrders:desconfirmadoOk:subjet',array($trip->name)), elgg_echo('mytrips:manageOrders:desconfirmadoOk:message'), $trip->owner_guid, 0,$user->guid);
if (!$result) {
	register_error(elgg_echo("messages:error"));
}
else {
	system_message(elgg_echo("messages:posted"));	
}*/


/*

if ($user && elgg_instanceof($trip, 'trip')
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

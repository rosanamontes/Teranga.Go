<?php
/**
 * preorder a group action.
 *
* 	Plugin: mytrips Teranga from previous version of @package ElggGroup
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
$group_guid = get_input('group_guid');

$user = NULL;
if (!$user_guid) {
	$user = elgg_get_logged_in_user_entity();
} else {
	$user = get_user($user_guid);
}

$group = get_entity($group_guid);

elgg_set_page_owner_guid($group->guid);

//register_error("aaa"); //mensaje en rojo MAL
system_message(elgg_echo("mytrips:unPreOrderCorrect")); //mensaje en negro OK

//eliminar de confirmed
	//copio en variable local
	$confirmed=$group->confirmed;

	//busco posición del user a borrar
	$clave=array_search($user->guid,$confirmed);

	//lo borro
	if ($clave) unset($confirmed[$clave]);
	//vuelvo a asignar
	$group->confirmed=$confirmed;

//añadir en follower

	//copio en variable local
	$follower=$group->follower;
	
	//añado al usuario
	$clave1=array_search($user->guid,$follower);
	if(!$clave1){
	array_push($follower,$user->guid);
	}
	//vuelvo a copiar el array
	$group->follower=$follower;
	
	$summaryPreOrderUserGuid=$group->summaryPreOrderUserGuid;
	$clave=array_search($user->guid,$summaryPreOrderUserGuid);
	
	$summaryPreOrderTrayecto=$group->summaryPreOrderTrayecto;
	$summaryPreOrderBultos=$group->summaryPreOrderBultos;
	$summaryPreOrderConfirmed=$group->summaryPreOrderConfirmed;
	
	unset($summaryPreOrderUserGuid[$clave]);
	unset($summaryPreOrderTrayecto[$clave]);
	unset($summaryPreOrderBultos[$clave]);
	unset($summaryPreOrderConfirmed[$clave]);
	
	$group->summaryPreOrderUserGuid=$summaryPreOrderUserGuid;
	$group->summaryPreOrderTrayecto=$summaryPreOrderTrayecto;
	$group->summaryPreOrderBultos=$summaryPreOrderBultos;
	$group->summaryPreOrderConfirmed=$summaryPreOrderConfirmed;
	
	//Rosana
	$linktotrip = "<a href=\"".$group->getURL()."\">".$group->name."</a>"; 
	$trayecto = elgg_echo($group->trayecto, array(), $user->language);//El mensaje se traduce segun el receiver.

	$linktoforum = "<a href='". elgg_get_site_url() ."discussion/owner/".$group->guid."'>".
		elgg_echo('mytrips:forum',array(),$user->language)."</a>"; 

	$subject = elgg_echo('mytrips:manageOrders:desconfirmadoOk:subjet', array($group->name),$user->language);
	$owner=$group->getOwnerGUID();
	$owner=get_entity($owner);
	
	$body = elgg_echo('mytrips:manageOrders:desconfirmadoOk:message',array($owner->name,$linktotrip,$trayecto,$group->aportacionViajero,$linktoforum),$user->language);

	//no tengo claro quien es el sender en esta llamada
	//Antonio                       MANDAR A:        DE PARTE DE:
	messages_send($subject, $body, $userguid, 0,$group->owner_guid);

/*$result = messages_send(elgg_echo('mytrips:manageOrders:desconfirmadoOk:subjet',array($group->name)), elgg_echo('mytrips:manageOrders:desconfirmadoOk:message'), $group->owner_guid, 0,$user->guid);
if (!$result) {
	register_error(elgg_echo("messages:error"));
}
else {
	system_message(elgg_echo("messages:posted"));	
}*/


/*if ($user && ($group instanceof ElggGroup)) {
	if ($group->getOwnerGUID() != elgg_get_logged_in_user_guid()) {
		if ($group->leave($user)) {
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

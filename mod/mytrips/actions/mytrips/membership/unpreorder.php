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
/*elgg_log("CREANDO mytrips/actions/mytrips/membership/preorder->","NOTICE");
elgg_dump($group);*/


//register_error("aaa"); //mensaje en rojo MAL
system_message(elgg_echo("mytrips:unPreOrderCorrect")); //mensaje en negro OK

//eliminar de preorder
	//copio en variable local
	$preorder=$group->preorder;

	//busco posición del user a borrar
	$clave=array_search($user->guid,$preorder);

	//lo borro
	unset($preorder[$clave]);
	//vuelvo a asignar
	$group->preorder=$preorder;

//añadir en follower
	//copio en variable local
	$follower=$group->follower;
	
	//añado al usuario
	array_push($follower,$user->guid);
	
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

<?php
/**
 * preorder a trip action.
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
	if ($trip->getOwnerGUID() != elgg_get_logged_in_user_guid()) 
	{
		system_message(elgg_echo("mytrips:PreOrderCorrect")); 

			//eliminar de follower
				//copio en variable local
				$follower=$trip->follower;

				//busco posición del user a borrar
				$clave=array_search($user->guid,$follower);

				//lo borro
				unset($follower[$clave]);
				//vuelvo a asignar
				$trip->follower=$follower;

			//añadir en preorder
				//copio en variable local
				$preorder=$trip->preorder;
				//añado al usuario
				array_push($preorder,$user->guid);
				
				//vuelvo a copiar el array
				$trip->preorder=$preorder;
				messages_send(elgg_echo('mytrips:manageOrders:preorderOk:subjet',array($trip->name)), 
					elgg_echo('mytrips:manageOrders:preorderOk:message',
						array("<a href=\"".$user->getURL()."\">".$user->name."</a>","<a href=\"".$trip->getURL()."\">".$trip->name."</a>")), $trip->owner_guid, 0,$user->guid);
		
		
	} else {
		register_error(elgg_echo("mytrips:cantleave"));
	}
} else {
	register_error(elgg_echo("mytrips:cantleave"));
}
forward(REFERER);

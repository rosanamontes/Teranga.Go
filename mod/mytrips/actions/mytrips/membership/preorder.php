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


if ($user && ($group instanceof ElggGroup)) {
	if ($group->getOwnerGUID() != elgg_get_logged_in_user_guid()) {
		system_message(elgg_echo("mytrips:PreOrderCorrect")); //mensaje en negro OK

			//eliminar de follower
				//copio en variable local
				$follower=$group->follower;

				//busco posición del user a borrar
				$clave=array_search($user->guid,$follower);

				//lo borro
				unset($follower[$clave]);
				//vuelvo a asignar
				$group->follower=$follower;

			//añadir en preorder
				//copio en variable local
				$preorder=$group->preorder;
				//añado al usuario
				array_push($preorder,$user->guid);
				
				//vuelvo a copiar el array
				$group->preorder=$preorder;
			messages_send(elgg_echo('mytrips:manageOrders:preorderOk:subjet',array($group->name)), elgg_echo('mytrips:manageOrders:preorderOk:message',array("<a href=\"".$user->getURL()."\">".$user->name."</a>","<a href=\"".$group->getURL()."\">".$group->name."</a>")), $group->owner_guid, 0,$user->guid);
		
		
	} else {
		register_error(elgg_echo("mytrips:cantleave"));
	}
} else {
	register_error(elgg_echo("mytrips:cantleave"));
}
forward(REFERER);

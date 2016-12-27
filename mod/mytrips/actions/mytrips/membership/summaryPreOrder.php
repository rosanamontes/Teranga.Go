<?php
/*
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


//Buscar clave en un array multidimensional
/*function search($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }

    return $results;
}*/
$group_guid = (int)get_input('group_guid');
$trayecto = (string)get_input('opcionViaje');
$YoMaleta = (int)get_input('opcion');
$bultos = (int)get_input('bultos');

$group = get_entity($group_guid);
$user=get_entity(elgg_get_logged_in_user_guid());

$summaryPreOrderUserGuid=$group->summaryPreOrderUserGuid;
$clave=array_search($user->guid,$summaryPreOrderUserGuid);
//$resultado=search($summaryPreOrderUserGuid, 'userguid',$user->guid);
if($clave!=""){
	system_messages(elgg_echo('mytrips:summaryPreOrder:justPreorder'));
}
else {
	$summaryPreOrderTrayecto=$group->summaryPreOrderTrayecto;
	$summaryPreOrderBultos=$group->summaryPreOrderBultos;
	$summaryPreOrderConfirmed=$group->summaryPreOrderConfirmed;

	$subjet=elgg_echo('mytrips:manageOrders:preorderOk:subjet',array($group->name));	
	
	switch($YoMaleta)
	{
		case "0":
			//Voy
			array_push($summaryPreOrderUserGuid,$user->guid);
			array_push($summaryPreOrderTrayecto,$trayecto);
			array_push($summaryPreOrderBultos,0);
			array_push($summaryPreOrderConfirmed,0);
			
			//PreOrder
			$follower=$group->follower;
			$clave=array_search($user->guid,$follower);
			unset($follower[$clave]);
			$group->follower=$follower;
			$preorder=$group->preorder;
			array_push($preorder,$user->guid);
			$group->preorder=$preorder;
			
			$clave=array_search($user->guid,$summaryPreOrderUserGuid);	
			$trayectoViajeGrupo=$group->trayecto;
			$aportacion=$group->aportacionViajero;
			
			$trayectoViaje=$summaryPreOrderTrayecto[$clave];
			$posicionFinal = strpos($aportacion,'.')+3;
			
			$rest = substr($aportacion,0, $posicionFinal);
				if($trayectoViaje=="custom:trayecto:ida" && $trayectoViajeGrupo=="custom:trayecto:vuelta")
				{
					$aportacionFinal=($rest/2)." €";
				}
				else
				{
					$aportacionFinal=$rest." €";
				}
				
			$body=elgg_echo('mytrips:manageOrders:preorderOk:Yo',array(
			"<a href=\"".$user->getURL()."\">".$user->name."</a>",
			elgg_echo($trayectoViaje),
			$aportacionFinal,
			"<a href=\"".$group->getURL()."\">".$group->name."</a>"
			));
			//al conductor
			messages_send($subjet,$body, $group->owner_guid, 0,$user->guid);
			
			$body=elgg_echo('mytrips:manageOrders:preorderOk:msgViajero:Yo',array(
			"<a href=\"".$group->getURL()."\">".$group->name."</a>",
			elgg_echo($trayectoViaje),
			$aportacionFinal
			));
			//al usuario
			messages_send($subjet,$body, $user->guid,$group->owner_guid);
			
			break;
		case "1":
			//Voy + Maleta
			array_push($summaryPreOrderUserGuid,$user->guid);
			array_push($summaryPreOrderTrayecto,$trayecto);
			array_push($summaryPreOrderBultos,$bultos);
			array_push($summaryPreOrderConfirmed,0);

			//PreOrder
			$follower=$group->follower;
			$clave=array_search($user->guid,$follower);
			unset($follower[$clave]);
			$group->follower=$follower;
			$preorder=$group->preorder;
			array_push($preorder,$user->guid);
			$group->preorder=$preorder;

			$trayectoViajeGrupo=$group->trayecto;
			$aportacion=$group->aportacionViajero;
			$clave=array_search($user->guid,$summaryPreOrderUserGuid);
			$trayectoViaje=$summaryPreOrderTrayecto[$clave];
			$posicionFinal = strpos($aportacion,'.')+3;
			
			$rest = substr($aportacion,0, $posicionFinal);
				if($trayectoViaje=="custom:trayecto:ida" && $trayectoViajeGrupo=="custom:trayecto:vuelta")
				{
					$aportacionFinal=($rest/2)." €";
				}
				else
				{
					$aportacionFinal=$rest." €";
				}
			
			$body=elgg_echo('mytrips:manageOrders:preorderOk:YoMaleta',array(
			"<a href=\"".$user->getURL()."\">".$user->name."</a>",
			elgg_echo($summaryPreOrderTrayecto[$clave]),
			$aportacionFinal,
			$bultos,
			"<a href=\"".$group->getURL()."\">".$group->name."</a>"
			));
			//al conductor
			messages_send($subjet,$body, $group->owner_guid, 0,$user->guid);
			
			$body=elgg_echo('mytrips:manageOrders:preorderOk:msgViajero:YoMaleta',array(
			"<a href=\"".$user->getURL()."\">".$user->name."</a>",
			elgg_echo($summaryPreOrderTrayecto[$clave]),
			$aportacionFinal,
			$bultos
			));
			//al usuario
			messages_send($subjet,$body, $user->guid,$group->owner_guid);

			break;
		case "2":
			//Sólo Maleta
			array_push($summaryPreOrderUserGuid,$user->guid);
			array_push($summaryPreOrderTrayecto,-1);
			array_push($summaryPreOrderBultos,$bultos);
			array_push($summaryPreOrderConfirmed,0);
			
			$body=elgg_echo('mytrips:manageOrders:preorderOk:Maleta',array(
			"<a href=\"".$user->getURL()."\">".$user->name."</a>",
			$aportacionFinal,
			$bultos,
			"<a href=\"".$group->getURL()."\">".$group->name."</a>"
			));
			//al conductor
			messages_send($subjet,$body, $group->owner_guid, 0,$user->guid);
			
			$body=elgg_echo('mytrips:manageOrders:preorderOk:msgViajero:Maleta',array(
			"<a href=\"".$user->getURL()."\">".$user->name."</a>",
			$aportacionFinal,
			$bultos
			));
			
			//al usuario
			messages_send($subjet,$body, $user->guid,$group->owner_guid);
			
			break;
	}
	//messages_send($subject, $body, $recipient_guid, $sender_guid)
	$group->summaryPreOrderUserGuid=$summaryPreOrderUserGuid;
	$group->summaryPreOrderTrayecto=$summaryPreOrderTrayecto;
	$group->summaryPreOrderBultos=$summaryPreOrderBultos;
	$group->summaryPreOrderConfirmed=$summaryPreOrderConfirmed;
		
	system_messages(elgg_echo('mytrips:manageOrders:saved'));
}

forward($group->getUrl());

?>
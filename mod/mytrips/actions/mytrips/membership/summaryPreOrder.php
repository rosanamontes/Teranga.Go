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

$trip = get_entity($group_guid);
$user=get_entity(elgg_get_logged_in_user_guid());

$summaryPreOrderUserGuid=$trip->summaryPreOrderUserGuid;
$clave=array_search($user->guid,$summaryPreOrderUserGuid);

//$resultado=search($summaryPreOrderUserGuid, 'userguid',$user->guid);
if($clave!=""){
	system_message(elgg_echo('mytrips:summaryPreOrder:justPreorder'));
}
else 
{
	$summaryPreOrderTrayecto=$trip->summaryPreOrderTrayecto;
	$summaryPreOrderBultos=$trip->summaryPreOrderBultos;
	$summaryPreOrderConfirmed=$trip->summaryPreOrderConfirmed;

	$subject=elgg_echo('mytrips:manageOrders:preorderOk:subject',array($trip->name));	
	
	switch($YoMaleta)
	{
		case "0":
			//Voy - only as passenger
			array_push($summaryPreOrderUserGuid,$user->guid);
			array_push($summaryPreOrderTrayecto,$trayecto);
			array_push($summaryPreOrderBultos,0);
			array_push($summaryPreOrderConfirmed,0);
			
			//PreOrder
			$follower=$trip->follower;
			$clave=array_search($user->guid,$follower);
			unset($follower[$clave]);
			$trip->follower=$follower;
			$preorder=$trip->preorder;
			array_push($preorder,$user->guid);
			$trip->preorder=$preorder;
			
			$clave=array_search($user->guid,$summaryPreOrderUserGuid);	
			$trayectoViajeGrupo=$trip->trayecto;
			$aportacion=$trip->aportacionViajero;
			
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
				"<a href=\"".$trip->getURL()."\">".$trip->name."</a>"
			));
			//al conductor

			//messages_send ($titulo_mensaje,$cuerpo_mensaje,$guid_destinatario,$guid_usuario,0,false,true);
			messages_send($subject,$body, $trip->owner_guid, $user->guid,0,false,true);
			
			$body = elgg_echo('mytrips:manageOrders:preorderOk:msgViajero:Yo',array(
				"<a href=\"".$trip->getURL()."\">".$trip->name."</a>",
				elgg_echo($trayectoViaje),
				$aportacionFinal
			));
			//al usuario
			messages_send($subject,$body, $user->guid,$trip->owner_guid,0,false,true);
			
			break;
		case "1":
			//Voy + Maleta - both services
			array_push($summaryPreOrderUserGuid,$user->guid);
			array_push($summaryPreOrderTrayecto,$trayecto);
			array_push($summaryPreOrderBultos,$bultos);
			array_push($summaryPreOrderConfirmed,0);

			//PreOrder
			$follower=$trip->follower;
			$clave=array_search($user->guid,$follower);
			unset($follower[$clave]);
			$trip->follower=$follower;
			$preorder=$trip->preorder;
			array_push($preorder,$user->guid);
			$trip->preorder=$preorder;

			$trayectoViajeGrupo=$trip->trayecto;
			$aportacion=$trip->aportacionViajero;
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
				"<a href=\"".$trip->getURL()."\">".$trip->name."</a>"
			));
			//al conductor
			messages_send($subject,$body, $trip->owner_guid, $user->guid, 0,false,true);

			$body=elgg_echo('mytrips:manageOrders:preorderOk:msgViajero:YoMaleta',array(
				"<a href=\"".$trip->getURL()."\">".$trip->name."</a>",
				elgg_echo($summaryPreOrderTrayecto[$clave]),
				$aportacionFinal,
				$bultos
			));
			//al usuario
			messages_send($subject,$body, $user->guid,$trip->owner_guid, 0,false, true);

			break;
		case "2":
			//Sólo Maleta - ojo!! no tiene la contribucion bien calculada @ToDo
			array_push($summaryPreOrderUserGuid,$user->guid);
			array_push($summaryPreOrderTrayecto,-1);
			array_push($summaryPreOrderBultos,$bultos);
			array_push($summaryPreOrderConfirmed,0);
			
			$body=elgg_echo('mytrips:manageOrders:preorderOk:Maleta',array(
				"<a href=\"".$user->getURL()."\">".$user->name."</a>",
				$aportacionFinal,
				$bultos,
				"<a href=\"".$trip->getURL()."\">".$trip->name."</a>"
			));
			//al conductor
			messages_send($subject,$body, $trip->owner_guid,$user->guid, 0,false, true);
			
			$body=elgg_echo('mytrips:manageOrders:preorderOk:msgViajero:Maleta',array(
				"<a href=\"".$trip->getURL()."\">".$trip->name."</a>",
				$aportacionFinal,
				$bultos
			));
			
			//al usuario
			messages_send($subject,$body, $user->guid,$trip->owner_guid, 0,false, true);
			
			break;
	}
	//messages_send($subject, $body, $recipient_guid, $sender_guid)
	$trip->summaryPreOrderUserGuid=$summaryPreOrderUserGuid;
	$trip->summaryPreOrderTrayecto=$summaryPreOrderTrayecto;
	$trip->summaryPreOrderBultos=$summaryPreOrderBultos;
	$trip->summaryPreOrderConfirmed=$summaryPreOrderConfirmed;
		
	system_messages(elgg_echo('mytrips:manageOrders:saved'));
}

forward($trip->getUrl());

?>
<?php
/**
 * Pre-Order summary and message communication between driver and passenger
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

$trip_guid = (int)get_input('trip_guid');
$trayecto = (string)get_input('opcionViaje');
$requestType = (int)get_input('opcion');//3 opciones, solo paqueteria, solo viaje, ambos
$bultos = (int)get_input('bultos');

$trip = get_entity($trip_guid);
$user=get_entity(elgg_get_logged_in_user_guid());

$summaryPreOrderUserGuid=$trip->summaryPreOrderUserGuid;
$clave=array_search($user->guid,$summaryPreOrderUserGuid);
//$resultado=search($summaryPreOrderUserGuid, 'userguid',$user->guid);

if ($clave!="")
{
	system_messages(elgg_echo('mytrips:summaryPreOrder:justPreorder'));
}
else 
{
	$summaryPreOrderTrayecto=$trip->summaryPreOrderTrayecto;
	$summaryPreOrderBultos=$trip->summaryPreOrderBultos;
	$summaryPreOrderConfirmed=$trip->summaryPreOrderConfirmed;

	$subjet=elgg_echo('mytrips:manageOrders:preorderOk:subjet',array($trip->name));	
	
	switch($requestType)
	{
		case "0":
			//Voy
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
			messages_send($subjet,$body, $trip->owner_guid, 0,$user->guid);
			
			$body=elgg_echo('mytrips:manageOrders:preorderOk:msgViajero:Yo',array(
			"<a href=\"".$trip->getURL()."\">".$trip->name."</a>",
			elgg_echo($trayectoViaje),
			$aportacionFinal
			));
			//al usuario
			messages_send($subjet,$body, $user->guid,$trip->owner_guid);
			
			break;
		case "1":
			//Voy + Maleta
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
			
			$body=elgg_echo('mytrips:manageOrders:preorderOk:requestType',array(
			"<a href=\"".$user->getURL()."\">".$user->name."</a>",
			elgg_echo($summaryPreOrderTrayecto[$clave]),
			$aportacionFinal,
			$bultos,
			"<a href=\"".$trip->getURL()."\">".$trip->name."</a>"
			));
			//al conductor
			messages_send($subjet,$body, $trip->owner_guid, 0,$user->guid);
			
			$body=elgg_echo('mytrips:manageOrders:preorderOk:msgViajero:requestType',array(
			"<a href=\"".$user->getURL()."\">".$user->name."</a>",
			elgg_echo($summaryPreOrderTrayecto[$clave]),
			$aportacionFinal,
			$bultos
			));
			//al usuario
			messages_send($subjet,$body, $user->guid,$trip->owner_guid);

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
			"<a href=\"".$trip->getURL()."\">".$trip->name."</a>"
			));


			//al conductor
			messages_send($subjet,$body, $trip->owner_guid, 0,$user->guid);
			
			$body=elgg_echo('mytrips:manageOrders:preorderOk:msgViajero:Maleta',array(
			"<a href=\"".$user->getURL()."\">".$user->name."</a>",
			$aportacionFinal,
			$bultos
			));
			
			//al usuario
			messages_send($subjet,$body, $user->guid,$trip->owner_guid);
			
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

?>




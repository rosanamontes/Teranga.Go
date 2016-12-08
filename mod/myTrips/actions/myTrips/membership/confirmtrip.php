<?php
/**
 * Someone pre-order a trip.
 *
* 	Plugin: myTripsTeranga
*	Author: Rosana Montes Soldado from previous version of @package ElggGroups
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

//register_error("aaa"); //mensaje en rojo MAL


//if ($user && ($trip instanceof ElggGroup)) 
if (!$user && !elgg_instanceof($trip, 'trip')) 
{
	if ($trip->getOwnerGUID() != elgg_get_logged_in_user_guid()) 
	{
		system_message(elgg_echo("myTrips:PreOrderCorrect")); //mensaje en negro OK

			//eliminar de preorder
				//copio en variable local
				$preorder=$trip->preorder;

				//busco posición del user a borrar
				$clave=array_search($user->guid,$preorder);

				//lo borro
				unset($preorder[$clave]);
				//vuelvo a asignar
				$trip->preorder=$preorder;

			//añadir en confirmed
				//copio en variable local
				$confirmed=$trip->confirmed;
				//añado al usuario
				array_push($confirmed,$user->guid);
				
				//vuelvo a copiar el array
				$trip->confirmed=$confirmed;
			
		
		
	} else {
		register_error(elgg_echo("myTrips:cantleave"));
	}
} else {
	register_error(elgg_echo("myTrips:cantleave"));
}
forward(REFERER);

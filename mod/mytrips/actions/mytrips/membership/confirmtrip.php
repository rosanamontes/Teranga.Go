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


if ($user && ($group instanceof ElggGroup)) 
{
	if ($group->getOwnerGUID() != elgg_get_logged_in_user_guid()) 
	{
		system_message(elgg_echo("mytrips:PreOrderCorrect")); //mensaje en negro OK

			//eliminar de preorder
				//copio en variable local
				$preorder=$group->preorder;

				//busco posición del user a borrar
				$clave=array_search($user->guid,$preorder);

				//lo borro
				unset($preorder[$clave]);
				//vuelvo a asignar
				$group->preorder=$preorder;

			//añadir en confirmed
				//copio en variable local
				$confirmed=$group->confirmed;
				//añado al usuario
				array_push($confirmed,$user->guid);
				
				//vuelvo a copiar el array
				$group->confirmed=$confirmed;
			
		
		
	} else {
		register_error(elgg_echo("mytrips:cantleave"));
	}
} else {
	register_error(elgg_echo("mytrips:cantleave"));
}

forward(REFERER);

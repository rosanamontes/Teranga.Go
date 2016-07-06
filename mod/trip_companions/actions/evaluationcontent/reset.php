<?php

/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: Full reset; objects and users' points
*/


/*
* Borrar puntos
* Option 1: listado de puntos por cada evaluación
*
if (elgg_is_active_plugin('elggx_userpoints')) 
{
	$entities = elgg_get_entities_from_metadata(array(
          'metadata_name' => 'meta_moderate',
          'metadata_value' => 'approved',
          'type' => 'object',
          'subtype' => 'userpoint',
          'owner_guid' => $user_guid,
          'limit' => $limit,
          'offset' => $offset
          ));
	foreach ($entities as $entity) 
	{
	    $owner = $entity->getOwnerEntity();
   		$friendlytime = elgg_view_friendly_time($entity->time_created);
   		$points = -$entity->meta_points;
		$description = "Se quitan los puntos por valoraciones al evaluador";

		system_message("Reset ". $points . " points of " . $owner->name);
		$userpoint = userpoints_add($owner->guid, $points, $description);	
	}
}
*/

/*
* Borrar puntos
* Option 2: listado de usuarios con puntos (expertos)
*/
if (elgg_is_active_plugin('elggx_userpoints')) 
{
	$options_count = array('type' => 'user', 'limit' => false, 'count' => true, 'order_by_metadata' =>  array('name' => 'userpoints_points', 'direction' => DESC, 'as' => integer));
	$options_count['metadata_name_value_pairs'] = array(array('name' => 'userpoints_points', 'value' => -10,  'operand' => '>'));
	$count = elgg_get_entities_from_metadata($options_count);
	$options = array('type' => 'user', 'limit' => $limit, 'offset' => $offset);
		//, 'order_by_metadata' =>  array('name' => 'userpoints_points', 'direction' => DESC, 'as' => integer));
		//$options['metadata_name_value_pairs'] = array(array('name' => 'userpoints_points', 'value' => -10,  'operand' => '>'));no solo los que tienen puntos... todos
	$experts = elgg_get_entities_from_metadata($options);

	foreach ($experts as $entity) 
	{
		$points = -$entity->userpoints_points;
		$description = elgg_echo('evaluationcontent:reset_all:description') . $entity->username;

		$userpoint = userpoints_add($entity->guid, $points, $description);	
		$user = get_user($entity->guid);

		$user->nValorations = 0 ;
		$user->expertise = 0 ;
		//system_message($user->nValorations . " reset " . $user->username);
		$user->karma = elgg_echo('hflts:karma:none');

	    /* hard core erasing is plausible too
	    $prefix = elgg_get_config('dbprefix');
	    delete_data("DELETE from {$prefix}metadata where name_id=" . add_metastring('userpoints_points'));
	    */
	}
}

/*
* Borrar evaluaciones
*/
$list = elgg_get_entities_from_metadata([
	'type' => 'object',
	'subtype' => 'evaluation_content',
	'order_by_metadata' => [
		'name' => 'state',
		'direction' => 'ASC',
		'as' => 'text',
	],
]);

if (!is_array($list)) system_error("Revisar foreach de E.C.Reset");
foreach ($list as $evaluation) 
{
	/*
	* se reinician los valores del perfil del usuario evaluado
	* se limpia el viaje de valoraciones
	* se borra la valoración en sí
	*/
	$user = get_user($evaluation->user_guid);
	if (!elgg_trigger_plugin_hook('evaluationcontent:delete', 'system', array('evaluation' => $evaluation), true)) 
		register_error(elgg_echo("evaluationcontent:notdeleted"));

	$theTrip = get_entity($evaluation->trip);
	if ($theTrip) //el viaje existe
		unset($theTrip->grade);
	
	if ($evaluation->delete())
	{
		system_message("borrando... ". $evaluation->guid);
		$user->nValorations=0;
		$user->karma = elgg_echo('hflts:karma:s0');
	} else {
		register_error(elgg_echo("evaluationcontent:notdeleted"));
	}
}

system_message(elgg_echo("evaluationcontent:deleted"));

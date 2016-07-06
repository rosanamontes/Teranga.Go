<?php
/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	CEI BioTIC Micro.proyect Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*
* 	Los Admins pueden confirmar una evaluación
*/

$guid = (int) get_input('guid');

$evaluation = get_entity($guid);
if (!$evaluation || $evaluation->getSubtype() !== "evaluation_content" || !$evaluation->canEdit()) 
{
	register_error(elgg_echo("evaluationcontent:notarchived"));
	forward(REFERER);
}

// allow another plugin to override
if (!elgg_trigger_plugin_hook('evaluationcontent:archive', 'system', ['evaluation' => $evaluation], true)) 
{
	register_error(elgg_echo("evaluationcontent:notarchived"));
	forward(REFERER);
}

/*
* se premiará con 1 punto al usuario que realiza la valoracion usando el plugin userpoints (+badgets)
* TO DO el numero de puntos puede ser configurable
*/
if (elgg_is_active_plugin('elggx_userpoints')) 
{
	$points = 1;
	//Se otorga un punto a " .$evaluation->owner. " por la evaluación realizada a ".$evaluation->name." relativa al viaje ".$evaluation->trip;
	$description = elgg_echo('evaluationcontent:pointtaken') . $points . elgg_echo('evaluationcontent:point') ;
	
	/*	$user = get_user_by_username('strem');	userpoints_add($user->guid, $points, $description, 'admin');*/
	userpoints_add($evaluation->owner_guid, $points, $description, 'admin');
}


//Registro del numero de valoraciones
$user = get_entity($evaluation->user_guid);

if (!$user->nValorations)
{
	$user->karma=0;
	$user->nValorations=0;
}
$user->nValorations=$user->nValorations + 1;
//system_message("nValorations = " . $user->nValorations);

// change the state
$evaluation->state = "archived";
system_message(elgg_echo("evaluationcontent:archived"));

//add to the river in case of group module solution
		elgg_create_river_item(array(
			'view' => 'river/object/evaluationcontent/create',
			'action_type' => 'create',
			'subject_guid' => elgg_get_logged_in_user_guid(),
			'object_guid' => $guid,
		));

forward(REFERER);

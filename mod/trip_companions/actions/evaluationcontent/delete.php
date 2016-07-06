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
* 	Admins can reject an evaluation
*/

$guid = (int) get_input('guid');

$evaluation = get_entity($guid);
if (!$evaluation || $evaluation->getSubtype() !== "evaluation_content" || !$evaluation->canEdit()) {
	register_error(elgg_echo("evaluationcontent:notdeleted"));
	forward(REFERER);
}

// give another plugin a chance to override
if (!elgg_trigger_plugin_hook('evaluationcontent:delete', 'system', array('evaluation' => $evaluation), true)) {
	register_error(elgg_echo("evaluationcontent:notdeleted"));
	forward(REFERER);
}

//debemos actualizar el numero de valoraciones
$user = get_entity($evaluation->user_guid);

if ($evaluation->delete()) {
	system_message(elgg_echo("evaluationcontent:deleted"));
	$user->nValorations=$user->nValorations - 1;
} else {
	register_error(elgg_echo("evaluationcontent:notdeleted"));
}

forward(REFERER);

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
*	File: Modulo para mostrar en los viajes aquellos comentarios públicos de los usuarios que han hecho su valoración
*		Ahora un viajero solo ve las valoraciones que ha realizado. Admin lo ve todo. 
*/

$group = elgg_get_page_owner_entity();
$guid = $group->getGUID();

if ($group->trip_companions_enable == "no") {
	system_message("activar-comentarios");//we should not get here
	return true;
}

$content = elgg_list_entities_from_metadata([
	'type' => 'object',
	'subtype' => 'evaluation_content',
	'metadata_name_value_pairs' => 
        array(
             array('name'=>'trip','value'=>$guid,'operand'=>'='),
        ),	
	'limit' => 30,
	'full_view' => true,
	'pagination' => true,
	'no_results' => elgg_echo('evaluationcontent:none'),
]);

//system_message(" box  " . $content);
echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('evaluationcontent:group'),
	'content' => $content,
));

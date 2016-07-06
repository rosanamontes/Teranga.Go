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
*	File: Array data of evaluations (an elgg list)
*/

$list = elgg_list_entities_from_metadata([
	'type' => 'object',
	'subtype' => 'evaluation_content',
	'order_by_metadata' => [
		'name' => 'state',
		'direction' => 'ASC',
		'as' => 'text',
	],
]);
if (!$list) {
	$list = '<p class="mtm">' . elgg_echo('evaluationcontent:none') . '</p>';
}

echo $list;
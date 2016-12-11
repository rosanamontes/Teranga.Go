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
*	File: output/go_radio
*		Traduce sobre la marcha el contenido de un radio button
*/

//$id = elgg_extract('id', $vars, '');
$value = elgg_extract('value', $vars, '');
//system_message($id . " output " . $value );
$value = elgg_echo($value);
echo elgg_view('output/text', array('value' => $value));
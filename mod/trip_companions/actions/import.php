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
*	File:  import DM data from csv
*/

//common settings
$nAlternativas = get_input('nAlternativas');
$nCriterios = get_input('nCriterios');
$nExpertos = get_input('nExpertos');
$G = get_input('G');
$import_file = get_input('import_file');


if (($import_file == 'imported') && ($nAlternativas == 0 || $nCriterios == 0 || $nExpertos == 0))
{
	register_error(elgg_echo('evaluationcontent:import:size:null'));
	forward("admin/teranga/import/");
}

// give another plugin a chance to override
if (!elgg_trigger_plugin_hook('admin:teranga:import', 'system', array(
		'nAlternativas' => $nAlternativas,
		'nCriterios' => $nCriterios,
		'nExpertos' => $nExpertos,
		'G' => $G,
		'import_file' => $import_file), true)) 
{
	register_error(elgg_echo("evaluationcontent:import:hook:error"));
	forward(REFERER);
}

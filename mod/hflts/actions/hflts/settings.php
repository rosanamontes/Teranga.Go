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
*	File: Save the plugin settings
*/


$simple_settings = [
	'profile_display',
	'termset',
	'classic',
	'vilkor',
	'topsis',
	'electre',
	'promethee',
];
foreach ($simple_settings as $setting) {
	elgg_set_plugin_setting($setting, get_input($setting), 'hflts');
}

elgg_flush_caches();

system_message(elgg_echo('hflts:settings:success'));

forward(REFERER);

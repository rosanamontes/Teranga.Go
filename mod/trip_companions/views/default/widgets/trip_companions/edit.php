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
*	File: to show options in the widget
*/

/* select for trips
echo elgg_echo('trip_companions:groups:only') . "<br>";
$options['name'] = 'params[look_in_groups]';
$options['value'] = $vars['entity']->look_in_groups ? $vars['entity']->look_in_groups : "yes";

echo elgg_view('input/dropdown', $options) . "<br><br>";
*/

// number of results
echo elgg_echo('trip_companions:how:many') . "<br>";
$options['name'] = 'params[num_display]';
$options['value'] = $vars['entity']->num_display ? $vars['entity']->num_display : 2;
$options['options_values'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

echo elgg_view('input/dropdown', $options);

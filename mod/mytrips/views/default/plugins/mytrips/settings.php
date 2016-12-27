<?php
/**
 * Trip plugin settings
 *
* 	Plugin: mytripsTeranga
*	Author: Rosana Montes Soldado from previous version of @package ElggGroups
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
*/

// set default value
if (!isset($vars['entity']->hidden_mytrips)) {
	$vars['entity']->hidden_mytrips = 'no';
}

// set default value
if (!isset($vars['entity']->limited_mytrips)) {
	$vars['entity']->limited_mytrips = 'no';
}

echo '<div>';
echo elgg_echo('mytrips:allowhiddenmytrips');
echo ' ';
echo elgg_view('input/select', array(
	'name' => 'params[hidden_mytrips]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes')
	),
	'value' => $vars['entity']->hidden_mytrips,
));
echo '</div>';

echo '<div>';
echo elgg_echo('mytrips:whocancreate');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[limited_mytrips]',
	'options_values' => array(
		'no' => elgg_echo('LOGGED_IN'),
		'yes' => elgg_echo('admin')
	),
	'value' => $vars['entity']->limited_mytrips,
));
echo '</div>';

<?php
/**
 * Trip followers sidebar
 * @uses $vars['entity'] trip entity
 * @uses $vars['limit']  The number of members to display
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

$limit = elgg_extract('limit', $vars, 14);

$body= elgg_view('mytrips/sidebar/views/tripArrays', array('CustomArray' => $vars['entity']->confirmed,'group_guid' => $vars['entity']->guid));

echo elgg_view_module('aside', elgg_echo('mytrips:confirmed'), $body);

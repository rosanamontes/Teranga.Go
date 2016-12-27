<?php
/**
 * Featured trips (date under "current")
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

$featured_groups = elgg_get_entities_from_metadata(array(
	'metadata_name' => 'featured_group',
	'metadata_value' => 'yes',
	'type' => 'group',
));

if ($featured_groups) {

	elgg_push_context('widgets');
	$body = '';
	foreach ($featured_groups as $group) {
		$body .= elgg_view_entity($group, array('full_view' => false));
	}
	elgg_pop_context();

	echo elgg_view_module('aside', elgg_echo("mytrips:featured"), $body);
}

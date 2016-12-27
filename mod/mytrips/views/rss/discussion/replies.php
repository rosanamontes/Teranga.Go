<?php
/**
 * List replies RSS view
 *
 * @uses $vars['entity'] ElggEntity
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

$options = array(
	'container_guid' => $vars['topic']->getGUID(),
	'type' => 'object',
	'subtype' => 'discussion_reply',
	'distinct' => false,
);
echo elgg_list_entities($options);

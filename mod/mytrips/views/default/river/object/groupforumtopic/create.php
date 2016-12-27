<?php
/**
 * Trip forum topic create river view.
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

$item = $vars['item'];
/* @var ElggRiverItem $item */

$object = $item->getObjectEntity();
$excerpt = strip_tags($object->description);
$excerpt = elgg_get_excerpt($excerpt);

$responses = '';
if (elgg_is_logged_in() && $object->canWriteToContainer()) {
	$responses = elgg_view('river/elements/discussion_replies', array('topic' => $object));
}

echo elgg_view('river/elements/layout', array(
	'item' => $item,
	'message' => $excerpt,
	'responses' => $responses,
));

<?php
/**
 * Delete topic action
 *
* 	Plugin: myTripsTeranga from previous version of @package ElggGroup
*	Author: Rosana Montes Soldado 
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
* 
*/ 

$topic_guid = (int) get_input('guid');

$topic = get_entity($topic_guid);
if (!elgg_instanceof($topic, 'object', 'tripforumtopic')) {
	register_error(elgg_echo('discussion:error:notdeleted'));
	forward(REFERER);
}

if (!$topic->canEdit()) {
	register_error(elgg_echo('discussion:error:permissions'));
	forward(REFERER);
}

$container = $topic->getContainerEntity();

$result = $topic->delete();
if ($result) {
	system_message(elgg_echo('discussion:topic:deleted'));
} else {
	register_error(elgg_echo('discussion:error:notdeleted'));
}

forward("discussion/owner/$container->guid");

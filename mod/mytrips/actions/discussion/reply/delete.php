<?php
/**
 * Delete discussion reply
* 	Plugin: mytrips Teranga from previous version of @package ElggGroup
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

$guid = (int) get_input('guid');

$reply = get_entity($guid);

if (!elgg_instanceof($reply, 'object', 'discussion_reply', 'ElggDiscussionReply')) {
	register_error(elgg_echo('discussion:reply:error:notdeleted'));
	forward(REFERER);
}

if (!$reply->canEdit()) {
	register_error(elgg_echo('discussion:error:permissions'));
	forward(REFERER);
}

if ($reply->delete()) {
	system_message(elgg_echo('discussion:reply:deleted'));
} else {
	register_error(elgg_echo('discussion:reply:error:notdeleted'));
}

forward(REFERER);

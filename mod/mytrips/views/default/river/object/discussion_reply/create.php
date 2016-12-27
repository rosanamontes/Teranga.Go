<?php
/**
 * River view for group discussion replies
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

$reply = $item->getObjectEntity();
$subject = $item->getSubjectEntity();
$target = $item->getTargetEntity();

$subject_link = elgg_view('output/url', array(
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
));

$target_link = elgg_view('output/url', array(
	'href' => $target->getURL(),
	'text' => $target->getDisplayName(),
	'class' => 'elgg-river-target',
	'is_trusted' => true,
));

$reply_link = elgg_view('output/url', array(
	'href' => $reply->getURL(),
	'text' => elgg_echo('river:reply:view'),
	'class' => 'elgg-river-target',
	'is_trusted' => true,
));

$summary = elgg_echo('river:reply:object:groupforumtopic', array($subject_link, $target_link));

echo elgg_view('river/elements/layout', array(
	'item' => $item,
	'message' => elgg_get_excerpt($reply->description). ' ' .$reply_link,
	'summary' => $summary,
));

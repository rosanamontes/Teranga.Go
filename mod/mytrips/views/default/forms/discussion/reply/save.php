<?php
/**
 * Discussion topic reply form body
 *
 * @uses $vars['topic']  A discussion topic object
 * @uses $vars['entity'] A discussion reply object
 * @uses $vars['inline'] Display a shortened form?
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

$topic = elgg_extract('topic', $vars);

$topic_guid_input = '';
if (isset($vars['topic'])) {
	$topic_guid_input = elgg_view('input/hidden', array(
		'name' => 'topic_guid',
		'value' => $vars['topic']->getGUID(),
	));
}

$inline = elgg_extract('inline', $vars, false);

$reply = elgg_extract('entity', $vars);

$value = '';

$reply_guid_input = '';
if ($reply && $reply->canEdit()) {
	$value = $reply->description;
	$reply_guid_input = elgg_view('input/hidden', array(
		'name' => 'guid',
		'value' => $reply->guid
	));

	$reply_label = elgg_echo("discussion:reply:edit");
	$submit_text = elgg_echo('save');
} else {
	$reply_label = elgg_echo("reply:this");
	$submit_text = elgg_echo('reply');
}

$cancel_button = '';
if ($reply) {
	$cancel_button = elgg_view('input/button', array(
		'value' => elgg_echo('cancel'),
		'class' => 'elgg-button-cancel mlm',
		'href' => $entity ? $entity->getURL() : '#',
	));
}

$submit_input = elgg_view('input/submit', array('value' => $submit_text));

if ($inline) {
	$description_input = elgg_view('input/text', array(
		'name' => 'description',
		'value' => $value
	));

echo <<<FORM
	$description_input
	$topic_guid_input
	$reply_guid_input
	$submit_input
FORM;
} else {
	$description_input = elgg_view('input/longtext', array(
		'name' => 'description',
		'value' => $value
	));

echo <<<FORM
	<div>
		<label>$reply_label</label>
		$description_input
	</div>
	<div class="foot">
		$reply_guid_input
		$topic_guid_input
		$submit_input $cancel_button
	</div>
FORM;
}


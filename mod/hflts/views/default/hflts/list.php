<?php

//namespace Teranga;


$user_guid = (int) get_input('uid');
$user = get_entity($user_guid);
system_message($user_guid ." list__" . $user->username);//usuario del hover

$title = elgg_echo('hflts');

$valorations = elgg_list_entities_from_metadata([
	'type' => 'object',
	'subtype' => 'evaluation_content',
	'limit' => $vars['entity']->num_display,
	'pagination' => false,
	'order_by_metadata' => [
		'name' => 'state',
		'direction' => 'ASC',
		'as' => 'text',
	],
]);
if (!$list) {
	$list = '<p class="mtm">' . elgg_echo('evaluationcontent:none') . '</p>';
}

$content = elgg_view('hflts/driver', array('valorations' => $valorations));

$body = elgg_view_layout('content', array(
	'title' => $title,
	'filter' => false,
	'content' => $content
));

echo elgg_view_page($title, $body);

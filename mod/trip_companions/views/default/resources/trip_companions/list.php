<?php

//namespace Teranga;

$title = elgg_echo('trip_companions');

$people = get_suggestions($vars['owner']->guid, $vars['friends'], $vars['groups']);

$content = elgg_view('trip_companions/people', array('people' => $people));

$body = elgg_view_layout('content', array(
	'title' => $title,
	'filter' => false,
	'content' => $content
));

echo elgg_view_page($title, $body);

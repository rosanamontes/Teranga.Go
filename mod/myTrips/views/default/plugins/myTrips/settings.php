<?php
/**
 * myTrips plugin settings
 */

// set default value
if (!isset($vars['entity']->hidden_myTrips)) {
	$vars['entity']->hidden_myTrips = 'no';
}

// set default value
if (!isset($vars['entity']->limited_myTrips)) {
	$vars['entity']->limited_myTrips = 'no';
}

echo '<div>';
echo elgg_echo('myTrips:allowhiddenmyTrips');
echo ' ';
echo elgg_view('input/select', array(
	'name' => 'params[hidden_myTrips]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes')
	),
	'value' => $vars['entity']->hidden_myTrips,
));
echo '</div>';

echo '<div>';
echo elgg_echo('myTrips:whocancreate');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[limited_myTrips]',
	'options_values' => array(
		'no' => elgg_echo('LOGGED_IN'),
		'yes' => elgg_echo('admin')
	),
	'value' => $vars['entity']->limited_myTrips,
));
echo '</div>';

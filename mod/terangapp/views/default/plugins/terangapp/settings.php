<?php
/**
* 	Plugin: TerangApp Popup Plugin
*	Author: Rosana Montes Soldado from previous version of Marek Lompart
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*
*	File: settings view
*/

// set default value
if (!isset($vars['entity']->beta_version)) {
	$vars['entity']->beta_version = 'no';
}

// set default value
if (!isset($vars['entity']->android_link)) {
	$vars['entity']->android_link = 'https://play.google.com/store';
}

// set default value
if (!isset($vars['entity']->ios_link)) {
	$vars['entity']->ios_link = 'http://www.apple.com/es/';
}

// set default value
if (!isset($vars['entity']->appsugr_link)) {
	$vars['entity']->appsugr_link = 'http://apps.ugr.es/app_opinaugr.html';
}

echo '<div>';
echo '<h5>'.elgg_echo('terangapp:settings:title').'</h5>';
echo elgg_echo('terangapp:settings:isbeta');
echo ' ';
echo elgg_view('input/select', array(
	'name' => 'params[beta_version]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes')
	),
	'value' => $vars['entity']->beta_version,
));
echo '</div>';

echo '<div>';
echo elgg_echo('terangapp:settings:android');
echo ' ';
echo elgg_view('input/text', array(
	'name' => 'params[android_link]',
	'value' => $vars['entity']->android_link,
));
echo '</div>';

echo '<div>';
echo elgg_echo('terangapp:settings:ios');
echo ' ';
echo elgg_view('input/text', array(
	'name' => 'params[ios_link]',
	'value' => $vars['entity']->ios_link,
));
echo '</div>';

echo '<div>';
echo elgg_echo('terangapp:settings:appsugr');
echo ' ';
echo elgg_view('input/text', array(
	'name' => 'params[appsugr_link]',
	'value' => $vars['entity']->appsugr_link,
));
echo '</div>';

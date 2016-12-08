<?php
/**
* 	Plugin: Teranga Trip Filtering Tool 0.1
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: Plugin settings for fuzzy filter
*/

$plugin = elgg_extract('entity', $vars);

$listing_options = [
	'yours' => elgg_echo('groups:yours'),
	//'newest' => elgg_echo('sort:newest'), => es la opcion por defecto!
	//'popular' => elgg_echo('sort:popular'),
	'open' => elgg_echo('fuzzy_filter:trips:sorting:open'),
	'closed' => elgg_echo('fuzzy_filter:trips:sorting:closed'),
	//'alpha' => elgg_echo('sort:alpha'),
	'ordered' => elgg_echo('fuzzy_filter:trips:sorting:ordered'),
	'featured' => elgg_echo('status:featured'),
	'suggested' => elgg_echo('fuzzy_filter:trips:sorting:suggested'),//Rosana: el que voy a implementar
	'discussion' => elgg_echo('groups:latestdiscussion'),
];

$body .= '<div>';
$body .= elgg_echo('fuzzy_filter:settings:listing:default');
$body .= elgg_view('input/select', [
	'name' => 'params[group_listing]',
	'options_values' => $listing_options,
	'value' => $plugin->group_listing,
	'class' => 'mls',
]);
$body .= '</div>';

$body .= '<div>';
$body .= elgg_echo('fuzzy_filter:settings:listing:available');
$body .= '<ul class="mll">';

foreach ($listing_options as $tab => $tab_title) 
{
	$tab_setting_name = "group_listing_{$tab}_available";
	$checkbox_options = [
		'name' => "params[{$tab_setting_name}]",
		'value' => 1,
		'label' => $tab_title,
	];
	$tab_value = $plugin->$tab_setting_name;

	//system_message("en settings " . $tab_title . " activo = " . $tab_value);


	if ($tab_value !== '0') {
		if (in_array($tab, ['ordered', 'featured'])) {
			// these tabs are default disabled
			if ($tab_value !== null) {
				$checkbox_options['checked'] = true;
			}
		} else {
			$checkbox_options['checked'] = true;
		}
	}
	$body .= elgg_format_element('li', [], elgg_view('input/checkbox', $checkbox_options));
}
$body .= '</ul>';
$body .= '</div>';

echo elgg_view_module('inline', $title, $body);


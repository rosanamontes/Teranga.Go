<?php

/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: Developer settings
*/

$plugin = elgg_get_plugin_from_id('teranga_idss');
$data = array(
/* ocultar
	'classic' => array(
		'type' => 'checkbox',
		'value' => 1,
		'checked' => elgg_get_plugin_setting('classic', 'teranga_idss') == 1,
		'readonly' => false,
	),

	'todim' => array(
		'type' => 'checkbox',
		'value' => 1,
		'checked' => elgg_get_plugin_setting('todim', 'teranga_idss') == 1,
		'readonly' => false,
	),

	'vikor' => array(
		'type' => 'checkbox',
		'value' => 1,
		'checked' => elgg_get_plugin_setting('vikor', 'teranga_idss') == 1,
		'readonly' => false,
	),
	
	'topsis' => array(
		'type' => 'checkbox',
		'value' => 1,
		'checked' => elgg_get_plugin_setting('topsis', 'teranga_idss') == 1,
		'readonly' => false,
	),

	'electre' => array(
		'type' => 'checkbox',
		'value' => 1,
		'checked' => elgg_get_plugin_setting('electre', 'teranga_idss') == 1,
		'readonly' => false,
	),

//* no implementado
	'promethee' => array(
		'type' => 'checkbox',
		'value' => 1,
		'checked' => elgg_get_plugin_setting('promethee', 'teranga_idss') == 1,
		'readonly' => false,
	),
*/

	'aggOperator' => array(
		'type' => 'dropdown',
		'value' => $plugin->aggOperator,
                'options_values' => array('0' => elgg_echo('teranga_idss:aggOperator:minmax'), '1' => elgg_echo('teranga_idss:aggOperator:HLWA')),
		'readonly' => false,
	),

	'termset' => array(
		'type' => 'dropdown',
		'value' => $plugin->termset,
                'options_values' => array('0' => elgg_echo('teranga_idss:settings:s3'), '1' => elgg_echo('teranga_idss:settings:s5'), '2' => elgg_echo('teranga_idss:settings:s7')),
		'readonly' => false,
	),

	'profile_display' => array(
		'type' => 'dropdown',
		'value' => $plugin->profile_display,
                'options_values' => array('1' => elgg_echo('teranga_idss:settings:yes'), '0' => elgg_echo('teranga_idss:settings:no')),
		'readonly' => false,
	),
/*
	'debug' => array(
		'type' => 'dropdown',
		'value' => $plugin->debug,
                'options_values' => array('1' => elgg_echo('teranga_idss:settings:yes'), '0' => elgg_echo('teranga_idss:settings:no')),
		'readonly' => false,
	),

	'exportTex' => array(
		'type' => 'dropdown',
		'value' => $plugin->exportTex,
                'options_values' => array('1' => elgg_echo('teranga_idss:settings:yes'), '0' => elgg_echo('teranga_idss:settings:no')),
		'readonly' => false,
	),


	'allowMany' => array(
		'type' => 'dropdown',
		'value' => $plugin->allowMany,
                'options_values' => array('1' => elgg_echo('teranga_idss:settings:yes'), '0' => elgg_echo('teranga_idss:settings:no')),
		'readonly' => false,
	),
*/
	'auto_moderation' => array(
		'type' => 'dropdown',
		'value' => $plugin->auto_moderation,
                'options_values' => array('1' => elgg_echo('teranga_idss:settings:yes'), '0' => elgg_echo('teranga_idss:settings:no')),
		'readonly' => false,
	),

	'weight_experts' => array(
		'type' => 'dropdown',
		'value' => $plugin->weight_experts,
                'options_values' => array('1' => elgg_echo('teranga_idss:settings:yes'), '0' => elgg_echo('teranga_idss:settings:no')),
		'readonly' => false,
	),

	'base_expertise' => array(
		'type' => 'range',
		'value' => $plugin->base_expertise,
		'readonly' => false,
	),

	'weight_assessments' => array(
		'type' => 'dropdown',
		'value' => $plugin->weight_assessments,
                'options_values' => array('1' => elgg_echo('teranga_idss:settings:yes'), '0' => elgg_echo('teranga_idss:settings:no')),
		'readonly' => false,
	),

);

/*$form .= "<br><br><b>" . elgg_echo('elggx_userpoints:settings:profile_display') . "</b>";
$form .= elgg_view('input/dropdown', array(
                'name' => 'params[profile_display]',
                'options_values' => array('1' => elgg_echo('elggx_userpoints:settings:yes'), '0' => elgg_echo('elggx_userpoints:settings:no')),
                'value' => $plugin->profile_display
));
*/


$form_vars = array('id' => 'teranga_idss-settings-form', 'class' => 'elgg-form-settings');
$body_vars = array('data' => $data);
echo elgg_view_form('teranga_idss/settings', $form_vars, $body_vars);


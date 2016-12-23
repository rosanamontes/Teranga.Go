<?php
/**
* 	Plugin: Valoraciones linguisticas con HFLTS (original class type)
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: input/go_radio
*		Radio input para usar con Teranga. La idea es que este radio maneja "traducciones"
*/


$defaults = array(
	'align' => 'vertical',
	'value' => array(),
	'disabled' => false,
	'options' => array(),
	'name' => '',
	'type' => 'radio'
);

$vars = array_merge($defaults, $vars);

$options = elgg_extract('options', $vars);
unset($vars['options']);

//if (empty($options)) return;

$id = elgg_extract('id', $vars, '');
unset($vars['id']);

$list_class = (array) elgg_extract('class', $vars, []);
$list_class[] = 'elgg-input-radios';
$list_class[] = "elgg-{$vars['align']}";

unset($vars['class']);
unset($vars['align']);

$vars['class'] = 'elgg-input-radio';

if (is_array($vars['value'])) {
	$vars['value'] = array_map('elgg_strtolower', $vars['value']);
} else {
	$vars['value'] = array(elgg_strtolower($vars['value']));
}

$value = $vars['value'];
unset($vars['value']);
system_message(" go_radio value ***  " . $value);

$radios = '';
foreach ($options as $label => $option) 
{
	$vars['checked'] = in_array(elgg_strtolower($option), $value);
	$vars['value'] = $option;
	system_message(" go_radio *** checked " . $option);
	// handle indexed array where label is not specified
	// @deprecated 1.8 Remove in 1.9
	if (is_integer($label)) {
		elgg_deprecated_notice('$vars[\'options\'] must be an associative array in input/radio', 1.8);
		$label = $option;
	}

	system_message(" input *** label " . $label);
	$texto = elgg_echo($label);//para teranga!
	$radio = elgg_format_element('input', $vars);
	$radios .= "<li><label>{$radio}{$texto}</label></li>";
}

echo elgg_format_element('ul', ['class' => $list_class, 'id' => $id], $radios);

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
*	File: output/go_range
*		Muestra en la página con un text el resultado de un valor + % de importancia
*/

$value = sanitise_int($vars['value'], false);
$value .= " % " . elgg_echo("profile:hint") ;	

echo elgg_view("output/text", array(
				'value' => $value,
				'class' => 'elgg-lightbox',
				'data-colorbox-opts' => json_encode([
					'width' => '85%',
					'height' => '85%',
					'iframe' => true,
				])
		));

<?php
/**
* non editable field
*
* 	Plugin: profiles_go from previous version of @package profile_manager of Coldtrick IT Solutions 2009
*	Author: Rosana Montes Soldado 
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
*
*/


if (is_array($vars["value"])) {
	// probably tags, so change to text (fixes #51)
	$vars["value"] = implode(", ", $vars["value"]);
}

echo elgg_view("input/hidden", $vars);
	
echo elgg_format_element('div', array(), elgg_view("output/text", $vars));

echo elgg_format_element('div', array(), elgg_echo("profiles_go:non_editable:info"));

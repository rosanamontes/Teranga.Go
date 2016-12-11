<?php
/*
* must accept terms
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

$accept_terms = elgg_get_plugin_setting("registration_terms", "profiles_go");
if ($accept_terms) {
	$link_begin = "<a target='_blank' href='" . $accept_terms . "'>";
	$link_end = "</a>";
	
	$label = elgg_echo("profiles_go:registration:accept_terms", array($link_begin, $link_end));

	$terms = "<div class='mandatory mbm'>";
	$terms .= elgg_view("input/checkbox", array(
		"id" => "register-accept_terms",
		"name" => "accept_terms",
		"value" => "yes",
		"default" => false
	));
	$terms .= "<label for='register-accept_terms'>" . $label . "</label>";
	$terms .= "</div>";
	
	echo $terms;
}
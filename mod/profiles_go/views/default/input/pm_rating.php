<?php

/*
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

elgg_require_js("profiles_go/rating");

$selected_value = sanitise_int($vars['value'], false);

$rating_id = $vars["name"] . "_container";


$body = elgg_view("input/hidden", $vars);
for ($i = 1; $i <= 5; $i++) {
	if ($i <= $selected_value) {
		$body .= elgg_view_icon("star-alt", "link");
	} else {
		$body .= elgg_view_icon("star-empty","link");
	}
}

$body .= " " . elgg_view("output/url", array("text" => elgg_echo("reset"), "href" => "#"));;

echo elgg_format_element('div', ['class' => 'profile-manager-input-pm-rating', 'id' => $rating_id], $body);

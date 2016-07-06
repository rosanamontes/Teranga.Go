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
*	File: admin form used to karma assigment
*/


$action = elgg_get_site_url() . 'action/evaluationcontent/assign';

$form = "<br><b>" . elgg_echo('trip_companions:assign:user') . ":</b>";
$form .= elgg_view('input/text', array('name' => "params[username]", 'value' => ''));
$form .= "<br><br>";

$form .= "<b>" . elgg_echo('trip_companions:assign:karma') . ":</b>";
$form .= elgg_view('input/text', array('name' => "params[label]", 'value' => ''));
$form .= "<br><br>";

$form .= "<b>" . elgg_echo('trip_companions:assign:number') . ":</b>";
$form .= elgg_view('input/text', array('name' => "params[nvalues]", 'value' => ''));
$form .= "<br><br>";

$form .= elgg_view("input/securitytoken");

$form .= elgg_view('input/submit', array('value' => elgg_echo("save")));
echo elgg_view('input/form', array('action' => $action, 'body' => $form));
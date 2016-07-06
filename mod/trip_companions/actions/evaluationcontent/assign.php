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
*	File: Accion que modifica el valor del karma de un usuario
*/

$params = get_input('params');

$user = get_user_by_username($params['username']);

//system_message($user->karma . " = ". $params['label']." & ".$user->nValorations . " = "  . $params['nvalues']); 
$user->karma = $params['label'];//aqui no funciona ya que icon.php lo recalcula siempre
$user->nValorations = $params['nvalues'];

system_message(sprintf(elgg_echo("trip_companions:assign:success"), $params['label'], elgg_echo('trip_companions:assign'), $params['username']));
forward(REFERER);

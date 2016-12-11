<?php

/*
* Numerical rate
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

$selected_value = sanitise_int($vars['value'], false);

echo "<div>";
for ($i = 1; $i <= 5; $i++) {
	if ($i <= $selected_value) {
		echo elgg_view_icon("star-alt");
	} else {
		echo elgg_view_icon("star-empty");
	}
}
echo "</div>";

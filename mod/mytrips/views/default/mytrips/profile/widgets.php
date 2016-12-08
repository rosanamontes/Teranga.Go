<?php
/**
* Profile widgets/tools
* 
* 	Plugin: myTripsTeranga from previous version of @package ElggGroup
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
	
// tools widget area
echo '<ul id="myTrips-tools" class="elgg-gallery elgg-gallery-fluid mtl clearfix">';

// enable tools to extend this area
echo elgg_view("myTrips/tool_latest", $vars);

// backward compatibility
$right = elgg_view('myTrips/right_column', $vars);
$left = elgg_view('myTrips/left_column', $vars);
if ($right || $left) {
	elgg_deprecated_notice('The views right_column and left_column have been replaced by tool_latest', 1.8);
	echo $left;
	echo $right;
}

echo "</ul>";


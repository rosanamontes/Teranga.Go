<?php
/**
* Profile widgets/tools
* 
* 	Plugin: mytripsTeranga
*	Author: Rosana Montes Soldado from previous version of @package ElggGroups
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
*/
	
// tools widget area
echo '<ul id="mytrips-tools" class="elgg-gallery elgg-gallery-fluid mtl clearfix">';

// enable tools to extend this area
echo elgg_view("mytrips/tool_latest", $vars);

// backward compatibility
$right = elgg_view('mytrips/right_column', $vars);
$left = elgg_view('mytrips/left_column', $vars);
if ($right || $left) {
	elgg_deprecated_notice('The views mytrips/right_column and mytrips/left_column have been replaced by mytrips/tool_latest', 1.8);
	echo $left;
	echo $right;
}

echo "</ul>";


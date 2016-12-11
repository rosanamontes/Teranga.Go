<?php

/**
 * Preview of user summary
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


$config = elgg_view("profiles_go/user_summary_control/configuration");
$preview = elgg_view("profiles_go/user_summary_control/preview");

$page_data = $config . $preview;

echo elgg_view("profiles_go/admin/tabs", array("user_summary_control_selected" => true));
echo $page_data;

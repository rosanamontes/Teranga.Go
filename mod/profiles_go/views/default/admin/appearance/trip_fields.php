<?php
/**
* Trip Profile Fields Config page
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


$fields = elgg_view("profiles_go/trip_fields/list");
$actions = elgg_view("profiles_go/trip_fields/actions");

$page_data = $fields . $actions;

echo elgg_view("profiles_go/admin/tabs", array("trip_fields_selected" => true));
echo $page_data;

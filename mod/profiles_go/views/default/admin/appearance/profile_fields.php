<?php
/**
* User Profile Fields Config page
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


$types = elgg_view("profiles_go/profile_types/list");
$categories = elgg_view("profiles_go/categories/list");
$fields = elgg_view("profiles_go/profile_fields/list");
$actions = elgg_view("profiles_go/profile_fields/actions");

$page_data = $types . $categories . $fields . $actions;

echo elgg_view("profiles_go/admin/tabs", array("profile_fields_selected" => true));
echo $page_data;

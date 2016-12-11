<?php
/**
* Export of profile fields
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


echo elgg_view("profiles_go/admin/tabs");
echo elgg_echo('profiles_go:export:description:' . CUSTOM_PROFILE_FIELDS_TRIP_SUBTYPE);

$form = elgg_view_form("profiles_go/export", array(), array("fieldtype" => CUSTOM_PROFILE_FIELDS_TRIP_SUBTYPE));

echo elgg_view_module("inline", elgg_echo("profiles_go:export:list:title"), $form);

<?php
/**
* Output view of a multiselect. Uses @package custom_index
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

if (is_string($vars["value"])) 
{
	//system_message("multiselect-not-happen" );
	$vars["value"] = string_to_tag_array($vars["value"]);
}

$isimage = false;

foreach ($vars['value'] as $value) 
{
	$ext=strrchr($value, '.');
	if ($ext == ".png")
	{
		$isimage = true;
		$image = elgg_get_site_url() . "mod/custom_index/graphics/" . $value;
		
		//system_message("<img src='". $image . "' alt='".$value."'>");
		echo elgg_view("output/img", array(
			'src' => $image,
			'alt' => $value));
	}
	
}

if (!$isimage) echo elgg_view("output/tags", $vars);
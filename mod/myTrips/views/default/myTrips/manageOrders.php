<?php
/**
 * Edit/create a trip wrapper
 *
 * @uses $vars['entity'] trip object
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

$entity = elgg_extract('entity', $vars, null);

$form_vars = array(
	'class' => 'elgg-form-alt',
);

echo elgg_view_form('myTrips/gestionarReservas', $form_vars, myTrips_prepare_form_vars($entity));

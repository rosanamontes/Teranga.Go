<?php
/**
* jQuery call to reorder the Custom Fields
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





$ordering = get_input("elgg-object");

if (!empty($ordering) && is_array($ordering)) {
	foreach ($ordering as $order => $guid) {
		$entity = get_entity($guid);
		if ($entity instanceof ProfileManagerCustomField) {
			$entity->order = $order + 1;
			
			// trigger memcache update
			$entity->save();
		}
	}
}

exit();

<?php

/**
* 	Plugin: Teranga Trip Filtering Tool 0.1
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: Plugin para gestionar filtros de viajes
*
* 	Start file for this plugin
*/

require_once(dirname(__FILE__) . '/lib/core.php');//aqui el codigo que implementa la funcionalidad


// default elgg event handlers
elgg_register_event_handler('init', 'system', 'trip_filter_init');

/**
 * called when the Elgg system get initialized
 *
 * @return void
 */
function trip_filter_init() 
{		
	// extend page handlers
	elgg_register_plugin_hook_handler('route', 'mytrips', 'Router::groups');
	
	elgg_register_action('trip_filter/order_groups', dirname(__FILE__) . '/actions/order_trips.php', 'admin');	
}


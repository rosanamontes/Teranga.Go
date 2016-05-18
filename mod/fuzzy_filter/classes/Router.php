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
*	File: Class to override pages/all
*/


class Router 
{
	
	/**
	 * Take over the groups page handler in some cases
	 *
	 * @param string $hook         the name of the hook
	 * @param string $type         the type of the hook
	 * @param array  $return_value current return value
	 * @param null   $params       supplied params
	 *
	 * @return void|false
	 */
	public static function groups($hook, $type, $return_value, $params) 
	{
		
		if (empty($return_value) || !is_array($return_value)) {
			return;
		}
		
		$include_file = false;
		$pages_path = elgg_get_plugins_path() . 'fuzzy_filter/pages/';
		
		$page = elgg_extract('segments', $return_value);
		switch ($page[0]) {
			case 'all':
				$filter = get_input('filter');
				$default_filter = elgg_get_plugin_setting('group_listing', 'fuzzy_filter');
				//system_message("el filter por defecto es " . $default_filter);

				if (empty($filter) && !empty($default_filter)) {
					$filter = $default_filter;
					set_input('filter', $default_filter);
				} elseif (empty($filter)) {
					$filter = 'newest';
					set_input('filter', $filter);
				}
				
				//Rosana: aqui añado suggested
				if (in_array($filter, ['yours', 'open', 'closed', 'alpha', 'ordered','suggested'])) {
					$include_file = "{$pages_path}groups/all.php";
				}
				
				break;
			case 'suggested':
				$include_file = "{$pages_path}groups/suggested.php";
				break;
			default:
				// check if we have an old group profile link
				if (isset($page[0]) && is_numeric($page[0])) {
					$group = get_entity($page[0]);
					if ($group instanceof ElggGroup) {
						register_error(elgg_echo('changebookmark'));
						forward($group->getURL());
					}
				}
				break;
		}
		
		// did we want this page?
		if (!empty($include_file)) {
			include($include_file);
			return false;
		}
	}
	
}
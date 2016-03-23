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
*	File: All helper functions for this plugin.
*/



/**
 * Returns suggested groups ... to be implemented (Rosana)
 *
 * @param ElggUser $user  (optional) the user to get the groups for, defaults to the current user
 * @param int      $limit (optional) the number of suggested groups to return, default = 10
 *
 * @return ElggGroup[]
 */
function fuzzy_filter_get_suggested_groups($user = null, $limit = null) 
{
	if (!($user instanceof ElggUser)) {
		$user = elgg_get_logged_in_user_entity();
	}
	
	if (is_null($limit)) {
		$limit = (int) get_input('limit', 10);
	}
	$limit = sanitize_int($limit, false);
	
	if (empty($user) || ($limit < 1)) {
		return [];
	}

	$result = [];
	
	return $result;
}


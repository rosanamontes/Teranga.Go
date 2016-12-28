<?php

/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	CEI BioTIC Micro.proyect Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: Add-in library 
*
*/


/*
* Check if both users are confirmed and assessment is valid
* Return:
*	 true if is valid and a hover menu shoud be shown
*/
function check_valid_asessment($source_guid, $target_guid, $trip_guid) 
{
	$x = check_available_user($source_guid, $trip_guid) ;
	$y = check_available_user($target_guid, $trip_guid) ;

	if ($x && $y)
	{
		$val = trip_companions_check_assessment($source_guid, $target_guid, $trip_guid) ;
		//system_message("---- ".$val);
		if ($val > -1)	//there is a valoration already
		{
			//now depends on the configuration on board
			if (elgg_get_plugin_setting('allowMany', 'hflts') != 0)//> one
				return true;
			else 
				return false;
		}
		else
			return true;
	}

	return false;
}


/*
* Check if user is in the confirmed list or the driver then maybe cound be an assessment later
* Return:
*	 true if available
*/
function check_available_user($guid, $trip_guid) 
{
	$trip = get_entity($trip_guid);
	$owner = $trip->getOwnerEntity();

	//el conductor es un caso especial
	if ($guid == $owner->guid)
	{
		return true;
	}

	$key = array_search($guid, $trip->confirmed);

	if ($key == "")
		return false;

	//ha confirmado y no es el conductor
	return true;
}

/*
* Check if user has an assessment in this trip
* Return:
*	 the position in the array where found the assessment, 
*	-1 if not found & could assess, 
* Restriction:
*	Assessments can onccurs only between confirmed pleople
*/
function trip_companions_check_assessment($source_guid, $target_guid, $trip_guid) 
{
	$user = NULL;
	if (!$source_guid) {
		$user = elgg_get_logged_in_user_entity();
	} else {
		$user = get_user($source_guid);
	}

	$trip = get_entity($trip_guid);

	//then verify, ...
	$element = $source_guid.$target_guid;
	$key = array_search($element, $trip->grade);
	if ($key != "")
		return $key; //has an assessment
	else
		return -1;//as if not found
}

/*
* Add a user to the trip's grade array
* source: the user that makes the assessment
* target: the user that is assessed
*/
function trip_companions_add_grade($source_guid, $target_guid, $trip_guid) 
{
	$key = trip_companions_check_assessment($source_guid, $target_guid, $trip_guid) ;
	
	if ($key == -1)//free 
	{
		$trip = get_entity($trip_guid);
		$copy=$trip->grade;
		$x = count($copy);

		$element = $source_guid.$target_guid;
		array_push( $copy, $element );
		$y = count($copy);

		if ($x < $y)
		{
			$trip->grade=$copy;
			system_message(elgg_echo("trips:grade:success")); 
		}
		else
		{	
			register_error(elgg_echo("trips:grade:fail")); 
			//this creates an orfan assessment
			forward(REFERER);
		}		
	}
}

/*
* Drop a user valoration (could be many) of the trip's grade array
*/
function trip_companions_remove_grade($source_guid, $target_guid, $trip_guid) 
{
	$key = trip_companions_check_assessment($source_guid, $target_guid, $trip_guid) ;
	if ($key != -1)//there is something to drop
	{
		$trip = get_entity($trip_guid);
		$copy=$trip->grade;
		$x = count($copy);
	
		unset($copy[$key]);
		$y = count($copy);

		if ($x > $y)
		{
			$trip->grade=$copy;
			system_message(elgg_echo("trips:unGrade:success")); 
		}
		else
		{	
			register_error(elgg_echo("trips:unGrade:fail")); 
			forward(REFERER);
		}
	}
}



/*
* Delete safely an assessment
*/
function delete_assessment($entity_guid) 
{
	$evaluation = get_entity($entity_guid);
	$user = get_entity($evaluation->user_guid);

	if ($evaluation->state == "archived")
	{
		//system_message($user->username . " was assessed by " . $evaluation->owner_guid . " (nValorations " . $user->nValorations .")");

		//drop owner points if the evaluation granted one
		if (elgg_is_active_plugin('elggx_userpoints')) 
		{
			$points = -1;
			$description = $points . elgg_echo('evaluationcontent:point') ;
			userpoints_add($evaluation->owner_guid, $points, $description, 'admin');
		}

		//update user nValorations
		if ($user->nValorations > 0)
			$user->nValorations=$user->nValorations - 1;

		//karma should be also updated
	}
	
	//drop grade
	if (!elgg_trigger_plugin_hook('evaluationcontent:delete', 'system', array('evaluation' => $evaluation), true)) 
		register_error(elgg_echo("evaluationcontent:notdeleted"));

	if (!$evaluation->delete())
		register_error(elgg_echo("evaluationcontent:notdeleted"));

}

/*
* Drop the assessments of a trip when it is deleted
*/
function delete_trip_assessments($trip_guid) 
{
	$list = elgg_get_entities_from_metadata([
		'type' => 'object',
		'subtype' => 'evaluation_content',
		'metadata_name_value_pairs' => array(
             array('name'=>'group','value'=>$trip_guid,'operand'=>'=')
        ),		
	]);
	if (!$list) {
		//system_message("empty-list");
		return;
	}
	
	$theTrip = get_entity($trip_guid);
	if (!is_array($list)) system_error("Revisar foreach de lib/TC");
	foreach ($list as $evaluation) 
	{
		if ($evaluation->trip == $trip_guid) //this must be
			delete_assessment($evaluation->guid);
		else register_error("no-concordance");
	}

	unset($theTrip->grade);
}


/*
* Recompute metadata expertise if expertiseBase changes
*/
function update_allusers_expertise() 
{
	$base = elgg_get_plugin_setting('base_expertise', 'hflts') ;
	//system_message("Computing with B=" . $base . " %");

	$options = array('type' => 'user', 'limit' => $limit, 'offset' => $offset);//, 
	$entities = elgg_get_entities_from_metadata($options);

	$i = 0; //counter
	$points = array();
	$values = array();
			

	if (is_array($entities)) 
	foreach ($entities as $entity) 
	{
		$entity->karma = userKarma($entity->guid);//recalculo todo de cara a overview
		$points[$i] = $entity->userpoints_points;
		$i++;
	}

	$values = relativeUserExpertise($points);	
	$i=0;
	foreach ($entities as $entity) 
	{
		$entity->expertise = $values[$i];
		//system_message($entity->name ." with ". $entity->expertise);
		$i++;
	}

}
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
*	File: Pop up window con el formulario para añadir valoraciones
*/

$uid = get_input('uid');//userguid (evaluated)
$name = get_input('name');//name of the user evaluated
$url = get_input('url');//profile link
$trip = get_input('trip');//trip guid
$G = get_input('granularity');//granularity
//system_message($name . " " . $uid . " " . $url . " / " . $trip);

//formfields
$C1 = get_input('C1');
$C2 = get_input('C2');
$C3 = get_input('C3');
$C4 = get_input('C4');
$C5 = get_input('C5');
$C6 = get_input('C6');
$W1 = get_input('W1');
$W2 = get_input('W2');
$W3 = get_input('W3');
$W4 = get_input('W4');
$description = get_input('description');

$access = ACCESS_PUBLIC; //this is private and only admins can see it

$fail = function () use ($url) 
{
	register_error(elgg_echo('evaluationcontent:failed'));
	forward($url);
};

if (!$name || !$url || !$trip || !$uid) 
{
	$fail();
}

$current_page = get_entity($trip);
$address = $current_page->getURL();


$evaluation = new ElggObject;
$evaluation->subtype = "evaluation_content";
$evaluation->owner_guid = elgg_get_logged_in_user_guid();//el usuario que evalua
$evaluation->user_guid = $uid;//el usuario evaluado
$evaluation->name = $name;
$evaluation->url = $url;
$evaluation->trip = $trip;//guid
$evaluation->granularity = $G;
$evaluation->criterion1 = $C1;//to be used in the MCDM model
$evaluation->criterion2 = $C2;//to be used in the MCDM model
$evaluation->criterion3 = $C3;//to be used in the MCDM model
$evaluation->criterion4 = $C4;//to be used in the MCDM model
$evaluation->criterion5 = $C5;//public
$evaluation->criterion6 = $C6;//public
$evaluation->weight1 = $W1/100.0;
$evaluation->weight2 = $W2/100.0;
$evaluation->weight3 = $W3/100.0;
$evaluation->weight4 = $W4/100.0;
$evaluation->description = $description;//public
$evaluation->access_id = $access;

if (!$evaluation->save()) 
{
	$fail();
}

//params: ('get_status', 'example', null, true)
//The current value for the hook is passed into the trigger function.
if (!elgg_trigger_plugin_hook('evaluationcontent:add', 'system', array('evaluation' => $evaluation), true)) 
{	
	$evaluation->delete();
	$fail();
}

$autoArchive = elgg_get_plugin_setting('auto_moderation', 'hflts');
//esto lo quiero implementar con una llamada al action archive, pero por lo pronto asi (un action se lanza desde botón)
if ($autoArchive)
{
	/*
	* se premiará con 1 punto al usuario que realiza la valoracion usando el plugin userpoints (+badgets)
	* TO DO el numero de puntos puede ser configurable
	*/
	if (elgg_is_active_plugin('elggx_userpoints')) 
	{
		$points = 1;
		$notify ="Se otorga un punto a " .$evaluation->owner. " por la evaluación realizada a ".$evaluation->name." relativa al viaje ".$evaluation->trip;
		//system_message($notify);
		$description = elgg_echo('evaluationcontent:pointtaken') . $points . elgg_echo('evaluationcontent:point') ;
		
		/*	$user = get_user_by_username('strem');	userpoints_add($user->guid, $points, $description, 'admin');*/
		userpoints_add($evaluation->owner_guid, $points, $description, 'admin');
	}

	//Registro del numero de valoraciones
	$user = get_entity($evaluation->user_guid);

	if (!$user->nValorations)
	{
		$user->karma=0;
		$user->nValorations=0;
	}
	$user->nValorations=$user->nValorations + 1;

	// change the state
	$evaluation->state = "archived";
	system_message(elgg_echo("evaluationcontent:archived"));

	// allow another plugin to override
	if (!elgg_trigger_plugin_hook('evaluationcontent:archive', 'system', ['evaluation' => $evaluation], true)) 
	{
		register_error(elgg_echo("evaluationcontent:notarchived"));
		forward(REFERER);
	}
}
else
{
	system_message(elgg_echo('evaluationcontent:success'));
	$evaluation->state = "active";
}
	
forward($address);	


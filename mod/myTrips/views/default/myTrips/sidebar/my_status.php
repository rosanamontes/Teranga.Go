<?php
/**
 * trip status for logged in user
 *
 * @uses $vars['entity'] trip entity
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

$trip = elgg_extract('entity', $vars);
$user = elgg_get_logged_in_user_entity();
$subscribed = elgg_extract('subscribed', $vars);

if (!elgg_is_logged_in()) 
{
	//teranga mensaje de información en modo abierto: "Debes estar logueado"
	elgg_register_menu_item('teranga:public', array(
		'name' => 'mustlogin',
		'text' => elgg_echo('teranga:public:mustlogin'),
		'href' => 'register'
	));
	$body = elgg_view_menu('teranga:public');
	echo elgg_view_module('aside', elgg_echo('teranga:public'), $body);
	
	return true;
}

// membership status
$is_member = $trip->isMember($user);
$is_owner = $trip->getOwnerEntity() == $user;

if ($is_owner) 
{
	elgg_register_menu_item('myTrips:my_status', array(
		'name' => 'membership_status',
		'text' => '<a>' . elgg_echo('myTrips:my_status:trip_owner') . '</a>',
		'href' => false
	));
	system_message(elgg_echo('myTrips:my_status:trip_owner'));
} 
else if ($is_member) 
{
	/*elgg_register_menu_item('myTrips:my_status', array(
		'name' => 'membership_status',
		'text' => '<a>' . elgg_echo('myTrips:my_status:trip_member') . '</a>',
		'href' => false
	));*/
	$follower =$trip->follower;
	$preorder =$trip->preorder;
	$confirmed=$trip->confirmed;
	$grade    =$trip->grade; //Rosana add status grade

	if(array_search($user->guid,$follower)>1)
	{
		elgg_register_menu_item('myTrips:my_status', array(
		'name' => 'membership_status',
		'text' => '<a>' . elgg_echo('myTrips:my_status:trip_member') . '</a>',
		'href' => false
		));
	} 
	else if (array_search($user->guid,$preorder)>1)
	{
		elgg_register_menu_item('myTrips:my_status', array(
		'name' => 'membership_status',
		'text' => '<a>' . elgg_echo('myTrips:my_status:trip_PreOrder') . ' ('.$trip->aportacionViajero.')</a>',
		'href' => false
		));
	} 
	else if (array_search($user->guid,$confirmed)>1)
	{
		elgg_register_menu_item('myTrips:my_status', array(
		'name' => 'membership_status',
		'text' => '<a>' . elgg_echo('myTrips:my_status:trip_Confirmed')  . ' ('.$trip->aportacionViajero.')</a>',
		'href' => false
		));
	} 
	
	/*
	elgg_log("MY_STATUS) myTrips/views/default/myTrips/sidebar/my_status","NOTICE");
	elgg_dump($user->guid);
	*/
} else {
	elgg_register_menu_item('myTrips:my_status', array(
		'name' => 'membership_status',
		'text' => elgg_echo('myTrips:join'),
		'href' => "/action/myTrips/join?trip_guid={$trip->getGUID()}",
		'is_action' => true
	));
}

// notification info
if (elgg_is_active_plugin('notifications') && $is_member) 
{
	if ($subscribed) {
		elgg_register_menu_item('myTrips:my_status', array(
			'name' => 'subscription_status',
			'text' => elgg_echo('myTrips:subscribed'),
			'href' => "notifications/trip/$user->username",
			'is_action' => true
		));
	} else {
		elgg_register_menu_item('myTrips:my_status', array(
			'name' => 'subscription_status',
			'text' => elgg_echo('myTrips:unsubscribed'),
			'href' => "notifications/trip/$user->username"
		));
	}
}

$body = elgg_view_menu('myTrips:my_status');
$grade_status = "";

//To do. Se debe comprobar que el viaje ya se ha realizado (lo que hablamos de pasarlo a una pesataña histórico) 
//y se puede contestar la encuesta de valoracion. Entonces tendrá sentido el else. Ahora lo dejo para que se muestre claramente el status

elgg_load_library('elgg:trip_companions');
if (check_available_user($user->guid, $trip->guid)) //$is_member no es suficiente si soy un usuario confirmado then
{
	foreach ($trip->confirmed as $key => $value) //for each member [confirmado] and not with me
	{
		if (($value == "_") || ($value == ""))
			continue;
		else
		{
			if ($user->guid != $value) 
			{
				$bro = get_user($value);//the other
				$key = trip_companions_check_assessment($user->guid, $bro->guid, $trip->guid);
				
				if ($key > -1)
					$grade_status .= '<div class="elgg-subtext">' . elgg_echo('myTrips:my_status:grade') . $bro->name .'</div>';
				else 
					$grade_status .= '<div class="elgg-subtext">' . elgg_echo('myTrips:my_status:grade:pending') . $bro->name .'</div>';
			}
		}
	}
	
	if (!$is_owner) //soy confirmado y debo valorar al conductor, que no está en ninguna lista
	{
		$bro = $trip->getOwnerEntity();
		$key = trip_companions_check_assessment($user->guid, $bro->guid, $trip->guid);
		
		if ($key > -1)
			$grade_status .= '<div class="elgg-subtext">' . elgg_echo('myTrips:my_status:grade') . $bro->name .'</div>';
		else 
			$grade_status .= '<div class="elgg-subtext">' . elgg_echo('myTrips:my_status:grade:pending') . $bro->name .'</div>';
	}
}
else
	$grade_status .= '<div class="elgg-subtext">' . elgg_echo('myTrips:my_status:nograde') .'</div>';

$body .= $grade_status;
echo elgg_view_module('aside', elgg_echo('myTrips:my_status'), $body);


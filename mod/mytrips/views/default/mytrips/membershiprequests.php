<?php
/**
 * A interested in trip request
 *
 * @uses $vars['entity']   trip entity
 * @uses $vars['requests'] Array of ElggUsers
 *
* 	Plugin: mytripsTeranga from previous version of @package ElggGroup
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

if (!empty($vars['requests']) && is_array($vars['requests'])) 
{
	echo '<ul class="elgg-list">';
	foreach ($vars['requests'] as $user) 
	{
		$icon = elgg_view_entity_icon($user, 'tiny', array('use_hover' => 'true'));

		$user_title = elgg_view('output/url', array(
			'href' => $user->getURL(),
			'text' => $user->name,
			'is_trusted' => true,
		));

		$url = "action/mytrips/addtotrip?user_guid={$user->guid}&trip_guid={$vars['entity']->guid}";
		$url = elgg_add_action_tokens_to_url($url);
		$accept_button = elgg_view('output/url', array(
			'href' => $url,
			'text' => elgg_echo('accept'),
			'class' => 'elgg-button elgg-button-submit',
			'is_trusted' => true,
		));

		$url = 'action/mytrips/killrequest?user_guid=' . $user->guid . '&trip_guid=' . $vars['entity']->guid;
		$delete_button = elgg_view('output/url', array(
				'href' => $url,
				'confirm' => elgg_echo('mytrips:joinrequest:remove:check'),
				'text' => elgg_echo('delete'),
				'class' => 'elgg-button elgg-button-delete mlm',
		));

		$body = "<h4>$user_title</h4>";
		$alt = $accept_button . $delete_button;

		echo '<li class="pvs">';
		echo elgg_view_image_block($icon, $body, array('image_alt' => $alt));
		echo '</li>';
	}
	echo '</ul>';
} else {
	echo '<p class="mtm">' . elgg_echo('mytrips:requests:none') . '</p>';
}

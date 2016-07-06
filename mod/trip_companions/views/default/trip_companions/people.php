<?php

/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: filter to get users in common 
*/

$people = $vars['people'];

if (is_array($people) && sizeof($people) > 0) {

	foreach ($people as $person) {

		$person_link = elgg_view('output/url', array(
			'text' => $person['entity']->name,
			'href' => $person['entity']->getURL()
		));


		$mutuals = '';
		if ($person['mutuals']) {
			$text = ($person['mutuals'] > 1) ? elgg_echo('trip_companions:num:mutual', array($person['mutuals'])) : elgg_echo('trip_companions:num:mutual:1');
			$mutuals = elgg_view('output/url', array(
				'text' => $text,
				'href' => 'ajax/view/trip_companions/mutual?guid=' . $person['entity']->guid,
				'class' => 'elgg-lightbox'
			));
		}

		$trip = '';
		if ($person['groups']) {
			$groups = elgg_view('output/url', array(
				'text' => elgg_echo('trip_companions:num:groups', array($person['groups'])),
				'href' => 'ajax/view/trip_companions/groups?guid=' . $person['entity']->guid,
				'class' => 'elgg-lightbox'
			));
		}

		$icon = elgg_view_entity_icon($person['entity'], 'small');
		
		$info = $person_link;
		if ($mutuals || $trip) {
			$value = $mutuals;
			if ($trip) {
				if ($value) {
					$value .= ', ';
				}
				$value .= $trip;
			}
			$info .= '<div class="elgg-subtext">' . $value . '</div>';
		}

		echo elgg_view('page/components/image_block', array(
			'image' => $icon,
			'body' => $info
		));
	}
} else {
	echo elgg_echo('trip_companions:people:not:found');
}

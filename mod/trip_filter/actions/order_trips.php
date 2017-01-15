<?php
/**
 * jQuery actions to order trips
 */

$guids = get_input('guids');
$order = 1;

if (empty($guids) || !is_array($guids)) {
	forward(REFERER);
}

foreach ($guids as $guid) {
	$trip = get_entity($guid);
	if (!($trip instanceof Elggtrip)) {
		continue;
	}
	
	$trip->order = $order;
	$order++;
}

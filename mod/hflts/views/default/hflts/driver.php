<?php

//namespace Teranga;

$valorationlist = $vars['valorations'];

if (is_array($valorationlist) && sizeof($valorationlist) > 0) {

	foreach ($valorationlist as $evaluation) 
	{
		$person_link = elgg_view('output/text', array(
				'text' => $evaluation->name,
				'href' => $evaluation->url,
				'is_trusted' => true,
				'class' => 'elgg-evaluation-content-address elgg-lightbox',
				'data-colorbox-opts' => json_encode([
					'width' => '85%',
					'height' => '85%',
					'iframe' => true,
				]),
		));

	}
} else {
	echo elgg_echo('hflts:evaluation:not:found');
}

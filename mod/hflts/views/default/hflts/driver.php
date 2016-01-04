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
*	File: private zone to get all info about the valorations of a user (mainly for drivers)
*/


$valorationlist = $vars['valorations'];//system_message(" Size\n " . sizeof($valorationlist));
	
if (sizeof($valorationlist) > 0) 
{

?>

<div class="evaluation-content evaluation-content-archived">
	<div class="clearfix">

<?php
	$count=0;
	$data = array('_','_');

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

		$hesitant = "#".$count." => G=" .  $evaluation->granularity;
		$hesitant .= " H={".$evaluation->criterion1 .",".$evaluation->criterion2.",".$evaluation->criterion3."}";
		$hesitant .= " W={".$evaluation->weight1.",". $evaluation->weight2.",".$evaluation->weight3."}";
		$data[$count] = array(
			'ref' => $evaluation->user_guid, 'co_codigo'=>$evaluation->owner_guid, 
			'U1' => $evaluation->criterion1, 'L1' => $evaluation->criterion1, 
			'U2' => $evaluation->criterion2, 'L2' => $evaluation->criterion2,
			'U3' => $evaluation->criterion3, 'L3' => $evaluation->criterion3
		);
		$weight[$count] = array( $evaluation->weight1, $evaluation->weight2, $evaluation->weight3 );
		$count++;
		?>
		<h3 class="mbm"><?php echo $person_link; ?></h3>
		<p><?php echo $hesitant; ?></p>
		<?php
	}	
?>	
	</div>
</div>

<?php

} else {
	echo elgg_echo('hflts:evaluation:not:found');
}

//To work with the objects we get the entities
$method_list = elgg_get_entities_from_metadata([
	'type' => 'object',
	'subtype' => 'mcdm',
	'pagination' => false,
]);

if (!$method_list) {
	$method_list = '<p class="mtm">' . elgg_echo('hflts:evaluation:not:found') . '</p>';
}	
else {
	foreach ($method_list as $entity) 
	{
		$model = get_entity($entity->guid);

		if (!$model || $model->getSubtype() !== "mcdm" || !$model->canEdit()) 
		{
			register_error(elgg_echo("hflts:evaluation:not:found"));
			forward(REFERER);
		}

		if ($model->label == "todim")
		{
			$method = new TodimHFL($evaluation->user_guid); 
			$title=$method->getTitle();
			$description=$method->getDescription();
			$method->setData($data,$weight,$count,$evaluation->granularity);
			$N = $method->getAlternatives();
			$M = $method->getCriteria();
			$P = $method->getExperts();
			$model->collectiveValoration = $method->run();
			unset($method);//destroys the object 

			//set valoration on user's profile
			$user = get_entity($evaluation->user_guid);
			$user->karma=$model->collectiveValoration;

			?>	
			<p><?php echo "depurando .... " . $title . " (" . $description .") " . $N."x".$M."x".$P; ?></p>
			<?php
		}

		//run it the last
		if ($model->label == "classic")
		{
			$method = new AggregationHFLTS($evaluation->user_guid); 
			$method->setData($data,$weight,$count,$evaluation->granularity);
			$model->collectiveValoration = $method->run();
			unset($method);//destroys the object 

			//set valoration on user's profile
			$user = get_entity($evaluation->user_guid);
			$user->karma=$model->collectiveValoration;
		}

	}
}

//To show objects we get the list
$method_list = elgg_list_entities_from_metadata([
	'type' => 'object',
	'subtype' => 'mcdm',
	'pagination' => false,
]);

if (!$method_list) {
	$method_list = '<p class="mtm">' . elgg_echo('hflts:evaluation:not:found') . '</p>';
}
else {
	echo $method_list;
}

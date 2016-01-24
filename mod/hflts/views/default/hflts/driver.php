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
*	File: private zone to get all info about the valorations of a user (a driver in Teranga)
*		It runs the methods to be compared
*/


$valorationlist = $vars['valorations'];
//	echo('driver: <pre>');	print_r($valorationlist);	echo('</pre><br>');		
	
if (sizeof($valorationlist) > 0) 
{

?>

<div class="evaluation-content evaluation-content-archived">
	<div class="clearfix">

<?php
	$count=0;
	$data = array('_','_');

	$enablePesos = elgg_get_plugin_setting('weight_assessments', 'hflts');
	$C_weight = null;

	$enableExpertos = elgg_get_plugin_setting('weight_experts', 'hflts');
	$E_weight = null;
	
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

		$data[$count] = array(
			'ref' => $evaluation->user_guid, 'co_codigo'=>$evaluation->owner_guid, 
		);//more to come

		$hesitant = "#".$count." => G=" .  $evaluation->granularity . " ";
		if (!is_array($evaluation->criterion1))
		{
			$hesitant .= "H_1={".$evaluation->criterion1."} - " ; 
			$data[$count]['U1']=$evaluation->criterion1; $data[$count]['L1']=$evaluation->criterion1;
		}
		else
		{
			$n = count($evaluation->criterion1) - 1;
			$hesitant .= "H_1={";
			for ($x=0;$x<$n;$x++)
				$hesitant .= $evaluation->criterion1[$x] . ",";
			$hesitant .= $evaluation->criterion1[$x] . "} - "; 
			$data[$count]['U1']=$evaluation->criterion1[$n]; $data[$count]['L1']=$evaluation->criterion1[0];
		}

		if (!is_array($evaluation->criterion2))
		{
			$hesitant .= "H_2={".$evaluation->criterion2."} - " ; 
			$data[$count]['U2']=$evaluation->criterion2; $data[$count]['L2']=$evaluation->criterion2;
		}
		else
		{
			$n = count($evaluation->criterion2) - 1;
			$hesitant .= "H_2={";
			for ($x=0;$x<$n;$x++)
				$hesitant .= $evaluation->criterion2[$x] . ",";
			$hesitant .= $evaluation->criterion2[$x] . "} - "; 
			$data[$count]['U2']=$evaluation->criterion2[$n]; $data[$count]['L2']=$evaluation->criterion2[0];
		}

		if (!is_array($evaluation->criterion3))
		{
			$hesitant .= "H_3={".$evaluation->criterion3."} - " ; 
			$data[$count]['U3']=$evaluation->criterion3; $data[$count]['L3']=$evaluation->criterion3;			
		}
		else
		{
			$n = count($evaluation->criterion3) - 1;
			$hesitant .= "H_3={";
			for ($x=0;$x<$n;$x++)
				$hesitant .= $evaluation->criterion3[$x] . ",";
			$hesitant .= $evaluation->criterion3[$x] . "} - ";
			$data[$count]['U3']=$evaluation->criterion3[$n]; $data[$count]['L3']=$evaluation->criterion3[0];
		}

		if (!is_array($evaluation->criterion4))
		{
			$hesitant .= "H_4={".$evaluation->criterion4."} - " ; 
			$data[$count]['U4']=$evaluation->criterion4; $data[$count]['L4']=$evaluation->criterion4;			
		}
		else
		{
			$n = count($evaluation->criterion4) - 1;
			$hesitant .= "H_4={";
			for ($x=0;$x<$n;$x++)
				$hesitant .= $evaluation->criterion4[$x] . ",";
			$hesitant .= $evaluation->criterion4[$x] . "}"; 
			$data[$count]['U4']=$evaluation->criterion4[$n]; $data[$count]['L4']=$evaluation->criterion4[0];			
		}

		if ($enablePesos)
		{
			$C_weight[$count] = array( $evaluation->weight1, $evaluation->weight2, $evaluation->weight3, $evaluation->weight4 );
			$hesitant .= " C_W={". $evaluation->weight1 . ", ". $evaluation->weight2. ", ". $evaluation->weight3. ", ". $evaluation->weight4 ."} ";
		}

		if ($enableExpertos)
		{
			$expert = get_user($evaluation->owner_guid);
			$hesitant .= "E_".$expert->name . " #" . $expert->userpoints_points ;
			$E_weight[$count] = $expert->userpoints_points;
		}

		$hesitant .= "<br>";

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


		if ($model->label == "electre")
		{
			$method = new ElectreHFLTS($evaluation->user_guid); 
			$method->setData($data,$C_weight,$E_weight,$count,$evaluation->granularity);
			$model->collectiveValoration = $method->run();
			unset($method);//destroys the object 
		}

		if ($model->label == "topsis")
		{
			$method = new TopsisHFLTS($evaluation->user_guid); 
			$method->setData($data,$C_weight,$E_weight,$count,$evaluation->granularity);
			$model->collectiveValoration = $method->run();
			unset($method);//destroys the object 
		}

		if ($model->label == "promethee")
		{
			$method = new PrometheeHF($evaluation->user_guid); 
			$method->setData($data,$C_weight,$E_weight,$count,$evaluation->granularity);
			$model->collectiveValoration = $method->run();
			unset($method);//destroys the object 
		}

		if ($model->label == "vikor")
		{
			$method = new VikorHFL($evaluation->user_guid); 
			$method->setData($data,$C_weight,$E_weight,$count,$evaluation->granularity);
			$model->collectiveValoration = $method->run();
			unset($method);//destroys the object 
		}

		if ($model->label == "todim")
		{
			$method = new TodimHFL($evaluation->user_guid); 
			$method->setData($data,$C_weight,$E_weight,$count,$evaluation->granularity);
			$model->collectiveValoration = $method->run();
			unset($method);//destroys the object 
		}

		//run it the last
		if ($model->label == "classic")
		{
			$method = new AggregationHFLTS($evaluation->user_guid); 
			$method->setData($data,$C_weight,$E_weight,$count,$evaluation->granularity);
			$model->collectiveValoration = $method->run();
			unset($method);//destroys the object 

			//set valoration on user's profile
			$user = get_user($evaluation->user_guid);
			//$user->karma=$model->collectiveValoration;
			system_message($user->username . " @ " . $model->collectiveValoration);
		}

	}
}

//To show the objects first we get the list
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

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
*	File: show the results of the methods under imported data external the platform
*/

//common settings
$nAlternativas = $vars['nAlternativas'];
$nCriterios = $vars['nCriterios'];
$nExpertos = $vars['nExpertos'];
$G = $vars['G'];
$import_file = $vars['import_file'];

	switch ($import_file) {
		case 'electre':
		case 'topsis':
		case 'topsisB':
		case 'promethee':
		case 'vikor':
		case 'vikorS7':
		case 'todim':
		case 'classic':
			$runcase = $import_file;
			break;
		
		default:
			$runcase = "imported";
			break;
	}

$import_file = elgg_get_plugins_path() . "hflts/samples/set_".$import_file.".csv";
//echo $nAlternativas . "  ..... " . $nCriterios. "  ..... " . $nExpertos. "  ..... " . $G. "  ..... " . $import_file . "  ..... " . $runcase . "<br>";


//To work with the objects we get the entities
$method_list = elgg_get_entities_from_metadata([
	'type' => 'object',
	'subtype' => 'mcdm',
	'pagination' => false,
]);

if (!$method_list) {
	$method_list = '<p class="mtm">' . elgg_echo('hflts:evaluation:not:found') . '</p>';
}	
else 
{
	if (is_array($method_list))
	foreach ($method_list as $entity) 
	{
		$model = get_entity($entity->guid);
		
		if (!$model || $model->getSubtype() !== "mcdm" || !$model->canEdit()) 
		{
			register_error(elgg_echo("hflts:evaluation:not:found"));
			forward(REFERER);
		}

		switch ($model->label) 
		{
			case 'electre':
				$method = new ElectreHFLTS($import_file); 
				break;
			case 'topsis':
				$method = new TopsisHFLTS($import_file); 
				break;
			case 'promethee':
				$method = new PrometheeHF($import_file); 
				break;
			case 'vikor':
				$method = new VikorHFL($import_file); 
				break;
			case 'todim':
				$method = new TodimHFL($import_file); 
				break;
			case 'classic':
				$method = new AggregationHFLTS($import_file); 
				break;
			
			default:
				register_error("label_not_found");
				break;
		}


		$method->case = $runcase;

		if ($runcase == "imported")
		{
			$method->setAlternatives($nAlternativas); //num of alternatives
			$method->setCriteria($nCriterios); //num of criteria
			$method->setExperts($nExpertos); //num of experts			
			$method->setGranularity($G); //granularity	
		}
		$method->debug = false;
		$model->collectiveValoration = $method->run();
		unset($method);//destroys the object 
		//echo "@ " . $model->collectiveValoration;

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

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
*	File: Save the plugin settings
*/

$fail = function () use ($url) 
{
	register_error(elgg_echo('hflts:settings:fail'));
	forward($url);
};

// clear the method list of previous settings
$list = elgg_get_entities_from_metadata([
	'type' => 'object',
	'subtype' => 'mcdm',
]);

if ($list) 
{
	if (!is_array($list)) system_error("Revisar foreach de settings");
	foreach ($list as $old_object) 
	{
		if (!$old_object->delete()) 
		{
			$fail();
		}
	}
}


$simple_settings = [
	'auto_moderation',
	'weight_assessments',
	'weight_experts',
	'base_expertise',
	'allowMany',
	'debug',
	'profile_display',
	'termset',
	'classic',
	'todim',
	'vikor',
	'topsis',
	'electre',
	'promethee',
	'aggOperator',
];
foreach ($simple_settings as $setting) 
{
	elgg_set_plugin_setting($setting, get_input($setting), 'hflts');
}


$aggOperator = elgg_get_plugin_setting('aggOperator', 'hflts');
switch ( $aggOperator )
{
	case '0':
		$operator = "minmax";
		break;
	case '1':
		$operator = "HLWA";
		break;
	default:
		$operator = "minmax";
		break;
}

$termnumber = elgg_get_plugin_setting('termset', 'hflts');
switch ( $termnumber )
{
	case '0':
		$scale = "S<sup>3</sup>";
		$G = 2;
		break;
	case '1':
		$scale = "S<sup>5</sup>";
		$G = 4;
		break;
	case '2':
		$scale = "S<sup>7</sup>";
		$G = 6;
		break;
	default:
		$scale = "S<sup>5</sup>";
		$G = 4;
		break;
}
system_message("# " . $operator);
$access = ACCESS_PRIVATE; //this is private and only admins can see it


if (elgg_get_plugin_setting('classic', 'hflts') == 1)
{
	$model1 = new ElggObject;
	$model1->subtype = "mcdm";
	$model1->owner_guid = elgg_get_logged_in_user_guid();//el usuario que evalua
	$model1->label = "classic";
	$model1->title = elgg_echo("hflts:label:classic");
	$model1->description = elgg_echo("hflts:help:classic");
	$model1->scale = $scale;
	$model1->operator = $operator;	
	$model1->collectiveValoration ="---";	
	if (!$model1->save()) 
	{
		$fail();
	}
}

if (elgg_get_plugin_setting('vikor', 'hflts') == 1)
{
	$model2 = new ElggObject;
	$model2->subtype = "mcdm";
	$model2->owner_guid = elgg_get_logged_in_user_guid();//el usuario que evalua
	$model2->label = "vikor";
	$model2->title = elgg_echo("hflts:label:vikor");
	$model2->description = elgg_echo("hflts:help:vikor");
	$model2->scale = $scale;
	$model2->operator = $operator;	
	$model2->collectiveValoration ="---";	
	if (!$model2->save()) 
	{
		$fail();
	}
}

if (elgg_get_plugin_setting('topsis', 'hflts') == 1)
{
	$model3 = new ElggObject;
	$model3->subtype = "mcdm";
	$model3->owner_guid = elgg_get_logged_in_user_guid();//el usuario que evalua
	$model3->label = "topsis";
	$model3->title = elgg_echo("hflts:label:topsis");
	$model3->description = elgg_echo("hflts:help:topsis");
	$model3->scale = $scale;
	$model3->operator = $operator;		
	$model3->collectiveValoration ="---";	
	if (!$model3->save()) 
	{
		$fail();
	}
}

if (elgg_get_plugin_setting('electre', 'hflts') == 1)
{
	$model4 = new ElggObject;
	$model4->subtype = "mcdm";
	$model4->owner_guid = elgg_get_logged_in_user_guid();//el usuario que evalua
	$model4->label = "electre";
	$model4->title = elgg_echo("hflts:label:electre");
	$model4->description = elgg_echo("hflts:help:electre");
	$model4->scale = $scale;
	$model4->operator = $operator;		
	$model4->collectiveValoration ="---";	
	if (!$model4->save()) 
	{
		$fail();
	}
}

if (elgg_get_plugin_setting('promethee', 'hflts') == 1)
{
	$model5 = new ElggObject;
	$model5->subtype = "mcdm";
	$model5->owner_guid = elgg_get_logged_in_user_guid();//el usuario que evalua
	$model5->label = "promethee";
	$model5->title = elgg_echo("hflts:label:promethee");
	$model5->description = elgg_echo("hflts:help:promethee");
	$model5->scale = $scale;
	$model5->operator = $operator;		
	$model5->collectiveValoration ="---";	
	if (!$model5->save()) 
	{
		$fail();
	}
}

if (elgg_get_plugin_setting('todim', 'hflts') == 1)
{
	$model6 = new ElggObject;
	$model6->subtype = "mcdm";
	$model6->owner_guid = elgg_get_logged_in_user_guid();//el usuario que evalua
	$model6->label = "todim";
	$model6->title = elgg_echo("hflts:label:todim");
	$model6->description = elgg_echo("hflts:help:todim");
	$model6->scale = $scale;
	$model6->operator = $operator;		
	$model6->collectiveValoration ="---";	
	if (!$model6->save()) 
	{
		$fail();
	}
}

elgg_flush_caches();

system_message(elgg_echo('hflts:settings:success'));

forward(REFERER);

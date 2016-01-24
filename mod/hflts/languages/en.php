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
*	File: English strings
*/


return array(
	'hflts' => 'HFLTS',
	'hflts:title' => 'Decision Making Algorithms',
	'hflts:menuhover' => 'Valorations',
	'hflts:profile' => 'Karma',
	'hflts:number' => 'From',
	'hflts:users' => 'users\' valorations.',
	'hflts:karma:none' => 'unknown',
	'hflts:karma:s0' => 'very poor',
	'hflts:karma:s1' => 'poor',
	'hflts:karma:s2' => 'novel',
	'hflts:karma:s3' => 'satisfying',
	'hflts:karma:s4' => 'trusted',
	'hflts:karma:s5' => 'very good',
	'hflts:karma:s6' => 'excelent',


	/**
	*  Plugin settings for admins
	*/
	'menu:page:header:teranga' => 'Teranga',
	'hflts:settings' => 'HFLTS',
	'admin:hflts' => 'University of Granada',
	'admin:hflts:settings' => 'Linguistic Decision Making',

	'hflts:label:profile_display' => 'Display karma on users profile? ',
	'hflts:help:profile_display' => 'The driver karma is the result of the decision making process considering overall satisfaction with the driver and his vehicle, and for all trips and valorations.',	
	'hflts:label:debug' => 'Show strings outputs',
	'hflts:help:debug' => 'Display the values of the interval model variables related to the code.',	
	'hflts:settings:yes' => 'Yes',
	'hflts:settings:no' => 'No',
	'hflts:label:allowMany' => 'Many assessments',
	'hflts:help:allowMany' => 'Allow many assessments from one user to other in the context of a trip',
	'hflts:label:auto_moderation' => 'Auto-Moderation',
	'hflts:help:auto_moderation' => 'If enabled, assessments would be automatically archived (no manual moderation)',	
	'hflts:label:weight_assessments' => 'Double assessment',
	'hflts:help:weight_assessments' => 'Enable to use importance per criteria and per evaluation (more subjetive information)',
	'hflts:label:weight_experts' => 'Consider Expersise',
	'hflts:help:weight_experts' => 'Allow many assessments from one user to other in the context of a trip',
	'hflts:label:base_expertise' => 'Base expertise',
	'hflts:help:base_expertise' => 'In case of considering expersise, this is a value in [0,1] that determines how to include the expersise characterization. 0=all from the platform 1=ignore the platform information (i.e. all user are equal).',
	
	'hflts:label:termset' => 'Linguistic terms',
	'hflts:help:termset' => 'Linguistic Term set to be used in the decision-making linguistics.',
	'hflts:settings:s3' => '3 terms',
	'hflts:settings:s5' => '5 terms',
	'hflts:settings:s7' => '7 terms',

	'hflts:settings:explanation' => 'Chose the methods to run as linguistic models in the decision making process.',
	'hflts:label:classic' => 'HFLTS Aggregation',
	'hflts:help:classic' => 'Rodriguez et al. IEEETFS\'12 - Hesitant fuzzy Linguistic Term Sets',
	'hflts:label:todim' => 'HFL Todim',
	'hflts:help:todim' => 'Couping Wei, Rosa. IJCIS\'15',
	'hflts:label:electre' => 'HFLTS-Electre I',
	'hflts:help:electre' => 'Jian-quang Wang IS\'14',
	'hflts:label:topsis' => 'Topsis para HFLTS',
	'hflts:help:topsis' => 'Osmat Beg IJIS\'13',
	'hflts:label:vikor' => 'HFL Vikor',
	'hflts:help:vikor' => 'Huchang Liao IEEE-TFS\'14',
	'hflts:label:promethee' => 'HF Promethee',
	'hflts:help:promethee' => 'Sonia Hajlaoui IEEE\'13',

	'hflts:label:submit' => 'Confirm',		
	'hflts:settings:success' => 'Options saved',
	'hflts:settings:fail' => 'An error appeared while saving data',

	/**
	*  Working with hesitant
	*/
	'hflts:evaluation:not:found' => 'Query not jet performed',	
	'hflts:mcdm:fail' => 'To few valorations to run the DM model',

);

?>

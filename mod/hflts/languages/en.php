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
	'hflts:karma:s0' => 'unknown',
	'hflts:karma:s1' => 'novel',
	'hflts:karma:s2' => 'satisfying',
	'hflts:karma:s3' => 'trusted',
	'hflts:karma:s4' => 'excelent',


	/**
	*  Plugin settings for admins
	*/
	'menu:page:header:teranga' => 'Teranga',
	'hflts:settings' => 'HFLTS',
	'admin:hflts' => 'University of Granada',
	'admin:hflts:settings' => 'Linguistic Decision Making',

	'hflts:label:profile_display' => 'Display karma on users profile? ',
	'hflts:help:profile_display' => 'The driver karma is the result of the decision making process considering overall satisfaction with the driver and his vehicle, and for all trips and valorations.',	
	'hflts:settings:yes' => 'Yes',
	'hflts:settings:no' => 'No',

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

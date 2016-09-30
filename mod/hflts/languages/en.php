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
	'hflts:karma:s0' => 'Terrible',
	'hflts:karma:s1' => 'Poor',
	'hflts:karma:s2' => 'Limited',
	'hflts:karma:s3' => 'Satisfiable',
	'hflts:karma:s4' => 'Honest',
	'hflts:karma:s5' => 'Very good',
	'hflts:karma:s6' => 'Excellent',

	/**
	*  Plugin settings for admins
	*/
	'menu:page:header:teranga' => 'Teranga',
	'hflts:settings' => 'HFLTS',
	'admin:hflts' => 'University of Granada',
	'admin:hflts:settings' => 'Linguistic Decision Making with HFLTS and 2-tuple linguistic representation',

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
	'hflts:label:weight_assessments' => 'Consider preferences',
	'hflts:help:weight_assessments' => 'Activates the use of importance per criteria and per expert (dual subjetive information)',
	'hflts:label:weight_experts' => 'Consider expersise',
	'hflts:help:weight_experts' => 'Allow many assessments from one user to other in the context of a trip',
	'hflts:label:base_expertise' => 'Base expertise',
	'hflts:help:base_expertise' => 'In case of considering expersise, this is a value in [0,1] that determines how to include the expersise characterization. 0=all from the platform 1=ignore the platform information (i.e. all user are equal).',
	
	'hflts:label:termset' => 'Linguistic terms',
	'hflts:help:termset' => 'Linguistic Term set to be used in the decision-making linguistics.',
	'hflts:settings:s3' => '3 terms',
	'hflts:settings:s5' => '5 terms',
	'hflts:settings:s7' => '7 terms',

	'hflts:settings:explanation' => 'Chose the methods to run as linguistic models in the decision making process.',
	'hflts:settings:explanation:reduced' => 'MultiExpert MultiCriteria Linguistic Model Settings',

	'hflts:label:classic' => 'HFLTS Classic',
	'hflts:help:classic' => 'Rodriguez et al. IEEETFS\'12 - Hesitant fuzzy Linguistic Term Sets. Method as in:<br> 
	<pre>R. Montes, A.M. Sanchez, P. Villar and F. Herrera, 
	A web tool to support decision making in the housing market using hesitant fuzzy linguistic term sets. 
	<em>Applied Soft Computing</em>, 35, (2015), pp.949--957.</pre>
	',
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

	'hflts:label:aggOperator' => 'Aggregation operator',
	'hflts:help:aggOperator' => 'Given a set of hesitants, compute the aggretate hesitant according one of these operators',
	'hflts:aggOperator:minmax' => 'MinMax from Classic-HFLTS & TOPSIS-HFLTS',
	'hflts:aggOperator:HLWA' => 'HLWA from Operators and Comparisons of HFLTS',

	'hflts:label:exportTex' => 'Export to LaTeX',
	'hflts:help:exportTex' => 'When using external samples (set_xxxx.csv and weight_xxxx_yyyy.csv files), automatic conversion to LaTeX tables can be output on result page if this setting is on',
	
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

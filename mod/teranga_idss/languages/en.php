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
	'teranga_idss' => 'HFLTS',
	'teranga_idss:title' => 'Decision Making Algorithms',
	'teranga_idss:menuhover' => 'Valorations',
	'teranga_idss:profile' => 'Karma',
	'teranga_idss:number' => 'From',
	'teranga_idss:users' => 'users\' valorations.',
	'teranga_idss:karma:none' => 'unknown',
	'teranga_idss:karma:s0' => 'Terrible',
	'teranga_idss:karma:s1' => 'Poor',
	'teranga_idss:karma:s2' => 'Limited',
	'teranga_idss:karma:s3' => 'Satisfiable',
	'teranga_idss:karma:s4' => 'Honest',
	'teranga_idss:karma:s5' => 'Very good',
	'teranga_idss:karma:s6' => 'Excellent',

	/**
	*  Plugin settings for admins
	*/
	'menu:page:header:teranga' => 'Teranga',
	'teranga_idss:settings' => 'HFLTS',
	'admin:teranga_idss' => 'University of Granada',
	'admin:teranga_idss:settings' => 'Linguistic Decision Making with HFLTS and 2-tuple linguistic representation',

	'teranga_idss:label:profile_display' => 'Display karma on users profile? ',
	'teranga_idss:help:profile_display' => 'The driver karma is the result of the decision making process considering overall satisfaction with the driver and his vehicle, and for all trips and valorations.',	
	'teranga_idss:label:debug' => 'Show strings outputs',
	'teranga_idss:help:debug' => 'Display the values of the interval model variables related to the code.',	
	'teranga_idss:settings:yes' => 'Yes',
	'teranga_idss:settings:no' => 'No',
	'teranga_idss:label:allowMany' => 'Many assessments',
	'teranga_idss:help:allowMany' => 'Allow many assessments from one user to other in the context of a trip',
	'teranga_idss:label:auto_moderation' => 'Auto-Moderation',
	'teranga_idss:help:auto_moderation' => 'If enabled, assessments would be automatically archived (no manual moderation)',	
	'teranga_idss:label:weight_assessments' => 'Consider preferences',
	'teranga_idss:help:weight_assessments' => 'Activates the use of importance per criteria and per expert (dual subjetive information)',
	'teranga_idss:label:weight_experts' => 'Consider expersise',
	'teranga_idss:help:weight_experts' => 'Allow many assessments from one user to other in the context of a trip',
	'teranga_idss:label:base_expertise' => 'Base expertise',
	'teranga_idss:help:base_expertise' => 'In case of considering expersise, this is a value in [0,1] that determines how to include the expersise characterization. 0=all from the platform 1=ignore the platform information (i.e. all user are equal).',
	
	'teranga_idss:label:termset' => 'Linguistic terms',
	'teranga_idss:help:termset' => 'Linguistic Term set to be used in the decision-making linguistics.',
	'teranga_idss:settings:s3' => '3 terms',
	'teranga_idss:settings:s5' => '5 terms',
	'teranga_idss:settings:s7' => '7 terms',

	'teranga_idss:settings:explanation' => 'Chose the methods to run as linguistic models in the decision making process.',
	'teranga_idss:settings:explanation:reduced' => 'MultiExpert MultiCriteria Linguistic Model Settings',

	'teranga_idss:label:classic' => 'HFLTS Classic',
	'teranga_idss:help:classic' => 'Rodriguez et al. IEEETFS\'12 - Hesitant fuzzy Linguistic Term Sets. Method as in:<br> 
	<pre>R. Montes, A.M. Sanchez, P. Villar and F. Herrera, 
	A web tool to support decision making in the housing market using hesitant fuzzy linguistic term sets. 
	<em>Applied Soft Computing</em>, 35, (2015), pp.949--957.</pre>
	',
	'teranga_idss:label:todim' => 'HFL Todim',
	'teranga_idss:help:todim' => 'Couping Wei, Rosa. IJCIS\'15',
	'teranga_idss:label:electre' => 'HFLTS-Electre I',
	'teranga_idss:help:electre' => 'Jian-quang Wang IS\'14',
	'teranga_idss:label:topsis' => 'Topsis para HFLTS',
	'teranga_idss:help:topsis' => 'Osmat Beg IJIS\'13',
	'teranga_idss:label:vikor' => 'HFL Vikor',
	'teranga_idss:help:vikor' => 'Huchang Liao IEEE-TFS\'14',
	'teranga_idss:label:promethee' => 'HF Promethee',
	'teranga_idss:help:promethee' => 'Sonia Hajlaoui IEEE\'13',

	'teranga_idss:label:aggOperator' => 'Aggregation operator',
	'teranga_idss:help:aggOperator' => 'Given a set of hesitants, compute the aggretate hesitant according one of these operators',
	'teranga_idss:aggOperator:minmax' => 'MinMax from Classic-HFLTS & TOPSIS-HFLTS',
	'teranga_idss:aggOperator:HLWA' => 'HLWA from Operators and Comparisons of HFLTS',

	'teranga_idss:label:exportTex' => 'Export to LaTeX',
	'teranga_idss:help:exportTex' => 'When using external samples (set_xxxx.csv and weight_xxxx_yyyy.csv files), automatic conversion to LaTeX tables can be output on result page if this setting is on',
	
	'teranga_idss:label:submit' => 'Confirm',		
	'teranga_idss:settings:success' => 'Options saved',
	'teranga_idss:settings:fail' => 'An error appeared while saving data',

	/**
	*  Working with hesitant
	*/
	'teranga_idss:evaluation:not:found' => 'Query not jet performed',	
	'teranga_idss:mcdm:fail' => 'To few valorations to run the DM model',

);

?>

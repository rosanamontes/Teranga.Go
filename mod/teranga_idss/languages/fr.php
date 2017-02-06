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
*	File: French strings
*/


return array(
	'teranga_idss' => 'HFLTS',
	'teranga_idss:title' => 'algorithmes de prise de décision',
	'teranga_idss:menuhover' => 'appréciations',
	'teranga_idss:profile' => 'Karma',
	'teranga_idss:number' => 'à partir de',
	'teranga_idss:users' => 'appréciations des utilisateurs.',
	'teranga_idss:karma:none' => 'inconnu',
	'teranga_idss:karma:s0' => 'très faible',
	'teranga_idss:karma:s1' => 'peut être amélioré',
	'teranga_idss:karma:s2' => 'moyen',
	'teranga_idss:karma:s3' => 'satisfaisant',
	'teranga_idss:karma:s4' => 'digne de confiance',
	'teranga_idss:karma:s5' => 'très bon',
	'teranga_idss:karma:s6' => 'excellent',


	/**
	*  Plugin settings for admins
	*/
	'menu:page:header:teranga' => 'Teranga',
	'teranga_idss:settings' => 'HFLTS',
	'admin:teranga_idss' => 'Universidad de Granada',
	'admin:teranga_idss:settings' => 'prise de décision linguistique sous incertitude',

	'teranga_idss:label:profile_display' => 'Montrer le karma en tant que profil d\'utilisateur?',
	'teranga_idss:help:profile_display' => 'le karma du conducteur est le résultat du processus de prise de décision des compagnons de voyage relatif à la satisfaction générale par rapport au conducteur et au véhicule et par rapport à tous les voyages dans lesquels ce dernier intervient.',	
	'teranga_idss:label:debug' => 'publier des messages du modèle',
	'teranga_idss:help:debug' => 'permet de connaître la valeur des variantes internes du modèle telles qu\'elles ont été programmées.',	
	'teranga_idss:settings:yes' => 'Oui',
	'teranga_idss:settings:no' => 'Non',
	'teranga_idss:label:allowMany' => 'reprendre des appréciations',
	'teranga_idss:help:allowMany' => 'permet de stocker plusieurs appréciations pour le même utilisateur et le même voyage.',	
	'teranga_idss:label:auto_moderation' => 'modération automatique',
	'teranga_idss:help:auto_moderation' => 'quand les appréciations sont autorisées, elles sont automatiquement archivées et ne nécessitent pas de modération manuelle.',		
	'teranga_idss:label:weight_assessments' => 'double appréciation',
	'teranga_idss:help:weight_assessments' => 'permet de signaler l\'importance de chaque critère dans chaque appréciation(double information subjective)',
	'teranga_idss:label:weight_experts' => 'prendre en compte  une expérience',
	'teranga_idss:help:weight_experts' => 'permet d\'intégrer le niveau d\'expérience dans l\'appréciation de l\'utilisateur',
	'teranga_idss:label:base_expertise' => 'expérience de base',
	'teranga_idss:help:base_expertise' => 'lorsqu\'on considère l\'expérience, cette valeur (0,1) caractérise votre intégration, en tant que 0= tout depuis la plateforme 1= rien depuis la plateforme (auquel cas les utilisateurs seraient tous au même niveau.',

	'teranga_idss:label:termset' => 'registre linguistique',
	'teranga_idss:help:termset' => 'ensemble de termes à utiliser dans l\'évaluation et dans le résultat du processus de prise de décision linguistique.',
	'teranga_idss:settings:s3' => '3 etiquettes',
	'teranga_idss:settings:s5' => '5 etiquettes',
	'teranga_idss:settings:s7' => '7 etiquettes',

	'teranga_idss:settings:explanation' => 'Sélectionnez les méthodes que vous souhaitez appliquer comme modèles de prise de décision linguistique.',
	'teranga_idss:label:classic' => 'HFLTS Classic',
	'teranga_idss:help:classic' => 'Rodriguez et al. IEEETFS\'12 - Hesitant fuzzy Linguistic Term Sets. Method as in:<br> 
	<pre>R. Montes, A.M. Sanchez, P. Villar and F. Herrera, 
	A web tool to support decision making in the housing market using hesitant fuzzy linguistic term sets. 
	<em>Applied Soft Computing</em>, 35, (2015), pp.949--957.</pre>
	',
	'teranga_idss:label:todim' => 'HFL Todim',
	'teranga_idss:help:todim' => 'Couping Wei, Rosa M. Rodríguez IJCIS\'15',
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

	'teranga_idss:label:submit' => 'Confirmer',		
	'teranga_idss:settings:success' => 'Modifications enregistrées avec succès',
	'teranga_idss:settings:fail' => 'Un problème est survenu lors de l\'enregistrement des modifiations',

	/**
	*  Consulta a los hesitant
	*/
	'teranga_idss:evaluation:not:found' => 'La consultation est à effectuer',
	'teranga_idss:mcdm:fail' => 'il n\'y a pas assez d\'appréciations pour appliquer le modèle de prise de décision.',
	
);
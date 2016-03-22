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
	'hflts' => 'HFLTS',
	'hflts:title' => 'algorithmes de prise de décision',
	'hflts:menuhover' => 'appréciations',
	'hflts:profile' => 'Karma',
	'hflts:number' => 'à partir de',
	'hflts:users' => 'appréciations des utilisateurs.',
	'hflts:karma:none' => 'inconnu',
	'hflts:karma:s0' => 'très faible',
	'hflts:karma:s1' => 'peut être amélioré',
	'hflts:karma:s2' => 'moyen',
	'hflts:karma:s3' => 'satisfaisant',
	'hflts:karma:s4' => 'digne de confiance',
	'hflts:karma:s5' => 'très bon',
	'hflts:karma:s6' => 'excellent',


	/**
	*  Plugin settings for admins
	*/
	'menu:page:header:teranga' => 'Teranga',
	'hflts:settings' => 'HFLTS',
	'admin:hflts' => 'Universidad de Granada',
	'admin:hflts:settings' => 'prise de décision linguistique sous incertitude',

	'hflts:label:profile_display' => 'Montrer le karma en tant que profil d\'utilisateur?',
	'hflts:help:profile_display' => 'le karma du conducteur est le résultat du processus de prise de décision des compagnons de voyage relatif à la satisfaction générale par rapport au conducteur et au véhicule et par rapport à tous les voyages dans lesquels ce dernier intervient.',	
	'hflts:label:debug' => 'publier des messages du modèle',
	'hflts:help:debug' => 'permet de connaître la valeur des variantes internes du modèle telles qu\'elles ont été programmées.',	
	'hflts:settings:yes' => 'Oui',
	'hflts:settings:no' => 'Non',
	'hflts:label:allowMany' => 'reprendre des appréciations',
	'hflts:help:allowMany' => 'permet de stocker plusieurs appréciations pour le même utilisateur et le même voyage.',	
	'hflts:label:auto_moderation' => 'modération automatique',
	'hflts:help:auto_moderation' => 'quand les appréciations sont autorisées, elles sont automatiquement archivées et ne nécessitent pas de modération manuelle.',		
	'hflts:label:weight_assessments' => 'double appréciation',
	'hflts:help:weight_assessments' => 'permet de signaler l\'importance de chaque critère dans chaque appréciation(double information subjective)',
	'hflts:label:weight_experts' => 'prendre en compte  une expérience',
	'hflts:help:weight_experts' => 'permet d\'intégrer le niveau d\'expérience dans l\'appréciation de l\'utilisateur',
	'hflts:label:base_expertise' => 'expérience de base',
	'hflts:help:base_expertise' => 'lorsqu\'on considère l\'expérience, cette valeur (0,1) caractérise votre intégration, en tant que 0= tout depuis la plateforme 1= rien depuis la plateforme (auquel cas les utilisateurs seraient tous au même niveau.',

	'hflts:label:termset' => 'registre linguistique',
	'hflts:help:termset' => 'ensemble de termes à utiliser dans l\'évaluation et dans le résultat du processus de prise de décision linguistique.',
	'hflts:settings:s3' => '3 etiquettes',
	'hflts:settings:s5' => '5 etiquettes',
	'hflts:settings:s7' => '7 etiquettes',

	'hflts:settings:explanation' => 'sélectionnez les méthodes que vous souhaitez appliquer comme modèles de prise de décision linguistique.',
	'hflts:label:classic' => 'agrégation HFLTS',
	'hflts:help:classic' => 'R.M. Rodríguez et al. IEEE-TFS\'12 - Hesitant Fuzzy Linguistic Term Sets',
	'hflts:label:todim' => 'HFL Todim',
	'hflts:help:todim' => 'Couping Wei, Rosa M. Rodríguez IJCIS\'15',
	'hflts:label:electre' => 'HFLTS-Electre I',
	'hflts:help:electre' => 'Jian-quang Wang IS\'14',
	'hflts:label:topsis' => 'Topsis para HFLTS',
	'hflts:help:topsis' => 'Osmat Beg IJIS\'13',
	'hflts:label:vikor' => 'HFL Vikor',
	'hflts:help:vikor' => 'Huchang Liao IEEE-TFS\'14',
	'hflts:label:promethee' => 'HF Promethee',
	'hflts:help:promethee' => 'Sonia Hajlaoui IEEE\'13',

	'hflts:label:submit' => 'confirmer',		
	'hflts:settings:success' => 'modifications enregistrées avec succès',
	'hflts:settings:fail' => 'un problème est survenu lors de l\'enregistrement des modifiations',

	/**
	*  Consulta a los hesitant
	*/
	'hflts:evaluation:not:found' => 'la consultation est à effectuer',
	'hflts:mcdm:fail' => 'il n\'y a pas assez d\'appréciations pour appliquer le modèle de prise de décision.',
	
);
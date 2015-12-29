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
*	File: Spanish strings
*/


return array(
	'hflts' => 'HFLTS',
	'hflts:title' => 'Algoritmos de Toma de Decisión',
	'hflts:menuhover' => 'Valoraciones',
	'hflts:profile' => 'Karma',
	'hflts:number' => 'A partir de',
	'hflts:users' => 'valoraciones de usuarios.',
	'hflts:karma:s0' => 'desconocido',
	'hflts:karma:s1' => 'novel',
	'hflts:karma:s2' => 'satisfactorio',
	'hflts:karma:s3' => 'confiable',
	'hflts:karma:s4' => 'excelente',

	/**
	*  Plugin settings for admins
	*/
	'menu:page:header:teranga' => 'Teranga',
	'hflts:settings' => 'HFLTS',
	'admin:hflts' => 'Universidad de Granada',
	'admin:hflts:settings' => 'Toma de decisión lingüistica bajo incertidumbre',

	'hflts:label:profile_display' => '¿Mostrar karma en Perfil de Usuario?',
	'hflts:help:profile_display' => 'El karma del conductor es el resultado del proceso de toma de decisión de los compañeros de un viaje relativo a la satisfacción general con el conductor y su vehículo, y para todos los viajes en los que intervenga el conductor.',	
	'hflts:settings:yes' => 'Si',
	'hflts:settings:no' => 'No',

	'hflts:label:termset' => 'Escala lingüistica',
	'hflts:help:termset' => 'Conjunto de etiquetas a utilizar en la evaluación y en el resultado del proceso de toma de decisión lingüistica.',
	'hflts:settings:s3' => '3 etiquetas',
	'hflts:settings:s5' => '5 etiquetas',
	'hflts:settings:s7' => '7 etiquetas',

	'hflts:settings:explanation' => 'Seleccione los métodos que desee ejecutar como modelos de toma de decisión lingüistica.',
	'hflts:label:classic' => 'Agregación HFLTS',
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

	'hflts:label:submit' => 'Confirmar',		
	'hflts:settings:success' => 'Cambios guardados con exito',
	'hflts:settings:fail' => 'Hubo un problema al guardar los cambios',

	/**
	*  Consulta a los hesitant
	*/
	'hflts:evaluation:not:found' => 'Pendiente realizar la consulta',
	'hflts:mcdm:fail' => 'No hay suficienes valoraciones para ejecutar el modelo de toma de decisión',
);

?>

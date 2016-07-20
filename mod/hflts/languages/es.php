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
	'hflts:karma:none' => 'desconocido',
	'hflts:karma:s0' => 'muy bajo',
	'hflts:karma:s1' => 'mejorable',
	'hflts:karma:s2' => 'novel',
	'hflts:karma:s3' => 'satisfactorio',
	'hflts:karma:s4' => 'confiable',
	'hflts:karma:s5' => 'muy bueno',
	'hflts:karma:s6' => 'excelente',


	/**
	*  Plugin settings for admins
	*/
	'menu:page:header:teranga' => 'Teranga',
	'hflts:settings' => 'HFLTS',
	'admin:hflts' => 'Universidad de Granada',
	'admin:hflts:settings' => 'Toma de decisión lingüistica con 2-tuplas bajo incertidumbre',

	'hflts:label:profile_display' => '¿Mostrar karma en Perfil de Usuario?',
	'hflts:help:profile_display' => 'El karma del conductor es el resultado del proceso de toma de decisión de los compañeros de un viaje relativo a la satisfacción general con el conductor y su vehículo, y para todos los viajes en los que intervenga el conductor.',	
	'hflts:label:debug' => 'Mostrar mensajes del modelo',
	'hflts:help:debug' => 'Permite conocer el valor de las variables internas del modelo tal y como éste se ha programado.',	
	'hflts:settings:yes' => 'Si',
	'hflts:settings:no' => 'No',
	'hflts:label:allowMany' => 'Repetir valoraciones',
	'hflts:help:allowMany' => 'Permite almacenar varias valoraciones para un mismo usuario y viaje.',	
	'hflts:label:auto_moderation' => 'Moderación automática',
	'hflts:help:auto_moderation' => 'Cuando se habilita, las valoraciones se archivan automáticamente y no se requiere moderación manual.',		
	'hflts:label:weight_assessments' => 'Doble valoración',
	'hflts:help:weight_assessments' => 'Permite expresar la importancia de cada criterio en cada valoración (doble información subjetiva)',
	'hflts:label:weight_experts' => 'Considerar experiencia',
	'hflts:help:weight_experts' => 'Permite añadir el grado de experiencia en la valoración del usuario',
	'hflts:label:base_expertise' => 'Experiencia base',
	'hflts:help:base_expertise' => 'En caso de considerar la experincia, este valor [0,1] caracteriza su inclusión, siendo: 0=todo desde la plataforma 1=nada desde la plataforma (en este caso todos los usuarios serian iguales).',

	'hflts:label:termset' => 'Escala lingüistica',
	'hflts:help:termset' => 'Conjunto de etiquetas a utilizar en la evaluación y en el resultado del proceso de toma de decisión lingüistica.',
	'hflts:settings:s3' => '3 etiquetas',
	'hflts:settings:s5' => '5 etiquetas',
	'hflts:settings:s7' => '7 etiquetas',

	'hflts:settings:explanation' => 'Seleccione los métodos que desee ejecutar como modelos de toma de decisión lingüistica.',
	'hflts:label:classic' => 'HFLTS Classic',
	'hflts:help:classic' => 'R.M. Rodríguez et al. IEEE-TFS\'12 - Hesitant Fuzzy Linguistic Term Sets. Method as in:<br> 
	<pre>R. Montes, A.M. Sanchez, P. Villar and F. Herrera, 
	A web tool to support decision making in the housing market using hesitant fuzzy linguistic term sets. 
	<em>Applied Soft Computing</em>, 35, (2015), pp.949--957.</pre>
	',
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

	'hflts:label:aggOperator' => 'Operador de agregación',
	'hflts:help:aggOperator' => 'Dado un conjunto de hesitants, se desea agregar y obtener el hesitant resultante, según uno de estos operadores',
	'hflts:aggOperator:minmax' => 'MinMax de Classic-HFLTS & TOPSIS-HFLTS',
	'hflts:aggOperator:HLWA' => 'HLWA de Operators and Comparisons of HFLTS',

	'hflts:label:exportTex' => 'Exportar a LaTeX',
	'hflts:help:exportTex' => 'Cuando los datos usados son externos (ficheros set_xxxx.csv & weight_xxxx_yyyy.csv), la conversión a LaTeX puede ser automática (se muestra en la página de resultados)',

	'hflts:label:submit' => 'Confirmar',		
	'hflts:settings:success' => 'Cambios guardados con exito',
	'hflts:settings:fail' => 'Hubo un problema al guardar los cambios',

	/**
	*  Consulta a los hesitant
	*/
	'hflts:evaluation:not:found' => 'Pendiente realizar la consulta',
	'hflts:mcdm:fail' => 'No hay suficientes valoraciones para ejecutar el modelo de toma de decisión.',
);

?>

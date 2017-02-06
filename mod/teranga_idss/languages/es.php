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
	'teranga_idss' => 'HFLTS',
	'teranga_idss:title' => 'Algoritmos de Toma de Decisión',
	'teranga_idss:menuhover' => 'Valoraciones',
	'teranga_idss:profile' => 'Karma',
	'teranga_idss:number' => 'A partir de',
	'teranga_idss:users' => 'valoraciones de usuarios.',
	'teranga_idss:karma:none' => 'desconocido',
	'teranga_idss:karma:s0' => 'Terrible',
	'teranga_idss:karma:s1' => 'Pobre',
	'teranga_idss:karma:s2' => 'Limitado',
	'teranga_idss:karma:s3' => 'Satisfactorio',
	'teranga_idss:karma:s4' => 'Confiable',
	'teranga_idss:karma:s5' => 'Muy bueno',
	'teranga_idss:karma:s6' => 'Excelente',


	/**
	*  Plugin settings for admins
	*/
	'menu:page:header:teranga' => 'Teranga',
	'teranga_idss:settings' => 'HFLTS',
	'admin:teranga_idss' => 'Universidad de Granada',
	'admin:teranga_idss:settings' => 'Toma de decisión lingüistica con 2-tuplas bajo incertidumbre',

	'teranga_idss:label:profile_display' => '¿Mostrar karma en Perfil de Usuario?',
	'teranga_idss:help:profile_display' => 'El karma del conductor es el resultado del proceso de toma de decisión de los compañeros de un viaje relativo a la satisfacción general con el conductor y su vehículo, y para todos los viajes en los que intervenga el conductor.',	
	'teranga_idss:label:debug' => 'Mostrar mensajes del modelo',
	'teranga_idss:help:debug' => 'Permite conocer el valor de las variables internas del modelo tal y como éste se ha programado.',	
	'teranga_idss:settings:yes' => 'Si',
	'teranga_idss:settings:no' => 'No',
	'teranga_idss:label:allowMany' => 'Repetir valoraciones',
	'teranga_idss:help:allowMany' => 'Permite almacenar varias valoraciones para un mismo usuario y viaje.',	
	'teranga_idss:label:auto_moderation' => 'Moderación automática',
	'teranga_idss:help:auto_moderation' => 'Cuando se habilita, las valoraciones se archivan automáticamente y no se requiere moderación manual.',		
	'teranga_idss:label:weight_assessments' => 'Condiderar preferencias',
	'teranga_idss:help:weight_assessments' => 'Permite expresar la importancia de cada criterio en cada valoración (doble información subjetiva)',
	'teranga_idss:label:weight_experts' => 'Considerar experiencia',
	'teranga_idss:help:weight_experts' => 'Permite añadir el grado de experiencia en la valoración del usuario',
	'teranga_idss:label:base_expertise' => 'Experiencia base',
	'teranga_idss:help:base_expertise' => 'En caso de considerar la experincia, este valor [0,1] caracteriza su inclusión, siendo: 0=todo desde la plataforma 1=nada desde la plataforma (en este caso todos los usuarios serian iguales).',

	'teranga_idss:label:termset' => 'Escala lingüistica',
	'teranga_idss:help:termset' => 'Conjunto de etiquetas a utilizar en la evaluación y en el resultado del proceso de toma de decisión lingüistica.',
	'teranga_idss:settings:s3' => '3 etiquetas',
	'teranga_idss:settings:s5' => '5 etiquetas',
	'teranga_idss:settings:s7' => '7 etiquetas',

	'teranga_idss:settings:explanation' => 'Seleccione los métodos que desee ejecutar como modelos de toma de decisión lingüistica.',
	'teranga_idss:label:classic' => 'HFLTS Classic',
	'teranga_idss:help:classic' => 'R.M. Rodríguez et al. IEEE-TFS\'12 - Hesitant Fuzzy Linguistic Term Sets. Method as in:<br> 
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

	'teranga_idss:label:aggOperator' => 'Operador de agregación',
	'teranga_idss:help:aggOperator' => 'Dado un conjunto de hesitants, se desea agregar y obtener el hesitant resultante, según uno de estos operadores',
	'teranga_idss:aggOperator:minmax' => 'MinMax de Classic-HFLTS & TOPSIS-HFLTS',
	'teranga_idss:aggOperator:HLWA' => 'HLWA de Operators and Comparisons of HFLTS',

	'teranga_idss:label:exportTex' => 'Exportar a LaTeX',
	'teranga_idss:help:exportTex' => 'Cuando los datos usados son externos (ficheros set_xxxx.csv & weight_xxxx_yyyy.csv), la conversión a LaTeX puede ser automática (se muestra en la página de resultados)',

	'teranga_idss:label:submit' => 'Confirmar',		
	'teranga_idss:settings:success' => 'Cambios guardados con exito',
	'teranga_idss:settings:fail' => 'Hubo un problema al guardar los cambios',

	/**
	*  Consulta a los hesitant
	*/
	'teranga_idss:evaluation:not:found' => 'Pendiente realizar la consulta',
	'teranga_idss:mcdm:fail' => 'No hay suficientes valoraciones para ejecutar el modelo de toma de decisión.',
);

?>

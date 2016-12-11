<?php

/**
 * spanish strings
 * 
* 	Plugin: mytripsTeranga from previous version of @package ElggGroup
*	Author: Rosana Montes Soldado 
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
* 	Project colaborator: Antonio Moles 
*	
*   Project Derivative:
*	TFG: Desarrollo de un sistema de gestión de paquetería para Teranga Go
*   Advisor: Rosana Montes
*   Student: Ricardo Luzón Fernández
* 
*/

return array(	
	'custom:mytrips' => "&uacute;ltimos viajes",
	
	/**
	 * Menu items and titles Teranga Go 
	 */
	'mytrips' => "Tu viaje",
	'mytrips:owned' => "Viajes que administro",
	'mytrips:owned:user' => 'Viaje que administra %s',
	'mytrips:yours' => "Mis viajes",
	'mytrips:user' => "Viaje de %s",
	'mytrips:all' => "Todos los viajes",
	'mytrips:add' => "Crear un nuevo viaje",
	'mytrips:edit' => "Editar viaje",
	'mytrips:delete' => 'Borrar viaje',
	'mytrips:membershiprequests' => 'Administrar solicitudes de interés a viajes',
	'mytrips:membershiprequests:pending' => 'Administrar solicitudes de interés (%s)',
	'mytrips:invitations' => 'Avisos de viaje',
	'mytrips:invitations:pending' => 'Avisos de (%s)',

	'mytrips:icon' => 'Icono de viaje (dejar en blanco para no hacer cambios)',
	'mytrips:name' => 'Nombre del viaje',
	'mytrips:username' => 'Nombre corto del viaje (como se muestra en la URL, solo caracteres alfanuméricos)',
	'mytrips:description' => 'Descripción completa',
	'mytrips:briefdescription' => 'Breve descripción',
	'mytrips:interests' => 'Etiquetas',
	'mytrips:website' => 'Sitio Web',
	'mytrips:members' => 'Participantes del viaje',
	'mytrips:my_status' => 'Mi estado',
	'mytrips:my_status:trip_owner' => 'Eres el promotor de este viaje',
	'mytrips:my_status:trip_member' => 'Usted participa en este viaje',
	'mytrips:my_status:trip_PreOrder' => 'Usted ha realizado una pre-reserva en éste viaje',
	'mytrips:my_status:trip_Confirmed' => 'Usted ha confirmado su reserva para éste viaje',	
	'mytrips:subscribed' => 'Habilitar notificaciones',
	'mytrips:unsubscribed' => 'Deshabilitar notificaciones',

	'mytrips:members:title' => 'Participantes de %s',
	'mytrips:members:more' => "Ver todos los participantes",
	'mytrips:membership' => "Ver los permisos de los participantes",
	'mytrips:content_access_mode' => "Accesabilidad del contenido del viaje",
	'mytrips:content_access_mode:warning' => "Advertencia: Cambiar esta preferencia no cambiara los permisos de acceso al contenido existente en el viaje.",
	'mytrips:content_access_mode:unrestricted' => "Sin restringir &mdash; el acceso depende de la configuración individual de cada contenido.",
	'mytrips:content_access_mode:membersonly' => "Solo participantes - Los que no son participantes no podrán ver el contenido del viaje",
	'mytrips:access' => "Permisos de acceso",
	'mytrips:owner' => "Conductor",
	'mytrips:owner:warning' => "Advertencia: si cambia este valor, usted ya no será el promotor de este viaje.",
	'mytrips:widget:num_display' => 'N&uacute;mero de participantes a mostrar',
	'mytrips:widget:membership' => 'Mis Viajes',
	'mytrips:widgets:description' => 'Muestra los viajes en los que te interesaste',

	'mytrips:widget:trip_activity:title' => 'Actividad del viaje',
	'mytrips:widget:trip_activity:description' => 'Ver la actividad en uno de tus viajes',
	'mytrips:widget:trip_activity:edit:select' => 'Selecciona un viaje',
	'mytrips:widget:trip_activity:content:noactivity' => 'No hay actividad en este viaje',
	'mytrips:widget:trip_activity:content:noselect' => 'Editar este widget para seleccionar un viaje',

	'mytrips:noaccess' => 'No hay acceso al viaje',
	'mytrips:permissions:error' => 'No tienes permisos para esto',
	'mytrips:intrip' => 'en el viaje',
	'mytrips:cantcreate' => 'No se puede crear un viaje. Sólo los administradores pueden.',
	'mytrips:cantedit' => 'No puedes editar este viaje',
	'mytrips:saved' => 'Viaje guardado',
	'mytrips:featured' => 'Viajes destacados',
	'mytrips:makeunfeatured' => 'No destacar',
	'mytrips:makefeatured' => 'Destacar',
	'mytrips:featuredon' => '%s es ahora un viaje destacado.',
	'mytrips:unfeatured' => '%s se ha eliminado de los viajes destacados.',
	'mytrips:featured_error' => 'Viaje no válido.',
	'mytrips:nofeatured' => 'Sin viajes destacados.',
	'mytrips:joinrequest' => 'Solicitar unirse',
	'mytrips:join' => 'Me interesa el viaje',
	'mytrips:leave' => 'No me interesa el viaje',
	'mytrips:invite' => 'Invitar',
	'mytrips:invite:title' => 'Invitar a este viaje',
	'mytrips:inviteto' => "Invitar seguidores a '%s'",
	'mytrips:nofriends' => "No hay seguidores que no hayan sido invitados al viaje.",
	'mytrips:nofriendsatall' => 'No hay seguidores para invitar',
	'mytrips:viamytrips' => "via viajes",
	'mytrips:trip' => "Viaje",
	'mytrips:search:tags' => "etiqueta",
	'mytrips:search:title' => "Búsqueda de viajes etiquetados con  '%s'",
	'mytrips:search:none' => "No se encontraron viajes que coincidan",
	'mytrips:search_in_trip' => "Buscar en este viaje",
	'mytrips:acl' => "Viaje: '%s'",
	'mytrips:seleccionar' => "Seleccionar",
	'discussion:topic:notify:summary' => 'Nuevo tema de discusión llamado %s',
	'discussion:topic:notify:subject' => 'Nuevo tema de discusión: %s',
	'discussion:topic:notify:body' =>
'%s ha agregado un nuevo tema al viaje %s:

Título: %s

%s

Ver y responder:
%s
',

	'discussion:reply:notify:summary' => 'Nueva respuesta en tema: %s',
	'discussion:reply:notify:subject' => 'Nueva respuesta en tema: %s',
	'discussion:reply:notify:body' =>
'%s ha respondido al tema %s en el viaje %s:

%s

Ver y comentar:
%s
',

	'mytrips:activity' => "Actividad del viaje",
	'mytrips:enableactivity' => 'Habilitar las actividades del viaje',
	'mytrips:activity:none' => "El viaje no ha tenido actividades a&uacute;n",

	'mytrips:notfound' => "No se encontró el viaje",
	'mytrips:notfound:details' => "El viaje solicitado no existe o no tienes permiso para verlo",

	'mytrips:requests:none' => 'No hay solicitudes de inclusión.',

	'mytrips:invitations:none' => 'Actualmente no hay avisos.',

	'item:object:tripforumtopic' => "Acuerdos del viaje",
	'item:object:discussion_reply' => "Respuestas de la discusión",

	'tripforumtopic:new' => "A&ntilde;adir un tema de discusión",

	'mytrips:count' => "Viaje creados",
	'mytrips:open' => "viaje abierto",
	'mytrips:closed' => "viaje cerrado",
	'mytrips:member' => "Participantes",
	'mytrips:searchtag' => "Buscar viajes por etiqueta",

	'mytrips:more' => 'M&aacute;s viajes',
	'mytrips:none' => 'No hay viajes',

	/**
	 * Access
	 */
	'mytrips:access:private' => 'Cerrado &mdash; los participantes deben ser invitados',
	'mytrips:access:public' => 'Abierto &mdash; cualquiera puede unirse',
	'mytrips:access:trip' => 'Sólo participantes del viaje',
	'mytrips:closedtrip' => "La inclusión a este viaje esta cerrada.",
	'mytrips:closedtrip:request' => 'Para pedir ser agregado, de click sobre el link "Pedir inclusión".',
	'mytrips:closedtrip:membersonly' => "La inclusión a este viaje es cerrada y su contenido solo puede ser accesible a los participantes.",
	'mytrips:opentrip:membersonly' => "El contenido de este viaje solo es accesible a los participantes.",
	'mytrips:opentrip:membersonly:join' => 'Para ser participante pulse el botón "Me interesa el viaje".',
	'mytrips:visibility' => '&iquest;Quienes pueden ver este viaje?',

	/**
	 * trip tools
	 */
	'mytrips:enableforum' => 'Habilitar discusión de los viajes',
	'mytrips:lastupdated' => '&Uacute;ltimas actualizaciones de %s por %s',
	'mytrips:lastcomment' => '&Uacute;ltimos de %s por %s',

	
	'admin:mytrips' => 'Viaje',

	'trip:replies' => 'Respuestas',
	'mytrips:forum:created' => 'Creado %s con %d comentarios',
	'mytrips:forum:created:single' => 'creado %s con %d respuestas',
	'mytrips:forum' => 'Acuerdos',
	'mytrips:addtopic' => 'Agregar un tema',
	'mytrips:forumlatest' => 'Último acuerdo',
	'mytrips:latestdiscussion' => 'Últimos acuerdos',
	'mytripspost:success' => 'Tu respuesta ha sido publicada',
	'mytripspost:failure' => 'Hubo un problema al publicar tu respuesta',
	'mytrips:alldiscussion' => 'Acuerdos más reciente',
	'mytrips:edittopic' => 'Editar tema',
	'mytrips:topicmessage' => 'Mensaje del tema',
	'mytrips:topicstatus' => 'Estado del tema',
	'mytrips:reply' => 'Publicar un comentario',
	'mytrips:topic' => 'Tema',
	'mytrips:posts' => 'Publicaciones',
	'mytrips:lastperson' => 'Último usuario',
	'mytrips:when' => 'Cuando',
	'triptopic:notcreated' => 'No hay temas creados.',
	'mytrips:topicclosed' => 'Cerrado',
	'triptopic:created' => 'Tu tema ha sido creado.',
	'mytrips:topicsticky' => 'Sticky',
	'mytrips:topicisclosed' => 'Este foro sobre acuerdos está cerrado.',
	'mytrips:topiccloseddesc' => 'Este tema est&aacute; cerrado y no acepta nuevas respuestas.',
	'triptopic:error' => 'El viaje no pudo ser creado. Por favor intenta de nuevo o contacta con el administrador.',
	'mytrips:forumpost:edited' => "Has editado la entrada exitosamente.",
	'mytrips:forumpost:error' => "Hubo un problema al editar la entrada.",

	'mytrips:privatetrip' => 'Este es un viaje cerrado. Debes solicitar inclusión.',
	'mytrips:notitle' => 'El viaje debe tener un t&iacute;tulo',
	'mytrips:cantjoin' => 'No se puede unir al viaje',
	'mytrips:cantleave' => 'No se pudo abandonar el viaje',
	'mytrips:removeuser' => 'Eliminar del viaje',
	'mytrips:cantremove' => 'No se puede dar de baja a este usuario del viaje',
	'mytrips:removed' => 'El usuario %s ha sido eliminado del viaje',
	'mytrips:addedtotrip' => 'El usuario ha sido agregado con éxito',
	'mytrips:joinrequestnotmade' => 'No se pudo enviar la solicitud de inclusión del viaje',
	'mytrips:joinrequestmade' => 'Solicitar unirse al viaje',
	'mytrips:joined' => 'Te has unido al viaje',
	'mytrips:left' => 'Has abandonado el viaje',
	'mytrips:notowner' => 'No eres el promotor del viaje.',
	'mytrips:notmember' => 'No eres seguidor de este viaje.',
	'mytrips:alreadymember' => 'Ya eres seguidor de este viaje',
	'mytrips:userinvited' => 'El usuario ha sido invitado.',
	'mytrips:usernotinvited' => 'El usuario no pudo ser invitado.',
	'mytrips:useralreadyinvited' => 'El usuario ya ha sido invitado',
	'mytrips:invite:subject' => "%s te ha invitado al viaje %s",
	'mytrips:updated' => "&Uacute;ltima respuesta en %s de %s",
	'mytrips:started' => "Iniciado por %s",
	'mytrips:joinrequest:remove:check' => '¿Seguro que deseas cancelar la solicitud de inclusión?',
	'mytrips:invite:remove:check' => '¿Seguro que deseas anular esta invitación?',
	'mytrips:invite:body' => "Hola %s,

%s te ha invitado para que te unas al viaje '%s'. Haz click en el siguiente enlace para unirte:

%s",

	'mytrips:welcome:subject' => "Bienvenido al viaje %s",
	'mytrips:welcome:body' => "Hola %s!

Ahora eres seguidor de '%s'. Haz click en el siguiente enlace para empezar a postear:

%s",

	'mytrips:request:subject' => "%s ha solicitado unirse a %s",
	'mytrips:request:body' => "Hola %s,

%s ha solicitado unirse al viaje '%s'. Click en el siguiente enlace para ver el perfil:

%s

O click a continuación para ver las solicitudes de inclusión del viaje:

%s",

	/**
	 * Forum river items
	 */

	'river:create:trip:default' => '%s ha creado el viaje %s',
	'river:join:trip:default' => '%s se ha unido al viaje %s',
	'river:create:object:tripforumtopic' => '%s abrió el tema %s',
	'river:reply:object:tripforumtopic' => '%s ha respondido en el tema %s',
	'river:reply:view' => 'Ver la respuesta',

	'mytrips:nowidgets' => 'No se han definido widgets para el viaje.',


	'mytrips:widgets:members:title' => 'Participantes del viaje',
	'mytrips:widgets:members:description' => 'Listar los participantes del viaje.',
	'mytrips:widgets:members:label:displaynum' => 'Listar los participantes de un viaje.',
	'mytrips:widgets:members:label:pleaseedit' => 'Por favor configura este widget.',

	'mytrips:widgets:entities:title' => "Objetos en el viaje",
	'mytrips:widgets:entities:description' => "Lista de objetos guardados en este viaje",
	'mytrips:widgets:entities:label:displaynum' => 'Lista de objetos de este viaje.',
	'mytrips:widgets:entities:label:pleaseedit' => 'Por favor configura este widget.',

	'mytrips:forumtopic:edited' => 'Tema de discusión guaddado con éxito.',

	'mytrips:allowhiddenmytrips' => '&iquest;Desea habilitar los viajes privados?',
	'mytrips:whocancreate' => '¿Quién puede editar este viaje?',

	/**
	 * Action messages
	 */
	'trip:deleted' => 'Viaje y contenidos borrados',
	'trip:notdeleted' => 'El viaje no pudo ser borrado',

	'trip:notfound' => 'No se pudo encontrar el Viaje',
	'trippost:deleted' => 'Publicación del viaje borrada con éxito',
	'trippost:notdeleted' => 'La publicación del viaje no se pudo borrar',
	'mytripstopic:deleted' => 'Tema eliminado',
	'mytripstopic:notdeleted' => 'No se pudo borrar el tema',
	'triptopic:blank' => 'No hay temas',
	'triptopic:notfound' => 'No se ha podido encontrar el tema solicitado',
	'trippost:nopost' => 'Entrada vacía',
	'mytrips:deletewarning' => "&iquest;Seguro que deseas borrar este viaje? No se puede deshacer",

	'mytrips:invitekilled' => 'El invitado ha sido eliminado.',
	'mytrips:joinrequestkilled' => 'La solicitud ha sido borrada.',
	'mytrips:error:addedtotrip' => "No ha sido posible añadir a %s al viaje.",
	'mytrips:add:alreadymember' => "%s ya forma parte del viaje.",

	/**
	 * ecml
	 */
	'mytrips:ecml:discussion' => 'Discusión de los viajes',
	'mytrips:ecml:tripprofile' => 'Perfiles de los viajes',

	//Photos
	'photos:trip' => 'Fotos del viaje',
	

	/**
	 * custom fields
	 */


	'mytrips:origen' => 'Punto de partida',
	'mytrips:destino' => 'Punto de llegada',
	'mytrips:trayecto' => 'Tipo de viaje',
	'mytrips:fechaIda' => 'Salida',
	'mytrips:fechaVuelta' => 'Regreso',
	'mytrips:llegadaIda' => 'Llegada al destino',
	'mytrips:llegadaVuelta' => 'Legada al punto de partida',
	'mytrips:flexible' => 'Las fechas son flexibles',	
	'mytrips:gender' => 'Seguridad para mujeres',
	'mytrips:nplazas' => 'Plazas ofertadas',	
	'mytrips:aportacionViajero' => 'Aportación por viajero',	
	'mytrips:distancia'=>'Distancia estimada del trayecto',
	'mytrips:tiempo'=>'Tiempo estimado',
	'mytrips:precio'=>'Precio estimado',
	'mytrips:showMap'=>'Ver / ocultar mapa',
	'trip:nplazasWrong'=>'Valor no permitido. Debe indicar un valor que no supere los asientos de su vehículo',
	'mytrips:aportacionViajero' => 'Aportación por viajero',	
	'mytrips:nplazas' => 'Plazas ofertadas',	
	'mytrips:distancia'=>'Distancia estimada del trayecto',
	'mytrips:tiempo'=>'Tiempo estimado',
	'mytrips:precio'=>'Precio estimado',
	'mytrips:showMap'=>'Ver / ocultar mapa',
	'mytrips:preReservar'=>'Pre-reservar',
	'mytrips:confirm'=>'Confirmar Pre-Reserva',
	'mytrips:unPreorder'=>'Cancelar Pre-Reserva',
	'mytrips:PreOrderCorrect'=>'Reservado Correctamente',
	'mytrips:unPreOrderCorrect'=>'Cancelada la reserva correctamente',
	'mytrips:confirmTrip'=>'Confirmar Reserva',
	'mytrips:unconfirmTrip'=>'Cancelar Reserva',
	'mytrips:cantPreorderSeatMax'=>'No puedes reservar porque no hay asientos disponibles en éste viaje',
	'mytrips:seatsAvaible'=>'Asientos disponibles',

	'trip:nplazasNoDato' => 'Es obligatorio introducir el número de plazas que ofertas',
	'trip:overbooking' => 'Has superado el límite de plazas de tu coche',

	//gestion de reservas
	'mytrips:manageOrders' => 'Gestionar Reservas',
	'mytrips:manageOrders:title' => 'Gestión de Reservas',
	'mytrips:manageOrders:save' => 'Guardar',
	'mytrips:manageOrders:saved' => 'Reservas guardadas correctamente',
	'mytrips:manageOrders:confirmar' => 'Confirmar',
	'mytrips:manageOrders:desconfirmar' => 'Cancelar',
	'mytrips:manageOrders:confirmadoOk' => 'Confirmado correctamente',
	'mytrips:manageOrders:confirmadoKo' => 'Hubo algún error en la confirmación',
	'mytrips:manageOrders:desconfirmadoOk' => 'Desconfirmado correctamente',
	'mytrips:manageOrders:desconfirmadoKo' => 'Hubo algún error en la desconfirmación',
	'mytrips:preorder' => 'Pre-reservar',

	//Mails internos de gestión de reservas
	'mytrips:manageOrders:preorderOk:subjet' => 'PRE-RESERVA DEL VIAJE %s',
	'mytrips:manageOrders:preorderOk:Yo'=>'El usuario %s ha hecho una pre-reserva de plaza. <br />
	Modalidad: %s<br />
	Aportación mínima: %s<br/ >
	Usted ahora debe gestionar esta solicitud accediendo a su viaje %s para confirmarla o cancelarla.
		<br />
		Atentamente, <br />
			El equipo de Teranga Go!',
	'mytrips:manageOrders:preorderOk:YoMaleta'=>'El usuario %s ha hecho una pre-reserva de plaza y paquetería. <br />
	Modalidad: %s<br />
	Aportación mínima: %s<br/ >
	Nº Bultos: %s<br>
	Usted ahora debe gestionar esta solicitud accediendo a su viaje %s para confirmarla o cancelarla.
		<br />
		Atentamente, <br />
			El equipo de Teranga Go!',
	'mytrips:manageOrders:preorderOk:Maleta'=>'El usuario %s ha hecho una pre-reserva de paquetería. <br />
	Aportación mínima: %s<br/ >
	Nº Bultos: %s<br />
	Usted ahora debe gestionar esta solicitud accediendo a su viaje %s para confirmarla o cancelarla.
		<br />
		Atentamente, <br />
			El equipo de Teranga Go!',
	'mytrips:manageOrders:preorderOk:msgViajero:Yo'=>'Has hecho una pre-reserva de plaza en el viaje %s. <br />
	Modalidad: %s<br />
	Aportación mínima: %s<br/ >
		<br />
		Atentamente, <br />
			El equipo de Teranga Go!',
	'mytrips:manageOrders:preorderOk:msgViajero:YoMaleta'=>'Has hecho una pre-reserva de plaza y paquetería en el viaje %s. <br />
	Modalidad: %s<br />
	Aportación mínima: %s<br/ >
	Nº Bultos: %s<br>
		<br />
		Atentamente, <br />
			El equipo de Teranga Go!',
	'mytrips:manageOrders:preorderOk:msgViajero:Maleta'=>'Has hecho una pre-reserva de paquetería en el viaje %s. <br />
	Aportación mínima: %s<br/ >
	Nº Bultos: %s<br />
		<br />
		Atentamente, <br />
			El equipo de Teranga Go!',		
	'mytrips:manageOrders:confirmadoOk:subjet' => 'RESERVA DEL VIAJE %s',
	'mytrips:manageOrders:confirmadoOk:message'=>'
	El usuario promotor del viaje <strong>%s</strong> ha aceptado su reserva de plaza para el viaje %s en modalidad de trayecto %s, y por el que se compromete a pagarle la cantidad de %s en su defecto u otra cantidad que haya sido acordada previa a la realización del viaje.<br />
	Ustedes ahora viajarán juntos atendiendo a los %s que hayan establecido en este viaje. 	
		<br />
		Atentamente, <br />
			El equipo de Teranga Go!',

	'mytrips:manageOrders:desconfirmadoOk:subjet' => 'RESERVA CANCELADA DEL VIAJE %s',
	'mytrips:manageOrders:desconfirmadoOk:message' => 'El usuario ha cancelado su reserva de plaza en el viaje. <br />
	Usted ahora puede gestionar otras pre-reservas de su viaje o modificar los datos de su viaje (fechas o numero de plazas ofertadas) y seguir atendiendo los %s que haya establecido en éste viaje. 
		<br />
		Atentamente, <br />
			El equipo de Teranga Go!',

	'mytrips:manageOrders:ConductorDesconfirmaOk:subjet' => 'RESERVA DENEGADA DEL VIAJE %s',
	'mytrips:manageOrders:ConductorDesconfirmaOk:message' => 'El promotor %s no ha aceptado su petición de reserva de plaza en el viaje %s. Revise los %s. <br />
		<br />
		Atentamente, <br />
			El equipo de Teranga Go!',


	//Acuerdos de viaje (foros)
	'mytrips:discussion:title1' => 'Puntos de recogida',
	'mytrips:discussion:description1' => 'Espacio para acordar con los pasajeros los lugares de recogida de ida y vuelta.',
	'mytrips:discussion:title2' => 'Descansos y paradas durante el viaje',
	'mytrips:discussion:description2' => 'Espacio para comentar la frecuencia de descansos y lugares de parada a realizar durante el viaje.',
	'mytrips:discussion:title3' => 'Paquetería',
	'mytrips:discussion:description3' => 'Acuerdos sobre el envío de paquetería, lugar de distribución, responsable, etc.',

	//Trip planning sidebar
	'mytrips:follower' => 'Interesados en el viaje',
	'mytrips:preorders' => 'Viajeros que han prereservado',
	'mytrips:confirmed' => 'Viajeros han confirmado su reserva',

	//Paqueteria =======================
	'mytrips:servicioPaqueteria' => 'Paquetería',	
	'mytrips:tamaMaletero' => 'Capacidad del maletero',	
	'mytrips:tipoBultos' => 'Tipo de bultos',	
	'mytrips:nbultos' => 'Máximo número de bultos permitidos',	
	'mytrips:bultosDisponibles'=>'Bultos disponibles',
	
	//summaryPreOrder==============
	'mytrips:summaryPreOrder:title'=> 'Reserva de viaje o paquetería',
	'mytrips:summaryOrder'=> 'Resumen de Pre-Reserva',
	'mytrips:summaryPreOrder:ViajoYO'=>'Ocupo un asiento',
	'mytrips:summaryPreOrder:ViajoYOBulto'=>'Ocupo un asiento y envío paquetería',
	'mytrips:summaryPreOrder:ViajaBulto'=>'No viajo, paquetería solamente',
	'mytrips:summaryPreOrder:Elijo'=>'Seleccione',
	'mytrips:summaryPreOrder:ElijoViajar'=>'Elijo Viajar',
	'mytrips:summaryPreOrder:numBultos'=>'Num. Bultos',
	'mytrips:summaryPreOrder:numBultos:Wrong'=>'Número de bultos erróneo.',
	'mytrips:summaryPreOrder:justPreorder'=>'Ya estabas insrito en el viaje'
);
	

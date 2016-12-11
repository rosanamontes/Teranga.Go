<?php

/**
 * French strings
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
	'custom:mytrips' => "Derniers voyages",

	/**
	 * Menu items and titles Teranga Go 
	 */
	'mytrips' => "Voyages",
	'mytrips:owned' => "Voyage déjà réalisée",
	'mytrips:owned:user' => "Voyage de l'utilisateur %s",
	'mytrips:yours' => "Mes voyages",
	'mytrips:user' => "Voyage de l'utilisateur (% S)",
	'mytrips:all' => "Tous les voyages",
	'mytrips:add' => "Créer un nouveau voyage",
	'mytrips:edit' => "Éditer un voyage",
	'mytrips:delete' => "Annuler un voyage",
	'mytrips:membershiprequests' => "Gérer les intentions de voyages",
	'mytrips:membershiprequests:pending' => "Gérer des demandes d'intérêt (%s)",
	'mytrips:invitations' => "Invitations a un voyage",
	'mytrips:invitations:pending' => "Invitation a (%s)",

	'mytrips:icon' => "Icone du voyage (laisser en blanc pour ne pas opérer des changements)",
	'mytrips:name' => "Dénomination du voyage",
	'mytrips:username' => "Nom abbrégé du voyage(comment l'écrire dans l'url, caractères alphanumériques uniquement)",
	'mytrips:description' => "description complète",
	'mytrips:briefdescription' => "brève description",
	'mytrips:interests' => "étiquettes",
	'mytrips:website' => "Site web",
	'mytrips:members' => "participants au voyages",
	'mytrips:my_status' => "mon statut",
	'mytrips:my_status:trip_owner' => "tu es propriétaire de ce voyage",
	'mytrips:my_status:trip_member' => "vous participez à ce voyage",
	'mytrips:my_status:trip_PreOrder' => "vous avez fait une pré-réservation pour ce voyage",
	'mytrips:my_status:trip_Confirmed' => "vous avez confirmé votre réservation pour ce voyage",	
	'mytrips:subscribed' => "autoriser des notifications",
	'mytrips:unsubscribed' => "ne plus autoriser des notifications",

	'mytrips:members:title' => "participants du %s",
	'mytrips:members:more' => "voir tous les abonnés ",
	'mytrips:membership' => "voir les autorisations des abonnés ",
	'mytrips:content_access_mode' => "accessibilité du contenu du voyage",
	'mytrips:content_access_mode:warning' => "avertissement: changer ce choix ne modifiera pas les autorisations d'accès au voyage",
	'mytrips:content_access_mode:unrestricted' => "sans restriction l'acès dépend de la configuration spécifique de chaque contenu",
	'mytrips:content_access_mode:membersonly' => "pour Les abonnés seulement.Les non abonnés ne pourront pas accéder au contenu",
	'mytrips:access' => "autorisation d'accès",
	'mytrips:owner' => "conducteur",
	'mytrips:owner:warning' => "si vous modifiez cette valeur, vous serez le propriétaire de ce voyage",
	'mytrips:widget:num_display' => "nombre d'abonnés à montrer",
	'mytrips:widget:membership' => "Mes voyages",
	'mytrips:widgets:description' => "montrer les voyages auxquels vous êtes abonné",

	'mytrips:widget:trip_activity:title' => "activité lors du voyage",
	'mytrips:widget:trip_activity:description' => "voir les activités menées lors d'un de vos voyages",
	'mytrips:widget:trip_activity:edit:select' => "sélectionner un voyage",
	'mytrips:widget:trip_activity:content:noactivity' => "il n'y a pas d'activité lors de ce voyage",
	'mytrips:widget:trip_activity:content:noselect' => "éditer ce widget pour sélectionner un voyage",

	'mytrips:noaccess' => "Pas d'accès au voyage",
	'mytrips:permissions:error' => "vous n'êtes pas autorisé à faire ce voyage",
	'mytrips:intrip' => "Lors du voyage",
	'mytrips:cantcreate' => "vous ne pouvez pas créer de voyage, seuls les administrateurs le peuvent",
	'mytrips:cantedit' => "vous ne pouvez pas éditer ce voyage",
	'mytrips:saved' => "voyage réservé",
	'mytrips:featured' => "voyages en vedette",
	'mytrips:makeunfeatured' => "ne pas mettre en vedette",
	'mytrips:makefeatured' => "mettre en vedette",
	'mytrips:featuredon' => "%s est devenu un voyage en vedette",
	'mytrips:unfeatured' => "%s retiré de la liste des voyages mis en vedette",
	'mytrips:featured_error' => "voyage non valide",
	'mytrips:nofeatured' => "pas de voyages en vedette",
	'mytrips:joinrequest' => "soliciter une adhésion",
	'mytrips:join' => "participer à un voyage",
	'mytrips:leave' => "renoncer au voyage",
	'mytrips:invite' => "Inviter",
	'mytrips:invite:title' => "inviter des amis pour ce voyage",
	'mytrips:inviteto' => "inviter des amis à (% s)",
	'mytrips:nofriends' => "pas d'amis invités pour ce voyage",
	'mytrips:nofriendsatall' => "pas d'amis à inviter",
	'mytrips:viamytrips' => "itinéraire du voyage",
	'mytrips:trip' => "Voyage",
	'mytrips:search:tags' => "etiquette",
	'mytrips:search:title' => "recherche de voyages avec étiquettes (%s)",
	'mytrips:search:none' => "aucun voyage ne correspond",
	'mytrips:search_in_trip' => "chercher dans ce voyage",
	'mytrips:acl' => "Voyage: (%s)",
	'mytrips:seleccionar' => "Sélectionner",
	'discussion:topic:notify:summary' => "nouveau thème de discussion ajouté %s",
	'discussion:topic:notify:subject' => "nouveau thème de discussion: %s",
	'discussion:topic:notify:body' => "nouveau thème de discussion (% s)
'vous avez ajouté un nouveau thème au voyage (% s): (% s), 

Titre: %s

%s

Voir et commenter:
%s
",

	'discussion:reply:notify:summary' => "nouvelle réponse pour le thème (% s)",
	'discussion:reply:notify:subject' => "nouvelle réponse pour le thème (% s)",
	'discussion:reply:notify:body' => "
(% s) vous avez répondu au thème(% s)lors du voyage (% s): (% s) 

Voir et commenter:%s",

	'mytrips:activity' => "activité lors du voyage",
	'mytrips:enableactivity' => "autoriser les activités lors du voyage",
	'mytrips:activity:none' => "il n'y a pas eu d'activités lors du voyage",

	'mytrips:notfound' => "Le voyage n'a pas été trouvé",
	'mytrips:notfound:details' => "Le voyage recherché n'est pas autorisé ou il n'ya pas d'autorisation pour le voir",

	'mytrips:requests:none' => "il n'y a pas de demande d'adhésion",

	'mytrips:invitations:none' => "il n'y a pas d'invitation pour le moment.",

	'item:object:tripforumtopic' => "Les arrangements de voyage",
	'item:object:discussion_reply' => "réponses de la discussion",

	'tripforumtopic:new' => "ajouter un arrangement de voyage",

	'mytrips:count' => "Voyages créés",
	'mytrips:open' => "voyage ouvert",
	'mytrips:closed' => "voyage fermé",
	'mytrips:member' => "affiliés",
	'mytrips:searchtag' => "chercher des voyages par étiquettes",

	'mytrips:more' => "plus de voyages",
	'mytrips:none' => "il n'y a pas de voyages",

	/**
	 * Access
	 */
	'mytrips:access:private' => "fermé &mdash; les abonnés doivent être invités",
	'mytrips:access:public' => "ouvert mdash; tout le monde peut adérer",
	'mytrips:access:trip' => "uniquement les abonnés au voyage",
	'mytrips:closedtrip' => "L'adhésion à ce voyage est clôturée",
	'mytrips:closedtrip:request' => "pour demander une adhésion, cliquer sur le lien demander une adhésion",
	'mytrips:closedtrip:membersonly' => "L'adhésion à ce voyage es clôturée, son contenu n'est accessible qu'aux abonnés",
	'mytrips:opentrip:membersonly' => "Le contenu de ce voyage n'est accessible qu'aux abonnés",
	'mytrips:opentrip:membersonly:join' => "pour être abonné cliquer sur le lien s'associer au voyage",
	'mytrips:visibility' => "iquest: qui peut voir ce voyage?",

	/**
	 * trip tools
	 */
	'mytrips:enableforum' => "autoriser les commentaires sur les voyages",
	'mytrips:lastupdated' => "dernières actualisations de  (% s) à  (% s) ",
	'mytrips:lastcomment' => "dernières de (% s) à (% s) ",

	/**
	 * trip discussion
	 */
	'discussion' => "Accord",
	'discussion:add' => "Ajouter un thème de accord",
	'discussion:latest' => "Derniers accords",
	'discussion:trip' => "Accords du voyage",
	'discussion:none' => "Il n' y a pas de accords",
	'discussion:reply:title' => "Réponses de  (% s) 
",

	'discussion:topic:created' => "Le thème de discussion a été créé",
	'discussion:topic:updated' => "Le thème de discussion a été actualisé",
	'discussion:topic:deleted' => "Le thème de discussion a été annulé",

	'discussion:topic:notfound' => "Le tème à discuter recherché n'a pas été trouvé",
	'discussion:error:notsaved' => "Le thème à discuter ne peut être conservé",
	'discussion:error:missing' => "Le titre et le corps du message sont obligatoires",
	'discussion:error:permissions' => "Tu n'es pas autorisé à effectuer cette action",
	'discussion:error:notdeleted' => "Le thème à discuter n'a pas pu être supprimé ",

	'discussion:reply:edit' => "éditer une réponse",
	'discussion:reply:deleted' => "La réponse a été a annulée",
	'discussion:reply:error:notfound' => "La réponse au thème à discuter n'a pas été trouvée",
	'discussion:reply:error:notfound_fallback' => "désolés la réponse recherhée n'a pu être trouvée, nous ous avons de accords originel",
	'discussion:reply:error:notdeleted' => "La réponse n'a pas pu être annulée",

	'discussion:search:title' => "répondre par thème  (% s) ",
	
	'admin:mytrips' => "Voyage",

	'reply:this' => "répondre à ceci",

	'trip:replies' => "Réponses",
	'mytrips:forum:created' => "créé  (% s) avec  (% s) de réponses",
	'mytrips:forum:created:single' => "créé  (% s) avec  (% s) de réponses",
	'mytrips:forum' => "discussion",
	'mytrips:addtopic' => "ajouter un thème ",
	'mytrips:forumlatest' => "derniers accords",
	'mytrips:latestdiscussion' => "derniers accords",
	'mytripspost:success' => "ta réponse a été publiée",
	'mytripspost:failure' => "difficultés lors de la publication de ta réponse",
	'mytrips:alldiscussion' => "discussion la plus récente",
	'mytrips:edittopic' => "éditer un thème",
	'mytrips:topicmessage' => "message du thème",
	'mytrips:topicstatus' => "éditer un thème",
	'mytrips:reply' => "publier un commentaire",
	'mytrips:topic' => "Thème",
	'mytrips:posts' => "Publications",
	'mytrips:lastperson' => "dernier utilisateur",
	'mytrips:when' => "quand",
	'triptopic:notcreated' => "pas de thèmes créés",
	'mytrips:topicclosed' => "clôturé",
	'triptopic:created' => "ton thème a été créé",
	'mytrips:topicsticky' => "Sticky",
	'mytrips:topicisclosed' => "ce forum sur les accords est clos",
	'mytrips:topiccloseddesc' => "ce thème est clos et ne reçoit plus de nouvelles réponses",
	'triptopic:error' => "Le voyage n'a pa pu être créé. Merci de réessayer ou de recontacter l'administrateur",
	'mytrips:forumpost:edited' => "tu as édité l'entrée avec succès",
	'mytrips:forumpost:error' => "un problème est survenu lors de l'édition de l'entrée",

	'mytrips:privatetrip' => "ceci et un voyage clôturé, vous devez demander une adhésion",
	'mytrips:notitle' => "Le voyage doit avoir un sous-titre",
	'mytrips:cantjoin' => "vous ne pouvez plus participer au voyage",
	'mytrips:cantleave' => "vous ne pouvez plus renoncer au voyage",
	'mytrips:removeuser' => "renoncer au voyage",
	'mytrips:cantremove' => "cet utilisateur ne peut être exclu",
	'mytrips:removed' => "L'utilisateur a été retiré avec succès",
	'mytrips:addedtotrip' => "L'utilisateur a été intégré avec succès",
	'mytrips:joinrequestnotmade' => "La demande d'adhésion n'a pas pu être envoyée",
	'mytrips:joinrequestmade' => " participer à un voyage",
	'mytrips:joined' => "tu t'es inscrit à ce voyage",
	'mytrips:left' => "tu as renoncé au voyage",
	'mytrips:notowner' => "tu n'es pas propriétaire de ce voyage",
	'mytrips:notmember' => "tu n'es pas un abonné de ce voyage",
	'mytrips:alreadymember' => "tu es déjà abonné à ce voyage",
	'mytrips:userinvited' => "L'utilisateur a été invité",
	'mytrips:usernotinvited' => "L'utilisateur n'a pas pu être invité",
	'mytrips:useralreadyinvited' => "L'utiisateur a déjà été invité",
	'mytrips:invite:subject' => " (% s) s t'a invité au voyage  (% s) ",
	'mytrips:updated' => "dernier réponses en  (% s)  de  (% s)  ",
	'mytrips:started' => "débuté/e/s par",
	'mytrips:joinrequest:remove:check' => "es-tu sur de annuler la demande d'inclusion?",
	'mytrips:invite:remove:check' => "es-tu sur de annuler cette invitation?",
	'mytrips:invite:body' => "bonjour (% s) ,

(% s) T'a invité à te joindre au voyage (% s) cliquez sur ce lien pour adhérer % s",

	'mytrips:welcome:subject' => "bienvenue au voyage (% s) ",
	'mytrips:welcome:body' => "bonjour  %s!

tu es pas un abonné de ce voyage
'%s'.Clique dans le lien suivant pour commencer à poster:

%s",

	'mytrips:request:subject' => "%s a souhait se joindre ton tripe %s",
	'mytrips:request:body' => "bonjour %s,

%s a souhait se joindre au voyage'%s'. Click dans le lien suivant pour voir le profil:

%s

clique ensuite pour voir les demandes d'inclusion au voyage:

%s",

	/**
	 * Forum river items
	 */

	'river:create:trip:default' => "%s a créé le voyage %s",
	'river:join:trip:default' => "%s s'est jointe au voyage %s",
	'river:create:object:tripforumtopic' => "%s a ouvert le th?e %s",
	'river:reply:object:tripforumtopic' => "%s a répondu au th?e %s",
	'river:reply:view' => "Voir la réponse",

	'mytrips:nowidgets' => "des widgets n'ont pas été définis pour le voyage.",


	'mytrips:widgets:members:title' => "Des participants au voyage",
	'mytrips:widgets:members:description' => "Enregistrer les membres au voyage",
	'mytrips:widgets:members:label:displaynum' => "Enregistrer les membres d'un voyage",
	'mytrips:widgets:members:label:pleaseedit' => "S'il te plaît configure ce widget.",

	'mytrips:widgets:entities:title' => "Des objets dans le voyage",
	'mytrips:widgets:entities:description' => "Une liste d'objets gardés dans ce voyage",
	'mytrips:widgets:entities:label:displaynum' => "Une liste d'objets de ce voyage.",
	'mytrips:widgets:entities:label:pleaseedit' => "S'il te plaît configure ce widget.",

	'mytrips:forumtopic:edited' => "sujet de discussion gardé avec succès.",

	'mytrips:allowhiddenmytrips' => "&iquest;Désirez-vous autoriser les voyages privés?",
	'mytrips:whocancreate' => "Qui est-ce qui peut éditer ce voyage?",

	/**
	 * Action messages
	 */
	'trip:deleted' => " voyage et contenus effacés",
	'trip:notdeleted' => "Le voyage n'a pas pu être supprimé",

	'trip:notfound' => "On n'a pas pu trouver le Voyage",
	'trippost:deleted' => "publication effacée du voyage avec succès",
	'trippost:notdeleted' => "La publication du voyage n'a pas pu être supprimé",
	'mytripstopic:deleted' => "Theme supprimé",
	'mytripstopic:notdeleted' => "Le theme ná pas pu être supprimé",
	'triptopic:blank' => "Il n'y a pas de themes",
	'triptopic:notfound' => "On n'a pas pu trouver le theme demandé",
	'trippost:nopost' => "une entrée vide",
	'mytrips:deletewarning' => "attention! es-tu sur de vouloir rejeter ce voyage? On ne peut pas défaire",

	'mytrips:invitekilled' => "L'invité a supprimé.",
	'mytrips:joinrequestkilled' => "La demande a été supprimé.",
	'mytrips:error:addedtotrip' => "Il n'a pas été possible d'ajouter à %s au voyage.",
	'mytrips:add:alreadymember' => "%s fait de partie du voyage.",

	/**
	 * ecml
	 */
	'mytrips:ecml:discussion' => "discussion lors des voyages",
	'mytrips:ecml:tripprofile' => "profils des voyages",

	//photos
	'photos:trip' => "photos du voyage",	

	/**
	 * custom fields
	 */

	'mytrips:origen' => "Lieu du départ",
	'mytrips:destino' => "Lieu d'arrivée",
	'mytrips:trayecto' => "Type de voyage",
	'mytrips:fechaIda' => "Départ",
	'mytrips:fechaVuelta' => "Retour",
	'mytrips:llegadaIda' => "Arrivée à destination",
	'mytrips:llegadaVuelta' => "Arrivée au point du départ",
	'mytrips:flexible' => "Les dates sont flexibles",	
	'mytrips:gender' => "Sécurité pour les femmes",
	'mytrips:nplazas' => "Places disponibles",	
	'mytrips:aportacionViajero' => 'Contribution par voyageur',	
	'mytrips:distancia'=>'Distance du parcours',
	'mytrips:tiempo'=>'Durée approximative du voyage',
	'mytrips:precio'=>'Tarif',
	'mytrips:showMap'=>'montre | carte cachée',
	'trip:nplazasWrong'=>"Valeur non autorisée. Le nombre maximum de sièges ne doit pas être supérieure à celle de votre véhicule.",
	'mytrips:preReservar' => "Pré-réserver",
	'mytrips:confirm' => "Confirmer la pré-réservation",
	'mytrips:unPreorder' => "Annuler la pré-réservation",
	'mytrips:PreOrderCorrect' => "Réservé avec succès",
	'mytrips:unPreOrderCorrect' => "Réservation reportée avec succès",
	'mytrips:confirmTrip' => "Confirmer la réservation",
	'mytrips:unconfirmTrip' => "Annuler la réservation",
	'mytrips:cantPreorderSeatMax' => "Réservation impossible parce qu'il n’y a plus de sièges disponibles dans ce voyage",
	'mytrips:seatsAvaible' => "Sièges disponibles",

	'trip:nplazasNoDato' => 'Il est obligatoire introduire le nombre de places que tu offres',
	'trip:overbooking' => 'Tu as surpassé la limite de places de ta voiture',

	//gestion de reservas
	'mytrips:manageOrders' => "Gérer les réservations",
	'mytrips:manageOrders:title' => "Gestion des réserations",
	'mytrips:manageOrders:save' => 'Derrière',
	'mytrips:manageOrders:saved' => "Reservation enregistrée avec succès",
	'mytrips:manageOrders:confirmar' => "Confirmer",
	'mytrips:manageOrders:desconfirmar' => "Annuler",
	'mytrips:manageOrders:confirmadoOk' => "Réservation confirmée avec succès",
	'mytrips:manageOrders:confirmadoKo' => "Erreur survenue lors de la confirmation",
	'mytrips:manageOrders:desconfirmadoOk' => "Réservation annulée avec succès",
	'mytrips:manageOrders:desconfirmadoKo' => "Erreur survenue lors de l’annulation de la réservation",
	'mytrips:preorder' => "Pre-réserver",	
	'custom:empty' => '(vide champ de profil)',	

	//Mails internos de gestion de reservas 
	'mytrips:manageOrders:preorderOk:subjet' => 'PRE-RESERVATION DU VOYAGE %s',
	'mytrips:manageOrders:preorderOk:message'=>"L´utilisateur %s a fait une pré-réservation de place. <br /> 
    	Maintenant, vous devez traiter cette demande en accédant à son voyage %s pour le confirmer ou pour l´annuler. <br />
        Cordialement, <br />
           L'équipe de teranga go Teranga Go!",

	'mytrips:manageOrders:confirmadoOk:subjet' => 'RÉSERVATION DU VOYAGE %s',
	'mytrips:manageOrders:confirmadoOk:message'=>"L’organisateur du voyage <strong>%s</strong> a accepté votre réservation de place pour le voyage %s aux conditions de trajet %s et et vous engage à lui verser la somme de %s ou, à défaut, le montant convenu préalablement à la réalisation du voyage.<br />
		Vous voyagerez maintenant ensemble conformément aux accords du voyage qui ont été établis sur cette plateforme.<br />
		Cordialement, <br />
           L'équipe de teranga go Teranga Go!",

	'mytrips:manageOrders:desconfirmadoOk:subjet' => 'UNE RÉSERVATION DU VOYAGE ANNULÉE %s',
	'mytrips:manageOrders:desconfirmadoOk:message' => "L'utilisateur a annulé sa réservation de place pour un voyage. <br />
		Maintenant vous pouvez traiter d'autres pré-réservations de votre voyage ou en modifier les données (des dates où je dénombre des places offertes). Vérifiez %s.<br />
		Cordialement, <br />
           L'équipe de teranga go Teranga Go!",

	'mytrips:manageOrders:ConductorDesconfirmaOk:subjet' => 'RÉSERVATION DU VOYAGE %s ANNULÉE',
	'mytrips:manageOrders:ConductorDesconfirmaOk:message' => "L’organisateur du voyage <strong>%s</strong> annulé sa réservation du %s. Vérifiez %s. <br />
		<br />
		Cordialement, <br />
           L'équipe de teranga go Teranga Go!",



	//Acuerdos de viaje (foros)
	'mytrips:discussion:title1' => 'Pick-up points',
	'mytrips:discussion:description1' => 'Ceci est un endroit pour discuter avec vos passagers le pick-up et déposer endroits.',
	'mytrips:discussion:title2' => 'Des repos et des arrêts durant le voyage',
	'mytrips:discussion:description2' => 'Les repos et les arrêts que nous ferons durant le voyage.',
	'mytrips:discussion:title3' => 'Sur le colis',
	'mytrips:discussion:description3' => 'Des accords sur le envoye du colis, un lieu de distribution, etc.',


	//Trip planning sidebar
	'mytrips:follower' => 'Les membres intéressés par voyage esta',
	'mytrips:preorders' => 'Membres ayant pré-réservé siège',
	'mytrips:confirmed' => 'Membres avec siège confirmé',


	// Paqueteria	 ===============================
	'mytrips:servicioPaqueteria' => "Colis",
	'mytrips:tamaMaletero' => "Taille du coffre",
	'mytrips:tipoBultos' => "Type de paquets",
	'mytrips:nbultos' => 'Max permis paquets',	
	'mytrips:bultosDisponibles'=>'Paquets disponibles',


	//summaryPreOrder==============
	'mytrips:summaryPreOrder:title'=> 'Réservation Voyage ou Colis',
	'mytrips:summaryOrder'=>'Résumé de pré-réserve',
	'mytrips:summaryPreOrder:ViajoYO'=>'Occupé un siège',
	'mytrips:summaryPreOrder:ViajoYOBulto'=>"J'occupe une expédition de siège et colis",
	'mytrips:summaryPreOrder:ViajaBulto'=>'Je ne voyage pas, seule parcelle',
	'mytrips:summaryPreOrder:Elijo'=>'Sélectionner',
	'mytrips:summaryPreOrder:ElijoViajar'=>'Je choisis voyager',
	'mytrips:summaryPreOrder:numBultos'=>'Num forfaits'	

);
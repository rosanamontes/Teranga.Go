<?php


$languagecode = get_current_language();
$singularvar = $languagecode . 'singular';
$pluralvar = $languagecode . 'plural';
$verb = $languagecode . 'verb';

$singular = elgg_get_plugin_setting($singularvar, 'rename_friends');
$plural = elgg_get_plugin_setting($pluralvar, 'rename_friends');
$verb = elgg_get_plugin_setting($verb, 'rename_friends');

// set defaults if setting can't be found
if(empty($singular)){ $singular = elgg_echo('friend'); }
if(empty($plural)){ $plural = elgg_echo('friends'); }
if(empty($verb)){ $verb = elgg_echo('friends'); }

// get first letter of each, and register variables for starting with uppercase and lowercase first letter
// $usingle = uppercase singluar eg. Friend
// $lsingle = lowercase singluar eg. friend
// $uplural = uppercase plural eg. Friends
// $lplural = lowercase plural eg. friends

$lsingle = strtolower($singular);
$lplural = strtolower($plural);

//create our uppercase singular
$first_letter = strtoupper($singular[0]);
$rest_of_word = substr($singular, 1);

$usingle = $first_letter . $rest_of_word;

//create our uppercase plural
$first_letter = strtoupper($plural[0]);
$rest_of_word = substr($plural, 1);

$uplural = $first_letter . $rest_of_word;



// get variables for groups 
$singular = '';
$plural = '';
if(elgg_is_active_plugin('rename_groups')){
  $singular = elgg_get_plugin_setting($singularvar, 'rename_groups');
  $plural = elgg_get_plugin_setting($pluralvar, 'rename_groups');
}

  // set defaults if setting can't be found
  if(empty($singular)){ $singular = elgg_echo('groups:group'); }
  if(empty($plural)){ $plural = elgg_echo('groups'); }

  // get first letter of each, and register variables for starting with uppercase and lowercase first letter
  // $usingle = uppercase singluar eg. Group
  // $lsingle = lowercase singluar eg. group
  // $uplural = uppercase plural eg. Groups
  // $lplural = lowercase plural eg. groups

  $glsingle = strtolower($singular);
  $glplural = strtolower($plural);

  //create our uppercase singular
  $first_letter = strtoupper($singular[0]);
  $rest_of_word = substr($singular, 1);

  $gusingle = $first_letter . $rest_of_word;

  //create our uppercase plural
  $first_letter = strtoupper($plural[0]);
  $rest_of_word = substr($plural, 1);

  $guplural = $first_letter . $rest_of_word;
 
$spanish = array(
	//
	//	rename_friends language mappings
	//
	'rename_friends:language' => "Idioma",
	'rename_friends:missing:language:file' => "Falta el fichero de idioma.  Compruebe los permisos del directorio.",
	'rename_friends:plural' => "Plural",
	'rename_friends:settings' => "Rename Friends para español",
	'rename_friends:singular' => "Singular",
	'rename_friends:verb' => "Verbo en 3ª persona",	


    /*
     * 	Default Notification Settings
     */
	'notifications_tools:friends_notifications' => "Choose the default notification method for {$lplural} notifications (This will be applied when a new user acount is created)",
    'notifications_tools:friends_batch_method' => "Choose a notification method for {$lplural} notifications (This will affect all site users)",

    /*
     * Elgg Core
     */

	'access:friends:label' => $uplural,
	'friends' => $uplural,
	'friends:yours' => "Tus {$lplural}",
	'friends:owned' => "%s {$verb} a:",
	'friend:add' => "Añadir a {$lplural}",
	'friend:remove' => "Abandonar {$lsingle}",
	'friends:add:successful' => "Ahora {$verb} a %s.",
	'friends:add:failure' => "No se pudo a&ntilde;adir a %s como {$lsingle}. Por favor intente nuevamente.",
	'friends:remove:successful' => "Ya no {$verb} a %s",
	'friends:remove:failure' => "No se pudo quitar a %s de sus {$lplural}. Por favor intente nuevamente",
	'friends:none' => "Este usuario no tiene {$lplural} a&uacute;n",
	'friends:none:you' => "No tienes {$lplural} a&uacute;n",
	'friends:none:found' => "No se encontraron {$lplural}",
	'friends:of:none' => "Nadie ha agragado a este usuario como {$lsingle} a&uacute;n",
	'friends:of:none:you' => "Nadie te ha agragado como {$lsingle} a&uacute;n. Comienza a a&ntilde;adir contenido y completar tu perfil para que la gente te encuentre!",
	'friends:of:owned' => "{$uplural} de %s",
	'friends:of' => "{$uplural} de",
	'friends:collections' => "Colecciones de {$lplural}",
	'collections:add' => "Nueva colecci&oacute;n",
	'friends:collections:add' => "Nueva colecci&oacute;n de {$lplural}",
	'friends:addfriends' => "Seleccionar {$lplural}",
	'friends:collectionfriends' => "{$uplural} en la colecci&oacute;n",	
	'river:friend:user:default' => "%s ahora es {$lsingle} de %s",
	'river:widgets:friends' => 'Actividad de {$lsingle}',
	'userpicker:only_friends' => "Solo {$lplural}",
	'river:friends' => "Actividad de {$uplural}",
	'friends:widget:description' => "Muestra algunos de tus {$lplural}.",
	'friends:num_display' => "Cantidad de {$lplural} a mostrar",
	'friend:newfriend:subject' => "%s te ha puesto como {$lsingle} suyo!",
	'friend:newfriend:body' => "%s te ha puesto como  {$lsingle} suyo!
 
Para visualizar su perfil haz click aqu&iacute;:
 
 %s
 
Por favor no responda a este mail",

    /*
     * 	Extendafriend
     */

	'extendafriend:edit:friend' => "Editar {$usingle}",
	'extendafriend:updated' => "{$usingle} acceso a la coleccion actualizado",


    /*
     * 	Friend Request
     */

	'friend_request' => "Solicitud para ser {$usingle}",
	'friend_request:menu' => "Solicitudes de {$usingle}",
	'friend_request:title' => "{$usingle} Solicitud de: %s",
	'friend_request:new' => "New {$lsingle} request",
	'friend_request:friend:add:pending' => "{$usingle} request pending",
	'friend_request:newfriend:subject' => "%s wants to be your {$lsingle}!",
	'friend_request:newfriend:body' => "%s wants to be your {$lsingle}! But they are waiting for you to approve the request...so login now so you can approve the request!

You can view your pending {$lsingle} requests at (Make sure you are logged into the website before clicking on the following link otherwise you will be redirected to the login page.):

%s

(You cannot reply to this email.)",
		
	// Actions
	// Add request
	'friend_request:add:successful' => "You have requested to be {$lplural} with %s. They must approve your request before they will show on your {$lplural} list.",
	'friend_request:add:exists' => "You've already requested to be {$lplural} with %s.",
		
	// Approve request
	'friend_request:approve:successful' => "%s is now a {$lsingle}",
	'friend_request:approve:fail' => "Error while creating {$lsingle} relation with %s",
	
	// Decline request
	'friend_request:decline:subject' => "%s has declined your {$lsingle} request",
	'friend_request:decline:message' => "Dear %s,

%s has declined your request to become a {$lsingle}.",
	'friend_request:decline:success' => "{$usingle} request successfully declined",
	'friend_request:decline:fail' => "Error while declining {$usingle} request, please try again",
		
	// Revoke request
	'friend_request:revoke:success' => "{$usingle} request successfully revoked",
	'friend_request:revoke:fail' => "Error while revoking {$usingle} request, please try again",
	
	// Views
	// Received
	'friend_request:received:title' => "Recivido solicitud para ser {$usingle}",
	
	// Sent
	'friend_request:sent:title' => "Enviar solicitud para ser {$usingle}",



    /*
     * 	HypeEvents
     */

    'hj:events:friendevents' => "Eventos de {$uplural}",

    /*
     * 	Invite Friends
     */
	
	'friends:invite' => "Invite {$lplural}",
	'invitefriends:introduction' => "To invite {$lplural} to join you on this network, enter their email addresses below (one per line):",
	'invitefriends:success' => "Your {$lplural} were invited.",
	'invitefriends:email' => "
You have been invited to join %s by %s. They included the following message:

%s

To join, click the following link:

%s

You will automatically add them as a {$lsingle} when you create your account.",


/*
 * 	Rename Groups
 */

'groups:invite' => "Invite {$lplural}",
'groups:invite:title' => "Invite {$lplural} to this {$glsingle}",
'groups:inviteto' => "Invite {$lplural} to '%s'",
'groups:nofriends' => "You have no {$lplural} left who have not been invited to this {$glsingle}.",
'groups:nofriendsatall' => "You have no {$lplural} to invite!",


/*
 * 	River Addon
 */
'river_addon:label:friends' => "Do you want to display {$lplural} in sidebar?",
'river_addon:label:num' => "Number of {$lplural} to display",
'river_addon:option:default' => "All, Mine, {$uplural}",
'river_addon:option:friend'	=> "{$uplural}, Mine, All",
'river_addon:option:mine' => "Mine, {$uplural}, All",

);

add_translation("es", $spanish);
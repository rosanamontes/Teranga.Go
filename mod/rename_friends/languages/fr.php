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
 
$french = array(
	//
	//	rename_friends language mappings
	//
	'rename_friends:language' => "Idioma",
	'rename_friends:missing:language:file' => "Falta el fichero de idioma.  Compruebe los permisos del directorio.",
	'rename_friends:plural' => "Plural",
	'rename_friends:settings' => "Rename Friends para frances (Teranga Go!)",
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

	'friends:yours' => "Vos {$lplural}",
	'friends:owned' => "Les {$lplural} de %s",
	'friend:add' => "Ajouter un contact",
	'friend:remove' => "Supprimer un contact",

	'friends:add:successful' => "Vous avez ajouté %s à vos {$lplural}.",
	'friends:add:failure' => "%s n'a pas pu être ajouté(e) à vos {$lplural}. Merci de réessayer ultérieurement.",

	'friends:remove:successful' => "Vous avez retiré %s de vos {$lplural}.",
	'friends:remove:failure' => "%s n'a pas pu être retiré(e) de vos {$lplural}. Merci de réessayer ultérieurement.",

	'friends:none' => "Ce membre n'a pas encore ajouté de contact.",
	'friends:none:you' => "Vous n'avez pas encore de contact !",

	'friends:none:found' => "Aucun contact n'a été trouvé.",

	'friends:of:none' => "Personne n'a encore ajouté cet utilisateur comme contact.",
	'friends:of:none:you' => "Personne ne vous a encore ajouté comme contact. Commencez par remplir votre page profil et publiez du contenu pour que les gens vous trouvent !",

	'friends:of:owned' => "Les personnes qui ont %s dans leurs {$lplural}",

	'friends:of' => "{$lplural} de",
	'friends:collections' => "Groupement de {$lplural}",
	'collections:add' => "Nouvelle collection",
	'friends:collections:add' => "Nouveau groupement de {$lplural}",
	'friends:addfriends' => "Sélectionner des {$lplural}",
	'friends:collectionname' => "Nom du groupement",
	'friends:collectionfriends' => "{$lplural} dans le groupement",
	'friends:collectionedit' => "Modifier ce groupement",
	'friends:nocollections' => "Vous n'avez pas encore de groupement de {$lplural}.",
	'friends:collectiondeleted' => "Votre groupement de {$lplural} a été supprimé.",
	'friends:collectiondeletefailed' => "Le groupement de {$lplural} n'a pas été supprimé. Vous n'avez pas de droits suffisants, ou un autre problème peut-être en cause.",
	'friends:collectionadded' => "Votre groupement de {$lplural} a été créé avec succès",
	'friends:nocollectionname' => "Vous devez nommer votre groupement de contact avant qu'il puisse être créé.",
	'friends:collections:members' => "Membres du groupement",
	'friends:collections:edit' => "Modifier le groupement de {$lplural}",
	'friends:collections:edited' => "Collection sauvegardée",
	'friends:collection:edit_failed' => 'Impossible de sauvegarder la collection.',


	'friends:yours' => "Vous {$lplural}",
	'friends:owned' => "%s {$verb} de:",
	'friend:add' => "Ajouter un {$lplural}",
	'friend:remove' => "Supprimer un {$lsingle}",
	'friends:add:successful' => "Vous avez ajouté %s à vos {$lplural}",
	'friends:add:failure' => "%s n'a pas pu être ajouté(e) à vos {$lplural}. Merci de réessayer ultérieurement.",
	'friends:remove:successful' => "Vous avez retiré %s de vos {$lplural}.",
	'friends:remove:failure' => "%s n'a pas pu être retiré(e) de vos {$lplural}. Merci de réessayer ultérieurement.",

	'friends:none' => "Ce membre n'a pas encore ajouté de contact.",
	'friends:none:you' => "Vous n'avez pas encore de contact !",

	'friends:none:found' => "Aucun contact n'a été trouvé.",

	'friends:of:none' => "Personne n'a encore ajouté cet utilisateur comme contact.",
	'friends:of:none:you' => "Personne ne vous a encore ajouté comme contact. Commencez par remplir votre page profil et publiez du contenu pour que les gens vous trouvent !",

	'friends:of:owned' => "Les personnes qui ont %s dans leurs {$lplural}",

	'friends:of' => "{$uplural} de",
	'friends:collections' => "Groupement de {$lplural}",
	'collections:add' => "Nouvelle collection",
	'friends:collections:add' => "Nouveau groupement de {$lplural}",
	'friends:addfriends' => "Sélectionner des {$lplural}",
	'friends:collectionname' => "Nom du groupement",
	'friends:collectionfriends' => "{$lplural} dans le groupement",
	'friends:collectionedit' => "Modifier ce groupement",
	'friends:nocollections' => "Vous n'avez pas encore de groupement de {$lplural}.",
	'friends:collectiondeleted' => "Votre groupement de {$lplural} a été supprimé.",
	'friends:collectiondeletefailed' => "Le groupement de {$lplural} n'a pas été supprimé. Vous n'avez pas de droits suffisants, ou un autre problème peut-être en cause.",
	'friends:collectionadded' => "Votre groupement de {$lplural} a été créé avec succès",
	'friends:nocollectionname' => "Vous devez nommer votre groupement de contact avant qu'il puisse être créé.",
	'friends:collections:members' => "Membres du groupement",
	'friends:collections:edit' => "Modifier le groupement de {$lplural}",
	'friends:collections:edited' => "Collection sauvegardée",
	'friends:collection:edit_failed' => 'Impossible de sauvegarder la collection.',

);

add_translation("fr", $french);
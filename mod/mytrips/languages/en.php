<?php

/**
 * English strings
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

	'custom:mytrips' => "Latest Trips",

	/**
	 * Menu items and titles
	 */
	'mytrips' => "Your Trip",
	'item:trip' => "Trips",
	'mytrips:owned' => "Trips I promote",
	'mytrips:owned:user' => 'Trips %s promote',
	'mytrips:yours' => "My trips",
	'mytrips:user' => "%s's trips",
	'mytrips:all' => "All trips",
	'mytrips:add' => "Create a new trip",
	'mytrips:edit' => "Edit trip",
	'mytrips:delete' => 'Delete trip',
	'mytrips:membershiprequests' => 'Manage order requests',
	'mytrips:membershiprequests:pending' => 'Manage order requests (%s)',
	'mytrips:invitations' => 'Trip invitations',
	'mytrips:invitations:pending' => 'Trip invitations (%s)',

	'mytrips:icon' => 'Trip icon (leave blank to leave unchanged)',
	'mytrips:name' => 'Trip name',
	'mytrips:username' => 'Trip short name (displayed in URLs, alphanumeric characters only)',
	'mytrips:description' => 'Description',
	'mytrips:briefdescription' => 'Brief description',
	'mytrips:interests' => 'Tags',
	'mytrips:website' => 'Website',
	'mytrips:members' => 'Trip followers',
	'mytrips:my_status' => 'My status',
	'mytrips:my_status:trip_owner' => 'You drive in this trip',
	'mytrips:my_status:trip_member' => 'You are interested in this trip',
	'mytrips:my_status:trip_PreOrder' => 'You\'ve pre-booked this trip',
	'mytrips:my_status:trip_Confirmed' => 'You have confirmed your reservation for this trip',

	'mytrips:subscribed' => 'Trip notifications on',
	'mytrips:unsubscribed' => 'Trip notifications off',

	'mytrips:members:title' => 'Followers of %s',
	'mytrips:members:more' => "View all followers",
	'mytrips:membership' => "Trip membership permissions",
	'mytrips:content_access_mode' => "Accessibility of trip content",
	'mytrips:content_access_mode:warning' => "Warning: Changing this setting won't change the access permission of existing trip content.",
	'mytrips:content_access_mode:unrestricted' => "Unrestricted - Access depends on content-level settings",
	'mytrips:content_access_mode:membersonly' => "Followers Only - Non-members can never access trip content",
	'mytrips:access' => "Access permissions",
	'mytrips:owner' => "Driver",
	'mytrips:owner:warning' => "Warning: if you change this value, you will no longer be the promoter of this trip.",
	'mytrips:widget:num_display' => 'Number of trips to display',
	'mytrips:widget:membership' => 'My Trips',
	'mytrips:widgets:description' => 'Display the trips you are a member of on your profile',

	'mytrips:widget:trip_activity:title' => 'Trip activity',
	'mytrips:widget:trip_activity:description' => 'View the activity in one of your trips',
	'mytrips:widget:trip_activity:edit:select' => 'Select a trip',
	'mytrips:widget:trip_activity:content:noactivity' => 'There is no activity in this trip',
	'mytrips:widget:trip_activity:content:noselect' => 'Edit this widget to select a trip',

	'mytrips:noaccess' => 'No access to trip',
	'mytrips:permissions:error' => 'You do not have the permissions for this',
	'mytrips:intrip' => 'in the trip',
	'mytrips:cantcreate' => 'You can not create a trip. Only admins can.',
	'mytrips:cantedit' => 'You can not edit this trip',
	'mytrips:saved' => 'Trip saved',
	'mytrips:save_error' => 'Trip could not be saved',
	'mytrips:featured' => 'Featured trips',
	'mytrips:makeunfeatured' => 'Unfeature',
	'mytrips:makefeatured' => 'Make featured',
	'mytrips:featuredon' => '%s is now a featured trip.',
	'mytrips:unfeatured' => '%s has been removed from the featured trip.',
	'mytrips:featured_error' => 'Invalid trip.',
	'mytrips:nofeatured' => 'No featured trips',
	'mytrips:joinrequest' => 'Request membership',
	'mytrips:join' => 'Interested in trip',
	'mytrips:leave' => 'Non interested in trip',
	'mytrips:invite' => 'Invite',
	'mytrips:invite:title' => 'Invite users to this trip',
	'mytrips:inviteto' => "Invite friends to '%s'",
	'mytrips:nofriends' => "You have no friends left who have not been invited to this trip.",
	'mytrips:nofriendsatall' => 'You have no friends to invite!',
	'mytrips:viatrips' => "via trips",
	'mytrips:trip' => "Trip",
	'mytrips:search:tags' => "tag",
	'mytrips:search:title' => "Search for trips tagged with '%s'",
	'mytrips:search:none' => "No matching trips were found",
	'mytrips:search_in_trip' => "Search in this trip",
	'mytrips:acl' => "trip: %s",
	'mytrips:seleccionar' => "Select",
	'discussion:topic:notify:summary' => 'New discussion topic called %s',
	'discussion:topic:notify:subject' => 'New discussion topic: %s',
	'discussion:topic:notify:body' =>
'%s added a new discussion topic to the trip %s:

Title: %s

%s

View and reply to the discussion topic:
%s
',

	'discussion:reply:notify:summary' => 'New reply in topic: %s',
	'discussion:reply:notify:subject' => 'New reply in topic: %s',
	'discussion:reply:notify:body' =>
'%s replied to the discussion topic %s in the trip %s:

%s

View and reply to the discussion:
%s
',

	'mytrips:activity' => "Trip activity",
	'mytrips:enableactivity' => 'Enable trip activity',
	'mytrips:activity:none' => "There is no trip activity yet",

	'mytrips:notfound' => "Trip not found",
	'mytrips:notfound:details' => "The requested trip either does not exist or you do not have access to it",

	'mytrips:requests:none' => 'There are no current membership requests.',

	'mytrips:invitations:none' => 'There are no current invitations.',

	'item:object:tripforumtopic' => "Travel arrangements",
	'item:object:discussion_reply' => "Travel arrangements replies",

	'tripforumtopic:new' => "Add discussion post",

	'mytrips:count' => "trips created",
	'mytrips:open' => "open trip",
	'mytrips:closed' => "closed trip",
	'mytrips:member' => "followers",
	'mytrips:searchtag' => "Search for trips by tag",

	'mytrips:more' => 'More trips',
	'mytrips:none' => 'No trips',

	/**
	 * Access
	 */
	'mytrips:access:private' => 'Closed - Users must be invited',
	'mytrips:access:public' => 'Open - Any user may follow',
	'mytrips:access:trip' => 'Trip followers only',
	'mytrips:closedtrip' => "This trip's membership is closed.",
	'mytrips:closedtrip:request' => 'To ask to be added, click the "Request membership" menu link.',
	'mytrips:closedtrip:membersonly' => "This trip's membership is closed and its content is accessible only by followers.",
	'mytrips:opentrip:membersonly' => "This trip's content is accessible only by followers.",
	'mytrips:opentrip:membersonly:join' => 'To be a member, click the "Interested in trip" menu link.',
	'mytrips:visibility' => 'Who can see this trip?',

	/**
	 * Trip tools
	 */
	'mytrips:enableforum' => 'Enable travel arrangements',
	'mytrips:lastupdated' => 'Last updated %s by %s',
	'mytrips:lastcomment' => 'Last comment %s by %s',

	/**
	 * Trip discussion
	 */
	'discussion' => 'Travel arrangement',
	'discussion:add' => 'Add travel arrangements',
	'discussion:latest' => 'Latest travel arrangements',
	'discussion:trip' => 'Travel arrangement',
	'discussion:none' => 'No travel arrangement',
	'discussion:reply:title' => 'Reply by %s',

	'discussion:topic:created' => 'The discussion topic was created.',
	'discussion:topic:updated' => 'The discussion topic was updated.',
	'discussion:topic:deleted' => 'Discussion topic has been deleted.',

	'discussion:topic:notfound' => 'Discussion topic not found',
	'discussion:error:notsaved' => 'Unable to save this topic',
	'discussion:error:missing' => 'Both title and message are required fields',
	'discussion:error:permissions' => 'You do not have permissions to perform this action',
	'discussion:error:notdeleted' => 'Could not delete the discussion topic',

	'discussion:reply:edit' => 'Edit reply',
	'discussion:reply:deleted' => 'Discussion reply has been deleted.',
	'discussion:reply:error:notfound' => 'The discussion reply was not found',
	'discussion:reply:error:notfound_fallback' => "Sorry, we could not find the specified reply, but we've forwarded you to the original discussion topic.",
	'discussion:reply:error:notdeleted' => 'Could not delete the discussion reply',

	'discussion:search:title' => 'Reply on topic: %s',
	
	'admin:mytrips' => 'Trips',

	'reply:this' => 'Reply to this',

	'trip:replies' => 'Replies',
	'mytrips:forum:created' => 'Created %s with %d comments',
	'mytrips:forum:created:single' => 'Created %s with %d reply',
	'mytrips:forum' => 'Travel arrangements',
	'mytrips:addtopic' => 'Add a topic',
	'mytrips:forumlatest' => 'Latest travel arrangement',
	'mytrips:latestdiscussion' => 'Latest travel arrangements',
	'mytripspost:success' => 'Your reply was succesfully posted',
	'mytripspost:failure' => 'There was problem while posting your reply',
	'mytrips:alldiscussion' => 'Latest travel arrangements',
	'mytrips:edittopic' => 'Edit topic',
	'mytrips:topicmessage' => 'Topic message',
	'mytrips:topicstatus' => 'Topic status',
	'mytrips:reply' => 'Post a comment',
	'mytrips:topic' => 'Topic',
	'mytrips:posts' => 'Posts',
	'mytrips:lastperson' => 'Last person',
	'mytrips:when' => 'When',
	'triptopic:notcreated' => 'No topics have been created.',
	'mytrips:topicclosed' => 'Closed',
	'triptopic:created' => 'Your topic was created.',
	'mytrips:topicsticky' => 'Sticky',
	'mytrips:topicisclosed' => 'This trip discussion is closed.',
	'mytrips:topiccloseddesc' => 'This trip discussion is closed and is not accepting new comments.',
	'triptopic:error' => 'Your trip topic could not be created. Please try again or contact a system administrator.',
	'mytrips:forumpost:edited' => "You have successfully edited the forum post.",
	'mytrips:forumpost:error' => "There was a problem editing the forum post.",

	'mytrips:privatetrip' => 'This trip is closed. Requesting membership.',
	'mytrips:notitle' => 'Trips must have a title',
	'mytrips:cantjoin' => 'Can not follow trip',
	'mytrips:cantleave' => 'Could not leave trip',
	'mytrips:removeuser' => 'Remove from trip',
	'mytrips:cantremove' => 'Cannot remove user from trip',
	'mytrips:removed' => 'Successfully removed %s from trip',
	'mytrips:addedtotrip' => 'Successfully added the user to the trip',
	'mytrips:joinrequestnotmade' => 'Could not request to follow trip',
	'mytrips:joinrequestmade' => 'Requested to follow trip',
	'mytrips:joined' => 'Successfully joined trip!',
	'mytrips:left' => 'Successfully left trip',
	'mytrips:notowner' => 'Sorry, you are not the promoter of this trip.',
	'mytrips:notmember' => 'Sorry, you are not a member of this trip.',
	'mytrips:alreadymember' => 'You are already a member of this trip!',
	'mytrips:userinvited' => 'User has been invited.',
	'mytrips:usernotinvited' => 'User could not be invited.',
	'mytrips:useralreadyinvited' => 'User has already been invited',
	'mytrips:invite:subject' => "%s you have been invited to follow %s!",
	'mytrips:updated' => "Last reply by %s %s",
	'mytrips:started' => "Started by %s",
	'mytrips:joinrequest:remove:check' => 'Are you sure you want to remove this follow request?',
	'mytrips:invite:remove:check' => 'Are you sure you want to remove this invitation?',
	'mytrips:invite:body' => "Hi %s,

%s invited you to follow the '%s' trip. Click below to view your invitations:

%s",

	'mytrips:welcome:subject' => "Welcome to the %s trip!",
	'mytrips:welcome:body' => "Hi %s!

You are now a member of the '%s' trip! Click below to begin posting!

%s",

	'mytrips:request:subject' => "%s has requested to follow %s",
	'mytrips:request:body' => "Hi %s,

%s has requested to follow the '%s' trip. Click below to view their profile:

%s

or click below to view the trip's follow requests:

%s",

	/**
	 * Forum river items
	 */

	'river:create:trip:default' => '%s created the trip %s',
	'river:join:trip:default' => '%s joined the trip %s',
	'river:create:object:tripforumtopic' => '%s added a new travel arrangement topic %s',
	'river:reply:object:tripforumtopic' => '%s replied on the travel arrangement topic %s',
	'river:reply:view' => 'view reply',

	'mytrips:nowidgets' => 'No widgets have been defined for this trip.',


	'mytrips:widgets:members:title' => 'Trip followers',
	'mytrips:widgets:members:description' => 'List the followers of a trip.',
	'mytrips:widgets:members:label:displaynum' => 'List the followers of a trip.',
	'mytrips:widgets:members:label:pleaseedit' => 'Please configure this widget.',

	'mytrips:widgets:entities:title' => "Objects in trip",
	'mytrips:widgets:entities:description' => "List the objects saved in this trip",
	'mytrips:widgets:entities:label:displaynum' => 'List the objects of a trip.',
	'mytrips:widgets:entities:label:pleaseedit' => 'Please configure this widget.',

	'mytrips:forumtopic:edited' => 'Forum topic successfully edited.',

	'mytrips:allowhiddentrips' => 'Do you want to allow private trips?',
	'mytrips:whocancreate' => 'Who can create new trips?',

	/**
	 * Action messages
	 */
	'trip:deleted' => 'Trip and trip contents deleted',
	'trip:notdeleted' => 'Trip could not be deleted',

	'trip:notfound' => 'Could not find the trip',
	'trippost:deleted' => 'Trip posting successfully deleted',
	'trippost:notdeleted' => 'Trip posting could not be deleted',
	'mytripstopic:deleted' => 'Topic deleted',
	'mytripstopic:notdeleted' => 'Topic not deleted',
	'triptopic:blank' => 'No topic',
	'triptopic:notfound' => 'Could not find the topic',
	'trippost:nopost' => 'Empty post',
	'mytrips:deletewarning' => "Are you sure you want to delete this trip? There is no undo!",

	'mytrips:invitekilled' => 'The invite has been deleted.',
	'mytrips:joinrequestkilled' => 'The follow request has been deleted.',
	'mytrips:error:addedtotrip' => "Could not add %s to the trip",
	'mytrips:add:alreadymember' => "%s is already a member of this trip",

	/**
	 * ecml
	 */
	'mytrips:ecml:discussion' => 'Trip Discussions',
	'mytrips:ecml:tripprofile' => 'Trip profiles',

	//Photos
	'photos:trip' => 'Trip Pictures',

	/**
	 * custom fields
	 */

	'mytrips:origen' => 'Starting point',
	'mytrips:destino' => 'End point',
	'mytrips:trayecto' => 'Journey',
	'mytrips:fechaIda' => 'Departure',
	'mytrips:fechaVuelta' => 'Return',
	'mytrips:llegadaIda' => 'Arrival to end point',
	'mytrips:llegadaVuelta' => 'Arrival to starting point',
	'mytrips:flexible' => 'Open dates',	
	'mytrips:gender' => 'Security for woman',
	'mytrips:nplazas' => 'Free seats',
	'mytrips:aportacionViajero' => 'Contribution per traveller',	
	'mytrips:distancia'=>'Distance of trip',
	'mytrips:tiempo'=>'Estimated time',
	'mytrips:precio'=>'Precio price',
	'mytrips:showMap'=>'show | hide map',
	'trip:nplazasWrong'=>'Value not allowed. Max number of seats should not be greater that those of your vehicle.',	
	'mytrips:preReservar'=>'Pre-Order',
	'mytrips:confirm'=>'Confirm Pre-Order',
	'mytrips:unPreorder'=>'Cancel Pre-Order',
	'mytrips:PreOrderCorrect'=>'Pre-Order correctly',
	'mytrips:unPreOrderCorrect'=>'Pre-Order cancel correctly',
	'mytrips:confirmTrip'=>'Confirm Order',
	'mytrips:unconfirmTrip'=>'Cancel Order',
	'mytrips:cantPreorderSeatMax'=>'You can\'t preorder because there aren\'t seats avaible',
	'mytrips:seatsAvaible'=>'Seats available',

	'trip:nplazasNoDato' => 'It is required to indicate the number of offered seats',
	'trip:overbooking' => "It's not possible to overbook your car",	

	//gestion de reservas
	'mytrips:manageOrders' => 'Orders Management',
	'mytrips:manageOrders:title' => 'Orders Management',
	'mytrips:manageOrders:save' => 'Back',
	'mytrips:manageOrders:saved' => 'Management done successfully',
	'mytrips:manageOrders:confirmar' => 'Accept',
	'mytrips:manageOrders:desconfirmar' => 'Decline',
	'mytrips:manageOrders:confirmadoOk' => 'Aceptance done successfully',
	'mytrips:manageOrders:confirmadoKo' => 'This operation failed',
	'mytrips:manageOrders:desconfirmadoOk' => 'Declination done successfully',
	'mytrips:manageOrders:desconfirmadoKo' => 'This operation failed',
	'mytrips:preorder' => 'Pre-Order',	

	//Mails internos de gestión de reservas
	'mytrips:manageOrders:preorderOk:subjet' => 'PREORDER FOR TRIP %s',
	'mytrips:manageOrders:preorderOk:message'=>'The user %s has pre-order a place. <br />
	You must now manage the orders of your trip.		
		<br />
		Greetings, <br />
			The Teranga Go! team',	

	'mytrips:manageOrders:confirmadoOk:subjet' => 'ORDER FOR TRIP %s',
	'mytrips:manageOrders:confirmadoOk:message'=>'
	%s as trip promoter has accepted your pre-order for the trip %s. By default the type is %s and you agree to pay the amount of %s or another amount dealed before departure.<br />
	Now you will travel together attending the %s established for this journey.
		<br />
		Greetings, <br />
			The Teranga Go! team',	

	'mytrips:manageOrders:desconfirmadoOk:subjet' => 'ORDER CANCELLED FOR TRIP %s',
	'mytrips:manageOrders:desconfirmadoOk:message' => 'The user has canceled the reservation fee on the trip %s<br />
	 You can now manage other pre-booking your trip or modify your travel details (dates or number of free seats). Check the %s.
		<br />
		Greetings, <br />
			The Teranga Go! team',	

	'mytrips:manageOrders:ConductorDesconfirmaOk:subjet' => 'ORDER DENYED FOR TRIP %s',
	'mytrips:manageOrders:ConductorDesconfirmaOk:message' => '%s as trip promoter has rejected your interest in travel in %s. Check the %s. <br />
		<br />
		Greetings, <br />
			The Teranga Go! team',	


	//Acuerdos de viaje (foros)
	'mytrips:discussion:title1' => 'Stop points',
	'mytrips:discussion:description1' => 'This is a place to discuss with your passengers the pick up and drop off places.',
	'mytrips:discussion:title2' => 'Breaks and journey stops',
	'mytrips:discussion:description2' => 'This is a place to discuss with your passengers the fequency of breaks and the stops that should be made during the trip.',
	'mytrips:discussion:title3' => 'Shipment',
	'mytrips:discussion:description3' => 'This is a place to discuss shipment information.',

	//Trips sidebar
	'mytrips:follower' => 'Members interested in this trip',
	'mytrips:preorders' => 'Members with pre-booked seat',
	'mytrips:confirmed' => 'Members with confirmed seat',

	// Paqueteria	===============================================================================00
	'mytrips:servicioPaqueteria' => 'Shipment allowed',	
	'mytrips:tamaMaletero' => 'Car Trunk',	
	'mytrips:tipoBultos' => 'Package categories',	
	'mytrips:nbultos' => 'Max allowed packages',	
	'mytrips:bultosDisponibles'=>'Packages available',


	//summaryPreOrder==============
	'mytrips:summaryPreOrder:title'=> 'Travel or Parcel reservation',
	'mytrips:summaryOrder'=>'Summary of Pre-Reserva',
	'mytrips:summaryPreOrder:ViajoYO'=>'Occupy a seat',
	'mytrips:summaryPreOrder:ViajoYOBulto'=>'Occupy a seat and parcel shipping',
	'mytrips:summaryPreOrder:ViajaBulto'=>'I do not travel, only parcel shipment',
	'mytrips:summaryPreOrder:Elijo'=>'Select',
	'mytrips:summaryPreOrder:ElijoViajar'=>'I choose to travel',
	'mytrips:summaryPreOrder:numBultos'=>'Num. Packages'	
);

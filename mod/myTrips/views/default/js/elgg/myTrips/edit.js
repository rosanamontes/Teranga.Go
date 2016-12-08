/**
 * JavaScript used on trip creation/editing form
 * 	Plugin: myTripsTeranga from previous version of @package ElggGroup
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

define(function(require) {
	var elgg = require('elgg');
	var $ = require('jquery');

	/**
	 * Toggle the availability of content access field
	 *
	 * Content access field gets disabled in the trip edit form when
	 * trip is made visible only to members. When the visibility is
	 * made less restrictive, the field is enabled again.
	 * 
	 * @param {Object} event
	 */
	var toggleContentAccessMode = function(event) {
		var accessModeField = $('#myTrips-content-access-mode');

		if ($(this).val() == elgg.ACCESS_PRIVATE) {
			// trip is hidden, so force members_only mode and disable the field
			accessModeField.val('members_only').prop('disabled', true);
		} else {
			// Enable the field
			accessModeField.prop('disabled', false);
		}
	};

	$('#myTrips-vis').on('change', toggleContentAccessMode);

	return {
		toggleContentAccessMode: toggleContentAccessMode
	};
});

<?php
/**
* JS (admin pages only, so no extend)
*
* 	Plugin: profiles_go from previous version of @package profile_manager of Coldtrick IT Solutions 2009
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

?>
//<script>
elgg.provide("elgg.profiles_go");

elgg.profiles_go.init_admin = function() {
	elgg.profiles_go.filter_custom_fields(0);
	$('#custom_fields_ordering').sortable({
  		update: function(event, ui) {
  			elgg.profiles_go.reorder_custom_fields();
   		},
   		opacity: 0.6,
   		tolerance: 'pointer',
   		items: 'li'
	});

	$('#custom_fields_category_list_custom .elgg-list').sortable({
		update: function(event, ui) {
			elgg.profiles_go.reorder_categories();
   		},
		opacity: 0.6,
		tolerance: 'pointer',
		items: 'li',
		handle: '.elgg-icon-drag-arrow'
	});

	$('#custom_profile_field_category_0, #custom_fields_category_list_custom .elgg-item').droppable({
		accept: "#custom_fields_ordering .elgg-item",
		hoverClass: 'droppable-hover',
		tolerance: 'pointer',
		drop: function(event, ui) {
			var dropped_on = $(this).attr("id");
			var dragged_field = $(ui.draggable);
			elgg.profiles_go.change_field_category(dragged_field, dropped_on);
		}
	});

	$(".elgg-icon-profile-manager-user-summary-config-add").live("click", function(){
		$("#profile-manager-user-summary-config-options").clone().insertBefore($(this)).removeAttr("id").attr("name", $(this).parent().attr("rel") + "[]");
	});

	$(".profile-manager-user-summary-config-options-delete").live("click", function(){
		$(this).parent().remove();
	});
}

elgg.profiles_go.toggle_option = function(field, guid) {
	elgg.action('profiles_go/toggleOption', {
		data: {
			guid: guid,
			field: field
		},
		success: function(data) {
			if(data == true){
				$("#" + field + "_" + guid).toggleClass("field_config_metadata_option_disabled field_config_metadata_option_enabled");
			} else {
				alert(elgg.echo("profiles_go:actions:toggle_option:error:unknown"));
			}
		},
	});
}

elgg.profiles_go.reorder_custom_fields = function() {
	elgg.action('profiles_go/reorder?' + $('#custom_fields_ordering').sortable('serialize'));
}

elgg.profiles_go.reorder_categories = function() {
	elgg.action('profiles_go/categories/reorder?' + $('#custom_fields_category_list_custom .elgg-list').sortable('serialize'));
}

elgg.profiles_go.remove_field = function(guid) {
	if (confirm(elgg.echo("profiles_go:actions:delete:confirm"))) {
		elgg.action('profiles_go/delete', {
			data: {
				guid: guid
			},
			success: function(data) {
				if(data == true){
					$('#custom_profile_field_' + guid).hide('slow').parent().remove();
					elgg.profiles_go.reorder_custom_fields();
				} else {
					alert(elgg.echo("profiles_go:actions:delete:error:unknown"));
				}
			},
		});
	}
}

elgg.profiles_go.filter_custom_fields = function(category_guid) {
	$("#custom_fields_ordering .elgg-item").hide();
	$("#custom_fields_category_list_custom .custom_fields_category_selected").removeClass("custom_fields_category_selected");
	if(category_guid === 0){
		// show default
		$("#custom_fields_ordering .custom_field[rel='']").parent().show();
		$("#custom_profile_field_category_0").addClass("custom_fields_category_selected");
	} else {
		if(category_guid === undefined){
			// show all
			$("#custom_fields_ordering .custom_field").parent().show();
			$("#custom_profile_field_category_all").addClass("custom_fields_category_selected");
		} else {
			//show selected category
			$("#custom_fields_ordering .custom_field[rel='" + category_guid + "']").parent().show();
			$("#custom_profile_field_category_" + category_guid).parent().addClass("custom_fields_category_selected");
		}
	}
}

elgg.profiles_go.change_field_type = function() {
	var selectedType = $("#custom_fields_form select[name='metadata_type']").val();
	
	$("#custom_fields_form .custom_fields_form_field_option").attr("disabled", "disabled");
	$("#custom_fields_form .field_option_enable_" + selectedType).removeAttr("disabled");
}

// categories
elgg.profiles_go.change_field_category = function(field, category_guid) {
	var field_guid = $(field).attr("id").replace("elgg-object-","");
	category_guid = category_guid.replace("elgg-object-","").replace("custom_profile_field_category_", "");

	$.post(elgg.security.addToken(elgg.get_site_url() + 'action/profiles_go/changeCategory?guid=' + field_guid + '&category_guid=' + category_guid), function(data){
		if(data == 'true'){
			if(category_guid == 0){
				category_guid = "";
			}
			$(field).find(".custom_field").attr("rel", category_guid);
			$(".custom_fields_category_selected a").click();
				
		} else {
			alert(elgg.echo("profiles_go:actions:change_category:error:unknown"));
		}
	});
}

//register init hook
elgg.register_hook_handler("init", "system", elgg.profiles_go.init_admin);
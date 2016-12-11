elgg.provide("elgg.profiles_go");

//show description and fields based on selected profile type (profile edit)
elgg.profiles_go.change_profile_type = function(){
	var selVal = $('#custom_profile_type').val();
	
	$('.custom_fields_edit_profile_category').hide();
	$('.custom_profile_type_description').hide();

	if (selVal !== "") {
		$('.custom_profile_type_' + selVal).show();
		$('#custom_profile_type_description_'+ selVal).show();
	}
	
	if ($("#profiles_go_profile_edit_tabs li.elgg-state-selected:visible").length === 0) {
		$('#profiles_go_profile_edit_tab_content_wrapper>div').hide();
		$("#profiles_go_profile_edit_tabs a:first:visible").click();
	}
};

elgg.profiles_go.profiles_go_username = function(event, elem) {
	if (event.which !== 13) {
		var username = $(elem).val();
		$container = $(elem).parent();
		$container.find(".elgg-icon").hide();
		
		if (username !== $(elem).attr("rel")) {
			$container.find(".elgg-icon-profile-manager-loading").show();
			
			$.getJSON(elgg.get_site_url() + "profiles_go/validate_username", { "username": username }, function(data){
				if($("#profiles_go_username .elgg-input-text").val() == username){
					if(data.valid){
						$container.find(".elgg-icon-profile-manager-valid").show();
					} else {
						$container.find(".elgg-icon-profile-manager-invalid").show();
					}
					
					$("#profiles_go_username .elgg-icon-profile-manager-loading").hide();
				}
			});
		}
	}
};

elgg.profiles_go.init_edit = function() {
	// tab switcher on edit form
	$("#profiles_go_profile_edit_tabs a").click(function(event) {
		var id = $(this).attr("href").replace("#", "");
		$("#profiles_go_profile_edit_tabs li").removeClass("elgg-state-selected");
		$(this).parent().addClass("elgg-state-selected");
	
		$('#profiles_go_profile_edit_tab_content_wrapper>div').hide();
		$('#profiles_go_profile_edit_tab_content_' + id).show();

		// do not jump to the anchor
		event.preventDefault();
	});
	
	var hash = window.location.hash;
	if(hash && hash !== "#" && $("#profiles_go_profile_edit_tabs " + hash).length > 0){
		var $tab = $("#profiles_go_profile_edit_tabs " + hash + " a:visible");
		if($tab.length > 0){
			$tab.click();
		} else {
			$("#profiles_go_profile_edit_tabs a:first:visible").click();
		}
	} else {
		$("#profiles_go_profile_edit_tabs a:first:visible").click();
	}

	// username change
	$("#profiles_go_username .elgg-input-text").live("keyup", function(event) {
		elgg.profiles_go.profiles_go_username(event, $(this));
	});
};

//register init hook
elgg.register_hook_handler("init", "system", elgg.profiles_go.init_edit);
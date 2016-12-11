elgg.provide("elgg.profiles_go");

var profiles_go_register_form_timers = [];
var profiles_go_register_form_validate_xhr = [];

//live input validation
elgg.profiles_go.register_form_validate = function(form, field){
	var fieldname = $(field).attr("name");
	var fieldvalue = $(field).val();
	if(profiles_go_register_form_validate_xhr[fieldname]){
		// cancel running ajax calls
		profiles_go_register_form_validate_xhr[fieldname].abort();
	}
	if(fieldvalue){
		var data = {};
		data.name=fieldname;
		data[fieldname] = fieldvalue;
	
		form.find("input[name='" + fieldname + "']").next(".profiles_go_validate_icon").attr("class", "elgg-icon profiles_go_validate_icon profiles_go_validate_icon_loading").attr("title", "");
		
		profiles_go_register_form_validate_xhr[fieldname] = elgg.action("profiles_go/register/validate", {
				data: data,
				success: function(data){
					// process results
					if(data.output){
						$field = form.find("input[name='" + data.output.name + "']");
						$field_icon = $field.next(".profiles_go_validate_icon");
						$field_icon.removeClass("profiles_go_validate_icon_loading");
						if(data.output.status === false){
							// something went wrong; show error icon and add title
							$field_icon.addClass("profiles_go_validate_icon_invalid");
						}
	
						if(data.output.status === true){
							// something went right; show success icon
							$field_icon.addClass("profiles_go_validate_icon_valid");
							$field.removeClass("profiles_go_register_missing");
						}
						if(data.output.text){
							$field_icon.attr("title", data.output.text);
						}
					}
					
				}
			});
	} else {
		form.find("input[name='" + fieldname + "']").next(".profiles_go_validate_icon").attr("class", "elgg-icon profiles_go_validate_icon").attr("title", "");
	}
};

//show description and fields based on selected profile type (register form)
elgg.profiles_go.change_profile_type_register = function(){
	var selVal = $('#custom_profile_fields_custom_profile_type').val();
	if(selVal === "" || selVal === "undefined"){
		selVal = 0;
	}

	// profile type description
	$('div.custom_profile_type_description').hide();
	$('#'+ selVal).show();

	// tabs
	var $tabs = $('#profiles_go_register_tabbed');
	if ($tabs.length > 0) {
		$tabs.find('li').hide();
		$tabs.find(".profile_type_0, .profile_type_" + selVal).show();
		if ($tabs.find('li.selected:visible').length === 0) {
			$tabs.find('li:visible:first>a').click();
		} else {
			$tabs.find('li.selected:visible').click();
		}
	} else {
		// list
		$(".profiles_go_register_category").hide();
		$(".profiles_go_register_category.profile_type_0, .profiles_go_register_category.profile_type_" + selVal).show();
	}
};

//tab switcher on register form
elgg.profiles_go.toggle_tabbed_nav = function(div_id, element){
	$content_container = $('#profiles_go_register_tabbed').next();
	$content_container.find('>div').hide();
	$content_container.find('>div.category_' + div_id).show();

	$('#profiles_go_register_tabbed li.elgg-state-selected').removeClass('elgg-state-selected');
	$(element).parent('li').addClass("elgg-state-selected");
};

elgg.profiles_go.init_register = function(){
	
	// validate on submit
	$(".elgg-form-register").live("submit", function() {
		var error_count = 0;
		var result = false;

		var $form = $(this);
		var selProfileType =  $("#custom_profile_fields_custom_profile_type").val();
		if (selProfileType === "") {
			selProfileType = 0;
		}
		
		$form.find(".mandatory").find("input, select, textarea").each(function(index, elem) {
			
			switch($(elem).attr("type")){
				case "radio":
				case "checkbox":
					$(elem).parent(".mandatory").removeClass("profiles_go_register_missing");

					// check parents
					var $parents = $(elem).parents(".profiles_go_register_category");
					if (($parents.length === 0) || ($parents.hasClass("category_" + selProfileType) || $parents.hasClass("category_0"))) {
						if ($form.find("input[name='" + $(elem).attr("name") + "']:checked").length === 0) {
							
							$(elem).parent(".mandatory").addClass("profiles_go_register_missing");
							error_count++;
						}
					}
					break;
				default:
					$(elem).removeClass("profiles_go_register_missing");
					// also remove class from multiselect element
					$(elem).next(".ui-multiselect").removeClass("profiles_go_register_missing");

					// check parents
					var $parents = $(elem).parents(".profiles_go_register_category");
					if (($parents.length === 0) || ($parents.hasClass("profile_type_" + selProfileType) || $parents.hasClass("profile_type_0"))) {
					
						if ($(elem).is("select")) {
							if (($(elem).val() === null) || ($(elem).val() === "")) {
								$(elem).addClass("profiles_go_register_missing");
								// also add class to multiselect element
								$(elem).next(".ui-multiselect").addClass("profiles_go_register_missing");
								
								error_count++;
							}
						} else {
							
							if ($(elem).val().trim() === "") {
								$(elem).addClass("profiles_go_register_missing");
								error_count++;
							}
						}
					}
					break;
			}
		});
	
		if (error_count > 0) {
			alert(elgg.echo("profiles_go:register:mandatory"));
		} else {
			result = true;
		}
	
		return result;
	});
	
	// add username generation when a email adress has been entered
	$(".elgg-form-register input[name='email']").live("blur", function(){
		var email_value = $(this).val();
		if (email_value.indexOf("@") !== -1) {
			var pre = email_value.split("@");
			if (pre[0]) {
				if ($(".elgg-form-register input[name='username']").val() === "") {
					// change value and trigger change
					var new_val = pre[0].replace(/[^a-zA-Z0-9]/g, "");
					$(".elgg-form-register input[name='username']").val(new_val).keyup();
				}
			}
		}
	});

	// add live validation of username and emailaddress
	$(".elgg-form-register input[name='username'], .elgg-form-register input[name='email'], .elgg-form-register input[name='password']").live("keyup", function(event){
		var fieldname = $(event.currentTarget).attr("name");
		var form = $(this).parents(".elgg-form-register");
		clearTimeout(profiles_go_register_form_timers[fieldname]);
		profiles_go_register_form_timers[fieldname] = setTimeout(function(){
			elgg.profiles_go.register_form_validate(form, $(event.currentTarget));
		}, 500);
	});

	// password compare check
	$(".elgg-form-register input[name='password'], .elgg-form-register input[name='password2']").live("keyup", function(event){
		var form = $(this).parents(".elgg-form-register");
		
		var password1 = form.find("input[name='password']").val();
		var password2 = form.find("input[name='password2']").val();
		
		$field = form.find("input[name='password2']");
		$field_icon = $field.next(".profiles_go_validate_icon");
		$field_icon.attr("class", "elgg-icon profiles_go_validate_icon").attr("title", "");
		if((password1 !== "") && (password2 !== "")){
			if(password1 == password2){
				$field_icon.addClass("profiles_go_validate_icon_valid");
				$field.removeClass("profiles_go_register_missing");
			} else {
				$field_icon.addClass("profiles_go_validate_icon_invalid").attr("title", elgg.echo("RegistrationException:PasswordMismatch"));
			}
		}
	});
};

//register init hook
elgg.register_hook_handler("init", "system", elgg.profiles_go.init_register);
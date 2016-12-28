<?php
/**
* trip edit form to support options (radio, dropdown, multiselect). It overrides the one from mytrips
*
* 	Plugin: profiles_go from previous version of @package profiles_go of Coldtrick IT Solutions 2009
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


$trip = elgg_extract("entity", $vars);

$name_limit = elgg_get_plugin_setting("trip_limit_name", "profiles_go");
$description_limit = elgg_get_plugin_setting("trip_limit_description", "profiles_go");
	
echo "<div>";
echo "<label>" . elgg_echo("mytrips:icon") . "</label><br />";
echo elgg_view("input/file", array('name' => 'icon'));
echo "</div>";

echo "<div>";
echo "<label>" . elgg_echo("mytrips:name") . "</label><br />";

$show_input = false;
if (empty($trip) || ($name_limit === NULL) || ($name_limit === "") || elgg_is_admin_logged_in()) {
	$show_input = true;
}

if (!$show_input && !empty($trip) && (!empty($name_limit) || ($name_limit == "0"))) {
	$name_limit = (int) $name_limit;
	$name_edit_count = (int) $trip->getPrivateSetting("profiles_go_name_edit_count");

	if ($name_edit_count < $name_limit) {
		$show_input = true;
	}
	
	$name_edit_num_left = $name_limit - $name_edit_count;
}

if ($show_input) {
	echo elgg_view("input/text", array(
			'name' => 'name',
			'value' => elgg_extract('name', $vars),
	));
	if (!empty($name_edit_num_left)) {
		echo "<div class='elgg-subtext'>" . elgg_echo("profiles_go:trip:edit:limit", array("<strong>" . $name_edit_num_left . "</strong>")) . "</div>";
	}
} else {
	// show value
	echo elgg_view("output/text", array(
			'value' => elgg_extract('name', $vars),
	));
	
	// add hidden so it gets saved and form checks still are valid
	echo elgg_view("input/hidden", array(
			'name' => 'name',
			'value' => elgg_extract('name', $vars),
	));
}
echo "</div>";?>
<!--Antonio: AQUí MI GOOGLE MAPS-->
<style>
#map {
        height: 450px;
		width:600px;
      }

</style>

	<div id="map"></div>
<?php

// retrieve trip fields
$trip_fields = profiles_go_get_categorized_trip_fields();

if (count($trip_fields["fields"]) > 0) 
{
	$trip_fields = $trip_fields["fields"];
	
	foreach ($trip_fields as $field) 
	{
		$metadata_name = $field->metadata_name;
		
		// get options
		$options = $field->getOptions();
		$placeholder = $field->getPlaceholder();
		
		// get type of field
		$valtype = $field->metadata_type;
		
		// get title
		$title = $field->getTitle();
		
		// get value
		$value = elgg_extract($metadata_name, $vars);
		
		$line_break = '<br />';
		if ($valtype == 'longtext') {
			$line_break = '';
		}
		echo '<div><label>';
		echo $title;
		echo "</label>";
		
		if ($hint = $field->getHint()) {
			?>
			<span class='custom_fields_more_info' id='more_info_<?php echo $metadata_name; ?>'></span>
			<span class="hidden" id="text_more_info_<?php echo $metadata_name; ?>"><?php echo $hint;?></span>
			<?php
		}
		
		echo $line_break;
		
		$field_output_options = array(
			'name' => $metadata_name,
			'value' => $value,
		);

		if ($options) {
			$field_output_options['options'] = $options;
		}

		if ($placeholder) {
			$field_output_options['placeholder'] = $placeholder;
		}

		if ($metadata_name == "description") {
		
			$show_input = false;
			if (empty($trip) || ($description_limit === NULL) || ($description_limit === "") || elgg_is_admin_logged_in()) {
				$show_input = true;
			}
			
			$edit_num_left = 0;
			
			if (!$show_input && !empty($trip) && (!empty($description_limit) || ($description_limit == "0"))) {
				$description_limit = (int) $description_limit;
				$field_edit_count = (int) $trip->getPrivateSetting("profiles_go_description_edit_count");
			
				if ($field_edit_count < $description_limit) {
					$show_input = true;
				}
					
				$edit_num_left = $description_limit - $field_edit_count;
			}
			
			if ($show_input) {

				echo elgg_view("input/{$valtype}", $field_output_options);
				
				if (!empty($edit_num_left)) {
					echo "<div class='elgg-subtext'>" . elgg_echo("profiles_go:trip:edit:limit", array("<strong>" . $edit_num_left . "</strong>")) . "</div>";
				}
			} else {
				// show value
				echo elgg_view("output/{$valtype}", array(
						'value' => $value
				));
					
				// add hidden so it gets saved and form checks still are valid
				echo elgg_view("input/hidden", array(
						'name' => $metadata_name,
						'value' => $value
				));
			}
		} else {
			if ($valtype == "dropdown") {
				// add div around dropdown to let it act as a block level element
				echo "<div>";
			}
			
			echo elgg_view("input/{$valtype}", $field_output_options);
			
			if ($valtype == "dropdown") {
				echo "</div>";
			}
		}
		
		echo '</div>';
	}
}
?>
	<style>
		.btnAportacion{
			display: inline-flex;
			width:25px;
			height:25px;
		}
		#btnAumentar{
			background-image:url('<?php echo elgg_get_site_url()."mod/mytrips/graphics/icono_mas.png"; ?>');
		}
		#btnRestar{
			background-image:url('<?php echo elgg_get_site_url()."mod/mytrips/graphics/icono_menos.png"; ?>');
		}
	</style>
	<script>
	$(document).ready(function(){
		$("[name='aportacionViajero']").parent().append("<br/><div style=\"margin-top:5px;\"><div id=\"btnAumentar\" class=\"btnAportacion\"></div>&nbsp;<div id=\"btnRestar\"  class=\"btnAportacion\"></div></div>");
		
		$("[name='nbultos']").blur(function(){
			if($(this).val()=="" || $(this).val()<0||$(this).val()>=50)
			{
				alert("<?php echo elgg_echo('package:nbultosWrong'); ?>");
				$(this).val("0");
			}
		});
		$("#btnAumentar").click(function(){
			var aportacion=$("[name='aportacionViajero']").val();
			var posicionFinal = parseInt(aportacion.indexOf('.')+3);
			var rest = aportacion.substr(0, posicionFinal);
			rest=(parseFloat(rest)+1).toFixed(2);
				$("[name='aportacionViajero']").val(rest+" €");
		});
		$("#btnRestar").click(function(){
		var aportacion=$("[name='aportacionViajero']").val();
		var posicionFinal = parseInt(aportacion.indexOf('.')+3);
		var rest = aportacion.substr(0, posicionFinal);
		rest=(parseFloat(rest)-1).toFixed(2);
		if (rest<=0){
			alert("No se puede bajar de ésta cifra");
		} else {
			$("[name='aportacionViajero']").val(rest+" €");
		}
		
		
		});
	});
	
	
	if ($('input[name=trayecto]:checked').index('input[name=trayecto]')==0){
		$('[name=\'fechaVuelta\']').attr("disabled", "disable");
	}
	var asientos=<?php 
				if (empty($trip)){
					$user = elgg_get_logged_in_user_entity();
					if ($user->asientos!=""){
							echo $user->asientos;  
						  }else {
							  echo 0;
						  }
				}
				else {
						$user1=get_entity($trip->getOwnerGUID());
						  if ($user1->asientos!=""){
							echo $user1->asientos;  
						  }else {
							  echo 0;
						  }
			  }
			   ?>;	
	
	var origen=$("[name='origen']").val(),
			destino=$("[name='destino']").val(),
			nplazas=parseInt($("[name='nplazas']").val()),nombreViaje=$("[name='name']").val();
		function initMap() {
			
			/*$("[name='origen']").attr("id","start");
			$("[name='destino']").attr("id","end");*/
			
	  var directionsService = new google.maps.DirectionsService;
	  var directionsDisplay = new google.maps.DirectionsRenderer;
	  var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 7,
		center: {lat: 37.17101383853488, lng: -3.6039181187454528}
	  });
	  directionsDisplay.setMap(map);

	  var onChangeHandler = function() {
		calculateAndDisplayRoute(directionsService, directionsDisplay);
	  };
	  onChangeHandler();
	  
	  $("[name='origen'],[name='destino']").blur(function(){
		  onChangeHandler();
	  });
	  $("[name='trayecto']").on("click",function(){
			origen=$("[name='origen']").val();
			destino=$("[name='destino']").val();
			nplazas=parseInt($("[name='nplazas']").val());
		  if($('input[name=trayecto]:checked').index('input[name=trayecto]')==1){
			  	
			  $('[name=\'fechaVuelta\']').removeAttr("disabled");
			  if (Number.isInteger(nplazas)&& nplazas>0 && nplazas!="" && nplazas<=asientos) 
			  {
				  var distanceService = new google.maps.DistanceMatrixService();
					distanceService.getDistanceMatrix({
						origins: [origen],
						destinations: [destino],
						travelMode: google.maps.TravelMode.DRIVING,
						unitSystem: google.maps.UnitSystem.METRIC,
						durationInTraffic: true,
						avoidHighways: false,
						avoidTolls: false
					},
					function (response, status) {
						if (status !== google.maps.DistanceMatrixStatus.OK) {
							console.log('Error:', status);
						} else {
							$("[name='aportacionViajero']").val(((((parseInt(response.rows[0].elements[0].distance.value)/1000)*0.0587).toFixed(2)/nplazas)*2).toFixed(2)+" €");
						}
					});
					
			  }else {
				  alert("<?php echo elgg_echo("trip:nplazasWrong"); ?> ");
			  }
		  }
		  else {
			  $('[name=\'fechaVuelta\']').attr("disabled", "disable");
			  $('[name=\'fechaVuelta\']').val("");
			  
				 if (Number.isInteger(nplazas)&& nplazas>0 && nplazas!=""&& nplazas<=asientos) 
		  {
			  var distanceService = new google.maps.DistanceMatrixService();
				distanceService.getDistanceMatrix({
					origins: [origen],
					destinations: [destino],
					travelMode: google.maps.TravelMode.DRIVING,
					unitSystem: google.maps.UnitSystem.METRIC,
					durationInTraffic: true,
					avoidHighways: false,
					avoidTolls: false
				},
				function (response, status) {
					if (status !== google.maps.DistanceMatrixStatus.OK) {
						console.log('Error:', status);
					} else {
						$("[name='aportacionViajero']").val((((parseInt(response.rows[0].elements[0].distance.value)/1000)*0.0587).toFixed(2)/nplazas).toFixed(2)+" €");
					}
				});
				
		  }else {
			  alert("<?php echo elgg_echo("trip:nplazasWrong"); ?> ");
		  }
		}
	  });
	   $("[name='nplazas']").blur(function(){
			origen=$("[name='origen']").val();
			destino=$("[name='destino']").val();
			nplazas=parseInt($("[name='nplazas']").val());
		  
		  if (Number.isInteger(nplazas)&& nplazas>0 && nplazas!="" && nplazas<=asientos) 
		  {
			  var distanceService = new google.maps.DistanceMatrixService();
				distanceService.getDistanceMatrix({
					origins: [origen],
					destinations: [destino],
					travelMode: google.maps.TravelMode.DRIVING,
					unitSystem: google.maps.UnitSystem.METRIC,
					durationInTraffic: true,
					avoidHighways: false,
					avoidTolls: false
				},
				function (response, status) {
					if (status !== google.maps.DistanceMatrixStatus.OK) {
						console.log('Error:', status);
					} else {
						$("[name='aportacionViajero']").val((((parseInt(response.rows[0].elements[0].distance.value)/1000)*0.0587).toFixed(2)/nplazas).toFixed(2)+" €");
					}
				});
				
		  }else {
			  alert("<?php echo elgg_echo("trip:nplazasWrong"); ?> ");
		  }
	  });

	  
	  
	  //objeto
	var fechaIda=$('[name=\'fechaIda\']'),
	fechaVuelta=$('[name=\'fechaVuelta\']');
	
	//valores
	var fechaIdaVal,
		fechaVueltaVal;
	
	/*
	Función que coje el valor actual de la fecha de ida y la de vuelta
	*/
	function getFechasViaje(){
		fechaIdaVal=$(fechaIda).val(),
		fechaVueltaVal=$(fechaVuelta).val();
	}
	var path="<?php echo elgg_get_site_url(); ?>";
	/*
	Para que no haga el form si se ha dejado las fechas mal
	*/
	$( "form" ).submit(function() 
	{
		var path="<?php echo elgg_get_site_url(); ?>";
		var rbIdaVuelta=$('input[name=trayecto]:checked').index('input[name=trayecto]')==1;
		//cojo fechas
		getFechasViaje();
		
		var d = new Date();

		var mes = d.getMonth()+1;
		var dia = d.getDate();

		var hoy = d.getFullYear() + '-' +
			((''+mes).length<2 ? '0' : '') + mes + '-' +
			((''+dia).length<2 ? '0' : '') + dia;
		var todoOk=false;
		//compruebo intervalos
		if (fechaIdaVal<hoy) {
			alert("<?php echo elgg_echo("datepicker:noTripAtPast"); ?>");
			//return todoOk;
		}
		
		else if(fechaIdaVal>fechaVueltaVal && rbIdaVuelta) {
			alert("<?php echo elgg_echo("datepicker:dateStartAfterThanDateEnd"); ?>");
		}
		else if(fechaVueltaVal<fechaIdaVal && rbIdaVuelta) {
			alert("<?php echo elgg_echo("datepicker:dateEndBeforeThanDateStart"); ?>");
		}
		else if($("[name='nbultos']").val()=="" || $("[name='nbultos']").val()<0||$("[name='nbultos']").val()>=50)
			{
				alert("<?php echo elgg_echo('package:nbultosWrong'); ?>");
				$("[name='nbultos']").val("0");
			}
		else if ($("[name='nplazas']").val()!=""&& $("[name='nplazas']").val()<=asientos){
				todoOk=true;
		} 
		else {
				alert("<?php echo elgg_echo("trip:nplazasWrong"); ?>");
			}
			return todoOk;
	});
	  
	}

	function calculateAndDisplayRoute(directionsService, directionsDisplay) 
	{
	  if ( $("[name='origen']").val()!="" && $("[name='destino']").val()){
		 directionsService.route({
		origin: $("[name='origen']").val(),
		destination: $("[name='destino']").val(),
		travelMode: google.maps.TravelMode.DRIVING
	  }, function(response, status) {
		if (status === google.maps.DirectionsStatus.OK) {
		  directionsDisplay.setDirections(response);
		} else {
		  window.alert('Directions request failed due to ' + status);
		}
	  }); 
	  }
	}
    </script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1vRLc27drd6AeU8U_SSu11yQflq7FR7g&signed_in=true&callback=initMap"
        async defer></script>

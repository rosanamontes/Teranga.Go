<?php header('Access-Control-Allow-Origin: *');  
/**
 * trip profile summary: Icon and profile fields
 *
 * @uses $vars['trip']
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

if (!isset($vars['entity']) || !$vars['entity']) {
	echo elgg_echo('mytrips:notfound');
	return true;
}

$trip = $vars['entity'];
$owner = $trip->getOwnerEntity();

if (!$owner) {
	// not having an owner is very bad so we throw an exception
	$msg = "Sorry, '" . 'trip owner' . "' does not exist for guid:" . $trip->guid;
	throw new InvalidParameterException($msg);
}

?>
<div class="mytrips-profile clearfix elgg-image-block">
	<div class="elgg-image">
		<div class="mytrips-profile-icon">
			<?php
				// we don't force icons to be square so don't set width/height
				echo elgg_view_entity_icon($trip, 'large', array(
					'href' => '',
					'width' => '',
					'height' => '',
				)); 
			?>
		</div>
		<div class="mytrips-stats">
			<p>
				<b><?php echo elgg_echo("mytrips:owner"); ?>: </b>
				<?php
					echo elgg_view('output/url', array(
						'text' => $owner->name,
						'value' => $owner->getURL(),
						'is_trusted' => true,
					));
				?>
			</p>
			<p>
			<?php
				$num_members = $trip->getMembers(array('count' => true));
				/*CAMBIA N MIEMBROS DEL GRUPO*/
				echo elgg_echo('mytrips:members') . ": " .$num_members."<br />";
				
				//Asientos usados
				$asientosOcupados=0;
				$summaryPreOrderConfirmed=$trip->summaryPreOrderConfirmed;
				$summaryPreOrderBultos=$trip->summaryPreOrderBultos;
				$summaryPreOrderTrayecto=$trip->summaryPreOrderTrayecto;
				for($i=2;$i<count($summaryPreOrderConfirmed);$i++)
					{
						if($summaryPreOrderConfirmed[$i]=="1" && $summaryPreOrderTrayecto[$i]!="-1" ) {
							$asientosOcupados++;
						}
					}
				/*
				if($trip->preorder!="") $asientosOcupados+=count($trip->preorder)-2;
				if($trip->confirmed!="") {
					$cont=0;
					$summaryPreOrderConfirmed=$trip->summaryPreOrderConfirmed;
					$summaryPreOrderBultos=$trip->summaryPreOrderBultos;
					$summaryPreOrderTrayecto=$trip->summaryPreOrderTrayecto;
					
					for($i=2;$i<count($summaryPreOrderConfirmed);$i++)
					{
						if($summaryPreOrderBultos[$i] > 0 && $summaryPreOrderTrayecto[$i]==-1) $cont++;
					}
					
					$asientosOcupados+=count($trip->confirmed)-2-$cont;					
				}*/
				
				if ($owner->nAsientos!="")	
					echo elgg_echo('mytrips:seatsAvaible').": ".($owner->nAsientos- $asientosOcupados);
				else if($trip->nplazas!="") 
					echo elgg_echo('mytrips:seatsAvaible').": ".($trip->nplazas- $asientosOcupados);
				
				
				$nbultos = $trip->nbultos;
				$summaryPreOrderConfirmed=$trip->summaryPreOrderConfirmed;
				for ($i=2;$i<count($summaryPreOrderConfirmed);$i++)
				{
					if ($summaryPreOrderConfirmed[$i]=="1") {
						$ArrayPosConfirmados[]=$i;
					}
				}
				
				$summaryPreOrderConfirmed = $trip->summaryPreOrderBultos;
				$sum = 0;

				for ($i=0;$i<count($ArrayPosConfirmados);$i++)
				{
					$sum += $summaryPreOrderConfirmed[$ArrayPosConfirmados[$i]];
				} 
				
				$total = $nbultos-$sum;
				if($total<0) $total=0;

				$trip->bultosDisponibles = $total; //new dic16

				//Rosana: mostrar solo si paquetería... idem en buscador
				if ($trip->servicioPaqueteria == "custom:rating:si")
					echo "<br />".elgg_echo('mytrips:bultosDisponibles').": ".$total;
				/*echo "<br />".elgg_echo('package:bultosDisponibles').": ".$trip->bultosDisponibles;*/
			?>
			
			</p>

			<a id="showMap" href="#"><?php echo elgg_echo('mytrips:showMap'); ?></a>
			<div id="output"></div>
		</div>
	</div>
	<div class="mytrips-profile-fields elgg-body">
		<?php
			echo elgg_view('mytrips/profile/fields', $vars);
		?>
	
		<p class="odd"><b><?php echo elgg_echo('mytrips:distancia'); ?>: </b><span id="distancia"></span></p>
			<p class="even"><b><?php echo elgg_echo('mytrips:tiempo'); ?>: </b><span id="tiempo"></span></p>
			<!--<p class="odd"><b><?php //echo elgg_echo('mytrips:precio'); ?>: </b><span id="precio"></span> €</p>-->
	</div>
	
	<style>
#map {
        height: 450px;
		width:600px;
      }
</style>
    <div id="map"></div>
		<script>
			$(document).ready(function(){
				$("#showMap").click(function(){
					$("#map").toggle("slow");
				});
				
			});
		</script>
		<script>
		
		function initMap() 
		{
	  		var directionsService = new google.maps.DirectionsService;
	  		var directionsDisplay = new google.maps.DirectionsRenderer;
	  		var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 7,
				center: {lat: 37.17101383853488, lng: -3.6039181187454528}
	  		});
	  		directionsDisplay.setMap(map);

			function onChangeHandler() {
				calculateAndDisplayRoute(directionsService, directionsDisplay);
	  		}
	  		onChangeHandler();
	  
	  
	  		var distanceService = new google.maps.DistanceMatrixService();
			distanceService.getDistanceMatrix(
			{
				origins: ["<?php echo $trip->origen; ?>"],
				destinations: ["<?php echo $trip->destino; ?>"],
				travelMode: google.maps.TravelMode.DRIVING,
				unitSystem: google.maps.UnitSystem.METRIC,
				durationInTraffic: true,
				avoidHighways: false,
				avoidTolls: false
			},
			
			function (response, status) 
			{
				if (status !== google.maps.DistanceMatrixStatus.OK) {
					console.log('Error:', status);
				} else {
					$("#distancia").html(response.rows[0].elements[0].distance.text);
					$("#tiempo").html(response.rows[0].elements[0].duration.text);
					//$("#precio").html(((parseInt(response.rows[0].elements[0].distance.value)/1000)*0.0587).toFixed(2));
				}
			});
	  
		}

		function calculateAndDisplayRoute(directionsService, directionsDisplay) 
		{
	  		directionsService.route({
				origin: "<?php echo $trip->origen; ?>",
				destination: "<?php echo $trip->destino; ?>",
				/*waypoints: [
				{
		  		location:"Granada,Granada",
		  		stopover:true
				},{
		  		location:"Loja,Granada",
		  		stopover:true
				}],*/
			travelMode: google.maps.TravelMode.DRIVING
	  		}, 
	  		function(response, status) 
	  		{
				if (status === google.maps.DirectionsStatus.OK) {
		  			directionsDisplay.setDirections(response);
				} else {
		  			window.alert('Directions request failed due to ' + status);
				}
	  	});
	}
    </script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1vRLc27drd6AeU8U_SSu11yQflq7FR7g&signed_in=true&callback=initMap"
        async defer></script>

	
</div>
<?php
/*	//debugging
		$trip->summaryPreOrderUserGuid=null;
		$trip->summaryPreOrderTrayecto=null;
		$trip->summaryPreOrderBultos=null;
		$trip->summaryPreOrderConfirmed=null;
		if(!is_array($trip->summaryPreOrderUserGuid))
			{
				$trip->summaryPreOrderUserGuid = array('_','_');
			}
			if(!is_array($trip->summaryPreOrderTrayecto))
			{
				$trip->summaryPreOrderTrayecto = array('_','_');
			}
			if(!is_array($trip->summaryPreOrderBultos))
			{
				$trip->summaryPreOrderBultos = array('_','_');
			}
			if(!is_array($trip->summaryPreOrderConfirmed))
			{
				$trip->summaryPreOrderConfirmed = array('_','_');
			}
	elgg_log(" CREANDO \mytrips\views\default\mytrips\profile\summary","NOTICE");
	elgg_dump($trip);
*/

	if(!is_array($trip->follower))
	{
		$trip->follower = array('_','_');
	}
	if(!is_array($trip->preorder))
	{
		$trip->preorder = array('_','_');
	}
	if(!is_array($trip->confirmed))
	{
		$trip->confirmed = array('_','_');
	}
	if(!is_array($trip->grade))
	{
		$trip->grade = array('_','_');
	}

/*
	//debugging

	//copio en variable local
	elgg_log("(GENERAL)) trip->follower","NOTICE");
	elgg_dump($trip->follower);

	elgg_log("(GENERAL)) trip->preorder","NOTICE");
	elgg_dump($trip->preorder);

	elgg_log("(GENERAL)) trip->confirmed","NOTICE");
	elgg_dump($trip->confirmed);

	elgg_log("(GENERAL)) trip->grade","NOTICE");
	elgg_dump($trip->grade);
*/

/*
	//debugging

	$trip->summaryPreOrderUserGuid=array('_','_',81);
	$trip->summaryPreOrderTrayecto=array('_','_','custom:trayecto:vuelta');
	$trip->summaryPreOrderBultos=array('_','_',0);
	$trip->summaryPreOrderConfirmed=array('_','_',1);

	elgg_dump($trip->summaryPreOrderUserGuid);
	elgg_dump($trip->summaryPreOrderTrayecto);
	elgg_dump($trip->summaryPreOrderBultos);
	elgg_dump($trip->summaryPreOrderConfirmed);
*/

?>

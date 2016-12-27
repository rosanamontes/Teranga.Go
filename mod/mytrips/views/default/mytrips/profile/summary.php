<?php header('Access-Control-Allow-Origin: *');  
/**
 * profile summary: Icon and profile fields
 *
 * @uses $vars['group']
 *
* 	Plugin: mytripsTeranga
*	Author: Rosana Montes Soldado from previous version of @package ElggGroups
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
*/

if (!isset($vars['entity']) || !$vars['entity']) {
	echo elgg_echo('mytrips:notfound');
	return true;
}

$group = $vars['entity'];
$owner = $group->getOwnerEntity();

if (!$owner) {
	// not having an owner is very bad so we throw an exception
	$msg = "Sorry, '" . 'trip owner' . "' does not exist for guid:" . $group->guid;
	throw new InvalidParameterException($msg);
}

?>
<div class="mytrips-profile clearfix elgg-image-block">
	<div class="elgg-image">
		<div class="mytrips-profile-icon">
			<?php
				// we don't force icons to be square so don't set width/height
				echo elgg_view_entity_icon($group, 'large', array(
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
				$num_members = $group->getMembers(array('count' => true));
				/*CAMBIA N MIEMBROS DEL GRUPO*/
				echo elgg_echo('mytrips:members') . ": " .$num_members."<br />";
				
				//Asientos usados
				$asientosOcupados=0;
				$summaryPreOrderConfirmed=$group->summaryPreOrderConfirmed;
				$summaryPreOrderBultos=$group->summaryPreOrderBultos;
				$summaryPreOrderTrayecto=$group->summaryPreOrderTrayecto;
				for($i=2;$i<count($summaryPreOrderConfirmed);$i++)
					{
						if($summaryPreOrderConfirmed[$i]=="1" && $summaryPreOrderTrayecto[$i]!="-1" ) {
							$asientosOcupados++;
						}
					}
				/*
				if($group->preorder!="") $asientosOcupados+=count($group->preorder)-2;
				if($group->confirmed!="") {
					$cont=0;
					$summaryPreOrderConfirmed=$group->summaryPreOrderConfirmed;
					$summaryPreOrderBultos=$group->summaryPreOrderBultos;
					$summaryPreOrderTrayecto=$group->summaryPreOrderTrayecto;
					
					for($i=2;$i<count($summaryPreOrderConfirmed);$i++)
					{
						if($summaryPreOrderBultos[$i] > 0 && $summaryPreOrderTrayecto[$i]==-1) $cont++;
					}
					
					$asientosOcupados+=count($group->confirmed)-2-$cont;					
				}*/
				
				if($owner->nAsientos!="")	echo elgg_echo('mytrips:seatsAvaible').": ".($owner->nAsientos- $asientosOcupados);
				else if($group->nplazas!="") echo elgg_echo('mytrips:seatsAvaible').": ".($group->nplazas- $asientosOcupados);
				
				
				$nbultos=$group->nbultos;
				$summaryPreOrderConfirmed=$group->summaryPreOrderConfirmed;
				for($i=2;$i<count($summaryPreOrderConfirmed);$i++)
				{
					if ($summaryPreOrderConfirmed[$i]=="1") {
						$ArrayPosConfirmados[]=$i;
					}
				}
				
				$summaryPreOrderConfirmed=$group->summaryPreOrderBultos;
				$sum=0;

				for($i=0;$i<count($ArrayPosConfirmados);$i++)
				{
					$sum+=$summaryPreOrderConfirmed[$ArrayPosConfirmados[$i]];
					
				} 
				
				$total=$nbultos-$sum;
				if($total<0) $total=0;

				//Rosana: en el formulario de pre-reserva este campo esta en blanco
				$group->bultosDisponibles = $total;

				//Rosana: mostrar solo si paquetería... idem en buscador
				if ($group->servicioPaqueteria == "custom:rating:si")
					echo "<br />".elgg_echo('mytrips:bultosDisponibles').": ".$total;
				/*echo "<br />".elgg_echo('package:bultosDisponibles').": ".$group->bultosDisponibles;*/
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
		
		function initMap() {
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
				distanceService.getDistanceMatrix({
					origins: ["<?php echo $group->origen; ?>"],
					destinations: ["<?php echo $group->destino; ?>"],
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
						$("#distancia").html(response.rows[0].elements[0].distance.text);
						$("#tiempo").html(response.rows[0].elements[0].duration.text);
						//$("#precio").html(((parseInt(response.rows[0].elements[0].distance.value)/1000)*0.0587).toFixed(2));
					}
				});
	  
	}

	function calculateAndDisplayRoute(directionsService, directionsDisplay) {
	  directionsService.route({
		origin: "<?php echo $group->origen; ?>",
		destination: "<?php echo $group->destino; ?>",
		/*waypoints: [
		{
		  location:"Granada,Granada",
		  stopover:true
		},{
		  location:"Loja,Granada",
		  stopover:true
		}],*/
		travelMode: google.maps.TravelMode.DRIVING
	  }, function(response, status) {
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
/*
		$group->summaryPreOrderUserGuid=null;
		$group->summaryPreOrderTrayecto=null;
		$group->summaryPreOrderBultos=null;
		$group->summaryPreOrderConfirmed=null;
		if(!is_array($group->summaryPreOrderUserGuid))
			{
				$group->summaryPreOrderUserGuid = array('_','_');
			}
			if(!is_array($group->summaryPreOrderTrayecto))
			{
				$group->summaryPreOrderTrayecto = array('_','_');
			}
			if(!is_array($group->summaryPreOrderBultos))
			{
				$group->summaryPreOrderBultos = array('_','_');
			}
			if(!is_array($group->summaryPreOrderConfirmed))
			{
				$group->summaryPreOrderConfirmed = array('_','_');
			}
*/
/*elgg_log(" CREANDO \mytrips\views\default\mytrips\profile\summary","NOTICE");
elgg_dump($group);*/
	if(!is_array($group->follower))
	{
		$group->follower = array('_','_');
	}
	if(!is_array($group->preorder))
	{
		$group->preorder = array('_','_');
	}
	if(!is_array($group->confirmed))
	{
		$group->confirmed = array('_','_');
	}
	if(!is_array($group->grade))
	{
		$group->grade = array('_','_');
	}
//copio en variable local
/*elgg_log("(GENERAL)) group->follower","NOTICE");
elgg_dump($group->follower);
elgg_log("(GENERAL)) group->preorder","NOTICE");
elgg_dump($group->preorder);
elgg_log("(GENERAL)) group->confirmed","NOTICE");
elgg_dump($group->confirmed);*//*
elgg_log("(GENERAL)) group->grade","NOTICE");
elgg_dump($group->grade);*/

/*
$group->summaryPreOrderUserGuid=array('_','_',81);
$group->summaryPreOrderTrayecto=array('_','_','custom:trayecto:vuelta');
$group->summaryPreOrderBultos=array('_','_',0);
$group->summaryPreOrderConfirmed=array('_','_',1);
*/
/*
elgg_dump($group->summaryPreOrderUserGuid);
elgg_dump($group->summaryPreOrderTrayecto);
elgg_dump($group->summaryPreOrderBultos);
elgg_dump($group->summaryPreOrderConfirmed);
*/

?>

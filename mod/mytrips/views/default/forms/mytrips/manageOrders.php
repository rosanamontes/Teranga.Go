<script 
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<link href="<?php echo elgg_get_site_url()."mod/"; ?>myTrips/css/bootstrap.css" rel="stylesheet" >

<?php
/**
 * Elgg myTrips manageOrders form
 *
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

$trip = $vars['entity'];// trip owners
$forward_url = $trip->getURL();

/* debugging
$owner = $trip->getOwnerEntity();
$friends = elgg_get_logged_in_user_entity()->getFriends(array('limit' => 0));

elgg_dump($trip->preorder);
elgg_dump($trip->confirm);
*/
for ($i=2;$i<count($trip->summaryPreOrderUserGuid);$i++)
{
	if($trip->summaryPreOrderConfirmed[$i]==0) 
	{
		$user =get_user($trip->summaryPreOrderUserGuid[$i]);
		/*elgg_dump($user);*/

		//empty custom fields always have print some value
		if ($user->dios == "") 
			$showdios = elgg_echo("custom:empty");
		else
			$showdios = elgg_echo($user->dios);

		if ($user->religioso == "") 
			$showreligioso = elgg_echo("custom:empty");
		else
			$showreligioso = elgg_echo($user->religioso);

		if ($user->humo == "") 
			$showhumo = elgg_echo("custom:empty");
		else
			$showhumo = elgg_echo($user->humo);

		if ($user->fumador == "") 
			$showfumador = elgg_echo("custom:empty");
		else
			$showfumador = elgg_echo($user->fumador);
	?>
	<div class="col-md-12" style="border-bottom:2px solid #CCC;">
		<div class="col-md-1 foto">
			<img class="img-responsive" src="<?php echo get_entity_icon_url($user,'medium'); ?>">
		</div>
		<div class="col-md-6 descViajero">
			<div class="col-md-12">
				<h4><a href="<?php echo elgg_get_site_url()."profile/".$user->name ?>"><strong><?php echo $user->name; ?></strong></a></h4>
			</div>
			<div class="col-md-12 textoDentro">
					
	<?php 
		$summaryPreOrderUserGuid=$trip->summaryPreOrderUserGuid;
		$summaryPreOrderTrayecto=$trip->summaryPreOrderTrayecto;
		$summaryPreOrderBultos = $trip->summaryPreOrderBultos;
						
		$clave=array_search($user->guid,$summaryPreOrderUserGuid);
		if (($summaryPreOrderTrayecto[$clave]!=-1 && $summaryPreOrderBultos[$clave]!=0) || ($summaryPreOrderTrayecto[$clave]!=-1 && $summaryPreOrderBultos[$clave]!=0) ) 
		{ 
	?>
			<?php echo elgg_echo("profile:dios").": "; echo $showdios; ?><br />
			<?php echo elgg_echo("profile:religioso").": ";echo $showreligioso; ?><br />
			<?php echo elgg_echo("profile:humo").": ";echo $showhumo; ?><br />
			<?php echo elgg_echo("profile:fumador").": ";echo $showfumador; ?><br />
	<?php 
		}
		
		if ($summaryPreOrderBultos[$clave]!=0)
		{
			echo elgg_echo('mytrips:summaryPreOrder:numBultos').": ";echo $summaryPreOrderBultos[$clave];
		}
						
		if ($summaryPreOrderTrayecto[$clave]!=-1)
		{
			echo "<br />".elgg_echo('mytrips:summaryPreOrder:Elijo').": ";echo elgg_echo($summaryPreOrderTrayecto[$clave]);
		}
					
	?>
			</div>
		</div>
		<div class="col-md-2 opciones">
			
		<input id="btn-<?php echo $user->guid;?>" userguid="<?php echo $user->guid;?>" type="button" class="col-md-12 btn btn-info" value="<?php echo elgg_echo('mytrips:manageOrders:confirmar'); ?>"/>
		</div>
	</div>

<?php 

	} //if
 }//for 

?>

<style>
.foto,.descViajero,.opciones{
	min-height:93px;
	/*border:1px solid green;*/
}
.foto img{
	margin-top:15px;
}
.opciones .btn{
	margin-top:21px;
}
</style>
<script>
$(document).ready(function()
{
	$("[type='button']").on('click', function()
	{	
		var userguid=$(this).attr("userguid");
		
		if($(this).hasClass("btn-info")) 
		{
			$.post("<?php echo elgg_get_site_url(); ?>services/api/rest/json/?method=trip.confirmWeb",
			{
				userguid:userguid,tripid:"<?php echo $trip->guid; ?>"
			},
			function(data, status)
			{
				if(data.status==0 && data.result.success)
				{
					$("#btn-"+userguid).removeClass("btn-info").addClass("btn-warning").attr("value","<?php echo elgg_echo('mytrips:manageOrders:desconfirmar'); ?>");
					elgg.system_message(elgg.echo('mytrips:manageOrders:confirmadoOk'));
				}
				else 
				{
					elgg.register_error(elgg.echo('mytrips:manageOrders:confirmadoKo'));
				}
			});
		}
		else if ($(this).hasClass("btn-warning"))
		{
			$.post("<?php echo elgg_get_site_url(); ?>services/api/rest/json/?method=trip.unconfirmWeb",
			{
				userguid:userguid,tripid:"<?php echo $trip->guid; ?>"
			},
			function(data, status)
			{
				if(data.status==0  && data.result.success)
				{
					$("#btn-"+userguid).removeClass("btn-warning").addClass("btn-info").attr("value","<?php echo elgg_echo('mytrips:manageOrders:confirmar'); ?>");
					elgg.system_message(elgg.echo('mytrips:manageOrders:desconfirmadoOk'));
				}	
				else 
				{
					elgg.register_error(elgg.echo('mytrips:manageOrders:desconfirmadoKo'));
				}
			});	
		}
	});
});
</script>
<?php
echo "<div class=\"col-md-12\">";
echo elgg_view('input/hidden', array('name' => 'trip_guid', 'value' => $trip->guid));
echo elgg_view('input/submit', array('value' => elgg_echo('mytrips:manageOrders:save')));
echo"<div>";

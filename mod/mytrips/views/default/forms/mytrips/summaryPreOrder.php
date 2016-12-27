<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<link href="<?php echo elgg_get_site_url()."mod/"; ?>mytrips/css/bootstrap.css" rel="stylesheet" >

<?php
/**
 * Teranga Go! summaryPreOrder form
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

 // group owners
$group = $vars['entity'];
//$owner = $group->getOwnerEntity();
$forward_url = $group->getURL();
?>
 <?php echo elgg_echo('mytrips:name').": ".$group->name; ?><br />
<?php echo elgg_echo('busqueda:OrigenyDestino').": ".$group->origen." - ".$group->destino; ?><br />
<?php echo elgg_echo('mytrips:trayecto').": ".elgg_echo($group->trayecto); ?><br />
<?php echo elgg_echo('mytrips:fechaIda').": ".date("d / m / Y", strtotime($group->fechaIda)); ?><br />
<?php 
if($group->trayecto!="custom:trayecto:ida"){ ?>
<?php echo elgg_echo('mytrips:fechaVuelta').": ".date("d / m / Y", strtotime($group->fechaVuelta)); ?><br />	
<?php } ?>
<?php echo elgg_echo('mytrips:servicioPaqueteria').": ".elgg_echo($group->servicioPaqueteria); ?><br />
<?php echo elgg_echo('mytrips:bultosDisponibles').": ".$group->bultosDisponibles; ?><br />
<br/>
<?php

if ($group->servicioPaqueteria=="custom:rating:si"){
echo "&nbsp;&nbsp;".elgg_echo('mytrips:summaryPreOrder:Elijo').": ";
echo elgg_view('input/select', array(
   'required' => true,
   'name' => 'opcion',
   'options_values' => array(
      '2' => elgg_echo('mytrips:summaryPreOrder:ViajaBulto'),
	  '1' => elgg_echo('mytrips:summaryPreOrder:ViajoYOBulto'),
	  '0' => elgg_echo('mytrips:summaryPreOrder:ViajoYO')
      
	  
   )));
?>
<br />

<div id="numBultos">
<?php echo elgg_echo('mytrips:summaryPreOrder:numBultos').": ";
echo elgg_view('input/text', array('name' => 'bultos','value'=>'0'));
 ?>

</div>
<script>
<?php $nbultos=$group->nbultos;
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
if($total<0){$total=0;}
?>
$(document).ready(function(){
	var nbultos="<?php echo $total; ?>";
	
	$("[name='bultos']").blur(function(){
		if($(this).val()=="" || $(this).val()<0 || $(this).val()>nbultos)
		{
			alert("<?php echo elgg_echo('mytrips:summaryPreOrder:numBultos:Wrong'); ?>");
		}
	});
	
	$("#tipoViaje").hide();
	$("[name='opcionViaje']").val("<?php echo $group->trayecto; ?>");
	$("[name='opcion']").change(function(){
		if($(this).attr("value")=="0"){
			$("#numBultos").hide();
			$("#tipoViaje").show();
			//if ($('[name="opcionViaje"]').val()=="custom:trayecto:ida"){
				$("#aportacionViajero").show();
			/*} else {
				$("#aportacionViajero").hide();
			}*/
		}
		else if ($(this).attr("value")=="1"){
			$("#numBultos").show();
			$("#tipoViaje").show();
			//if ($('[name="opcionViaje"]').val()=="custom:trayecto:ida"){
				$("#aportacionViajero").show();
			/*} else {
				$("#aportacionViajero").hide();
			}*/
		}
		else if ($(this).attr("value")=="2"){
			$("#numBultos").show();
			$("#tipoViaje").hide();
			$("#aportacionViajero").hide();
		}
	});
	$("[name='opcionViaje']").change(function(){
		var aportacion="<?php echo $group->aportacionViajero; ?>";
		var trayectoViaje="<?php echo $group->trayecto; ?>";
		var posicionFinal = parseInt(aportacion.indexOf('.')+3);
		var rest = aportacion.substr(0, posicionFinal);
		
		if($(this).val()=="custom:trayecto:ida")
		{
			$("#spanAportacionViajero").html((rest/2)+" €");
		}
		else
		{
			$("#spanAportacionViajero").html(rest+" €");
		}
		
	});
	$( "form" ).submit(function() {
		if($("[name='bultos']").val()=="" || $("[name='bultos']").val()<0 || $("[name='bultos']").val()>nbultos)
		{
			alert("<?php echo elgg_echo('mytrips:summaryPreOrder:numBultos:Wrong'); ?>");
			return false;
		}
	});
});
</script>
<?php	
} ?>

<div id="tipoViaje">
<?php 
if($group->trayecto=="custom:trayecto:vuelta"){
	echo elgg_echo('mytrips:summaryPreOrder:ElijoViajar').": ";
echo elgg_view('input/select', array(
   'name' => 'opcionViaje',
   'options_values' => array(
      'custom:trayecto:ida' => elgg_echo('custom:trayecto:ida'),
      'custom:trayecto:vuelta' => elgg_echo('custom:trayecto:vuelta')
   )));
}

echo "<div id=\"aportacionViajero\"><br />".elgg_echo('mytrips:aportacionViajero').": <span id=\"spanAportacionViajero\">".$group->aportacionViajero."<span><br /></div>";
echo "</div>";

echo "<br/><div class=\"col-md-12\">";
echo elgg_view('input/hidden', array('name' => 'group_guid', 'value' => $group->guid));
echo elgg_view('input/submit', array('value' => elgg_echo('mytrips:manageOrders:save')));
echo"<div>";


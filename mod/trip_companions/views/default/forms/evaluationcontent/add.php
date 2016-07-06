<?php

/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: Dialogo para introducir una valoración. 
*	Usa cuatro criterios, [pesos por defecto usuario], dos respuestas públicas y un texto libre
*
*/

$url = get_input('profile', "");
$trip = get_input('trip', "");//guid del trip
$uid = get_input('uid', "");
//$name = get_input('name', "");--no me llega bien este valor

$entity = get_entity($trip);
$user = get_user($uid);
$name = $user->name;
$title = $name . " - " . $entity->name; //se valorará al usuario en mas de un trip, pero no más de una vez usuario-usuario

$C1 = "private1";
$C2 = "private2";
$C3 = "private3";
$C4 = "private4";
$C5 = "public1";
$C6 = "public2";
$description = get_input('name', "");

$validation_msg1 = elgg_echo('evaluationcontent:validation:consecutive');
$validation_msg2 = elgg_echo('evaluationcontent:validation:mandatory');
$uno = elgg_echo('evaluationcontent:validation:criterion1');
$dos = elgg_echo('evaluationcontent:validation:criterion2');
$tres = elgg_echo('evaluationcontent:validation:criterion3');
$cuatro = elgg_echo('evaluationcontent:validation:criterion4');

//user's criteria weights
$owner = elgg_get_logged_in_user_entity();//the expert

$W1=$owner->reason1;
if (empty($W1)) $W1 = 100;//full and all the same

$W2=$owner->reason2;
if (empty($W2)) $W2 = 100;//full and all the same

$W3=$owner->reason3;
if (empty($W3)) $W3 = 100;//full and all the same

$W4=$owner->reason4;
if (empty($W4)) $W4 = 100;//full and all the same
//system_message($W1 . " mis pesos ". $W4);

$opinion = array(
	1 => elgg_echo('hflts:settings:yes'), 
	0 => elgg_echo('hflts:settings:no'),
	-1 => elgg_echo('evaluationcontent:notevaluated'),	
	);

$scale3 = array(
//	elgg_echo('evaluationcontent:notevaluated') => -1,	
	elgg_echo('evaluationcontent:scale3:s0') => 0,
	elgg_echo('evaluationcontent:scale3:s1') => 1,
	elgg_echo('evaluationcontent:scale3:s2') => 2, 
	);

$scale5 = array(
//	elgg_echo('evaluationcontent:notevaluated') => -1,	
	elgg_echo('evaluationcontent:scale5:s0') => 0,
	elgg_echo('evaluationcontent:scale5:s1') => 1,
	elgg_echo('evaluationcontent:scale5:s2') => 2,
	elgg_echo('evaluationcontent:scale5:s3') => 3,
	elgg_echo('evaluationcontent:scale5:s4') => 4, 
	);

$scale7 = array(
//	elgg_echo('evaluationcontent:notevaluated') => -1,	
	elgg_echo('evaluationcontent:scale7:s0') => 0,
	elgg_echo('evaluationcontent:scale7:s1') => 1,
	elgg_echo('evaluationcontent:scale7:s2') => 2,
	elgg_echo('evaluationcontent:scale7:s3') => 3,
	elgg_echo('evaluationcontent:scale7:s4') => 4,
	elgg_echo('evaluationcontent:scale7:s5') => 5,
	elgg_echo('evaluationcontent:scale7:s6') => 6, 
	);

//check the scale
if (elgg_is_active_plugin('hflts')) 
	$termnumber = elgg_get_plugin_setting('termset', 'hflts');//system_message("#" . $termnumber);
else 
	$termnumber = 1;
	
switch ( $termnumber )
{
	case '0':
		$scale = $scale3;
		$G = 2;
		break;
	case '1':
		$scale = $scale5;
		$G = 4;
		break;
	case '2':
		$scale = $scale7;
		$G = 6;
		break;
	default:
		$scale = $scale5;
		$G = 4;
		break;
}

?>
<div id="evaluation">
<div class="elgg-form-row">
	<label>
		<?php
			echo elgg_echo('evaluationcontent:objecttitle');
			echo elgg_view('input/text', array(
				'name' => 'title',//solo se usa aqui
				'value' => $title,
				'disabled' => true, //en true no manda el valor al action
			));
			echo elgg_view('input/hidden', array(
				'name' => 'name',
				'value' => $name,
			));		
			echo elgg_view('input/hidden', array(
				'name' => 'url',
				'value' => $url,
			));		
			echo elgg_view('input/hidden', array(
				'name' => 'uid',
				'value' => $uid,
			));					
			echo elgg_view('input/hidden', array(
				'name' => 'trip',
				'value' => $trip,
			));
			echo elgg_view('input/hidden', array(
				'name' => 'granularity',
				'value' => $G,
			));									
			echo elgg_view('input/hidden', array(
				'name' => 'W1',
				'value' => $W1,
			));									
			echo elgg_view('input/hidden', array(
				'name' => 'W2',
				'value' => $W2,
			));									
			echo elgg_view('input/hidden', array(
				'name' => 'W3',
				'value' => $W3,
			));									
			echo elgg_view('input/hidden', array(
				'name' => 'W4',
				'value' => $W4,
			));									
		?>
	</label>

</div>
<div class="elgg-module-featured rounded">
	<div class="elgg-head">
		<?php 
			echo "<h4>".elgg_echo('evaluationcontent:reason1')."</h4>";
		?>
	</div>
	<div class="elgg-body">
		<?php 
			echo elgg_view('input/checkboxes', array(
				'name' => 'C1',
				'id' => 'C1',
				'options' => $scale,
				'align' => 'horizontal',
				'value' => '-1',
			));
			echo '<span class="elgg-text-help">' . elgg_echo("evaluationcontent:help:reason1") . '</span>';
		?>
	</div>
</div>
<div class="elgg-module-featured rounded">
	<div class="elgg-head">
		<?php 
			echo "<h4>".elgg_echo('evaluationcontent:reason2')."</h4>";
		?>
	</div>
	<div class="elgg-body">
		<?php 
			echo elgg_view('input/checkboxes', array(
				'name' => 'C2',
				'id' => 'C2',
				'options' => $scale,
				'align' => 'horizontal',
				'value' => -1,
			));
			echo '<span class="elgg-text-help">' . elgg_echo("evaluationcontent:help:reason2") . '</span>';
		?>
	</div>
</div>
<div class="elgg-module-featured rounded">
	<div class="elgg-head">
		<?php 
			echo "<h4>".elgg_echo('evaluationcontent:reason3')."</h4>";
		?>
	</div>
	<div class="elgg-body">
		<?php 
			echo elgg_view('input/checkboxes', array(
				'name' => 'C3',
				'id' => 'C3',
				'options' => $scale,
				'align' => 'horizontal',
				'value' => -1,
			));
			echo '<span class="elgg-text-help">' . elgg_echo("evaluationcontent:help:reason3") . '</span>';

		?>
	</div>
</div>
<div class="elgg-module-featured rounded">
	<div class="elgg-head">
		<?php 
			echo "<h4>".elgg_echo('evaluationcontent:reason4')."</h4>";
		?>
	</div>
	<div class="elgg-body">
		<?php 
			echo elgg_view('input/checkboxes', array(
				'name' => 'C4',
				'id' => 'C4',
				'options' => $scale,
				'align' => 'horizontal',
				'value' => -1,
			));
			echo '<span class="elgg-text-help">' . elgg_echo("evaluationcontent:help:reason4") . '</span>';
		?>
	</div>
</div>


<div class="elgg-module-featured rounded">
	<div class="elgg-head">
		<?php 
			echo "<h4>".elgg_echo('evaluationcontent:reason5')."</h4>";
		?>
	</div>
	<div class="elgg-body">
		<?php 
			echo elgg_view("input/dropdown", array(
				'name' => 'C5',
				'id' => 'C5',
				'options_values' => $opinion,
				'value' => -1,
				'class' => $class,
				'readonly' => false,
			));
			echo '<span class="elgg-text-help">' . elgg_echo("evaluationcontent:help:reason5") . '</span>';
		?>
	</div>
</div>
<div class="elgg-module-featured rounded">
	<div class="elgg-head">
		<?php 
			echo "<h4>".elgg_echo('evaluationcontent:reason6')."</h4>";
		?>
	</div>
	<div class="elgg-body">
		<?php ;
			echo elgg_view("input/dropdown", array(
				'name' => 'C6',
				'id' => 'C6',
				'options_values' => $opinion,
				'value' => -1,
				'class' => $class,
				'readonly' => false,
			));
			echo '<span class="elgg-text-help">' . elgg_echo("evaluationcontent:help:reason5") . '</span>';
		?>
	</div>
</div>
<div class="elgg-form-input">
	<label>
		<?php 	
		echo elgg_echo('evaluationcontent:description');
		echo elgg_view('input/plaintext',array(
			'name' => 'description',
			'value' => $description,
		));
	?>
	</label>
</div>

</div> <!--container evaluation-->

<div class="elgg-foot">
	<?php
		echo elgg_view('input/submit', array(
			'value' => elgg_echo('evaluationcontent:report'),
		));
		echo elgg_view('input/button', [
			'class' => 'elgg-button-cancel mls',
			'value' => elgg_echo('cancel'),
		]);
	?>
</div>

<script>

	$(document).ready(function()
	{	
		$(function() {
			$(".elgg-button-submit").click(function() 
			{
				/* Note that typeof $(this) is JQuery object and typeof $(this)[0] is HTMLElement object 
			    var checkbox_value = "";
			    $(":checkbox").each(function () {
			        var ischecked = $(this).is(":checked");
			        if (ischecked) {
			            checkbox_value += $(this).attr('name') + " = " +  $(this).val() + "\n";
			        }
			    });
			    console.log(checkbox_value);
			    */	
				return getSelectedChbox(this.form);
		    });
		});

		function getSelectedChbox(frm) 
		{
			"use strict"

  			var selchbox1 = []; 
  			var selchbox2 = []; 
  			var selchbox3 = []; 			
  			var selchbox4 = []; 			
			var inpfields = frm.getElementsByTagName('input');
  			var nr_inpfields = inpfields.length;

			for(var i=0; i<nr_inpfields; i++) 
			{
				if(inpfields[i].type == 'checkbox' && inpfields[i].checked == true) 
				{
					if (inpfields[i].name == 'C1[]') 		selchbox1.push(inpfields[i].value);
					if (inpfields[i].name == 'C2[]')		selchbox2.push(inpfields[i].value);
					if (inpfields[i].name == 'C3[]')		selchbox3.push(inpfields[i].value);
					if (inpfields[i].name == 'C4[]')		selchbox4.push(inpfields[i].value); 
				}
			}
  			
  			var msg = '<?php echo $validation_msg1; ?>';
  			var oblig = '<?php echo $validation_msg2; ?>';
  			var uno = '<?php echo $uno; ?>';
  			var dos = '<?php echo $dos; ?>';
  			var tres = '<?php echo $tres; ?>';
  			var cuatro = '<?php echo $cuatro; ?>';

			var validC1 = validar(selchbox1);
			if (validC1 == 1)
			{
				alert(msg + uno);
				return false;	
			} 
			else if (validC1 == 2)
			{
				alert(oblig + uno);
				return false;	
			}

			var validC2 = validar(selchbox2);
			if (validC2 == 1)
			{
				alert(msg + dos);
				return false;
			}
			else if (validC2 == 2)
			{
				alert(oblig + dos);
				return false;	
			}

			var validC3 = validar(selchbox3);
			if (validC3 == 1)
			{
				alert(msg + tres);
				return false;
			}
			else if (validC3 == 2)
			{
				alert(oblig + tres);
				return false;	
			}

			var validC4 = validar(selchbox4);
			if (validC4 == 1)
			{
				alert(msg + cuatro);
				return false;
			}
			else if (validC4 == 2)
			{
				alert(oblig + cuatro);
				return false;	
			}

			function validar(box)
			{
				var code = 2;
				for (var i=0; i<box.length; i++)
				{
					code = 0;
					if (i!=0 && box[i-1]!=eval(box[i]-1))
					{			
						console.log("Los check "+box+" no son consecutivos");
						code = 1;
					}
				}
				console.log(box);
				return code;
  			}

			return true;
		}
	});

</script>

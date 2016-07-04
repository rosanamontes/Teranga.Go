<?php

/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	HFLTS in a ELGG community: Teranga Go! CEI BioTIC project
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	Date: july 2016
*	
*	File: Hesitant Operators
*/

//________________________________________________________________________

//_____________________ > HLWA aggregation operator < ____________________
//________________________________________________________________________

/**
* Operators and Comparisons of Hesitant Fuzzy Linguistic Term Sets
* IEEE TRANSACTIONS ON FUZZY SYSTEMS, VOL. 22, NO. 3, JUNE 2014
* C. Wei, N. Zhao, and X. Tang. 
*
* Input: linguistic intervals, normalized weights (several uses... criteria weights, experts weights o ranking weights), G
* Output: an hesitant resulting of aggregation of several linguistic intervals
*/

function aggregationHLWA($data, $weights, $granularity)
{
	//two step aggregation processs
	$ranking = rankingHesitantsWithPossibilityDegree($data);
	$hesitants = array();
	convertEnvelopes($ranking, $hesitants);

	$H =  computeHLWA($hesitants, $weights, $granularity);
	//echo('<hr>aggregationHLWA<pre>');	print_r($H);	echo('</pre>');
	return $H;
}

function exampleHesitantAggegation()
{
	$debug = false;
	$granularity = 6;

	//	H1={2,3,4}	H2={4,5}	H3={3}	rankingWeight (0.25,0.5,0.25) => C³(h2,h3,h1) = {3,4}
	$example_1 = array(['inf'=>2, 'sup'=>4],['inf'=>4,'sup'=>5],['inf'=>3,'sup'=>3]);
	$rankingWeight_1 = array(0.25,0.5,0.25);

	//	H1={1,2,3}	H2={4,5}	H3={4}	rankingWeight (1,0,0) => HLWA(h1,h2,h3) = C^3(1, h2, 0, h3, 0, h1) = h2 = {4,5}
	$example_2 = array(['inf'=>1, 'sup'=>3],['inf'=>4,'sup'=>5],['inf'=>4,'sup'=>4]);
	$rankingWeight_2 = array(1,0,0);

	//	H1={2,3}	H2={3}	H3={0,1,2}	rankingWeight (1,0,0) => HLWA(h1,h2,h3) = C^3(1, h2, 0, h1, 0, h3) = h2 = {3}
	$example_3 = array(['inf'=>2, 'sup'=>3],['inf'=>3,'sup'=>3],['inf'=>0,'sup'=>2]);
	$rankingWeight_3 = array(1,0,0);

	//	H1={4,5,6}	H2={1,2}	H3={4,5,6}	rankingWeight (1,0,0) => HLWA(h1,h2,h3) = C^3(1, h3, 0, h1, 0, h2) = h3 = {4,5,6}
	$example_4 = array(['inf'=>4, 'sup'=>6],['inf'=>1,'sup'=>2],['inf'=>4,'sup'=>6]);
	$rankingWeight_4 = array(1,0,0);

	//	H1={2}	H2={3}	H3={3}	H4={4}	rankingWeight (same) => HLWA(h1,h2,h3,h4) = C^4(h, h, h, h, h) = {}
	$example_5 = array(['inf'=>2, 'sup'=>2],['inf'=>3, 'sup'=>3],['inf'=>3, 'sup'=>3],['inf'=>4,'sup'=>4]);
	$w = 1.0/4.0;//all the same
	$rankingWeight_5 = array($w,$w,$w,$w);

	//	H1={3,4,5}	H2={4,5,6}	H3={5}	H4={1,2,3}	H5={3,4}	rankingWeight (same) => HLWA(h1,h2,h3,h4,h5) = C^5(h, h, h, h, h) = {}
	$example_6 = array(['inf'=>3, 'sup'=>5],['inf'=>4, 'sup'=>6],['inf'=>5, 'sup'=>5],['inf'=>1,'sup'=>3],['inf'=>3,'sup'=>4]);
	$w = 1.0/5.0;//all the same
	$rankingWeight_6 = array($w,$w,$w,$w,$w);


	//set what to do and run
	$runSample = $example_6;
	$weights = $rankingWeight_6;
	$N = 5;//manual change the example size!
	//..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-

	if ($debug) 
	{
		echo "Step 0: collect data<br>";
		for ($i=0;$i<$N;$i++)
			echo "[".$runSample[$i]['inf'].",".$runSample[$i]['sup']."] &  not-to-data-weight = " . $weights[$i] . "<br>";
	}

	//two step aggregation processs
	$ranking = rankingHesitantsWithPossibilityDegree($runSample);
	$hesitants = array();
	convertEnvelopes($ranking, $hesitants);

	if ($debug) 
	{ 	
		echo('<hr>Ranking<pre>');	print_r($ranking);	echo('</pre>');
		echo('<hr>Hesitants<pre>');	print_r($hesitants);	echo('</pre>');
	}

	$singleH = computeHLWA($hesitants, $weights, $granularity);
	if ($debug) 
	{ 	
		echo('<hr>operatorHLWA()=<pre>');	print_r($singleH);	echo('</pre>');
	}
	
}


	function rankingHesitantsWithPossibilityDegree($envelopes)
	{
		$debug=false;
		$n = sizeof($envelopes); //	system_message("n " . $n);

		//data for step 1
		$l=0;
		$indexes = array();//like envelope but consecutive
		$degree = array();//P matrix
		//data for step 2
		$relation = array();//U matrix
		$I = array();
		$V = array();
		// output data
		$ranking = array();

		for ($i=0;$i<$n;$i++)
		{
			if ($debug) echo "[".$envelopes[$i]['inf'].",".$envelopes[$i]['sup']."] ";

			$indexes[$l] = $envelopes[$i]['inf'];
			$indexes[$l+1] = $envelopes[$i]['sup'];	
				
			$l = $l+2;
		}
		//echo('<pre>');	print_r($indexes);	echo('</pre>');
		
		if ($debug) echo "<br>Step 1: compute the possibility matrix P<br>";

		//possibility degree matrix P
		for($i=0;$i<$n;$i++)
	    for($j=$i;$j<$n;$j++)
	    {
	    	if ($i!=$j)
	    	{ 
	    		$degree[$i][$j] = computePossibility( $indexes[$i*2], $indexes[$i*2+1], $indexes[$j*2], $indexes[$j*2+1] );
	    		//echo '<br>['. $i . ',' . $j . '] ' . $degree[$i][$j];
	    		$degree[$j][$i] = 1 - $degree[$i][$j] ;
	    		//echo '<br>['. $j . ',' . $i . '] ' . $degree[$j][$i];
	    	}
	    	else $degree[$i][$j] = 0.5;
	    }
	    	
	    if ($debug) 
	    {
	    	echo('<br><pre>');	print_r($degree);	echo('</pre>');
	    	echo "Step 2: preference relation matrix ($n)<br>";
		}

		//preference relation matrix U
		for($i=0;$i<$n;$i++)
		{
	   		for($j=0;$j<$n;$j++)
	   		{
				if($degree[$i][$j]>=0.5)
					$relation[$i][$j]=1.0;
				else
					$relation[$i][$j]=0.0;
				//echo ' -> ['. $i . ',' . $j . '] ' . $relation[$i][$j];
			}
				
			//almaceno los indices originales en la ultima columna, esto es, es Nx(N+1)
	   		$relation[$i][$n] = $i;
	   	}	
	  
	   	if ($debug) 
	   	{
	   		echo('<br><pre>');	print_r($relation);	echo('</pre>');
	   	}	
	 	
	   	$m = $n;//tamaño inicial de U_1
	   	$k=0;
	   	while ($m >= 1)
	   	{
	   		$I = checkOnes($relation, $m);
	   		//echo('<br>I<pre>');	print_r($I);	echo('</pre>');
	   	
	   		$N = count($I);
	   		//echo " eliminar " . $n . " filas<br>";
	    	
	   		$V[$k] = removeCrossAt( $I, $relation );///se eliminan las referencias &$
			//echo('<br>U<pre>');	print_r($relation);	echo('</pre>');
			//echo('<br>V<pre>');	print_r($V[$k]);	echo('</pre>');
			
			$k++;
			$m = $m-$N; //tamaño actualizado
			//echo " tam actualizado " . $m . " <br>";
		}
			
		if ($debug) 
		{ 
			echo('<br>V<pre>');	print_r($V);	echo('</pre>');
		}


		$p=0;
		for ($i=0; $i<$k; $i++)
		{
			$nI = count($V[$i]);
			//echo " nElementos " . $nI . " en V<br>";
			if ($nI==1)
			{
				$ranking[$p]['inf'] = $envelopes[$V[$i][0]]['inf'];
				$ranking[$p]['sup'] = $envelopes[$V[$i][0]]['sup'];
				$p++;

				//echo " rank index =  " . $V[$i][0] . "<br>";
			}
			else if ($nI==2) //check which one is quasisuperior to the other?
			{
				$a = $envelopes[$V[$i][1]]['sup']-$envelopes[$V[$i][1]]['inf'];
				$b = $envelopes[$V[$i][0]]['sup']-$envelopes[$V[$i][0]]['inf'];
				
				if ($a == $b)
				{
					if ($debug) echo " indiferent (" . $V[$i][0] .") = (". $V[$i][1] .") <br>" ;
					$ranking[$p]['inf'] = $envelopes[$V[$i][0]]['inf'];
					$ranking[$p]['sup'] = $envelopes[$V[$i][0]]['sup'];
					$p++;
					$ranking[$p]['inf'] = $envelopes[$V[$i][1]]['inf'];
					$ranking[$p]['sup'] = $envelopes[$V[$i][1]]['sup'];
					$p++;
				}
				else
				{
					if ($a < $b)
					{
						if ($debug) echo $V[$i][1] ." > ". $V[$i][0] ."<br>";	//As example3. Note than Anexo do the reverse
						$ranking[$p]['inf'] = $envelopes[$V[$i][1]]['inf'];
						$ranking[$p]['sup'] = $envelopes[$V[$i][1]]['sup'];
						$p++;
						$ranking[$p]['inf'] = $envelopes[$V[$i][0]]['inf'];
						$ranking[$p]['sup'] = $envelopes[$V[$i][0]]['sup'];
						$p++;
					}
					else
					{
						if ($debug) echo $V[$i][0] ." > ". $V[$i][1] ."<br>";
						$ranking[$p]['inf'] = $envelopes[$V[$i][0]]['inf'];
						$ranking[$p]['sup'] = $envelopes[$V[$i][0]]['sup'];
						$p++;
						$ranking[$p]['inf'] = $envelopes[$V[$i][1]]['inf'];
						$ranking[$p]['sup'] = $envelopes[$V[$i][1]]['sup'];
						$p++;
					}
				}
			}
			else 
			{	
				if ($debug) echo "case of quasisuperior for more than 2 indiferent elements<br>";
				//they are equivalent so we use the same order of the V vector as the simplisctic solution

				for ($x=0;$x<$nI;$x++)
				{
					$ranking[$p]['inf'] = $envelopes[$V[$i][$x]]['inf'];
					$ranking[$p]['sup'] = $envelopes[$V[$i][$x]]['sup'];
					$p++;					
				}					
			}	
		}

		if ($debug) 
		{ 	
			echo('<hr>Ranking<pre>');	print_r($ranking);	echo('</pre>');
		}

		return $ranking;

	}



	//..-..-..-..-..-..-..-..-..-..-..-..-..- POSSIBILITY DEGREE SUPPORTING FUNCTIONS -..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-
	//  private function that computes p(h1>h2)
	//	input:  interval indexes corresponding to h1[i_1,i_m] > h2[j_1,j_m]
	//  output: a real value in [0,1]

	function computePossibility($i_1, $i_m, $j_1, $j_n)
	{
		$value; //possibility degree value computed by this function
		
		//if ($this->debug) 			echo 'compute with ('. $i_1 . ', ' . $i_m. ', ' . $j_1. ', ' . $j_n .') ';
		$useFormula;
		$case;
		if ($i_m<=$j_n)
			$useFormula=1;
		else
			$useFormula=2;
			
		if($useFormula==1)
		{
			if ($i_m < $j_1)
				$case = "consecutivo";
			else
				if ( ($i_1<=$j_1) && ($j_1<=$i_m) && ($i_m<=$j_n) )
					$case = "cruce";
				else
					$case = "caja";
		}
		else
		{			
			if($j_n<$i_1)
				$case = "consecutivo";
			else	
				if ( ($j_1<=$i_1) && ($i_1<=$j_n) && ($j_n<=$i_m) )
					$case = "cruce";
				else
					$case = "caja";
		}		

		//if ($this->debug) 			echo 'with ('. $useFormula . ') & 	' . $case . ' = ';
		
		switch ($case)
		{
			case "consecutivo":
				if ($useFormula==1)
					$value = 0;
				else
					$value = 1;			
				break;

			case "cruce":
				if ($useFormula==1)
					$value = (0.5*($i_m-$j_1+1))/($j_n-$i_1+1.0);
				else
					$value = (0.5*($j_n-$i_1+1)+($i_m-$j_n)+($i_1-$j_1))/($i_m-$j_1+1.0);
				break;

			case "caja":
				if ($useFormula==1)
					$value = ($i_1-$j_1+0.5*($i_m-$i_1+1))/($j_n-$j_1+1.0);
				else
					$value = (0.5*($j_n-$j_1+1)+($i_m-$j_n))/($i_m-$i_1+1.0);
				break;

			default:
				$value = 0;
				echo "no debería estar en este case de possibility degree computation<br>";
		}
		
		//if ($this->debug) 			echo $value . '<br>';
		return $value;
	}
	
	//auxiliar private function
	function checkOnes( $matrix, $N )
	{
		$V = array();
		$k=0;
		//assumed is a squared matrix
		for($i=$N-1;$i>=0;$i--) //muy importante hacerlo en orden inverso de cara a recortar la matriz
		{
			$row2_one = true;
			for($j=0;$j<$N;$j++) 
				$row2_one = ($matrix[$i][$j] && $row2_one);
					
			//echo '['.$i.'] = ' . $row2_one . '<br>';
			if ($row2_one == true)
			{
				$V[$k] = $i;
				$k++;
			}
		}
		return $V;	
	}
	
	
	//auxiliar private function
	function delete_row(&$array, $offset) 
	{
		return array_splice($array, $offset, 1);//, true);//preserve_keys
	}

	//auxiliar private function
	function delete_col(&$array, $offset) 
	{
		return array_walk($array, function (&$v) use ($offset) {
			array_splice($v, $offset, 1);
		});
	}
	
	//auxiliar private function
	function removeCrossAt( $lines, &$matrix )
	{
		//if ($this->debug) echo " remove index " . $index;
		$newLines = array();
		$n = count($lines);
		$m = count($matrix);
		
		for($i=0;$i<$n;$i++) 
		{
			$newLines[$i] = $matrix[$lines[$i]][$m]; //guardar indices originales
			//echo ($m) . " + old " . $lines[$i] . " new " . $newLines[$i] . "<br>";
		}

		for($i=0;$i<$n;$i++) 
			delete_col($matrix, $lines[$i]);///se eliminan las referencias &$matrix
		for($i=0;$i<$n;$i++) 		
			delete_row($matrix, $lines[$i]);
			
		return $newLines;
	}
	

	//..-..-..-..-..-..-..-..-..-..-..- HESITANT LINGUISTIC WEIGHTED AGGREGATION SUPPORTING FUNCTIONS -..-..-..-..-..-..-..-..-..-..-..-

	function convertEnvelopes($envelopes,&$hesitants)
	{
		$debug = false;
		//data needed to convert envelopes to hesitants
		
		$lengths = array();//number of elements in the hesitant
		$deltas = array();//not to be used in aggregation

		$n = sizeof($envelopes); 
		for ($i=0;$i<$n;$i++)
		{
			if ($debug) echo " [".$envelopes[$i]['inf'].",".$envelopes[$i]['sup']."] ";
			$hesitants[$i] = toHesitant($envelopes[$i],$lengths[$i],$deltas[$i]);
			if ($hesitants[$i] != -1 && $debug)
			{
				echo('<pre>');	print_r($hesitants[$i]);	echo('</pre>');
			}
		}
	}


	// computes a Convex Combination of hesitants (HLWA), noted as C^n(w1,h1,w2,h2, ... wn,hn)
	// output: an hesitant
	function computeHLWA($hesitants, $rankingWeight, $granularity)
	{
		$debug = true;
		$H = array();//resulting aggregate hesitant

		$n = count($hesitants);
		$m = count($rankingWeight);

		//check size: must be > 1
		if ($n == 1)
		{
			//echo "[computeHLWA]: the aggregation of a single element is the element itself<br>";
			return $hesitants[0];
		}

		//check size: n and m should be the same
		if ($n != $m)
		{
			echo "Error[computeHLWA]: unexpected number of elements in arrays: $n x $m<br>";
			return;
		}

		if ($debug) 
		{ 	
			echo('<br>rankingWeight<pre>');	print_r($rankingWeight);	echo('</pre>');
			echo('<br>Hesitants<pre>');	print_r($hesitants);	echo('</pre>');
		}

		$H = computeCN($n, $rankingWeight, $hesitants, $granularity );

		if ($debug) 
		{ 	
			echo('<hr>HLWA<pre>');	print_r($H);	echo('</pre>');
		}

		return $H;		
	}

	//computes the Convex Combination of two terms
	//input: 2 weights 2 linguistic terms and the granularity of the linguistic term set
	//output: s_k with k = min(g, round(w1*s1+w2*s2))
	//example  convexCombination(0.25,5,0.75,4,6); => 4
	function convexCombination($w1,$s1,$w2,$s2,$g)
	{
		//check weights
		$sum = $w1 + $w2;
		if ($sum != 1.0)
		{
			echo "Error[convexCombination]: weights " . $w1 . " and " . $w2 . " should be normalized<br>";
			return;
		}

		$toRound = $w1*$s1 + $w2*$s2;
		$c2 = min($g, round($toRound));
		//echo "G=" . $g . " to round = " . $toRound . " => " . $c2 ."<br>";
		return $c2;
	}

	//function that computes the Convex Combination of 2 Hesitants, noted as C^2(w1,h1,w2,h2)
	function computeC2($w1,$h1,$w2,$h2,$g)
	{
		$debug = false;
		$r = count($h1);
		$s = count($h2);
		$t = array();  //an empty hesitant

		//check sizes
		if ($r*$s < 1)	
		{
			echo "Error[computeC2]: at least a single element per hesitant is required<br>";
			
			echo('<hr>h1<pre>');	print_r($h1);	echo('</pre>');
			echo('<hr>h2<pre>');	print_r($h2);	echo('</pre>');
			echo $r . " x " . $s . "<br>";
			return;		
		}

		//we call r x s times the computation of C2
		for ($i=0;$i<$r;$i++)
		for ($j=0;$j<$s;$j++)
		{
			$t[$i*$r+$j] = convexCombination($w1, $h1[$i], $w2, $h2[$j],$g);
			if ($debug) 
				echo $h1[$i] . " with " . $h2[$j] . " output term s_".$t[$i*$r+$j] . "<br>";
		}

		//remove redundant elements, reset indexes and return
		$c2 = array_values(array_unique($t)); 
		
		if ($debug) 
		{ 	
			echo('<hr>C2<pre>');	print_r($c2);	echo('</pre>');
		}

		return $c2;
	}


	//function that computes the Convex Combination of 2 Hesitants
	function computeCN($n, $w, $h,$g)
	{
		$debug = false;
		
		if ($n == 2)
		{
			//echo('<hr>base h1<pre>');	print_r($h[0]);	echo('</pre>');
			//echo('<hr>base h2<pre>');	print_r($h[1]);	echo('</pre>');
			return computeC2($w[0],$h[0],1.0-$w[0],$h[1],$g);
		}

		$new_W = array();
		$new_H = array();
		$sumRest = 1.0-$w[0];

		//remove first element & compute new weights
		for ($i=1;$i<$n;$i++)
		{
			if ($sumRest==0) //avoid divO = infity
				$new_W[$i-1] = 0;
			else
				$new_W[$i-1] = $w[$i-1] / $sumRest;
			$new_H[$i-1] = $h[$i];
		}

		if ($debug) 
		{ 	
			echo('<br>new_W\'<pre>');	print_r($new_W);	echo('</pre>');
			echo('<br>new_H\'<pre>');	print_r($new_H);	echo('</pre>');
		}

		$result = computeC2($w[0], $h[0], $sumRest, computeCN( $n-1, $new_W, $new_H, $g ), $g);
		if ($debug) 
		{ 	
			echo($n . '<hr>C^N<pre>');	print_r($result);	echo('</pre>');
		}

		return $result;
	}



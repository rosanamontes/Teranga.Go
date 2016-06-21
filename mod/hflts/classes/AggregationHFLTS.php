<?php

/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	CEI BioTIC Micro.proyect Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: Classic aggregation with HFLTS - Rosa'12. Linguistic Decision Making method as in: 
*			R. Montes, A.M. Sanchez, P. Villar and F. Herrera, 
*			A web tool to support decision making in the housing market using hesitant fuzzy linguistic term sets. 
*			Applied Soft Computing, 35, (2015), pp.949--957. 
*
* 	@package DecisionMaking
*
*/


class AggregationHFLTS extends MCDM
{
	var $label;//shortname
	var $cSi; //array with lower interval values (for all criteria)
	var $cSj; //array with upper interval values (for all criteria)
	
	var $beta; //2-tuples
	var $avg; //average-aggregation array
	var $ranking; //alternatives ranked array

	public function	AggregationHFLTS($username)
	{
		$this->N=1;
		$this->M=4;
		$this->P=$this->num=0;
		$this->label="classic";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0,1.0); //same importance by default
		$this->E = array(); //to be set by the platform
	}

	
	public function run()
	{
		parent::run();
		
		$this->translation();	
		$this->envelope();
		$this->average();
		$this->ranking();	

		return $this->ranking[0]['average']['label'];
	}

	private function translation()
	{
		for ($p=0;$p<$this->N;$p++)//for all alternatives
		{		
			//min de las up para cada valoracion, max de las low para la misma alternativa 
			$upper = array();
			$lower = array();
			
			for ($c=0;$c<$this->M;$c++)//forall criteria
			for ($e=0;$e<$this->P;$e++)//for all experts
			{
				$i = $p*$this->P + $e; //index to get assessments
				//echo $i . " .. " . $this->data[$i]["co_codigo"] . " = ";
				$inf = "L".($c+1);
				$sup = "U".($c+1);
				$upper[$c][$e] = $this->data[$i][$sup];//* $this->E[$i];
				$lower[$c][$e] = $this->data[$i][$inf];//* $this->E[$i]; no es la solucion que "mengüe" la valoracion y sea peor. Nunca será mejor
				//echo $upper[$c][$e] . "<br>"; //. $this->E[$i] . "<br>";//ojo indice para E, ver si nExpertos vs nValoraciones
			}
			if ($this->debug) echo "min-max: ";
			for ($c=0;$c<$this->M;$c++)//forall criteria
	 		{
				//echo(' upper: <pre>');	print_r($upper[$c]);	echo('</pre><br>');
				//echo('lower: <pre>');	print_r($lower[$c]);	echo('</pre><br>');
				$this->cSi[$p][$c] = min($upper[$c]);
				$this->cSj[$p][$c] = max($lower[$c]);
				$this->checkRange($this->cSi[$p][$c], $this->cSj[$p][$c]);
				if ($this->debug) 
					echo $this->alternatives[$p] . ": c" . ($c+1) . " [". $this->cSi[$p][$c] .",". $this->cSj[$p][$c] ."] ";
			}
			if ($this->debug) 
				echo "<br>";	
		}
		echo "<hr>";
	}


	/**
	* a range must satisfy the condition of being monotonically increasing
	*/
	private function checkRange( $a, $b )
	{
		if ($a <= $b) return;

		$temp = $a;
		$a = $b;
		$b = $temp;

		if ($this->debug) echo '['.$a.', '.$b.']';
	}

	private function envelope()
	{
		for($p=0;$p<$this->N;$p++)
		{
			$this->avg['inf'][$p] = 0.0;
			$this->avg['sup'][$p] = 0.0;
			$sum = 0.0;
		
			for($c=0;$c<$this->M;$c++)
			{
				$i = $p*$this->P+$c;//index for all assessments

				$this->beta[$p][$c]['inf'] = toBeta( $this->cSi[$p][$c], 0.0 );
				$this->beta[$p][$c]['sup'] = toBeta( $this->cSj[$p][$c], 0.0 );
				if ($this->debug) 
					echo  $p . "_". $c . " [". $this->beta[$p][$c]['inf'] .", " . $this->beta[$p][$c]['sup'] . "] ";
				
				$sum += $this->W[$c];
				$this->avg['inf'][$p] += $this->W[$c] * $this->beta[$p][$c]['inf'];
				$this->avg['sup'][$p] += $this->W[$c] * $this->beta[$p][$c]['sup'];
			}
			
			//echo "Acumu=" . $sum . "<br>";
			$this->avg['inf'][$p] = $this->avg['inf'][$p] / $sum;
			$this->avg['sup'][$p] = $this->avg['sup'][$p] / $sum;

			if ($this->debug) 
				echo " => [". $this->avg['inf'][$p] .", " . $this->avg['sup'][$p] . "] <hr>";
		}
	}

	private function average()
	{
		$pessimistic = array();
		$optimistic = array();

		//interval average
		for($p=0;$p<$this->N;$p++)
		{
			$pessimistic[$p] = $this->avg['inf'][$p] ;
			$values[$p] = ($this->avg['inf'][$p] + $this->avg['sup'][$p]) * 0.5;
			$optimistic[$p] = $this->avg['sup'][$p] ;
		}

		arsort($pessimistic);
		if ($this->debug) 
		{
			echo('<br>pessimistic <pre>');	print_r($pessimistic);	echo('</pre>');
		}

		arsort($values);
		if ($this->debug) 
		{
			echo('<br>average used by default <pre>');	print_r($values);	echo('</pre>');
		}

		arsort($optimistic);
		if ($this->debug) 
		{
			echo('<br>optimistic <pre>');	print_r($optimistic);	echo('</pre>');
		}

		$p=0;    	    
		while ($candidato = current($values))   	
		{
			$index = key($values);
			$this->ranking[$p]['average']['ref'] = $this->alternatives[$index] ;
			$this->ranking[$p]['average']['tuple'] = toTuple( $candidato );
			$this->ranking[$p]['average']['label'] = toLabel( $this->ranking[$p]['average']['tuple'][0] );
			//$this->ranking[$p]['pessimistic']['tuple'] = toTuple ($pessimistic[$index]);
			//$this->ranking[$p]['optimistic']['tuple'] =  toTuple ($optimistic[$index]) ;

			echo "<p>2-tupla ".$candidato." & index ".$p." is ranked as ".$index." </p>";
			$p++;
			next($values);
		}  
	}

	private function ranking()
	{
		if ($this->information)
		{
			echo('<br>Ranking <pre>');	print_r($this->ranking);	echo('</pre>');
		}
		return $this->ranking;
	}

}

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
*	File: Classic aggregation with HFLTS - Rosa'12
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
		$this->E = array(1.0, 1.0, 1.0,1.0); //same importance by default
	}

	
	public function run()
	{
		parent::run();
		//parent::electreCase();

		$this->translation();	
		$this->envelope();
		$this->average();
		$this->ranking();	

		return $this->ranking[0]['average']['label'];
	}


	private function translation()
	{
		//min de las up para cada valoracion, max de las low para la misma alternativa 
		$upper = array();
		$lower = array();

		for ($j=0;$j<$this->M;$j++)//forall criteria
		for ($i=0;$i<$this->num;$i++)//forall assessments
		{
			$inf = "L".($j+1);
			$sup = "U".($j+1);
			$upper[$j][$i] = $this->data[$i][$sup] * $this->E[$i];
			$lower[$j][$i] = $this->data[$i][$inf] * $this->E[$i];
		}
		
		for ($j=0;$j<$this->M;$j++)//forall criteria
 		{
			$this->cSi[$j] = min($upper[$j]);
			$this->cSj[$j] = max($lower[$j]);
			$this->checkRange($this->cSi[$j], $this->cSj[$j]);
			if ($this->debug) 
				echo $this->data[$i]["ref"] . "- C" . $j . " (". $this->cSi[$j] .",". $this->cSj[$j] .")<br>";
		}
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
				$this->beta[$p][$c]['inf'] = toBeta( $this->cSi[$c], 0.0 );
				$this->beta[$p][$c]['sup'] = toBeta( $this->cSj[$c], 0.0 );
				if ($this->debug) 
					echo " [". $this->beta[$p][$c]['inf'] .", " . $this->beta[$p][$c]['sup'] . "] ";
				
				$sum += $this->W[$c];
				$this->avg['inf'][$p] += $this->W[$c] * $this->beta[$p][$c]['inf'];
				$this->avg['sup'][$p] += $this->W[$c] * $this->beta[$p][$c]['sup'];
			}
			
			//echo "Acumu=" . $sum . "<br>";
			$this->avg['inf'][$p] = $this->avg['inf'][$p] / $sum;
			$this->avg['sup'][$p] = $this->avg['sup'][$p] / $sum;

			if ($this->debug) 
				echo " => [". $this->avg['inf'][$p] .", " . $this->avg['sup'][$p] . "] <br>";
		}
	}

	private function average()
	{
		//interval average
		for($p=0;$p<$this->N;$p++)
			$values[$p] = ($this->avg['inf'][$p] + $this->avg['sup'][$p]) * 0.5;

		arsort($values);
		if ($this->debug) 
		{
			echo('<br><pre>');	print_r($values);	echo('</pre>');
		}

		$p=0;    	    
		while ($candidato = current($values))   	
		{
			$index = key($values);
			$this->ranking[$p]['average']['ref'] = $this->alternatives[$index] ;
			$this->ranking[$p]['average']['tuple'] = toTuple( $candidato );
			$this->ranking[$p]['average']['label'] = toLabel( $this->ranking[$p]['average']['tuple'][0] );
			if ($this->debug) echo "<p>2-tupla ".$candidato." & index ".$p." is ranked as ".$index." </p>";
			$p++;
			next($values);
		}  
	}

	private function ranking()
	{
		if ($this->debug)
		{
			echo('<br>Ranking <pre>');	print_r($this->ranking);	echo('</pre>');
		}
		return $this->ranking;
	}

}

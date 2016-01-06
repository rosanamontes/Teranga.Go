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
*	File: Agregación clasica con HFLTS - Rosa'12
*
* 	@package DecisionMaking
*
*/


class AggregationHFLTS extends MCDM
{

	var $label;//shortname
	var $CSi; //array with lower interval values (for all criteria)
	var $CSj; //array with upper interval values (for all criteria)
	
	var $beta; //2-tuples
	var $avg; //average aggregation array
	var $ranking; //alternatives ranked array

	public function	AggregationHFLTS($username)
	{
		$this->N=1;
		$this->M=3;
		$this->P=$this->num=0;
		$this->label="classic";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0); //same important
	}

	public function realEstateCase()
	{
		$this->N=5; //numero de alternatives
		$this->M=9; //numero de criterios
		$this->P=5; //numero de expertos
		
	    $this->alternatives = array('C-1','C-2','C-3','C-4','C-5');
		$this->W = array(1.0, 1.0, 0.5,0.8, 0.7, 0.7, 1.0, 0.8, 0.4); //9 pesos del usuario 1
		
		$this->parse_csv("ejemplo_casas.csv");		
		$this->num = $this->N*$this->P;
	}

	public function todimCase()
	{
		$this->N=4; //numero de alternatives
		$this->M=4; //numero de criterios
		$this->P=1; //numero de expertos
		$this->alternatives = array('p1','p2','p3','p4');
		$this->W = array(0.2, 0.15, 0.15,0.5);

		$this->parse_csv("ejemplo_todim.csv");	
		$this->num = $this->N*$this->P;
	}	
	
	public function run()
	{
		self::todimCase();

		parent::run();
		$this->translation();
		$this->envelope();
		$this->average();
		$this->ranking();	

		return $this->ranking[0]['average']['label'];
	}

	/**
	 * Returns the title of the method
	 *
	 * @return string
	 */
	public function getTitle() 
	{
		// make title for Teranga
		$header = $this->label;
		system_message($this->label . " title " . $header);
		$header = elgg_echo("hflts:label:{$this->label}");
		return $header;
	}
		
	/**
	 * Returns the method full name
	 *
	 * @return string
	 */
	public function getDescription() 
	{
		// Make name for Teranga
		$result = $this->label;
		system_message("description " . $result);
		$result = elgg_echo("hflts:help:{$this->label}");
		return $result;
	}

    private function translation()
    {
    	//min de las up para cada valoracion, max de las low para la misma alternativa 
    	for($p=0;$p<$this->N;$p++)
    	{
    		for($i=0;$i<$this->num;$i++)
    		{
	   			if ($this->data[$i]['ref'] == $this->alternatives[$p])//index 0 equivale a ref
 			  	  	$_c1up[$p][$i] = $this->data[$i]['U1'];
    			if ($this->data[$i]['ref'] == $this->alternatives[$p])
    		 		$_c2up[$p][$i] = $this->data[$i]['U2'];   		
    			if ($this->data[$i]['ref'] == $this->alternatives[$p])
    				$_c3up[$p][$i] = $this->data[$i]['U3'];

    			if ($this->M>3)
				{
    				if ($this->data[$i]['ref'] == $this->alternatives[$p])
    					$_c4up[$p][$i] = $this->data[$i]['U4'];    		
    				if ($this->data[$i]['ref'] == $this->alternatives[$p])
 			   			$_c5up[$p][$i] = $this->data[$i]['U5'];    		
    				if ($this->data[$i]['ref'] == $this->alternatives[$p])
    					$_c6up[$p][$i] = $this->data[$i]['U6'];    
    				if ($this->data[$i]['ref'] == $this->alternatives[$p])
    					$_c7up[$p][$i] = $this->data[$i]['U7'];
    				if ($this->data[$i]['ref'] == $this->alternatives[$p])
    					$_c8up[$p][$i] = $this->data[$i]['U8'];

   					if ($this->data[$i]['ref'] == $this->alternatives[$p])	$_c9up[$p][$i] = $this->data[$i]['U9'];
    			}

    			if ($this->data[$i]['ref'] == $this->alternatives[$p])
 	 	  			$_c1low[$p][$i] = $this->data[$i]['L1'];		    		
     			if ($this->data[$i]['ref'] == $this->alternatives[$p])
 		  			$_c2low[$p][$i] = $this->data[$i]['L2'];		    		
    			if ($this->data[$i]['ref'] == $this->alternatives[$p])
    				$_c3low[$p][$i] = $this->data[$i]['L3'];		    		
    			
    			if ($this->M>3)
    			{
    				if ($this->data[$i]['ref'] == $this->alternatives[$p])
   	 					$_c4low[$p][$i] = $this->data[$i]['L4'];		    		
    				if ($this->data[$i]['ref'] == $this->alternatives[$p])
    					$_c5low[$p][$i] = $this->data[$i]['L5'];		    		
    				if ($this->data[$i]['ref'] == $this->alternatives[$p])
	    				$_c6low[$p][$i] = $this->data[$i]['L6'];		    		
    				if ($this->data[$i]['ref'] == $this->alternatives[$p])
    					$_c7low[$p][$i] = $this->data[$i]['L7'];		    		
    				if ($this->data[$i]['ref'] == $this->alternatives[$p])
	    				$_c8low[$p][$i] = $this->data[$i]['L8'];		    		
    				if ($this->data[$i]['ref'] == $this->alternatives[$p])	$_c9low[$p][$i] = $this->data[$i]['L9'];
    			}
    		}

	    	$this->cSi[$p][0] = min($_c1up[$p]);
    		$this->cSj[$p][0] = max($_c1low[$p]);
			$this->checkRange($this->cSi[$p][0], $this->cSj[$p][0]);	///se eliminan las referencias &$this
			if ($this->debug) echo $this->alternatives[$p]. " C1 [".$this->cSi[$p][0].",".$this->cSj[$p][0]."] ";
	
    		$this->cSi[$p][1] = min($_c2up[$p]);
    		$this->cSj[$p][1] = max($_c2low[$p]);
			$this->checkRange($this->cSi[$p][1], $this->cSj[$p][1]);	
			if ($this->debug) echo $this->alternatives[$p]. " C2 [".$this->cSi[$p][1].",".$this->cSj[$p][1]."] ";
			
    		$this->cSi[$p][2] = min($_c3up[$p]);
    		$this->cSj[$p][2] = max($_c3low[$p]);
			$this->checkRange($this->cSi[$p][2], $this->cSj[$p][2]);	
			if ($this->debug) echo $this->alternatives[$p]. " C3 [".$this->cSi[$p][2].",".$this->cSj[$p][2]."] ";
			
   			if ($this->M>3)
   			{
	    		$this->cSi[$p][3] = min($_c4up[$p]);
	    		$this->cSj[$p][3] = max($_c4low[$p]);
				$this->checkRange($this->cSi[$p][3], $this->cSj[$p][3]);	
				if ($this->debug) echo $this->alternatives[$p]. " C4 [".$this->cSi[$p][3].",".$this->cSj[$p][3]."] ";
					
	    		$this->cSi[$p][4] = min($_c5up[$p]);
	    		$this->cSj[$p][4] = max($_c5low[$p]);
				$this->checkRange($this->cSi[$p][4], $this->cSj[$p][4]);	
				if ($this->debug) echo $this->alternatives[$p]. " C5 [".$this->cSi[$p][4].",".$this->cSj[$p][4]."] ";
				
	    		$this->cSi[$p][5] = min($_c6up[$p]);
	    		$this->cSj[$p][5] = max($_c6low[$p]);
				$this->checkRange($this->cSi[$p][5], $this->cSj[$p][5]);	
				if ($this->debug) 
					echo $this->alternatives[$p]. " C6 [".$this->cSi[$p][5].",".$this->cSj[$p][5]."] ";

	    		$this->cSi[$p][6] = min($_c7up[$p]);
	    		$this->cSj[$p][6] = max($_c7low[$p]);
				$this->checkRange($this->cSi[$p][6], $this->cSj[$p][6]);	
				if ($this->debug) 
					echo $this->alternatives[$p]. " C7 [".$this->cSi[$p][6].",".$this->cSj[$p][6]."] ";

	    		$this->cSi[$p][7] = min($_c8up[$p]);
	    		$this->cSj[$p][7] = max($_c8low[$p]);
				$this->checkRange($this->cSi[$p][7], $this->cSj[$p][7]);	
				if ($this->debug) 
					echo $this->alternatives[$p]. " C8 [".$this->cSi[$p][7].",".$this->cSj[$p][7]."] ";

    			$this->cSi[$p][8] = min($_c9up[$p]);
    			$this->cSj[$p][8] = max($_c9low[$p]);
				$this->checkRange($this->cSi[$p][8], $this->cSj[$p][8]);	
				if ($this->debug) 
					echo $this->alternatives[$p]. " C9 [".$this->cSi[$p][8].",".$this->cSj[$p][8]."] ";
			}
			if ($this->debug) 
				echo "<br>";
		}
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
    			$this->beta[$p][$c]['inf'] = toBeta( $this->cSi[$p][$c], 0.0 );
    			$this->beta[$p][$c]['sup'] = toBeta( $this->cSj[$p][$c], 0.0 );
    			if ($this->debug) 
    				echo " [". $this->beta[$p][$c]['inf'] .", " . $this->beta[$p][$c]['sup'] . "] ";
    			
    			$sum += $this->W[$c];
    			$this->avg['inf'][$p] += $this->W[$c] * $this->beta[$p][$c]['inf'];
    			$this->avg['sup'][$p] += $this->W[$c] * $this->beta[$p][$c]['sup'];
    		}
    		
    		if ($this->debug) echo "Acumu=" . $sum . "<br>";
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

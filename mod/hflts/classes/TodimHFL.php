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
*	File: A Hesitant Fuzzy Linguistic TODIM Method Based on a Score Function
*   Couping Wei, Zhilian Ren, Rosa Mª Rodiguez. IJCIS'15
*
* 	@package DecisionMaking
*
*/


class TodimHFL extends MCDM
{

	var $label;//shortname
	var $refC; //reference criterion

	var $W_r;  //relative weights
	var $T_Wr; //total relative weights

	var $hesitants;//parsed data
	var $score;//measure of the hesitant
	var $variance; //variance of the granularity

	var $chi; //risk attitudes in [0,1]. Optimistic =1, Pesimistic =0
	var $lambda; //to set the distance measure

	var $CSi; //array with lower interval values (for all criteria)
	var $CSj; //array with upper interval values (for all criteria)
	var $beta; //2-tuples
	var $avg; //average aggregation array
	var $ranking; //alternatives ranked array

	public function	TodimHFL($username)
	{
		$this->N=1;
		$this->M=3;
		$this->P=$this->num=0;
		$this->label="todim";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0); //same importance

		$this->lambda = 1.5;
		$this->theta = 1.0; //losses factor
	}

	
	public function run()
	{
		parent::run();

		//Assuption: G is a normalized linguistic decision matrix, where criteria benefit is same and cost criteria es negated
		$this->theCase();

		//step 1 find the most important factor and calculate the relative weights
		$this->relativeWeights();

		//step 2 calculate the dominance degree for each alternative concerning a criterion
		$this->crossAlternativesWithCriteria();


		//step 3 calculate the dominance degree for each alternative
		//step 4 calculate the overall dominance degree for each alternative
		//step 5 rank alternatives
		$this->ranking();	

		return $this->ranking[0]['todim']['label'];
	}


	/**
	* Compute F(H) for all assessment regarding criteria and alternatives 
	*/
	private function crossAlternativesWithCriteria()
	{
    	$this->hesitants = array();
    	$this->score = array();
    	$length = $delta = 0;

		for ($i=0;$i<$this->N;$i++)//forall alternatives
		{
			for ($j=0;$j<$this->M;$j++)//forall criteria
			{
				$inf = "L".($j+1);
				$sup = "U".($j+1);
				$envelope = array ("inf" => $this->data[$i][$inf], "sup" => $this->data[$i][$sup]);
		        if ($this->debug) echo "[".$this->data[$i][$inf].",".$this->data[$i][$sup]."] ";
		        $this->hesitants[$i][$j] = toHesitant($envelope,$length,$delta);
		        if ($this->hesitants[$i][$j] == -1)
		        	register_error("wrong hesitant in score function");
 
		        $this->score[$i][$j] = $this->scoreFunction($this->hesitants[$i][$j], $length, $delta);
				if ($this->debug) echo $this->data[$i]["ref"] . " - C" . $j . " F=" . $this->score[$i][$j] ."<br>";
			}	
		}

		//check cases
		for ($j=0;$j<$this->M;$j++)//forall criteria
		{
			echo "C".$j;
			for ($i=0;$i<$this->N;$i++)//all alternatives
			{
				for ($k=0;$k<$this->N;$k++)//with all alternatives
				{
					if ($i == $k)
						echo " 0";
					else
					{
						//echo " (".$this->data[$i]["ref"] . "," . $this->data[$k]["ref"].")" ;
						if ($this->score[$i][$j] == $this->score[$k][$j] ) 
							echo " 0";	
						else if ($this->score[$i][$j] > $this->score[$k][$j] ) 
							$this->dominanceDegreeCaseOver($this->hesitants[$i][$j], $this->hesitants[$k][$j]);
						else 
							$this->dominanceDegreeCaseUnder($this->hesitants[$i][$j], $this->hesitants[$k][$j]);
					}
				}
				echo "<br>&nbsp;&nbsp;&nbsp;";
			}
			echo "<br>";
		}

	}


	/**
	* Compute \Phi_j(Hi_,H_k) when F(H_ij) > F(H_kj)
	* as sqrt( w_jr d_(H_ij,H_kj) / sum w_jr)
	*/
	private function dominanceDegreeCaseOver($A, $B)
	{
		echo " +";
    	if ($this->debug)
    	{
    		echo('<br>DD+ <pre>');	print_r($A);	echo('</pre>');
    	}

	}	

	/**
	* Compute \Phi_j(Hi_,H_k) when F(H_ij) < F(H_kj)
	* as -1/theta sqrt ( sum w_jr d_(H_kj,H_ij) / w_jr)
	*/
	private function dominanceDegreeCaseUnder($A, $B)
	{
		echo " -";		
    	if ($this->debug)
    	{
    		echo('<br>DD- <pre>');	print_r($B);	echo('</pre>');
    	}

	}	


	/**
	* Computes the relative weights in base of the main criteria
	*/
	private function relativeWeights()
	{
		$a = array_keys($this->W, max($this->W));
		$refC = $a[0];//index
		
		for ($i=0;$i<$this->M;$i++)
		{
			$this->W_r[$i] = $this->W[$i] / $this->W[$refC]; 
		}
		
		if ($this->debug)
		{
   			echo('W_r: <pre>');	print_r($this->W_r);	echo('</pre><br>');
   		}
	}


	/**
	* Computes the averaged linguistic terms. If Average increases the score increases.
	* The hesitant degree increases when score decreases 
	* F(H_S) = deltaAvg - (1/#H_S \sum(delta-deltaAvg) / var(tau))
	* var(tau)
	*/
	private function scoreFunction($hesitant, $L, $D)
	{
    	if ($this->debug)
    	{
    		echo('<br>F <pre>');	print_r($hesitant);	echo('</pre>');
    	}

		$sum=0;
		for ($l=0; $l<$L;$l++)
		{
			$sum += pow($hesitant[$l]-$D,2);
		}

		$var = $this->variance*$L;
		if ($this->debug) 
			echo "score = " .$D . " - (" . $sum." / " . $var . ") L=".$L."<br>" ;
		
		return $D - ($sum / $var);
	}

	/**
	* Computes the var(tau) = {(0 - tau/2)^2 +..+ (tau - tau/2)^2}  / tau+1
	*/
	private function variance()
	{
		$taumed = $this->G * 0.5; 
		$sum = 0;
		for ($i=0; $i<=$this->G; $i++)
		{
			$sum += pow($i - $taumed,2);
		}
		$var = $sum / ($this->G + 1);
		if ($this->debug) system_message("G=" . $this->G . " variance=" . $var);
		return $var;
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
		$result = elgg_echo("hflts:help:{$this->label}");
		return $result;
	}

    private function ranking()
    {
    	if ($this->debug)
    	{
    		echo('<br>Ranking <pre>');	print_r($this->ranking);	echo('</pre>');
    	}
    	return $this->ranking;
    }

	public function theCase()
	{
		$this->N=4; //numero de alternatives
		$this->M=4; //numero de criterios
		$this->P=1; //numero de expertos
		$this->alternatives = array('p1','p2','p3','p4');
		$this->W = array(0.2, 0.15, 0.15,0.5);
		$this->W_r = array();
		$this->variance = $this->variance();

		$this->parse_csv("ejemplo_todim.csv");	
		//$this->testing();
	}

	private function testing()
	{
		/*
		* Example 1 in paper
		*/
		$envelopes = array(['inf'=>3, 'sup'=>3],['inf'=>3,'sup'=>4],['inf'=>1,'sup'=>6]);
		//$envelopes = array(['inf'=>2, 'sup'=>4],['inf'=>0,'sup'=>1],['inf'=>0,'sup'=>2],['inf'=>2,'sup'=>5]);
    	$n = sizeof($envelopes); //system_message("n " . $n);
    	$hesitants = array();
    	$lengths = array();
    	$deltas = array();

    	for ($i=0;$i<$n;$i++)
    	{
	        echo "[".$envelopes[$i]['inf'].",".$envelopes[$i]['sup']."] ";
	        $hesitants[$i] = toHesitant($envelopes[$i],$lengths[$i],$deltas[$i]);
	        if ($hesitants[$i] != -1)
	            echo "score=".$this->scoreFunction($hesitants[$i],$lengths[$i],$deltas[$i])."<br>";
	    }

        /*
        * test intervalDominance. 
        * Example 2 in the paper
        */
        $is1 = intervalDominance($envelopes[1]['inf'], $envelopes[1]['sup'], $envelopes[0]['inf'], $envelopes[0]['sup']);//must be 1 
        $is1ov2 = intervalDominance($envelopes[1]['inf'], $envelopes[1]['sup'], $envelopes[2]['inf'], $envelopes[2]['sup']);//must be 0.5
        $is3ov5 = intervalDominance($envelopes[2]['inf'], $envelopes[2]['sup'], $envelopes[0]['inf'], $envelopes[0]['sup']);//must be 0.6
        if ($this->debug)
        	echo "intervalDominance " . $is1 . " " . $is1ov2 . " " . $is3ov5 . "<br>";
    }

	/*public function realEstateCase()
	{
		$this->N=5; //numero de alternatives
		$this->M=9; //numero de criterios
		$this->P=5; //numero de expertos
		
	    $this->alternatives = array('C-1','C-2','C-3','C-4','C-5');
		$this->W = array(1.0, 1.0, 0.5,0.8, 0.7, 0.7, 1.0, 0.8, 0.4); //9 pesos del usuario 1
		
		$this->parse_csv("ejemplo_casas.csv");		
		$this->num = $this->N*$this->P;
		
		$this->translation();
		$this->envelope();

		$this->average();
		$this->ranking();
	}*/

}

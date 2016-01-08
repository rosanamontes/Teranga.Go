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
*	File: Huchang Liao IEEE-TFS'14
*
* 	@package DecisionMaking
*
*/


class VikorHFL extends MCDM
{

	var $label;		//shortname
	var $lambda; 	//to set the distance measure
	var $xhi;		//to set the distance measure
	var $theta;		//the strategy of the majority of griteria

	var $hesitants;	//parsed data
	var $score;		//measure of the hesitant
	var $variance; //variance of the hesitant
	var $positive; //ideal positive solution
	var $negative; //ideal negative solution

	var $HFLGU;	//group utility for each alternative
	var $HFLIR;	//indivisual regret of the oponent
	var $HFLC;	//linguistic compromise of alternatives

	var $ranking; //alternatives ranked array

	public function	VikorHFL($username)
	{
		$this->N=1;
		$this->M=3;
		$this->P=$this->num=0;
		$this->label="vikor";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0); //same important

    	$this->lambda = 2; 	//hamming distance 
    	$this->xhi = 0.5; 	//risk attitudes
    	$this->theta = 0.5; //maximul overall utility. The larger, the preferences of the expert over criteria will be more average

		//init class variables
    	$this->hesitants = array();
    	$this->score = array();
    	$this->variance = array();
    	$this->positive = array();
    	$this->negative = array();    	    	
    	$this->HFLGU = array();
    	$this->HFLIR = array();
    	$this->HFLC = array();
	}

	public function vikorCase()
	{
		$this->N=3; //num of alternatives
		$this->M=3; //num of criteria
		$this->P=1; //num of experts
		$this->alternatives = array('p1','p2','p3');
		$this->W = array(0.3, 0.5, 0.2);

		$this->parse_csv("ejemplo_vikor.csv");	
		//$this->testing();
	}
	
	public function run()
	{
		//Step 1: establish the alternatives, criteria and the weights of the criteria
		//Step 2: define the semantics
		//system_message("Granularity ". $this->G);
		
		//Step 3: transform assessments into the HFLTS
		//parent::run();
		self::vikorCase();//self::realEstateCase();

		//Step 4: find out the positive ideal and the negative ideal solution
		self::crossAlternativesWithCriteria();
		self::idealSolution();

		//Step 5: derive the compromise solutions
		self::linguisticCompromise();
		$this->ranking();	

		return $this->ranking[0]['vikor']['label'];
	}

	private function crossAlternativesWithCriteria()
	{
    	$length = $delta = 0;

		for ($j=0;$j<$this->M;$j++)//forall criteria
		{
			for ($i=0;$i<$this->N;$i++)//forall alternatives
			{
				$inf = "L".($j+1);
				$sup = "U".($j+1);
				$envelope = array ("inf" => $this->data[$i][$inf], "sup" => $this->data[$i][$sup]);
		        if ($this->debug) 
		        	echo "[".$this->data[$i][$inf].",".$this->data[$i][$sup]."] ";
		        $this->hesitants[$j][$i] = toHesitant($envelope,$length,$delta);
		        if ($this->hesitants[$j][$i] == -1)
		        	register_error("wrong hesitant in score function");
 
		        $this->score[$j][$i] = $delta; //similar to mean in statistics
		        $this->variance[$j][$i] = $this->varianceFunction($this->hesitants[$j][$i], $length);

				if ($this->debug) 
					echo $this->data[$i]["ref"] . " - C" . $j . " rho=" . $this->score[$j][$i] ." sigma=". $this->variance[$j][$i] . "<br>";
			}	
		}
	}

	/**
	* similar to variance in statistics
	*/
	private function varianceFunction($hesitant, $L)
	{
    	$sumSquaredDiff = 0;
		for ($l=0;$l<$L;$l++)
		for ($k=$l;$k<$L;$k++)
		{
			if ($l!=$k) 
				$sumSquaredDiff += pow($hesitant[$l]-$hesitant[$k],2);
		}

		$var = (1.0/$L) * sqrt($sumSquaredDiff);
    	if ($this->debug)
	    	echo " 1/L=" . (1.0/$L) . " sum=".$sumSquaredDiff . " -> " . $var ."<br>";

	    return $var;
	}

	/**
	* Max operator of two hesitant given their indexes
	* Return: index of the greater hesitant
	*/
	private function maxH($H1, $H2, $j)
	{
		//echo "[".$H1.",".$H2."]";
		$rho_1 = $this->score[$j][$H1];
		$rho_2 = $this->score[$j][$H2];

		if ($rho_1 > $rho_2)
			return $H1;
		else if ($rho_1 == $rho_2)
		{
			$var_1 = $this->variance[$j][$H1];
			$var_2 = $this->variance[$j][$H2];

			if ($var_1 < $var_2)
				return $H1;
			else //case of v1 > v2 but if  v1=v2 then max is either H1 or H2, so ...
				return $H2;
		}
		return $H2;
	}

	/**
	* Min operator of two hesitant given their indexes
	* Return: index of the smaller hesitant
	*/
	private function minH($H1, $H2, $j)
	{
		$rho_1 = $this->score[$j][$H1];
		$rho_2 = $this->score[$j][$H2];

		if ($rho_1 > $rho_2)
			return $H2;
		else if ($rho_1 == $rho_2)
		{
			$var_1 = $this->variance[$j][$H1];
			$var_2 = $this->variance[$j][$H2];

			if ($var_1 < $var_2)
				return $H2;
			else //case of v1 > v2 but if  v1=v2 then max is either H1 or H2, so ... 
				return $H1;
		}
		return $H1;
	}

	/**
	* Compare best distances and worst distances to the evaluation matrix
	*/
	private function idealSolution()
	{
		$l_metric = array();

		for ($j=0;$j<$this->M;$j++)//forall criteria
		{
			$max = array_keys($this->score[$j], max($this->score[$j]));
			$this->positive[$j] = $this->hesitants[$j][$max[0]];
			$min = array_keys($this->score[$j], min($this->score[$j]));
			$this->negative[$j] = $this->hesitants[$j][$min[0]];
		}

		if ($this->debug) 
    	{
    		echo('positive: <pre>');	print_r($this->positive);	echo('</pre><br>');
    		echo('negative: <pre>');	print_r($this->negative);	echo('</pre><br>');
    	}

		for ($j=0;$j<$this->M;$j++)//forall criteria
		{
			//echo "C".($j+1)."<br>" ;
			$d_IN = euclideanDistance($this->negative[$j], $this->positive[$j], $this->lambda, $this->G, $this->xhi);

			for ($i=0;$i<$this->N;$i++)//forall alternatives
			{
				$d_IP = euclideanDistance($this->hesitants[$j][$i], $this->positive[$j], $this->lambda, $this->G, $this->xhi);
				$l_metric[$i][$j] = ($d_IP / $d_IN) * $this->W[$j]; 
	        	//echo "d=".$d_IP." .... " . $l_metric[$i][$j] . "<br>";
			}
		}
		
		for ($i=0;$i<$this->N;$i++)//forall alternatives
		{
			$sumGU = 0;
			for ($j=0;$j<$this->M;$j++)//forall criteria
			{
				$sumGU += $l_metric[$i][$j];
			}

			$this->HFLGU[$i] = $sumGU;				// HFLGU	group utility measure = Lp metric with p =1 
			$this->HFLIR[$i] = max($l_metric[$i]);	// HFLIR	individual regret measure = Lp metric con p \inf
		}
	}

	/**
	* computes the	linguistic compromise measure (HFLC) using as weight the value of param strategy = 0.5
	*     			echo('H: <pre>');	print_r($this->hesitants[$j][$i]);	echo('</pre><br>');
	*/
	private function linguisticCompromise()
	{
		$GU_plus = min($this->HFLGU);
		$GU_minus = max($this->HFLGU);
		$IR_plus = min($this->HFLIR);
		$IR_minus = max($this->HFLIR);

		if ($this->debug)
			echo "GU_plus=" . $GU_plus. " GU_minus=".$GU_minus." IR_plus=" . $IR_plus . " IR_minus=" . $IR_minus. "<br>";

		for ($i=0;$i<$this->N;$i++)//forall alternatives
		{
			$this->HFLC[$i] = ( $this->theta*(($this->HFLGU[$i]-$GU_plus)/($GU_minus-$GU_plus)) )
							+ ( (1.0-$this->theta)*(($this->HFLIR[$i]-$IR_plus)/($IR_minus-$IR_plus)) );

			if ($this->debug)
				echo "P" . ($i+1). " HFLGU=".$this->HFLGU[$i]." HFLIR=" . $this->HFLIR[$i] . " HFLC=" . $this->HFLC[$i]. "<br>";
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


	private function testing()
	{
		/*
		* Example 1 in paper
		*/
		$envelopes = array(['inf'=>1, 'sup'=>1],['inf'=>-3,'sup'=>0],['inf'=>1,'sup'=>3],['inf'=>0,'sup'=>2]);
    	$n = sizeof($envelopes); //system_message("n " . $n);
    	$hesitants = array();
    	$lengths = array();
    	$deltas = array();

    	for ($i=0;$i<$n;$i++)
    	{
	        echo "[".$envelopes[$i]['inf'].",".$envelopes[$i]['sup']."] ";
	        $hesitants[$i] = toHesitant($envelopes[$i],$lengths[$i],$deltas[$i]);
	        if ($hesitants[$i] != -1)
	        {
	        	$V = $this->varianceFunction($hesitants[$i],$lengths[$i]);
	        	echo "score=".$deltas[$i] . " variance=" . $V."<br>";
	        }
		}
	}

	public function todimCase()
	{
		$this->N=4; //num of alternatives
		$this->M=4; //num of criteria
		$this->P=1; //num of experts
		$this->alternatives = array('p1','p2','p3','p4');
		$this->W = array(0.2, 0.15, 0.15,0.5);

		$this->parse_csv("ejemplo_todim.csv");	
	}

	public function realEstateCase()
	{
		$this->N=5; //num of alternatives
		$this->M=9; //num of criteria
		$this->P=5; //num of experts
		
	    $this->alternatives = array('C-1','C-2','C-3','C-4','C-5');
		$this->W = array(1.0, 1.0, 0.5,0.8, 0.7, 0.7, 1.0, 0.8, 0.4); //user_1
		
		$this->parse_csv("ejemplo_casas.csv");	
	}

}

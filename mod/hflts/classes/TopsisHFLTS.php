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
*	File: 
		2013-IJIS-Beg-Rasid-TOPSIS for Hesitant Fuzzy Linguistic
*		
*  	TOPSIS for Hesitant Fuzzy Linguistic Term Sets
* 	INTERNATIONAL JOURNAL OF INTELLIGENT SYSTEMS, VOL. 28, 1162–1171 (2013)
* 	Ismat Beg, Tabasam Rashid
*
* 	@package DecisionMaking
*
*/


class TopsisHFLTS extends MCDM
{
	var $label;//shortname
	var $envelopes;//parsed data
	var $pis;	//hesitants with the positive ideal solution 
	var $nis;	//hesitants with the negative ideal solution 
	var $Dplus; //positive ideal separation matrix (D+)
	var $Dminus;//negative ideal separation matrix (D-)
	var $RC;	//relative closeness (RC) of each alternative
	var $ranking; //alternatives ranked array

	public function	TopsisHFLTS($username)
	{
		$this->N=1;
		$this->M=4;
		$this->P=$this->num=0;
		$this->label="topsis";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0, 1.0); //same importance by default

		$this->envelopes = array(); //(NxM matrix)
		$this->pis = array(); //(1xM matrix)
		$this->nis = array(); //(1xM matrix)
		$this->Dplus = array(); //(NxM matrix)
		$this->Dminus = array(); //(NxM matrix)
		$this->RC = array(); //(1xN matrix)
	}
	
	public function run()
	{
		//step 1 collect data into a fuzzy decision matrix
		parent::run();
		//$this->debug = true;
		if ($this->debug) 
			system_message($this->N . " x ". $this->M . " x " . $this->P);

		//Assuption: G is a normalized linguistic decision matrix, where criteria benefit is same and cost criteria es negated
		//parent::topsisCase();//realEstateCase();vikorCase

		//step 2 aggretate the opinion of decision makers into X (one decision matrix) by using max-min operators
		$this->crossAlternativesWithCriteria();

		//step 3 Let a collection of benefit criteria (i.e., the larger C_j, the greater preference)
		//Let be a collection of cost criteria (i.e., the smaller C_j, the greater preference)
		// compute the HFLTS positive-ideal solution (HFLTS-PIS) & negative-ideal solution (HFLTS-NIS)
		$this->idealSolutions();
		
		//Step 4. Construct positive ideal separation matrix (D+) and negative ideal separation matrix (D−)
		//Step 5. Calculate the relative closeness (RC) of each alternative to the ideal solution 
		$this->separationMatrix();


		//Step 6. Rank all the alternatives A i (i = 1, . , m) according to the closeness coefficient RC(A i ), the greater the value RC(A i ), the better the alternative A i.
		$this->ranking();	

		return $this->ranking[0]['topsis']['label'];
	}

	/**
	* Gather all assessment regarding criteria and alternatives 
	* It uses aggregationMinMax($data) from the same paper
	*/
	private function crossAlternativesWithCriteria()
	{
		$length = $delta = 0;
		$criterionAssessment = array();//what several experts say about a single criterion. Temporal array

		for ($i=0;$i<$this->N;$i++)//forall alternatives 
		{
			for ($j=0;$j<$this->M;$j++)//forall criteria
			{
				if ($this->debug)
					echo $this->data[$i*$this->P]["ref"] . " - C" . ($j+1) ;

				//Aggregate hesitants given from experts for each criterion and alternative
				for ($k=0;$k<$this->P;$k++)//forall experts
				{
					$c = $i*$this->P + $k; //index to get assessments - system_message("#".$c);
					
					$inf = "L".($j+1);
					$sup = "U".($j+1);
					$criterionAssessment[$k] = array ("inf" => $this->data[$c][$inf], "sup" => $this->data[$c][$sup]);

					if ($this->debug) //echo " - E_" . $this->data[$c]['co_codigo'];
						echo " [".$this->data[$c][$inf].",".$this->data[$c][$sup]."], ";
				} 

				$avgE_Cj = aggregationMinMax($criterionAssessment, $this->E, $this->G);
				$this->envelopes[$i][$j] = $avgE_Cj;//store the aggretate linguistic interval as alternative x criteria

				if ($this->debug) 
					echo " => [".$avgE_Cj['inf'].", ".$avgE_Cj['sup']."]<br>";

			}	
		}
	}

	//compute PIS as min of costCriteria and max of benefitCriteria
	//compute NIS as max of costCriteria and min of benefitCriteria
	private function idealSolutions()
	{
		$assessments = array();//of (NxMxP)
		$num = $this->N * $this->P;

		for ($j=0;$j<$this->M;$j++)//forall criteria
		{
			for ($x=0;$x<$num;$x++)//forall alternatives and experts
			{
				$inf = "L".($j+1);
				$sup = "U".($j+1);

				$assessments[$j][$x] = array("inf" => $this->data[$x][$inf], "sup" => $this->data[$x][$sup]);
				//echo $x . " [".$this->data[$x][$inf].",".$this->data[$x][$sup]."]<br>";

			}
		}
		
		for ($j=0;$j<$this->M;$j++)//forall criteria
		{		
			if (in_array($j,$this->benefitCriteria))
			{
				$this->pis[$j] = max($assessments[$j]);
				$this->nis[$j] = min($assessments[$j]);
				//echo 'C_'. $j . " is benefit criteria<br>" ;	
			}
			else //cost criteria
			{
				$this->pis[$j] = min($assessments[$j]);
				$this->nis[$j] = max($assessments[$j]);
				//echo 'C_'. $j . " is cost criteria<br>" ;	
			}
		}

		if ($this->debug)
		{
			echo('<br>benefitCriteria<pre>');	print_r($this->benefitCriteria);	echo('</pre>');
			echo('<br>PIS<pre>');	print_r($this->pis);	echo('</pre>');
			echo('<br>NIS<pre>');	print_r($this->nis);	echo('</pre>');
		}
	}


	//Compute D+ & D- using TOPSIS for HFLTS distance operator where d(H1,H2) = | I(upH1)-I(upH2) |  + | I(lowH1)-I(lowH2)^2 | 
	//It uses function distanceBetween( $Env1, $Env2 )
	private function separationMatrix()
	{
		$acumPlus = array();
		$acumMinus = array();

		for ($i=0;$i<$this->N;$i++)//forall alternatives 
		{
			$acumPlus[$i] = $acumMinus[$i] = 0;
			for ($j=0;$j<$this->M;$j++)//forall criteria
			{
				$this->Dplus[$i][$j] = distanceBetween($this->envelopes[$i][$j], $this->pis[$j]);
				$acumPlus[$i] += $this->Dplus[$i][$j];
				$this->Dminus[$i][$j] = distanceBetween($this->envelopes[$i][$j], $this->nis[$j]);
				$acumMinus[$i] += $this->Dminus[$i][$j];
			}
		}

		if ($this->debug)
		{
			echo('<br>D+<pre>');	print_r($this->Dplus);	echo('</pre>');
			echo('<br>acum of D+<pre>');	print_r($acumPlus);	echo('</pre>');
			echo('<br>D-<pre>');	print_r($this->Dminus);	echo('</pre>');
			echo('<br>acum of D-<pre>');	print_r($acumMinus);	echo('</pre>');
		}

		//compute the closeness coefficient RC(A_i)
		for ($i=0;$i<$this->N;$i++)//forall alternatives 
		{
			$this->RC[$i] = $acumMinus[$i] / ($acumPlus[$i] + $acumMinus[$i]) ;
			//echo $this->RC[$i] . "<br>";
		}
	}


	//the greater the value RC(A_i), the better the alternative A_i.
    private function ranking()
    {
    	arsort($this->RC);
		if ($this->debug)
		{
			echo('<br>sorted RC<pre>');	print_r($this->RC);	echo('</pre>');
		}

		for ($i=0;$i<$this->N;$i++)	
		{
			$index = key($this->RC);
			$this->ranking[$i]['topsis']['ref'] = $this->alternatives[$index] ;
			$this->ranking[$i]['topsis']['value'] = $this->RC[$index];
			$this->ranking[$i]['topsis']['label'] = "--";
			//echo "<p>index ".$i." is ranked as ".$index." </p>";
			next($this->RC);
		}  	

    	if ($this->information)
    	{
    		echo('<br>Ranking <pre>');	print_r($this->ranking);	echo('</pre>');
    	}
    	return $this->ranking;
    }

}

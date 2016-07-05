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
	var $ranking; //alternatives ranked array

	public function	TopsisHFLTS($username)
	{
		$this->N=1;
		$this->M=4;
		$this->P=$this->num=0;
		$this->label="topsis";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0, 1.0); //same importance by default

		$envelopes = array(); //(NxM matrix)
		$pis = array(); //(1xM matrix)
		$nis = array(); //(1xM matrix)
	}
	
	public function run()
	{
		//step 1 collect data into a fuzzy decision matrix
		parent::run();
		$this->debug = true;
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
		
		//step 4 calculate the dominance degree for each alternative
		




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
					$criterionAssessment[$j][$k] = array ("inf" => $this->data[$c][$inf], "sup" => $this->data[$c][$sup]);

					if ($this->debug) //echo " - E_" . $this->data[$c]['co_codigo'];
						echo " [".$this->data[$c][$inf].",".$this->data[$c][$sup]."], ";
				} 

				$avgE_Cj = aggregationMinMax($criterionAssessment, $this->E, $this->G);
				$this->envelopes[$j][$i] = $avgE_Cj;//store the aggretate linguistic interval as criteria x alternative

				if ($this->debug) 
					echo " => [".$avgE_Cj['inf'].", ".$avgE_Cj['sup']."]<br>";

			}	
		}
	}

	//compute PIS as min of costCriteria and max of benefitCriteria
	//compute NIS as max of costCriteria and min of benefitCriteria
	private function idealSolutions()
	{
		$assessments = array();
		$num = $this->N * $this->P;

		for ($j=0;$j<$this->M;$j++)//forall criteria
		{
			for ($x=0;$x<$num;$x++)//forall alternatives and experts
			{
				$y = $j*$this->M+$x;
				$inf = "L".($j+1);
				$sup = "U".($j+1);

				//$assessments[$j]['inf'] = 
				echo $x . " [".$this->data[$x][$inf].",".$this->data[$x][$sup]."]<br>";

			}
		}
		echo('<br>assessments<pre>');	print_r($assessments);	echo('</pre>');
		
		return;
		for ($j=0;$j<$this->M;$j++)//forall criteria
		{		
			/*if (in_array($j,$this->benefitCriteria))
			{
				$pis[$j] = max($this->envelopes[$j]);
				$nis[$j] = min($this->envelopes[$j]);
			}
			else
			{
				$pis[$j] = min($this->envelopes[$j]);
				$nis[$j] = max($this->envelopes[$j]);
			}*/
		}

		if ($this->debug)
		{
			echo('<br>PIS<pre>');	print_r($pis);	echo('</pre>');
			echo('<br>NIS<pre>');	print_r($nis);	echo('</pre>');
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

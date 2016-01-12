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
*	File: Jian-quang Wang IS'14
*	      An outranking approach for multi-criteria decision-making with hesitant fuzzy linguistic term sets
*
* 	@package DecisionMaking
*
*/


class ElectreHFLTS extends MCDM
{

	var $label;//shortname

	var $ranking; //alternatives ranked array

	public function	ElectreHFLTS($username)
	{
		$this->N=1;
		$this->M=3;
		$this->P=$this->num=0;
		$this->label="electre";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0); //same important
	}

	
	public function run()
	{
		parent::run();
		parent::electreCase();//realEstateCase();


		$this->ranking();	

		return $this->ranking[0]['electre']['label'];
	}

	/**
	* P(si, sj) is a binary relation between two hesitants that test binary relation at index level
	* Not simetrical!
	*/ 
	private function binaryRelation($h1, $h2, $l1, $l2)
	{
		$sum = 0;
		for ($i=0;$i<$l1;$i++)
	    for ($j=0;$j<$l2;$j++)
	    {
	    	$sum += $this->binary($h1[$i],$h2[$j]);
	    	//echo $sum . " ";
	    }
	    //echo "=> P=".$sum."<br>";
	    return $sum;
	}

	private function binary($s1, $s2)
	{
		return ($s1 > $s2) ? 1 : 0;
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
		* Example 1 and 4 in paper
		*/
		$envelopes = array(['inf'=>3, 'sup'=>3],['inf'=>2,'sup'=>3],['inf'=>3,'sup'=>5],['inf'=>4,'sup'=>5]);
    	$n = sizeof($envelopes); system_message("n " . $n);
    	$hesitants = array();
    	$lengths = array();
    	$deltas = array();

    	for ($i=0;$i<$n;$i++)
    	{
	        $hesitants[$i] = toHesitant($envelopes[$i],$lengths[$i],$deltas[$i]);
	        if ($hesitants[$i] == -1)
	            echo "stop here!<br>";
	    }

	    for ($i=0;$i<$n;$i++)
	    for ($j=0;$j<$n;$j++)
	    {
	    	if ($i!=$j)
	    	{
	    		//distanceEnvelope($envelopes[$i],$envelopes[$j]);

	        	//r(H,H) = sum p() / #h * #h 
	        	$R = $this->binaryRelation($hesitants[$i], $hesitants[$j],$lengths[$i],$lengths[$j]);
	        	$R /= ($lengths[$i] * $lengths[$j]);

	        	echo "r(".($i+1).",".($j+1).") = ".$R."<br>";	        	
	        }
	    }
    }
}

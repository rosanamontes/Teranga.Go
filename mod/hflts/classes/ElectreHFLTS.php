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

	var $hesitants;//parsed data
	var $W_distance; //weighted distance between two hesitants
	var $maxWD; //maximum weighted distance per alternative
	var $outrank;  //outrank degree between two hesitants. Seams always <=1 
	var $strong, $weak; //strong and weak criteria indexes
	var $C, $D; //concordance and discordance matrices	

	var $ranking; //alternatives ranked array

	public function	ElectreHFLTS($username)
	{
		$this->N=1;
		$this->M=3;
		$this->P=$this->num=0;
		$this->label="electre";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0); //same important

		//init local variables
		$this->hesitants = array();
		$this->W_distance = array();//d() * W_j
		$this->maxWD = array();
		$this->outrank = array(); //r()
		$this->strong = array();				
		$this->weak = array();				
		$this->C = array();				
		$this->D = array();				
	}

	
	public function run()
	{
		parent::run();
		parent::electreCase();//realEstateCase();

		//step 1: transform teh linguistic expressions into HFLTS. 
		//Since all criteria are of the maximizing type no normalization is needed
		//step 2: identify the concordance an discordance indices
		$this->crossAlternativesWithCriteria();
		
		//step 3: construct the concordance and discordance matrices
		$this->computeMatrices();

		//step 4: get the net dominance and disadvantage indices (c_i and d_i)
		//$this->testing();
		//step 5: rank the alternatives in acoordance with c_i and d_i
		$this->ranking();	

		return $this->ranking[0]['electre']['label'];
	}

	/**
	* P(si, sj) = sum p() is a binary relation between two hesitants that test binary relation at index level
	* Not simetrical!
	*/ 
	private function binaryRelation($h1, $h2, $l1, $l2)
	{
		$sum = 0;
		for ($i=0;$i<$l1;$i++)
		for ($j=0;$j<$l2;$j++)
		{
			$sum += $this->binary($h1[$i],$h2[$j]);
			//echo "is " . $h1[$i] . " > " . $h2[$j]. "? ";
		}
		//echo "=> P=".$sum."<br>";
		return $sum;
	}

	private function binary($s1, $s2)
	{
		return ($s1 > $s2) ? 1 : 0;//p()
	}

	private function crossAlternativesWithCriteria()
	{
		$envelope = array();
		$length = array();
		$delta = 0.0;

		for ($i=0;$i<$this->N;$i++)//forall alternatives
		{
			for ($j=0;$j<$this->M;$j++)//forall criteria
			{
				$inf = "L".($j+1);
				$sup = "U".($j+1);
				$envelope[$i][$j] = array ("inf" => $this->data[$i][$inf], "sup" => $this->data[$i][$sup]);
				if ($this->debug) echo "[".$this->data[$i][$inf].",".$this->data[$i][$sup]."] ";
				$this->hesitants[$i][$j] = toHesitant($envelope[$i][$j],$length[$i][$j],$delta);
				if ($this->hesitants[$i][$j] == -1)
					register_error("wrong hesitant in score function");
			}	
		}
		
		
		for ($i=0;$i<$this->N;$i++)//forall alternatives
		{
			for ($k=$i;$k<$this->N;$k++)//with half alternatives
			{
				if ($i!=$k)
				{
					for ($j=0;$j<$this->M;$j++)//forall criteria
					{
						$this->W_distance[$i][$j] = distanceEnvelope($envelope[$i][$j],$envelope[$k][$j]) * $this->W[$j];

						$len = $length[$i][$j] * $length[$k][$j];
						$this->outrank[$i][$k][$j] = $this->binaryRelation($this->hesitants[$i][$j], $this->hesitants[$k][$j], 
							$length[$i][$j],$length[$k][$j]) / $len;
						$this->outrank[$k][$i][$j] = $this->binaryRelation($this->hesitants[$k][$j], $this->hesitants[$i][$j], 
							$length[$k][$j],$length[$i][$j]) / $len;

						if ($this->debug) 
						{
							echo "C".($j+1)." (".($i+1).",".($k+1).") ";
							echo "W_d=" .$this->W_distance[$i][$j]." Conc_r=".$this->outrank[$i][$k][$j]." Dis_r=".$this->outrank[$k][$i][$j]."<br>" ;

							if ($this->outrank[$i][$k][$j] == 1.0)
								echo "C_S in " . ($j+1) . "<br>";
							else
								if ($this->outrank[$i][$k][$j] >= 0.5) 
									echo "C_W in " . ($j+1) . "<br>";

							if ($this->outrank[$k][$i][$j] == 1.0)
								echo "D_S in " . ($j+1) . "<br>";
							else
								if ($this->outrank[$k][$i][$j] >= 0.5) 
									echo "D_W in " . ($j+1) . "<br>";
						}

						//concordance indices
						if ($this->outrank[$i][$k][$j] == 1.0)
							$this->strong[$i][$k][$j] = $j;
						else
						{
							if ($this->outrank[$i][$k][$j] >= 0.5) 
								$this->weak[$i][$k][$j] = $j;
						}

						//discordance indices
						if ($this->outrank[$k][$i][$j] == 1.0)
							$this->strong[$k][$i][$j] = $j;
						else
						{
							if ($this->outrank[$k][$i][$j] >= 0.5) 
								$this->weak[$k][$i][$j] = $j;
						}
					}	
			

					$this->maxWD[$i] = max($this->W_distance[$i]);
					if ($this->debug) echo "max  " . $this->maxWD[$i] . "<br>";
				}
			}
		}

		//if ($this->debug)
		{
			echo('strong: <pre>');	print_r($this->strong);	echo('</pre><br>');
			echo('weak: <pre>');	print_r($this->weak);	echo('</pre><br>');
		}

	}	

	private function computeMatrices()
	{
		for ($i=0;$i<$this->N;$i++)//for all alternatives
		{
			for ($k=$i;$k<$this->N;$k++)//with half alternatives
			{
				$acum1 = $acum2 = $s1 = $s2 =0;
				if ($i!=$k)
				{
					//concordance matrix
					for($x=0;$x<count($this->strong[$i][$k]);$x++)
					{
						$acum1 += $this->W[$this->strong[$i][$k][$x]];
						//echo " C_S " . ($this->C_strong[$i][$k]+1) . " sum " . $acum1 ;
					} 					
					for($x=0;$x<count($this->weak[$i][$k]);$x++)
					{
						$s1 += $this->W[$this->weak[$i][$k][$x]] * $this->outrank[$i][$k][$this->weak[$i][$k][$x]];//upper half
						//echo " C_W ". ($this->C_weak[$i][$k]+1). " s1 " . $s1  ;
					} 
						
					$this->C[$i][$k] = $acum1 + $s1;//upper half
					echo " (".($i+1).",".($k+1).") -> C=" . $this->C[$i][$k] . "<br>";


					//disconcordance matrix
					for($x=0;$x<count($this->strong[$k][$i]);$x++)
					{
						$acum2 += $this->W[$this->strong[$k][$i][$x]];
						echo " D_S " . ($this->strong[$k][$i][$x]+1) . " sum " . $acum2 ;
					} 					
					for($x=0;$x<count($this->weak[$k][$i]);$x++)
					{
						$s2 += $this->W[$this->weak[$k][$i][$x]] * $this->outrank[$k][$i][$this->weak[$k][$i][$x]];//lower half
						echo " D_W ". ($this->weak[$k][$i][$x]+1). " s2 " . $s2 ;
					} 
					$this->C[$k][$i] = $acum2 + $s2;//lower half
					echo " (".($k+1).",".($i+1).") -> C=" . $this->C[$k][$i] . "<br>";
				}
			}
			
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
		* Example 1 and 4 in paper
		*/
		$envelopes = array(['inf'=>3, 'sup'=>3],['inf'=>2,'sup'=>3],['inf'=>3,'sup'=>5],['inf'=>4,'sup'=>5]);
		$n = sizeof($envelopes); //system_message("n " . $n);
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

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
*	File: Multi-Criteria Decision Making function library 
*/

//________________________________________________________________________

//________________________ > DISTANCES MEASURES < ________________________
//________________________________________________________________________

/**
* Euclidean Distance 
* 2014-INS-Distance and similarity measures for hesitant fuzzy linguistic term sets and their application in multi-criteria decision making
* In: 	Array of hesitants (any number) as in this example
*		H1={2,3}
*		H2={1,2,3}
* Params: granularity, for instance G=6
* Out: d_(H1,H2) = number with decimals
* Requirements: it has to work with hesitant of the same length L 
*/

function euclideanDistance($envelopes)
{
	return 3.14;
}

/**
* Operations and comparisons of hesitant fuzzy linguistic term sets. C.P. Wei IEEE TFS'14
* In: two hesitant in S
*/
function hesitantComplement($H1, $H2)
{

}

/**
* Dominance Degree function proposed by Rodriguez et al. 2012
* where P(A>B) = (  (a2-b1)-(a1-b2) ) / ( (a2-a1)+(b2-b1) )
* it computes the preference degree of interval a over interval b
*/
function intervalDominance( $a1, $a2, $b1, $b2 )
{
	return (  max(0.0,($a2-$b1))-max(0.0,($a1-$b2)) ) / ( ($a2-$a1)+($b2-$b1) );
}


//________________________________________________________________________

//_____________________ > REPRESENTATION UTILITIES < _____________________
//________________________________________________________________________



/** 
* Conversion from symbolic value in [0,1] to a linguistic range	
* supposing [0,6]
*/
function toRange( $value, $g=6.0 )
{
	return (  $value * $g );
}

/**
* converts from 2-tuple to beta 
*/
function toBeta( $term, $alpha ) 
{
   	return $term + $alpha;
}
    
/**
* converts from beta value to 2-tuple representation
*/
function toTuple( $value )
{
    $i = round($value);
    return array ( $i, $value - $i );
}
 

/**
* Falta traducir con elgg strings
*/
function toLabel( $term )
{
	switch ($term) 
	{
    	case 0:
        	return "Nada";
    	case 1:
        	return "Muy Bajo";
    	case 2:
        	return "Bajo";
    	case 3:
        	return "Medio";
    	case 4:
        	return "Alto";
    	case 5:
        	return "Muy Alto";
    	case 6:
        	return "Perfecto";
    	default:
        	return "No valorado";
	   } 
    }

/**
* Detailed hesitant description
* Input: single envelope
* Output: the hesitant's length and delta, and the hesitant array or -1 if something went wrong 
*/
function toHesitant($envelope, &$length, &$deltaAvg)
{
    $hesitant = array();
    $sum = 0;
    $i=0;
    for ($j=$envelope['inf']; $j<=$envelope['sup']; $j++)
    {
        $hesitant[$i++] = $j;
        $sum += $j;
    }

    //validate it
    if ((min($hesitant) != $envelope['inf']) || (max($hesitant) != $envelope['sup']))
    {
        echo min($hesitant) . " - " . max($hesitant) ." <br>";
        return -1; //wrong!
    }
    
    $length = $envelope['sup'] - $envelope['inf'] + 1;
    $deltaAvg = $sum / $length;
    //echo $length  . "/" . $deltaAvg ."<br>";
    //echo('<br>Ranking <pre>');  print_r($hesitant);    echo('</pre>');
    return $hesitant;
}

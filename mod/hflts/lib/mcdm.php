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
*	File: Multi-Criteria Decision Making functions library 
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
* Params: lamda. When =1 it compute the Hamming distance. When =2 is the Euclidean distance
*,        granularity, for instance G=6, 
*         Xhi
* Out: d_(H1,H2) = distance in real
* Requirements: it has to work with hesitant of the same length L 
*/

function euclideanDistance($H1, $H2, $lambda, $G, $X)
{
    $size = [ sizeof($H1), sizeof($H2) ];
    $L = max($size);
    $exp = $lambda;
    $den = $G+1;

       /* {
            echo('<br>H1 <pre>');    print_r($H1); echo('</pre>');
            echo('<br>H2 <pre>');    print_r($H2); echo('</pre>');
        }*/


    if ($size[0] == $size[1])
    {
        $EH1 = extend($H1, 0, $G, $X);
        $EH2 = extend($H2, 0, $G, $X);
    }
    else if ($size[0] < $size[1])
    {
        $EH1 = extend($H1, $size[1]-$size[0], $G, $X);
        $EH2 = extend($H2, 0, $G, $X);
        //system_message(" extend H1 " . ($size[1]-$size[0])) ;
    }
    else if ($size[0] > $size[1])
    {
        $EH1 = extend($H1, 0, $G, $X);
        $EH2 = extend($H2, $size[0]-$size[1], $G, $X);
        //system_message(" extend H2 " . ($size[0]-$size[1])) ;
    }

    $sum = 0;
    for ($g=0;$g<$L;$g++)
    {
        $d_abs= abs($EH1[$g]-$EH2[$g]);
        $fracc2 = pow( $d_abs / $den, $exp );
        $sum += $fracc2;
        //echo "<br>d_abs=".$d_abs." frac=".$fracc2." ";
    }

    $exp = 1.0 / $lambda;
    $sumL = $sum / $L;
    $d = pow( $sumL, $exp);
    //echo "<br>sumL=".$sumL." exp=".$exp." distance=".$d;

	return $d;
}

/**
* in order to operate correctly, the sorter hesitant should be extended until it equals the length of work
*/
function extend($hesitant, $n, $tau, $chi)
{
    $E = $hesitant;
    $N = sizeof($hesitant);
    $min = min($hesitant);
    $max = max($hesitant);
    
    $s = ($max * $chi) - ($min * $chi) + $min;//value
    $k = min($tau,round($chi * $N) );    //index
    //echo $n." extend with ".$k." at ".$s."<br>";

    while ($n>0)
    {
        $E = insertBeforeKey($E, $k, array($k => $s));
        $n--;
        $k++;
    }

    /*{
        echo('<br>Ext <pre>');  print_r($E);    echo('</pre>');
    }*/

    return $E;
}

function insertBeforeKey($array, $key, $data = null)
{
    if (($offset = array_search($key, array_keys($array))) === false) // if the key doesn't exist
    {
        $offset = 0; // should we prepend $array with $data?
        $offset = count($array); // or should we append $array with $data? lets pick this one...
    }

    return array_merge(array_slice($array, 0, $offset), (array) $data, array_slice($array, $offset));
}

/**
* Operations and comparisons of hesitant fuzzy linguistic term sets. C.P. Wei IEEE TFS'14
* In: the term and the granularity of the term set
* Out: the complement of the hesitant/linguistic term
*/
function negate($index, $G)
{
    return $G - $index;
}

/**
* Dominance Degree function proposed by Rodriguez et al. 2012
* where P(A>B) = (  (a2-b1)-(a1-b2) ) / ( (a2-a1)+(b2-b1) )
* it computes the preference degree of interval a over interval b
* Example: p(env(H2) > env(H1)) it is called as intervalDominance(H2.inf, H2.sup, H1.inf, H2.sup)
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
        echo "return -1 -> " . min($hesitant) . " - " . max($hesitant) ." <br>";
        return -1; //wrong!
    }
    
    $length = $envelope['sup'] - $envelope['inf'] + 1;
    $deltaAvg = $sum / $length;
    //echo "L=" . $length  . " D=" . $deltaAvg ."<br>";
    //echo('<br>Hesitant <pre>');  print_r($hesitant);    echo('</pre>');
    return $hesitant;
}


function toEnvelope($H, $G)
{

}
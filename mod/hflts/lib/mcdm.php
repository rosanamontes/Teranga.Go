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



/**
* Euclidean Distance 
* 2014-INS-Distance and similarity measures for hesitant fuzzy linguistic term sets and their application in multi-criteria decision making.pdf
* In: 	Array of hesitants as in this example
*		H1={2,3}
*		H2={1,2,3}
* Params: granularity, for instance G=6
* Out: d_(H1,H2) = number with decimals
* Requirements: it has to work with hesitant of the same length L 
*/

function euclideanDistance($hesitant, $granularity)
{
	system_message("granularity = " . $granularity);
	return 3.14;
}

/**
* Dominance Degree function 
* where P(A>B) = (  (a2-b1)-(a1-b2) ) / ( (a2-a1)+(b2-b1) )
*/
function dominancie( $a1, $a2, $b1, $b2 )
{
	return (  max(0.0,($a2-$b1))-max(0.0,($a1-$b2)) ) / ( ($a2-$a1)+($b2-$b1) );
}

/** 
* Conversion from symbolic value in [0,1] to a linguistic range	
* suposing [0,6]
*/
function toRange( $value )
{
	return (  $value * 6.0 );
}

/**
* converts from 2-tuple to beta value  
*/
function toBeta( $term, $alpha ) 
{
  	$b = $term + $alpha;
   	return $b;
}
    
/**
* converts from beta value to 2-tuple representation
*/
function toTuple( $value )
{
    $i = round($value);
    return array ( $i, $value - $i );
}
    
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

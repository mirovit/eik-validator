<?php

namespace Mirovit\EIKValidator;

class EIKValidator {

	public function isValid($eik) {
		if ( !ctype_digit($eik) )
			throw new Exceptions\InvalidArgument("The provided EIK is not a number or contains non-numeric characters");

		$len = strlen($eik);

		if( $len !== 9 && $len !== 13 )
			throw new Exceptions\InvalidLength("The EIK should be either 9 or 13 digits long, you have provided {$len}", 1);

		if ( $len === 9 ) {
			return $this->validate9($eik);
		}

		// The 13 digit EIK is composed of a 9 digit EIK,
		// which if valid, the checksum of the last five
		// should be checked to confirm validity
		$eik_9 = substr($eik, 0, 9);
		if ($this->validate9($eik_9)) {
			$eik = substr($eik, -5);
			return $this->validate13($eik);
		}

		return false;
	}

	
	private function validate9($eik) {
		// Weights for the sums of a 9 digit EIK
		$weights = [ [1,2,3,4,5,6,7,8], [3,4,5,6,7,8,9,10] ];
		
		return $this->validate($eik, $weights);
	}
	
	
	private function validate13($eik) {
		// Weights for the two sums of a 13 digit EIK
		$weights = [ [2,7,3,5], [4,9,5,7] ];
		
		return $this->validate($eik, $weights);
	}
		
	
	private function validate($eik, $weights)
	{
		$eik_arr = str_split($eik);

		$weight = count(current($weights));
		
		$sum = 0;
		for($i = 0; $i < $weight; $i++) {
			$sum += $weights[0][$i] * $eik_arr[$i];
		} 
		
		$remainder = $sum % 11;
		
		// If the remainder is less than 10, it is the control
		// digit, which should be equal to the last digit of
		// the EIK
		if( $remainder < 10 && $remainder == end($eik_arr) )
		{
			return true;
		}

		$sum = 0;
		for($i = 0; $i < $weight; $i++) {
			$sum += $weights[1][$i] * $eik_arr[$i];
		}

		// If the second pass remainder is 10,
		// it should be set to 0 and check
		// whether the remainder is equal to the
		// control digit - the last one
		$remainder = $sum % 11;
		if ( $remainder === 10 ) {
			$remainder = 0;
		}
		
		if ( $remainder == end($eik_arr) ) {
			return true;	
		}
		
		return false;
	}	
}
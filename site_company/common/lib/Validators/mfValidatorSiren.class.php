<?php
// Example : 552 100 554

class mfValidatorSiren extends mfValidatorBase {
    
  protected function doIsValid($value)
  {
    $siren = trim($value);
    $siren = str_replace ( ' ', '', $siren );
    if (strlen ( $siren ) != 9 || !is_numeric ( $siren )) 
         throw new mfValidatorError($this, $this->translateMessages('siren number is invalid.'));
    $total = 0;
    for($i = 0; $i < 9; $i++) {
	$temp = substr ( $siren, $i, 1 );
	if ($i % 2 == 1) {
		$temp *= 2;
		if ($temp > 9) {
			$temp -= 9;
		}
	}
	$total += $temp;
    }
    if (($total % 10) != 0)
        throw new mfValidatorError($this, $this->translateMessages('siren number is invalid.'));
    return $siren;    
  }
}

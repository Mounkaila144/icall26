<?php

// 732 829 320 00074
class mfValidatorSiret extends mfValidatorBase {
   
   protected function configure($options = array(), $messages = array()) {
        parent::configure($options, $messages);
        $this->setOption('empty_value', "");
  }
    
  protected function doIsValid($values)
  {
    $siret = trim($values);
    if(empty($siret) || strlen($siret) != 14)
      throw new mfValidatorError($this, $this->translateMessages('siret number is invalid'));
    $sum = 0;
    for($i=0; $i<14; $i++)
    {
      if($i%2 == 0)
      {
        $tmp = $siret[$i]*2;
        $tmp = $tmp > 9 ? $tmp - 9 : $tmp;
      }
      else
      {
        $tmp= $siret[$i];
      }
      $sum += $tmp;
    }
    if($sum%10 !== 0)
      throw new mfValidatorError($this, $this->translateMessages('siret number is invalid'));
    return $siret;
  }
}

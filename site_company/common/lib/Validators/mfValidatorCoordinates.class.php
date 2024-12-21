<?php

/* latitude,longitude */
/* /(-?[\d]{2}\.[\d]{6},?){2}/ */

class mfValidatorCoordinates extends mfValidatorString {
   
   protected function configure($options = array(), $messages = array()) {    
        $this->setOption('missing', true);
        $this->addMessage("missing",$this->translateMessages("; is missing."));
        parent::configure($options, $messages);       
    } 
   protected function doIsValid($value)
   {
      if (strpos($value,";")===false)
          throw new mfValidatorError($this,"missing");    
      $coordinates=explode(";",$value);
      $latitude_validator=new mfValidatorNumber(array('min'=>-90,'max'=>90),array('min'=>__('minimun latitude has to be {min}'),'max'=>__('maximun latitude has to be {max}')));
      $longtitude_validator=new mfValidatorNumber(array('min'=>-90,'max'=>90),array('min'=>__('minimun longitude has to be {min}'),'max'=>__('maximun longitude has to be {max}')));
      $latitude_validator->isValid($coordinates[0]);
      $longtitude_validator->isValid($coordinates[1]);
      return $value;
   }   
   
}

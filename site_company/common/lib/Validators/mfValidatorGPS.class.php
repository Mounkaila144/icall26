<?php


class mfValidatorGPS extends mfValidatorString {
    
    protected function doIsValid($value) {
        $clean = parent::doIsValid($value);
        $clean=explode("|",$clean);
        var_dump($clean);
        //$pattern = $this->getPattern();
        
        
      /*  if (
                ($this->getOption('must_match') && !preg_match($pattern, $clean))
                ||
                (!$this->getOption('must_match') && preg_match($pattern, $clean))
        ) {
            throw new mfValidatorError($this, 'invalid', array('value' => $value));
        }*/
        return "";
    }
    
    
}

/*
 * function isValid($value)
    {
       if (!is_array($value))
         throw new Exception("Error tableaux");
       if (!isset($value['longitude']))
         throw new Exception("Error no longitude");
       if (!isset($value['latitude']))
         throw new Exception("Error no latitude"); 
      
       $patternL = "#^[0-9]+\Â°+([0-9]+\')?(([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)+\")?(N|S)$#";
       $patternG = "#^[0-9]+\Â°+([0-9]+\')?(([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)+\")?(E|W)$#";
       //var_dump(substr($value['longitude'],0,2));
       
       $degreG =  explode("Â°",$value['longitude']);  
       
        if(strpos($degreG['1'], "\'") === FALSE){
       $minuteG = explode("\'",$degreG['1']);
       $minuteGstring = implode($minuteG);
       }     
       if(strpos($minuteGstring,"\"") === false)
       {
           echo '';
       }   
       else    
       {
           $minuteG2 = explode("\"",$minuteGstring);
           $secondeG = explode("'",$minuteG2['0']);
       } 
         if (strpos($minuteGstring,"\"") === false)
         {
             echo'';
         }     
         else
         {
             $secondeGG = intval($secondeG['1']);
             if($secondeGG > 60)
             {
                throw new Exception("nombre depassÃ© dans Longitude ");
             }    
         }            
        $minutGG = intval($minuteG['0']);
        $degreGG = intval($degreG['0']);   
       if($degreGG > 180 OR $minutGG > 60)
           throw new Exception("nombre depassÃ© dans Longitude "); 
        
       if(!preg_match($patternG, $value['longitude']))
          throw new Exception("faute de syntax in longitude");
             
       if(!preg_match($patternL, $value['latitude']))
          throw new Exception("faute de syntax in latitude");
       return $value;
    }  
 */
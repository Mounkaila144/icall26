<?php

class EmailFormatter extends mfString {
    
     function split()
     {
        return new mfArray(array(
            'host'=>$this->explode("@")->getItemByKey(1),
            'name'=>$this->explode("@")->getItemByKey(0)            
        )); 
     }
   
}

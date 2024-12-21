<?php


class CustomerContractZoneCollection extends mfObjectCollection3  {
    
    
    
    
    function getNames()
    {
        if($this->names==null)
        {
            $this->names=new mfArray();
            foreach ($this->collection as $item)           
            {    
                    $this->names[]=(string)$item;
            }                  
        }
        return $this->names;
    }

    function getMax()
    {
        
        if($this->max==null)
        {
            $this->max=0;
            foreach ($this->collection as $item)           
            {    
                if ($this->max < $item->get('max_contracts'))  
                    $this->max = $item->get('max_contracts'); 
                
            }                  
        }
        return $this->max;
    }
    
    function getPostCodes(){
        if($this->postcodes==null)
        {
            $this->postcodes=new mfArray();
            foreach ($this->collection as $item){           
                
                    $this->postcodes->merge($item->getPostcodes()); 
                             
        }
    }
    return $this->postcodes;
    }

        
   
    /*function getPostCode(){
        if($this->postcodes==null)
        {    
            $this->postcodes=new mfArray();
            foreach ($this->collection as $item)            
                $this->postcodes->merge($item->getPostcodes());             
            $this->postcodes->unique();
        }
        return $this->postcodes;
    }*/
   

    
   
}

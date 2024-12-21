<?php


class PartnerPolluterCompanyCollection extends mfObjectCollection3 {
    
    function getNames()
    {
        if ($this->names===null)
        {
            $this->names=new mfArray();
            foreach ($this as $item)
               $this->names[]=$item->get('name');
        }   
        return $this->names;
    }
    
    
    function getTypes()
    {
       if ($this->types===null)
        {
            $this->types=new mfArray();
            foreach ($this as $item)
               $this->types[]=$item->get('type');
        }   
        return $this->types; 
    }
}

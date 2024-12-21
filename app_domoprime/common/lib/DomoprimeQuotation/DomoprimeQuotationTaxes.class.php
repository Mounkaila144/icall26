<?php

class DomoprimeQuotationTaxes extends mfArray {
    
    protected $taxes=null;
     
    function __construct(mfJson $data) {
        $this->collection=$data->decode(true);
    }
    
    function getValues()
    {
        if ($this->taxes===null)
        {
            $this->taxes=new mfArray();
            foreach ($this as $item)
            {
                $this->taxes[(string)(floatval($item['rate']) * 100.0)]=format_number($item['amount'],"#.00");
            }    
        }   
        return $this->taxes;
    }
    
    function toArray()     
    {
        $values=array();
        foreach ($this as $item) 
        {                       
           $values[(string)(floatval($item['rate']) * 100.0)]=array('amount'=>format_currency(round($item['amount'],2),'EUR'),'rate'=>format_pourcentage($item['rate']));
        }       
        return $values;
    }
}

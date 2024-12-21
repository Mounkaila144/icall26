<?php

class CustomerContractCompanyItemFormatterApi extends mfFormatterItemApi  {
    
    
    function __construct(CustomerContractCompany $item,$options=null) {      
         $this->item=$item;        
         parent::__construct($options);             
    }
    
    function getItem()
    {
        return $this->item;
    }
      
    function getDefaultsData()
    {
        return $this->getItem()->toArray(array());
    }
    
     function getData()
    {
        return array(                    
                     'id'  ,              
                     'name'=>array(
                         'format'=>array('method'=>'name','output'=>array('method'=>"ucfirst"))
                     )
                    );
    }
    
       
    function toArray()
    {
        return $this->data;                       
    }
}

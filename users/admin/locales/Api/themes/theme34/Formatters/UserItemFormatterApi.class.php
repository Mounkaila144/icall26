<?php

class UserItemTheme34FormatterApi extends mfFormatterItemApi  {
    
     protected $data=array(),$filter=null;
    
    function __construct(User $item,$filter=null) {      
         $this->item=$item;   
         $this->filter=$filter;
         parent::__construct();             
    }
    
    function getItem()
    {
        return $this->item;
    }
    
    
    function getFilter()
    {
       return $this->filter; 
    }
    
     
    function getDefaultsData()
    {
        return $this->getItem()->toArray(array());
    }
    
    function getData()
    {
        
        return array(                    
                     'id'=>array(
                         'fields'=>array(

                             'company_id'=>array(
                                     'method'=>'getCompany'
                                        ), 

                        ),          
                         'label'=>__("ID"),
                         ),
                    'is_locked',
                    'company_id'=>array(
                        'label'=>__('Company'),
                            'method'=>'getCompany'
                       ),
                    
                    //  'created_at'=>array('format'=>array('method'=>'CreatedAt','output'=>array('method'=>'Formatted','options'=>'d'))),  // formatter
                    //  'created_at'=>array('output'=>'')   // method in object 
                    );
    }
    
    
       
    function toArray()
    {
        return $this->data;                       
    }
}

<?php



 class CustomerMeetingProductBaseForm extends mfFormSite {
    
    protected static $product_list=array();
            
    function __construct($defaults = array(), $site = null) {
        if (empty(self::$product_list))
        {        
           self::$product_list=ProductUtils::getActiveProductsForSelect($site);            
        }  
        parent::__construct($defaults, array(), $site);        
    }
   
    
    function configure()
    {                        
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),
            "product_id"=>new mfValidatorChoice(array('choices'=>self::$product_list,'key'=>true)),                     
            "details"=> new mfValidatorString(array('required'=>false)),                       
            ) 
        );      
    }
    
 
}



<?php

class MutualProductCommissionFormFilter extends mfFormFilterBase {

    protected $site=null;
    
    function __construct($site=null)
    {       
        $this->site=$site;      
        parent::__construct();      
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function configure()
    {                    
        $this->setDefaults(array(            
            'order'=>array(
                "id"=>"asc",                        
            ),            
            'nbitemsbypage'=>"10",
        ));          
        $this->setClass('MutualProductCommission');
        $this->setFields(array());
        
        // SELECT * FROM `t_mutual_commission` INNER JOIN `t_mutual_product` 
        // ON `t_mutual_commission`.`mutual_product_id`=`t_mutual_product`.`id` 
        
        $this->setQuery("SELECT {fields} FROM ". MutualProductCommission::getTable().  
                        " INNER JOIN ". MutualProductCommission::getOuterForJoin('mutual_product_id').
                        " WHERE ". MutualProductCommission::getTableField('mutual_product_id')."='{mutual_product_id}' ".
                        ";"); 
        // Validators 
        $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                                                                         
                        ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(                            
                        ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(                          
                        ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                        ),array("required"=>false)),                                        
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    
   
}


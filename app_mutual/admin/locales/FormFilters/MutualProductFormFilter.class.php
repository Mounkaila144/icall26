<?php


class MutualProductFormFilter extends mfFormFilterBase {

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
        $this->setClass('MutualProduct');
        $this->setFields(array());
        
        // SELECT * FROM `t_mutual_product` INNER JOIN `t_partners_company` 
        // ON `t_mutual_product`.`financial_partner_id`=`t_partners_company`.`id` 
        
        $this->setQuery("SELECT {fields} FROM ". MutualProduct::getTable().  
                        " INNER JOIN ". MutualProduct::getOuterForJoin('financial_partner_id').
                        " WHERE ". MutualProduct::getTableField('financial_partner_id')."='{financial_partner_id}' ".
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


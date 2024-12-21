<?php


class MutualPartnerFormFilter extends mfFormFilterBase {

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
        $this->setClass('MutualPartner');
        $this->setFields(array());
        // SELECT * FROM `t_partners_company` LEFT JOIN `t_mutual_partner_params` 
        // ON `t_mutual_partner_params`.`financial_partner_id`=`t_partners_company`.`id` 
        
        $this->setQuery("SELECT {fields} FROM ".MutualPartner::getTable().  
                        " LEFT JOIN ". MutualPartnerParams::getInnerForJoin('financial_partner_id').
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


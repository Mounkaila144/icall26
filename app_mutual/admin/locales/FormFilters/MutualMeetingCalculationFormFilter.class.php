<?php


class MutualMeetingCalculationFormFilter extends mfFormFilterBase {

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
        $this->setClass('MutualEngineCalculationMeeting');
        $this->setFields(array());
        // SELECT * FROM `t_app_mutual_engine_calculation_meeting` ....
        
        $this->setQuery("SELECT {fields} FROM ". MutualEngineCalculationMeeting::getTable().  
                        " INNER JOIN ". MutualEngineCalculationMeeting::getOuterForJoin("meeting_id").
                        " INNER JOIN ". CustomerMeetingMutual::getOuterForJoin("customer_id").
                        ";"); 
//        $this->setQuery("SELECT {fields} FROM ". MutualEngineCalculationProduct::getTable().  
//                        " INNER JOIN ". MutualEngineCalculationProduct::getOuterForJoin("product_id").
//                        " INNER JOIN ". MutualEngineCalculationProduct::getOuterForJoin("mutual_calculation_id").
//                        " INNER JOIN ". MutualEngineCalculationMutual::getOuterForJoin("financial_partner_id").
//                        " INNER JOIN ". MutualEngineCalculationMutual::getOuterForJoin("meeting_calculation_id").
//                        " INNER JOIN ". MutualEngineCalculationMeeting::getOuterForJoin("meeting_id").
//                        " INNER JOIN ". CustomerMeetingMutual::getOuterForJoin("customer_id").
//                        ";"); 
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


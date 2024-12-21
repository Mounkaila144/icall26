<?php


class ProductActionsFormFilter extends mfFormFilterBase {
 
     protected $site=null;
    
    function __construct(Site $site)
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
                       'order'=>array(),
                      'nbitemsbypage'=>"*",
       ));
       // Base Query
       $this->setQuery("SELECT * FROM ".ProductAction::getTable().";");
       // Validators 
       $this->setValidators(array(       
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                      
                                                        "rate"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                       ),array("required"=>false)),
            'equal' => new mfValidatorSchema(array(   
                          
                            
                            ),array("required"=>false)),                              
             
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>"5","10"=>"10","20"=>"20","*"=>"*",))),         
        ));
    }
}



<?php

/*
 * Generated by SuperAdmin Generator date : 25/03/13 16:38:07
 */
 
class ModuleManagerFormFilter extends mfFormFilterBase {
 
    protected $site=null;
    
    function __construct(Site $site)
    {
      $this->site=$site;
      parent::__construct();
      
    }
    
    protected function getSite()
    {
     return $this->site;
    }
    
    function configure()
    {
        $this->setDefaults(array(
                       'order'=>array("id"=>"asc"),
                      'nbitemsbypage'=>"10",
       ));
       // Base Query
       $this->setQuery("SELECT * FROM ".moduleManager::getTable().";");
       // Validators 
       $this->setValidators(array(       
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                        "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                        "type"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                            "id"=>new mfValidatorString(array("required"=>false)),                            
                            "name"=>new mfValidatorString(array("required"=>false)),             
                            ),array("required"=>false)), 
            'equal' => new mfValidatorSchema(array(   
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO",),"required"=>false,"key"=>true)),  
                            "status"=>new mfValidatorChoice(array("choices"=>array(""=>"","loaded"=>"loaded","installed"=>"installed"),"required"=>false,"key"=>true)),  
                            "is_available"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO",),"required"=>false,"key"=>true)),
                            "in_site"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO",),"required"=>false,"key"=>true)), 
                            "type"=>new mfValidatorChoice(array("choices"=>array(""=>"")+moduleManagerUtils::getFieldValues('type',$this->getSite()),"key"=>true,"required"=>false)),   
                            ),array("required"=>false)),                       
              
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*",))),         
        ));
    }
}



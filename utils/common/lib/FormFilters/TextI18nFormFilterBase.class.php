<?php


class TextI18nFormFilterBase extends mfFormFilterBase {
 
    function __construct($class,$site=null)
    {
      $this->site=$site;   
      $this->setClass($class);
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
                            "lang"=>"asc",                        
            ),
            'search'=>array(
                        
            ),
            'nbitemsbypage'=>"10",
       ));
       $class=$this->getClass();
       // Validators 
       $this->setQuery("SELECT * FROM ".$class::getTable().";");
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "lang"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),    
                            "key"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),    
                           ),array("required"=>false)),
            'equal' => new mfValidatorSchema(array(
                            "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+textI18nBaseUtils::getLanguages($this->getClass(),$this->getSite()),"required"=>false)),                            
                           ),array("required"=>false)),
         /*   'search' => new mfValidatorSchema(array(
                            "application"=>new mfValidatorChoice(array("choices"=>array(""=>"","admin"=>"admin","frontend"=>"frontend"),"required"=>false)),
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                           ),array("required"=>false)), */
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
    }
 
}

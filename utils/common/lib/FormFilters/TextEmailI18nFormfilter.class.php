<?php


class TextEmailI18nFormFilter extends mfFormFilterBase {
 
    protected $site=null;
    
    function __construct($defaults,$site=null)
    {
      $this->site=$site;      
      parent::__construct($defaults);          
    }
       
    function getSite()
    {
     return $this->site;
    }   
           
    function configure()
    {             
       $this->setDefaults(array(
            'module'=>$this->getDefault('module'),
            'order'=>array(
                            "lang"=>"asc",                        
            ),
            'search'=>array(
                        
            ),
            'nbitemsbypage'=>"10",
       ));      
       // Validators 
       $this->setQuery("SELECT * FROM ".TextEmailI18n::getTable()." WHERE module='{module}';");
       $this->setValidators(array(
            'module'=> new mfValidatorString(),
            'order' => new mfValidatorSchema(array(
                            "lang"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),    
                            "key"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),    
                           ),array("required"=>false)),
            'equal' => new mfValidatorSchema(array(
                            "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+TextEmailI18nBaseUtils::getLanguages($this->getDefault('module'),$this->getSite()),"required"=>false)),                            
                           ),array("required"=>false)),
         /*   'search' => new mfValidatorSchema(array(
                            "application"=>new mfValidatorChoice(array("choices"=>array(""=>"","admin"=>"admin","frontend"=>"frontend"),"required"=>false)),
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                           ),array("required"=>false)), */
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"),"required"=>false)),         
        ));
    }
 
}
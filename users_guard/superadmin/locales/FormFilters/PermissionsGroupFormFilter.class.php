<?php

class PermissionsGroupFormFilter extends mfFormFilterBase {
 
    protected $site=null,$language=null,$objects=array();
    
    function __construct($language,$site=null)
    {
       $this->language=$language;       
       $this->site=$site;      
       parent::__construct();      
    }
    
    function getLanguage()
    {
      return $this->language;
    }
        
    function getSite()
    {
     return $this->site;
    }
    
    function configure()
    {
      $this->objects=array('PermissionGroupI18n','PermissionGroup');
      $this->setDefaults(array(
            'order'=>array(
                         //   "application"=>"asc",
            ),
            'search'=>array(
                         // "is_active"=>"",
            ),
            'lang'=>$this->getLanguage(),     
            'nbitemsbypage'=>10,
       ));
       $this->setClass('PermissionGroup');
       $this->setFields(array('value'=>'PermissionGroupI18n'));
       // Base Query
       $this->setQuery("SELECT {fields} FROM ".PermissionGroup::getTable().
                      " LEFT JOIN ".PermissionGroupI18n::getInnerForJoin('group_id'). " AND ".PermissionGroupI18n::getTableField('lang')."='{lang}'".                                                        
               ";");
       // Validators
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "value"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                          //  "updated_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                          //  "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                          //  "application"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorInteger(array("required"=>false)),
                            "name"=>new mfValidatorString(array("required"=>false)),                           
                         //   "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"required"=>false)),
                         //   "application"=>new mfValidatorChoice(array("choices"=>array(""=>"","admin"=>"admin","frontend"=>"frontend"),"required"=>false)),
                           ),array("required"=>false)),
           'lang'=>new LanguagesExistsValidator(array(),'frontend',$this->getSite()), 
           'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
    }
  
     function getObjectsForPager()
    {
        return $this->objects;
    }
    
    function hasObject($name)
    {             
        return in_array($name,$this->objects);
    }
}


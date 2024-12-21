<?php


class UsersTeamFormFilter extends mfFormFilterBase {

    protected $site=null,$objects=array();
    
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
       $this->objects=array("UserTeam","manager1"=>"User","manager2"=>"User");
       $this->setDefaults(array(           
            'order'=>array(
                            "id"=>"asc",                        
            ),            
            'nbitemsbypage'=>"10",
       ));          
       $this->setClass('UserTeam');       
       $this->setQuery("SELECT {fields} FROM ".UserTeam::getTable().
                       " LEFT JOIN ".UserTeam::getOuterForJoin('manager_id','manager1').
                       " LEFT JOIN ".UserTeam::getOuterForJoin('manager2_id','manager2').
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                        "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                     
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                          //  "id"=>new mfValidatorString(array("required"=>false)),                            
                          //  "link"=>new mfValidatorString(array("required"=>false)),                            
                          //  "title"=>new mfValidatorString(array("required"=>false)),                            
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                          //  "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                           // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "meta_title"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('meta_title',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "customer_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getCustomerFieldValuesForSelect($this->getSite()),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),                                         
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
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

<?php


class CustomerMeetingFormsFormFilter extends mfFormFilterBase {

    protected $language=null,$user=null,$objects=array();
    
    function __construct($user)
    {                     
       $this->user=$user;
       $this->language=$user->getCountry();       
       parent::__construct();      
    }        
    
    function getLanguage()
    {
      return $this->language;    
    }
    
  
    
    function getUser()
    {
        return $this->user;
    }
    
    
    function configure()
    {         
       
       $this->objects=array('CustomerMeetingForm',
                            'CustomerMeetingFormI18n'); 
       $this->addDefaults(array(    
            'lang'=>$this->getLanguage(),     
            'order'=>array(
                           // "in_at"=>"desc",                            
            ),        
            'equal'=>array(
                  //  "created_at"=>date("Y-m-d"),
            ),           
            'nbitemsbypage'=>"10",           
       ));          
       $this->setClass('CustomerMeetingForm'); 
       $this->setFields(array(
                'value'=>'CustomerMeetingFormI18n'
       ));
       $where=$this->getUser()->hasCredential([['superadmin','settings_meeting_form_list_admin']])?"":" WHERE is_admin='N'";     
       $this->setQuery("SELECT {fields} FROM ".CustomerMeetingForm::getTable().                      
                       " LEFT JOIN ".CustomerMeetingFormI18n::getInnerForJoin('form_id')." AND ".CustomerMeetingFormI18n::getTableField('lang')."='{lang}'".                                     
                       $where.
                       ";"); 
       // Validators        
       $this->setValidators(array( 
           
            'order' => new mfValidatorSchema(array(                                                      
                                                      "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                                                                           
                                                      "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                                                      "value"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                             "id"=>new mfValidatorString(array("required"=>false)),                            
                             "name"=>new mfValidatorString(array("required"=>false)),                                                                         
                            ),array("required"=>false)),                
            'equal' => new mfValidatorSchema(array(                                 
                            ),array("required"=>false)),   
            'lang'=>new LanguagesExistsValidator(array(),'frontend'), 
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","250"=>"250","500"=>"500","*"=>"*"),"key"=>true)),                               
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


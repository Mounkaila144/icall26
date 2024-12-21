<?php


class CustomerMeetingCommentsFormFilter extends mfFormFilterBase {

    protected $objects=array(),$user=null;
    
    function __construct($user)
    {                      
       $this->user=$user;     
     //  $this->conditions->setParameters(array('user_id'=>$this->getUser()->getGuardUser()->get('id')));
       parent::__construct();      
    }  
   
     function getUser()
    {
        return $this->user;
    }
    
    function configure()
    {                   
       $this->objects=array('CustomerMeetingCommentHistory','CustomerMeetingComment','User');
       $this->setDefaults(array(           
            'order'=>array(
                            "id"=>"desc",                        
            ),            
            'nbitemsbypage'=>"20",
       ));          
       $this->setClass('CustomerMeetingCommentHistory');
       $this->setFields(array('comment'=>'CustomerComment'));
       $this->setQuery("SELECT {fields} FROM ".CustomerMeetingCommentHistory::getTable().                      
                       " LEFT JOIN ".CustomerMeetingCommentHistory::getOuterForJoin('comment_id'). 
                       " LEFT JOIN ".CustomerMeetingCommentHistory::getOuterForJoin('user_id'). 
                       " WHERE ".CustomerMeetingComment::getTableField('meeting_id')."={meeting_id} AND ".CustomerMeetingComment::getTableField('type')." IN('','SYSTEM')".
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                        "comment"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                    //    "value"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                                                    //    "subject"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
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


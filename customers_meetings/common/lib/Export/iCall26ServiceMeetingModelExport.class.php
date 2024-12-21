<?php

class iCall26ServiceMeetingModelExport {
    
    protected $fields=null;
    
    function __construct() {        
        $this->fields=new mfArray(array(
              'meeting.id'=>new iCall26ServiceContractFormatField('CustomerMeeting','id'),
              'meeting.remarks'=>new iCall26ServiceContractFormatField('CustomerMeeting','remarks'),   
        ));        
    }
    
    function getFields()
    {
        return $this->fields;
    }
    
   /* function getFieldsForChoices()
    {
        $values=new mfArray();
        foreach ($this->getFields()->getKeys() as $key)
           $values[$key]=$key;
        return $values;
    }
    
    function getFieldByName($name,$default=null)
    {
        return isset($this->fields[$name])?$this->fields[$name]:$default;
    }   */     
}

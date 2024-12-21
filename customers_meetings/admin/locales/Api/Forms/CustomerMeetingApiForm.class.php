<?php

require_once __DIR__."/../../Forms/CustomerMeetingViewForm.class.php";

class CustomerMeetingApiForm extends CustomerMeetingViewForm {
    
    function __construct($user,$meeting,$defaults = array(), $site = null) {        
        parent::__construct($user,$meeting,$defaults, $site);
    }
    
            
    function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
    }
    
    
    function getMapping($fields=array())
    {
        if ($this->mapping===null)
        {
            $this->mapping=new mfArray();
            if (!$fields)            
                $fields = $this->getFields();            
            foreach ($fields as $field)
            {
               if (method_exists($this->$field, 'getMapping'))
                 $this->mapping[$field]=array('options'=>$this->$field->getMapping(),'name'=>$field,'validator'=>str_replace('mfValidator','',get_class($this->$field)));
               else
                 $this->mapping[$field]=array('options'=>$this->$field->getOptions(),'name'=>$field,'validator'=>str_replace('mfValidator','',get_class($this->$field)));
            }          
        }
        return $this->mapping;
    } 
    
}

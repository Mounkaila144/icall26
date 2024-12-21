<?php

class CustomerMeetingFormatter extends mfFormatter {
     
    
    
    function getCompiledSubjectForEmail($tpl="")
    {
       $params= array(
            '{customer}'=>(string)$this->getValue()->getCustomer()
       );                          
       return strtr($tpl,$params);
    }
   
    function getCreatedAt()
    {
        return new DateFormatter($this->getValue()->get('created__at'));
    }
    function getCreationAt()
    {
        return new DateFormatter($this->getValue()->get('creation_at'));
    }
    
    function getUpdatedAt()
    {
        return new DateFormatter($this->getValue()->get('updated__at'));
    }
    
    function getOpcAt()
    {
        return new DateFormatter($this->getValue()->get('opc_at'));
    }
    
    function getInAt()
     {
        return new DateFormatter($this->getValue()->get('in_at'));
    }
    
     function getCallbackAt()
    {
        return new DateFormatter($this->getValue()->get('callback_at'));
    }
     function getTreatedAt()
    {
        return new DateFormatter($this->getValue()->get('treated_at'));
    }
    
    
    function getCommentSettings()
    {
        return $this->settings=$this->settings===null?new CustomerCommentSettings(null,$this->getValue()->getSite()):$this->settings;
    }
    
    function getCensoredRemarks()
    {           
        return $this->getCommentSettings()->escapeText($this->getValue()->get('remarks'));    
    }
    
    function getOutput($tpl=""){        
        try{
            $output=new mfOutputApi($this->getValue());  
            
        }catch (mfException $e) {
            
          echo $e->getMessage();
        } 
            
        return $output->getOutput($tpl);           
    }
}

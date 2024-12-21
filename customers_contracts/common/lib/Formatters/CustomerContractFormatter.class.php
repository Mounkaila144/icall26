<?php


class CustomerContractFormatter extends mfFormatter {
    
    function getCreatedAt()
    {
        return new DateFormatter($this->getValue()->get('created_at'));
    }
    
    function getUpdatedAt()
    {
        return new DateFormatter($this->getValue()->get('updated_at'));
    }
      
    function getApfAt()
    {
        return new DateFormatter($this->getValue()->get('apf_at'));
    }
    
    function getQuotedAt()
    {
        return new DateFormatter($this->getValue()->get('quoted_at'));
    }
    
    function getBillingAt()
    {
        return new DateFormatter($this->getValue()->get('billing_at'));
    }

    function getOpcAt()
    {
        return new DateFormatter($this->getValue()->get('opc_at'));
    }
    
    function getSavAt()
    {
        return new DateFormatter($this->getValue()->get('sav_at'));
    }
    
    function getOpenedAt()
    {
        return new DateFormatter($this->getValue()->get('opened_at'));
    }
    
    function getDocAt()
    {
        return new DateFormatter($this->getValue()->get('doc_at'));
    }
    
    function getPreMeetingAt()
    {
        return new DateFormatter($this->getValue()->get('pre_meeting_at'));
    }
    
    function getSchedules($separator=",")
    {
        $values=new mfArray();
        foreach ($this->getValue()->schedules as $schedule)
           $values[]= $schedule->getFormatter()->getInAt()->getDateAndTime();
        return $values->implode($separator);
    }
    
     function getCommentSettings()
    {
        return $this->settings=$this->settings===null?new CustomerCommentSettings(null,$this->getValue()->getSite()):$this->settings;
    }
    
    function getCensoredRemarks()
    {           
        return $this->getCommentSettings()->escapeText($this->getValue()->get('remarks'));    
    }
    
}

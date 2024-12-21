<?php


class CustomerMeetingFormValidatorString extends mfValidatorString  {

  
    protected $request=null,$size=null;
    
    function setRequest($request)
    {
        $this->request=$request;
        return $this;
    }
    
    function setSize($size)
    {
        $this->size=$size;
        return $this;
    }
    
    function getRequest()
    {
        return $this->request;
    }
    
    function getSize()
    {
        return $this->size;
    }
}
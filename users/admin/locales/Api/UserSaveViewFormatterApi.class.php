<?php

require_once __DIR__."/UserViewFormatterApi.class.php";

class UserSaveViewFormatterApi extends UserViewFormatterApi {
    
        
    function process()
    {        
        try
        {
            if ($this->getItem()->isNotLoaded())
                throw new mfException('Item is invalid');
            // parent:: process();            
            // $this->data['schema']=$this->getForm()->getMapping()->getValues()->toArray();             
            if ($this->getForm()->isValid())
            {
                $this->getItem()->add($this->getForm()->getValues());
                if ($this->getItem()->isExist())
                   throw new mfException(__("User already exists."));               
                $this->getItem()->save();
                return $this->data['status']=__("OK");
                //return array('status'=>'OK');
            }    
            else
            {
                return $this->data['errors']=$this->getForm()->getErrorSchema()->getErrorsMessage();
            }    
        }
        catch (mfException $e)
        {
            $this->data['errors']=$e->getMessage();
        }       
        return $this;
    }
    
   
}


<?php

class UserMultipleProcess extends MultipleProcessCore {
   
    
    function process()
    {
        $query=new mfArray();  
        $params=array();
         if ($this->getActions()->in('generate_password'))
        {           
             if (!mfModule::isModuleInstalled('emailer_spooler',$this->getSite()))
                    throw new mfException(__("Emailer spooler module is not present."));  
            $messages=UserUtils::generatePassword($this->getSelection(),$this->getSite());
            $this->messages->merge($messages);            
        }

        if ($this->getActions()->in('profile'))
        {            
            $messages= UserProfile::updateProfileForMultipleUsers(new UserProfile($this->parameters['profile_id'],$this->getSite()),$this->getSelection(),$this->getSite());
            $this->messages->merge($messages);            
        }         
        if ($this->getActions()->in('secure_by_code'))
        {        
            $secure_by_code=(boolean)$this->parameters['is_secure_by_code']?'YES':'NO';
            $db=mfSiteDatabase::getInstance()
                ->setParameters(array('secure_by_code'=>$secure_by_code))                
                ->setQuery("UPDATE ".User::getTable().
                           " SET is_secure_by_code='{secure_by_code}'".
                           " WHERE id IN('".$this->getSelection()->implode("','")."')".                          
                           ";")                        
                ->makeSiteSqlQuery($this->getSite()); 
            $this->parameters['is_secure_by_code']?$this->messages->merge(__('Email by code is activated.')):$this->messages->merge(__('Email by code is disabled.'));            
        }         
        
        if (!$query->isEmpty())
        {           
           $db=mfSiteDatabase::getInstance()
                ->setParameters($params)                
                ->setQuery("UPDATE ".User::getTable().
                           " SET ".$query->implode().
                           " WHERE id IN('".$this->getSelection()->implode("','")."')".                          
                           ";")                        
                ->makeSiteSqlQuery($this->getSite()); 
       //    echo $db->getQuery();
        }  
        return $this;
    }
    
    function activateCode(){
        $params=array();
        $db=mfSiteDatabase::getInstance()
            ->setParameters($params)                
            ->setQuery("UPDATE ".User::getTable().
                       " SET is_secure_by_code='YES'".
                       " WHERE id IN('".$this->getSelection()->implode("','")."')". 
                       ";")                        
            ->makeSiteSqlQuery($this->getSite()); 
         return $this;
    }
    

}


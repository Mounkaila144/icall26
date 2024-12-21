<?php

require_once __DIR__."/UserNewFormatterApi.class.php";

class UserSaveNewFormatterApi extends UserNewFormatterApi {
    
    function getAction(){
        return  mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
    }
            
    function process()
    {        
        try
        {
            // if ($this->getItem()->isNotLoaded())
                //throw new mfException('Item is invalid');
            if ($this->getForm()->isValid())
            {
                $this->getItem()->add($this->getForm()->getValues());
                $this->getItem()->set('creator_id', mfcontext::getInstance()->getUser());
                if ($this->getItem()->isExist())
                    throw new mfException (__("User already exists"));  
                 if ($this->getForm()->getValue('password'))                                              
                     $this->getItem()->encryptPassword();  
                $this->getItem()->save();                        
                
                // Functions
                $this->getItem()->updateFunctions($this->getForm()->getValue('functions')); 
                // Functions
                $this->getItem()->updateGroups($this->getForm()->getValue('groups'));
                // Team
                if ($this->getForm()->getValue('team_id'))
                {    
                    $team_user=new UserTeamUsers();
                    $team_user->add(array('user_id'=> $this->getItem(),'team_id'=>$this->getForm()->getValue('team_id')));
                    $team_user->save();
                } 
                $this->getAction()->getEventDispather()->notify(new mfEvent($this->getItem(), 'user.change','new')); 
                return $this->data['status']="OK";
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


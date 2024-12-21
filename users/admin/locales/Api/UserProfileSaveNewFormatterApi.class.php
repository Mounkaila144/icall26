<?php

require_once __DIR__."/UserProfileNewFormatterApi.class.php";

class UserSaveNewFormatterApi extends UserProfileNewFormatterApi {
    
    function getAction(){
        return  mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
    }
            
    function process()
    {        
 

        if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_profile_view'))))
           $this->forwardTo401Action();
        try 
        {          
            if ($this->getForm()>isValid()) 
            {
                $this->getItem()->add($this->getForm()>getValues());
                if ($this->getItem()->isExist())
                    throw new mfException(__("User already exists"));  
                if(!$this->getForm()>getProfile())       
                    throw new mfException(__("Profile doesn't exist"));  
                if ($this->getForm()>getValue('password'))                                              
                     $this->getItem()->encryptPassword();  
              // echo "<pre>";  var_dump($this->getItem(),$this->getForm()>getValues());  echo "</pre>";                 
                $this->getItem()->save();   
//                var_dump($this->getForm()>getValue('team_id'));
                $this->getItem()->updateTeam($this->getForm()>getTeam(),$this->getForm()>isTeamManager());
                $this->getItem()->getProfile()->setProfile($this->getForm()>getProfile())->save();                 
               $this->getAction()->getEventDispather()->notify(new mfEvent($this->getItem(), 'user.change','profile')); 
               return $this->data['status']=__("User %s (%s) has been saved.",array($this->getItem(),$this->getItem()->get('username')));
            }
            else
            {    
               $this->getItem()->add($request->getPostParameter('User'));
               $this->getItem()->getProfile()->set('profile_id',$this->getForm()>getDefault('profile_id'));
               return $this->data['errors']=$this->getForm()->getErrorSchema()->getErrorsMessage();
            //   var_dump($this->getForm()>getErrorSchema()->getErrorsMessage());
            }          
   
        }
        catch (mfException $e)
        {
            $this->data['errors']=$e->getMessage();
        }       
        return $this;
    }
    
   
}


<?php

require_once dirname(__FILE__)."/../locales/Forms/UserViewProfileForm.class.php";


class users_ajaxSaveUserProfileAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {             
        $messages = mfMessages::getInstance();      
        if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_profile_view'))))
           $this->forwardTo401Action();
        try 
        {          
            $this->user_settings=  UserSettings::load();
            $this->item = new User($request->getPostParameter('User'),'admin'); // new object        
            if (!$this->item->isAuthorized('view'))
                  $this->forwardTo401Action();  
            $this->form = new UserViewProfileForm($this->item,$this->getUser(),$request->getPostParameter('User'));   
            $this->getEventDispather()->notify(new mfEvent($this->form, 'user.view.config',$this->item)); 
            if (!$request->isMethod('POST') || !$request->getPostParameter('User')!=null) 
                return ;
            $this->form->bind($request->getPostParameter('User'));
            if ($this->form->isValid()) 
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("User already exists"));  
                if(!$this->form->getProfile())       
                    throw new mfException(__("Profile doesn't exist"));  
                if ($this->form->getValue('password'))                                              
                     $this->item->encryptPassword();  
              // echo "<pre>";  var_dump($this->item,$this->form->getValues());  echo "</pre>";    
                $this->getEventDispather()->notify(new mfEvent($this->item, 'user.change.before',['form'=>$this->form])); 
                $this->item->save();   
//                var_dump($this->form->getValue('team_id'));
                $this->item->updateTeam($this->form->getTeam(),$this->form->isTeamManager());
                $this->item->getProfile()->setProfile($this->form->getProfile())->save();                
                $messages->addInfo(__("User %s (%s) has been saved.",array($this->item,$this->item->get('username'))));
               $this->getEventDispather()->notify(new mfEvent($this->item, 'user.change',['action'=>'profile','form'=>$this->form])); 
               $this->forward('users','ajaxListPartial');
            }
            else
            {    
               $this->item->add($request->getPostParameter('User'));
               $this->item->getProfile()->set('profile_id',$this->form->getDefault('profile_id'));
               $messages->addError(__("Forms has some errors."));
            //   var_dump($this->form->getErrorSchema()->getErrorsMessage());
            }                        
       } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }          
    }

}

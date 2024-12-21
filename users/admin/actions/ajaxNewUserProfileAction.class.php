<?php

// http://www.ecosol28.net/admin/module/site/users/admin/NewUserProfile
require_once dirname(__FILE__)."/../locales/Forms/UserNewProfileForm.class.php";


class users_ajaxNewUserProfileAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {             
        $messages = mfMessages::getInstance();    
         if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_profile_new'))))
           $this->forwardTo401Action();
        try 
        {
            $this->user=$this->getUser();
            $this->user_settings=  UserSettings::load();
            $this->item = new User(null,'admin'); // new object          
            $this->form = new UserNewProfileForm($this->getUser(),$request->getPostParameter('User'));               
            $this->item->set('team_id',$this->form->getTeamByDefault());
            $this->getEventDispather()->notify(new mfEvent($this->form, 'user.new.config',$this->item));          
            if (!$request->isMethod('POST') || !$request->getPostParameter('User')!=null) 
                return ;
            $this->form->bind($request->getPostParameter('User'));
            if ($this->form->isValid()) 
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException (__("User already exists"));  
                if(!$this->form->getProfile())       
                    throw new mfException (__("Profile doesn't exist"));  
                if ($this->form->getValue('password'))                                              
                     $this->item->encryptPassword();       
                $this->item->set('creator_id',$this->getUser()->getGuardUser());
                $this->item->save();                   
                $this->item->getProfile()->setProfile($this->form->getProfile())->save();                 
                $this->item->createOrUpdateTeam($this->form->getValue('team_id'),$this->form->getValue('team'),$this->form->getValue('manager_id'),$this->form->isTeamManager());                
                $messages->addInfo(__("User %s (%s) has been saved.",array($this->item,$this->item->get('username'))));
                // $this->getEventDispather()->notify(new mfEvent($this->item, 'user.change','new'));     
                $this->getEventDispather()->notify(new mfEvent($this->item, 'user.change',['action'=>'new','form'=>$this->form])); 
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

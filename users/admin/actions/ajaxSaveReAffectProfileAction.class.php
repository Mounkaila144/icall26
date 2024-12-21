<?php

require_once __DIR__."/../locales/Forms/ProfileReAffectForm.class.php";

class users_ajaxSaveReAffectProfileAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();    
         if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_profile_reaffect'))))
            $this->forwardTo401Action ();
          $this->profile=new UserProfile($request->getPostParameter('Profile')) ;
          if ($this->profile->isNotLoaded())
              return;
          $this->form=new ProfileReAffectForm($this->profile);       
          if (!$request->getPostParameter('ProfileReAffect'))
              return ;
          $this->form->bind($request->getPostParameter('ProfileReAffect'));
          if ($this->form->isValid())
          {
               $this->profile->affectTo($this->form->getProfile());
               $messages->addInfo(__('Profile %s has been reaffect to profile %s (%s profile impacted).',array($this->profile->get('name'),$this->form->getProfile()->get('name'),$this->profile->getNumberOfUsersAffected())));
               //$this->getEventDispather()->notify(new mfEvent($this->profile,'user.guard.profile.reaffect',array('profile'=>$this->form->getProfile())));
               $this->forward('users', 'ajaxListPartialProfile');
          }   
          else
          {
              $messages->addError(__('Form has some errors.'));
          }    
    }

}

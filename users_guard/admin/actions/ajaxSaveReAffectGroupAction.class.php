<?php

require_once __DIR__."/../locales/Forms/GroupReAffectForm.class.php";

class users_guard_ajaxSaveReAffectGroupAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();    
         if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_groups_reaffect'))))
            $this->forwardTo401Action ();
          $this->group=new Group($request->getPostParameter('Group'),'admin') ;
          if ($this->group->isNotLoaded())
              return;
          $this->form=new GroupReAffectForm($this->group);       
          if (!$request->getPostParameter('GroupReAffect'))
              return ;
          $this->form->bind($request->getPostParameter('GroupReAffect'));
          if ($this->form->isValid())
          {
               $this->group->affectTo($this->form->getGroup());
               $messages->addInfo(__('Group %s has been reaffect to group %s (%s users impacted).',array($this->group->get('name'),$this->form->getGroup()->get('name'),$this->group->getNumberOfUsersAffected())));
               $this->getEventDispather()->notify(new mfEvent($this->group,'user.guard.group.reaffect',array('group'=>$this->form->getGroup())));
               $this->forward('users_guard', 'ajaxListPartialGroup');
          }   
          else
          {
              $messages->addError(__('Form has some errors.'));
          }    
    }

}

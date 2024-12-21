<?php

require_once __DIR__."/../locales/Forms/GroupReAffectForm.class.php";

class users_guard_ajaxReAffectGroupAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();                     
          $this->group=new Group($request->getPostParameter('id'),'admin') ;
          if ($this->group->isNotLoaded())
              return;
          $this->form=new GroupReAffectForm($this->group);       
    }

}

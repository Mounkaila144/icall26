<?php

require_once dirname(__FILE__)."/../locales/Forms/TeamUsersForm.class.php";

class users_ajaxSaveTeamUsersAction extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';    
            
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");   
        $this->item=new UserTeam($request->getParameter('TeamUsers'),$this->site);   
        if ($this->item->isNotLoaded())
            return ;       
        $this->form= new TeamUsersForm($request->getParameter('TeamUsers',array('users'=>$this->item->getUsersById())),$this->site);
        if ($request->isMethod('POST') && $request->getPostParameter('TeamUsers'))
        {           
            $this->form->bind($request->getPostParameter('TeamUsers'));
            if ($this->form->isValid())
            {                     
                $this->item->updateUsers($this->form['users']->getValue());
                $messages->addInfo(__("Users have been added to team."));
                $this->forward('users','ajaxListPartialTeam');
            }   
            else
            {               
                $messages->addError(__("Form has some errors."));
            }    
        }         
          
    }

}

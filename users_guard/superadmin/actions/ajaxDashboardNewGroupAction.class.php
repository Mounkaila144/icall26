<?php

require_once dirname(__FILE__)."/../locales/Forms/GroupSuperAdminNewForm.class.php";

class users_guard_ajaxDashboardNewGroupAction extends mfAction {
  
     
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        try {
            $this->form = new GroupsSuperAdminNewForm($request->getPostParameter('group'));  // Repopulate in same time if error 
            if ($request->isMethod('POST') && $request->getPostParameter('group'))
            {    
                $this->form->bind($request->getPostParameter('group'));
                if ($this->form->isValid()) {
                    $this->groupCollection = new GroupCollection($this->form->getValue('groups'));
                    $this->groupCollection->save();
                    $messages->addInfo(__("Groups have been saved."));
                    $this->forward("users_guard","ajaxDashboardListPartialGroups");
                }
                else
                {                   
                        $messages->addErrors($this->form->getErrorSchema()->getGlobalErrors());
                }
            }
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }       
        
    }

}

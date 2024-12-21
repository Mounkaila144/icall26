<?php

require_once dirname(__FILE__)."/../locales/Forms/GroupForm.class.php";

class users_guard_ajaxDashboardSaveGroupAction extends mfAction {
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        try {
            $this->form = new groupForm();
            $this->group=new Group($request->getPostParameter('group'));
            $this->form->bind($request->getPostParameter('group'));
            if ($this->form->isValid()) {
                if ($this->group->isExist())
                     return $messages->addError(__("Group already exists")); 
                $this->group->add($this->form->getValues());
                $this->group->save();
                $messages->addInfo(__("Group has been saved"));
                $this->forward('users_guard','ajaxDashboardListPartialGroups');
            }
            else
            {
                $messages->addErrors($this->formFilter->getErrorSchema()->getGlobalErrors());
            }    
        }       
        catch (mfException $e)
        {
           $messages->addError($e);
        }             
    }
}
  
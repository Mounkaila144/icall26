<?php

require_once dirname(__FILE__)."/../locales/Forms/GroupNewForm.class.php";


class users_guard_ajaxNewGroupAction extends mfAction {
  
    

    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
                
         
        try {
            $this->form = new GroupNewForm();            
            $this->group = new Group($request->getPostParameter('Group'),'admin');
            if ($request->isMethod('POST') && $request->getPostParameter('Group'))
            {    
                $this->form->bind($request->getPostParameter('Group'));
                if ($this->form->isValid()) {
                    if ($this->group->isExist())
                       return $messages->addError(__("Group name already exists")); 
                    $this->group->add($this->form->getValues());
                    $this->group->save();
                    $messages->addInfo(__("Group %s has been saved",array($this->group->get('name'))));
                    $this->forward('users_guard','ajaxListPartialGroup');
                }
                else
                {    
                    //var_dump($this->form->getErrorSchema()->getErrorsMessage());
                   $messages->addError(__("Form has some errors."));
                }        
            }
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }             
    }

}

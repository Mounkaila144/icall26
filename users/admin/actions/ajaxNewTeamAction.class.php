<?php

require_once dirname(__FILE__)."/../locales/Forms/UserTeamNewForm.class.php";

class users_ajaxNewTeamAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        try 
        {                   
            $this->form= new UserTeamNewForm();
            $this->item=new UserTeam();   
            if ($request->isMethod('POST') && $request->getParameter('UserTeam'))
            {
                $this->form->bind($request->getParameter('UserTeam'));
                if ($this->form->isValid())
                {
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist())
                        throw new mfException(__("Team is already exist."));
                    $this->item->save();
                    $messages->addInfo(__("Team has been created."));
                    $this->forward('users', 'ajaxListPartialTeam');
                }    
                else 
                {
                    $messages->addError(__("Form has some errors."));
                    $this->item->add($request->getParameter('UserTeam'));
                }
            }  
        }
        catch (mfException $e)
        {
              $messages->addError($e);
        }
    }

}

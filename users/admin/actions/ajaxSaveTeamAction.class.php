<?php

require_once dirname(__FILE__)."/../locales/Forms/UserTeamForm.class.php";

class users_ajaxSaveTeamAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                      
        $this->form= new UserTeamForm();
        $this->item=new UserTeam($request->getParameter('UserTeam'));   
        try
        {
            if ($request->isMethod('POST') && $request->getParameter('UserTeam'))
            {
                $this->form->bind($request->getParameter('UserTeam'));
                if ($this->form->isValid())
                {
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist())
                        throw new mfException(__("Team is already exist."));
                    $this->item->save();
                    $messages->addInfo(__("Team has been updated."));
                    $this->forward('users', 'ajaxListPartialTeam');
                }    
                else 
                {
                    $messages->addInfo(__("Form has some errors."));
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

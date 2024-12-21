<?php

require_once dirname(__FILE__)."/../locales/Forms/UserTeamForm.class.php";

class users_ajaxSaveTeamAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                    
        $this->form= new UserTeamForm(array(),$this->site);
        $this->item=new UserTeam($request->getParameter('UserTeam'),$this->site);   
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
                    //var_dump($this->form->getErrorSchema());
                }
            }  
        }
        catch (mfException $e)
        {
             $messages->addError($e);
        }
    }

}

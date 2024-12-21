<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeSubventionTypeNewForm.class.php";

class app_domoprime_ajaxNewTypeAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                  
        $this->form= new DomoprimeSubventionTypeNewForm($request->getPostParameter('DomoprimeSubventionType'));
        $this->item=new DomoprimeSubventionType(); 
        if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeSubventionType'))
            return ;
        $this->form->bind($request->getPostParameter('DomoprimeSubventionType'));
        try
        {
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());             
                if ($this->item->isExist())
                    throw new mfException(__('Type already exists.'));
                $this->item->save();
                $messages->addInfo(__('Type has been created.'));              
                $this->forward('app_domoprime','ajaxListPartialType');
            }   
            else
            {
                $messages->addError(__('Form has some errors.'));
                $this->item->add($this->form->getDefaults());
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}

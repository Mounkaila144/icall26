<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeSubventionTypeViewForm.class.php";

class app_domoprime_ajaxSaveTypeAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();               
        $this->form= new DomoprimeSubventionTypeViewForm();
        $this->item=new DomoprimeSubventionType($request->getPostParameter('DomoprimeSubventionType'));
        $this->form->bind($request->getPostParameter('DomoprimeSubventionType'));
        try
        {
            if ($this->form->isValid())
            {
               $this->item->add($this->form->getValues());             
                if ($this->item->isExist())
                    throw new mfException(__('Type already exists.'));
                $this->item->save();
                $messages->addInfo(__('Typel has been updated.'));
                $this->forward('app_domoprime', 'ajaxListPartialType');
            }   
            else
            {    
                $messages->addError(__('Form has some errors.'));
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}

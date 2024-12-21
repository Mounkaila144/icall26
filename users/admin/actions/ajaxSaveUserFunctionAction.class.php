<?php

require_once dirname(__FILE__)."/../locales/Forms/UserFunctionsForm.class.php";

class users_ajaxSaveUserFunctionAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {                        
        $messages = mfMessages::getInstance();               
        $this->user=new User($request->getPostParameter('User'),'admin');  
        $this->form = new UserFunctionsForm($request->getPostParameter('UserFunctions'));  
        $this->form->setDefault('functions',$this->user->getFunctionsId());
        $this->functions=UserFunctionBaseUtils::getFieldValuesForI18nSelect('value',$this->getUser()->getCountry());
        if ($request->isMethod('POST') && $request->getPostParameter('UserFunctions'))
        {
            $this->form->bind($request->getPostParameter('UserFunctions'));
            if ($this->form->isValid())
            {                
                $this->user->updateFunctions($this->form['selection']->getValues());                
                $messages->addInfo(__("Functions have been saved."));
                $this->forward('users','ajaxListPartial');
            }  
            else
            {
                $messages->addError(__("Form has some errors."));                
            }    
        }    
    }

}

<?php

require_once dirname(__FILE__)."/../locales/Forms/UserFunctionsForm.class.php";

class users_ajaxSaveUserFunctionAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
       
    function execute(mfWebRequest $request) {                        
        $messages = mfMessages::getInstance();        
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->user=new User($request->getPostParameter('User'),'admin',$this->site);  
        $this->form = new UserFunctionsForm($request->getPostParameter('UserFunctions'),$this->site);  
        $this->form->setDefault('functions',$this->user->getFunctionsId());
        $this->functions=UserFunctionBaseUtils::getFieldValuesForI18nSelect('value',$this->getUser()->getCountry(),$this->site);
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

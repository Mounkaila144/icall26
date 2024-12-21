<?php

require_once dirname(__FILE__)."/../locales/Forms/UserAttributionNewForm.class.php";

class users_ajaxNewAttributionI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");      
        $form=new LanguageFrontendForm($this->getUser()->getCountry(),$this->site);
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('users','ajaxListPartialStatus');  
        }       
        $this->form= new UserAttributionNewForm((string)$form['lang'],array(),$this->site);
        $this->item=new UserAttributionI18n(array('lang'=>(string)$form['lang']),$this->site);        
    }

}

<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterModelI18nNewForPolluterForm.class.php";

class partners_polluter_ajaxNewModelI18nForPolluterAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();       
        $this->polluter=new PartnerPolluterCompany($request->getPostParameter('Polluter'));
        if ($this->polluter->isNotLoaded())
            return ;
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $request->addRequestParameter('polluter',$this->polluter);
            $this->forward('partners_polluter','ajaxListPartialModelI18nForPolluter');  
        }             
        $this->form= new PartnerPolluterModelI18nNewForPolluterForm();
        $this->item_i18n=new PartnerPolluterModelI18n(array('lang'=>(string)$form['lang'],'polluter_id'=>$this->polluter->get('id')));        
    }

}

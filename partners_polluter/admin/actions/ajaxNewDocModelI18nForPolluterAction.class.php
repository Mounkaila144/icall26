<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterModelDocNewForPolluterForm.class.php";

class partners_polluter_ajaxNewDocModelI18nForPolluterAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->polluter=new PartnerPolluterCompany($request->getPostParameter('Polluter'));
        if ($this->polluter->isNotLoaded())
            return ;
        $form=new LanguageFrontendForm($this->getUser()->getCountry(),$this->site);
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('partners_polluter','ajaxListPartialModel');  
        }       
        $this->form= new PartnerPolluterModelDocNewForPolluterForm((string)$form['lang'],array());
        $this->item_i18n=new PartnerPolluterModelI18n(array('lang'=>(string)$form['lang']));   
        $this->country=$this->getUser()->getCountry();
    }

}

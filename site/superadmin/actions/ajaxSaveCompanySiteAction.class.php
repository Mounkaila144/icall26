<?php

require_once dirname(__FILE__)."/../locales/Forms/SiteCompanyForm.class.php";



class site_ajaxSaveCompanySiteAction extends mfAction {
    
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $this->site=new Site($request->getPostParameter('Site'));
        $this->form = new SiteCompanyForm($request->getPostParameter('Site'));  
        if (!$request->isMethod('POST') || !$request->getPostParameter('Site') || $this->site->isNotLoaded())
            return ;
        $this->form->bind($request->getPostParameter('Site'));        
        if ($this->form->isValid())
        {
            $this->site->add($this->form->getValues());
            $this->site->save();
            $messages->addInfo(__('Company has been saved.'));
            $this->forward('site','ajaxListPartial');
        }   
        else
        {
            $messages->addError(__("Form has some errors."));
           // var_dump($this->form->getErrorSchema()->getErrorsMessage());
        }    
    }

}


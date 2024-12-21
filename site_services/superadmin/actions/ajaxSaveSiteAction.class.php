<?php

require_once __DIR__."/../locales/Forms/SiteServicesViewDescriptionForm.class.php";

class site_services_ajaxSaveSiteAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance();        
        $this->item=new SiteServicesSite($request->getPostParameter('SiteServicesSite'));    
        $this->form=new SiteServicesViewDescriptionForm();
        if (!$request->isMethod('POST') || $this->item->isNotLoaded() || !$request->getPostParameter('SiteServicesSite'))
            return ;
        $this->form->bind($request->getPostParameter('SiteServicesSite'));
        if ($this->form->isValid())
        {
            $this->item->add($this->form->getValues());
            $this->item->save();
            $messages->addInfo(__('Information has been updated.'));
            $this->forward($this->getModuleName(), 'ajaxListPartialSiteServices');
        }
    }

  

}

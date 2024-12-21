<?php

require_once dirname(__FILE__).'/../locales/Forms/SiteServicesNewServerForm.class.php';

class site_services_ajaxNewSiteServicesServerAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();     
        $this->user=$this->getUser();              
        $this->form=new SiteServicesNewServerForm($request->getPostParameter('SiteServicesServer'));
        $this->item=new SiteServicesServer();
        if (!$request->isMethod('POST') || !$request->getPostParameter('SiteServicesServer'))
            return ;
        $this->form->bind($request->getPostParameter('SiteServicesServer'));
        try
        {
            if ($this->form->isValid())
            {              
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("Server already exists."));
                $this->item->save();
                $messages->addInfo(__("Server has been created"));             
                $this->forward('site_services','ajaxListPartialSiteServicesServers');
            }   
            else
            {
                $messages->addError(__("Form has some errors."));
                //echo '<pre>';var_dump($this->form->getErrorSchema()->getErrorsMessage());echo '</pre>';
                $this->item->add($this->form->getDefaults());
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}

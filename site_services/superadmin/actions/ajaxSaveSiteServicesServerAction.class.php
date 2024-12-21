<?php

require_once dirname(__FILE__).'/../locales/Forms/SiteServicesServerForm.class.php';

class site_services_ajaxSaveSiteServicesServerAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();     
        $this->user=$this->getUser();              
        $this->form=new SiteServicesServerForm($request->getPostParameter('SiteServicesServer'));
        $this->item=new SiteServicesServer($request->getPostParameter('SiteServicesServer'));     
        if (!$request->isMethod('POST') || !$request->getPostParameter('SiteServicesServer') || $this->item->isNotloaded())
            return ;
        $this->form->bind($request->getPostParameter('SiteServicesServer'));
        try
        {
            if ($this->form->isValid())
            {              
                $this->item->add($this->form->getValues());
                $this->item->save();                             
                $messages->addInfo(__("Server  has been updated")); 
                $this->forward('site_services','ajaxViewSiteServicesServer');
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
        return $response;
    }

}

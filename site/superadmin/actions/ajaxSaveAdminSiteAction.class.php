<?php

require_once dirname(__FILE__)."/../locales/Forms/SiteEditForm.class.php";

class site_ajaxSaveAdminSiteAction extends mfAction {

        const SITE_NAMESPACE = 'system/site';
        
    function execute(mfWebRequest $request) {        
        $messages = mfMessages::getInstance();      
        try {
            $this->form = new SiteEditForm();
            $this->site = new Site($request->getPostParameter('Site'));
            if ($request->isMethod('POST') && $request->getPostParameter('Site'))
            {    
                $this->form->bind($request->getPostParameter('Site'));
                if ($this->form->isValid()) {
                        $this->site->add($this->form->getValues())->save();  
                        // Modify the Site in session if necessary
                        $siteSession=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);     
                        if ( $siteSession && $this->site->isEqual($siteSession))
                             $this->getUser()->getStorage()->write(self::SITE_NAMESPACE, $this->site);  
                        $messages->addInfo(__("Site [%s] has been saved",$this->site->get('site_host')));                    
                        $this->site->removeFrontendHostCache(); // Remove host cache
                        $this->forward('site','ajaxListPartial');
                }
                else
                {
                    $messages->addError(__("Form has some errors."));
                    $this->site->add($request->getPostParameter('Site'));
                }    
            }              
        } 
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
    }

}


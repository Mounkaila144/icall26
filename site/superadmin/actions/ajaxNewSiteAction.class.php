<?php

require_once dirname(__FILE__)."/../locales/Forms/SiteForm.class.php";



class site_ajaxNewSiteAction extends mfAction {
    
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        try {  
            $this->form = new SiteForm($request->getPostParameter('Site'));                             
            if ($request->isMethod('POST') && $request->getPostParameter('Site'))
            {  
                $this->form->bind($request->getPostParameter('Site'));
                if ($this->form->isValid()) {
                    $site=new Site((string)$this->form['site_host']);
                    if ($site->isLoaded())
                         throw new mfException(__("Site already exists")); // Message d'information
                    $site->add($this->form->getValues());
                    $site->save(); 
                    SiteUtils::createSite($site); 
                    $messages->addInfo(__("Site [%s] has been created.", (string)$this->form['site_host']));                                        
                    $this->forward('site','ajaxListPartial');
                }               
                else
                {                    
                    $messages->addError(__("Form has some errors."));
                }    
            }
        }     
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}


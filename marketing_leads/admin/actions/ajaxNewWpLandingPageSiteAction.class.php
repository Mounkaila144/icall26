<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpLandingPageSiteNewForm.class.php";

class marketing_leads_ajaxNewWpLandingPageSiteAction extends mfAction {
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();            
        
        $this->form= new MarketingLeadsWpLandingPageSiteNewForm();
        $this->item=new MarketingLeadsWpLandingPageSite();     
        
        if (!$request->isMethod('POST') || !$request->getPostParameter('WpLandingPageSite'))
            return;  
        try 
        {
            $this->form->bind($request->getPostParameter('WpLandingPageSite'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
//                if ($this->item->isExist())
//                    throw new mfException (__("Wordpress landing page site already exists"));   
                $this->item->save();
                $messages->addInfo(__("Wordpress landing page site has been created."));
                $this->forward('marketing_leads','ajaxListPartialWpLandingPageSite');
            }   
            else
            {   // Repopulate
                echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";    
                $this->item->add($this->form->getValues());             
                $messages->addError(__("Form has some errors."));                                   
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
   }
}

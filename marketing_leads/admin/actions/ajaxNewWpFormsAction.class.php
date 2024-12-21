<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsNewForm.class.php";

class marketing_leads_ajaxNewWpFormsAction extends mfAction {
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();            
        
        $this->form= new MarketingLeadsWpFormsNewForm();
        $this->item=new MarketingLeadsWpForms();     
        $this->landing_page_site = $request->getRequestParameter("site",new MarketingLeadsWpLandingPageSite($request->getPostParameter("WpLandingPageSite")));
        
        if($this->landing_page_site->isNotLoaded())
        {
            $messages->addError(__('Site not loaded.'));
            $this->forward("marketing_leads", "ajaxListPartialWpLandingPageSite");
        }
        
        if (!$request->isMethod('POST') || !$request->getPostParameter('WpForms'))
            return;  
        try 
        {
            $this->form->bind($request->getPostParameter('WpForms'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                $this->item->set('site_id',$this->landing_page_site);
                $this->item->save();
                $messages->addInfo(__("Lead has been created."));
                $this->forward('marketing_leads','ajaxListPartialWpForms');
            }   
            else
            {   // Repopulate  
                $this->item->add($request->getPostParameter('WpForms'));             
                $messages->addError(__("Form has some errors."));                                   
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }        
    }
}

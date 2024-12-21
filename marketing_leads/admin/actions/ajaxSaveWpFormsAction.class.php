<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsViewForm.class.php";
 
class marketing_leads_ajaxSaveWpFormsAction extends mfAction {
    
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new MarketingLeadsWpFormsViewForm($request->getPostParameter('WpForms')); 
        $this->landing_page_site = $request->getRequestParameter("site",new MarketingLeadsWpLandingPageSite($request->getPostParameter("WpLandingPageSite")));
        
        if($this->landing_page_site->isNotLoaded())
        {
            $messages->addError(__('Site not loaded.'));
            $this->forward("marketing_leads", "ajaxListPartialWpLandingPageSite");
        }
        
        $this->item=new MarketingLeadsWpForms($this->form->getDefaults());
        if($this->item->isNotLoaded())
        {
            $messages->addError(__('item not loaded.'));
            $request->addRequestParameter("site", $this->landing_page_site);
            $this->forward("marketing_leads", "ajaxListPartialWpForms");
        }
        try
        {            
                           
            $this->form->bind($request->getPostParameter('WpForms'));                            
            if ($this->form->isValid())
            {              
                $this->item->add($this->form->getValues());    
                $this->item->set('site_id',$this->landing_page_site);    
                $this->item->save();
                $messages->addInfo(__('Wordpress form has been saved.'));
                $this->forward('marketing_leads','ajaxListPartialWpForms');
            }   
            else
            {   
                $messages->addError(__('Wordpress form has some errors.'));   
                $this->item->add($this->form->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}


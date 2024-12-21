<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpLandingPageSiteViewForm.class.php";
 
class marketing_leads_ajaxSaveWpLandingPageSiteAction extends mfAction {
    
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new MarketingLeadsWpLandingPageSiteViewForm($request->getPostParameter('WpLandingPageSite'));                    
        try
        {            
            $this->item=new MarketingLeadsWpLandingPageSite($request->getPostParameter('WpLandingPageSite')); 
            if($this->item->isNotLoaded())
            {
                $messages->addError(__('Item not loaded'));
                return;
            } 
            $this->form->bind($request->getPostParameter('WpLandingPageSite'));                            
            if ($this->form->isValid())
            {   
                $this->item->add($this->form->getValues());
//                if ($this->item->isExist())
//                    throw new mfException (__("Income already exists"));                                                              
                $this->item->save();
                $messages->addInfo(__('class has been saved.'));
                $this->forward('marketing_leads','ajaxListPartialWpLandingPageSite');
            }   
            else
            {                    
                $messages->addError(__('form has some errors.'));           
                $this->item->add($this->form->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}


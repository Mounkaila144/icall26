<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsStatusNewForm.class.php";

class marketing_leads_ajaxSaveNewStatusI18nAction extends mfAction {
          
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();   
        if (!$request->isXmlHttpRequest() )  
        {
            if ($request->getPostParameter('iFrame')=='true') // Comes from Iframe
                $request->forceXMLRequest();                  
        }   
        try
        {      
            $this->form = new MarketingLeadsWpFormsStatusNewForm($this->getUser()->getCountry(),$request->getPostParameter('MarketingLeadsStatus'));             
            $this->status_i18n = new MarketingLeadsWpFormsStatusI18n();
            $this->form->bind($request->getPostParameter('MarketingLeadsStatus'),$request->getFiles('MarketingLeadsStatus'));
            if ($this->form->isValid())
            {
                $this->status_i18n->getMarketingLeadsWpFormsStatus()->add($this->form['status']->getValues());
                $this->status_i18n->add($this->form['status_i18n']->getValues());
                if ($this->status_i18n->getMarketingLeadsWpFormsStatus()->isExist())
                    throw new mfException (__("status already exists"));   
                if ($this->form['status']->hasValue('icon'))
                {
                    $iconFile = $this->form['status']['icon']->getValue();                  
                    $this->status_i18n->getMarketingLeadsWpFormsStatus()->set('icon',$iconFile->getFile()); 
                }     
                $this->status_i18n->getMarketingLeadsWpFormsStatus()->save();
                if ($iconFile)
                {
                    $iconFile->save($this->status_i18n->getMarketingLeadsWpFormsStatus()->getIcon()->getPath());  
                }                                                              
                $this->status_i18n->set('status_id',$this->status_i18n->getMarketingLeadsWpFormsStatus());                                    
                if ($this->status_i18n->isExist())
                    throw new mfException (__("status already exists"));                                                                                                                                       
                $this->status_i18n->save();
                $messages->addInfo("Status has been saved.");
                $request->addRequestParameter('lang',$this->status_i18n->get('lang'));
                $this->forward('marketing_leads','ajaxListPartialStatus');
            }   
            else
            {               
                // Repopulate
                $this->status_i18n->add($this->form['status_i18n']->getValues());
                $this->status_i18n->getMarketingLeadsWpFormsStatus()->add($this->form['status']->getValues());
                $messages->addError(__("form has some errors.")); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}

<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsStatusViewForm.class.php";
 
class marketing_leads_ajaxSaveStatusI18nAction extends mfAction {
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
    
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new MarketingLeadsWpFormsStatusViewForm($request->getPostParameter('MarketingLeadsStatusI18n'));                    
        try
        {            
            $this->item=new MarketingLeadsWpFormsStatusI18n($this->form->getDefault('status_i18n'));               
            $this->form->bind($request->getPostParameter('MarketingLeadsStatusI18n'),$request->getFiles('MarketingLeadsStatusI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item->add($this->form['status_i18n']->getValues());
                $this->item->getMarketingLeadsWpFormsStatus()->add($this->form['status']->getValues());  
                if ($this->item->getMarketingLeadsWpFormsStatus()->isExist() || $this->item->isExist())
                    throw new mfException (__("status already exists"));                                                      
                if ($this->item->isNotLoaded())                
                {                           
                    $this->item->set('status_id',$this->item->getMarketingLeadsWpFormsStatus());  
                    if ($this->form['status']->hasValue('icon'))
                    {
                        $iconFile=$this->form['status']['icon']->getValue();     
                        $this->item->getMarketingLeadsWpFormsStatus()->set('icon',$iconFile->getFilename()); 
                        if ($iconFile)
                        {
                           $iconFile->save($this->item->getMarketingLeadsWpFormsStatus()->getIcon()->getPath());  
                        }                               
                    }                                                                                                                                              
                }         
                $this->item->getMarketingLeadsWpFormsStatus()->save();
                $this->item->save();
                $messages->addInfo(__('status has been saved.'));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('marketing_leads','ajaxListPartialStatus');
            }   
            else
            {                    
                $messages->addError(__('form has some errors.'));              
                $this->item->getMarketingLeadsWpFormsStatus()->add($this->form['status']->getValues());
                $this->item->add($this->form['status_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}


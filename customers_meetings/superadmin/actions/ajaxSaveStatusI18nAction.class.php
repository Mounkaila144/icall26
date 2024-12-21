<?php


 require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusViewForm.class.php";
 
class  customers_meetings_ajaxSaveStatusI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {             
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();     
        $this->form = new CustomerMeetingStatusViewForm($request->getPostParameter('CustomerMeetingStatusI18n'),$this->site);                    
        try
        {            
            $this->item=new CustomerMeetingStatusI18n($this->form->getDefault('status_i18n'),$this->site);               
            $this->form->bind($request->getPostParameter('CustomerMeetingStatusI18n'),$request->getFiles('CustomerMeetingStatusI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item->add($this->form['status_i18n']->getValues());
                $this->item->getCustomerMeetingStatus()->add($this->form['status']->getValues());  
                if ($this->item->getCustomerMeetingStatus()->isExist() || $this->item->isExist())
                            throw new mfException (__("status already exists"));                                                      
                if ($this->item->isNotLoaded())                
                {                           
                    $this->item->set('status_id',$this->item->getCustomerMeetingStatus());  
                    if ($this->form['status']->hasValue('icon'))
                    {
                        $iconFile=$this->form['status']['icon']->getValue();     
                        $this->item->getCustomerMeetingStatus()->set('icon',$iconFile->getFilename()); 
                        if ($iconFile)
                        {
                           $iconFile->save($this->item->getCustomerMeetingStatus()->getIcon()->getPath());  
                        }                               
                    }                                                                                                                                              
                }         
                $this->item->getCustomerMeetingStatus()->save();
                $this->item->save();
                $messages->addInfo(__('status has been saved.'));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('customers_meetings','ajaxListPartialStatus');
            }   
            else
            {                    
               $messages->addError(__('form has some errors.'));              
               $this->item->getCustomerMeetingStatus()->add($this->form['status']->getValues());
               $this->item->add($this->form['status_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}


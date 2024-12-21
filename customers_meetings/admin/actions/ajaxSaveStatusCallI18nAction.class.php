<?php


 require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusCallViewForm.class.php";
 
class  customers_meetings_ajaxSaveStatusCallI18nAction extends mfAction {
    
   
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new CustomerMeetingStatusCallViewForm($request->getPostParameter('CustomerMeetingStatusCallI18n'));                    
        try
        {            
            $this->item=new CustomerMeetingStatusCallI18n($this->form->getDefault('status_i18n'));               
            $this->form->bind($request->getPostParameter('CustomerMeetingStatusCallI18n'),$request->getFiles('CustomerMeetingStatusCallI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item->add($this->form['status_i18n']->getValues());
                $this->item->getStatus()->add($this->form['status']->getValues());  
                if ($this->item->getStatus()->isExist() || $this->item->isExist())
                            throw new mfException (__("status already exists"));                                                      
                if ($this->item->isNotLoaded())                
                {                           
                    $this->item->set('status_id',$this->item->getStatus());  
                    if ($this->form['status']->hasValue('icon'))
                    {
                        $iconFile=$this->form['status']['icon']->getValue();     
                        $this->item->getStatus()->set('icon',$iconFile->getFilename()); 
                        if ($iconFile)
                        {
                           $iconFile->save($this->item->getStatus()->getIcon()->getPath());  
                        }                               
                    }                                                                                                                                              
                }         
                $this->item->getStatus()->save();
                $this->item->save();
                $messages->addInfo(__('Status has been saved.'));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('customers_meetings','ajaxListPartialStatusCall');
            }   
            else
            {                    
               $messages->addError(__('form has some errors.'));              
               $this->item->getStatus()->add($this->form['status']->getValues());
               $this->item->add($this->form['status_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}


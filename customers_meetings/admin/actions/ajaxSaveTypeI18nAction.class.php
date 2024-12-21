<?php


 require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingTypeViewForm.class.php";
 
class  customers_meetings_ajaxSaveTypeI18nAction extends mfAction {
    
   
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new CustomerMeetingTypeViewForm($request->getPostParameter('CustomerMeetingTypeI18n'));                    
        try
        {            
            $this->item=new CustomerMeetingTypeI18n($this->form->getDefault('type_i18n'));               
            $this->form->bind($request->getPostParameter('CustomerMeetingTypeI18n'),$request->getFiles('CustomerMeetingTypeI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item->add($this->form['type_i18n']->getValues());
                $this->item->getType()->add($this->form['type']->getValues());  
                if ($this->item->getType()->isExist() || $this->item->isExist())
                            throw new mfException (__("type already exists"));                                                      
                if ($this->item->isNotLoaded())                
                {                           
                    $this->item->set('type_id',$this->item->getType());  
                    if ($this->form['type']->hasValue('icon'))
                    {
                        $iconFile=$this->form['type']['icon']->getValue();     
                        $this->item->getType()->set('icon',$iconFile->getFilename()); 
                        if ($iconFile)
                        {
                           $iconFile->save($this->item->getType()->getIcon()->getPath());  
                        }                               
                    }                                                                                                                                              
                }         
                $this->item->getType()->save();
                $this->item->save();
                $messages->addInfo(__('Status has been saved.'));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('customers_meetings','ajaxListPartialType');
            }   
            else
            {                    
               $messages->addError(__('form has some errors.'));              
               $this->item->getType()->add($this->form['type']->getValues());
               $this->item->add($this->form['type_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}


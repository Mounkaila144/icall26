<?php


 require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormViewForm.class.php";
 
class  customers_meetings_forms_ajaxSaveFormI18nAction extends mfAction {
    
        
    function execute(mfWebRequest $request) {                   
        $messages = mfMessages::getInstance();     
        $this->form = new CustomerMeetingFormViewForm($request->getPostParameter('CustomerMeetingFormI18n'));                    
        try
        {            
            $this->item=new CustomerMeetingFormI18n($this->form->getDefault('form_i18n'));                    
            $this->form->bind($request->getPostParameter('CustomerMeetingFormI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item->add($this->form['form_i18n']->getValues());
                $this->item->getForm()->add($this->form['form']->getValues());  
                if ($this->item->getForm()->isExist() || $this->item->isExist())
                            throw new mfException (__("Form already exists"));                                                      
                if ($this->item->isNotLoaded())                
                {                           
                    $this->item->set('form_id',$this->item->getForm());                                                                                                                                                                 
                }         
                $this->item->getForm()->save();
                $this->item->save();                
                $messages->addInfo(__('Form has been saved.'));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('customers_meetings_forms','ajaxListPartialForm');
            }   
            else
            {                    
               $messages->addError(__('Form has some errors.'));              
               $this->item->getForm()->add($this->form['form']->getValues());
               $this->item->add($this->form['form_i18n']->getValues());   
              // var_dump($this->form->getErrorSchema()->getErrorsMessage());        
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}


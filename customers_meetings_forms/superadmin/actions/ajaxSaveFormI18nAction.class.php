<?php


 require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormViewForm.class.php";
 
class  customers_meetings_forms_ajaxSaveFormI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    
        
    function execute(mfWebRequest $request) {             
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();     
        $this->form = new CustomerMeetingFormViewForm($request->getPostParameter('CustomerMeetingFormI18n'),$this->site);                    
        try
        {            
            $this->item=new CustomerMeetingFormI18n($this->form->getDefault('form_i18n'),$this->site);                    
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


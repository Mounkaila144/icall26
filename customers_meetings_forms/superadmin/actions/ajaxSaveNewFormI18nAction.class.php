<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormNewForm.class.php";

class customers_meetings_forms_ajaxSaveNewFormI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
            
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                                 
        try
        {      
            $this->form= new CustomerMeetingFormNewForm($this->getUser()->getCountry(),$request->getPostParameter('CustomerMeetingForm'),$this->site);             
            $this->item=new CustomerMeetingFormI18n(null,$this->site);
            $this->form->bind($request->getPostParameter('CustomerMeetingForm'));
            if ($this->form->isValid())
            {
                $this->item->getForm()->add($this->form['form']->getValues());
                $this->item->add($this->form['form_i18n']->getValues());
                if ($this->item->getForm()->isExist())
                    throw new mfException (__("Form already exists"));
                $this->item->getForm()->save();
                $this->item->set('form_id',$this->item->getForm());                                    
                if ($this->item->isExist())
                    throw new mfException (__("Form already exists"));                                                                                                                                       
                $this->item->save();
                $messages->addInfo(__("Form has been saved."));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('customers_meetings_forms','ajaxListPartialForm');
            }   
            else
            {               
                // Repopulate
                $this->item->add($this->form['form_i18n']->getValues());
                $this->item->getForm()->add($this->form['form']->getValues());
                $messages->addError(__("Form has some errors.")); 
                //var_dump($this->form->getErrorSchema()->getErrorsMessage());  
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}

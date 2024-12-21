<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingTypeNewForm.class.php";

class customers_meetings_ajaxSaveNewTypeI18nAction extends mfAction {
    
       
            
    function execute(mfWebRequest $request) {             
        if (!$request->isXmlHttpRequest() )  
        {
                if ($request->getPostParameter('iFrame')=='true') // Comes from Iframe
                       $request->forceXMLRequest();                  
        }   
        $messages = mfMessages::getInstance();              
        try
        {      
            $this->form= new CustomerMeetingTypeNewForm($this->getUser()->getCountry(),$request->getPostParameter('CustomerMeetingType'));             
            $this->type_i18n=new CustomerMeetingTypeI18n();
            $this->form->bind($request->getPostParameter('CustomerMeetingType'));
            if ($this->form->isValid())
            {
                $this->type_i18n->getType()->add($this->form['type']->getValues());
                $this->type_i18n->add($this->form['type_i18n']->getValues());
                if ($this->type_i18n->getType()->isExist())
                    throw new mfException (__("Type already exists"));   
                $this->type_i18n->getType()->save();
                $this->type_i18n->set('type_id',$this->type_i18n->getType());                                    
                if ($this->type_i18n->isExist())
                    throw new mfException (__("Type already exists"));                                                                                                                                       
                $this->type_i18n->save();
                $messages->addInfo("Type has been saved.");
                $request->addRequestParameter('lang',$this->type_i18n->get('lang'));
                $this->forward('customers_meetings','ajaxListPartialType');
            }   
            else
            {               
                // Repopulate
                $this->type_i18n->add($this->form['type_i18n']->getValues());
                $this->type_i18n->getType()->add($this->form['type']->getValues());
                $messages->addError(__("form has some errors.")); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}

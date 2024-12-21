<?php

require_once dirname(__FILE__).'/../locales/Forms/CustomerMeetingCompanyForm.class.php';

class customers_Meetings_ajaxSaveCompanyAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();     
        $this->user=$this->getUser();
        $this->item=new CustomerMeetingCompany($request->getPostParameter('CustomerMeetingCompany'));    
        $this->form=new  CustomerMeetingCompanyForm($this->getUser(),$request->getPostParameter('CustomerMeetingCompany'));
        if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerMeetingCompany') || $this->item->isNotLoaded())
            return ;
        $this->form->bind($request->getPostParameter('CustomerMeetingCompany'));
        try
        {
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("Company already exists."));                                 
                $this->item->save();               
                $messages->addInfo(__("Company has been updated."));                
                $this->forward('customers_meetings','ajaxListPartialCompany');
            }   
            else
            {
                $messages->addError(__("Form has some errors."));
                $this->item->add($this->form->getDefaults());
               // var_dump($this->form->getErrorSchema()->getErrorsMessage());
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        
    }

}

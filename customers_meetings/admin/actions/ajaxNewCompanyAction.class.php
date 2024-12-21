<?php
require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingCompanyNewForm.class.php";

class customers_meetings_ajaxNewCompanyAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();  
        $this->user=$this->getUser();
        try
        {
            $this->item=new CustomerMeetingCompany();
            $this->form=new CustomerMeetingCompanyNewForm($this->getUser(),$request->getPostParameter('CustomerMeetingCompany')); 
            if ($request->isMethod('POST') && $request->getPostParameter('CustomerMeetingCompany'))
            {           
                $this->form->bind($request->getPostParameter('CustomerMeetingCompany'));
                if ($this->form->isValid())
                {                    
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist())
                        throw new mfException(__("Company already exists."));  
                    $this->item->save();
                    $messages->addInfo(__("Company has been created."));
                    $this->forward('customers_meetings', 'ajaxListCompany');
                }   
                else
                {
                     $messages->addError(__("Form has some errors."));
                     $this->item->add($this->form->getDefaults());
                }    
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        
    }

}

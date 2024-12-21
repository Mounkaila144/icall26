<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingCampaignNewForm.class.php";
 

class customers_meetings_ajaxNewCampaignAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->item = new CustomerMeetingCampaign(); // new object       
        $this->form = new CustomerMeetingCampaignNewForm($request->getPostParameter('CustomerMeetingCampaign'));      
        if ($request->getPostParameter('CustomerMeetingCampaign'))
        {
            try 
            {
                $this->form->bind($request->getPostParameter('CustomerMeetingCampaign'));
                if ($this->form->isValid()) {
                    $this->item->add($this->form->getValues());                   
                    if ($this->item->isExist())
                        throw new mfException (__("Campaign already exists"));                                                       
                    $this->item->save();
                    $messages->addInfo(__("Campaign [%s] has been created.",$this->item->get('name')));                   
                    $this->forward("customers_meetings","ajaxListPartialCampaign");
                }
                else
                {
                   $messages->addError(__("Form has some errors."));   
                   $this->item->add($request->getPostParameter('CustomerMeetingCampaign')); // repopulate       
                //   var_dump($this->form->getErrorSchema());
                }    
            } 
            catch (mfException $e)
            {
               $messages->addError($e);
            }  
        }    
    }

}

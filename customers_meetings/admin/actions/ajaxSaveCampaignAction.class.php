<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingCampaignViewForm.class.php";
 

class customers_meetings_ajaxSaveCampaignAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();       
        $this->item = new CustomerMeetingCampaign($request->getPostParameter('CustomerMeetingCampaign')); // new object       
        $this->form = new CustomerMeetingCampaignViewForm();  
        if ($request->getPostParameter('CustomerMeetingCampaign') && $request->isMethod('POST'))
        {
            $this->form->bind($request->getPostParameter('CustomerMeetingCampaign'));
            try
            {
                 if ($this->form->isValid())
                 {
                     $this->item->add($this->form->getValues()); // repopulate     
                     if ($this->item->isExist())
                         throw new mfException(__("Campaign already exists."));
                     $this->item->save();
                     $messages->addInfo(__("Campaign [%s] has been updated.",$this->item->get('name')));                   
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

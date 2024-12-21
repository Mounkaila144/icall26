<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormDocumentFormFieldForDocumentViewForm.class.php";

class app_domoprime_ajaxSaveFieldForDocumentAction extends mfAction {

       
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();                    
        try
        {            
             $this->item=new CustomerMeetingFormDocumentFormfield($request->getPostParameter('CustomerMeetingFormDocumentField'));
             $this->form=new CustomerMeetingFormDocumentFormfieldForDocumentViewForm($request->getPostParameter('CustomerMeetingFormDocumentField'));                                 
              if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerMeetingFormDocumentField'))
                 return ;
                $this->form->bind($request->getPostParameter('CustomerMeetingFormDocumentField')); 
                if ($this->form->isValid())
                {                                         
                     $this->item->add($this->form->getValues());                                     
                     $this->item->save();                                                            
                     $messages->addInfo(__('Field has been added.'));                     
                     $request->addRequestParameter('document', $this->item->getDocument());
                     $this->forward('app_domoprime','ajaxListPartialFieldForDocument');
                }   
                else
                {
                    $messages->addError(__('Form has some errors.'));
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
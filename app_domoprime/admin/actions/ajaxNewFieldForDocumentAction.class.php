<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormDocumentFormFieldForDocumentNewForm.class.php";

class app_domoprime_ajaxNewFieldForDocumentAction extends mfAction {

       
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();                    
        try
        { 
             $this->document=$request->getRequestParameter('document',new CustomerMeetingFormDocument($request->getPostParameter('CustomerMeetingFormDocument')));
             if ($this->document->isNotLoaded())
                        return ;
             $this->item=new CustomerMeetingFormDocumentFormfield();
             $this->form=new CustomerMeetingFormDocumentFormfieldForDocumentNewForm($request->getPostParameter('CustomerMeetingFormDocumentField'));                                              
              if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerMeetingFormDocumentField'))
                 return ;
                $this->form->bind($request->getPostParameter('CustomerMeetingFormDocumentField')); 
                if ($this->form->isValid())
                {                                         
                     $this->item->add($this->form->getValues());
                     $this->item->set('document_id',$this->document);                 
                     $this->item->save();                                                               
                     $messages->addInfo(__('Field has been added.'));                     
                     $request->addRequestParameter('document', $this->document);
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
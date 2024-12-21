<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormDocumentViewForm.class.php";

class app_domoprime_ajaxSaveDocumentAction extends mfAction {

       
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();              
        $this->item=new CustomerMeetingFormDocument($request->getPostParameter('CustomerMeetingFormDocument'));
        $this->form=new CustomerMeetingFormDocumentViewForm();                                   
        try
        {             
                if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerMeetingFormDocument') || $this->item->isNotLoaded())
                 return ;
                $this->form->bind($request->getPostParameter('CustomerMeetingFormDocument')); 
                if ($this->form->isValid())
                {                                       
                     $this->item->add($this->form->getValues());                       
                     $this->item->set('type',$this->form->getValue('class_id')?1:0);
                     $this->item->save();
                     $this->doc_form_class=new DomoprimeCustomerMeetingFormDocumentClass($this->item);
                     if ($this->form->getValue('class_id'))                        
                        $this->doc_form_class->set('class_id',$this->form->getValue('class_id'))->save();                                                               
                     else                     
                        $this->doc_form_class->delete();   
                     $messages->addInfo(__('Document has been updated.'));                           
                     $this->forward('app_domoprime','ajaxListPartialDocument');
                }   
                else
                {
                    $messages->addError(__('Form has some errors.'));
                    $this->item->add($this->form->getDefaults());
                }                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }          
    }
    
}    
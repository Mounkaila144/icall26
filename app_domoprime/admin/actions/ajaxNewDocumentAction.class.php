<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormDocumentNewForm.class.php";

class app_domoprime_ajaxNewDocumentAction extends mfAction {

       
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();                    
        try
        { 
              $this->item=new CustomerMeetingFormDocument();
              $this->form=new CustomerMeetingFormDocumentNewForm($request->getPostParameter('CustomerMeetingFormDocument'));                                 
              if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerMeetingFormDocument'))
                 return ;
                $this->form->bind($request->getPostParameter('CustomerMeetingFormDocument')); 
                if ($this->form->isValid())
                {                                         
                     $this->item->add($this->form->getValues());
                     $this->item->set('type',$this->form->getValue('class_id')?1:0);
                     $this->item->save();
                        if ($this->form->getValue('class_id'))
                     {
                         $form_class = new DomoprimeCustomerMeetingFormDocumentClass();
                         $form_class->add(array('class_id'=>$this->form->getClass(),'form_document_id'=>$this->item));
                         $form_class->save();
                     }    
                     $messages->addInfo(__('Document has been added.'));                     
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
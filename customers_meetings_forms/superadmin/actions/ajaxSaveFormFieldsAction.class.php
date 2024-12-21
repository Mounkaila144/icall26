<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormForm.class.php";
 
class customers_meetings_forms_ajaxSaveFormFieldsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
  
        
    function execute(mfWebRequest $request) {              
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();       
        //       $req=array ( 'fields' => array ( 0 => array ( 'type' => 'choice', 'request' => 'aaa', 'name' => 'aa', 'formfield_id' => '16', 'size' => '', 'widget' => 'radio', 'choices' => array ( 0 => 'A',1=>'B' ), ), ), 'count' => '1', 'token' => '8efe63bf14daa97a9340dbc44eaa0886', );
        $this->item=new CustomerMeetingFormI18n($request->getPostParameter('CustomerMeetingFormI18n'),$this->site);          
        $this->form=new CustomerMeetingFormForm($request->getPostParameter('CustomerMeetingFormFields',$this->item->getDefaultFormfields()));        
      // $this->form=new CustomerMeetingFormForm($req);        
       // var_export($request->getPostParameter('CustomerMeetingFormFields'));
       //var_dump($req);
        if ($request->isMethod('POST') && $request->getPostParameter('CustomerMeetingFormFields'))
        {
           $this->form->bind($request->getPostParameter('CustomerMeetingFormFields')); 
           if ($this->form->isValid())
           {     
               $this->item->updateFormFields($this->form->getValue('fields'));                                 
               $messages->addInfo(__("Form has been saved."));
           }    
           else
           {               
               $messages->addError(__('Form has some errors.'));               
              // var_dump($this->form->getErrorSchema()->getErrorsMessage());             
           }
        }   
   }

}


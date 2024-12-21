<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterDocumentForPolluterForm.class.php";
 
class partners_polluter_ajaxViewDocumentForPolluterAction extends mfAction {
    
           
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
         $this->polluter=new PartnerPolluterCompany($request->getPostParameter('Polluter'));
        if ($this->polluter->isNotLoaded())
           return ;
         $this->document=new CustomerMeetingFormDocument($request->getPostParameter('Document'));
        if ($this->document->isNotLoaded())
        {    
            $messages->addError(__('Document is invalid.'));
            $request->addRequestParameter('polluter',$this->polluter);             
            $this->forward('partners_polluter', 'ajaxListPartialDocumentForPolluter');
        }    
        $this->item=new PartnerPolluterDocument(array('document'=>$this->document,'polluter'=>$this->polluter));
        $this->form = new PartnerPolluterDocumentForPolluterForm($this->polluter);     
   }

}


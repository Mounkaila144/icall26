<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterDocumentForPolluterForm.class.php";
 
class partners_polluter_ajaxSaveDocumentForPolluterAction extends mfAction {
    
           
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();   
        $this->polluter=new PartnerPolluterCompany($request->getPostParameter('Polluter'));
        if ($this->polluter->isNotLoaded())
           return ;
        $this->form = new PartnerPolluterDocumentForPolluterForm($this->polluter,$request->getPostParameter('PolluterDocument')); 
        $this->form->bind($request->getPostParameter('PolluterDocument'));   
        if ($this->form->getDocument()->isNotLoaded())
        {    
            $messages->addError(__('Document is invalid.'));
            $request->addRequestParameter('polluter',$this->polluter);             
            $this->forward('partners_polluter', 'ajaxListPartialDocumentForPolluter');
        }  
        $this->item= new PartnerPolluterDocument(array('document'=>$this->form->getDocument(),'polluter'=>$this->polluter));
        if ($this->form->isValid())
        {
          //  var_dump($this->form['model_id']->getValue());
             $this->item->set('model_id',$this->form['model_id']->getValue());
             $this->item->save();
             $messages->addInfo(__("Model for document has been saved."));
             $request->addRequestParameter('polluter',$this->polluter);            
             $this->forward('partners_polluter', 'ajaxListPartialDocumentForPolluter');
        }    
        else 
        {
            $messages->addError(__('Form has some errors.'));
        }        
   }

}


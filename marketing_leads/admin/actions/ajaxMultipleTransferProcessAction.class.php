<?php

require_once dirname(__FILE__)."/../locales/Forms/MultipleMarketingLeadsSelectionForm.class.php";

class marketing_leads_ajaxMultipleTransferProcessAction extends mfAction {
  
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();    
        $this->user=$this->getUser();
        $this->form = new MultipleMarketingLeadsSelectionForm($this->getUser(),$request->getPostParameter('MultipleMarketingLeadsSelection'));                
        $this->form->bind($request->getPostParameter('MultipleMarketingLeadsSelection'));
        try
        {
            if ($this->form->isValid())
            {
                $this->collection = new MarketingLeadsWpFormsCollection();
                if(!$this->collection->fillFromSelection($this->form->getSelection())){
                    $response = array("error"=>__("Leads are not correctly loaded"));
                }
                $this->collection->loaded();
                $this->collection->processTransfer();
                mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->collection,'marketing.leads.meeting.multiple.transfer.data',$this->collection->getMeetings()));
                $messages->addInfo(__("Transfer processed with success"));
            }  
            else
            {
                $messages->addError(__("Form has some errors."));
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        
      //  return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
        $this->forward($this->getModuleName(), 'ajaxListPartialWpFormsAll');
    }

}

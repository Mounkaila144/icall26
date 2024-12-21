<?php


class customers_contracts_ajaxCopyContractAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
      $messages = mfMessages::getInstance();
      try 
      {                 
          if (!$this->getUser()->hasCredential(array(array('superadmin','contract_copy'))))
                $this->forwardTo401Action ();
         $item=new CustomerContract($request->getPostParameter('Contract'));
         if ($item->isNotLoaded())
            throw new mfException(__("Contract is invalid."));
        $copy=$item->copy();
        $this->getEventDispather()->notify(new mfEvent($copy, 'contract.copy',array('source'=>$item)));                                                                 
         $messages->addInfo(__("Contract has been copied."));     
         $request->addRequestParameter('contract', $copy);
         $this->forward($this->getModuleName(), 'ajaxViewContract');
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
       $this->getController()->setRenderMode(mfView::RENDER_JSON);
       $response = array("action"=>"CopyContract",
                         "id" =>$item->get('id'));
       return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}


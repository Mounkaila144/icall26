<?php


class app_domoprime_ajaxSignedAtToContractOpenedAtProcessAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {                                    
                $messages->addInfo(__("%s Signed at has been transferred to opened at",DomoprimeQuotationUtils::transferSignedAtToOpenedAtContract()));        
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      $this->forward($this->getModuleName(), 'ajaxListPartialQuotation');
    }
}



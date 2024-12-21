<?php


class customers_ajaxCleanContractsAndMeetingsProcessAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {                                    
                CustomerContract::DeleteContractsWithNoCustomer();
            CustomerMeeting::DeleteMeetingsWithNoCustomer();
                $messages->addInfo(__("Contracts and meetings with no customer are deleted"));             
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      $this->forward($this->getModuleName(), 'ajaxListPartial');
    }
}



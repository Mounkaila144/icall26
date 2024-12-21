<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsFormFilter.class.php";

class customers_meetings_ajaxGenerateCoordinatesFromFilterAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {   
        $filter= new CustomerMeetingsFormFilter($this->getUser());  
        $filter->bind($request->getPostParameter('filter'));
        if (!$filter->isValid())
           throw new mfException(__("Filter has some errors."))    ;
        $msgs=CustomerMeetingUtils::generateCoordinatesFromFilter($filter);
        $response=array('info'=>(string)$msgs->implode(','));
        //SystemDebug::getInstance()->trace(date("Y-m-d H:i:s").":Meeting:GenerateCoordinatesFromFilter [".(string)$this->getUser()->getGuardUser()."] ");
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}


<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingScheduleForListFormFilter.class.php";

class customers_meetings_ajaxListPartialScheduleForListAction extends mfAction {

   
  
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->user=$this->getUser();       
        $this->formFilter= new CustomerMeetingScheduleForListFormFilter($this->getUser());                                       
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid() || $request->getPostParameter('filter')==null)
            {                     
                $this->formFilter->execute();
            }       
            else
            {
                  var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
            }    
        //    var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }            
    }
    
}    
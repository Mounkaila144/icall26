<?php

//require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsScheduleFormFilter.class.php";

class customers_meetings_ajaxListPartialMeetingScheduleAction extends mfAction {

   
  
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->user=$this->getUser();       
        $this->formFilter= new CustomerMeetingsScheduleFormFilter($this->getUser());                                       
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid() || $request->getPostParameter('filter')==null)
            {                     
                $this->formFilter->execute();
            }       
        //    var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }            
    }
    
}    
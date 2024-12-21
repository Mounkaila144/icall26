<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsScheduleFormFilter.class.php";
//require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingsSchedulePager.class.php";


class customers_meetings_tabScheduleActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                   
        $messages = $this->getMessage();                   
        $this->formFilter= new CustomerMeetingsScheduleFormFilter($this->getUser()->getCountry());                                                     
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {                     
                   $this->formFilter->execute();
               }                          
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }            
    } 
    
    
}
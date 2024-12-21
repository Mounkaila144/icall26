<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsScheduleFormFilter.class.php";

class customers_meetings_ajaxListPartialMeetingScheduleAction extends mfAction {

const SITE_NAMESPACE = 'system/site';
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();               
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
        $this->forwardIf(!$this->site,"sites","Admin");         
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);                    
        $this->formFilter= new CustomerMeetingsScheduleFormFilter($this->getUser()->getCountry(),$this->site);                                       
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid() || $request->getPostParameter('filter')==null)
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
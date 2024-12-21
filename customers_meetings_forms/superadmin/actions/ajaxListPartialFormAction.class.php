<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingFormsFormFilter.class.php";
//require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingsPager.class.php";

class customers_meetings_forms_ajaxListPartialFormAction extends mfAction {

    const SITE_NAMESPACE = 'system/site';
        
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();               
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
        $this->forwardIf(!$this->site,"sites","Admin");               
        $this->formFilter= new CustomerMeetingFormsFormFilter($this->getUser(),$this->site);                                  
        $this->pager=new Pager($this->formFilter->getObjectsForPager());                 
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                   // echo $this->formFilter->getQuery()."<br/>";
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);    
                    $this->pager->setParameter('lang',(string)$this->formFilter['lang']);         
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->executeSite($this->site);              
               }           
               else 
               {
                    $messages->addError(__("Filter has some errors."));
                  //  var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());                   
               }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        } 
       //  var_dump($this->pager[0]);
     //   echo $this->formFilter->getQuery()."<br/>";
   //      var_dump($this->formFilter['in']['telepro_id']->getValue());
    }
    
}    
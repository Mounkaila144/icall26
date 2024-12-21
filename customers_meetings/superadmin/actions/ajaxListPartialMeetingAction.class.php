<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingsPager.class.php";

class customers_meetings_ajaxListPartialMeetingAction extends mfAction {

const SITE_NAMESPACE = 'system/site';
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    } 
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();               
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
        $this->forwardIf(!$this->site,"sites","Admin");               
        $this->formFilter= new CustomerMeetingsFormFilter($this->getUser(),$this->site); 
        $this->getEventDispather()->notify(new mfEvent($this->formFilter, 'meeting.filter'));                                          
        $this->pager=new CustomerMeetingsPager($this->formFilter->getObjectsForPager());                 
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                  //  echo $this->formFilter->getQuery()."<br/>";
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',$this->getUser()->getCountry());   
                    $this->pager->setParameter('user_id',$this->getUser()->getGuardUser()->get('id'));  
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->executeSite($this->site);              
               }           
               else 
               {
                    $messages->addError(__("Filter has some errors."));
                  //  var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
                   // var_dump($this->formFilter['in']->getErrors());
               }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        } 
        // var_dump($this->formFilter->getParametersForUrl(array('equal','in','begin','search')));
      //    var_dump($this->pager[0]->hasStatus());
     //   echo $this->formFilter->getQuery()."<br/>";
   //      var_dump($this->formFilter['in']['telepro_id']->getValue());
    }
    
}    
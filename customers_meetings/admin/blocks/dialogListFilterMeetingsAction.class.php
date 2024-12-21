<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DialogListFilterMeetingsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DialogListFilterMeetingsPager.class.php";

class customers_meetings_dialogListFilterMeetingsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                               
        $this->user=$this->getUSer();
       $this->formFilter=new dialogListFilterMeetingsFormFilter($this->getUser());          
       $this->formFilter->setDefault('selected',$this->getParameter('selected'));       
      $this->pager=new DialogListFilterMeetingsPager($this->formFilter->getObjectsForPager());
       try
       {                             
               $this->pager->setQuery($this->formFilter->getQuery()); 
               $this->pager->setNbItemsByPage((string)$this->formFilter['nbitemsbypage']);    
               $this->pager->setParameter('lang',$this->getUser()->getCountry());  
               $this->pager->setParameter('user_id',$this->getUser()->getGuardUser()->get('id'));  
               $this->pager->setPage($request->getGetParameter('page'));                
               $this->pager->executeSite($this->getParameter('site'));      
        }
        catch (mfException $e)
        {
            $this->getMessage()->addError($e);           
        }   
        // var_dump($this->pager->toArray());
    }     
    
}
<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingCompanyFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingCompanyPager.class.php";

class customers_meetings_ajaxListPartialCompanyAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {

            $messages = mfMessages::getInstance(); 
            $this->user=$this->getUser();
            $this->formFilter= new CustomerMeetingCompanyFormFilter();                  
            $this->pager=new CustomerMeetingCompanyPager();
            try
            {       
                 $this->formFilter->bind($request->getPostParameter('filter'));
                   if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                   {                   
                  //   echo $this->formFilter->getQuery()."<br/>";
                     $this->pager->setQuery($this->formFilter->getQuery()); 
                     $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                  //   $this->pager->setParameter('lang',$this->getUser()->getCountry());    
                     $this->pager->setPage($request->getGetParameter('page'));
                     $this->pager->execute();   
                  //   echo mfSiteDatabase::getInstance()->getQuery();
                   }
            }
            catch (mfException $e)
            {          
                $messages->addError($e);
            }   
        
    }

}

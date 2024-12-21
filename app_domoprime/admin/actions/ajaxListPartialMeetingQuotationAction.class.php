<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeMeetingQuotationFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeMeetingQuotationPager.class.php";

class app_domoprime_ajaxListPartialMeetingQuotationAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();   
        $this->user=$this->getUser(); 
        $this->formFilter= new DomoprimeMeetingQuotationFormFilter($this->getUser());                  
        $this->pager=new DomoprimeMeetingQuotationPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                 // echo $this->formFilter->getQuery();
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',$this->getUser()->getLanguage());                
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }        
       // var_dump($this->pager[0]);
    }
    
}    
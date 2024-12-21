<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeCalculationFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeCalculationPager.class.php";

class app_domoprime_ajaxListPartialCalculationAction extends mfAction {

 
   
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->user=$this->getUser();
        $this->formFilter= new DomoprimeCalculationFormFilter($this->user);                  
        $this->pager=new DomoprimeCalculationPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                 //  var_dump($this->formFilter->getQuery());
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);    
                $this->pager->setParameter('lang',$this->getUser()->getCountry()); 
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
       // var_dump($this->pager[0]);
        $this->contract_settings=CustomerContractSettings::load();     
        $this->meeting_settings=CustomerMeetingSettings::load();     
    }
    
}    
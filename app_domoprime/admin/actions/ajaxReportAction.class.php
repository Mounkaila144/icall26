<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeCalculationReportFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeCalculationReportPager.class.php";

class app_domoprime_ajaxReportAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();   
        $this->user=$this->getUser(); 
        $this->formFilter= new DomoprimeCalculationReportFormFilter($this->getUser());    
        $this->pager=new DomoprimeCalculationReportPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));                   
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                 //  echo $this->formFilter->getWhere();
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                     $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',$this->getUser()->getLanguage());                
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();                                
               }    
 else {
   //  var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
 }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }   
        
       // var_dump($this->formFilter->getTotalSurfaces());
    }
    
}    
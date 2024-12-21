<?php

require_once __DIR__."/../locales/FormFilters/DomoprimeAfterWorkModelFormFilter.class.php";
require_once __DIR__."/../locales/Pagers/DomoprimeAfterWorkModelPager.class.php";

class app_domoprime_ajaxListPartialAfterWorkModelAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();      
        $this->formFilter= new DomoprimeAfterWorkModelFormFilter($request->getRequestParameter('lang',$request->getPostParameter('lang',$this->getUser()->getCountry())));                  
        $this->pager=new DomoprimeAfterWorkModelPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage("*");
                $this->pager->setParameter('lang',(string)$this->formFilter['lang']);                
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
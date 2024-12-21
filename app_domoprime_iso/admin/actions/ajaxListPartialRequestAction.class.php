<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeRequestFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeRequestPager.class.php";

class app_domoprime_iso_ajaxListPartialRequestAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();   
        $this->user=$this->getUser(); 
        $this->formFilter= new DomoprimeRequestFormFilter($this->getUser());                  
        $this->pager=new DomoprimeRequestPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                 //  echo $this->formFilter->getQuery();
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',$this->getUser()->getLanguage());                
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }        
               else
               {
                   var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
               }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }        
       // var_dump($this->pager[0]);
    }
    
}    
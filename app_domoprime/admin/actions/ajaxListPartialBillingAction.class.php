<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeBillingFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeBillingPager.class.php";

class app_domoprime_ajaxListPartialBillingAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();   
        $this->user=$this->getUser(); 
        $this->formFilter= new DomoprimeBillingFormFilter($this->getUser());                  
        $this->pager=new DomoprimeBillingPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                  // var_dump($this->formFilter->getQuery());
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',$this->getUser()->getLanguage());                
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }                                    
               else
               {
                  // var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
                   $messages->addError(__('Filter has some errors.'));
               }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);            
        }        
       // var_dump($this->pager[0]);
    }
    
}    
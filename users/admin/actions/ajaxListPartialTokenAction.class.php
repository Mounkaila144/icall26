<?php

require_once dirname(__FILE__)."/../locales/FormFilters/UserValidationTokenFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/UserValidationTokenPager.class.php";

class users_ajaxListPartialTokenAction extends mfAction {

   
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance(); 
        $this->user=$this->getUser();
        $this->formFilter= new UserValidationTokenFormFilter();                  
        $this->pager=new UserValidationTokenPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                       
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
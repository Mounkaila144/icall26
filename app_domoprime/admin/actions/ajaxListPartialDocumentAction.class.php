<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingDocumentFormFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingDocumentFormPager.class.php";

class app_domoprime_ajaxListPartialDocumentAction extends mfAction {

       
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();             
        $this->formFilter= new CustomerMeetingDocumentFormFormFilter();                  
        $this->pager=new CustomerMeetingDocumentFormPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                 //  echo $this->formFilter->getQuery();
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                             
                    $this->pager->setParameter('lang',$this->getUser()->getCountry());                    
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();
                //    echo mfSiteDatabase::getInstance()->getQuery();
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
        //var_dump($this->pager[0]->getModel());        
    }
    
}    
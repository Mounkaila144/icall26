<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingDocumentFieldForDocumentFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingDocumentFieldForDocumentPager.class.php";

class app_domoprime_ajaxListPartialFieldForDocumentAction extends mfAction {

       
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();             
        $this->document=$request->getRequestParameter('document',new CustomerMeetingFormDocument($request->getPostParameter('CustomerMeetingFormDocument')));
        if ($this->document->isNotLoaded())
            return ;
        
        $this->formFilter= new CustomerMeetingDocumentFieldForDocumentFormFilter();                  
        $this->pager=new CustomerMeetingDocumentFieldForDocumentPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                  // echo $this->formFilter->getQuery();
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                             
                    $this->pager->setParameter('lang',$this->getUser()->getCountry());    
                    $this->pager->setParameter('document_id',$this->document->get('id'));    
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();                        
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
      //  var_dump($this->pager->getItems());        
    }
    
}    
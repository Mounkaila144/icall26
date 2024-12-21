<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingImportFileFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingImportFilePager.class.php";

class customers_meetings_imports_ajaxListPartialFilesAction extends mfAction {
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->formFilter= new CustomerMeetingImportFileFormFilter();                  
        $this->pager=new CustomerMeetingImportFilePager();
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
        $this->settings= CustomerMeetingSettings::load();
    }
    
}

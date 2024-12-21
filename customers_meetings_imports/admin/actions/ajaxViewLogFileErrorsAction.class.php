<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingImportErrorsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingImportErrorsPager.class.php";

class customers_meetings_imports_ajaxViewLogFileErrorsAction extends mfAction {
        
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance(); 
        $this->formFilter= new CustomerMeetingImportErrorsFormFilter();                  
        $this->pager=new CustomerMeetingImportErrorsPager();
        $this->import = $request->getRequestParameter("import",new CustomerMeetingImportFile($request->getPostParameter('Import')));
        
        try
        {
            
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                             
                $this->pager->setParameter("import_id",$this->import->get('id'));
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
            }                                  
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
    }
    
}

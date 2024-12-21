<?php

require_once dirname(__FILE__)."/../locales/Pagers/PagerViewCsvFile.class.php";

class customers_meetings_imports_ajaxViewLogFromLineAction extends mfAction {
        
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();
        
        try
        {
            $this->line = (int)$request->getPostParameter('Line');
            $this->import = $request->getRequestParameter("import",new CustomerMeetingImportFile($request->getPostParameter('Import')));
            $this->pager = new PagerViewCsvFile($this->import);
            $this->pager->setPage($request->getGetParameter('page'));
            $this->pager->setPointer($this->line);
            $this->pager->setErrorField($request->getPostParameter("Field"));
            $this->pager->execute();                                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
    }
    
}

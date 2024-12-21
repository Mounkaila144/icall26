<?php

class customers_meetings_imports_ajaxViewLogFileAction extends mfAction {
        
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();
        
        try
        {
            $this->import = $request->getRequestParameter("import",new CustomerMeetingImportFile($request->getPostParameter('Import')));
            $this->pager=new PagerCsvFile($this->import);
            $this->pager->setPage($request->getGetParameter('page'));
            $this->pager->execute();                                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
    }
    
}

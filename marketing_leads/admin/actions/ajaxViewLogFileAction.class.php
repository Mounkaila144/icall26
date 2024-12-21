<?php

class marketing_leads_ajaxViewLogFileAction extends mfAction {
        
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();
        
        try
        {
            $this->import = $request->getRequestParameter("import",new MarketingLeadsWpFormsLeadsImportFile($request->getPostParameter('Import')));
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

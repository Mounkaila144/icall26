<?php

class marketing_leads_ajaxViewErrorLogAction extends mfAction {
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        
        try
        {
            // A REVOIR
            $this->import = new MarketingLeadsWpFormsLeadsImportFile($request->getPostParameter('Import'));
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

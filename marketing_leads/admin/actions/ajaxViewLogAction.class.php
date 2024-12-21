<?php

class marketing_leads_ajaxViewLogAction extends mfAction {
        
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();
        
        try
        {
            $this->import = new MarketingLeadsWpFormsLeadsImportFile($request->getPostParameter('Import'));
            
            $request->addRequestParameter("import",$this->import);
            
            if($this->import->hasError())
                $this->forward("marketing_leads","ajaxViewLogFileErrors");
            $this->forward("marketing_leads","ajaxViewLogFile");                          
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
    }
    
}

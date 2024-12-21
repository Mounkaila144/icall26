<?php

class customers_meetings_imports_ajaxViewLogAction extends mfAction {
        
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();
        
        try
        {
            $this->import = new CustomerMeetingImportFile($request->getPostParameter('Import'));
            
            $request->addRequestParameter("import",$this->import);
            
            if($this->import->hasError())
                $this->forward("customers_meetings_imports","ajaxViewLogFileErrors");
            
            $this->forward("customers_meetings_imports","ajaxViewLogFile");                          
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
    }
    
}

<?php

//pager
//filter

class customers_meetings_imports_ajaxViewErrorLogAction extends mfAction {
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        
        try
        {
            $this->import = new CustomerMeetingImportFile($request->getPostParameter('Import'));
            $path = $this->import->getLogFile()->getPath()."/".$this->import->get('file_log');
            $this->pager=new PagerCsvFile($path,$this->import);
            $this->pager->setPage($request->getGetParameter('page'));
            $this->pager->execute();                                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
    }
    
    
}

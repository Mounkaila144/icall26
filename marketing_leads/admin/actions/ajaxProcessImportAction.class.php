<?php

class marketing_leads_ajaxProcessImportAction extends mfAction {
 
    function execute(mfWebRequest $request) {                         
        $messages = mfMessages::getInstance();  
        $this->import=$request->getRequestParameter('import');
        $this->mode=$request->getRequestParameter('mode');
    }
}
  
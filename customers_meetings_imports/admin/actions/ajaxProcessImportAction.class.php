<?php


class customers_meetings_imports_ajaxProcessImportAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {                         
        $messages = mfMessages::getInstance();  
        $this->import=$request->getRequestParameter('import');
        $this->mode=$request->getRequestParameter('mode');
      /*  if ($this->import==null)
        {    
          $this->import=new CampaignListFile($request->getPostParameter('Import'));
       //   $this->import_file->set('lines_processed',0);
          $this->import->save();
        } */      
    }
}
  
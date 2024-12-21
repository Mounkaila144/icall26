<?php

require_once dirname(__FILE__)."/../locales/Imports/MarketingLeadsWpFormsAllLeadsImport.class.php";

class marketing_leads_ajaxProcessImportFileLinesAction extends mfAction {
 
    function execute(mfWebRequest $request) {                         
        $messages = mfMessages::getInstance();  
        $file = new MarketingLeadsWpFormsLeadsImportFile($request->getPostParameter('Import'));
        $mode = $request->getPostParameter('Mode');
        try
        {
            if ($file->isLoaded())
            {    
                if (!$file->isProcessed())
                {                   
                    $import = new MarketingLeadsWpFormsAllLeadsImport($this->getUser(),$file,'csv',array("mode"=>$mode));                   
                    $import->execute();                                 
                }  
                $response=array(
                    'isProcessed'=>$file->isProcessed(),
                    'pourcentage'=>$file->getPourcentage(),                
                    'lines_processed'=>$file->get('lines_processed'),
                    'nb_errors'=>$file->getNumberOfErrors(),
                    'log_file'=>$import->getLogFileUrl(),
                );    
                if ($import && $import->getMessages()->hasMessages('info'))
                {                  
                    $response['infos']=$import->getMessages()->getDecodedMessages('info');
                }    
            }
        }
        catch (mfException $e)
        {           
            $messages->addError($e); 
        }
        
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;          
    }
}
  
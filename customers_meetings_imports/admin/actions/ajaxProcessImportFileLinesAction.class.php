<?php

require_once dirname(__FILE__)."/../locales/Imports/CustomerMeetingImport.class.php";

class customers_meetings_imports_ajaxProcessImportFileLinesAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {                         
        $messages = mfMessages::getInstance();  
        $file = new CustomerMeetingImportFile($request->getPostParameter('Import'));
        $mode = $request->getPostParameter('Mode');
        try
        {
            if ($file->isLoaded())
            {    
                if (!$file->isProcessed())
                {                   
                    $import=new CustomerMeetingImport($this->getUser(),$file,'csv',array("mode"=>$mode));                   
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
       // if ($import)
       //     $import->close();
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;          
    }
}
  
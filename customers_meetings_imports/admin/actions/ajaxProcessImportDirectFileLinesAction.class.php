<?php

require_once dirname(__FILE__)."/../locales/Imports/CustomerMeetingImport.class.php";

class customers_meetings_imports_ajaxProcessImportDirectFileLinesAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {                         
        $messages = mfMessages::getInstance();  
        $file = new CustomerMeetingImportFile($request->getPostParameter('Import'));     
        try
        {
            if ($file->isNotLoaded())
                throw new mfException(__("File is invalid"));
            if (!$file->isProcessed())            
            {                   
                $import=new CustomerMeetingImport($this->getUser(),$file,'csv');                   
                $import->execute();                                 
            }  
            $response=array(
                'isProcessed'=>$file->isProcessed(),
                'pourcentage'=>$file->getPourcentage(),                
                'lines_processed'=>$file->get('lines_processed'),
                'nb_errors'=>$file->getNumberOfErrors(),                   
            );  
            if ($file->isProcessed())
            {
                 $file->getFormat()->delete(); 
                 $file->set('format_id',null)->save();
            }   
            if ($import && $import->getMessages()->hasMessages('info'))
            {                  
                $response['infos']=$import->getMessages()->getDecodedMessages('info');
            }            
        }
        catch (mfException $e)
        {           
            $messages->addError($e); 
        }      
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;          
    }
}
  
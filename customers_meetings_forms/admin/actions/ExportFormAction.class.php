<?php

 //require_once dirname(__FILE__)."/../locales/Export/CustomerMeetingFormExportXML.class.php";

class customers_meetings_forms_ExportFormAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();                                      
              
         try
        {                
            $form= new CustomerMeetingForm($request->getGetParameter('form'));       
            if ($form->isNotLoaded())
                throw new mfException(__("Form is invalid."));
            $xml=new CustomerMeetingFormExportXML($form,array('lang'=>$this->getUser()->getLanguage()));
            if ($debug=$request->getGetParameter('debug',false))
                $xml->debug();
            $xml->process();   
            
            if ($debug)
               throw new mfException(__("--STOP--"));
            
            ob_start();
            ob_end_clean();
            $response=$this->getResponse();
            $response->setHeaderFile($xml->getFilename(),true);
            $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
            $response->sendHttpHeaders();
            readfile($xml->getFilename());  
            die();
        }
        catch (mfException $e)
        {
            die ($e->getMessage());
        }
        die();        
    }
}


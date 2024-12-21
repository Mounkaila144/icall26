<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/ExportKML/CustomerMeetingExportKmlFilter.class.php";


class customers_meetings_ExportKMLMeetingsAction extends mfAction {
    
   
    
 
    function execute(mfWebRequest $request) {              
                 
        if (!$this->getUser()->hasCredential([['superadmin','admin','meeting_exportKML']]))
             $this->forwardTo401Action ();
      /*  $kml=new CustomerMeetingExportKMLCollection(CustomerMeetingUtils::getMeetings($request->getPostParameter('Meetings')));        
        $kml->build();                     
        ob_start();
        ob_end_clean();
        $response=$this->getResponse();
        $response->setHeaderFile($kml->getFilename(),true);
        $response->sendHttpHeaders();
        readfile($kml->getFilename());   
        die();       */       
        $filter= new CustomerMeetingsFormFilter($this->getUser());         
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                   
           $kml=new CustomerMeetingExportKMLFilter($filter,$this->getUser());
           $kml->build();             
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
           $response->setHeaderFile($kml->getFilename(),true);
           $response->sendHttpHeaders();
           readfile($kml->getFilename());  
            $this->getEventDispather()->notify(new mfEvent($kml, 'meetings.kml.export'));                      
           die();
        }  
      //  else var_dump($filter->getErrorSchema()->getErrorsMessage());
       // else var_dump($filter['range']->getErrors());
        die("Error filter");
   }

}


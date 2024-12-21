<?php

class customers_meetings_ExportKMLMeetingAction extends mfAction {
    
   
    
 
    function execute(mfWebRequest $request) {              
           
        $meeting=new CustomerMeeting($request->getGetParameter('meeting'));
        if ($meeting->isNotLoaded())
            $this->forward404File();
        $kml=new CustomerMeetingExportKML($meeting);
        $kml->build();     
        $response=$this->getResponse();     
        $response->setHttpHeader('Content-Type', mfFileMime::getType('kml'));
        $response->setHttpHeader('Content-Length', $kml->getSize());         
        $response->setHttpHeader('Content-Disposition','attachment; filename="'.$kml->getName().'"');
        $response->sendHttpHeaders();
        echo $kml->output();        
        die();       
   }

}


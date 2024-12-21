<?php


require_once dirname(__FILE__)."/../locales/Export/CustomerMeetingExportCsvFilter.class.php";
require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsFormFilter.class.php";

class customers_meetings_ExportCsvMeetingsAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {                                              
     //  echo "<pre>"; var_dump($request->getGetParameter('filter')); echo "</pre>"; die(__METHOD__);
        if (!$this->getUser()->hasCredential([['superadmin','admin','meeting_export']]))
             $this->forwardTo401Action ();
        $filter= new CustomerMeetingsFormFilter($this->getUser());  
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                  
           $csv=new CustomerMeetingExportCsvFilter($filter,array('lang'=>$this->getUser()->getCountry()));
           $csv->build();          
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
           $response->setHeaderFile($csv->getFilename(),true);
           $response->sendHttpHeaders();
           readfile($csv->getFilename()); 
           $this->getEventDispather()->notify(new mfEvent($csv, 'meetings.csv.export'));           
           die();
        }  
        else {
   //  echo "<pre>"; var_dump($filter->getErrorSchema()->getErrorsMessage()); echo "</pre>"; 
        }
        if (mfConfig::get('app')=='dev')
        {    
           echo "<pre>"; var_dump($filter->getErrorSchema()->getErrorsMessage()); echo "</pre>"; 
        }   
     //  echo "<!--"; var_dump($request->getGetParameter('filter')); echo "-->"; 
     //  echo "<!-->"; var_dump($filter->getErrorSchema()->getErrorsMessage()); echo "-->"; 
        die("Error filter");
   }

}


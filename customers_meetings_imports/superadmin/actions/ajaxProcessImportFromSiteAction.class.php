<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsImportFormFilter.class.php";

class customers_meetings_imports_ajaxProcessImportFromSiteAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
       
    
    function execute(mfWebRequest $request)
    {       
        $messages = mfMessages::getInstance();
      try 
      {                
          $user=$this->getUser();
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);              
          $formFilter=new CustomerMeetingsImportFormFilter($user,$request->getPostParameter('CustomerMeetingImportFromSite'),$site);
          $formFilter->bind($request->getPostParameter('CustomerMeetingImportFromSite'));
          if ($formFilter->isValid())
          {
              $formFilter->execute();
              $response=array(//'message'=>__("Import is in progress"),
                              'progress'=>$formFilter->getProgressBarPourcentage(),
                              'remaining'=>$formFilter->getProgressBarRemaining(),
                              'finished'=>$formFilter->isFinished(),
                              'processed'=>$formFilter->isProcessed(),
                              'next'=>$formFilter->getNextLimit());
              if ($formFilter->isFinished())
                  $response['info']=__("Import is done");               
              $this->getEventDispather()->notify(new mfEvent($formFilter->getMeetings(), 'meetings.import.from.site'));       
          }    
          else
          {
            //   echo "<pre>"; var_dump($this->formFilter->getErrorSchema()->getErrorsMessage()); echo "</pre>";  
          }    
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}



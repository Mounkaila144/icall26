<?php


class server_services_ajaxRefresh2Action extends mfAction{
   
    public function execute(\mfWebRequest $request){

        $messages = mfMessages::getInstance(); 
        try
        {              
              $engine = new SiteServicesServerProcessEngine();             
              $engine->process();       
            /* $messages->addInfo(__("[%s/%s] server(s) %sha(s)ve been refreshed.",array($engine->getNumberOfProcessedServers(),
                                                                                      $engine->getNumberOfServers(),
                                                                                      (string)$engine->getSiteServicesServers()->getNames()
                                                                                    )));     */
               $response=array('message'=>__("s[%s/%s] server(s) %sha(s)ve been refreshed.",array($engine->getNumberOfProcessedServers(),
                                                                                      $engine->getNumberOfServers(),
                                                                                      (string)$engine->getSiteServicesServers()->getNames()
                                                                                    )),
                            'isFinished'=>$engine->getIsFinished(),
                             );
       
        }
        catch (Exception $e)
        {
            $messages->addError($e);
        }  
         
        // $this->forward('site_services','ajaxListPartialSiteServices');
           return $messages->hasErrors()?array("errors"=>$messages->getDecodedErrors()):$response;
    }

}

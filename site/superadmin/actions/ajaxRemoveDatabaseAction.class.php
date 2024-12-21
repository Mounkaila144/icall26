<?php

class site_ajaxRemoveDatabaseAction extends mfAction {

    function execute(mfWebRequest $request) {
        $messages=mfMessages::getInstance();       
        try
        {                
            $site=new Site($request->getPostParameter('Host'));
            if ($site->isNotLoaded())
               throw new mfException(__("Site [%s] doesn't exist.",$site->get('site_host')));             
            $soap=new SoapOvh();
            $soap->login();                                           
            $soap->databaseDelete($this->getRequest()->getSite()->getSite()->getHostName(),$site->get('site_db_name'));                      
            $soap->logout();                 
            $site->delete();
            $response=array('info'=>__("Database has been remove."));
        }
        catch (SoapFault $e)
        {
            $messages->addError($e);                      
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }    
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;      
    }

}


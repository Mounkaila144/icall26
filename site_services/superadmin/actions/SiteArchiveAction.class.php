<?php


class site_services_SiteArchiveAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance(); 
        try {
            $site=new Site($request->getPostParameter('host'));
            $archive=new UtilsTar($site);
            $archive->tar();
            $response = array( "action" => "SiteArchive");
            
        } catch (Exception $ex) {
            
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;        
    }
    

}

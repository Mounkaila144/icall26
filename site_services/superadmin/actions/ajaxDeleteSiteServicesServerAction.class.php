<?php


class site_Services_ajaxDeleteSiteServicesServerAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        
    $messages = mfMessages::getInstance();
      try 
      {                
         $item=new SiteServicesServer($request->getPostParameter('SiteServicesServer'));        
         if ($item->isLoaded())
         {                
            $item->delete();           
            $response = array("action"=>"DeleteSiteServicesServer",
                              "info"=>__("Server  has been removed."),
                              "id" =>$item->get('id')
                          );
         }    
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

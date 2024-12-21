<?php


class site_Services_ajaxDeleteSiteAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        
    $messages = mfMessages::getInstance();
      try 
      {                
         $item=new SiteServicesSite($request->getPostParameter('SiteServicesSite'));        
         if ($item->isLoaded())
         {                
            $item->delete();           
            $response = array("action"=>"DeleteSite",
                              "info"=>__("Site  has been removed."),
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

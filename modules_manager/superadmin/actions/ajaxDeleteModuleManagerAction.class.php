<?php

 
class modules_manager_ajaxDeleteModuleManagerAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);     
          if (!$site)  
               throw new mfException(__("thanks to select a site"));           
          $item= new ModuleManager($request->getPostParameter('ModuleManager'),$site);    
          if ($item->isLoaded())
          {  
           $item->delete();   
           $response = array("action"=>"DeleteModuleManager","id"=>$item->get('id'));
          }                    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}


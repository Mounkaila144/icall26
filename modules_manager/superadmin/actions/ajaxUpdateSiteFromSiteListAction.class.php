<?php
 
class modules_manager_ajaxUpdateSiteFromSiteListAction extends mfAction {
       
    
    function execute(mfWebRequest $request) { 
    
      $messages = mfMessages::getInstance();
      try 
      {
         $site=new Site($request->getPostParameter('site'));       
         if ($site->isNotLoaded())
             return;      
         $siteModules= new siteModules($site);
         $siteModules->update();         
         if ($siteModules->hasModulesUpdated())
         {             
            $messages->addInfo(format_number_choice("[1] one module [{modules}] is updated on site {site}.|(1,Inf] modules [{modules}] are updated on site {site}.",array('site'=>$site->getHost(),'modules'=>implode(',',$siteModules->getModulesUpdated())),count($siteModules->getModulesUpdated()))                               
                              );
         }
         else
             $messages->addInfo(__('All modules are uptodate on site %s',$site->getHost()));     
         $response=array("action"=>"UpdateSiteModule",
                         "info"=>$messages->getDecodedInfos(),
                         "site"=>$site->get('site_id')
                         );
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}


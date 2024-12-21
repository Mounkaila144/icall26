<?php
 
class modules_manager_ajaxUpdateSitesAction extends mfAction {
       
    
    function execute(mfWebRequest $request) { 
    
      $messages = mfMessages::getInstance();
      
      foreach (SiteUtils::getSites() as $site)
      {             
            try 
            {
               $siteModules= new SiteModules($site);
               $siteModules->update();         
               if ($siteModules->hasModulesUpdated())
               {             
                  $messages->addInfo(format_number_choice("[1] one module [{modules}] is updated on site {site}.|(1,Inf] modules [{modules}] are updated on site {site}.",array('site'=>$site->getHost(),'modules'=>implode(',',$siteModules->getModulesUpdated())),count($siteModules->getModulesUpdated()))                               
                                    );
               }
               else
                   $messages->addInfo(__('All modules are uptodate on site %s',$site->getHost()));     
               $response=array("action"=>"UpdateSitesModule",
                               "info"=>$messages->getDecodedInfos(),                        
                               );
            } 
            catch (mfModuleException $e)
            {
                $messages->addError(__("Error {error} in site {site}.",array("error"=>$e->getI18nMessage(),"site"=>$site->getHost()))); 
            }
            catch (mfException $e) {
                $messages->addError(__("Error {error} in site {site}.",array("error"=>$e->getMessage(),"site"=>$site->getHost())));
            }
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}


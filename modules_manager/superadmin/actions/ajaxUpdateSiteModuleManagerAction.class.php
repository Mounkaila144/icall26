<?php
 
class modules_manager_ajaxUpdateSiteModuleManagerAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) { 
    
      $messages = mfMessages::getInstance();
      try 
      {
         $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
         if (!$site) 
              throw new mfException(__("thanks to select a site"));           
         $siteModules= new siteModules($site);
         $siteModules->update();         
         if ($siteModules->hasModulesUpdated())
         {    
            foreach ($siteModules->getModulesUpdated() as $module)
                $messages->addInfo(__("module [%s] is updated.",$module));
         }
         else
             $messages->addInfo(__('All modules are uptodate.'));        
         $response=array("action"=>"UpdateSiteModule",
                         "info"=>$messages->getDecodedInfos()
                         );
      } 
      catch (mfModuleException $e) {
          $messages->addError($e->getI18nMessage());
      }
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}


<?php


class modules_manager_ajaxListUpdateSiteModuleManagerAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        try 
        {
            $moduleManager=new ModuleManager($request->getPostParameter('ModuleManager'), $this->site);
            $this->updates=moduleManagerUpdater::getUpdatesForModule($moduleManager);
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

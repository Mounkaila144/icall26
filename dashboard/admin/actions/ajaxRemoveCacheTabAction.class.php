<?php


class dashboard_ajaxRemoveCacheTabAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();   
        try 
        { 
            SystemTab::removeCache('dashboard.site');
            $response=array('action'=>'RemoveCacheTab','info'=>__('cache has been removed.'));
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

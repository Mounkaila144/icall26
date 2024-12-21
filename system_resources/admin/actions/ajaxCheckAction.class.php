<?php


class system_resources_ajaxCheckAction extends mfAction {
    
       
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();            
        $request->addRequestParameter('system_resources_check','YES');
        $messages->addInfo(__('Resources have been updated.'));
        $this->forward('system_resources','ajaxPartialSettings'); 
    }
    
}


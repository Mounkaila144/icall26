<?php

require dirname(__FILE__)."/ajaxAdminAction.class.php";

class sites_AdminAction extends sites_ajaxAdminAction {
    
    function execute(mfWebRequest $request)
    {
        if ($request->isXmlHttpRequest())
             $this->forward("sites","ajaxAdmin");
        parent::execute($request);
    }
}


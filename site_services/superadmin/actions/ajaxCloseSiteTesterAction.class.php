<?php


class site_services_ajaxCloseSiteTesterAction extends mfAction{
    
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        try
        {  
             $server= new SiteServicesServer();            
             $server->setHost('www.ecosol0.net');                    
                $api = new iCall26ServerServiceApi($server);
                $api->login('fmallet','antromane');               
                $api->changeAdminSites(array('www.ecosol16.net'),"YES");
           var_dump($api->getResponse());
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
      die(__METHOD__);
    }
}

<?php

//http://www.ecosol0.net/superadmin/system/resources/admin/WkhtmltoimageTest

class system_resources_WkhtmltoimageTestAction extends mfAction {
    
       
    function execute(mfWebRequest $request)
    {
       //  echo __METHOD__;
                        
        $api=new ServiceImpotVerifApi($request->getGetParameter('number','0401662973110'),$request->getGetParameter('reference','18A4968605250'));     
        $api->process();        
        if ($api->hasError())                         
            die('ERROR');
                
        $directory=mfConfig::get('mf_app_cache_dir')."/data/tests/verif";
        $api->generatePictureTest($directory,'test');
        
         $response=$this->getResponse();
        $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');      
        $response->sendFile($directory."/test.png");
         return mfView::NONE;
    }
    
}


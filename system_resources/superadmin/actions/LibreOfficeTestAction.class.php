<?php

//http://www.ecosol0.net/superadmin/system/resources/admin/LibreOfficeTest

class system_resources_LibreOfficeTestAction extends mfAction {
    
       
    function execute(mfWebRequest $request)
    {
        //  echo __METHOD__;
        //  
          //libreoffice --headless --convert-to pdf /data/www/html/modules/system_resources/data/test.docx --outdir /data/www/html/tmp/sites/6dikxahlp.icall26.net/superadmin/prod/data/pdf/libreoffice
         $dir = mfConfig::get('mf_site_app_cache_dir')."/data/pdf/libreoffice";
         mfFileSystem::mkdirs($dir);
         
         $office = new SystemLibreOffice(array('--headless','--convert-to','pdf'));
         $office->setFile(new File(realpath(__DIR__."/../data/libreoffice/test.docx")));
         $office->setOutput(new File($dir."/test.pdf"));
         $office->execute();
                           
         $response=$this->getResponse();
         $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');              
         $response->sendFile($office->getOutput()->getFile());
         die();
         return mfView::NONE;
    }
    
}


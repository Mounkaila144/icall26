<?php

//http://www.ecosol0.net/superadmin/system/resources/admin/imagemagickTest

class system_resources_imagemagickTestAction extends mfAction {
    
       
    function execute(mfWebRequest $request)
    {
        // echo __METHOD__;
                        
          $magick=new SystemImageMagick();
          
        //  var_dump($magick->getVersion());
          $magick->setOptions(__DIR__."/../data/imagemagick/test.png ".__DIR__."/output.pdf");
          $magick->convert();
          
          
         return mfView::NONE;
    }
    
}


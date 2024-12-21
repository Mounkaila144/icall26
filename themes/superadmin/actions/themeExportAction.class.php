<?php

class themes_themeExportAction extends mfAction {
    
    
     
    function execute(mfWebRequest $request) {   
        
       $theme=new Themes($request->getGetParameter('id'));
       if ($theme->isLoaded())
       {    
          $theme->outputZip();
          die();
       }   
       $this->forward404File(); 
       return mfView::NONE;       
    }

}


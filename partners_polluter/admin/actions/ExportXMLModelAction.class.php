<?php


class partners_polluter_ExportXMLModelAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {            
      try 
      {  
          $model=new PartnerPolluterModel($request->getGetParameter('model'));         
          if ($model->getI18n()->isNotLoaded())
              throw new mfException(__('Model is invalid.'));
          
          $xml=new PartnerPolluterModelI18nXML($model->getI18n());
          $xml->save();
           
        $response=$this->getResponse();                                
        $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
        $response->setHeaderFile($xml->getFilename(),true);            
        $response->sendHttpHeaders();     
        ob_start();
        ob_end_clean();  
        ob_end_flush();
        readfile($xml->getFilename());  
      } 
      catch (mfException $e) {
         echo $e->getMessage();
      } 
      die();
    }
}


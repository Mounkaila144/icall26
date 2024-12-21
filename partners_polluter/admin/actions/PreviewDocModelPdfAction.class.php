<?php


class partners_polluter_PreviewDocModelPdfAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {            
      try 
      {  
         ///  if (!SystemResourceSettings::load()->hasResource('libreoffice'))
        //        throw new mfException(__("Resource 'libreoffice' is missing."));        
          $model=new PartnerPolluterModel($request->getGetParameter('model'));         
          if (!$model->hasI18n())
              throw new mfException(__('Model is invalid.'));
          if ($model->getI18n()->hasFile())
          {                             
              $office = new SystemLibreOffice(array('--headless','--convert-to','pdf'));
              $office->setFile(new File($model->getI18n()->getFile()->getFile()));
              $office->setOutput(new File(mfConfig::get('mf_site_app_cache_dir')."/data/pdf/libreoffice/models/".$model->get('id')."/model.pdf"));
              $office->execute();             
              if (!$office->getOutput()->isExist())
                 throw new mfException(__('PDF Model has not been generated.'));                             
              $response=$this->getResponse();                            
              $response->sendFile($office->getOutput()->getFile(),0,0);                         
          }
          else
          {    
              throw new mfException(__('Not supported.'));             
          }
      } 
      catch (mfException $e) {
         echo $e->getMessage();
      } 
      die();
    }
}


<?php


class app_domoprime_ExportAssetPdfAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {          
           if (!$this->getUser()->hasCredential([['superadmin','admin','app_domoprime_asset_export_pdf']]))
            $this->forwardTo401Action(); 
          $asset=new DomoprimeAsset($request->getGetParameter('Asset'));         
          if ($asset->isNotLoaded())
             $this->forward404File();          
          $model=DomoprimeSettings::load()->getModelForAsset();               
          if ($model->isNotLoaded())
              throw new mfException( __("Model is invalid."));
          $pdf=new DomoprimeAssetPDF($model,$asset);
          if ($request->getGetParameter('debug')=='true')
              $pdf->output();
          else
              $pdf->forceOutput();       
      } 
      catch (mfException $e) {
          $messages->addError($e);
          echo $e->getMessage();
      } 
    //  var_dump($messages->getDecodedErrors());
      die();
    }
}


<?php


class app_domoprime_PreviewAfterWorkModelAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {            
      try 
      {  
          $model=new DomoprimeAfterWorkModel($request->getGetParameter('model'));         
          if ($model->getI18n()->isNotLoaded())
              throw new mfException(__('Model is invalid.'));
          if ($model->getI18n()->hasFile())
          {    
            
              if (!$model->getI18n()->getFile()->isExist())
                  throw new mfException(__('PDF model is invalid.'));
            //  echo $model->getI18n()->getFile()->getFile(); die(__METHOD__);
              $response=$this->getResponse();                     
              $response->setHeaderFile($model->getI18n()->getFile()->getFile());
              $response->sendHttpHeaders();
              readfile($model->getI18n()->getFile()->getFile());
          }
          else
          {    
              throw new mfException(__('Not supported.'));
               /* $pdf=new ProductModelPreviewPdf($model);
                if ($request->getGetParameter('debug')=='true')
                    $pdf->output();
                else
                   $pdf->forceOutput(); */      
          }
      } 
      catch (mfException $e) {
         echo $e->getMessage();
      } 
      die();
    }
}


<?php


class app_domoprime_PreviewPreMeetingModelAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {            
      try 
      {  
          $model=new DomoprimePreMeetingModel($request->getGetParameter('model'));         
          if ($model->getI18n()->isNotLoaded())
              throw new mfException(__('Model is invalid.'));
          if ($model->getI18n()->hasFile())
          {    
            
              if (!$model->getI18n()->getFile()->isExist())
                  throw new mfException(__('PDF model is invalid.'));
              
              $response=$this->getResponse();            
              $response->sendFile($model->getI18n()->getFile()->getFile(),0,0);                          
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


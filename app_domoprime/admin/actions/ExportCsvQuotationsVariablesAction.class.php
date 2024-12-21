<?php


class app_domoprime_ExportCsvQuotationsVariablesAction extends mfAction {    
   
    function execute(mfWebRequest $request) {
        
        $model_i18n=new DomoprimeQuotationModelI18n($request->getGetParameter('modelI18n'));
       // var_dump($model_i18n->getUsedVariables());
        //die(__METHOD__);
        $csv=new DomoprimeVariablesQuotationExportCsvFilter($model_i18n->getUsedVariables(),$this->getUser(),array('lang'=>$this->getUser()->getLanguage()));        
        $csv->build();                       
        ob_start();
        ob_end_clean();
        $response=$this->getResponse();
        $response->setHeaderFile($csv->getFilename());
        $response->sendHttpHeaders();
        readfile($csv->getFilename()); 
        die();        
        
   }

}


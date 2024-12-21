<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeAssetFormFilter.class.php";

class app_domoprime_ExportCsvAssetsAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {             
        if (!$this->getUser()->hasCredential([['superadmin','admin','app_domoprime_asset_export']]))
            $this->forwardTo401Action(); 
        $filter= new DomoprimeAssetFormFilter($this->getUser());          
       // echo "<pre>"; var_dump($request->getGetParameter('filter')); echo "</pre>"; 
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                          
          //  echo "Filter".$filter->getQuery()."<br/>";           
          $csv=new DomoprimeAssetExportCsvFilter($filter,array('lang'=>$this->getUser()->getCountry()));        
          $csv->build();                       
          ob_start();
          ob_end_clean();
          $response=$this->getResponse();
          $response->setHeaderFile($csv->getFilename());
          $response->sendHttpHeaders();
          readfile($csv->getFilename()); 
          die();
        }    
        die("Error filter");
   }

}


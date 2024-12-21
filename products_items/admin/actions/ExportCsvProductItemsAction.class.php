<?php

require_once dirname(__FILE__)."/../locales/FormFilters/ProductItemFormFilter.class.php";

class products_items_ExportCsvProductItemsAction extends mfAction {

    public function execute(\mfWebRequest $request) {
        
        $filter= new ProductItemFormFilter($request->getGetParameter('filter'));          
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                          
          $csv=new ProductItemsExportCsvFilter($filter,array('lang'=>$this->getUser()->getCountry()));        
          $csv->build();                       
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
           $response->setHeaderFile($csv->getFilename(),true);
           $response->sendHttpHeaders();
           readfile($csv->getFilename()); 
           die();
        }else{
            var_dump($filter->getErrorSchema()->geterrorsMessage());
            die("Error filter");  
        } 
        
    }

}

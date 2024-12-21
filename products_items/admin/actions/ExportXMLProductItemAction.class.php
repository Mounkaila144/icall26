<?php
require_once dirname(__FILE__)."/../locales/FormFilters/ProductItemFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/ProductItemPager.class.php";

class products_items_ExportXMLProductItemAction extends mfAction{
        
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();                                      
              
        try
        {      
            $filter= new ProductItemFormFilter($request->getGetParameter('filter'));
            $pager=new ProductItemPager();
            $filter->bind($request->getGetParameter('filter'));
            if ($filter->isValid() || $request->getGetParameter('filter')==null)
            {
                
                // pager
                $pager->setQuery($filter->getQuery()); 
                $pager->setNbItemsByPage($filter['nbitemsbypage']);                  
                $pager->setPage($request->getGetParameter('page'));
                $pager->execute();
                // xml form
                $xml=new ProductItemFormExportXML($pager);
                if ($debug=$request->getGetParameter('debug',false))
                    $xml->debug();
                $xml->process();   

                if ($debug)
                   throw new mfException(__("--STOP--"));

                ob_start();
                ob_end_clean();
                $response=$this->getResponse();
                $response->setHeaderFile($xml->getFilename(),true);
                $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
                $response->sendHttpHeaders();
                readfile($xml->getFilename());  
                die();
            
            }else{
                var_dump($filter->getErrorSchema()->geterrorsMessage());
                die("Error filter");  
            } 
        }
        catch (mfException $e)
        {
            die ($e->getMessage());
        }
        die();        
    }

}

<?php

require_once dirname(__FILE__)."/../locales/FormFilters/ProductItemFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/ProductItemPager.class.php";

class products_items_ajaxListPartialItemAction extends mfAction {


  
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();     
        $this->settings= new ProductItemSettings();                          
        $this->formFilter= new ProductItemFormFilter();                  
        $this->pager=new ProductItemPager();
        $this->user=$this->getUser();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {   
                //   echo $this->formFilter->getQuery()."<br/>";
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                  
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
       // var_dump($this->pager[0]);
    }
    
}    
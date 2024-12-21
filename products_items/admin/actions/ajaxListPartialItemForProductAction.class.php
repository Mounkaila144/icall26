<?php

require_once dirname(__FILE__)."/../locales/FormFilters/ProductItemForProductFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/ProductItemForProductPager.class.php";

class products_items_ajaxListPartialItemForProductAction extends mfAction {


  
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();     
        $this->settings= new ProductItemSettings();       
        $this->product=$request->getRequestParameter('product',new Product($request->getPostParameter('Product')));
        if ($this->product->isNotLoaded())
            return ;                
        $this->formFilter= new ProductItemForProductFormFilter();                  
        $this->pager=new ProductItemForProductPager();
        $this->user=$this->getUser();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {   
                //   echo $this->formFilter->getQuery()."<br/>";
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);    
                $this->pager->setParameter('product_id',$this->product->get('id'));
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
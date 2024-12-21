<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeSectorEnergyForProductFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeSectorEnergyForProductPager.class.php";

class app_domoprime_ajaxListPartialSectorEnergyForProductAction extends mfAction {

 
   
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();     
        $this->product=$request->getRequestParameter('product',new Product($request->getPostParameter('Product')));
        if ($this->product->isNotLoaded())
            return ;
        $this->formFilter= new DomoprimeSectorEnergyForProductFormFilter();                  
        $this->pager=new DomoprimeSectorEnergyForProductPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {                       
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',$this->getUser()->getCountry());              
                $this->pager->setParameter('product_id',$this->product->get('id'));      
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();         
              //  echo mfSiteDatabase::getInstance()->getQuery();
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
       // echo "<pre>"; var_dump($this->pager->getItems());
    }
    
}    
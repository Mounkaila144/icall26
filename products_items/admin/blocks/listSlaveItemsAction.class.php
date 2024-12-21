<?php
require_once dirname(__FILE__)."/../locales/FormFilters/ProductItemSlaveForProductFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/ProductItemSlaveForProductPager.class.php";

class products_items_listSlaveItemsActionComponent extends mfActionComponent {
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();     
        $this->settings= new ProductItemSettings();       
        $this->product=$request->getRequestParameter('product',new Product($request->getPostParameter('Product')));
        if ($this->product->isNotLoaded())
            return ;  
        //---- for slave
        $this->formFilter= new ProductItemSlaveForProductFormFilter();                  
        $this->pager=new ProductItemSlaveForProductPager();
        $this->user=$this->getUser();
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {   
                     //echo $this->formFilter->getQuery()."<br/>";
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
    }

}

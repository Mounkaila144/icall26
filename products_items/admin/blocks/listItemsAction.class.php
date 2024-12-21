<?php
require_once dirname(__FILE__)."/../locales/FormFilters/ProductItemsForProductFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/ProductItemsForProductPager.class.php";

class products_items_listItemsActionComponent extends mfActionComponent{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();     
        $this->settings= new ProductItemSettings();       
        $this->product=$request->getRequestParameter('product',new Product($request->getPostParameter('Product')));
        if ($this->product->isNotLoaded())
            return ;  
       
        //---- for master
        $this->formFilter= new ProductItemsForProductFormFilter();                  
        $this->pager=new ProductItemsForProductPager();
        $this->user=$this->getUser();
        try
        {
               /* $this->formFilter->bind($request->getPostParameter('filterMaster'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filterMaster')==null)
                {   */
                    //echo $this->formFilter->getQuery()."<br/>";
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);    
                    $this->pager->setParameter('product_id',$this->product->get('id'));
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();              
                /*}    */                               
        }catch (mfException $e)
        {
            $messages->addError($e);
        }      
       // var_dump($this->pager[0]);
    }

}

<?php
require_once __DIR__."/../locales/FormFilters/CustomerContractReferenceForSelectFormFilter.class.php";
require_once __DIR__."/../locales/Pagers/CustomerContractReferenceForSelectPager.class.php";

class customers_contracts_selectListReferenceActionComponent extends mfActionComponent {
   
    public function execute(\mfWebRequest $request) {
               
        $messages=mfMessages::getInstance();     
        $filter=$this->getParameter('filter');
        $this->formFilter= new CustomerContractReferenceForSelectFormFilter(10);
        $this->pager=new CustomerContractReferenceForSelectPager();     
        try 
        {  
                //echo $this->formFilter->getQuery();
                $this->pager->setQuery($this->formFilter->getQuery());               
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setPage(1);
                $this->pager->execute();
        }
        catch (mfException $e)
        {
              $messages->addError($e);
        } 
    }

}

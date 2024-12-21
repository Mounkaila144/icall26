<?php

require_once dirname(__FILE__)."/../locales/FormFilters/AddressByCustomerFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/AddressByCustomerPager.class.php";

class customers_MyAddressesActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request) {    
        
        $this->formFilter= new AddressByCustomerFormFilter();                  
        $this->pager=new AddressByCustomerPager();
        try
        {                 
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage(10);  
                $this->pager->setParameter('user_id',$this->getUser()->getGuardUser()->get('id'));
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();                                                         
        }
        catch (mfException $e)
        {
            $this->getMessage()->addError($e);
        }    
    } 
    
    
}

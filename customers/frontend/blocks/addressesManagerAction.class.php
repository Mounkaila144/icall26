<?php

class customers_addressesManagerActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request) {    
           if (!$this->getUser()->isAuthenticated())
             return mfView::NONE;                
           if (!$this->getUser()->isCustomerUser())
             return mfView::NONE;  
    } 
    
    
}

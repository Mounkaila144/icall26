<?php

class customers_logoutActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request) {    
                
        if (!$this->getUser()->isAuthenticated())
            return mfView::NONE; //isAuthenticated()
        if (!$this->getUser()->isCustomerUser())
            return ;
    } 
    
    
}

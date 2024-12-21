<?php

class customers_subscriptionActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request) {                    
          if ($this->getUser()->getGuardUser()->isSubsripted())
             return mfView::NONE;   
          $this->subscription=$this->getUser()->getStorage()->read('CUSTOMER_USER_SUBSCRIPTION',new CustomerSubscription($this->getUser()->getGuardUser()));          
    } 
    
    
}

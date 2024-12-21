<?php

class customers_subscriptionAddressStepActionComponent extends mfActionComponent {
   
    function execute(mfWebRequest $request)
    { 
          if (!$steps=$this->getUser()->getStorage()->read('CustomerUserSteps'))
            return mfView::NONE;
        $this->step=$steps->get('address');       
       // var_dump($this->step);
    }
    
    
}
<?php

class customers_subscriptionSigninStepActionComponent extends mfActionComponent {
   
    function execute(mfWebRequest $request)
    { 
        if (!$steps=$this->getUser()->getStorage()->read('CustomerUserSteps'))
            return mfView::NONE;
        $this->step=$steps->get('signin');          
    }
    
    
}
<?php

class customers_subscriptionStepsActionComponent extends mfActionComponent {
   
    function execute(mfWebRequest $request)
    { 
        $steps=$this->getUser()->getStorage()->read('CustomerUserSteps');  
        if (!$steps)
        {           
           $steps=CustomerSettings::load()->get('steps'); 
           $this->getUser()->getStorage()->write('CustomerUserSteps',$steps);          
        }                             
        $this->steps=$steps->getComponents();         
    }
    
    
}
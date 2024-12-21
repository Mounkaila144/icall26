<?php



class app_domoprime_pdfBillingsAction extends mfAction {
    
  
    function execute(mfWebRequest $request) {    
       
       try
       {           
           $this->model=$this->getParameter('model');                      
           $billings=$this->getParameter('billings');   
           DomoprimeBillingModelParameters::loadParametersForBillings($billings,$this);              
         //  $this->getEventDispather()->notify(new mfEvent($this, 'customers.meetings.document.build'));   
       }
       catch (mfException $e)
       {
           echo __("Error=").$e->getMessage();
       }
    }
}


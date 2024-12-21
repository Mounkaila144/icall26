<?php



class app_domoprime_pdfBillingAction extends mfAction {
    
  
    function execute(mfWebRequest $request) {          
       try
       {           
           $this->model=$this->getParameter('model');                      
           $billing=$this->getParameter('billing');   
           DomoprimeBillingModelParameters::loadParametersForBilling($billing,$this);   
           $this->getEventDispather()->notify(new mfEvent($this, 'app_domoprime.billing.build'));  
            if (mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug'))) && mfContext::getInstance()->getRequest()->getGetParameter('debug')=='true')
           {
               echo "<pre>"; var_dump($this->billing,$this->company,$this->financial_request);
               die();
           }             
       }
       catch (mfException $e)
       {
           echo __("Error=").$e->getMessage();
       }
    }
}


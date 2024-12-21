<?php



class app_domoprime_pdfAction extends mfAction {
    
  
    function execute(mfWebRequest $request) {    
       
       try
       {           
           $this->model=$this->getParameter('model');            
           $this->quotation_base=$this->getParameter('quotation');   
           DomoprimeQuotationModelParameters::loadParametersForQuotation($this->quotation_base,$this);                         
           $this->getEventDispather()->notify(new mfEvent($this, 'app_domoprime.quotation.build'));                      
           if (mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug'))) && mfContext::getInstance()->getRequest()->getGetParameter('debug')=='true')
           {
               echo "<pre>"; var_dump(array(
                   'quotation'=>$this->quotation,
                   'products'=>$this->products,
                   'contract'=>$this->contract,
                   'meeting'=>$this->meeting,
                   'calculation'=>$this->calculation,
                   'company'=>$this->company,
                   'master'=>$this->master,
                   'polluter'=>$this->polluter,
                   'financial_request'=>$this->financial_request,
               ));
               die();
           }   
       }
       catch (mfException $e)
       {
           echo __("Error=").$e->getMessage();
           die();
       }
    }
}


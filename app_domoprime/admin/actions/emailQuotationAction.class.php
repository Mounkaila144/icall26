<?php


class app_domoprime_emailQuotationAction extends mfAction {
         
    function execute(mfWebRequest $request) {   
       try
       {  
            $this->model=$this->getParameter("model");
            DomoprimeQuotationModelParameters::loadParametersForQuotation($this->getParameter("quotation"),$this);
       }
       catch (mfException $e)
       {
           echo __("Error=").$e->getMessage();
       }
    }
}

<?php


class DomoprimePdfEngine extends SystemPdfEngine {
   
     protected static $instance=null,$quotation_engine=array(),$billing_engine=array();    
     
     
     function getSettings()
     {
         return $this->settings=$this->settings===null?new DomoprimeSettings(null,$this->getSite()):$this->settings;
     }
         
    
     function getQuotationEngine($model,$quotation,$polluter_quotation_model)
     {
         $key=$model->get('id')."_".$quotation->get('id')."_".$polluter_quotation_model->get('id');
         if ($this->quotation_engine[$key]===null)
         {    
            if ($this->getPdfEngine()=='pdf2')
            {    
                if ($this->getSettings()->get('quotation_multi_pdf')=='YES')
                    $class=$this->getSettings()->getQuotationMultiEngine(); //"DomoprimeQuotationMultiPdf";
                else
                    $class="DomoprimeQuotationPDF2";
            }
            else
            {                   
               if ($this->getSettings()->get('quotation_multi_pdf')=='YES')
                    $class=$this->getSettings()->getQuotationMultiEngine();
                else
                    $class="DomoprimeQuotationPDF";  
            }
            if (!class_exists($class))
                throw new mfException(__('PDF engine invalid. [%s]', str_replace ('DomoprimeQuotation','',$class)));
            $this->quotation_engine[$key]=new $class($model,$quotation,$polluter_quotation_model);
        }
         return $this->quotation_engine[$key];
     }
     
     function getBillingEngine($model,$quotation)
     {
         $key=$model->get('id')."_".$quotation->get('id');
         if ($this->billing_engine[$key]===null)
         {    
            if ($this->getPdfEngine()=='pdf2')
               $class="DomoprimeBillingPDF2";
            else
               $class="DomoprimeBillingPDF";  
            if (!class_exists($class))
                throw new mfException(__('PDF engine invalid. [%s]', str_replace ('DomoprimeBilling','',$class)));
            $this->billing_engine[$key]=new $class($model,$quotation);
        }
         return $this->billing_engine[$key];
     }
    
      
}

<?php



class app_domoprime_pdfAssetAction extends mfAction {
    
  
    function execute(mfWebRequest $request) {    
       
       try
       {           
           $this->model=$this->getParameter('model');                      
           $asset=$this->getParameter('asset');   
           DomoprimeAssetModelParameters::loadParametersForAsset($asset,$this);   
           
         //  $this->getEventDispather()->notify(new mfEvent($this, 'customers.meetings.document.build'));   
       }
       catch (mfException $e)
       {
           echo __("Error=").$e->getMessage();
       }
    }
}


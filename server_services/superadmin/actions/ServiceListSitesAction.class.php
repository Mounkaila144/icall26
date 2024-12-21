<?php

require_once dirname(__FILE__).'/../locales/FormFilters/SitesForServicesFormFilter.class.php';

class server_services_ServiceListSitesAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance();                       
        try
        {                       
            $this->formFilter= new SitesForServicesFormFilter(); 
            $this->formFilter->execute();
            $response=array('status'=>'OK','items'=>$this->formFilter->getItems());
        }
        catch (Exception $e)
        {
            $messages->addError($e);
            return array('error'=>$messages->getDecodedErrors());
        }  
        return $response;  
        
    }

}

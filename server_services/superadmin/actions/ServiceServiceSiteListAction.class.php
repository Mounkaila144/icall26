<?php
require_once dirname(__FILE__).'/../locales/FormFilters/ServiceForServicesFormFilter.class.php';

class server_services_ServiceServiceSiteListAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        echo '++++++++++++++++++ ServiceSiteList +++++++++++';
        $messages = mfMessages::getInstance();          
      
        $this->formFilter= new ServiceForServicesFormFilter(); 
        try
        {                       
            
            $this->formFilter->execute();
            $response=array('status'=>'OK','items'=>$this->formFilter->getItems());
        }
        catch (Exception $e)
        {
            $messages->addError($e);
            return array('error'=>$messages->getDecodedErrors());
        }  
        return $messages->hasErrors()?array("errors"=>$messages->getDecodedErrors()):$response;
        
    }
        
    

}

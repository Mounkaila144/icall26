<?php


class SiteServicesNewServerForm extends SiteServicesNewServerBaseForm {
 
    
      function configure()
    {
        parent::configure(); 
        unset($this['id']);        
    }
    
    
    function getValues()
    {
        $values=parent::getValues();
        $ssl=new OpenCypherIVSSL($this->getSettings()->getPrivateKey());        
        $values["password"]= $ssl->encrypt($values["password"],"ewebsolutionskech#2020");        
        return $values;
    }
}

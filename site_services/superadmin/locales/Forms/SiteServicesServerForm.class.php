<?php


class SiteServicesServerForm extends SiteServicesNewServerBaseForm{
    
    
    function getValues()
    {
        $values=parent::getValues();
        $ssl=new OpenCypherIVSSL($this->getSettings()->getPrivateKey());        
        $values["password"]= $ssl->encrypt($values["password"],"ewebsolutionskech#2020");        
        return $values;
    }
}

<?php


class DomoprimeBillingModelSignatureCollection extends mfArray {
    
    
    function __construct($data = null) {
        $signatures=array();
        if ($data)
        {    
            foreach (explode(";",$data) as $signature)
                $signatures[]=new DomoprimeBillingModelSignature($signature);
        }
        parent::__construct($signatures);
    }
     
}

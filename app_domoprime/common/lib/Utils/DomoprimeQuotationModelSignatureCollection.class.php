<?php


class DomoprimeQuotationModelSignatureCollection extends mfArray {
    
    
    function __construct($data = null) {
        $signatures=array();
        if ($data)
        {    
            foreach (explode(";",$data) as $signature)
                $signatures[]=new DomoprimeQuotationModelSignature($signature);
        }
        parent::__construct($signatures);
    }
     
}
